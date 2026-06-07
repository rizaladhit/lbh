<x-app-layout>
    <x-slot name="header">Master Data Paralegal</x-slot>

    <style>
        .panel { border-radius: 16px; border: none; box-shadow: 0 4px 24px rgba(0,0,0,.07); overflow: hidden; }
        [data-bs-theme="dark"] .panel { background: #1a2035; }
        .panel-head {
            padding: 18px 24px;
            border-bottom: 1px solid rgba(0,0,0,.06);
            display: flex; align-items: center; justify-content: space-between;
        }
        [data-bs-theme="dark"] .panel-head { border-color: rgba(255,255,255,.06); }
        .data-table { margin: 0; }
        .data-table thead th {
            font-size: .7rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: .6px;
            color: #94a3b8; padding: 14px 18px;
            background: transparent; border-bottom: 1px solid rgba(0,0,0,.06);
        }
        [data-bs-theme="dark"] .data-table thead th { border-color: rgba(255,255,255,.06); }
        .data-table tbody tr { border-bottom: 1px solid rgba(0,0,0,.04); transition: background .15s; }
        .data-table tbody tr:hover { background: rgba(16,185,129,.04); }
        [data-bs-theme="dark"] .data-table tbody tr:hover { background: rgba(255,255,255,.03); }
        .data-table td { padding: 16px 18px; vertical-align: middle; border: none; }
        .role-badge {
            padding: 4px 10px; border-radius: 99px;
            font-size: .72rem; font-weight: 700;
            display: inline-flex; align-items: center; gap: 6px;
            background: rgba(16,185,129,.12); color: #10b981;
        }
        .action-btn {
            width: 32px; height: 32px; border-radius: 8px;
            border: 1px solid rgba(0,0,0,.08); background: transparent;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: .8rem; text-decoration: none; cursor: pointer; transition: all .15s;
        }
        .action-btn:hover { background: rgba(0,0,0,.05); transform: scale(1.08); }
        [data-bs-theme="dark"] .action-btn { border-color: rgba(255,255,255,.1); }
        .btn-cta {
            background: linear-gradient(135deg,#10b981,#059669);
            border: none; color: #fff; font-weight: 600; font-size: .8rem;
            padding: 8px 18px; border-radius: 9px; transition: all .2s;
            display: inline-flex; align-items: center; gap: 8px; text-decoration: none;
            box-shadow: 0 4px 14px rgba(16,185,129,.35);
        }
        .btn-cta:hover { opacity: .9; color: #fff; transform: translateY(-1px); }
    </style>

    <div class="panel">
        <div class="panel-head">
            <div class="d-flex align-items-center gap-3">
                <div style="width:36px;height:36px;border-radius:10px;background:rgba(16,185,129,.15);display:flex;align-items:center;justify-content:center;">
                    <i class="fa-solid fa-user-shield" style="color:#10b981;"></i>
                </div>
                <div>
                    <h6 class="mb-0 fw-bold text-body">Daftar Paralegal</h6>
                    <div style="font-size:.72rem;color:#94a3b8;">Total {{ $paralegals->total() }} paralegal terdaftar</div>
                </div>
            </div>
            <a href="{{ route('paralegals.create') }}" class="btn-cta">
                <i class="fa-solid fa-plus"></i><span class="d-none d-sm-inline">Tambah Paralegal</span>
            </a>
        </div>

        <div class="table-responsive">
            <table class="data-table table">
                <thead>
                    <tr>
                        <th style="padding-left:24px;">Paralegal</th>
                        <th>Email & Info</th>
                        <th>Identitas</th>
                        <th>Keahlian</th>
                        <th>Status</th>
                        <th style="padding-right:24px;text-align:right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($paralegals as $paralegal)
                    <tr>
                        <td style="padding-left:24px;">
                            <div class="d-flex align-items-center gap-3">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($paralegal->name) }}&background=10b981&color=fff&size=40"
                                     style="width:38px;height:38px;border-radius:10px;" alt="{{ $paralegal->name }}">
                                <div>
                                    <div style="font-weight:600;font-size:.88rem;" class="text-body">{{ $paralegal->name }}</div>
                                    <div style="font-size:.72rem;color:#94a3b8;">{{ $paralegal->phone }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="font-size:.82rem;font-weight:500;" class="text-body">{{ $paralegal->email }}</div>
                            <div style="font-size:.72rem;color:#94a3b8;">{{ $paralegal->created_at->diffForHumans() }}</div>
                        </td>
                        <td><span class="role-badge">{{ $paralegal->no_identitas }}</span></td>
                        <td>{{ $paralegal->specialization }}</td>
                        <td>
                            <span class="badge {{ $paralegal->getStatusBadgeColor() }}">
                                {{ $paralegal->getStatusLabel() }}
                            </span>
                        </td>
                        <td style="padding-right:24px;text-align:right;">
                            <div class="d-flex justify-content-end gap-1">
                                <a href="{{ route('paralegals.show', $paralegal) }}" class="action-btn" style="color:#10b981;" title="Detail">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('paralegals.edit', $paralegal) }}" class="action-btn" style="color:#f59e0b;" title="Edit">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <button onclick="confirmDelete('{{ route('paralegals.destroy', $paralegal) }}')" class="action-btn" style="color:#ef4444;" title="Hapus">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center text-muted py-4">Belum ada data paralegal tercatat.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($paralegals->hasPages())
        <div style="padding:16px 24px;border-top:1px solid rgba(0,0,0,.05);display:flex;justify-content:space-between;align-items:center;">
            <span style="font-size:.75rem;color:#94a3b8;">Menampilkan hal. {{ $paralegals->currentPage() }} dari {{ $paralegals->lastPage() }}</span>
            {{ $paralegals->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>

    <form id="deleteForm" method="POST" style="display:none;">@csrf @method('DELETE')</form>
    <script>
        function confirmDelete(action){
            if(!confirm('Hapus data paralegal ini? Pastikan tidak ada penugasan aktif.')) return;
            const f = document.getElementById('deleteForm'); f.action = action; f.submit();
        }
    </script>
</x-app-layout>
