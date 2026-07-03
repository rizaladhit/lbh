<?php

namespace App\Http\Controllers;

use App\Models\KeahlianSpesialisasi;
use Illuminate\Http\Request;

class KeahlianSpesialisasiController extends Controller
{
    private function authorizeAdmin()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
    }

    public function index()
    {
        $this->authorizeAdmin();
        $keahlians = KeahlianSpesialisasi::orderBy('nama')->get();
        return view('keahlian-spesialisasi.index', compact('keahlians'));
    }

    public function create()
    {
        $this->authorizeAdmin();
        return view('keahlian-spesialisasi.create');
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin();
        $request->validate([
            'nama' => 'required|string|max:255|unique:keahlian_spesialisasis,nama',
        ], [
            'nama.required' => 'Nama keahlian harus diisi.',
            'nama.unique' => 'Keahlian ini sudah terdaftar.',
        ]);

        KeahlianSpesialisasi::create($request->only('nama'));

        return redirect()->route('keahlian-spesialisasi.index')
            ->with('success', 'Keahlian/Spesialisasi berhasil ditambahkan.');
    }

    public function edit(KeahlianSpesialisasi $keahlianSpesialisasi)
    {
        $this->authorizeAdmin();
        return view('keahlian-spesialisasi.edit', compact('keahlianSpesialisasi'));
    }

    public function update(Request $request, KeahlianSpesialisasi $keahlianSpesialisasi)
    {
        $this->authorizeAdmin();
        $request->validate([
            'nama' => 'required|string|max:255|unique:keahlian_spesialisasis,nama,' . $keahlianSpesialisasi->id,
        ], [
            'nama.required' => 'Nama keahlian harus diisi.',
            'nama.unique' => 'Keahlian ini sudah terdaftar.',
        ]);

        $keahlianSpesialisasi->update($request->only('nama'));

        return redirect()->route('keahlian-spesialisasi.index')
            ->with('success', 'Keahlian/Spesialisasi berhasil diperbarui.');
    }

    public function destroy(KeahlianSpesialisasi $keahlianSpesialisasi)
    {
        $this->authorizeAdmin();
        $keahlianSpesialisasi->delete();

        return redirect()->route('keahlian-spesialisasi.index')
            ->with('success', 'Keahlian/Spesialisasi berhasil dihapus.');
    }
}
