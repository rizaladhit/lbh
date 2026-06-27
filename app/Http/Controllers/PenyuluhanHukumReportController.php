<?php

namespace App\Http\Controllers;

use App\Models\PenyuluhanHukumReport;
use Illuminate\Http\Request;

class PenyuluhanHukumReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (auth()->user()->role !== 'admin') {
                abort(403, 'Unauthorized. Only admin can access Laporan Penyuluhan Hukum.');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $reports = PenyuluhanHukumReport::latest()->paginate(10);
        return view('penyuluhan_hukum_reports.index', compact('reports'));
    }

    public function create()
    {
        return view('penyuluhan_hukum_reports.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'obh'               => 'required|string|max:255',
            'alamat'            => 'required|string|max:255',
            'provinsi'          => 'required|string|max:255',
            'tgl_pelaksanaan'   => 'nullable|date',
            'penerima_bantuan'  => 'nullable|string|max:255',
            'tempat_pelaksanaan'=> 'nullable|string|max:255',
            'materi'            => 'nullable|string|max:500',
            'narasumber'        => 'nullable|string|max:255',
            'checklist_data'    => 'nullable|array',
        ]);

        $validated['kegiatan'] = 'Penyuluhan Hukum';
        $validated['user_id']  = auth()->id();
        $validated['status']   = PenyuluhanHukumReport::STATUS_DRAFT;

        PenyuluhanHukumReport::create($validated);

        return redirect()->route('penyuluhan-hukum-reports.index')
            ->with('success', 'Laporan Penyuluhan Hukum berhasil ditambahkan.');
    }

    public function show(PenyuluhanHukumReport $penyuluhanHukumReport)
    {
        return view('penyuluhan_hukum_reports.show', compact('penyuluhanHukumReport'));
    }

    public function edit(PenyuluhanHukumReport $penyuluhanHukumReport)
    {
        return view('penyuluhan_hukum_reports.edit', compact('penyuluhanHukumReport'));
    }

    public function update(Request $request, PenyuluhanHukumReport $penyuluhanHukumReport)
    {
        $validated = $request->validate([
            'obh'               => 'required|string|max:255',
            'alamat'            => 'required|string|max:255',
            'provinsi'          => 'required|string|max:255',
            'tgl_pelaksanaan'   => 'nullable|date',
            'penerima_bantuan'  => 'nullable|string|max:255',
            'tempat_pelaksanaan'=> 'nullable|string|max:255',
            'materi'            => 'nullable|string|max:500',
            'narasumber'        => 'nullable|string|max:255',
            'checklist_data'    => 'nullable|array',
        ]);
        $validated['kegiatan'] = 'Penyuluhan Hukum';
        $penyuluhanHukumReport->update($validated);
        return redirect()->route('penyuluhan-hukum-reports.show', $penyuluhanHukumReport)->with('success', 'Laporan berhasil diperbarui.');
    }

    public function destroy(PenyuluhanHukumReport $penyuluhanHukumReport)
    {
        $penyuluhanHukumReport->delete();
        return redirect()->route('penyuluhan-hukum-reports.index')
            ->with('success', 'Laporan berhasil dihapus.');
    }
}
