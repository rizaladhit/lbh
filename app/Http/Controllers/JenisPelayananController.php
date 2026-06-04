<?php

namespace App\Http\Controllers;

use App\Models\JenisPelayanan;
use Illuminate\Http\Request;

class JenisPelayananController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:jenis_pelayanans,nama',
        ]);

        JenisPelayanan::create([
            'nama' => $request->nama,
        ]);

        return redirect()->route('settings.edit')->with('success', 'Jenis pelayanan baru berhasil ditambahkan.');
    }

    public function destroy(JenisPelayanan $jenisPelayanan)
    {
        $jenisPelayanan->delete();

        return redirect()->route('settings.edit')->with('success', 'Jenis pelayanan berhasil dihapus.');
    }
}
