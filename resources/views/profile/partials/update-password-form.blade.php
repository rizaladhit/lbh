<form method="post" action="{{ route('password.update') }}">
    @csrf
    @method('put')

    <div class="mb-3">
        <label for="update_password_current_password" class="form-label fw-semibold">{{ __('Password Saat Ini') }}</label>
        <input id="update_password_current_password" name="current_password" type="password"
               class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
               autocomplete="current-password">
        @error('current_password', 'updatePassword') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label for="update_password_password" class="form-label fw-semibold">{{ __('Password Baru') }}</label>
        <input id="update_password_password" name="password" type="password"
               class="form-control @error('password', 'updatePassword') is-invalid @enderror"
               autocomplete="new-password">
        @error('password', 'updatePassword') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label for="update_password_password_confirmation" class="form-label fw-semibold">{{ __('Konfirmasi Password Baru') }}</label>
        <input id="update_password_password_confirmation" name="password_confirmation" type="password"
               class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror"
               autocomplete="new-password">
        @error('password_confirmation', 'updatePassword') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="d-flex align-items-center gap-3 pt-2 border-top">
        <button type="submit" class="btn btn-primary fw-bold px-4 shadow-sm mt-3">
            <i class="fa-solid fa-floppy-disk me-1"></i> {{ __('Simpan') }}
        </button>

        @if (session('status') === 'password-updated')
            <span class="text-success small mt-3" id="password-updated-status">
                <i class="fa-solid fa-check me-1"></i>{{ __('Tersimpan.') }}
            </span>
            <script>
                setTimeout(() => {
                    const el = document.getElementById('password-updated-status');
                    if (el) el.style.display = 'none';
                }, 2000);
            </script>
        @endif
    </div>
</form>
