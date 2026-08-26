<form method="post" action="{{ route('profile.update') }}">
    @csrf
    @method('patch')

    <div class="mb-3">
        <label for="name" class="form-label fw-semibold">{{ __('Nama') }}</label>
        <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label for="email" class="form-label fw-semibold">{{ __('Email') }}</label>
        <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email', $user->email) }}" required autocomplete="username">
        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="mt-2">
                <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                    @csrf
                </form>
                <p class="small text-muted mb-0">
                    {{ __('Alamat email Anda belum terverifikasi.') }}
                    <button form="send-verification" class="btn btn-link btn-sm p-0 align-baseline">
                        {{ __('Klik di sini untuk kirim ulang email verifikasi.') }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                    <p class="small text-success fw-semibold mt-1 mb-0">
                        {{ __('Tautan verifikasi baru telah dikirim ke alamat email Anda.') }}
                    </p>
                @endif
            </div>
        @endif
    </div>

    <div class="d-flex align-items-center gap-3 pt-2 border-top">
        <button type="submit" class="btn btn-primary fw-bold px-4 shadow-sm mt-3">
            <i class="fa-solid fa-floppy-disk me-1"></i> {{ __('Simpan') }}
        </button>

        @if (session('status') === 'profile-updated')
            <span class="text-success small mt-3" id="profile-updated-status">
                <i class="fa-solid fa-check me-1"></i>{{ __('Tersimpan.') }}
            </span>
            <script>
                setTimeout(() => {
                    const el = document.getElementById('profile-updated-status');
                    if (el) el.style.display = 'none';
                }, 2000);
            </script>
        @endif
    </div>
</form>
