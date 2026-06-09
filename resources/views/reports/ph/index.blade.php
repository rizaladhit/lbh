<x-app-layout>
    @php
        $isTypePengadilan = $type === 'pengadilan';
        $isTypeLapas = $type === 'lapas';
        $typeLabel = $isTypePengadilan ? 'Pengadilan Subang' : ($isTypeLapas ? 'Lapas Subang' : 'PH');
        $headerTitle = "Daftar Laporan {$typeLabel}";
        $cardTitle = "Daftar Laporan {$typeLabel}";
        $createButtonRoute = $isTypePengadilan ? 'laporan-ph.pengadilan.create' : 'laporan-ph.lapas.create';
        $indexRoute = $isTypePengadilan ? 'laporan-ph.pengadilan.index' : 'laporan-ph.lapas.index';
        $printRoute = $isTypePengadilan ? 'laporan-ph.pengadilan.print' : 'laporan-ph.lapas.print';
        $printParams = array_filter(request()->only(['date_from', 'date_to']));
        $emptyMessage = $isTypePengadilan ? 'Belum ada laporan pengadilan.' : ($isTypeLapas ? 'Belum ada laporan lapas.' : 'Belum ada laporan.');
    @endphp
    
    <x-slot name="header">{{ $headerTitle }}</x-slot>

    <style>
        :root {
            --radius-card: 16px;
            --shadow-soft: 0 4px 24px rgba(0,0,0,.07);
            --shadow-hover: 0 8px 32px rgba(0,0,0,.13);
            --transition: all .22s cubic-bezier(.4,0,.2,1);
        }

        .stat-card {
            border-radius: var(--radius-card);
            border: none;
            overflow: hidden;
            display: block;
            box-shadow: var(--shadow-soft);
            transition: var(--transition);
            position: relative;
            min-height: 132px;
        }
        .stat-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-hover); }
        .stat-icon-wrap {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: rgba(255,255,255,.2);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .stat-count { font-size: 2rem; font-weight: 800; line-height: 1; color: #fff; }
        .stat-label { font-size: .78rem; color: rgba(255,255,255,.85); font-weight: 500; margin-top: 2px; }

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
        .data-table tbody tr { transition: var(--transition); }
        .data-table tbody tr:hover { background: rgba(16,185,129,.04); }
        [data-bs-theme="dark"] .data-table tbody tr:hover { background: rgba(255,255,255,.03); }
        .data-table td { padding: 16px; vertical-align: middle; border: none; }

        .reg-chip {
            font-size: .73rem;
            font-weight: 700;
            letter-spacing: .8px;
            padding: 4px 10px;
            border-radius: 999px;
            background: linear-gradient(135deg,rgba(16,185,129,.15),rgba(5,150,105,.15));
            color: #10b981;
            border: 1px solid rgba(16,185,129,.25);
            white-space: nowrap;
        }
        [data-bs-theme="dark"] .reg-chip { color: #6ee7b7; background: rgba(110,231,183,.1); border-color: rgba(110,231,183,.2); }

        .info-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 12px;
            border-radius: 999px;
            font-size: .75rem;
            font-weight: 700;
            white-space: nowrap;
            background: rgba(16,185,129,.12);
            color: #10b981;
            border: 1px solid rgba(16,185,129,.22);
        }

        .btn-cta {
            background: linear-gradient(135deg,#10b981,#059669);
            border: none;
            color: #fff;
            font-weight: 600;
            font-size: .83rem;
            padding: 9px 18px;
            border-radius: 10px;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 7px;
            text-decoration: none;
            box-shadow: 0 4px 14px rgba(16,185,129,.35);
        }
        .btn-cta:hover { opacity: .92; transform: translateY(-1px); color: #fff; box-shadow: 0 6px 20px rgba(16,185,129,.45); }

        .btn-print {
            background: linear-gradient(135deg,#4facfe,#00b8d9);
            border: none;
            color: #fff;
            font-weight: 600;
            font-size: .83rem;
            padding: 9px 18px;
            border-radius: 10px;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 7px;
            text-decoration: none;
            box-shadow: 0 4px 14px rgba(79,172,254,.32);
        }
        .btn-print:hover { opacity: .92; transform: translateY(-1px); color: #fff; box-shadow: 0 6px 20px rgba(79,172,254,.42); }

        .filter-form {
            display: flex;
            align-items: end;
            gap: 10px;
            flex-wrap: wrap;
        }
        .filter-field label {
            display: block;
            margin-bottom: 4px;
            color: #94a3b8;
            font-size: .68rem;
            font-weight: 700;
            letter-spacing: .5px;
            text-transform: uppercase;
        }
        .filter-input {
            border-radius: 10px;
            border: 1px solid rgba(0,0,0,.1);
            font-size: .83rem;
            height: 38px;
            background: transparent;
            transition: var(--transition);
            min-width: 150px;
        }
        .filter-input:focus { border-color: #10b981; box-shadow: 0 0 0 3px rgba(16,185,129,.15); outline: none; }
        [data-bs-theme="dark"] .filter-input { border-color: rgba(255,255,255,.1); color: #f1f1f1; }

        .empty-state { padding: 72px 24px; text-align: center; }
        .empty-icon {
            width: 80px;
            height: 80px;
            border-radius: 20px;
            background: linear-gradient(135deg,rgba(16,185,129,.12),rgba(5,150,105,.12));
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 2rem;
            color: #10b981;
        }
    </style>

    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="stat-card" style="background: linear-gradient(135deg,#10b981,#059669);">
                <div class="p-3 d-flex flex-column gap-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="stat-icon-wrap">
                            <i class="fa-solid fa-file-lines text-white" style="font-size:1.1rem;"></i>
                        </div>
                    </div>
                    <div>
                        <div class="stat-count">{{ $reports->total() }}</div>
                        <div class="stat-label">Total Laporan {{ $typeLabel }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="stat-card" style="background: linear-gradient(135deg,#4facfe,#00f2fe);">
                <div class="p-3 d-flex flex-column gap-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="stat-icon-wrap">
                            <i class="fa-solid fa-building-columns text-white" style="font-size:1.1rem;"></i>
                        </div>
                    </div>
                    <div>
                        <div class="stat-count">{{ $reports->count() }}</div>
                        <div class="stat-label">Ditampilkan di Halaman Ini</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-4">
            <a href="{{ route($createButtonRoute) }}" class="stat-card text-decoration-none" style="background: linear-gradient(135deg,#fa8231,#f7b733);">
                <div class="p-3 d-flex flex-column gap-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="stat-icon-wrap">
                            <i class="fa-solid fa-plus text-white" style="font-size:1.1rem;"></i>
                        </div>
                    </div>
                    <div>
                        <div class="stat-count" style="font-size:1.35rem;">Buat Baru</div>
                        <div class="stat-label">Tambah laporan penasehat hukum</div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="panel-card" style="background: var(--bs-card-bg, #fff);">
        <div class="panel-header flex-wrap gap-3">
            <div class="d-flex align-items-center gap-3">
                <div style="width:38px;height:38px;border-radius:10px;background:linear-gradient(135deg,#10b981,#059669);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="fa-solid fa-file-signature text-white" style="font-size:.9rem;"></i>
                </div>
                <div>
                    <h6 class="mb-0 fw-bold text-body" style="font-size:.95rem;">{{ $cardTitle }}</h6>
                    <p class="mb-0 text-muted" style="font-size:.75rem;">{{ $reports->total() }} laporan ditemukan</p>
                </div>
            </div>
            <div class="d-flex align-items-end gap-2 flex-wrap ms-auto">
                <form method="GET" action="{{ route($indexRoute) }}" class="filter-form">
                    <div class="filter-field">
                        <label for="date_from">Dari</label>
                        <input id="date_from" name="date_from" type="date" class="form-control filter-input" value="{{ request('date_from') }}">
                    </div>
                    <div class="filter-field">
                        <label for="date_to">Sampai</label>
                        <input id="date_to" name="date_to" type="date" class="form-control filter-input" value="{{ request('date_to') }}">
                    </div>
                    <button type="submit" class="btn-cta">
                        <i class="fa-solid fa-filter"></i><span class="d-none d-sm-inline">Filter</span>
                    </button>
                </form>
                @if(request()->filled('date_from') || request()->filled('date_to'))
                <a href="{{ route($indexRoute) }}" class="btn btn-light border fw-medium" style="height:38px;border-radius:10px;font-size:.83rem;display:inline-flex;align-items:center;">
                    Reset
                </a>
                @endif
                <a href="{{ route($printRoute, $printParams) }}" target="_blank" class="btn-print">
                    <i class="fa-solid fa-print"></i><span class="d-none d-sm-inline">Print</span>
                </a>
                <a href="{{ route($createButtonRoute) }}" class="btn-cta">
                    <i class="fa-solid fa-plus"></i><span class="d-none d-sm-inline">Buat Laporan</span>
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="data-table table">
                <thead>
                    <tr>
                        <th style="padding-left:24px;">No</th>
                        <th>No. Registrasi</th>
                        <th>Nama Terdakwa</th>
                        <th>Jaksa</th>
                        <th>Penasehat Hukum</th>
                        <th>Jenis Perkara</th>
                        <th style="padding-right:24px;">Dibuat</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reports as $i => $r)
                    <tr>
                        <td style="padding-left:24px;">
                            <span class="text-muted fw-semibold" style="font-size:.8rem;">{{ $reports->firstItem() + $i }}</span>
                        </td>
                        <td>
                            <span class="reg-chip">{{ $r->no_registrasi_perkara ?: '-' }}</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div style="width:34px;height:34px;border-radius:10px;background:linear-gradient(135deg,rgba(16,185,129,.15),rgba(5,150,105,.15));display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                    <i class="fa-solid fa-user" style="color:#10b981;font-size:.75rem;"></i>
                                </div>
                                <div class="fw-semibold text-body" style="font-size:.87rem;">{{ $r->nama ?: '-' }}</div>
                            </div>
                        </td>

                        <td>
                            <span class="text-body fw-medium" style="font-size:.83rem;">{{ $r->nama_jaksa ?: '-' }}</span>
                        </td>
                        <td>
                            <span class="text-body fw-medium" style="font-size:.83rem;">{{ $r->nama_penasehat_hukum ?: '-' }}</span>
                        </td>
                        <td>
                            <span class="info-chip">
                                <i class="fa-solid fa-scale-balanced" style="font-size:.7rem;"></i>
                                {{ $r->jenis_perkara ?: '-' }}
                            </span>
                        </td>
                        <td style="padding-right:24px;">
                            <div class="d-flex align-items-center gap-2">
                                <div style="width:30px;height:30px;border-radius:8px;background:rgba(250,130,49,.1);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                    <i class="fa-solid fa-calendar-days" style="font-size:.75rem;color:#fa8231;"></i>
                                </div>
                                <div>
                                    <div class="fw-medium text-body" style="font-size:.82rem;">{{ $r->created_at->format('d M Y') }}</div>
                                    <div class="text-muted" style="font-size:.7rem;">{{ $r->created_at->diffForHumans() }}</div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <div class="empty-icon"><i class="fa-solid fa-folder-open"></i></div>
                                <h6 class="fw-bold text-body mb-1">Belum Ada Laporan</h6>
                                <p class="text-muted mb-4" style="font-size:.85rem;">{{ $emptyMessage }}</p>
                                <a href="{{ route($createButtonRoute) }}" class="btn-cta" style="margin:auto;width:fit-content;">
                                    <i class="fa-solid fa-plus"></i> Buat Sekarang
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($reports->hasPages())
        <div style="padding:16px 24px;border-top:1px solid rgba(0,0,0,.05);display:flex;justify-content:space-between;align-items:center;gap:16px;flex-wrap:wrap;">
            <span style="font-size:.75rem;color:#94a3b8;">Halaman {{ $reports->currentPage() }} dari {{ $reports->lastPage() }}</span>
            {{ $reports->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>
</x-app-layout>
