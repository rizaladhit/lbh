<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'LBH') }} — Welcome</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <script>
        const savedTheme = localStorage.getItem('lbh-theme') || 'light';
        document.documentElement.setAttribute('data-bs-theme', savedTheme);
    </script>

    <style>
        :root {
            --brand-1: #6366f1;
            --brand-2: #8b5cf6;
            --font: 'Inter', system-ui, sans-serif;
            --bg-grad: linear-gradient(135deg, #f4f5f9 0%, #e2e8f0 100%);
        }
        [data-bs-theme="dark"] {
            --bg-grad: linear-gradient(135deg, #0f1117 0%, #161b2e 100%);
        }
        
        body {
            font-family: var(--font);
            background: var(--bg-grad);
            min-height: 100vh;
            display: flex; flex-direction: column;
        }

        /* Ambient background glow */
        body::before {
            content: ''; position: fixed; top: -20%; left: -10%;
            width: 50%; height: 60%;
            background: radial-gradient(circle, rgba(99,102,241,0.15) 0%, transparent 70%);
            border-radius: 50%; z-index: -1; filter: blur(60px);
        }
        body::after {
            content: ''; position: fixed; bottom: -20%; right: -10%;
            width: 50%; height: 60%;
            background: radial-gradient(circle, rgba(139,92,246,0.15) 0%, transparent 70%);
            border-radius: 50%; z-index: -1; filter: blur(60px);
        }

        .auth-container {
            flex: 1; display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            padding: 40px 20px;
        }
        
        .auth-card {
            width: 100%; max-width: 420px;
            background: rgba(255,255,255,0.85);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            border: 1px solid rgba(255,255,255,0.4);
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
            padding: 40px;
        }
        [data-bs-theme="dark"] .auth-card {
            background: rgba(30,41,59,0.7);
            border-color: rgba(255,255,255,0.08);
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        }

        .auth-logo-icon {
            width: 64px; height: 64px; border-radius: 16px;
            background: linear-gradient(135deg, var(--brand-1), var(--brand-2));
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 8px 24px rgba(99,102,241,0.4);
            font-size: 1.8rem; color: #fff;
        }

        .theme-toggle {
            position: fixed; top: 20px; right: 20px;
            width: 40px; height: 40px; border-radius: 12px;
            background: rgba(255,255,255,0.5);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.3);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; color: #64748b; font-size: 1rem;
            transition: all .2s; z-index: 100;
        }
        .theme-toggle:hover { transform: scale(1.05); color: var(--brand-1); }
        [data-bs-theme="dark"] .theme-toggle {
            background: rgba(30,41,59,0.5); border-color: rgba(255,255,255,0.1); color: #cbd5e1;
        }

        /* Form Controls */
        .form-control-mod {
            border-radius: 12px;
            background: rgba(248,250,252,0.8);
            border: 1px solid rgba(0,0,0,0.08);
            padding: 12px 16px;
            font-size: .9rem; font-weight: 500;
            color: #1e293b;
            transition: all .2s;
        }
        .form-control-mod:focus {
            background: #fff; border-color: var(--brand-1);
            box-shadow: 0 0 0 4px rgba(99,102,241,0.15);
            outline: none;
        }
        [data-bs-theme="dark"] .form-control-mod {
            background: rgba(15,23,42,0.6); border-color: rgba(255,255,255,0.08);
            color: #f1f5f9;
        }
        [data-bs-theme="dark"] .form-control-mod:focus {
            background: rgba(15,23,42,0.9); box-shadow: 0 0 0 4px rgba(99,102,241,0.2);
        }

        .input-icon-wrap { position: relative; }
        .input-icon-wrap i {
            position: absolute; left: 16px; top: 50%; transform: translateY(-50%);
            color: #94a3b8; font-size: 1rem;
        }
        .input-icon-wrap .form-control-mod { padding-left: 44px; }

        .btn-auth {
            background: linear-gradient(135deg, var(--brand-1), var(--brand-2));
            border: none; color: #fff; font-weight: 700; font-size: .95rem;
            padding: 12px; border-radius: 12px; width: 100%;
            transition: all .2s; box-shadow: 0 8px 20px rgba(99,102,241,0.35);
        }
        .btn-auth:hover { opacity: .9; transform: translateY(-2px); color: #fff; }

        .btn-google {
            background: transparent; border: 1px solid rgba(0,0,0,0.1);
            color: #475569; font-weight: 600; font-size: .9rem;
            padding: 12px; border-radius: 12px; width: 100%;
            transition: all .2s; display: flex; align-items: center; justify-content: center; gap: 10px;
        }
        .btn-google:hover { background: rgba(0,0,0,0.02); border-color: rgba(0,0,0,0.15); color: #1e293b; }
        [data-bs-theme="dark"] .btn-google { border-color: rgba(255,255,255,0.1); color: #cbd5e1; }
        [data-bs-theme="dark"] .btn-google:hover { background: rgba(255,255,255,0.03); color: #f1f5f9; }

        .form-check-input { border-radius: 6px; border-color: rgba(0,0,0,0.2); }
        .form-check-input:checked { background-color: var(--brand-1); border-color: var(--brand-1); }

        .alert-custom {
            background: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.2);
            color: #059669; border-radius: 12px; padding: 12px 16px;
            font-size: .85rem; font-weight: 500; display: flex; align-items: center; gap: 10px;
        }
        [data-bs-theme="dark"] .alert-custom { color: #34d399; }
    </style>
</head>
<body>

    <button id="themeToggle" class="theme-toggle" title="Toggle theme">
        <i class="fa-solid fa-moon" id="themeIcon"></i>
    </button>

    <div class="auth-container">
        <div class="text-center mb-4">
            <div class="auth-logo-icon">
                @if(isset($appSetting) && $appSetting->logo_path)
                    <img src="{{ Storage::url($appSetting->logo_path) }}" alt="Logo" style="height:32px;width:32px;object-fit:contain;">
                @else
                    <i class="fa-solid fa-scale-balanced"></i>
                @endif
            </div>
            <h3 class="fw-bold text-body" style="letter-spacing:-0.5px;">{{ isset($appSetting) ? $appSetting->app_name : 'LBH Panel' }}</h3>
            <p style="color:#64748b;font-size:.9rem;">Sistem Manajemen Bantuan Hukum</p>
        </div>

        <div class="auth-card">
            {{ $slot }}
        </div>

        <div style="margin-top:40px;color:#94a3b8;font-size:.75rem;font-weight:500;">
            &copy; {{ date('Y') }} Hak Cipta Dilindungi
        </div>
    </div>

    <script>
        function applyTheme(t){
            document.documentElement.setAttribute('data-bs-theme', t);
            localStorage.setItem('lbh-theme', t);
            document.getElementById('themeIcon').className = t === 'dark' ? 'fa-solid fa-sun' : 'fa-solid fa-moon';
        }
        applyTheme(savedTheme);
        document.getElementById('themeToggle').addEventListener('click', () => {
            applyTheme(document.documentElement.getAttribute('data-bs-theme') === 'dark' ? 'light' : 'dark');
        });
    </script>
</body>
</html>
