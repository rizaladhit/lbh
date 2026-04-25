<x-guest-layout>
    <div style="margin-bottom:28px;text-align:center;">
        <h4 style="font-weight:800;font-size:1.35rem;letter-spacing:-0.5px;" class="text-body mb-2">Selamat Datang! 👋</h4>
        <p style="color:#64748b;font-size:.85rem;margin:0;">Silakan masuk ke akun Anda untuk melanjutkan.</p>
    </div>

    @if (session('status'))
        <div class="alert-custom mb-4">
            <i class="fa-solid fa-circle-check"></i>
            {{ session('status') }}
        </div>
    @endif
    
    @if (session('error'))
        <div class="alert-custom mb-4" style="background:rgba(239,68,68,0.1);border-color:rgba(239,68,68,0.2);color:#ef4444;">
            <i class="fa-solid fa-triangle-exclamation"></i>
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div style="margin-bottom:18px;">
            <label for="email" style="display:block;margin-bottom:6px;font-size:.8rem;font-weight:600;" class="text-body">{{ __('Alamat Email') }}</label>
            <div class="input-icon-wrap">
                <i class="fa-regular fa-envelope"></i>
                <input id="email" class="form-control form-control-mod w-100" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="nama@email.com" />
            </div>
            @error('email')
                <div style="color:#ef4444;font-size:.75rem;margin-top:6px;font-weight:500;"><i class="fa-solid fa-circle-exclamation me-1"></i> {{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div style="margin-bottom:22px;">
            <label for="password" style="display:block;margin-bottom:6px;font-size:.8rem;font-weight:600;" class="text-body">{{ __('Kata Sandi') }}</label>
            <div class="input-icon-wrap">
                <i class="fa-solid fa-lock"></i>
                <input id="password" class="form-control form-control-mod w-100" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            </div>
            @error('password')
                <div style="color:#ef4444;font-size:.75rem;margin-top:6px;font-weight:500;"><i class="fa-solid fa-circle-exclamation me-1"></i> {{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me & Forgot Password -->
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:28px;">
            <div style="display:flex;align-items:center;gap:8px;">
                <input id="remember_me" type="checkbox" class="form-check-input m-0" name="remember">
                <label for="remember_me" style="font-size:.8rem;color:#64748b;cursor:pointer;user-select:none;margin:0;">{{ __('Ingat saya') }}</label>
            </div>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" style="font-size:.8rem;font-weight:600;color:var(--brand-1);text-decoration:none;">
                    {{ __('Lupa sandi?') }}
                </a>
            @endif
        </div>

        <button type="submit" class="btn-auth mb-4">
            {{ __('Masuk Sekarang') }}
        </button>
        
        <div style="display:flex;align-items:center;margin-bottom:24px;">
            <div style="flex:1;height:1px;background:rgba(0,0,0,0.08);"></div>
            <div style="padding:0 12px;font-size:.7rem;font-weight:700;color:#94a3b8;letter-spacing:1px;">ATAU</div>
            <div style="flex:1;height:1px;background:rgba(0,0,0,0.08);"></div>
        </div>
        
        <a href="{{ route('google.login') }}" class="btn-google" style="text-decoration:none;">
            <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google" style="width:18px;height:18px;">
            Masuk dengan Google
        </a>
    </form>
</x-guest-layout>
