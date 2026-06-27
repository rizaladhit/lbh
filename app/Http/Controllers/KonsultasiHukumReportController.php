<?php

namespace App\Http\Controllers;

use App\Models\KonsultasiHukumReport;
use Illuminate\Http\Request;

class KonsultasiHukumReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (auth()->user()->role !== 'admin') {
                abort(403, 'Unauthorized. Only admin can access Laporan Konsultasi Hukum.');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $reports = KonsultasiHukumReport::latest()->paginate(10);
        return view('konsultasi_hukum_reports.index', compact('reports'));
    }

    public function create()
    {
        return view('konsultasi_hukum_reports.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'obh'      => 'required|string|max:255',
            'alamat'   => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'sections' => 'nullable|array',
        ]);

        $validated['kegiatan'] = 'KONSULTASI HUKUM';
        $validated['user_id']  = auth()->id();
        $validated['status']   = KonsultasiHukumReport::STATUS_DRAFT;
        $validated['sections'] = $request->input('sections', []);

        KonsultasiHukumReport::create($validated);

        return redirect()->route('konsultasi-hukum-reports.index')
            ->with('success', 'Laporan Konsultasi Hukum berhasil ditambahkan.');
    }

    public function show(KonsultasiHukumReport $konsultasiHukumReport)
    {
        return view('konsultasi_hukum_reports.show', compact('konsultasiHukumReport'));
    }

    public function edit(KonsultasiHukumReport $konsultasiHukumReport)
    {
        return view('konsultasi_hukum_reports.edit', compact('konsultasiHukumReport'));
    }

    public function update(Request $request, KonsultasiHukumReport $konsultasiHukumReport)
    {
        $validated = $request->validate([
            'obh'      => 'required|string|max:255',
            'alamat'   => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'sections' => 'nullable|array',
        ]);
        $validated['kegiatan'] = 'KONSULTASI HUKUM';
        $validated['sections'] = $request->input('sections', []);
        $konsultasiHukumReport->update($validated);
        return redirect()->route('konsultasi-hukum-reports.show', $konsultasiHukumReport)->with('success', 'Laporan berhasil diperbarui.');
    }

    public function destroy(KonsultasiHukumReport $konsultasiHukumReport)
    {
        $konsultasiHukumReport->delete();
        return redirect()->route('konsultasi-hukum-reports.index')
            ->with('success', 'Laporan berhasil dihapus.');
    }
}
