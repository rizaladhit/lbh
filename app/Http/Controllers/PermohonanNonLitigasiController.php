<?php

namespace App\Http\Controllers;

use App\Mail\PermohonanNonLitigasiAssignedMail;
use App\Mail\PermohonanNonLitigasiStatusMail;
use App\Mail\PermohonanNonLitigasiSubmittedMail;
use App\Models\JenisPelayanan;
use App\Models\Lawyer;
use App\Models\Paralegal;
use App\Models\PermohonanNonLitigasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PermohonanNonLitigasiController extends Controller
{
    public function index(Request $request)
    {
        $baseQuery = PermohonanNonLitigasi::query();
        if (auth()->user()->role === 'pengacara') {
            $lawyerId = auth()->user()->lawyer?->id;
            $lawyerId ? $baseQuery->where('assigned_lawyer_id', $lawyerId) : $baseQuery->whereRaw('1 = 0');
        } elseif (auth()->user()->role === 'paralegal') {
            $paralegalId = auth()->user()->paralegal?->id;
            $paralegalId ? $baseQuery->where('assigned_paralegal_id', $paralegalId) : $baseQuery->whereRaw('1 = 0');
        } elseif (auth()->user()->role !== 'admin') {
            $baseQuery->where('user_id', auth()->id());
        }

        $statusCounts = (clone $baseQuery)->selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();
        $totalAll = array_sum($statusCounts);

        $query = (clone $baseQuery)->with('user')->latest();
        if ($request->filled('status') && in_array($request->status, ['REGISTERED', 'APPROVED', 'VERIFIED', 'ASSIGNED', 'DONE', 'REJECTED'])) {
            $query->where('status', $request->status);
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_pemohon', 'like', "%{$search}%")
                  ->orWhere('nik_pemohon', 'like', "%{$search}%")
                  ->orWhere('jenis_perkara', 'like', "%{$search}%")
                  ->orWhere('no_registrasi', 'like', "%{$search}%")
                  ->orWhere('uraian_singkat', 'like', "%{$search}%");
            });
        }
        $permohonan = $query->paginate(10)->withQueryString();

        return view('permohonan.non_litigasi.index', compact('permohonan', 'statusCounts', 'totalAll'));
    }

    public function create()
    {
        if (in_array(auth()->user()->role, ['pengacara', 'paralegal'])) {
            abort(403, 'Akses ditolak. Advocate dan Paralegal hanya memiliki akses baca.');
        }
        $jenisPelayanans = JenisPelayanan::orderBy('nama')->get();
        return view('permohonan.non_litigasi.create', compact('jenisPelayanans'));
    }

    public function edit(PermohonanNonLitigasi $permohonanNonLitigasi)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $jenisPelayanans = JenisPelayanan::orderBy('nama')->get();
        return view('permohonan.non_litigasi.edit', compact('permohonanNonLitigasi', 'jenisPelayanans'));
    }

    public function update(Request $request, PermohonanNonLitigasi $permohonanNonLitigasi)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $validated = $request->validate([
            'nama_pemohon' => 'required|string|max:255',
            'alamat_pemohon' => 'required|string',
            'telp_hp_pemohon' => 'required|string|max:20',
            'nik_pemohon' => 'required|string|size:16',
            'jenis_perkara' => 'required|string|exists:jenis_pelayanans,nama',
            'tgl_rencana_kunjungan' => 'required|date',
            'uraian_singkat' => 'required|string',
            'file_ktp_kk' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_sktm' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_ttd' => 'nullable|string',
        ]);

        if ($request->hasFile('file_ktp_kk')) {
            Storage::disk('public')->delete($permohonanNonLitigasi->file_ktp_kk);
            $validated['file_ktp_kk'] = $request->file('file_ktp_kk')->store('permohonan/ktp_kk', 'public');
        } else {
            unset($validated['file_ktp_kk']);
        }

        if ($request->hasFile('file_sktm')) {
            Storage::disk('public')->delete($permohonanNonLitigasi->file_sktm);
            $validated['file_sktm'] = $request->file('file_sktm')->store('permohonan/sktm', 'public');
        } else {
            unset($validated['file_sktm']);
        }

        $ttdData = $request->input('file_ttd');
        if ($ttdData && str_starts_with($ttdData, 'data:image')) {
            Storage::disk('public')->delete($permohonanNonLitigasi->file_ttd);
            $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $ttdData));
            $filename = 'permohonan/ttd/ttd_' . time() . '.png';
            Storage::disk('public')->put($filename, $imageData);
            $validated['file_ttd'] = $filename;
        } else {
            unset($validated['file_ttd']);
        }

        $permohonanNonLitigasi->update($validated);

        return redirect()->route('permohonan-non-litigasi.show', $permohonanNonLitigasi)
            ->with('success', 'Permohonan berhasil diperbarui.');
    }

    public function store(Request $request)
    {
        if (in_array(auth()->user()->role, ['pengacara', 'paralegal'])) {
            abort(403);
        }
        $validated = $request->validate([
            'nama_pemohon' => 'required|string|max:255',
            'alamat_pemohon' => 'required|string',
            'telp_hp_pemohon' => 'required|string|max:20',
            'nik_pemohon' => 'required|string|size:16',
            'jenis_perkara' => 'required|string|exists:jenis_pelayanans,nama',
            'tgl_rencana_kunjungan' => 'required|date',
            'uraian_singkat' => 'required|string',
            'file_ktp_kk' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_sktm' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_ttd' => 'nullable|string',
        ]);

        $validated['file_ktp_kk'] = $request->file('file_ktp_kk')->store('permohonan/ktp_kk', 'public');
        if ($request->hasFile('file_sktm')) {
            $validated['file_sktm'] = $request->file('file_sktm')->store('permohonan/sktm', 'public');
        }

        // Handle signature: convert canvas dataURL to PNG file (optional)
        $ttdData = $request->input('file_ttd');
        if ($ttdData && str_starts_with($ttdData, 'data:image')) {
            $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $ttdData));
            $filename = 'permohonan/ttd/ttd_' . time() . '.png';
            Storage::disk('public')->put($filename, $imageData);
            $validated['file_ttd'] = $filename;
        } else {
            unset($validated['file_ttd']);
        }

        $permohonan = auth()->user()->permohonanNonLitigasi()->create($validated);

        $this->notifyAdmins($permohonan->fresh());

        return redirect()->route('permohonan-non-litigasi.index')->with('success', 'Form Permohonan Non-Litigasi berhasil dikirim.');
    }

    public function show(PermohonanNonLitigasi $permohonanNonLitigasi)
    {
        $user = auth()->user();
        $isOwner = $permohonanNonLitigasi->user_id == $user->id;
        $isAssignedLawyer = $user->role === 'pengacara' && $user->lawyer &&
            $permohonanNonLitigasi->assigned_lawyer_id == $user->lawyer->id;
        $isAssignedParalegal = $user->role === 'paralegal' && $user->paralegal &&
            $permohonanNonLitigasi->assigned_paralegal_id == $user->paralegal->id;
        $isAssigned = $isAssignedLawyer || $isAssignedParalegal;

        if ($user->role !== 'admin' && !$isOwner && !$isAssigned) {
            abort(403);
        }
        return view('permohonan.non_litigasi.show', compact('permohonanNonLitigasi'));
    }

    public function printForm(PermohonanNonLitigasi $permohonanNonLitigasi)
    {
        $user = auth()->user();
        $isOwner = $permohonanNonLitigasi->user_id == $user->id;
        $isAssignedLawyer = $user->role === 'pengacara' && $user->lawyer &&
            $permohonanNonLitigasi->assigned_lawyer_id == $user->lawyer->id;
        $isAssignedParalegal = $user->role === 'paralegal' && $user->paralegal &&
            $permohonanNonLitigasi->assigned_paralegal_id == $user->paralegal->id;
        $isAssigned = $isAssignedLawyer || $isAssignedParalegal;

        if ($user->role !== 'admin' && !$isOwner && !$isAssigned) {
            abort(403);
        }

        return view('permohonan.non_litigasi.print', compact('permohonanNonLitigasi'));
    }

    public function destroy(PermohonanNonLitigasi $permohonanNonLitigasi)
    {
        if (auth()->user()->role !== 'admin' && $permohonanNonLitigasi->user_id != auth()->id()) {
            abort(403);
        }
        Storage::disk('public')->delete([$permohonanNonLitigasi->file_ktp_kk, $permohonanNonLitigasi->file_sktm, $permohonanNonLitigasi->file_ttd]);
        $permohonanNonLitigasi->delete();
        return redirect()->route('permohonan-non-litigasi.index')->with('success', 'Data permohonan berhasil dihapus.');
    }

    /**
     * Verify permohonan by admin
     */
    public function approve(PermohonanNonLitigasi $permohonanNonLitigasi)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        if (!$permohonanNonLitigasi->canBeApproved()) {
            return redirect()->back()->with('error', 'Permohonan tidak dapat disetujui pada status saat ini.');
        }

        return view('permohonan.non_litigasi.approve', compact('permohonanNonLitigasi'));
    }

    public function storeApprove(Request $request, PermohonanNonLitigasi $permohonanNonLitigasi)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $validated = $request->validate([
            'verification_notes' => 'nullable|string|min:10',
        ], [
            'verification_notes.min' => 'Catatan persetujuan minimal 10 karakter',
        ]);

        $permohonanNonLitigasi->approve($validated['verification_notes'] ?? null);

        $this->notifyUser(
            $permohonanNonLitigasi->fresh('user'),
            'Disetujui',
            'Permohonan non-litigasi Anda telah disetujui oleh tim kami dan akan segera diverifikasi lebih lanjut.',
            '#0ea5e9',
            'Catatan',
            $validated['verification_notes'] ?? null
        );

        return redirect()->route('permohonan-non-litigasi.show', $permohonanNonLitigasi)
            ->with('success', 'Permohonan berhasil disetujui dan siap diverifikasi.');
    }

    public function reject(PermohonanNonLitigasi $permohonanNonLitigasi)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        if (!$permohonanNonLitigasi->canBeRejected()) {
            return redirect()->back()->with('error', 'Permohonan tidak dapat ditolak pada status saat ini.');
        }

        return view('permohonan.non_litigasi.reject', compact('permohonanNonLitigasi'));
    }

    public function storeReject(Request $request, PermohonanNonLitigasi $permohonanNonLitigasi)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $validated = $request->validate([
            'verification_notes' => 'nullable|string|min:10',
        ], [
            'verification_notes.min' => 'Catatan penolakan minimal 10 karakter',
        ]);

        $permohonanNonLitigasi->reject($validated['verification_notes'] ?? null);

        $this->notifyUser(
            $permohonanNonLitigasi->fresh('user'),
            'Ditolak',
            'Permohonan non-litigasi Anda tidak dapat kami proses lebih lanjut. Silakan lihat catatan dari tim kami pada detail permohonan.',
            '#ef4444',
            'Catatan',
            $validated['verification_notes'] ?? null
        );

        return redirect()->route('permohonan-non-litigasi.show', $permohonanNonLitigasi)
            ->with('success', 'Permohonan berhasil ditolak dan tidak dapat dilanjutkan.');
    }

    public function verify(PermohonanNonLitigasi $permohonanNonLitigasi)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        if (!$permohonanNonLitigasi->canBeVerified()) {
            return redirect()->back()->with('error', 'Permohonan tidak dapat diverifikasi pada status saat ini.');
        }

        return view('permohonan.non_litigasi.verify', compact('permohonanNonLitigasi'));
    }

    public function storeVerify(Request $request, PermohonanNonLitigasi $permohonanNonLitigasi)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $validated = $request->validate([
            'verification_notes' => 'required|string|min:10',
        ], [
            'verification_notes.required' => 'Catatan verifikasi harus diisi',
            'verification_notes.min' => 'Catatan verifikasi minimal 10 karakter',
        ]);

        $permohonanNonLitigasi->verify($validated['verification_notes']);

        $this->notifyUser(
            $permohonanNonLitigasi->fresh('user'),
            'Terverifikasi',
            'Permohonan non-litigasi Anda telah diverifikasi oleh tim kami dan akan segera ditugaskan ke tim hukum yang menangani.',
            '#10b981',
            'Catatan',
            $validated['verification_notes']
        );

        return redirect()->route('permohonan-non-litigasi.show', $permohonanNonLitigasi)
            ->with('success', 'Permohonan berhasil diverifikasi.');
    }

    /**
     * Assign permohonan to lawyer/paralegal
     */
    public function assignForm(PermohonanNonLitigasi $permohonanNonLitigasi)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        if (!$permohonanNonLitigasi->canBeAssigned()) {
            return redirect()->back()->with('error', 'Permohonan harus dalam status VERIFIED untuk ditugaskan.');
        }

        $lawyers = Lawyer::active()->latest('name')->get();
        $paralegals = Paralegal::active()->latest('name')->get();
        
        return view('permohonan.non_litigasi.assign', compact('permohonanNonLitigasi', 'lawyers', 'paralegals'));
    }

    public function storeAssign(Request $request, PermohonanNonLitigasi $permohonanNonLitigasi)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $validated = $request->validate([
            'assigned_lawyer_id' => 'nullable|exists:lawyers,id',
            'assigned_paralegal_id' => 'nullable|exists:paralegals,id',
        ], [
            'assigned_lawyer_id.exists' => 'Advocate yang dipilih tidak valid',
            'assigned_paralegal_id.exists' => 'Paralegal yang dipilih tidak valid',
        ]);

        if (!$validated['assigned_lawyer_id'] && !$validated['assigned_paralegal_id']) {
            return redirect()->back()->with('error', 'Pilih minimal satu advocate atau paralegal.');
        }

        $permohonanNonLitigasi->assign(
            $validated['assigned_lawyer_id'],
            $validated['assigned_paralegal_id']
        );

        $fresh = $permohonanNonLitigasi->fresh(['user', 'assignedLawyer', 'assignedParalegal']);

        $emailNotice = $this->sendAssignmentEmails($fresh);

        $this->notifyUser(
            $fresh,
            'Ditugaskan',
            'Permohonan non-litigasi Anda telah ditugaskan ke tim hukum kami. Tim akan segera menghubungi Anda untuk tindak lanjut.',
            '#f59e0b'
        );

        return redirect()->route('permohonan-non-litigasi.show', $permohonanNonLitigasi)
            ->with('success', 'Permohonan berhasil ditugaskan.' . $emailNotice);
    }

    private function sendAssignmentEmails(PermohonanNonLitigasi $permohonanNonLitigasi): string
    {
        $recipients = collect([
            [
                'role' => 'Advocate',
                'person' => $permohonanNonLitigasi->assignedLawyer,
            ],
            [
                'role' => 'Paralegal',
                'person' => $permohonanNonLitigasi->assignedParalegal,
            ],
        ])
            ->filter(fn ($recipient) => $recipient['person'] && filter_var($recipient['person']->email, FILTER_VALIDATE_EMAIL))
            ->unique(fn ($recipient) => strtolower($recipient['person']->email))
            ->values();

        if ($recipients->isEmpty()) {
            return ' Email notifikasi tidak dikirim karena penerima yang dipilih belum memiliki email valid.';
        }

        try {
            foreach ($recipients as $recipient) {
                Mail::to($recipient['person']->email)->send(
                    new PermohonanNonLitigasiAssignedMail(
                        $permohonanNonLitigasi,
                        $recipient['person']->name,
                        $recipient['role']
                    )
                );
            }
        } catch (\Throwable $exception) {
            Log::warning('Gagal mengirim email penugasan permohonan non-litigasi.', [
                'permohonan_non_litigasi_id' => $permohonanNonLitigasi->id,
                'error' => $exception->getMessage(),
            ]);

            return ' Namun email notifikasi gagal dikirim. Silakan periksa konfigurasi email.';
        }

        return ' Email notifikasi telah dikirim ke penerima yang dipilih.';
    }

    private function notifyAdmins(PermohonanNonLitigasi $permohonanNonLitigasi): void
    {
        $admins = User::where('role', 'admin')
            ->whereNotNull('email')
            ->where('email', '!=', '')
            ->get()
            ->filter(fn ($u) => filter_var($u->email, FILTER_VALIDATE_EMAIL));

        if ($admins->isEmpty()) {
            return;
        }

        foreach ($admins as $admin) {
            try {
                Mail::to($admin->email)->send(new PermohonanNonLitigasiSubmittedMail($permohonanNonLitigasi));
            } catch (\Throwable $exception) {
                Log::warning('Gagal mengirim email notifikasi permohonan non-litigasi baru.', [
                    'permohonan_non_litigasi_id' => $permohonanNonLitigasi->id,
                    'recipient' => $admin->email,
                    'error' => $exception->getMessage(),
                ]);
            }
        }
    }

    /**
     * Complete permohonan and mark as DONE
     */
    public function completeForm(PermohonanNonLitigasi $permohonanNonLitigasi)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        if (!$permohonanNonLitigasi->canBeCompleted()) {
            return redirect()->back()->with('error', 'Permohonan harus dalam status ASSIGNED untuk diselesaikan.');
        }

        return view('permohonan.non_litigasi.complete', compact('permohonanNonLitigasi'));
    }

    public function storeComplete(Request $request, PermohonanNonLitigasi $permohonanNonLitigasi)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $validated = $request->validate([
            'activity_notes' => 'required|string|min:10',
        ], [
            'activity_notes.required' => 'Catatan aktivitas harus diisi',
            'activity_notes.min' => 'Catatan aktivitas minimal 10 karakter',
        ]);

        $permohonanNonLitigasi->complete($validated['activity_notes']);

        $this->notifyUser(
            $permohonanNonLitigasi->fresh('user'),
            'Selesai',
            'Permohonan non-litigasi Anda telah selesai diproses oleh tim kami. Terima kasih telah mempercayakan permohonan Anda kepada kami.',
            '#6366f1',
            'Catatan Aktivitas',
            $validated['activity_notes']
        );

        return redirect()->route('permohonan-non-litigasi.show', $permohonanNonLitigasi)
            ->with('success', 'Permohonan berhasil diselesaikan dan ditandai sebagai DONE.');
    }

    private function notifyUser(PermohonanNonLitigasi $permohonanNonLitigasi, string $statusLabel, string $pesan, string $headerColor = '#6366f1', string $catatanLabel = 'Catatan', ?string $catatanNilai = null): void
    {
        $email = $permohonanNonLitigasi->user?->email;

        if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return;
        }

        try {
            Mail::to($email)->send(new PermohonanNonLitigasiStatusMail(
                $permohonanNonLitigasi,
                $statusLabel,
                $pesan,
                $headerColor,
                $catatanLabel,
                $catatanNilai
            ));
        } catch (\Throwable $exception) {
            Log::warning('Gagal mengirim email status permohonan non-litigasi ke user.', [
                'permohonan_non_litigasi_id' => $permohonanNonLitigasi->id,
                'recipient' => $email,
                'error' => $exception->getMessage(),
            ]);
        }
    }
}
