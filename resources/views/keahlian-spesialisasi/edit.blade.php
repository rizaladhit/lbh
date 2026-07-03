<x-app-layout>
    <x-slot name="header">Edit Keahlian/Spesialisasi</x-slot>

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-transparent py-3 d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="m-0 fw-bold text-primary"><i class="fa-solid fa-scale-balanced me-2"></i>Form Edit Keahlian/Spesialisasi</h6>
                        <div class="text-muted small">Perbarui nama keahlian yang sudah terdaftar.</div>
                    </div>
                    <span class="badge bg-warning text-dark">Edit</span>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('keahlian-spesialisasi.update', $keahlianSpesialisasi) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nama" class="form-label fw-bold small text-muted">Nama Keahlian/Spesialisasi</label>
                            <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror"
                                name="nama" value="{{ old('nama', $keahlianSpesialisasi->nama) }}" required autofocus>
                            @error('nama')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                            <a href="{{ route('keahlian-spesialisasi.index') }}" class="btn btn-light fw-medium">Batalkan</a>
                            <button type="submit" class="btn btn-primary fw-bold shadow-sm"><i class="fa-solid fa-save me-1"></i> Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
