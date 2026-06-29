<x-app-layout>
    <x-slot name="header">Tambah Data SIMBAKUM</x-slot>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header py-3">
            <h6 class="mb-0 fw-bold" style="font-size:.9rem;">
                <i class="fa-solid fa-plus-circle me-2 text-primary"></i>Form Input SIMBAKUM
            </h6>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('simbakum.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">
                    {{-- No. Perkara --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size:.83rem;">No. Perkara <span class="text-danger">*</span></label>
                        <input type="text" name="no_perkara" class="form-control @error('no_perkara') is-invalid @enderror"
                               value="{{ old('no_perkara') }}" placeholder="Contoh: 123/Pid.B/2026/PN.Sbn" required>
                        @error('no_perkara')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tanggal Register --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size:.83rem;">Tanggal Register <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_register" class="form-control @error('tanggal_register') is-invalid @enderror"
                               value="{{ old('tanggal_register') }}" required>
                        @error('tanggal_register')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Klasifikasi Perkara --}}
                    <div class="col-md-12">
                        <label class="form-label fw-semibold" style="font-size:.83rem;">Klasifikasi Perkara <span class="text-danger">*</span></label>
                        <input type="text" name="klasifikasi_perkara" class="form-control @error('klasifikasi_perkara') is-invalid @enderror"
                               value="{{ old('klasifikasi_perkara') }}" placeholder="Contoh: Pidana Umum" required>
                        @error('klasifikasi_perkara')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Terdakwa --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size:.83rem;">Terdakwa <span class="text-danger">*</span></label>
                        <input type="text" name="terdakwa" class="form-control @error('terdakwa') is-invalid @enderror"
                               value="{{ old('terdakwa') }}" placeholder="Nama terdakwa" required>
                        @error('terdakwa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Penuntut Umum --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size:.83rem;">Penuntut Umum <span class="text-danger">*</span></label>
                        <input type="text" name="penuntut_umum" class="form-control @error('penuntut_umum') is-invalid @enderror"
                               value="{{ old('penuntut_umum') }}" placeholder="Nama jaksa penuntut umum" required>
                        @error('penuntut_umum')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Advokat Pendamping --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size:.83rem;">Advokat Pendamping <span class="text-danger">*</span></label>
                        <input type="text" name="advokat_pendamping" class="form-control @error('advokat_pendamping') is-invalid @enderror"
                               value="{{ old('advokat_pendamping') }}" placeholder="Nama advokat pendamping" required>
                        @error('advokat_pendamping')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Status Perkara --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size:.83rem;">Status Perkara <span class="text-danger">*</span></label>
                        <select name="status_perkara_id" class="form-select @error('status_perkara_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Status --</option>
                            @foreach($statusPerkaras as $sp)
                            <option value="{{ $sp->id }}" {{ old('status_perkara_id') == $sp->id ? 'selected' : '' }}>
                                {{ $sp->nama }}
                            </option>
                            @endforeach
                        </select>
                        @error('status_perkara_id')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Dokumen Section --}}
                <hr class="my-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="mb-0 fw-semibold" style="font-size:.85rem;">
                        <i class="fa-solid fa-paperclip me-2 text-muted"></i>Dokumen Lampiran <span class="text-muted fw-normal">(opsional, PDF)</span>
                    </h6>
                    <button type="button" id="btnTambahDokumen" class="btn btn-sm btn-outline-primary" style="font-size:.78rem;border-radius:8px;">
                        <i class="fa-solid fa-plus me-1"></i>Tambah Dokumen
                    </button>
                </div>

                <div id="dokumenContainer">
                    <div class="dokumen-row row g-2 mb-2 align-items-end">
                        <div class="col-md-5">
                            <label class="form-label" style="font-size:.78rem;color:#94a3b8;">Nama Dokumen</label>
                            <input type="text" name="nama_dokumen[]" class="form-control form-control-sm" placeholder="Contoh: Surat Dakwaan">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-size:.78rem;color:#94a3b8;">File PDF</label>
                            <input type="file" name="file[]" class="form-control form-control-sm" accept=".pdf">
                        </div>
                        <div class="col-md-1 d-flex align-items-end pb-1">
                            <button type="button" class="btn btn-sm btn-outline-danger btn-hapus-dokumen" style="border-radius:8px;" title="Hapus baris">
                                <i class="fa-solid fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>

                @error('file.*')
                    <div class="text-danger mt-1" style="font-size:.8rem;">{{ $message }}</div>
                @enderror

                {{-- Buttons --}}
                <div class="d-flex gap-2 justify-content-end mt-4 pt-3 border-top">
                    <a href="{{ route('simbakum.index') }}" class="btn btn-outline-secondary" style="border-radius:9px;font-size:.83rem;">
                        <i class="fa-solid fa-arrow-left me-1"></i>Batalkan
                    </a>
                    <button type="submit" class="btn btn-primary" style="border-radius:9px;font-size:.83rem;background:linear-gradient(135deg,#6366f1,#8b5cf6);border:none;">
                        <i class="fa-solid fa-save me-1"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        document.getElementById('btnTambahDokumen').addEventListener('click', function() {
            const container = document.getElementById('dokumenContainer');
            const newRow = document.createElement('div');
            newRow.className = 'dokumen-row row g-2 mb-2 align-items-end';
            newRow.innerHTML = `
                <div class="col-md-5">
                    <label class="form-label" style="font-size:.78rem;color:#94a3b8;">Nama Dokumen</label>
                    <input type="text" name="nama_dokumen[]" class="form-control form-control-sm" placeholder="Contoh: Surat Dakwaan">
                </div>
                <div class="col-md-6">
                    <label class="form-label" style="font-size:.78rem;color:#94a3b8;">File PDF</label>
                    <input type="file" name="file[]" class="form-control form-control-sm" accept=".pdf">
                </div>
                <div class="col-md-1 d-flex align-items-end pb-1">
                    <button type="button" class="btn btn-sm btn-outline-danger btn-hapus-dokumen" style="border-radius:8px;" title="Hapus baris">
                        <i class="fa-solid fa-times"></i>
                    </button>
                </div>
            `;
            container.appendChild(newRow);
            attachRemoveHandlers();
        });

        function attachRemoveHandlers() {
            document.querySelectorAll('.btn-hapus-dokumen').forEach(function(btn) {
                btn.onclick = function() {
                    const row = this.closest('.dokumen-row');
                    if (row) row.remove();
                };
            });
        }

        attachRemoveHandlers();
    </script>
    @endpush
</x-app-layout>
