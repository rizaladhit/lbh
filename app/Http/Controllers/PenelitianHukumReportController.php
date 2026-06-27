<?php

namespace App\Http\Controllers;

use App\Models\PenelitianHukumReport;
use Illuminate\Http\Request;

class PenelitianHukumReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (auth()->user()->role !== 'admin') {
                abort(403, 'Unauthorized. Only admin can access Laporan Penelitian Hukum.');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $reports = PenelitianHukumReport::latest()->paginate(10);
        return view('penelitian_hukum_reports.index', compact('reports'));
    }

    public function create()
    {
        return view('penelitian_hukum_reports.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'obh'              => 'required|string|max:255',
            'alamat'           => 'required|string|max:255',
            'provinsi'         => 'required|string|max:255',
            'tgl_pelaksanaan'  => 'nullable|date',
            'judul_penelitian' => 'required|string|max:500',
            'checklist_data'   => 'nullable|array',
        ]);

        $validated['kegiatan'] = 'Penelitian Hukum';
        $validated['user_id']  = auth()->id();
        $validated['status']   = PenelitianHukumReport::STATUS_DRAFT;

        PenelitianHukumReport::create($validated);

        return redirect()->route('penelitian-hukum-reports.index')
            ->with('success', 'Laporan Penelitian Hukum berhasil ditambahkan.');
    }

    public function show(PenelitianHukumReport $penelitianHukumReport)
    {
        return view('penelitian_hukum_reports.show', compact('penelitianHukumReport'));
    }

    public function edit(PenelitianHukumReport $penelitianHukumReport)
    {
        return view('penelitian_hukum_reports.edit', compact('penelitianHukumReport'));
    }

    public function update(Request $request, PenelitianHukumReport $penelitianHukumReport)
    {
        $validated = $request->validate([
            'obh'              => 'required|string|max:255',
            'alamat'           => 'required|string|max:255',
            'provinsi'         => 'required|string|max:255',
            'tgl_pelaksanaan'  => 'nullable|date',
            'judul_penelitian' => 'required|string|max:500',
            'checklist_data'   => 'nullable|array',
        ]);
        $validated['kegiatan'] = 'Penelitian Hukum';
        $penelitianHukumReport->update($validated);
        return redirect()->route('penelitian-hukum-reports.show', $penelitianHukumReport)->with('success', 'Laporan berhasil diperbarui.');
    }

    public function destroy(PenelitianHukumReport $penelitianHukumReport)
    {
        $penelitianHukumReport->delete();
        return redirect()->route('penelitian-hukum-reports.index')
            ->with('success', 'Laporan berhasil dihapus.');
    }
}
