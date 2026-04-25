<?php

namespace App\Http\Controllers;

use App\Models\ReimbursementReport;
use Illuminate\Http\Request;

class ReimbursementReportController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (auth()->check() && auth()->user()->role !== 'admin') {
                abort(403, 'Unauthorized. Only admin can access reimbursement reports.');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $reports = ReimbursementReport::latest()->paginate(15);
        return view('reimbursement_reports.index', compact('reports'));
    }

    public function create(Request $request)
    {
        $kegiatan_type = $request->query('type', 'Penelitian Hukum');
        return view('reimbursement_reports.create', compact('kegiatan_type'));
    }

    public function createPemberdayaan()
    {
        return view('reimbursement_reports.create_pemberdayaan');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'obh' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kegiatan' => 'required|string|max:255',
            'tgl_pelaksanaan' => 'required|date',
            'penerima_bantuan' => 'nullable|string|max:255',
            'tempat_pelaksanaan' => 'nullable|string|max:255',
            'materi' => 'nullable|string|max:255',
            'narasumber' => 'nullable|string|max:255',
            'kasus' => 'nullable|string|max:255',
            'nomor_perkara' => 'nullable|string|max:255',
            'perkara_type' => 'nullable|string|max:50',
            'jenis_kegiatan_investigasi' => 'nullable|string|max:255',
            'nama_investigator' => 'nullable|string|max:255',
            'nama_mediator' => 'nullable|string|max:255',
            'nama_negosiator' => 'nullable|string|max:255',
            'nama_konsultan' => 'nullable|string|max:255',
            'checklist_items' => 'nullable|array',
            'checklist_data' => 'nullable|array',
        ]);

        // Build checklist data from either checklist_data or checklist_items
        $checklist_data = $request->input('checklist_data', []);
        if (empty($checklist_data) && $request->has('checklist_items')) {
            foreach ($request->input('checklist_items', []) as $item => $value) {
                if (is_numeric($item) && is_string($value)) {
                    $checklist_data[$value] = true;
                } else {
                    $checklist_data[$item] = $value === 'on' ? true : false;
                }
            }
        }

        $validated['checklist_data'] = $checklist_data;
        $validated['status'] = 'draft';

        ReimbursementReport::create($validated);

        return redirect()->route('reimbursement-reports.index')
            ->with('success', 'Laporan Reimbursement berhasil ditambahkan.');
    }

    public function show(ReimbursementReport $reimbursementReport)
    {
        return view('reimbursement_reports.show', compact('reimbursementReport'));
    }

    public function edit(ReimbursementReport $reimbursementReport)
    {
        return view('reimbursement_reports.edit', compact('reimbursementReport'));
    }

    public function update(Request $request, ReimbursementReport $reimbursementReport)
    {
        $validated = $request->validate([
            'obh' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kegiatan' => 'required|string|max:255',
            'tgl_pelaksanaan' => 'required|date',
            'penerima_bantuan' => 'nullable|string|max:255',
            'tempat_pelaksanaan' => 'nullable|string|max:255',
            'materi' => 'nullable|string|max:255',
            'narasumber' => 'nullable|string|max:255',
            'kasus' => 'nullable|string|max:255',
            'nomor_perkara' => 'nullable|string|max:255',
            'perkara_type' => 'nullable|string|max:50',
            'jenis_kegiatan_investigasi' => 'nullable|string|max:255',
            'nama_investigator' => 'nullable|string|max:255',
            'nama_mediator' => 'nullable|string|max:255',
            'nama_negosiator' => 'nullable|string|max:255',
            'nama_konsultan' => 'nullable|string|max:255',
            'checklist_items' => 'nullable|array',
            'checklist_data' => 'nullable|array',
            'status' => 'nullable|in:draft,submitted,approved,rejected',
        ]);

        $checklist_data = $request->input('checklist_data', []);
        if (empty($checklist_data) && $request->has('checklist_items')) {
            foreach ($request->input('checklist_items', []) as $item => $value) {
                if (is_numeric($item) && is_string($value)) {
                    $checklist_data[$value] = true;
                } else {
                    $checklist_data[$item] = $value === 'on' ? true : false;
                }
            }
        }
        $validated['checklist_data'] = $checklist_data;

        $reimbursementReport->update($validated);

        return redirect()->route('reimbursement-reports.show', $reimbursementReport)
            ->with('success', 'Laporan Reimbursement berhasil diperbarui.');
    }

    public function destroy(ReimbursementReport $reimbursementReport)
    {
        $reimbursementReport->delete();
        return redirect()->route('reimbursement-reports.index')
            ->with('success', 'Laporan Reimbursement berhasil dihapus.');
    }
}
