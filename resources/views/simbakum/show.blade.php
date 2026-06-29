<x-app-layout>
    <x-slot name="header">Detail SIMBAKUM</x-slot>

    {{-- Detail Card --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="mb-0 fw-bold" style="font-size:.9rem;">
                <i class="fa-solid fa-circle-info me-2 text-primary"></i>Detail Data Perkara
            </h6>
            <span class="{{ $simbakum->getStatusBadgeClass() }}">{{ $simbakum->getStatusLabel() }}</span>
        </div>
        <div class="card-body p-4">
            <div class="d-flex mb-3" style="font-size:.85rem;">
                <span class="fw-semibold text-muted" style="min-width:200px;">No. Perkara</span>
                <span class="text-body fw-bold">{{ $simbakum->no_perkara }}</span>
            </div>
            <div class="d-flex mb-3" style="font-size:.85rem;">
                <span class="fw-semibold text-muted" style="min-width:200px;">Tanggal Register</span>
                <span class="text-body">{{ $simbakum->tanggal_register?->format('d M Y') ?? '-' }}</span>
            </div>
            <div class="d-flex mb-3" style="font-size:.85rem;">
                <span class="fw-semibold text-muted" style="min-width:200px;">Klasifikasi Perkara</span>
                <span class="text-body">{{ $simbakum->klasifikasi_perkara }}</span>
            </div>
            <div class="d-flex mb-3" style="font-size:.85rem;">
                <span class="fw-semibold text-muted" style="min-width:200px;">Terdakwa</span>
                <span class="text-body">{{ $simbakum->terdakwa }}</span>
            </div>
            <div class="d-flex mb-3" style="font-size:.85rem;">
                <span class="fw-semibold text-muted" style="min-width:200px;">Penuntut Umum</span>
                <span class="text-body">{{ $simbakum->penuntut_umum }}</span>
            </div>
            <div class="d-flex mb-3" style="font-size:.85rem;">
                <span class="fw-semibold text-muted" style="min-width:200px;">Advokat Pendamping</span>
                <span class="text-body">{{ $simbakum->advokat_pendamping }}</span>
            </div>
            <div class="d-flex mb-3" style="font-size:.85rem;">
                <span class="fw-semibold text-muted" style="min-width:200px;">Status Perkara</span>
                <span class="{{ $simbakum->getStatusBadgeClass() }}">{{ $simbakum->getStatusLabel() }}</span>
            </div>
            <div class="d-flex mb-0" style="font-size:.85rem;">
                <span class="fw-semibold text-muted" style="min-width:200px;">Lama Proses</span>
                <span class="text-body">{{ $simbakum->getLamaProses() }}</span>
            </div>
        </div>
    </div>

    {{-- Dokumen Card --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header py-3">
            <h6 class="mb-0 fw-bold" style="font-size:.9rem;">
                <i class="fa-solid fa-folder-open me-2 text-muted"></i>Dokumen Terlampir
            </h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-sm mb-0" style="font-size:.83rem;">
                    <thead style="background:rgba(99,102,241,.05);">
                        <tr>
                            <th style="padding:12px 20px;font-size:.7rem;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;">No.</th>
                            <th style="padding:12px 16px;font-size:.7rem;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;">Nama Dokumen</th>
                            <th style="padding:12px 16px;font-size:.7rem;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;text-align:right;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="dokumenTableBody">
                        @forelse($simbakum->dokumens as $dokumen)
                        <tr id="dokumen-row-{{ $dokumen->id }}" style="border-bottom:1px solid rgba(0,0,0,.04);">
                            <td style="padding:12px 20px;color:#94a3b8;">{{ $loop->iteration }}</td>
                            <td style="padding:12px 16px;">
                                <i class="fa-solid fa-file-pdf text-danger me-2" style="font-size:.85rem;"></i>
                                {{ $dokumen->nama_dokumen }}
                            </td>
                            <td style="padding:12px 16px;text-align:right;">
                                <div class="d-flex gap-1 justify-content-end">
                                    <a href="{{ $dokumen->url }}" target="_blank" class="btn btn-sm btn-outline-primary" style="font-size:.73rem;border-radius:7px;">
                                        <i class="fa-solid fa-download me-1"></i>Unduh
                                    </a>
                                    @if(auth()->user()->role === 'admin')
                                    <button type="button"
                                        class="btn btn-sm btn-outline-danger btn-hapus-dokumen"
                                        style="font-size:.73rem;border-radius:7px;"
                                        data-id="{{ $dokumen->id }}"
                                        data-url="{{ route('simbakum.dokumen.destroy', $dokumen) }}">
                                        <i class="fa-solid fa-trash me-1"></i>Hapus
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr id="emptyDokumenRow">
                            <td colspan="3" class="text-center text-muted py-4" style="font-size:.83rem;">
                                <i class="fa-solid fa-folder-open me-2"></i>Belum ada dokumen terlampir.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Upload form for admin --}}
            @if(auth()->user()->role === 'admin')
            <div class="p-4 border-top" style="border-color:rgba(0,0,0,.06)!important;">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="mb-0 fw-semibold" style="font-size:.83rem;">
                        <i class="fa-solid fa-upload me-2 text-muted"></i>Upload Dokumen Baru
                    </h6>
                    <button type="button" id="btnTambahDokumenShow" class="btn btn-sm btn-outline-primary" style="font-size:.78rem;border-radius:8px;">
                        <i class="fa-solid fa-plus me-1"></i>Tambah Baris
                    </button>
                </div>
                <form action="{{ route('simbakum.dokumen.upload', $simbakum) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div id="uploadDokumenContainer">
                        <div class="upload-dok-row row g-2 mb-2 align-items-end">
                            <div class="col-md-5">
                                <label class="form-label" style="font-size:.78rem;color:#94a3b8;">Nama Dokumen</label>
                                <input type="text" name="new_nama_dokumen[]" class="form-control form-control-sm" placeholder="Nama dokumen">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" style="font-size:.78rem;color:#94a3b8;">File PDF</label>
                                <input type="file" name="new_file[]" class="form-control form-control-sm" accept=".pdf">
                            </div>
                            <div class="col-md-1 d-flex align-items-end pb-1">
                                <button type="button" class="btn btn-sm btn-outline-danger btn-hapus-upload-row" style="border-radius:8px;" title="Hapus">
                                    <i class="fa-solid fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-sm btn-primary" style="border-radius:8px;font-size:.8rem;background:linear-gradient(135deg,#6366f1,#8b5cf6);border:none;">
                            <i class="fa-solid fa-cloud-upload-alt me-1"></i>Upload
                        </button>
                    </div>
                </form>
            </div>
            @endif
        </div>
    </div>

    {{-- Bottom Buttons --}}
    <div class="d-flex gap-2">
        <a href="{{ route('simbakum.index') }}" class="btn btn-outline-secondary" style="border-radius:9px;font-size:.83rem;">
            <i class="fa-solid fa-arrow-left me-1"></i>Kembali
        </a>
        @if(auth()->user()->role === 'admin')
        <a href="{{ route('simbakum.edit', $simbakum) }}" class="btn btn-warning text-white" style="border-radius:9px;font-size:.83rem;">
            <i class="fa-solid fa-pen-to-square me-1"></i>Edit
        </a>
        @endif
    </div>

    @push('scripts')
    <script>
        // Add new upload row
        document.getElementById('btnTambahDokumenShow')?.addEventListener('click', function() {
            const container = document.getElementById('uploadDokumenContainer');
            const newRow = document.createElement('div');
            newRow.className = 'upload-dok-row row g-2 mb-2 align-items-end';
            newRow.innerHTML = `
                <div class="col-md-5">
                    <label class="form-label" style="font-size:.78rem;color:#94a3b8;">Nama Dokumen</label>
                    <input type="text" name="new_nama_dokumen[]" class="form-control form-control-sm" placeholder="Nama dokumen">
                </div>
                <div class="col-md-6">
                    <label class="form-label" style="font-size:.78rem;color:#94a3b8;">File PDF</label>
                    <input type="file" name="new_file[]" class="form-control form-control-sm" accept=".pdf">
                </div>
                <div class="col-md-1 d-flex align-items-end pb-1">
                    <button type="button" class="btn btn-sm btn-outline-danger btn-hapus-upload-row" style="border-radius:8px;" title="Hapus">
                        <i class="fa-solid fa-times"></i>
                    </button>
                </div>
            `;
            container.appendChild(newRow);
            attachUploadRemoveHandlers();
        });

        function attachUploadRemoveHandlers() {
            document.querySelectorAll('.btn-hapus-upload-row').forEach(function(btn) {
                btn.onclick = function() {
                    const row = this.closest('.upload-dok-row');
                    if (row) row.remove();
                };
            });
        }

        attachUploadRemoveHandlers();

        // AJAX delete dokumen
        document.querySelectorAll('.btn-hapus-dokumen').forEach(function(btn) {
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
                .catch(function() {
                    alert('Terjadi kesalahan saat menghapus dokumen.');
                });
            });
        });
    </script>
    @endpush
</x-app-layout>
