<?php

namespace App\Http\Controllers;

use App\Models\PerdataReport;
use Illuminate\Http\Request;

class PerdataReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (auth()->user()->role !== 'admin') {
                abort(403, 'Unauthorized. Only admin can access Laporan Perdata.');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $reports = PerdataReport::latest()->paginate(10);
        return view('perdata_reports.index', compact('reports'));
    }

    public function create()
    {
        return view('perdata_reports.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'obh'              => 'required|string|max:255',
            'alamat'           => 'required|string|max:255',
            'provinsi'         => 'required|string|max:255',
            'kasus'            => 'nullable|string|max:255',
            'nomor_perkara'    => 'nullable|string|max:255',
            'penerima_bantuan' => 'nullable|string|max:255',
            'jk_penerima'      => 'nullable|in:L,P',
            'checklist_data'   => 'nullable|array',
        ]);

        $validated['perkara'] = 'Perdata';
        $validated['user_id'] = auth()->id();
        $validated['status']  = PerdataReport::STATUS_DRAFT;

        PerdataReport::create($validated);

        return redirect()->route('perdata-reports.index')
            ->with('success', 'Laporan Perdata berhasil ditambahkan.');
    }

    public function show(PerdataReport $perdataReport)
    {
        return view('perdata_reports.show', compact('perdataReport'));
    }

    public function edit(PerdataReport $perdataReport)
    {
        return view('perdata_reports.edit', compact('perdataReport'));
    }

    public function update(Request $request, PerdataReport $perdataReport)
    {
        $validated = $request->validate([
            'obh'              => 'required|string|max:255',
            'alamat'           => 'required|string|max:255',
            'provinsi'         => 'required|string|max:255',
            'kasus'            => 'nullable|string|max:255',
            'nomor_perkara'    => 'nullable|string|max:255',
            'penerima_bantuan' => 'nullable|string|max:255',
            'jk_penerima'      => 'nullable|in:L,P',
            'checklist_data'   => 'nullable|array',
        ]);
        $validated['perkara'] = 'Perdata';
        $perdataReport->update($validated);
        return redirect()->route('perdata-reports.show', $perdataReport)->with('success', 'Laporan berhasil diperbarui.');
    }

    public function destroy(PerdataReport $perdataReport)
    {
        $perdataReport->delete();
        return redirect()->route('perdata-reports.index')
            ->with('success', 'Laporan berhasil dihapus.');
    }
}
