<?php

namespace App\Http\Controllers;

use App\Models\TunReport;
use Illuminate\Http\Request;

class TunReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (auth()->user()->role !== 'admin') {
                abort(403, 'Unauthorized. Only admin can access Laporan TUN.');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $reports = TunReport::latest()->paginate(10);
        return view('tun_reports.index', compact('reports'));
    }

    public function create()
    {
        return view('tun_reports.create');
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

        $validated['perkara'] = 'TUN';
        $validated['user_id'] = auth()->id();
        $validated['status']  = TunReport::STATUS_DRAFT;

        TunReport::create($validated);

        return redirect()->route('tun-reports.index')
            ->with('success', 'Laporan TUN berhasil ditambahkan.');
    }

    public function show(TunReport $tunReport)
    {
        return view('tun_reports.show', compact('tunReport'));
    }

    public function edit(TunReport $tunReport)
    {
        return view('tun_reports.edit', compact('tunReport'));
    }

    public function update(Request $request, TunReport $tunReport)
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
        $validated['perkara'] = 'TUN';
        $tunReport->update($validated);
        return redirect()->route('tun-reports.show', $tunReport)->with('success', 'Laporan berhasil diperbarui.');
    }

    public function destroy(TunReport $tunReport)
    {
        $tunReport->delete();
        return redirect()->route('tun-reports.index')
            ->with('success', 'Laporan berhasil dihapus.');
    }
}
