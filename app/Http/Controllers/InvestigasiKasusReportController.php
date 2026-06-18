<?php

namespace App\Http\Controllers;

use App\Models\InvestigasiKasusReport;
use Illuminate\Http\Request;

class InvestigasiKasusReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (auth()->user()->role !== 'admin') {
                abort(403, 'Unauthorized. Only admin can access Laporan Investigasi Kasus.');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $reports = InvestigasiKasusReport::latest()->paginate(10);
        return view('investigasi_kasus_reports.index', compact('reports'));
    }

    public function create()
    {
        return view('investigasi_kasus_reports.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'obh'      => 'required|string|max:255',
            'alamat'   => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'sections' => 'nullable|array',
        ]);

        $validated['kegiatan'] = 'INVESTIGASI KASUS';
        $validated['user_id']  = auth()->id();
        $validated['status']   = InvestigasiKasusReport::STATUS_DRAFT;
        $validated['sections'] = $request->input('sections', []);

        InvestigasiKasusReport::create($validated);

        return redirect()->route('investigasi-kasus-reports.index')
            ->with('success', 'Laporan Investigasi Kasus berhasil ditambahkan.');
    }

    public function show(InvestigasiKasusReport $investigasiKasusReport)
    {
        return view('investigasi_kasus_reports.show', compact('investigasiKasusReport'));
    }

    public function destroy(InvestigasiKasusReport $investigasiKasusReport)
    {
        $investigasiKasusReport->delete();
        return redirect()->route('investigasi-kasus-reports.index')
            ->with('success', 'Laporan berhasil dihapus.');
    }
}
