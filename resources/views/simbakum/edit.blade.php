<x-app-layout>
    <x-slot name="header">Edit Data SIMBAKUM</x-slot>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header py-3">
            <h6 class="mb-0 fw-bold" style="font-size:.9rem;">
                <i class="fa-solid fa-pen-to-square me-2 text-warning"></i>Edit Data SIMBAKUM — {{ $simbakum->no_perkara }}
            </h6>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('simbakum.update', $simbakum) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    {{-- No. Perkara --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size:.83rem;">No. Perkara <span class="text-danger">*</span></label>
                        <input type="text" name="no_perkara" class="form-control @error('no_perkara') is-invalid @enderror"
                               value="{{ old('no_perkara', $simbakum->no_perkara) }}" required>
                        @error('no_perkara')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tanggal Register --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size:.83rem;">Tanggal Register <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_register" class="form-control @error('tanggal_register') is-invalid @enderror"
                               value="{{ old('tanggal_register', $simbakum->tanggal_register?->format('Y-m-d')) }}" required>
                        @error('tanggal_register')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Klasifikasi Perkara --}}
                    <div class="col-md-12">
                        <label class="form-label fw-semibold" style="font-size:.83rem;">Klasifikasi Perkara <span class="text-danger">*</span></label>
                        <input type="text" name="klasifikasi_perkara" class="form-control @error('klasifikasi_perkara') is-invalid @enderror"
                               value="{{ old('klasifikasi_perkara', $simbakum->klasifikasi_perkara) }}" required>
                        @error('klasifikasi_perkara')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Terdakwa --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size:.83rem;">Terdakwa <span class="text-danger">*</span></label>
                        <input type="text" name="terdakwa" class="form-control @error('terdakwa') is-invalid @enderror"
                               value="{{ old('terdakwa', $simbakum->terdakwa) }}" required>
                        @error('terdakwa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Penuntut Umum --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size:.83rem;">Penuntut Umum <span class="text-danger">*</span></label>
                        <input type="text" name="penuntut_umum" class="form-control @error('penuntut_umum') is-invalid @enderror"
                               value="{{ old('penuntut_umum', $simbakum->penuntut_umum) }}" required>
                        @error('penuntut_umum')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Advokat Pendamping --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size:.83rem;">Advokat Pendamping <span class="text-danger">*</span></label>
                        <input type="text" name="advokat_pendamping" class="form-control @error('advokat_pendamping') is-invalid @enderror"
                               value="{{ old('advokat_pendamping', $simbakum->advokat_pendamping) }}" required>
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
                            <option value="{{ $sp->id }}" {{ old('status_perkara_id', $simbakum->status_perkara_id) == $sp->id ? 'selected' : '' }}>
                                {{ $sp->nama }}
                            </option>
                            @endforeach
                        </select>
                        @error('status_perkara_id')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Existing Documents --}}
                @if($simbakum->dokumens->isNotEmpty())
                <hr class="my-4">
                <h6 class="fw-semibold mb-3" style="font-size:.85rem;">
                    <i class="fa-solid fa-folder-open me-2 text-muted"></i>Dokumen Yang Sudah Ada
                </h6>
                <div class="table-responsive mb-3">
                    <table class="table table-sm table-bordered" style="font-size:.83rem;border-color:rgba(0,0,0,.07);">
                        <thead style="background:rgba(99,102,241,.06);">
                            <tr>
                                <th style="font-size:.7rem;color:#94a3b8;text-transform:uppercase;letter-spacing:.5px;">Nama Dokumen</th>
                                <th style="font-size:.7rem;color:#94a3b8;text-transform:uppercase;letter-spacing:.5px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="existingDokumensTable">
                            @foreach($simbakum->dokumens as $dokumen)
                            <tr id="dokumen-row-{{ $dokumen->id }}">
                                <td>
                                    <i class="fa-solid fa-file-pdf text-danger me-2" style="font-size:.8rem;"></i>
                                    {{ $dokumen->nama_dokumen }}
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ $dokumen->url }}" target="_blank" class="btn btn-sm btn-outline-primary" style="font-size:.73rem;border-radius:7px;">
                                            <i class="fa-solid fa-download me-1"></i>Unduh
                                        </a>
                                        <button type="button"
                                            class="btn btn-sm btn-outline-danger btn-hapus-dokumen-existing"
                                            style="font-size:.73rem;border-radius:7px;"
                                            data-id="{{ $dokumen->id }}"
                                            data-url="{{ route('simbakum.dokumen.destroy', $dokumen) }}">
                                            <i class="fa-solid fa-trash me-1"></i>Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif

                {{-- New Document Uploads --}}
                <hr class="my-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="mb-0 fw-semibold" style="font-size:.85rem;">
                        <i class="fa-solid fa-upload me-2 text-muted"></i>Upload Dokumen Baru <span class="text-muted fw-normal">(opsional, PDF)</span>
                    </h6>
                    <button type="button" id="btnTambahDokumenBaru" class="btn btn-sm btn-outline-primary" style="font-size:.78rem;border-radius:8px;">
                        <i class="fa-solid fa-plus me-1"></i>Tambah Dokumen
                    </button>
                </div>

                <div id="newDokumenContainer">
                    <div class="new-dokumen-row row g-2 mb-2 align-items-end">
                        <div class="col-md-5">
                            <label class="form-label" style="font-size:.78rem;color:#94a3b8;">Nama Dokumen</label>
                            <input type="text" name="new_nama_dokumen[]" class="form-control form-control-sm" placeholder="Contoh: Putusan Hakim">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-size:.78rem;color:#94a3b8;">File PDF</label>
                            <input type="file" name="new_file[]" class="form-control form-control-sm" accept=".pdf">
                        </div>
                        <div class="col-md-1 d-flex align-items-end pb-1">
                            <button type="button" class="btn btn-sm btn-outline-danger btn-hapus-new-dokumen" style="border-radius:8px;" title="Hapus baris">
                                <i class="fa-solid fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>

                @error('new_file.*')
                    <div class="text-danger mt-1" style="font-size:.8rem;">{{ $message }}</div>
                @enderror

                {{-- Buttons --}}
                <div class="d-flex gap-2 justify-content-end mt-4 pt-3 border-top">
                    <a href="{{ route('simbakum.show', $simbakum) }}" class="btn btn-outline-secondary" style="border-radius:9px;font-size:.83rem;">
                        <i class="fa-solid fa-arrow-left me-1"></i>Batalkan
                    </a>
                    <button type="submit" class="btn btn-warning text-white" style="border-radius:9px;font-size:.83rem;">
                        <i class="fa-solid fa-save me-1"></i>Perbarui
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        // Add new document row
        document.getElementById('btnTambahDokumenBaru').addEventListener('click', function() {
            const container = document.getElementById('newDokumenContainer');
            const newRow = document.createElement('div');
            newRow.className = 'new-dokumen-row row g-2 mb-2 align-items-end';
            newRow.innerHTML = `
                <div class="col-md-5">
                    <label class="form-label" style="font-size:.78rem;color:#94a3b8;">Nama Dokumen</label>
                    <input type="text" name="new_nama_dokumen[]" class="form-control form-control-sm" placeholder="Contoh: Putusan Hakim">
                </div>
                <div class="col-md-6">
                    <label class="form-label" style="font-size:.78rem;color:#94a3b8;">File PDF</label>
                    <input type="file" name="new_file[]" class="form-control form-control-sm" accept=".pdf">
                </div>
                <div class="col-md-1 d-flex align-items-end pb-1">
                    <button type="button" class="btn btn-sm btn-outline-danger btn-hapus-new-dokumen" style="border-radius:8px;" title="Hapus baris">
                        <i class="fa-solid fa-times"></i>
                    </button>
                </div>
            `;
            container.appendChild(newRow);
            attachNewRemoveHandlers();
        });

        function attachNewRemoveHandlers() {
            document.querySelectorAll('.btn-hapus-new-dokumen').forEach(function(btn) {
                btn.onclick = function() {
                    const row = this.closest('.new-dokumen-row');
                    if (row) row.remove();
                };
            });
        }

        attachNewRemoveHandlers();

        // AJAX delete existing dokumen
        document.querySelectorAll('.btn-hapus-dokumen-existing').forEach(function(btn) {
            btn.addEventListener('click', function() {
                if (!confirm('Hapus dokumen ini secara permanen?')) return;

                const id  = this.dataset.id;
                const url = this.dataset.url;
                const row = document.getElementById('dokumen-row-' + id);
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    }
                })
                .then(function(response) { return response.json(); })
                .then(function(data) {
                    if (data.success && row) {
                        row.remove();
                    }
                })
                .catch(function(err) {
                    alert('Terjadi kesalahan saat menghapus dokumen.');
                });
            });
        });
    </script>
    @endpush
</x-app-layout>
