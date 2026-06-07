<x-app-layout>
    <x-slot name="header">Permohonan Bantuan Litigasi</x-slot>

    @php
        $activeFilter = request('status', 'ALL');
        $stats = [
            'ALL'        => ['label' => 'Total Semua',     'icon' => 'fa-solid fa-layer-group',      'grad' => 'linear-gradient(135deg,#667eea,#764ba2)', 'count' => $totalAll],
            'REGISTERED' => ['label' => 'Terdaftar',       'icon' => 'fa-solid fa-file-circle-plus', 'grad' => 'linear-gradient(135deg,#4facfe,#00f2fe)', 'count' => $statusCounts['REGISTERED'] ?? 0],
            'APPROVED'   => ['label' => 'Disetujui',       'icon' => 'fa-solid fa-thumbs-up',       'grad' => 'linear-gradient(135deg,#2d98da,#4ac6ff)', 'count' => $statusCounts['APPROVED']   ?? 0],
            'VERIFIED'   => ['label' => 'Terverifikasi',   'icon' => 'fa-solid fa-circle-check',     'grad' => 'linear-gradient(135deg,#43e97b,#38f9d7)', 'count' => $statusCounts['VERIFIED']   ?? 0],
            'ASSIGNED'   => ['label' => 'Ditugaskan',      'icon' => 'fa-solid fa-user-tie',         'grad' => 'linear-gradient(135deg,#fa8231,#f7b733)', 'count' => $statusCounts['ASSIGNED']   ?? 0],
            'DONE'       => ['label' => 'Selesai',         'icon' => 'fa-solid fa-flag-checkered',   'grad' => 'linear-gradient(135deg,#a18cd1,#fbc2eb)', 'count' => $statusCounts['DONE']       ?? 0],
            'REJECTED'   => ['label' => 'Ditolak',         'icon' => 'fa-solid fa-ban',             'grad' => 'linear-gradient(135deg,#d63031,#ff6b6b)', 'count' => $statusCounts['REJECTED']   ?? 0],
        ];
        $statusConfig = [
            'REGISTERED' => ['badge' => '#4facfe', 'bg'  => 'rgba(79,172,254,.12)', 'label' => 'Terdaftar',     'icon' => 'fa-solid fa-file-circle-plus'],
            'APPROVED'   => ['badge' => '#2d98da', 'bg'  => 'rgba(45,152,218,.12)', 'label' => 'Disetujui',     'icon' => 'fa-solid fa-thumbs-up'],
            'VERIFIED'   => ['badge' => '#43e97b', 'bg'  => 'rgba(67,233,123,.12)', 'label' => 'Terverifikasi', 'icon' => 'fa-solid fa-circle-check'],
            'ASSIGNED'   => ['badge' => '#fa8231', 'bg'  => 'rgba(250,130,49,.12)', 'label' => 'Ditugaskan',    'icon' => 'fa-solid fa-user-tie'],
            'DONE'       => ['badge' => '#a18cd1', 'bg'  => 'rgba(161,140,209,.12)','label' => 'Selesai',       'icon' => 'fa-solid fa-flag-checkered'],
            'REJECTED'   => ['badge' => '#d63031', 'bg'  => 'rgba(214,48,49,.12)', 'label' => 'Ditolak',       'icon' => 'fa-solid fa-ban'],
        ];
    @endphp

    <style>
        /* ── Page Variables ── */
        :root {
            --radius-card : 16px;
            --radius-badge: 8px;
            --shadow-soft : 0 4px 24px rgba(0,0,0,.07);
            --shadow-hover: 0 8px 32px rgba(0,0,0,.13);
            --transition  : all .22s cubic-bezier(.4,0,.2,1);
        }

        /* ── Stat Cards ── */
        .stat-card {
            border-radius: var(--radius-card);
            border: none;
            overflow: hidden;
            cursor: pointer;
            text-decoration: none;
            display: block;
            box-shadow: var(--shadow-soft);
            transition: var(--transition);
            position: relative;
        }
        .stat-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-hover); }
        .stat-card.active-card { transform: translateY(-4px); box-shadow: var(--shadow-hover); }
        .stat-card.active-card::after {
            content: '';
            position: absolute; inset: 0;
            border-radius: var(--radius-card);
            border: 2.5px solid rgba(255,255,255,.55);
            pointer-events: none;
        }
        .stat-icon-wrap {
            width: 48px; height: 48px;
            border-radius: 12px;
            background: rgba(255,255,255,.2);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .stat-count { font-size: 2rem; font-weight: 800; line-height: 1; color: #fff; }
        .stat-label { font-size: .78rem; color: rgba(255,255,255,.85); font-weight: 500; margin-top: 2px; }

        /* ── Table Panel ── */
        .panel-card {
            border-radius: var(--radius-card);
            border: none;
            box-shadow: var(--shadow-soft);
            overflow: hidden;
        }
        .panel-header {
            padding: 18px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid rgba(0,0,0,.06);
        }
        [data-bs-theme="dark"] .panel-header { border-color: rgba(255,255,255,.07); }

        /* ── Table ── */
        .data-table { margin: 0; border-collapse: separate; border-spacing: 0; }
        .data-table thead th {
            font-size: .72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .6px;
            padding: 14px 16px;
            color: #8b9cb6;
            background: transparent;
            border-bottom: 1px solid rgba(0,0,0,.06);
            white-space: nowrap;
        }
        [data-bs-theme="dark"] .data-table thead th {
            color: #6b7a93;
            border-color: rgba(255,255,255,.07);
        }
        .data-table tbody tr {
            transition: var(--transition);
            border-bottom: 1px solid transparent;
        }
        .data-table tbody tr:hover { background: rgba(102,126,234,.04); }
        [data-bs-theme="dark"] .data-table tbody tr:hover { background: rgba(255,255,255,.03); }
        .data-table td { padding: 16px; vertical-align: middle; border: none; }

        /* ── No Registrasi Chip ── */
        .reg-chip {
            font-size: .73rem; font-weight: 700;
            letter-spacing: .8px;
            padding: 4px 10px;
            border-radius: 999px;
            background: linear-gradient(135deg,rgba(102,126,234,.15),rgba(118,75,162,.15));
            color: #667eea;
            border: 1px solid rgba(102,126,234,.25);
            white-space: nowrap;
        }
        [data-bs-theme="dark"] .reg-chip { color: #a5b4fc; background: rgba(165,180,252,.1); border-color: rgba(165,180,252,.2); }

        /* ── Status Pill ── */
        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 12px;
            border-radius: 999px;
            font-size: .75rem;
            font-weight: 700;
            white-space: nowrap;
        }
        .status-dot { width: 7px; height: 7px; border-radius: 50%; display: inline-block; }

        /* ── Workflow stepper ── */
        .wf-stepper { display: flex; align-items: center; gap: 4px; margin-top: 6px; }
        .wf-step {
            width: 22px; height: 4px; border-radius: 2px;
            background: rgba(0,0,0,.08);
            transition: var(--transition);
        }
        [data-bs-theme="dark"] .wf-step { background: rgba(255,255,255,.1); }
        .wf-step.done { opacity: 1; }

        /* ── Action Buttons ── */
        .action-btn {
            width: 32px; height: 32px;
            border-radius: 8px;
            border: 1px solid rgba(0,0,0,.08);
            background: transparent;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: .8rem;
            transition: var(--transition);
            text-decoration: none;
            cursor: pointer;
        }
        .action-btn:hover { background: rgba(0,0,0,.05); border-color: rgba(0,0,0,.15); transform: scale(1.08); }
        .action-btn.btn-view   { color: #4facfe; }
        .action-btn.btn-delete { color: #ef4444; }
        [data-bs-theme="dark"] .action-btn { border-color: rgba(255,255,255,.1); }
        [data-bs-theme="dark"] .action-btn:hover { background: rgba(255,255,255,.07); }

        /* ── CTA Button ── */
        .btn-cta {
            background: linear-gradient(135deg,#667eea,#764ba2);
            border: none;
            color: #fff;
            font-weight: 600;
            font-size: .83rem;
            padding: 9px 18px;
            border-radius: 10px;
            transition: var(--transition);
            display: inline-flex; align-items: center; gap: 7px;
            text-decoration: none;
            box-shadow: 0 4px 14px rgba(102,126,234,.4);
        }
        .btn-cta:hover { opacity: .92; transform: translateY(-1px); color: #fff; box-shadow: 0 6px 20px rgba(102,126,234,.5); }

        /* ── Empty State ── */
        .empty-state { padding: 72px 24px; text-align: center; }
        .empty-icon {
            width: 80px; height: 80px;
            border-radius: 20px;
            background: linear-gradient(135deg,rgba(102,126,234,.12),rgba(118,75,162,.12));
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 20px;
            font-size: 2rem;
            color: #667eea;
        }

        /* ── Search bar ── */
        .search-wrap { position: relative; }
        .search-wrap .search-icon {
            position: absolute; left: 12px; top: 50%; transform: translateY(-50%);
            color: #aab; font-size: .85rem; pointer-events: none;
        }
        .search-input {
            padding-left: 36px; border-radius: 10px;
            border: 1px solid rgba(0,0,0,.1);
            font-size: .83rem;
            height: 36px;
            background: transparent;
            transition: var(--transition);
        }
        .search-input:focus { border-color: #667eea; box-shadow: 0 0 0 3px rgba(102,126,234,.15); outline: none; }
        [data-bs-theme="dark"] .search-input { border-color: rgba(255,255,255,.1); color: #f1f1f1; }

        /* ── Pagination override ── */
        .pagination { margin: 0; }
        .page-link { border-radius: 8px !important; margin: 0 2px; font-size: .8rem; }

        /* ── Filter tab active line ── */
        .stat-card.active-card .active-indicator {
            position: absolute; bottom: 0; left: 0; right: 0;
            height: 3px; background: rgba(255,255,255,.6);
        }
    </style>

    {{-- ── STAT CARDS ── --}}
    <div class="row g-3 mb-4">
        @foreach($stats as $key => $s)
        @php $isActive = $activeFilter === $key; @endphp
        <div class="col-6 col-sm-4 col-xl">
            <a href="{{ $key === 'ALL' ? route('permohonan-litigasi.index') : route('permohonan-litigasi.index', ['status' => $key]) }}"
               class="stat-card {{ $isActive ? 'active-card' : '' }}"
               style="background: {{ $s['grad'] }};">
                @if($isActive)<div class="active-indicator"></div>@endif
                <div class="p-3 d-flex flex-column gap-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="stat-icon-wrap">
                            <i class="{{ $s['icon'] }} text-white" style="font-size:1.1rem;"></i>
                        </div>
                        @if($isActive)
                        <span style="background:rgba(255,255,255,.2);color:#fff;font-size:.65rem;font-weight:700;padding:2px 8px;border-radius:999px;letter-spacing:.5px;">
                            AKTIF
                        </span>
                        @endif
                    </div>
                    <div>
                        <div class="stat-count">{{ $s['count'] }}</div>
                        <div class="stat-label">{{ $s['label'] }}</div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>

    {{-- ── MAIN PANEL ── --}}
    <div class="panel-card" style="background: var(--bs-card-bg, #fff);">
        {{-- Header --}}
        <div class="panel-header">
            <div class="d-flex align-items-center gap-3">
                <div style="width:38px;height:38px;border-radius:10px;background:linear-gradient(135deg,#667eea,#764ba2);
                            display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="fa-solid fa-scale-balanced text-white" style="font-size:.9rem;"></i>
                </div>
                <div>
                    <h6 class="mb-0 fw-bold text-body" style="font-size:.95rem;">Daftar Permohonan Litigasi</h6>
                    <p class="mb-0 text-muted" style="font-size:.75rem;">
                        @if($activeFilter !== 'ALL')
                            Menampilkan filter: <strong>{{ $stats[$activeFilter]['label'] }}</strong> &bull;
                        @endif
                        {{ $permohonan->total() }} permohonan ditemukan
                    </p>
                </div>
            </div>
            <div class="d-flex align-items-center gap-2">
                {{-- Search form --}}
                <form method="GET" action="{{ route('permohonan-litigasi.index') }}" class="d-none d-md-block">
                    @if($activeFilter !== 'ALL')
                        <input type="hidden" name="status" value="{{ $activeFilter }}">
                    @endif
                    <div class="search-wrap">
                        <i class="fa-solid fa-magnifying-glass search-icon"></i>
                        <input type="text" name="search" value="{{ request('search') }}"
                               class="form-control search-input" placeholder="Cari nama / perkara…">
                    </div>
                </form>
                @if(!in_array(auth()->user()->role, ['pengacara', 'paralegal']))
                <a href="{{ route('permohonan-litigasi.create') }}" class="btn-cta">
                    <i class="fa-solid fa-plus"></i>
                    <span class="d-none d-sm-inline">Ajukan Permohonan</span>
                </a>
                @endif
            </div>
        </div>

        {{-- Table --}}
        <div class="table-responsive">
            <table class="data-table table">
                <thead>
                    <tr>
                        <th style="padding-left:24px;">No. Registrasi</th>
                        <th>Pemohon</th>
                        <th>Jenis Perkara</th>
                        <th>Status & Alur</th>
                        <th>Tgl. Kunjungan</th>
                        @if(auth()->user()->role === 'admin')
                        <th>Diajukan Oleh</th>
                        @endif
                        <th style="padding-right:24px; text-align:right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($permohonan as $item)
                    @php
                        $sc   = $statusConfig[$item->status] ?? $statusConfig['REGISTERED'];
                        $steps= ['REGISTERED','APPROVED','VERIFIED','ASSIGNED','DONE'];
                        $idx  = array_search($item->status, $steps);
                        $idx  = $idx === false ? -1 : $idx;
                        $stepColors = ['#4facfe','#2d98da','#43e97b','#fa8231','#a18cd1'];
                    @endphp
                    <tr>
                        {{-- No Registrasi --}}
                        <td style="padding-left:24px;">
                            <span class="reg-chip">{{ $item->no_registrasi ?? '—' }}</span>
                        </td>

                        {{-- Nama --}}
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div style="width:34px;height:34px;border-radius:10px;
                                            background:linear-gradient(135deg,rgba(102,126,234,.15),rgba(118,75,162,.15));
                                            display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                    <i class="fa-solid fa-user text-primary" style="font-size:.75rem;"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold text-body" style="font-size:.87rem;">{{ $item->nama }}</div>
                                    <div class="text-muted" style="font-size:.72rem;">NIK: {{ substr($item->nik, 0, 6) }}••••••</div>
                                </div>
                            </div>
                        </td>

                        {{-- Jenis Perkara --}}
                        <td>
                            <span class="text-body fw-medium" style="font-size:.83rem;">{{ $item->jenis_perkara }}</span>
                            <div class="text-muted" style="font-size:.72rem;">No. {{ $item->no_perkara }}</div>
                        </td>

                        {{-- Status + Workflow --}}
                        <td>
                            <span class="status-pill"
                                  style="background:{{ $sc['bg'] }};color:{{ $sc['badge'] }};border:1px solid {{ $sc['badge'] }}22;">
                                <span class="status-dot" style="background:{{ $sc['badge'] }};box-shadow:0 0 0 2px {{ $sc['badge'] }}33;"></span>
                                <i class="{{ $item->getStatusIcon() }}" style="font-size:.7rem;"></i>
                                {{ $sc['label'] }}
                            </span>
                            {{-- Workflow stepper --}}
                            <div class="wf-stepper" title="Progress alur: {{ implode(' → ', array_map(fn($s) => $statusConfig[$s]['label'], $steps)) }}">
                                @foreach($steps as $i => $step)
                                    <div class="wf-step {{ $i <= $idx ? 'done' : '' }}"
                                         style="{{ $i <= $idx ? 'background:'.$stepColors[$i].';' : '' }}"></div>
                                @endforeach
                            </div>
                        </td>

                        {{-- Tgl Kunjungan --}}
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div style="width:30px;height:30px;border-radius:8px;
                                            background:rgba(250,130,49,.1);
                                            display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                    <i class="fa-solid fa-calendar-days" style="font-size:.75rem;color:#fa8231;"></i>
                                </div>
                                <div>
                                    <div class="fw-medium text-body" style="font-size:.82rem;">
                                        {{ $item->tgl_rencana_kunjungan->format('d M Y') }}
                                    </div>
                                    <div class="text-muted" style="font-size:.7rem;">
                                        {{ $item->tgl_rencana_kunjungan->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        </td>

                        {{-- Diajukan Oleh (admin only) --}}
                        @if(auth()->user()->role === 'admin')
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($item->user->name ?? 'U') }}&background=667eea&color=fff&size=28"
                                     width="28" height="28" class="rounded-circle" alt="">
                                <span class="text-body" style="font-size:.8rem;">{{ $item->user->name ?? '—' }}</span>
                            </div>
                        </td>
                        @endif

                        {{-- Actions --}}
                        <td style="padding-right:24px; text-align:right;">
                            <div class="d-flex justify-content-end align-items-center gap-1">
                                <a href="{{ route('permohonan-litigasi.show', $item) }}"
                                   class="action-btn btn-view" title="Lihat Detail">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                @if(auth()->user()->role === 'admin')
                                <button type="button" class="action-btn btn-delete"
                                        title="Hapus"
                                        onclick="confirmDelete('{{ route('permohonan-litigasi.destroy', $item) }}')">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="{{ auth()->user()->role === 'admin' ? 7 : 6 }}">
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <i class="fa-solid fa-folder-open"></i>
                                </div>
                                <h6 class="fw-bold text-body mb-1">Belum Ada Permohonan</h6>
                                <p class="text-muted mb-4" style="font-size:.85rem;">
                                    @if($activeFilter !== 'ALL')
                                        Tidak ada permohonan dengan status <strong>{{ $stats[$activeFilter]['label'] }}</strong>.
                                    @else
                                        Anda belum memiliki permohonan litigasi. Ajukan yang pertama sekarang!
                                    @endif
                                </p>
                                <a href="{{ route('permohonan-litigasi.create') }}" class="btn-cta" style="margin:auto;width:fit-content;">
                                    <i class="fa-solid fa-plus"></i> Ajukan Permohonan
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($permohonan->hasPages())
        <div style="padding:16px 24px;border-top:1px solid rgba(0,0,0,.06);" class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <span class="text-muted" style="font-size:.78rem;">
                Menampilkan {{ $permohonan->firstItem() }}–{{ $permohonan->lastItem() }} dari {{ $permohonan->total() }} data
            </span>
            {{ $permohonan->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>

    {{-- Hidden delete form --}}
    <form id="deleteForm" method="POST" style="display:none;">
        @csrf @method('DELETE')
    </form>

    <script>
        function confirmDelete(action) {
            if (!confirm('Yakin ingin menghapus permohonan ini? Tindakan tidak dapat dibatalkan.')) return;
            const form = document.getElementById('deleteForm');
            form.action = action;
            form.submit();
        }
    </script>
</x-app-layout>
