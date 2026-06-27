<x-app-layout>
    <x-slot name="header">Laporan Negosiasi</x-slot>

    <style>
        .panel { border-radius: 16px; border: none; box-shadow: 0 4px 24px rgba(0,0,0,.07); overflow: hidden; }
        [data-bs-theme="dark"] .panel { background: #1a2035; }
        .panel-head { padding: 18px 24px; border-bottom: 1px solid rgba(0,0,0,.06); display: flex; align-items: center; justify-content: space-between; }
        [data-bs-theme="dark"] .panel-head { border-color: rgba(255,255,255,.06); }
        .data-table { margin: 0; }
        .data-table thead th { font-size: .7rem; font-weight: 700; text-transform: uppercase; letter-spacing: .6px; color: #94a3b8; padding: 14px 18px; background: transparent; border-bottom: 1px solid rgba(0,0,0,.06); }
        [data-bs-theme="dark"] .data-table thead th { border-color: rgba(255,255,255,.06); }
        .data-table tbody tr { border-bottom: 1px solid rgba(0,0,0,.04); transition: background .15s; }
        .data-table tbody tr:hover { background: rgba(99,102,241,.04); }
        [data-bs-theme="dark"] .data-table tbody tr:hover { background: rgba(255,255,255,.03); }
        .data-table td { padding: 16px 18px; vertical-align: middle; border: none; }
        .action-btn { width: 32px; height: 32px; border-radius: 8px; border: 1px solid rgba(0,0,0,.08); background: transparent; display: inline-flex; align-items: center; justify-content: center; font-size: .8rem; text-decoration: none; cursor: pointer; transition: all .15s; }
        .action-btn:hover { background: rgba(0,0,0,.05); transform: scale(1.08); }
        [data-bs-theme="dark"] .action-btn { border-color: rgba(255,255,255,.1); }
        .btn-cta { background: linear-gradient(135deg,#6366f1,#8b5cf6); border: none; color: #fff; font-weight: 600; font-size: .8rem; padding: 8px 18px; border-radius: 9px; transition: all .2s; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; box-shadow: 0 4px 14px rgba(99,102,241,.35); }
        .btn-cta:hover { opacity: .9; color: #fff; transform: translateY(-1px); }
        .empty-state { padding: 72px 24px; text-align: center; }
        .empty-icon { width: 80px; height: 80px; border-radius: 20px; background: rgba(99,102,241,.1); display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 2rem; color: #6366f1; }
        .badge-kegiatan { background: rgba(245,158,11,.15); color: #d97706; padding: 4px 10px; border-radius: 99px; font-size: .7rem; font-weight: 700; display: inline-block; }
    </style>

    <div class="panel">
        <div class="panel-head">
            <div class="d-flex align-items-center gap-3">
                <div style="width:36px;height:36px;border-radius:10px;background:rgba(99,102,241,.15);display:flex;align-items:center;justify-content:center;">
                    <i class="fa-solid fa-file-signature text-primary"></i>
                </div>
                <div>
                    <h6 style="font-size:.85rem;font-weight:600;" class="mb-0 fw-bold text-body">Daftar Laporan Negosiasi</h6>
                    <div style="font-size:.72rem;color:#94a3b8;">Total {{ $reports->total() }} laporan terdata</div>
                </div>
            </div>
            <a href="{{ route('negosiasi-reports.create') }}" class="btn-cta">
                <i class="fa-solid fa-plus"></i><span class="d-none d-sm-inline">Buat Laporan Baru</span>
            </a>
        </div>

        <div class="table-responsive">
            <table class="data-table table">
                <thead>
                    <tr>
                        <th style="padding-left:24px;">Kasus</th>
                        <th>OBH & Kegiatan</th>
                        <th>Penerima Bantuan</th>
                        <th>Tgl Pelaksanaan</th>
                        <th>Status</th>
                        <th style="padding-right:24px;text-align:right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reports as $report)
                    <tr>
                        <td style="padding-left:24px;">
                            <div style="font-size:.85rem;font-weight:600;" class="text-body">{{ Str::limit($report->kasus, 28) }}</div>
                            <div style="font-size:.7rem;color:#94a3b8;margin-top:2px;">{{ $report->provinsi }}</div>
                        </td>
                        <td>
                            <div style="font-size:.85rem;font-weight:600;" class="text-body">{{ $report->obh }}</div>
                            <div class="badge-kegiatan mt-1">{{ $report->kegiatan }}</div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div style="width:28px;height:28px;border-radius:50%;background:{{ $report->jk_penerima === 'L' ? 'rgba(59,130,246,.15)' : 'rgba(236,72,153,.15)' }};display:flex;align-items:center;justify-content:center;color:{{ $report->jk_penerima === 'L' ? '#3b82f6' : '#ec4899' }};font-size:.7rem;font-weight:bold;">
                                    {{ $report->jk_penerima }}
                                </div>
                                <span style="font-size:.85rem;font-weight:600;" class="text-body">{{ $report->penerima_bantuan }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <i class="fa-solid fa-calendar-check" style="color:#10b981;font-size:.8rem;"></i>
                                <span style="font-size:.85rem;font-weight:600;" class="text-body">{{ $report->tgl_pelaksanaan->format('d M Y') }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-secondary">{{ $report->getStatusLabel() }}</span>
                        </td>
                        <td style="padding-right:24px;text-align:right;">
                            <div class="d-flex justify-content-end gap-1">
                                <a href="{{ route('negosiasi-reports.show', $report) }}" class="action-btn" style="color:#6366f1;" title="Detail Laporan">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('negosiasi-reports.edit', $report) }}" class="action-btn" style="color:#f59e0b;" title="Edit Laporan">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <button onclick="confirmDelete('{{ route('negosiasi-reports.destroy', $report) }}')" class="action-btn" style="color:#ef4444;" title="Hapus Laporan">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <div class="empty-icon"><i class="fa-regular fa-file-lines"></i></div>
                                <h6 style="font-size:.85rem;font-weight:600;" class="fw-bold text-body mb-1">Belum Ada Laporan Negosiasi</h6>
                                <p class="text-muted mb-4" style="font-size:.85rem;">Mulai dengan membuat laporan Negosiasi yang pertama.</p>
                                <a href="{{ route('negosiasi-reports.create') }}" class="btn-cta" style="margin:auto;width:fit-content;">
                                    <i class="fa-solid fa-plus"></i> Buat Laporan
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($reports->hasPages())
        <div style="padding:16px 24px;border-top:1px solid rgba(0,0,0,.05);display:flex;justify-content:space-between;align-items:center;">
            <span style="font-size:.75rem;color:#94a3b8;">Halaman {{ $reports->currentPage() }} dari {{ $reports->lastPage() }}</span>
            {{ $reports->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>

    <form id="deleteForm" method="POST" style="display:none;">@csrf @method('DELETE')</form>
    <script>
        function confirmDelete(action){
            if(!confirm('Hapus laporan Negosiasi ini secara permanen?')) return;
            const f = document.getElementById('deleteForm'); f.action = action; f.submit();
        }
    </script>
</x-app-layout>
