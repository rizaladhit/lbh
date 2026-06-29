<?php

namespace App\Http\Controllers;

use App\Models\Simbakum;
use App\Models\SimbakumDokumen;
use App\Models\StatusPerkara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SimbakumController extends Controller
{
    /**
     * Check if current user is allowed to view SIMBAKUM (admin/pengacara/paralegal).
     */
    private function authorizeView(): void
    {
        $role = auth()->user()->role ?? '';
        if (!in_array($role, ['admin', 'pengacara', 'paralegal'])) {
            abort(403, 'Akses ditolak.');
        }
    }

    /**
     * Check if current user is admin.
     */
    private function authorizeAdmin(): void
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak. Hanya admin yang dapat melakukan tindakan ini.');
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorizeView();

        $simbakums = Simbakum::with('dokumens')->latest()->paginate(15);

        return view('simbakum.index', compact('simbakums'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorizeAdmin();

        $statusPerkaras = StatusPerkara::orderBy('urutan')->get();

        return view('simbakum.create', compact('statusPerkaras'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'no_perkara'          => 'required|string|max:100|unique:simbakums,no_perkara',
            'tanggal_register'    => 'required|date',
            'klasifikasi_perkara' => 'required|string|max:255',
            'terdakwa'            => 'required|string|max:255',
            'penuntut_umum'       => 'required|string|max:255',
            'advokat_pendamping'  => 'required|string|max:255',
            'status_perkara_id'   => 'required|exists:status_perkaras,id',
            'nama_dokumen'        => 'nullable|array',
            'nama_dokumen.*'      => 'nullable|string|max:255',
            'file'                => 'nullable|array',
            'file.*'              => 'nullable|file|mimes:pdf|max:10240',
        ]);

        // Auto-set tanggal_selesai when status is_final
        $status = StatusPerkara::findOrFail($validated['status_perkara_id']);
        $tanggalSelesai = null;
        if ($status->is_final) {
            $tanggalSelesai = now()->toDateString();
        }

        $simbakum = Simbakum::create([
            'no_perkara'          => $validated['no_perkara'],
            'tanggal_register'    => $validated['tanggal_register'],
            'klasifikasi_perkara' => $validated['klasifikasi_perkara'],
            'terdakwa'            => $validated['terdakwa'],
            'penuntut_umum'       => $validated['penuntut_umum'],
            'advokat_pendamping'  => $validated['advokat_pendamping'],
            'status_perkara_id'   => $validated['status_perkara_id'],
            'tanggal_selesai'     => $tanggalSelesai,
        ]);

        // Handle document uploads
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $index => $file) {
                if ($file && $file->isValid()) {
                    $namaDokumen = $request->input("nama_dokumen.{$index}") ?? $file->getClientOriginalName();
                    $uniqueName  = time() . '_' . $index . '_' . $file->getClientOriginalName();
                    $filePath    = Storage::putFileAs('public/simbakum', $file, $uniqueName);
                    // filePath stored as relative path without 'public/' prefix
                    $relativePath = 'simbakum/' . $uniqueName;

                    SimbakumDokumen::create([
                        'simbakum_id'  => $simbakum->id,
                        'nama_dokumen' => $namaDokumen,
                        'file_path'    => $relativePath,
                    ]);
                }
            }
        }

        return redirect()->route('simbakum.index')
            ->with('success', 'Data SIMBAKUM berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Simbakum $simbakum)
    {
        $this->authorizeView();

        $simbakum->load('dokumens');

        return view('simbakum.show', compact('simbakum'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Simbakum $simbakum)
    {
        $this->authorizeAdmin();

        $simbakum->load('dokumens');
        $statusPerkaras = StatusPerkara::orderBy('urutan')->get();

        return view('simbakum.edit', compact('simbakum', 'statusPerkaras'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Simbakum $simbakum)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'no_perkara'          => 'required|string|max:100|unique:simbakums,no_perkara,' . $simbakum->id,
            'tanggal_register'    => 'required|date',
            'klasifikasi_perkara' => 'required|string|max:255',
            'terdakwa'            => 'required|string|max:255',
            'penuntut_umum'       => 'required|string|max:255',
            'advokat_pendamping'  => 'required|string|max:255',
            'status_perkara_id'   => 'required|exists:status_perkaras,id',
            'new_nama_dokumen'    => 'nullable|array',
            'new_nama_dokumen.*'  => 'nullable|string|max:255',
            'new_file'            => 'nullable|array',
            'new_file.*'          => 'nullable|file|mimes:pdf|max:10240',
        ]);

        // Handle tanggal_selesai logic
        $status = StatusPerkara::findOrFail($validated['status_perkara_id']);
        $tanggalSelesai = $simbakum->tanggal_selesai?->toDateString();

        if ($status->is_final && !$tanggalSelesai) {
            $tanggalSelesai = now()->toDateString();
        } elseif (!$status->is_final) {
            $tanggalSelesai = null;
        }

        $simbakum->update([
            'no_perkara'          => $validated['no_perkara'],
            'tanggal_register'    => $validated['tanggal_register'],
            'klasifikasi_perkara' => $validated['klasifikasi_perkara'],
            'terdakwa'            => $validated['terdakwa'],
            'penuntut_umum'       => $validated['penuntut_umum'],
            'advokat_pendamping'  => $validated['advokat_pendamping'],
            'status_perkara_id'   => $validated['status_perkara_id'],
            'tanggal_selesai'     => $tanggalSelesai,
        ]);

        // Handle new document uploads only
        if ($request->hasFile('new_file')) {
            foreach ($request->file('new_file') as $index => $file) {
                if ($file && $file->isValid()) {
                    $namaDokumen  = $request->input("new_nama_dokumen.{$index}") ?? $file->getClientOriginalName();
                    $uniqueName   = time() . '_' . $index . '_' . $file->getClientOriginalName();
                    Storage::putFileAs('public/simbakum', $file, $uniqueName);
                    $relativePath = 'simbakum/' . $uniqueName;

                    SimbakumDokumen::create([
                        'simbakum_id'  => $simbakum->id,
                        'nama_dokumen' => $namaDokumen,
                        'file_path'    => $relativePath,
                    ]);
                }
            }
        }

        return redirect()->route('simbakum.show', $simbakum)
            ->with('success', 'Data SIMBAKUM berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Simbakum $simbakum)
    {
        $this->authorizeAdmin();

        // Delete all associated document files
        foreach ($simbakum->dokumens as $dokumen) {
            Storage::delete('public/' . $dokumen->file_path);
        }

        $simbakum->delete();

        return redirect()->route('simbakum.index')
            ->with('success', 'Data SIMBAKUM berhasil dihapus.');
    }

    /**
     * Upload new documents from the show page.
     */
    public function uploadDokumen(Request $request, Simbakum $simbakum)
    {
        $this->authorizeAdmin();

        $request->validate([
            'new_nama_dokumen'   => 'required|array|min:1',
            'new_nama_dokumen.*' => 'nullable|string|max:255',
            'new_file'           => 'required|array|min:1',
            'new_file.*'         => 'required|file|mimes:pdf|max:10240',
        ]);

        if ($request->hasFile('new_file')) {
            foreach ($request->file('new_file') as $index => $file) {
                if ($file && $file->isValid()) {
                    $namaDokumen  = $request->input("new_nama_dokumen.{$index}") ?? $file->getClientOriginalName();
                    $uniqueName   = time() . '_' . $index . '_' . $file->getClientOriginalName();
                    Storage::putFileAs('public/simbakum', $file, $uniqueName);
                    $relativePath = 'simbakum/' . $uniqueName;

                    SimbakumDokumen::create([
                        'simbakum_id'  => $simbakum->id,
                        'nama_dokumen' => $namaDokumen,
                        'file_path'    => $relativePath,
                    ]);
                }
            }
        }

        return redirect()->route('simbakum.show', $simbakum)
            ->with('success', 'Dokumen berhasil diunggah.');
    }

    /**
     * Delete a single document (AJAX).
     */
    public function destroyDokumen(SimbakumDokumen $dokumen)
    {
        $this->authorizeAdmin();

        Storage::delete('public/' . $dokumen->file_path);
        $dokumen->delete();

        return response()->json(['success' => true]);
    }
}
