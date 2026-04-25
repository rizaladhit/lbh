<?php

namespace App\Http\Controllers;

use App\Models\NegosiasiReport;
use Illuminate\Http\Request;

class NegosiasiReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (auth()->user()->role !== 'admin') {
                abort(403, 'Unauthorized. Only admin can access Laporan Negosiasi.');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $reports = NegosiasiReport::latest()->paginate(10);
        return view('negosiasi_reports.index', compact('reports'));
    }

    public function create()
    {
        return view('negosiasi_reports.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'obh' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'tgl_pelaksanaan' => 'required|date',
            'kasus' => 'required|string|max:255',
            'penerima_bantuan' => 'required|string|max:255',
            'jk_penerima' => 'required|in:L,P',
            'nama_negosiator' => 'required|string|max:255',
            'checklist' => 'nullable|array',
        ]);

        $checklist = [];
        foreach ($request->input('checklist', []) as $item) {
            $checklist[] = [
                'label' => $item['label'] ?? null,
                'obh' => isset($item['obh']),
                'kanwil' => isset($item['kanwil']),
                'bphn' => isset($item['bphn']),
            ];
        }

        $validated['checklist_data'] = $checklist;
        $validated['kegiatan'] = 'NEGOSIASI';
        $validated['user_id'] = auth()->id();
        $validated['status'] = NegosiasiReport::STATUS_DRAFT;

        NegosiasiReport::create($validated);

        return redirect()->route('negosiasi-reports.index')->with('success', 'Laporan Negosiasi berhasil ditambahkan.');
    }

    public function show(NegosiasiReport $negosiasiReport)
    {
        return view('negosiasi_reports.show', compact('negosiasiReport'));
    }

    public function destroy(NegosiasiReport $negosiasiReport)
    {
        $negosiasiReport->delete();
        return redirect()->route('negosiasi-reports.index')->with('success', 'Laporan Negosiasi berhasil dihapus.');
    }
}
