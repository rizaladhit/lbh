<?php

namespace App\Http\Controllers;

use App\Models\StatusPerkara;
use Illuminate\Http\Request;

class StatusPerkaraController extends Controller
{
    private function authorizeAdmin(): void
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak. Hanya admin yang dapat melakukan tindakan ini.');
        }
    }

    public function index()
    {
        $this->authorizeAdmin();

        $statusPerkaras = StatusPerkara::orderBy('urutan')->get();

        return view('status-perkara.index', compact('statusPerkaras'));
    }

    public function create()
    {
        $this->authorizeAdmin();

        return view('status-perkara.create');
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $v = $request->validate([
            'nama'     => 'required|string|max:100|unique:status_perkaras,nama',
            'is_final' => 'boolean',
            'warna'    => 'required|string|max:50',
            'urutan'   => 'required|integer|min:0',
        ]);

        $v['is_final'] = $request->boolean('is_final');

        StatusPerkara::create($v);

        return redirect()->route('status-perkara.index')
            ->with('success', 'Status Perkara berhasil ditambahkan.');
    }

    public function edit(StatusPerkara $statusPerkara)
    {
        $this->authorizeAdmin();

        return view('status-perkara.edit', compact('statusPerkara'));
    }

    public function update(Request $request, StatusPerkara $statusPerkara)
    {
        $this->authorizeAdmin();

        $v = $request->validate([
            'nama'     => 'required|string|max:100|unique:status_perkaras,nama,' . $statusPerkara->id,
            'is_final' => 'boolean',
            'warna'    => 'required|string|max:50',
            'urutan'   => 'required|integer|min:0',
        ]);

        $v['is_final'] = $request->boolean('is_final');

        $statusPerkara->update($v);

        return redirect()->route('status-perkara.index')
            ->with('success', 'Status Perkara berhasil diperbarui.');
    }

    public function destroy(StatusPerkara $statusPerkara)
    {
        $this->authorizeAdmin();

        if ($statusPerkara->simbakums()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Tidak dapat menghapus status yang masih digunakan.');
        }

        $statusPerkara->delete();

        return redirect()->route('status-perkara.index')
            ->with('success', 'Status Perkara berhasil dihapus.');
    }
}
