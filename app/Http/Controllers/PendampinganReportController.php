<?php

namespace App\Http\Controllers;

use App\Models\PendampinganReport;
use Illuminate\Http\Request;

class PendampinganReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (auth()->user()->role !== 'admin') {
                abort(403, 'Unauthorized. Only admin can access Laporan Pendampingan.');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $reports = PendampinganReport::latest()->paginate(10);
        return view('pendampingan_reports.index', compact('reports'));
    }

    public function create()
    {
        return view('pendampingan_reports.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'obh'                 => 'required|string|max:255',
            'alamat'              => 'required|string|max:255',
            'provinsi'            => 'required|string|max:255',
            'kasus'               => 'required|string|max:255',
            'tgl_pendampingan_1'  => 'nullable|date',
            'tgl_pendampingan_2'  => 'nullable|date',
            'tgl_pendampingan_3'  => 'nullable|date',
            'tgl_pendampingan_4'  => 'nullable|date',
            'penerima_bantuan'    => 'required|string|max:255',
            'jk_penerima'         => 'required|in:L,P',
            'checklist_data'      => 'nullable|array',
        ]);

        $validated['kegiatan'] = 'Pendampingan Diluar Pengadilan';
        $validated['user_id']  = auth()->id();
        $validated['status']   = PendampinganReport::STATUS_DRAFT;

        PendampinganReport::create($validated);

        return redirect()->route('pendampingan-reports.index')
            ->with('success', 'Laporan Pendampingan Diluar Pengadilan berhasil ditambahkan.');
    }

    public function show(PendampinganReport $pendampinganReport)
    {
        return view('pendampingan_reports.show', compact('pendampinganReport'));
    }

    public function destroy(PendampinganReport $pendampinganReport)
    {
        $pendampinganReport->delete();
        return redirect()->route('pendampingan-reports.index')
            ->with('success', 'Laporan berhasil dihapus.');
    }
}
