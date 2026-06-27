<?php

namespace App\Http\Controllers;

use App\Models\DraftingDokumenHukumReport;
use Illuminate\Http\Request;

class DraftingDokumenHukumReportController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (auth()->check() && auth()->user()->role !== 'admin') {
                abort(403, 'Unauthorized. Only admin can access this report.');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $reports = DraftingDokumenHukumReport::latest()->paginate(10);
        return view('bphn_reports.index', compact('reports'));
    }

    public function create()
    {
        return view('bphn_reports.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'obh' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kegiatan' => 'required|string|max:255',
            'tgl_pelaksanaan' => 'required|date',
            'kasus' => 'required|string',
            'penerima_bantuan' => 'required|string|max:255',
            'jk_penerima' => 'required|in:L,P',
            'nama_drafter' => 'required|string|max:255',
            'checklist_data' => 'nullable|array'
        ]);

        DraftingDokumenHukumReport::create($validated);

        return redirect()->route('drafting-reports.index')->with('success', 'Laporan Drafting Dokumen Hukum berhasil ditambahkan.');
    }

    public function show(DraftingDokumenHukumReport $draftingReport)
    {
        return view('bphn_reports.show', compact('draftingReport'));
    }

    public function edit(DraftingDokumenHukumReport $draftingReport)
    {
        return view('bphn_reports.edit', compact('draftingReport'));
    }

    public function update(Request $request, DraftingDokumenHukumReport $draftingReport)
    {
        $validated = $request->validate([
            'obh' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kegiatan' => 'required|string|max:255',
            'tgl_pelaksanaan' => 'required|date',
            'kasus' => 'required|string',
            'penerima_bantuan' => 'required|string|max:255',
            'jk_penerima' => 'required|in:L,P',
            'nama_drafter' => 'required|string|max:255',
            'checklist_data' => 'nullable|array'
        ]);
        $draftingReport->update($validated);
        return redirect()->route('drafting-reports.show', $draftingReport)->with('success', 'Laporan berhasil diperbarui.');
    }

    public function destroy(DraftingDokumenHukumReport $draftingReport)
    {
        $draftingReport->delete();
        return redirect()->route('drafting-reports.index')->with('success', 'Laporan berhasil dihapus.');
    }
}
