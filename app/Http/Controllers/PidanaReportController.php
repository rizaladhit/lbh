<?php

namespace App\Http\Controllers;

use App\Models\PidanaReport;
use Illuminate\Http\Request;

class PidanaReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (auth()->user()->role !== 'admin') {
                abort(403, 'Unauthorized. Only admin can access Laporan Pidana.');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $reports = PidanaReport::latest()->paginate(10);
        return view('pidana_reports.index', compact('reports'));
    }

    public function create()
    {
        return view('pidana_reports.create');
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

        $validated['perkara'] = 'Pidana';
        $validated['user_id'] = auth()->id();
        $validated['status']  = PidanaReport::STATUS_DRAFT;

        PidanaReport::create($validated);

        return redirect()->route('pidana-reports.index')
            ->with('success', 'Laporan Pidana berhasil ditambahkan.');
    }

    public function show(PidanaReport $pidanaReport)
    {
        return view('pidana_reports.show', compact('pidanaReport'));
    }

    public function destroy(PidanaReport $pidanaReport)
    {
        $pidanaReport->delete();
        return redirect()->route('pidana-reports.index')
            ->with('success', 'Laporan berhasil dihapus.');
    }
}
