<?php

namespace App\Http\Controllers;

use App\Models\Paralegal;
use App\Models\User;
use Illuminate\Http\Request;

class ParalegalController extends Controller
{
    public function index()
    {
        $paralegals = Paralegal::latest()->paginate(15);
        return view('paralegals.index', compact('paralegals'));
    }

    public function create()
    {
        $users = User::where('role', 'paralegal')->get();
        return view('paralegals.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:paralegals,email',
            'phone' => 'required|string|max:20',
            'no_identitas' => 'required|string|unique:paralegals,no_identitas|max:50',
            'specialization' => 'required|string|max:255',
            'address' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'notes' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
        ], [
            'name.required' => 'Nama Paralegal harus diisi (pilih akun Paralegal)',
            'email.required' => 'Email harus diisi',
            'email.unique' => 'Email sudah terdaftar sebagai Paralegal',
            'phone.required' => 'Nomor telepon harus diisi',
            'no_identitas.required' => 'Nomor identitas harus diisi',
            'no_identitas.unique' => 'Nomor identitas sudah terdaftar',
            'specialization.required' => 'Keahlian harus diisi',
            'user_id.required' => 'Harap pilih Akun Paralegal',
        ]);

        Paralegal::create($validated);

        return redirect()->route('paralegals.index')->with('success', 'Data Paralegal berhasil ditambahkan.');
    }

    public function show(Paralegal $paralegal)
    {
        return view('paralegals.show', compact('paralegal'));
    }

    public function edit(Paralegal $paralegal)
    {
        $users = User::where('role', 'paralegal')->get();
        return view('paralegals.edit', compact('paralegal', 'users'));
    }

    public function update(Request $request, Paralegal $paralegal)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:paralegals,email,' . $paralegal->id,
            'phone' => 'required|string|max:20',
            'no_identitas' => 'required|string|unique:paralegals,no_identitas,' . $paralegal->id . '|max:50',
            'specialization' => 'required|string|max:255',
            'address' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'notes' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
        ], [
            'name.required' => 'Nama Paralegal harus diisi (pilih akun Paralegal)',
            'email.required' => 'Email harus diisi',
            'email.unique' => 'Email sudah terdaftar sebagai Paralegal',
            'phone.required' => 'Nomor telepon harus diisi',
            'no_identitas.required' => 'Nomor identitas harus diisi',
            'no_identitas.unique' => 'Nomor identitas sudah terdaftar',
            'specialization.required' => 'Keahlian harus diisi',
            'user_id.required' => 'Harap pilih Akun Paralegal',
        ]);

        $paralegal->update($validated);

        return redirect()->route('paralegals.show', $paralegal)->with('success', 'Data Paralegal berhasil diperbarui.');
    }

    public function destroy(Paralegal $paralegal)
    {
        $assigned = $paralegal->permohonanLitigasi()->count() + $paralegal->permohonanNonLitigasi()->count();

        if ($assigned > 0) {
            return redirect()->back()->with('error', 'Tidak dapat menghapus Paralegal yang masih memiliki penugasan aktif.');
        }

        $paralegal->delete();

        return redirect()->route('paralegals.index')->with('success', 'Data Paralegal berhasil dihapus.');
    }
}
