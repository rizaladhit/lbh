<x-app-layout>
    <x-slot name="header">Tambah Status Perkara</x-slot>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header py-3">
            <h6 class="mb-0 fw-bold" style="font-size:.9rem;">
                <i class="fa-solid fa-plus-circle me-2 text-primary"></i>Form Tambah Status Perkara
            </h6>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('status-perkara.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    {{-- Nama --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size:.83rem;">Nama <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                               value="{{ old('nama') }}" placeholder="Contoh: Sidang Pertama" required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Warna --}}
                    <div class="col-md-3">
                        <label class="form-label fw-semibold" style="font-size:.83rem;">Warna <span class="text-danger">*</span></label>
                        <select name="warna" class="form-select @error('warna') is-invalid @enderror" required>
                            <option value="secondary" {{ old('warna', 'secondary') === 'secondary' ? 'selected' : '' }}>Abu-abu (secondary)</option>
                            <option value="info"      {{ old('warna') === 'info'      ? 'selected' : '' }}>Biru (info)</option>
                            <option value="warning"   {{ old('warna') === 'warning'   ? 'selected' : '' }}>Kuning (warning)</option>
                            <option value="danger"    {{ old('warna') === 'danger'    ? 'selected' : '' }}>Merah (danger)</option>
                            <option value="success"   {{ old('warna') === 'success'   ? 'selected' : '' }}>Hijau (success)</option>
                            <option value="primary"   {{ old('warna') === 'primary'   ? 'selected' : '' }}>Ungu (primary)</option>
                        </select>
                        @error('warna')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Urutan --}}
                    <div class="col-md-3">
                        <label class="form-label fw-semibold" style="font-size:.83rem;">Urutan <span class="text-danger">*</span></label>
                        <input type="number" name="urutan" class="form-control @error('urutan') is-invalid @enderror"
                               value="{{ old('urutan', 0) }}" min="0" required>
                        @error('urutan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Is Final --}}
                    <div class="col-md-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_final" id="is_final" value="1"
                                   {{ old('is_final') ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="is_final" style="font-size:.83rem;">
                                Tandai sebagai status Selesai (membekukan counter Lama Proses)
                            </label>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2 justify-content-end mt-4 pt-3 border-top">
                    <a href="{{ route('status-perkara.index') }}" class="btn btn-outline-secondary" style="border-radius:9px;font-size:.83rem;">
                        <i class="fa-solid fa-arrow-left me-1"></i>Batalkan
                    </a>
                    <button type="submit" class="btn btn-primary" style="border-radius:9px;font-size:.83rem;background:linear-gradient(135deg,#6366f1,#8b5cf6);border:none;">
                        <i class="fa-solid fa-save me-1"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
