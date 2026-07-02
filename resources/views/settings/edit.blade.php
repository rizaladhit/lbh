<x-app-layout>
    <x-slot name="header">
        Pengaturan Aplikasi
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-xl-7">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 fw-bold text-primary"><i class="fa-solid fa-gear me-2"></i>Pengaturan Aplikasi</h6>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- App Name --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Nama Aplikasi <span class="text-danger">*</span></label>
                            <input type="text" name="app_name" class="form-control @error('app_name') is-invalid @enderror"
                                   value="{{ old('app_name', $setting->app_name) }}" required>
                            @error('app_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- App Description --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Deskripsi Aplikasi</label>
                            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror"
                                   value="{{ old('description', $setting->description) }}"
                                   placeholder="Contoh: Sistem Manajemen Bantuan Hukum">
                            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Logo --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Logo Aplikasi</label>
                            @if($setting->logo_path)
                            <div class="mb-3 p-3 border rounded d-flex align-items-center gap-3" style="background: var(--bs-secondary-bg);">
                                <img src="{{ Storage::url($setting->logo_path) }}" alt="Logo" style="height: 60px; object-fit: contain;">
                                <div>
                                    <p class="mb-1 small text-muted">Logo saat ini</p>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remove_logo" id="removeLogo" value="1">
                                        <label class="form-check-label text-danger small" for="removeLogo">Hapus logo ini</label>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror"
                                   accept=".png,.jpg,.jpeg,.svg">
                            <div class="form-text">Format: PNG, JPG, SVG. Maks. 2MB. Rekomendasi: PNG transparan.</div>
                            @error('logo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Address --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Alamat Kantor</label>
                            <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="2">{{ old('address', $setting->address) }}</textarea>
                            @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Phone --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Telepon / Fax</label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                   value="{{ old('phone', $setting->phone) }}">
                            @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="d-flex justify-content-end pt-3 border-top">
                            <button type="submit" class="btn btn-primary fw-bold px-4 shadow-sm">
                                <i class="fa-solid fa-floppy-disk me-1"></i> Simpan Pengaturan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
