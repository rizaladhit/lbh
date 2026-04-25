<?php

namespace App\Http\Controllers;

use App\Models\MediasiReport;
use Illuminate\Http\Request;

class MediasiReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $query = MediasiReport::with('user')->latest();
        if (auth()->user()->role !== 'admin') {
            $query->where('user_id', auth()->id());
        }
        $reports = $query->paginate(10);
        return view('mediasi_reports.index', compact('reports'));
    }

    public function create()
    {
        return view('mediasi_reports.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'obh' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'tgl_pelaksanaan' => 'required|date',
            'kasus' => 'required|string',
            'penerima_bantuan' => 'required|string|max:255',
            'jk_penerima' => 'required|in:L,P',
            'nama_mediator' => 'required|string|max:255',
            'checklist_data' => 'nullable|array'
        ]);

        $validated['user_id'] = auth()->id();
        $validated['kegiatan'] = 'MEDIASI';

        MediasiReport::create($validated);

        return redirect()->route('mediasi-reports.index')->with('success', 'Laporan Mediasi berhasil ditambahkan.');
    }

    public function show(MediasiReport $mediasiReport)
    {
        if (auth()->user()->role !== 'admin' && $mediasiReport->user_id !== auth()->id()) {
            abort(403);
        }
        return view('mediasi_reports.show', compact('mediasiReport'));
    }

    public function destroy(MediasiReport $mediasiReport)
    {
        if (auth()->user()->role !== 'admin' && $mediasiReport->user_id !== auth()->id()) {
            abort(403);
        }
        $mediasiReport->delete();
        return redirect()->route('mediasi-reports.index')->with('success', 'Laporan berhasil dihapus.');
    }
}
