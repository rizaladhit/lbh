<x-guest-layout>
    <div style="margin-bottom:28px;text-align:center;">
        <h4 style="font-weight:800;font-size:1.35rem;letter-spacing:-0.5px;" class="text-body mb-2">Buat Akun Baru ✨</h4>
        <p style="color:#64748b;font-size:.85rem;margin:0;">Daftar untuk mengakses sistem LBH Panel.</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div style="margin-bottom:18px;">
            <label for="name" style="display:block;margin-bottom:6px;font-size:.8rem;font-weight:600;" class="text-body">{{ __('Nama Lengkap') }}</label>
            <div class="input-icon-wrap">
                <i class="fa-regular fa-user"></i>
                <input id="name" class="form-control form-control-mod w-100" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Budi Santoso" />
            </div>
            @error('name')
                <div style="color:#ef4444;font-size:.75rem;margin-top:6px;font-weight:500;"><i class="fa-solid fa-circle-exclamation me-1"></i> {{ $message }}</div>
            @enderror
        </div>

        <!-- Email -->
        <div style="margin-bottom:18px;">
            <label for="email" style="display:block;margin-bottom:6px;font-size:.8rem;font-weight:600;" class="text-body">{{ __('Alamat Email') }}</label>
            <div class="input-icon-wrap">
                <i class="fa-regular fa-envelope"></i>
                <input id="email" class="form-control form-control-mod w-100" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="nama@email.com" />
            </div>
            @error('email')
                <div style="color:#ef4444;font-size:.75rem;margin-top:6px;font-weight:500;"><i class="fa-solid fa-circle-exclamation me-1"></i> {{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div style="margin-bottom:18px;">
            <label for="password" style="display:block;margin-bottom:6px;font-size:.8rem;font-weight:600;" class="text-body">{{ __('Kata Sandi') }}</label>
            <div class="input-icon-wrap">
                <i class="fa-solid fa-lock"></i>
                <input id="password" class="form-control form-control-mod w-100" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
            </div>
            @error('password')
                <div style="color:#ef4444;font-size:.75rem;margin-top:6px;font-weight:500;"><i class="fa-solid fa-circle-exclamation me-1"></i> {{ $message }}</div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div style="margin-bottom:28px;">
            <label for="password_confirmation" style="display:block;margin-bottom:6px;font-size:.8rem;font-weight:600;" class="text-body">{{ __('Konfirmasi Kata Sandi') }}</label>
            <div class="input-icon-wrap">
                <i class="fa-solid fa-lock"></i>
                <input id="password_confirmation" class="form-control form-control-mod w-100" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            </div>
            @error('password_confirmation')
                <div style="color:#ef4444;font-size:.75rem;margin-top:6px;font-weight:500;"><i class="fa-solid fa-circle-exclamation me-1"></i> {{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn-auth mb-4">
            {{ __('Daftar Sekarang') }}
        </button>
        
        <div style="display:flex;align-items:center;margin-bottom:24px;">
            <div style="flex:1;height:1px;background:rgba(0,0,0,0.08);"></div>
            <div style="padding:0 12px;font-size:.7rem;font-weight:700;color:#94a3b8;letter-spacing:1px;">ATAU</div>
            <div style="flex:1;height:1px;background:rgba(0,0,0,0.08);"></div>
        </div>
        
        <a href="{{ route('google.login') }}" class="btn-google mb-4" style="text-decoration:none;">
            <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google" style="width:18px;height:18px;">
            Daftar dengan Google
        </a>
        
        <div style="text-align:center;">
            <a href="{{ route('login') }}" style="font-size:.82rem;font-weight:500;color:#64748b;text-decoration:none;">
                {{ __('Sudah punya akun?') }} <span style="color:var(--brand-1);font-weight:700;">Masuk di sini</span>
            </a>
        </div>
    </form>
</x-guest-layout>
