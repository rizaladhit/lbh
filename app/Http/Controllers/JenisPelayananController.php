<?php

namespace App\Http\Controllers;

use App\Models\JenisPelayanan;
use Illuminate\Http\Request;

class JenisPelayananController extends Controller
{
    private function authorizeAdmin(): void
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }
    }

    public function index()
    {
        $this->authorizeAdmin();
        $jenisPelayanans = JenisPelayanan::orderBy('nama')->get();
        return view('jenis-pelayanan.index', compact('jenisPelayanans'));
    }

    public function create()
    {
        $this->authorizeAdmin();
        return view('jenis-pelayanan.create');
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $request->validate([
            'nama' => 'required|string|max:255|unique:jenis_pelayanans,nama',
        ]);

        JenisPelayanan::create(['nama' => $request->nama]);

        return redirect()->route('jenis-pelayanan.index')
            ->with('success', 'Jenis pelayanan berhasil ditambahkan.');
    }

    public function edit(JenisPelayanan $jenisPelayanan)
    {
        $this->authorizeAdmin();
        return view('jenis-pelayanan.edit', compact('jenisPelayanan'));
    }

    public function update(Request $request, JenisPelayanan $jenisPelayanan)
    {
        $this->authorizeAdmin();

        $request->validate([
            'nama' => 'required|string|max:255|unique:jenis_pelayanans,nama,' . $jenisPelayanan->id,
        ]);

        $jenisPelayanan->update(['nama' => $request->nama]);

        return redirect()->route('jenis-pelayanan.index')
            ->with('success', 'Jenis pelayanan berhasil diperbarui.');
    }

    public function destroy(JenisPelayanan $jenisPelayanan)
    {
        $this->authorizeAdmin();
        $jenisPelayanan->delete();

        return redirect()->route('jenis-pelayanan.index')
            ->with('success', 'Jenis pelayanan berhasil dihapus.');
    }
}
