<x-app-layout>
    <x-slot name="header">Manajemen User</x-slot>

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
        .data-table tbody tr:hover { background: rgba(14,165,233,.04); }
        [data-bs-theme="dark"] .data-table tbody tr:hover { background: rgba(255,255,255,.03); }
        .data-table td { padding: 16px 18px; vertical-align: middle; border: none; }
        
        .role-badge {
            padding: 4px 10px; border-radius: 99px;
            font-size: .72rem; font-weight: 700;
            display: inline-flex; align-items: center; gap: 6px;
        }
        .role-badge.admin { background: rgba(239,68,68,.12); color: #ef4444; }
        .role-badge.user { background: rgba(99,102,241,.12); color: #6366f1; }
        
        .action-btn {
            width: 32px; height: 32px; border-radius: 8px;
            border: 1px solid rgba(0,0,0,.08); background: transparent;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: .8rem; text-decoration: none; cursor: pointer; transition: all .15s;
        }
        .action-btn:hover { background: rgba(0,0,0,.05); transform: scale(1.08); }
        [data-bs-theme="dark"] .action-btn { border-color: rgba(255,255,255,.1); }
        
        .btn-cta {
            background: linear-gradient(135deg,#0ea5e9,#0284c7);
            border: none; color: #fff; font-weight: 600; font-size: .8rem;
            padding: 8px 18px; border-radius: 9px; transition: all .2s;
            display: inline-flex; align-items: center; gap: 8px; text-decoration: none;
            box-shadow: 0 4px 14px rgba(14,165,233,.35);
        }
        .btn-cta:hover { opacity: .9; color: #fff; transform: translateY(-1px); }
    </style>

    <div class="panel">
        <div class="panel-head">
            <div class="d-flex align-items-center gap-3">
                <div style="width:36px;height:36px;border-radius:10px;background:rgba(14,165,233,.15);display:flex;align-items:center;justify-content:center;">
                    <i class="fa-solid fa-users text-info"></i>
                </div>
                <div>
                    <h6 class="mb-0 fw-bold text-body">Daftar Pengguna</h6>
                    <div style="font-size:.72rem;color:#94a3b8;">Total {{ $users->total() }} user terdaftar</div>
                </div>
            </div>
            <a href="{{ route('users.create') }}" class="btn-cta">
                <i class="fa-solid fa-plus"></i><span class="d-none d-sm-inline">Tambah User</span>
            </a>
        </div>

        <div class="table-responsive">
            <table class="data-table table">
                <thead>
                    <tr>
                        <th style="padding-left:24px;">Pengguna</th>
                        <th>Email & Info</th>
                        <th>Akses Role</th>
                        <th style="padding-right:24px;text-align:right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td style="padding-left:24px;">
                            <div class="d-flex align-items-center gap-3">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=0ea5e9&color=fff&size=40" 
                                     style="width:38px;height:38px;border-radius:10px;" alt="">
                                <div>
                                    <div style="font-weight:600;font-size:.88rem;" class="text-body">{{ $user->name }}</div>
                                    <div style="font-size:.72rem;color:#94a3b8;">Tergabung {{ $user->created_at->diffForHumans() }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="font-size:.82rem;font-weight:500;" class="text-body">{{ $user->email }}</div>
                            @if($user->google_id)
                                <div style="font-size:.7rem;color:#10b981;margin-top:2px;">
                                    <i class="fa-brands fa-google me-1"></i> Google Auth linked
                                </div>
                            @endif
                        </td>
                        <td>
                            @php
                                $roleLabel = match($user->role) {
                                    'admin' => 'Admin',
                                    'pengacara' => 'Advocate',
                                    'paralegal' => 'Paralegal',
                                    default => ucfirst($user->role)
                                };
                            @endphp
                            <span class="role-badge {{ $user->role === 'admin' ? 'admin' : 'user' }}">
                                <i class="fa-solid {{ $user->role === 'admin' ? 'fa-shield-halved' : 'fa-user' }}"></i>
                                {{ $roleLabel }}
                            </span>
                        </td>
                        <td style="padding-right:24px;text-align:right;">
                            <div class="d-flex justify-content-end gap-1">
                                <a href="{{ route('users.edit', $user) }}" class="action-btn" style="color:#f59e0b;" title="Edit">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                @if(auth()->id() !== $user->id)
                                <button onclick="confirmDelete('{{ route('users.destroy', $user) }}')" class="action-btn" style="color:#ef4444;" title="Hapus">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
        <div style="padding:16px 24px;border-top:1px solid rgba(0,0,0,.05);display:flex;justify-content:space-between;align-items:center;">
            <span style="font-size:.75rem;color:#94a3b8;">Menampilkan hal. {{ $users->currentPage() }} dari {{ $users->lastPage() }}</span>
            {{ $users->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>

    <form id="deleteForm" method="POST" style="display:none;">@csrf @method('DELETE')</form>
    <script>
        function confirmDelete(action){
            if(!confirm('Hapus akun pengguna ini?')) return;
            const f = document.getElementById('deleteForm'); f.action = action; f.submit();
        }
    </script>
</x-app-layout>
