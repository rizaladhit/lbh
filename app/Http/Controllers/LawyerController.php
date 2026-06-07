<?php

namespace App\Http\Controllers;

use App\Models\Lawyer;
use Illuminate\Http\Request;

class LawyerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lawyers = Lawyer::latest()->paginate(15);
        return view('lawyers.index', compact('lawyers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = \App\Models\User::where('role', 'pengacara')->get();
        return view('lawyers.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:lawyers,email',
            'phone' => 'required|string|max:20',
            'no_identitas' => 'required|string|unique:lawyers,no_identitas|max:50',
            'specialization' => 'required|string|max:255',
            'address' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'notes' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
        ], [
            'name.required' => 'Nama Advocate harus diisi (pilih akun Advocate)',
            'email.required' => 'Email harus diisi',
            'email.unique' => 'Email sudah terdaftar sebagai Advocate',
            'phone.required' => 'Nomor telepon harus diisi',
            'no_identitas.required' => 'Nomor identitas (SIU) harus diisi',
            'no_identitas.unique' => 'Nomor identitas sudah terdaftar',
            'specialization.required' => 'Keahlian harus diisi',
            'user_id.required' => 'Harap pilih Akun Advocate',
        ]);

        Lawyer::create($validated);

        return redirect()->route('lawyers.index')->with('success', 'Data Advocate berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lawyer $lawyer)
    {
        return view('lawyers.show', compact('lawyer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lawyer $lawyer)
    {
        $users = \App\Models\User::where('role', 'pengacara')->get();
        return view('lawyers.edit', compact('lawyer', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lawyer $lawyer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:lawyers,email,' . $lawyer->id,
            'phone' => 'required|string|max:20',
            'no_identitas' => 'required|string|unique:lawyers,no_identitas,' . $lawyer->id . '|max:50',
            'specialization' => 'required|string|max:255',
            'address' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'notes' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
        ], [
            'name.required' => 'Nama Advocate harus diisi (pilih akun Advocate)',
            'email.required' => 'Email harus diisi',
            'email.unique' => 'Email sudah terdaftar sebagai Advocate',
            'phone.required' => 'Nomor telepon harus diisi',
            'no_identitas.required' => 'Nomor identitas (SIU) harus diisi',
            'no_identitas.unique' => 'Nomor identitas sudah terdaftar',
            'specialization.required' => 'Keahlian harus diisi',
            'user_id.required' => 'Harap pilih Akun Advocate',
        ]);

        $lawyer->update($validated);

        return redirect()->route('lawyers.show', $lawyer)->with('success', 'Data Advocate berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lawyer $lawyer)
    {
        // Check if lawyer is assigned to any active permohonan
        $assigned = $lawyer->permohonanLitigasiAsLawyer()->count() + $lawyer->permohonanNonLitigasiAsLawyer()->count();
        
        if ($assigned > 0) {
            return redirect()->back()->with('error', 'Tidak dapat menghapus Advocate yang masih memiliki penugasan aktif.');
        }

        $lawyer->delete();
        return redirect()->route('lawyers.index')->with('success', 'Data Advocate berhasil dihapus.');
    }
}
