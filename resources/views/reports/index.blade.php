<x-app-layout>
    <x-slot name="header">Case Reports</x-slot>

    @php
        $statusConfig = [
            'Draft'       => ['bg'=>'rgba(100,116,139,.1)','color'=>'#64748b','dot'=>'#64748b'],
            'Submitted'   => ['bg'=>'rgba(99,102,241,.1)', 'color'=>'#6366f1','dot'=>'#6366f1'],
            'In Progress' => ['bg'=>'rgba(245,158,11,.1)', 'color'=>'#d97706','dot'=>'#f59e0b'],
            'Completed'   => ['bg'=>'rgba(16,185,129,.1)', 'color'=>'#059669','dot'=>'#10b981'],
        ];
    @endphp

    <style>
        .panel { border-radius: 16px; border: none; box-shadow: 0 4px 24px rgba(0,0,0,.07); overflow: hidden; }
        [data-bs-theme="dark"] .panel { background: #1a2035; }
        .filter-wrap {
            padding: 18px 22px;
            border-bottom: 1px solid rgba(0,0,0,.06);
            background: rgba(99,102,241,.03);
        }
        [data-bs-theme="dark"] .filter-wrap { border-color: rgba(255,255,255,.06); background: rgba(99,102,241,.05); }
        .panel-head {
            padding: 16px 22px;
            border-bottom: 1px solid rgba(0,0,0,.06);
            display: flex; align-items: center; gap: 12px;
        }
        [data-bs-theme="dark"] .panel-head { border-color: rgba(255,255,255,.06); }
        .data-table { margin: 0; }
        .data-table thead th {
            font-size: .68rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: .6px;
            color: #94a3b8; padding: 12px 16px;
            background: transparent;
            border-bottom: 1px solid rgba(0,0,0,.06);
            white-space: nowrap;
        }
        [data-bs-theme="dark"] .data-table thead th { border-color: rgba(255,255,255,.06); }
        .data-table tbody tr { border-bottom: 1px solid rgba(0,0,0,.04); transition: background .15s; }
        .data-table tbody tr:last-child { border: none; }
        .data-table tbody tr:hover { background: rgba(99,102,241,.035); }
        [data-bs-theme="dark"] .data-table tbody tr:hover { background: rgba(255,255,255,.025); }
        .data-table td { padding: 14px 16px; vertical-align: middle; border: none; }
        .status-pill {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 4px 10px; border-radius: 99px;
            font-size: .72rem; font-weight: 600; white-space: nowrap;
        }
        .status-dot { width: 6px; height: 6px; border-radius: 50%; }
        .action-btn {
            width: 30px; height: 30px; border-radius: 7px;
            border: 1px solid rgba(0,0,0,.08);
            background: transparent;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: .75rem; text-decoration: none; cursor: pointer;
            transition: all .15s;
        }
        .action-btn:hover { background: rgba(0,0,0,.05); transform: scale(1.08); }
        [data-bs-theme="dark"] .action-btn { border-color: rgba(255,255,255,.1); }
        .btn-cta {
            background: linear-gradient(135deg,#6366f1,#8b5cf6);
            border: none; color: #fff; font-weight: 600;
            font-size: .8rem; padding: 8px 16px;
            border-radius: 9px; transition: all .2s;
            display: inline-flex; align-items: center; gap: 6px;
            text-decoration: none;
            box-shadow: 0 4px 14px rgba(99,102,241,.35);
        }
        .btn-cta:hover { opacity: .9; color: #fff; transform: translateY(-1px); }
        .input-sm-mod {
            height: 34px; font-size: .8rem; border-radius: 8px;
            border: 1px solid rgba(0,0,0,.1); background: transparent;
            padding: 0 10px;
        }
        .input-sm-mod:focus { outline: none; border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99,102,241,.12); }
        [data-bs-theme="dark"] .input-sm-mod { border-color: rgba(255,255,255,.1); color: #f1f5f9; }
        .export-btn {
            height: 34px; padding: 0 12px; border-radius: 8px;
            font-size: .78rem; font-weight: 600;
            display: inline-flex; align-items: center; gap: 6px;
            text-decoration: none; border: none; cursor: pointer;
            transition: all .15s;
        }
        .export-btn:hover { transform: translateY(-1px); }
    </style>

    <div class="panel">
        {{-- Filter --}}
        <div class="filter-wrap">
            <form action="{{ route('reports.index') }}" method="GET">
                <div class="row g-2 align-items-end">
                    <div class="col-12 col-sm-5 col-lg-3">
                        <div style="position:relative;">
                            <i class="fa-solid fa-magnifying-glass" style="position:absolute;left:10px;top:50%;transform:translateY(-50%);color:#94a3b8;font-size:.75rem;"></i>
                            <input name="search" type="text" class="form-control input-sm-mod" style="padding-left:30px;"
                                   value="{{ request('search') }}" placeholder="Cari klien / judul…">
                        </div>
                    </div>
                    <div class="col-6 col-sm-3 col-lg-2">
                        <select name="category_id" class="form-select input-sm-mod">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6 col-sm-3 col-lg-2">
                        <select name="status" class="form-select input-sm-mod">
                            <option value="">Semua Status</option>
                            @foreach(['Draft','Submitted','In Progress','Completed'] as $s)
                                <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>{{ $s }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6 col-lg-2">
                        <input name="date_from" type="date" class="form-control input-sm-mod" value="{{ request('date_from') }}">
                    </div>
                    <div class="col-6 col-lg-auto d-flex gap-2">
                        <button type="submit" class="btn-cta"><i class="fa-solid fa-filter"></i> Filter</button>
                        <a href="{{ route('reports.index') }}" class="export-btn" style="background:rgba(0,0,0,.06);color:#64748b;">
                            <i class="fa-solid fa-xmark"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>

        {{-- Panel head --}}
        <div class="panel-head">
            <div style="width:32px;height:32px;border-radius:9px;background:rgba(245,158,11,.12);display:flex;align-items:center;justify-content:center;">
                <i class="fa-solid fa-folder-open" style="color:#f59e0b;font-size:.8rem;"></i>
            </div>
            <div style="flex:1;">
                <span style="font-weight:700;font-size:.9rem;" class="text-body">Daftar Kasus</span>
                <span class="ms-2" style="font-size:.72rem;color:#94a3b8;">{{ $reports->total() }} data</span>
            </div>
            <div class="d-flex gap-2 align-items-center">
                <a href="{{ route('reports.export.pdf', request()->query()) }}" target="_blank"
                   class="export-btn" style="background:rgba(239,68,68,.1);color:#ef4444;">
                    <i class="fa-solid fa-file-pdf"></i><span class="d-none d-md-inline">PDF</span>
                </a>
                <a href="{{ route('reports.export.excel', request()->query()) }}" target="_blank"
                   class="export-btn" style="background:rgba(16,185,129,.1);color:#10b981;">
                    <i class="fa-solid fa-file-excel"></i><span class="d-none d-md-inline">Excel</span>
                </a>
                <a href="{{ route('reports.create') }}" class="btn-cta">
                    <i class="fa-solid fa-plus"></i><span class="d-none d-sm-inline">Tambah</span>
                </a>
            </div>
        </div>

        {{-- Table --}}
        <div class="table-responsive">
            <table class="data-table table">
                <thead>
                    <tr>
                        <th style="padding-left:22px;">Report ID</th>
                        <th>Klien / Judul</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>User</th>
                        <th style="padding-right:22px;text-align:right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reports as $report)
                    @php $sc = $statusConfig[$report->status] ?? $statusConfig['Draft']; @endphp
                    <tr>
                        <td style="padding-left:22px;">
                            <span style="font-size:.72rem;font-weight:700;font-family:monospace;color:#94a3b8;">{{ $report->report_id }}</span>
                        </td>
                        <td>
                            <div style="font-weight:600;font-size:.85rem;max-width:200px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;" class="text-body" title="{{ $report->case_title }}">{{ $report->case_title }}</div>
                            <div style="font-size:.72rem;color:#94a3b8;">{{ $report->client_name }}</div>
                        </td>
                        <td>
                            <span style="font-size:.78rem;font-weight:500;" class="text-body">{{ $report->category->name ?? '—' }}</span>
                        </td>
                        <td>
                            <span class="status-pill" style="background:{{ $sc['bg'] }};color:{{ $sc['color'] }};">
                                <span class="status-dot" style="background:{{ $sc['dot'] }};"></span>
                                {{ $report->status }}
                            </span>
                        </td>
                        <td style="font-size:.8rem;color:#64748b;">{{ \Carbon\Carbon::parse($report->date)->format('d M Y') }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($report->user->name ?? 'U') }}&background=6366f1&color=fff&size=28"
                                     width="24" height="24" class="rounded-circle" alt="">
                                <span style="font-size:.78rem;" class="text-body">{{ $report->user->name ?? '—' }}</span>
                            </div>
                        </td>
                        <td style="padding-right:22px;text-align:right;">
                            <div class="d-flex justify-content-end gap-1">
                                <a href="{{ route('reports.show', $report) }}" class="action-btn" style="color:#6366f1;" title="Lihat"><i class="fa-solid fa-eye"></i></a>
                                <a href="{{ route('reports.edit', $report) }}" class="action-btn" style="color:#f59e0b;" title="Edit"><i class="fa-solid fa-pen"></i></a>
                                <button onclick="confirmDelete('{{ route('reports.destroy', $report) }}')" class="action-btn" style="color:#ef4444;" title="Hapus"><i class="fa-solid fa-trash-can"></i></button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" style="padding:60px;text-align:center;color:#94a3b8;font-size:.83rem;">
                        <i class="fa-solid fa-folder-open fa-2x" style="display:block;margin-bottom:10px;opacity:.3;"></i>
                        Tidak ada laporan ditemukan.
                    </td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($reports->hasPages())
        <div style="padding:14px 22px;border-top:1px solid rgba(0,0,0,.05);display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:8px;">
            <span style="font-size:.72rem;color:#94a3b8;">{{ $reports->firstItem() }}–{{ $reports->lastItem() }} dari {{ $reports->total() }}</span>
            {{ $reports->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>

    <form id="deleteForm" method="POST" style="display:none;">@csrf @method('DELETE')</form>
    <script>
        function confirmDelete(action){
            if(!confirm('Hapus laporan ini?')) return;
            const f = document.getElementById('deleteForm'); f.action = action; f.submit();
        }
    </script>
</x-app-layout>
