<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Category;
use App\Models\User;
use App\Http\Requests\ReportRequest;
use Illuminate\Http\Request;
use App\Exports\ReportsExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (auth()->check() && auth()->user()->role !== 'admin') {
                abort(403, 'Unauthorized. Only admin can access reports.');
            }
            return $next($request);
        });
    }

    private function buildQuery(Request $request)
    {
        $query = Report::with(['category', 'user']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('client_name', 'like', "%{$search}%")
                  ->orWhere('case_title', 'like', "%{$search}%");
            });
        }

        // Filter
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('date_from')) {
            $query->whereDate('date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('date', '<=', $request->date_to);
        }

        // Role restriction (User only sees their own, Admin sees all)
        if (auth()->check() && auth()->user()->role === 'user') {
            $query->where('user_id', auth()->id());
        }

        return $query;
    }

    public function index(Request $request)
    {
        $query = $this->buildQuery($request);
        
        $reports = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        $categories = Category::all();

        return view('reports.index', compact('reports', 'categories'));
    }

    public function exportExcel(Request $request)
    {
        $query = $this->buildQuery($request);
        $reports = $query->orderBy('created_at', 'desc')->get();
        return Excel::download(new ReportsExport($reports), 'reports_'.date('YmdHis').'.xlsx');
    }

    public function exportPdf(Request $request)
    {
        $query = $this->buildQuery($request);
        $reports = $query->orderBy('created_at', 'desc')->get();
        $pdf = Pdf::loadView('reports.pdf', compact('reports'));
        return $pdf->download('reports_'.date('YmdHis').'.pdf');
    }

    public function create()
    {
        $categories = Category::all();
        $users = auth()->user()->role === 'admin' ? User::all() : collect([auth()->user()]);
        return view('reports.create', compact('categories', 'users'));
    }

    public function store(ReportRequest $request)
    {
        $data = $request->validated();
        
        // Generate Unique Report ID (e.g. LBH-YYYYMM-XXXX)
        $data['report_id'] = 'LBH-' . date('Ym') . '-' . str_pad(Report::count() + 1, 4, '0', STR_PAD_LEFT);
        
        // Handle user_id assignment
        if (empty($data['user_id'])) {
            $data['user_id'] = auth()->id();
        }

        // Handle attachment upload
        if ($request->hasFile('attachment')) {
            $data['attachment_path'] = $request->file('attachment')->store('attachments', 'public');
        }

        Report::create($data);

        return redirect()->route('reports.index')->with('success', 'Report created successfully.');
    }

    public function show(Report $report)
    {
        // Role check
        if (auth()->user()->role === 'user' && $report->user_id !== auth()->id()) {
            abort(403);
        }
        
        return view('reports.show', compact('report'));
    }

    public function edit(Report $report)
    {
        if (auth()->user()->role === 'user' && $report->user_id !== auth()->id()) {
            abort(403);
        }

        $categories = Category::all();
        $users = auth()->user()->role === 'admin' ? User::all() : collect([auth()->user()]);
        return view('reports.edit', compact('report', 'categories', 'users'));
    }

    public function update(ReportRequest $request, Report $report)
    {
        if (auth()->user()->role === 'user' && $report->user_id !== auth()->id()) {
            abort(403);
        }

        $data = $request->validated();

        if ($request->hasFile('attachment')) {
            $data['attachment_path'] = $request->file('attachment')->store('attachments', 'public');
        }

        $report->update($data);

        return redirect()->route('reports.index')->with('success', 'Report updated successfully.');
    }

    public function destroy(Report $report)
    {
        if (auth()->user()->role === 'user' && $report->user_id !== auth()->id()) {
            abort(403);
        }
        
        $report->delete();
        return redirect()->route('reports.index')->with('success', 'Report deleted successfully.');
    }
}
