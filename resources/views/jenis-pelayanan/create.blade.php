<x-app-layout>
    <x-slot name="header">Tambah Jenis Pelayanan</x-slot>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header py-3">
            <h6 class="mb-0 fw-bold" style="font-size:.9rem;">
                <i class="fa-solid fa-plus-circle me-2 text-primary"></i>Form Tambah Jenis Pelayanan
            </h6>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('jenis-pelayanan.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label fw-semibold" style="font-size:.83rem;">Nama Jenis Pelayanan <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                               value="{{ old('nama') }}" placeholder="Contoh: Konsultasi Hukum" required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex gap-2 justify-content-end mt-4 pt-3 border-top">
                    <a href="{{ route('jenis-pelayanan.index') }}" class="btn btn-outline-secondary" style="border-radius:9px;font-size:.83rem;">
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
