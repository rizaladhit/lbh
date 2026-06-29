<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'LBH') }} — Panel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <script>
        const savedTheme = localStorage.getItem('lbh-theme') || 'light';
        document.documentElement.setAttribute('data-bs-theme', savedTheme);
    </script>

    <style>
        /* ════ TOKENS ════ */
        :root {
            --brand-1: #6366f1;
            --brand-2: #8b5cf6;
            --brand-grad: linear-gradient(135deg, var(--brand-1), var(--brand-2));
            --sidebar-w: 268px;
            --radius: 14px;
            --radius-sm: 8px;
            --shadow: 0 4px 24px rgba(0,0,0,.07);
            --shadow-md: 0 8px 32px rgba(0,0,0,.12);
            --trans: all .2s cubic-bezier(.4,0,.2,1);
            --font: 'Inter', system-ui, sans-serif;
        }

        /* ════ BASE ════ */
        *, *::before, *::after { box-sizing: border-box; }
        body {
            font-family: var(--font);
            background: #f4f5f9;
            overflow-x: hidden;
            font-size: 14px;
        }
        [data-bs-theme="dark"] body { background: #0f1117; }

        /* ════ SIDEBAR ════ */
        .sidebar {
            width: var(--sidebar-w);
            position: fixed; top: 0; left: 0; bottom: 0;
            z-index: 1050;
            display: flex; flex-direction: column;
            background: #fff;
            border-right: 1px solid rgba(0,0,0,.07);
            overflow-y: auto;
            overflow-x: hidden;
            transition: transform .3s cubic-bezier(.4,0,.2,1);
        }
        [data-bs-theme="dark"] .sidebar { background: #161b2e; border-color: rgba(255,255,255,.06); }

        .sidebar-logo {
            display: flex; align-items: center; gap: 10px;
            padding: 22px 20px 16px;
            text-decoration: none;
            border-bottom: 1px solid rgba(0,0,0,.06);
        }
        [data-bs-theme="dark"] .sidebar-logo { border-color: rgba(255,255,255,.06); }
        .sidebar-logo-icon {
            width: 36px; height: 36px; border-radius: 10px;
            background: var(--brand-grad);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(99,102,241,.35);
        }
        .sidebar-logo-text { font-size: .93rem; font-weight: 700; color: #1a1d2e; line-height: 1.2; }
        [data-bs-theme="dark"] .sidebar-logo-text { color: #f1f5f9; }
        .sidebar-logo-sub { font-size: .68rem; font-weight: 500; color: #94a3b8; }

        .sidebar-section {
            padding: 18px 14px 4px;
            font-size: .63rem;
            font-weight: 700;
            letter-spacing: .8px;
            text-transform: uppercase;
            color: #94a3b8;
        }

        .nav-item-custom { margin: 2px 10px; }
        .nav-link-custom {
            display: flex; align-items: center; gap: 10px;
            padding: 9px 12px;
            border-radius: var(--radius-sm);
            color: #64748b;
            font-weight: 500;
            font-size: .83rem;
            text-decoration: none;
            transition: var(--trans);
            cursor: pointer;
            border: none; background: none; width: 100%;
        }
        .nav-link-custom:hover { background: rgba(99,102,241,.07); color: var(--brand-1); }
        .nav-link-custom.active {
            background: rgba(99,102,241,.1);
            color: var(--brand-1);
            font-weight: 600;
        }
        [data-bs-theme="dark"] .nav-link-custom { color: #94a3b8; }
        [data-bs-theme="dark"] .nav-link-custom:hover { background: rgba(99,102,241,.12); color: #a5b4fc; }
        [data-bs-theme="dark"] .nav-link-custom.active { background: rgba(99,102,241,.15); color: #a5b4fc; }

        .nav-icon {
            width: 28px; height: 28px; border-radius: 7px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0; font-size: .75rem;
            transition: var(--trans);
        }

        .submenu-wrap { overflow: hidden; }
        .submenu-inner { padding: 2px 0 6px 48px; }
        .submenu-inner .nav-link-custom { font-size: .8rem; padding: 6px 10px; }

        .sidebar-footer {
            margin-top: auto;
            padding: 12px;
            border-top: 1px solid rgba(0,0,0,.06);
        }
        [data-bs-theme="dark"] .sidebar-footer { border-color: rgba(255,255,255,.06); }

        .user-card {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 12px;
            border-radius: var(--radius-sm);
            background: rgba(99,102,241,.06);
            text-decoration: none;
            cursor: pointer;
            border: none; width: 100%; text-align: left;
            position: relative;
        }
        .user-card:hover { background: rgba(99,102,241,.1); }
        .user-avatar {
            width: 34px; height: 34px; border-radius: 9px;
            flex-shrink: 0; object-fit: cover;
        }
        .user-name { font-size: .8rem; font-weight: 600; color: #1e293b; }
        [data-bs-theme="dark"] .user-name { color: #f1f5f9; }
        .user-role {
            font-size: .67rem; font-weight: 500;
            color: var(--brand-1);
            background: rgba(99,102,241,.1);
            padding: 1px 7px; border-radius: 99px;
        }

        /* ════ MAIN CONTENT ════ */
        .main-content {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            display: flex; flex-direction: column;
        }
        .topbar {
            position: sticky; top: 0; z-index: 100;
            padding: 14px 28px;
            background: rgba(244,245,249,.85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0,0,0,.06);
            display: flex; align-items: center; justify-content: space-between;
        }
        [data-bs-theme="dark"] .topbar {
            background: rgba(15,17,23,.85);
            border-color: rgba(255,255,255,.06);
        }
        .topbar-title { font-size: 1.05rem; font-weight: 700; color: #1e293b; }
        [data-bs-theme="dark"] .topbar-title { color: #f1f5f9; }
        .topbar-sub { font-size: .72rem; color: #94a3b8; margin-top: 1px; }

        .page-body { padding: 28px; flex: 1; }

        /* ════ THEME TOGGLE ════ */
        .theme-toggle {
            width: 34px; height: 34px; border-radius: 9px;
            border: 1px solid rgba(0,0,0,.08);
            background: #fff;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; font-size: .85rem; color: #64748b;
            transition: var(--trans);
        }
        .theme-toggle:hover { background: rgba(99,102,241,.08); color: var(--brand-1); }
        [data-bs-theme="dark"] .theme-toggle { background: #1e293b; border-color: rgba(255,255,255,.1); color: #94a3b8; }

        /* ════ MOBILE ════ */
        .mobile-header {
            display: none;
            position: sticky; top: 0; z-index: 200;
            padding: 12px 16px;
            background: #fff;
            border-bottom: 1px solid rgba(0,0,0,.07);
            align-items: center; justify-content: space-between;
        }
        [data-bs-theme="dark"] .mobile-header { background: #161b2e; border-color: rgba(255,255,255,.06); }
        .hamburger {
            width: 36px; height: 36px; border-radius: 9px;
            border: 1px solid rgba(0,0,0,.08);
            background: transparent;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; color: #64748b;
        }
        .sidebar-overlay {
            display: none;
            position: fixed; inset: 0; z-index: 1040;
            background: rgba(0,0,0,.4);
            backdrop-filter: blur(2px);
        }
        @media (max-width: 991px) {
            .sidebar { transform: translateX(-100%); box-shadow: none; }
            .sidebar.open { transform: translateX(0); box-shadow: var(--shadow-md); }
            .sidebar-overlay.open { display: block; }
            .main-content { margin-left: 0; }
            .mobile-header { display: flex; }
            .topbar { display: none; }
            .page-body { padding: 16px; }
        }

        /* ════ ALERTS ════ */
        .alert-modern {
            border: none; border-radius: var(--radius-sm);
            padding: 12px 16px;
            display: flex; align-items: center; gap: 12px;
            font-size: .83rem; font-weight: 500;
            box-shadow: 0 2px 12px rgba(0,0,0,.07);
        }
        .alert-modern.alert-success { background: rgba(16,185,129,.1); color: #065f46; border-left: 3px solid #10b981; }
        .alert-modern.alert-danger  { background: rgba(239,68,68,.1);  color: #991b1b; border-left: 3px solid #ef4444; }
        [data-bs-theme="dark"] .alert-modern.alert-success { background: rgba(16,185,129,.12); color: #6ee7b7; }
        [data-bs-theme="dark"] .alert-modern.alert-danger  { background: rgba(239,68,68,.12);  color: #fca5a5; }

        /* ════ GLOBAL CARD ════ */
        .card { border: none; border-radius: var(--radius); box-shadow: var(--shadow); }
        [data-bs-theme="dark"] .card { background: #1a2035; }
        .card-header { background: transparent; border-color: rgba(0,0,0,.06); }
        [data-bs-theme="dark"] .card-header { border-color: rgba(255,255,255,.06); }

        /* ════ SCROLLBAR ════ */
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(99,102,241,.25); border-radius: 99px; }
    </style>
</head>
<body>

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- ── SIDEBAR ── -->
<aside class="sidebar" id="sidebar">
    <!-- Logo -->
    <a href="{{ route('dashboard') }}" class="sidebar-logo">
        <div class="sidebar-logo-icon">
            @if(isset($appSetting) && $appSetting->logo_path)
                <img src="{{ Storage::url($appSetting->logo_path) }}" alt="Logo" style="height:22px;width:22px;object-fit:contain;">
            @else
                <i class="fa-solid fa-scale-balanced text-white" style="font-size:.85rem;"></i>
            @endif
        </div>
        <div>
            <div class="sidebar-logo-text">{{ isset($appSetting) ? $appSetting->app_name : 'LBH' }}</div>
            <div class="sidebar-logo-sub">{{ isset($appSetting) && $appSetting->description ? $appSetting->description : 'Sistem Manajemen Bantuan Hukum' }}</div>
        </div>
    </a>

    <!-- Nav -->
    <div style="flex:1;padding-top:8px;">
        <div class="sidebar-section">Menu Utama</div>

        <div class="nav-item-custom">
            <a href="{{ route('dashboard') }}"
               class="nav-link-custom {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <div class="nav-icon" style="background:{{ request()->routeIs('dashboard') ? 'rgba(99,102,241,.15)' : 'rgba(100,116,139,.08)' }};">
                    <i class="fa-solid fa-chart-pie" style="color:{{ request()->routeIs('dashboard') ? 'var(--brand-1)' : '#64748b' }};"></i>
                </div>
                Dashboard
            </a>
        </div>

        {{-- SIMBAKUM - visible to admin, pengacara, paralegal --}}
        @if(auth()->check() && in_array(auth()->user()->role, ['admin', 'pengacara', 'paralegal']))
        <div class="nav-item-custom">
            <a href="{{ route('simbakum.index') }}"
               class="nav-link-custom {{ request()->routeIs('simbakum.*') ? 'active' : '' }}">
                <div class="nav-icon" style="background:{{ request()->routeIs('simbakum.*') ? 'rgba(99,102,241,.15)' : 'rgba(100,116,139,.08)' }};">
                    <i class="fa-solid fa-scale-balanced" style="color:{{ request()->routeIs('simbakum.*') ? 'var(--brand-1)' : '#64748b' }};"></i>
                </div>
                SIMBAKUM
            </a>
        </div>
        @endif

        {{-- Case Reports (Laporan BPHN) - removed per request --}}

        <div class="sidebar-section" style="margin-top:4px;">Form Permohonan</div>

        <!-- Permohonan Submenu -->
        <div class="nav-item-custom">
            <button class="nav-link-custom {{ request()->routeIs('permohonan-*') ? 'active' : '' }}"
                    onclick="toggleSubmenu('permohonanMenu', this)">
                <div class="nav-icon" style="background:{{ request()->routeIs('permohonan-*') ? 'rgba(16,185,129,.15)' : 'rgba(100,116,139,.08)' }};">
                    <i class="fa-solid fa-file-pen" style="color:{{ request()->routeIs('permohonan-*') ? '#10b981' : '#64748b' }};"></i>
                </div>
                Form Permohonan
                <i class="fa-solid fa-chevron-right ms-auto" style="font-size:.6rem;transition:var(--trans);" id="permohonanMenuArrow"></i>
            </button>
            <div class="submenu-wrap" id="permohonanMenu" style="display:{{ request()->routeIs('permohonan-*') ? 'block' : 'none' }};">
                <div class="submenu-inner">
                    <div class="nav-item-custom" style="margin:0;">
                        <a href="{{ route('permohonan-litigasi.index') }}"
                           class="nav-link-custom {{ request()->routeIs('permohonan-litigasi.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-scale-balanced me-2" style="width:14px;color:#6366f1;font-size:.75rem;"></i>
                            Bantuan Litigasi
                        </a>
                    </div>
                    <div class="nav-item-custom" style="margin:0;">
                        <a href="{{ route('permohonan-non-litigasi.index') }}"
                           class="nav-link-custom {{ request()->routeIs('permohonan-non-litigasi.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-handshake me-2" style="width:14px;color:#10b981;font-size:.75rem;"></i>
                            Bantuan Non-Litigasi
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Laporan BPHN & Drafting Dokumen Hukum - Admin Only --}}
        @if(auth()->check() && auth()->user()->role == 'admin')
        <div class="nav-item-custom">
            <button class="nav-link-custom {{ request()->routeIs('drafting-reports.*') || request()->routeIs('mediasi-reports.*') || request()->routeIs('negosiasi-reports.*') || request()->routeIs('pemberdayaan-masyarakat.*') || request()->routeIs('reimbursement-reports.create-pemberdayaan') || request()->routeIs('pendampingan-reports.*') || request()->routeIs('penelitian-hukum-reports.*') || request()->routeIs('penyuluhan-hukum-reports.*') || request()->routeIs('perdata-reports.*') || request()->routeIs('pidana-reports.*') || request()->routeIs('tun-reports.*') || request()->routeIs('konsultasi-hukum-reports.*') || request()->routeIs('investigasi-kasus-reports.*') ? 'active' : '' }}"
                    onclick="toggleSubmenu('bphnMenu', this)">
                <div class="nav-icon" style="background:{{ request()->routeIs('drafting-reports.*') || request()->routeIs('mediasi-reports.*') || request()->routeIs('negosiasi-reports.*') || request()->routeIs('pemberdayaan-masyarakat.*') || request()->routeIs('reimbursement-reports.create-pemberdayaan') || request()->routeIs('pendampingan-reports.*') || request()->routeIs('penelitian-hukum-reports.*') || request()->routeIs('penyuluhan-hukum-reports.*') || request()->routeIs('perdata-reports.*') || request()->routeIs('pidana-reports.*') || request()->routeIs('tun-reports.*') || request()->routeIs('konsultasi-hukum-reports.*') || request()->routeIs('investigasi-kasus-reports.*') ? 'rgba(99,102,241,.15)' : 'rgba(100,116,139,.08)' }};">
                    <i class="fa-solid fa-book-bookmark" style="color:{{ request()->routeIs('drafting-reports.*') || request()->routeIs('mediasi-reports.*') || request()->routeIs('negosiasi-reports.*') || request()->routeIs('pemberdayaan-masyarakat.*') || request()->routeIs('reimbursement-reports.create-pemberdayaan') || request()->routeIs('pendampingan-reports.*') || request()->routeIs('penelitian-hukum-reports.*') || request()->routeIs('penyuluhan-hukum-reports.*') || request()->routeIs('perdata-reports.*') || request()->routeIs('pidana-reports.*') || request()->routeIs('tun-reports.*') || request()->routeIs('konsultasi-hukum-reports.*') || request()->routeIs('investigasi-kasus-reports.*') ? 'var(--brand-1)' : '#64748b' }};"></i>
                </div>
                Laporan BPHN/KANWIL
                <i class="fa-solid fa-chevron-right ms-auto" style="font-size:.6rem;transition:var(--trans);" id="bphnMenuArrow"></i>
            </button>
            <div class="submenu-wrap" id="bphnMenu" style="display:{{ request()->routeIs('drafting-reports.*') || request()->routeIs('mediasi-reports.*') || request()->routeIs('negosiasi-reports.*') || request()->routeIs('pemberdayaan-masyarakat.*') || request()->routeIs('reimbursement-reports.create-pemberdayaan') || request()->routeIs('pendampingan-reports.*') || request()->routeIs('penelitian-hukum-reports.*') || request()->routeIs('penyuluhan-hukum-reports.*') || request()->routeIs('perdata-reports.*') || request()->routeIs('pidana-reports.*') || request()->routeIs('tun-reports.*') || request()->routeIs('konsultasi-hukum-reports.*') || request()->routeIs('investigasi-kasus-reports.*') ? 'block' : 'none' }};">
                <div class="submenu-inner">
                    <div class="nav-item-custom" style="margin:0;">
                        <a href="{{ route('drafting-reports.index') }}"
                           class="nav-link-custom {{ request()->routeIs('drafting-reports.*') ? 'active' : '' }}">
                            <i class="fa-regular fa-file-lines me-2" style="width:14px;color:#6366f1;font-size:.75rem;"></i>
                            Drafting Dokumen Hukum
                        </a>
                    </div>
                    <div class="nav-item-custom" style="margin:0;">
                        <a href="{{ route('mediasi-reports.index') }}"
                           class="nav-link-custom {{ request()->routeIs('mediasi-reports.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-handshake me-2" style="width:14px;color:#6366f1;font-size:.75rem;"></i>
                            Laporan Mediasi
                        </a>
                    </div>
                    <div class="nav-item-custom" style="margin:0;">
                        <a href="{{ route('pemberdayaan-masyarakat.index') }}"
                           class="nav-link-custom {{ request()->routeIs('pemberdayaan-masyarakat.*') || request()->routeIs('reimbursement-reports.create-pemberdayaan') ? 'active' : '' }}">
                            <i class="fa-solid fa-person-chalkboard me-2" style="width:14px;color:#6366f1;font-size:.75rem;"></i>
                            Pemberdayaan Masyarakat
                        </a>
                    </div>
                    <div class="nav-item-custom" style="margin:0;">
                        <a href="{{ route('negosiasi-reports.index') }}"
                           class="nav-link-custom {{ request()->routeIs('negosiasi-reports.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-file-signature me-2" style="width:14px;color:#6366f1;font-size:.75rem;"></i>
                            Laporan Negosiasi
                        </a>
                    </div>
                    <div class="nav-item-custom" style="margin:0;">
                        <a href="{{ route('pendampingan-reports.index') }}"
                           class="nav-link-custom {{ request()->routeIs('pendampingan-reports.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-scale-balanced me-2" style="width:14px;color:#6366f1;font-size:.75rem;"></i>
                            Pendampingan Diluar Pengadilan
                        </a>
                    </div>
                    <div class="nav-item-custom" style="margin:0;">
                        <a href="{{ route('penelitian-hukum-reports.index') }}"
                           class="nav-link-custom {{ request()->routeIs('penelitian-hukum-reports.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-microscope me-2" style="width:14px;color:#6366f1;font-size:.75rem;"></i>
                            Penelitian Hukum
                        </a>
                    </div>
                    <div class="nav-item-custom" style="margin:0;">
                        <a href="{{ route('penyuluhan-hukum-reports.index') }}"
                           class="nav-link-custom {{ request()->routeIs('penyuluhan-hukum-reports.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-chalkboard-user me-2" style="width:14px;color:#6366f1;font-size:.75rem;"></i>
                            Penyuluhan Hukum
                        </a>
                    </div>
                    <div class="nav-item-custom" style="margin:0;">
                        <a href="{{ route('perdata-reports.index') }}"
                           class="nav-link-custom {{ request()->routeIs('perdata-reports.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-gavel me-2" style="width:14px;color:#6366f1;font-size:.75rem;"></i>
                            Perdata
                        </a>
                    </div>
                    <div class="nav-item-custom" style="margin:0;">
                        <a href="{{ route('pidana-reports.index') }}"
                           class="nav-link-custom {{ request()->routeIs('pidana-reports.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-handcuffs me-2" style="width:14px;color:#6366f1;font-size:.75rem;"></i>
                            Pidana
                        </a>
                    </div>
                    <div class="nav-item-custom" style="margin:0;">
                        <a href="{{ route('tun-reports.index') }}"
                           class="nav-link-custom {{ request()->routeIs('tun-reports.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-landmark me-2" style="width:14px;color:#6366f1;font-size:.75rem;"></i>
                            TUN
                        </a>
                    </div>
                    <div class="nav-item-custom" style="margin:0;">
                        <a href="{{ route('konsultasi-hukum-reports.index') }}"
                           class="nav-link-custom {{ request()->routeIs('konsultasi-hukum-reports.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-comments me-2" style="width:14px;color:#6366f1;font-size:.75rem;"></i>
                            Konsultasi Hukum
                        </a>
                    </div>
                    <div class="nav-item-custom" style="margin:0;">
                        <a href="{{ route('investigasi-kasus-reports.index') }}"
                           class="nav-link-custom {{ request()->routeIs('investigasi-kasus-reports.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-magnifying-glass me-2" style="width:14px;color:#6366f1;font-size:.75rem;"></i>
                            Investigasi Kasus
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if(auth()->check() && auth()->user()->role === 'admin')
        <div class="nav-item-custom">
            <button class="nav-link-custom {{ request()->routeIs('laporan-ph.*') ? 'active' : '' }}"
                    onclick="toggleSubmenu('laporanPHMenu', this)">
                <div class="nav-icon" style="background:{{ request()->routeIs('laporan-ph.*') ? 'rgba(99,102,241,.15)' : 'rgba(100,116,139,.08)' }};">
                    <i class="fa-solid fa-file-lines" style="color:{{ request()->routeIs('laporan-ph.*') ? 'var(--brand-1)' : '#64748b' }};"></i>
                </div>
                Laporan Penasehat Hukum (PH)
                <i class="fa-solid fa-chevron-right ms-auto" style="font-size:.6rem;transition:var(--trans);" id="laporanPHMenuArrow"></i>
            </button>
            <div class="submenu-wrap" id="laporanPHMenu" style="display:{{ request()->routeIs('laporan-ph.*') ? 'block' : 'none' }};">
                <div class="submenu-inner">
                    <div class="nav-item-custom" style="margin:0;">
                        <a href="{{ route('laporan-ph.pengadilan.index') }}"
                           class="nav-link-custom {{ request()->routeIs('laporan-ph.pengadilan.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-gavel me-2" style="width:14px;color:#6366f1;font-size:.75rem;"></i>
                            Laporan Pengadilan Subang
                        </a>
                    </div>
                    <div class="nav-item-custom" style="margin:0;">
                        <a href="{{ route('laporan-ph.lapas.index') }}"
                           class="nav-link-custom {{ request()->routeIs('laporan-ph.lapas.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-building-ngo me-2" style="width:14px;color:#6366f1;font-size:.75rem;"></i>
                            Laporan Lapas Subang
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if(auth()->check() && auth()->user()->role === 'admin')
        <div class="sidebar-section" style="margin-top:4px;">Master Data</div>

        <div class="nav-item-custom">
            <a href="{{ route('users.index') }}"
               class="nav-link-custom {{ request()->routeIs('users.*') ? 'active' : '' }}">
                <div class="nav-icon" style="background:{{ request()->routeIs('users.*') ? 'rgba(14,165,233,.15)' : 'rgba(100,116,139,.08)' }};">
                    <i class="fa-solid fa-users" style="color:{{ request()->routeIs('users.*') ? '#0ea5e9' : '#64748b' }};"></i>
                </div>
                Manajemen Users
            </a>
        </div>

        {{-- Kategori menu hidden --}}
        {{-- 
        <div class="nav-item-custom">
            <a href="{{ route('categories.index') }}"
               class="nav-link-custom {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                <div class="nav-icon" style="background:rgba(100,116,139,.08);">
                    <i class="fa-solid fa-tags" style="color:#64748b;"></i>
                </div>
                Kategori
            </a>
        </div>
        --}}

        <div class="nav-item-custom">
            <a href="{{ route('lawyers.index') }}"
               class="nav-link-custom {{ request()->routeIs('lawyers.*') ? 'active' : '' }}">
                <div class="nav-icon" style="background:rgba(100,116,139,.08);">
                    <i class="fa-solid fa-gavel" style="color:#64748b;"></i>
                </div>
                Advocate
            </a>
        </div>

        <div class="nav-item-custom">
            <a href="{{ route('paralegals.index') }}"
               class="nav-link-custom {{ request()->routeIs('paralegals.*') ? 'active' : '' }}">
                <div class="nav-icon" style="background:{{ request()->routeIs('paralegals.*') ? 'rgba(16,185,129,.15)' : 'rgba(100,116,139,.08)' }};">
                    <i class="fa-solid fa-user-shield" style="color:{{ request()->routeIs('paralegals.*') ? '#10b981' : '#64748b' }};"></i>
                </div>
                Paralegal
            </a>
        </div>

        <div class="nav-item-custom">
            <a href="{{ route('status-perkara.index') }}"
               class="nav-link-custom {{ request()->routeIs('status-perkara.*') ? 'active' : '' }}">
                <div class="nav-icon" style="background:rgba(100,116,139,.08);">
                    <i class="fa-solid fa-list-check" style="color:#64748b;"></i>
                </div>
                Status Perkara
            </a>
        </div>

        <div class="nav-item-custom">
            <a href="{{ route('settings.edit') }}"
               class="nav-link-custom {{ request()->routeIs('settings.*') ? 'active' : '' }}">
                <div class="nav-icon" style="background:rgba(100,116,139,.08);">
                    <i class="fa-solid fa-gear" style="color:#64748b;"></i>
                </div>
                Pengaturan
            </a>
        </div>
        @endif
    </div>

    <!-- Footer -->
    <div class="sidebar-footer">
        <!-- User -->
        <div class="dropdown">
            <div class="user-card dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'U') }}&background=6366f1&color=fff&size=68"
                     class="user-avatar" alt="">
                <div style="flex:1;overflow:hidden;">
                    <div class="user-name text-truncate">{{ auth()->user()->name ?? 'User' }}</div>
                    @php
                        $roleLabel = match(auth()->user()->role ?? 'user') {
                            'admin' => 'Admin',
                            'pengacara' => 'Advocate',
                            'paralegal' => 'Paralegal',
                            default => ucfirst(auth()->user()->role ?? 'user')
                        };
                    @endphp
                    <span class="user-role">{{ $roleLabel }}</span>
                </div>
            </div>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0" style="border-radius:var(--radius-sm);min-width:180px;">
                <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fa-regular fa-id-badge me-2 text-muted"></i>Profil Saya</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger"><i class="fa-solid fa-arrow-right-from-bracket me-2"></i>Keluar</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</aside>

<!-- ── MAIN ── -->
<div class="main-content">
    <!-- Mobile header -->
    <header class="mobile-header">
        <div class="d-flex align-items-center gap-2">
            <div style="width:28px;height:28px;border-radius:7px;background:var(--brand-grad);display:flex;align-items:center;justify-content:center;">
                <i class="fa-solid fa-scale-balanced text-white" style="font-size:.7rem;"></i>
            </div>
            <span style="font-weight:700;font-size:.9rem;color:#1e293b;" class="sidebar-logo-text">LBH Panel</span>
        </div>
        <div class="d-flex gap-2">
            <button class="theme-toggle" id="themeToggle" title="Toggle theme"><i class="fa-solid fa-moon" id="themeIcon"></i></button>
            <button class="hamburger" id="hamburger"><i class="fa-solid fa-bars"></i></button>
        </div>
    </header>

    <!-- Topbar (desktop) -->
    <div class="topbar">
        @if(isset($header))
        <div>
            <div class="topbar-title">{{ $header }}</div>
            <div class="topbar-sub">{{ now()->isoFormat('dddd, D MMMM YYYY') }}</div>
        </div>
        @else
        <div class="topbar-title">Dashboard</div>
        @endif
        <div class="d-flex align-items-center gap-2">
            <button class="theme-toggle" id="themeToggleDesktop" title="Toggle theme"><i class="fa-solid fa-moon" id="themeIconDesktop"></i></button>
        </div>
    </div>

    <!-- Alerts -->
    <div style="padding: 20px 28px 0 28px;">
        @if(session('success'))
        <div class="alert-modern alert-success alert-dismissible mb-4" role="alert">
            <i class="fa-solid fa-circle-check fa-lg"></i>
            <span>{{ session('success') }}</span>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" style="font-size:.7rem;"></button>
        </div>
        @endif
        @if(session('error'))
        <div class="alert-modern alert-danger alert-dismissible mb-4" role="alert">
            <i class="fa-solid fa-triangle-exclamation fa-lg"></i>
            <span>{{ session('error') }}</span>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" style="font-size:.7rem;"></button>
        </div>
        @endif
    </div>

    <!-- Page slot -->
    <div class="page-body">
        {{ $slot }}
    </div>

    <footer class="text-center py-4" style="font-size:.72rem;color:#94a3b8;border-top:1px solid rgba(0,0,0,.05);">
        &copy; {{ date('Y') }} LBH UNSUB
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Theme
    function applyTheme(t){
        document.documentElement.setAttribute('data-bs-theme', t);
        localStorage.setItem('lbh-theme', t);
        const icon = t === 'dark' ? 'fa-sun' : 'fa-moon';
        document.querySelectorAll('#themeIcon,#themeIconDesktop').forEach(el => {
            el.className = `fa-solid ${icon}`;
        });
    }
    applyTheme(savedTheme);
    document.getElementById('themeToggle')?.addEventListener('click', () => applyTheme(document.documentElement.getAttribute('data-bs-theme') === 'dark' ? 'light' : 'dark'));
    document.getElementById('themeToggleDesktop')?.addEventListener('click', () => applyTheme(document.documentElement.getAttribute('data-bs-theme') === 'dark' ? 'light' : 'dark'));

    // Sidebar mobile
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    document.getElementById('hamburger')?.addEventListener('click', () => { sidebar.classList.add('open'); overlay.classList.add('open'); });
    overlay?.addEventListener('click', () => { sidebar.classList.remove('open'); overlay.classList.remove('open'); });

    // Submenu toggle
    function toggleSubmenu(id, btn) {
        const el = document.getElementById(id);
        const arrowId = id + 'Arrow';
        const arrow = document.getElementById(arrowId);
        const open = el.style.display === 'block';
        el.style.display = open ? 'none' : 'block';
        if(arrow) arrow.style.transform = open ? 'rotate(0deg)' : 'rotate(90deg)';
    }
    // Init arrows for open submenus
    document.querySelectorAll('.submenu-wrap').forEach(el => {
        if(el.style.display === 'block') {
            const arrow = document.getElementById(el.id + 'Arrow');
            if(arrow) arrow.style.transform = 'rotate(90deg)';
        }
    });
</script>
@stack('scripts')
</body>
</html>
