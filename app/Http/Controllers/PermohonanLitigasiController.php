<?php

namespace App\Http\Controllers;

use App\Models\PermohonanLitigasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PermohonanLitigasiController extends Controller
{
    public function index(Request $request)
    {
        // Base query scoped to current user (non-admin only sees own records)
        $baseQuery = PermohonanLitigasi::query();
        if (auth()->user()->role === 'pengacara') {
            $lawyerId = auth()->user()->lawyer?->id;
            $baseQuery->where(function($q) use ($lawyerId) {
                $q->where('assigned_lawyer_id', $lawyerId)
                  ->orWhere('assigned_paralegal_id', $lawyerId);
            });
        } elseif (auth()->user()->role !== 'admin') {
            $baseQuery->where('user_id', auth()->id());
        }

        // Accurate counts per status (always unfiltered)
        $statusCounts = (clone $baseQuery)->selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();
        $totalAll = array_sum($statusCounts);

        // Filtered query for table
        $query = (clone $baseQuery)->with('user')->latest();
        if ($request->filled('status') && in_array($request->status, ['REGISTERED', 'APPROVED', 'VERIFIED', 'ASSIGNED', 'DONE', 'REJECTED'])) {
            $query->where('status', $request->status);
        }
        $permohonan = $query->paginate(15)->withQueryString();

        return view('permohonan.litigasi.index', compact('permohonan', 'statusCounts', 'totalAll'));
    }

    public function create()
    {
        if (auth()->user()->role === 'pengacara') {
            abort(403, 'Akses ditolak. Advocate hanya memiliki akses baca.');
        }
        return view('permohonan.litigasi.create');
    }

    public function edit(PermohonanLitigasi $permohonanLitigasi)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        return view('permohonan.litigasi.edit', compact('permohonanLitigasi'));
    }

    public function update(Request $request, PermohonanLitigasi $permohonanLitigasi)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telp_hp' => 'required|string|max:20',
            'nik' => 'required|string|size:16',
            'jenis_perkara' => 'required|string|max:255',
            'no_perkara' => 'required|string|max:100',
            'tgl_rencana_kunjungan' => 'required|date',
            'uraian_singkat' => 'required|string',
            'file_ktp_kk' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_sktm' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_ttd' => 'nullable|string',
        ]);

        if ($request->hasFile('file_ktp_kk')) {
            Storage::disk('public')->delete($permohonanLitigasi->file_ktp_kk);
            $validated['file_ktp_kk'] = $request->file('file_ktp_kk')->store('permohonan/ktp_kk', 'public');
        } else {
            unset($validated['file_ktp_kk']);
        }

        if ($request->hasFile('file_sktm')) {
            Storage::disk('public')->delete($permohonanLitigasi->file_sktm);
            $validated['file_sktm'] = $request->file('file_sktm')->store('permohonan/sktm', 'public');
        } else {
            unset($validated['file_sktm']);
        }

        $ttdData = $request->input('file_ttd');
        if ($ttdData && str_starts_with($ttdData, 'data:image')) {
            Storage::disk('public')->delete($permohonanLitigasi->file_ttd);
            $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $ttdData));
            $filename = 'permohonan/ttd/ttd_' . time() . '.png';
            Storage::disk('public')->put($filename, $imageData);
            $validated['file_ttd'] = $filename;
        } else {
            unset($validated['file_ttd']);
        }

        $permohonanLitigasi->update($validated);

        return redirect()->route('permohonan-litigasi.show', $permohonanLitigasi)
            ->with('success', 'Permohonan berhasil diperbarui.');
    }

    public function store(Request $request)
    {
        if (auth()->user()->role === 'pengacara') {
            abort(403);
        }
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telp_hp' => 'required|string|max:20',
            'nik' => 'required|string|size:16',
            'jenis_perkara' => 'required|string|max:255',
            'tgl_rencana_kunjungan' => 'required|date',
            'uraian_singkat' => 'required|string',
            'file_ktp_kk' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_sktm' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_ttd' => 'required|string|starts_with:data:image',
        ]);

        $validated['file_ktp_kk'] = $request->file('file_ktp_kk')->store('permohonan/ktp_kk', 'public');
        if ($request->hasFile('file_sktm')) {
            $validated['file_sktm'] = $request->file('file_sktm')->store('permohonan/sktm', 'public');
        }

        // Handle signature: convert canvas dataURL to PNG file
        $ttdData = $request->input('file_ttd');
        if ($ttdData && str_starts_with($ttdData, 'data:image')) {
            $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $ttdData));
            $filename = 'permohonan/ttd/ttd_' . time() . '.png';
            Storage::disk('public')->put($filename, $imageData);
            $validated['file_ttd'] = $filename;
        } else {
            unset($validated['file_ttd']);
        }

        // No nomor perkara is generated at creation; admin will fill it later.
        $validated['no_perkara'] = '';

        auth()->user()->permohonanLitigasi()->create($validated);

        return redirect()->route('permohonan-litigasi.index')->with('success', 'Form Permohonan Litigasi berhasil dikirim.');
    }

    public function show(PermohonanLitigasi $permohonanLitigasi)
    {
        $user = auth()->user();
        $isOwner = $permohonanLitigasi->user_id == $user->id;
        $isAssigned = $user->role === 'pengacara' && $user->lawyer && 
                      ($permohonanLitigasi->assigned_lawyer_id == $user->lawyer->id || 
                       $permohonanLitigasi->assigned_paralegal_id == $user->lawyer->id);

        if ($user->role !== 'admin' && !$isOwner && !$isAssigned) {
            abort(403);
        }
        return view('permohonan.litigasi.show', compact('permohonanLitigasi'));
    }

    public function printForm(PermohonanLitigasi $permohonanLitigasi)
    {
        $user = auth()->user();
        $isOwner = $permohonanLitigasi->user_id == $user->id;
        $isAssigned = $user->role === 'pengacara' && $user->lawyer &&
                      ($permohonanLitigasi->assigned_lawyer_id == $user->lawyer->id ||
                       $permohonanLitigasi->assigned_paralegal_id == $user->lawyer->id);

        if ($user->role !== 'admin' && !$isOwner && !$isAssigned) {
            abort(403);
        }

        return view('permohonan.litigasi.print', compact('permohonanLitigasi'));
    }

    public function destroy(PermohonanLitigasi $permohonanLitigasi)
    {
        if (auth()->user()->role !== 'admin' && $permohonanLitigasi->user_id != auth()->id()) {
            abort(403);
        }
        Storage::disk('public')->delete([$permohonanLitigasi->file_ktp_kk, $permohonanLitigasi->file_sktm, $permohonanLitigasi->file_ttd]);
        $permohonanLitigasi->delete();
        return redirect()->route('permohonan-litigasi.index')->with('success', 'Data permohonan berhasil dihapus.');
    }

    /**
     * Verify permohonan by admin
     */
    public function approve(PermohonanLitigasi $permohonanLitigasi)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        if (!$permohonanLitigasi->canBeApproved()) {
            return redirect()->back()->with('error', 'Permohonan tidak dapat disetujui pada status saat ini.');
        }

        return view('permohonan.litigasi.approve', compact('permohonanLitigasi'));
    }

    public function storeApprove(Request $request, PermohonanLitigasi $permohonanLitigasi)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $validated = $request->validate([
            'verification_notes' => 'nullable|string|min:10',
        ], [
            'verification_notes.min' => 'Catatan persetujuan minimal 10 karakter',
        ]);

        $permohonanLitigasi->approve($validated['verification_notes'] ?? null);

        return redirect()->route('permohonan-litigasi.show', $permohonanLitigasi)
            ->with('success', 'Permohonan berhasil disetujui dan siap diverifikasi.');
    }

    public function reject(PermohonanLitigasi $permohonanLitigasi)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        if (!$permohonanLitigasi->canBeRejected()) {
            return redirect()->back()->with('error', 'Permohonan tidak dapat ditolak pada status saat ini.');
        }

        return view('permohonan.litigasi.reject', compact('permohonanLitigasi'));
    }

    public function storeReject(Request $request, PermohonanLitigasi $permohonanLitigasi)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $validated = $request->validate([
            'verification_notes' => 'nullable|string|min:10',
        ], [
            'verification_notes.min' => 'Catatan penolakan minimal 10 karakter',
        ]);

        $permohonanLitigasi->reject($validated['verification_notes'] ?? null);

        return redirect()->route('permohonan-litigasi.show', $permohonanLitigasi)
            ->with('success', 'Permohonan berhasil ditolak dan tidak dapat dilanjutkan.');
    }

    public function verify(PermohonanLitigasi $permohonanLitigasi)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        if (!$permohonanLitigasi->canBeVerified()) {
            return redirect()->back()->with('error', 'Permohonan tidak dapat diverifikasi pada status saat ini.');
        }

        return view('permohonan.litigasi.verify', compact('permohonanLitigasi'));
    }

    public function storeVerify(Request $request, PermohonanLitigasi $permohonanLitigasi)
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

        $permohonanLitigasi->verify($validated['verification_notes']);

        return redirect()->route('permohonan-litigasi.show', $permohonanLitigasi)
            ->with('success', 'Permohonan berhasil diverifikasi.');
    }

    /**
     * Assign permohonan to lawyer/paralegal
     */
    public function assignForm(PermohonanLitigasi $permohonanLitigasi)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        if (!$permohonanLitigasi->canBeAssigned()) {
            return redirect()->back()->with('error', 'Permohonan harus dalam status VERIFIED untuk ditugaskan.');
        }

        $lawyers = \App\Models\Lawyer::active()->latest('name')->get();
        
        return view('permohonan.litigasi.assign', compact('permohonanLitigasi', 'lawyers'));
    }

    public function storeAssign(Request $request, PermohonanLitigasi $permohonanLitigasi)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $validated = $request->validate([
            'assigned_lawyer_id' => 'nullable|exists:lawyers,id',
            'assigned_paralegal_id' => 'nullable|exists:lawyers,id',
        ], [
            'assigned_lawyer_id.exists' => 'Advocate yang dipilih tidak valid',
            'assigned_paralegal_id.exists' => 'Paralegal yang dipilih tidak valid',
        ]);

        if (!$validated['assigned_lawyer_id'] && !$validated['assigned_paralegal_id']) {
            return redirect()->back()->with('error', 'Pilih minimal satu advocate atau paralegal.');
        }

        $permohonanLitigasi->assign(
            $validated['assigned_lawyer_id'],
            $validated['assigned_paralegal_id']
        );

        return redirect()->route('permohonan-litigasi.show', $permohonanLitigasi)
            ->with('success', 'Permohonan berhasil ditugaskan.');
    }

    /**
     * Complete permohonan and mark as DONE
     */
    public function completeForm(PermohonanLitigasi $permohonanLitigasi)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        if (!$permohonanLitigasi->canBeCompleted()) {
            return redirect()->back()->with('error', 'Permohonan harus dalam status ASSIGNED untuk diselesaikan.');
        }

        return view('permohonan.litigasi.complete', compact('permohonanLitigasi'));
    }

    public function storeComplete(Request $request, PermohonanLitigasi $permohonanLitigasi)
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

        $permohonanLitigasi->complete($validated['activity_notes']);

        return redirect()->route('permohonan-litigasi.show', $permohonanLitigasi)
            ->with('success', 'Permohonan berhasil diselesaikan dan ditandai sebagai DONE.');
    }
}
