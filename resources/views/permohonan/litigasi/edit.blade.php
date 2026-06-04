<x-app-layout>
    <x-slot name="header">
        Edit Permohonan Bantuan Layanan Litigasi
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-xl-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 fw-bold text-primary"><i class="fa-solid fa-scale-balanced me-2"></i>Edit Permohonan Bantuan Litigasi</h6>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('permohonan-litigasi.update', $permohonanLitigasi) }}" enctype="multipart/form-data" id="litigasiForm">
                        @csrf
                        @method('PUT')

                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-semibold small">No. Registrasi</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border-secondary border-opacity-50 bg-secondary bg-opacity-10" value="{{ $permohonanLitigasi->no_registrasi }}" disabled>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-semibold small">Nama <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" name="nama" class="form-control border-secondary border-opacity-50 @error('nama') is-invalid @enderror" value="{{ old('nama', $permohonanLitigasi->nama) }}" required>
                                @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-semibold small">Alamat <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <textarea name="alamat" class="form-control border-secondary border-opacity-50 @error('alamat') is-invalid @enderror" rows="3" required>{{ old('alamat', $permohonanLitigasi->alamat) }}</textarea>
                                @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-semibold small">Telp/HP <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="tel" name="telp_hp" class="form-control border-secondary border-opacity-50 @error('telp_hp') is-invalid @enderror" value="{{ old('telp_hp', $permohonanLitigasi->telp_hp) }}" required>
                                @error('telp_hp') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-semibold small">NIK <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" name="nik" class="form-control border-secondary border-opacity-50 @error('nik') is-invalid @enderror" value="{{ old('nik', $permohonanLitigasi->nik) }}" maxlength="16" required>
                                @error('nik') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-semibold small">Jenis Perkara <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" name="jenis_perkara" class="form-control border-secondary border-opacity-50 @error('jenis_perkara') is-invalid @enderror" value="{{ old('jenis_perkara', $permohonanLitigasi->jenis_perkara) }}" required>
                                @error('jenis_perkara') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-semibold small">No. Perkara <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" name="no_perkara" class="form-control border-secondary border-opacity-50 @error('no_perkara') is-invalid @enderror" value="{{ old('no_perkara', $permohonanLitigasi->no_perkara) }}" required>
                                @error('no_perkara') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-semibold small">Tgl. Rencana Kunjungan <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="date" name="tgl_rencana_kunjungan" class="form-control border-secondary border-opacity-50 @error('tgl_rencana_kunjungan') is-invalid @enderror" value="{{ old('tgl_rencana_kunjungan', $permohonanLitigasi->tgl_rencana_kunjungan?->format('Y-m-d')) }}" required>
                                @error('tgl_rencana_kunjungan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-semibold small">Uraian Singkat <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <textarea name="uraian_singkat" class="form-control border-secondary border-opacity-50 @error('uraian_singkat') is-invalid @enderror" rows="4" required>{{ old('uraian_singkat', $permohonanLitigasi->uraian_singkat) }}</textarea>
                                @error('uraian_singkat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <hr class="my-4">
                        <p class="small text-muted fw-semibold text-uppercase mb-3">Upload Dokumen</p>

                        @if($permohonanLitigasi->file_ktp_kk)
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-semibold small">KTP/KK Saat Ini</label>
                            <div class="col-sm-8">
                                <a href="{{ Storage::url($permohonanLitigasi->file_ktp_kk) }}" target="_blank" class="btn btn-sm btn-outline-primary">Lihat File Saat Ini</a>
                            </div>
                        </div>
                        @endif
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-semibold small">Upload KTP/KK</label>
                            <div class="col-sm-8">
                                <input type="file" name="file_ktp_kk" class="form-control border-secondary border-opacity-50 @error('file_ktp_kk') is-invalid @enderror" accept=".jpg,.jpeg,.png,.pdf">
                                <div class="form-text">Opsional. Format: JPG, PNG, PDF. Maks. 2MB.</div>
                                @error('file_ktp_kk') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        @if($permohonanLitigasi->file_sktm)
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-semibold small">SKTM Saat Ini</label>
                            <div class="col-sm-8">
                                <a href="{{ Storage::url($permohonanLitigasi->file_sktm) }}" target="_blank" class="btn btn-sm btn-outline-primary">Lihat File Saat Ini</a>
                            </div>
                        </div>
                        @endif
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-semibold small">Upload SKTM</label>
                            <div class="col-sm-8">
                                <input type="file" name="file_sktm" class="form-control border-secondary border-opacity-50 @error('file_sktm') is-invalid @enderror" accept=".jpg,.jpeg,.png,.pdf">
                                <div class="form-text">Opsional. Format: JPG, PNG, PDF. Maks. 2MB.</div>
                                @error('file_sktm') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <hr class="my-4">
                        <p class="small text-muted fw-semibold text-uppercase mb-3">Tanda Tangan Pemohon <span class="text-muted">(Opsional)</span></p>

                        @if($permohonanLitigasi->file_ttd)
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-semibold small">TTD Saat Ini</label>
                            <div class="col-sm-8">
                                <img src="{{ Storage::url($permohonanLitigasi->file_ttd) }}" class="img-thumbnail" style="max-height: 120px;" alt="TTD Saat Ini">
                            </div>
                        </div>
                        @endif
                        <div class="mb-4">
                            <div class="border rounded p-2 mb-2" style="background-color: var(--bs-secondary-bg);">
                                <canvas id="signaturePad" class="w-100 rounded" style="height: 180px; cursor: crosshair; touch-action: none;"></canvas>
                            </div>
                            <div class="d-flex gap-2 mb-2">
                                <button type="button" class="btn btn-sm btn-outline-secondary" id="clearSignature"><i class="fa-solid fa-eraser me-1"></i>Hapus TTD</button>
                                <span class="text-muted small">Gambar ulang tanda tangan jika ingin mengganti.</span>
                            </div>
                            <input type="hidden" name="file_ttd" id="signatureInput">
                            @error('file_ttd') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="d-flex justify-content-end pt-3 border-top gap-2">
                            <a href="{{ route('permohonan-litigasi.show', $permohonanLitigasi) }}" class="btn btn-light border fw-medium">Batal</a>
                            <button type="submit" class="btn btn-primary fw-bold px-4 shadow-sm" id="submitBtn"><i class="fa-solid fa-pen-to-square me-1"></i> Perbarui Permohonan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const canvas = document.getElementById('signaturePad');
        const ctx = canvas.getContext('2d');
        const input = document.getElementById('signatureInput');
        const clearBtn = document.getElementById('clearSignature');
        const form = document.getElementById('litigasiForm');
        let isDrawing = false, hasSignature = false;

        function resizeCanvas() {
            const data = canvas.toDataURL();
            canvas.width = canvas.offsetWidth;
            canvas.height = 180;
            ctx.fillStyle = 'white'; ctx.fillRect(0,0,canvas.width,canvas.height);
            const img = new Image(); img.onload = () => ctx.drawImage(img, 0, 0); img.src = data;
        }
        resizeCanvas();
        window.addEventListener('resize', resizeCanvas);

        function getPos(e) {
            const rect = canvas.getBoundingClientRect();
            const src = e.touches ? e.touches[0] : e;
            return { x: src.clientX - rect.left, y: src.clientY - rect.top };
        }

        canvas.addEventListener('mousedown', e => { isDrawing = true; const p = getPos(e); ctx.beginPath(); ctx.moveTo(p.x, p.y); });
        canvas.addEventListener('mousemove', e => { if (!isDrawing) return; const p = getPos(e); ctx.lineTo(p.x, p.y); ctx.strokeStyle = '#212529'; ctx.lineWidth = 2; ctx.lineCap = 'round'; ctx.stroke(); hasSignature = true; });
        canvas.addEventListener('mouseup', () => { isDrawing = false; ctx.closePath(); });
        canvas.addEventListener('touchstart', e => { e.preventDefault(); isDrawing = true; const p = getPos(e); ctx.beginPath(); ctx.moveTo(p.x, p.y); }, {passive:false});
        canvas.addEventListener('touchmove', e => { e.preventDefault(); if (!isDrawing) return; const p = getPos(e); ctx.lineTo(p.x, p.y); ctx.strokeStyle = '#212529'; ctx.lineWidth = 2; ctx.lineCap = 'round'; ctx.stroke(); hasSignature = true; }, {passive:false});
        canvas.addEventListener('touchend', () => { isDrawing = false; ctx.closePath(); });

        clearBtn.addEventListener('click', () => { ctx.clearRect(0,0,canvas.width,canvas.height); ctx.fillStyle='white'; ctx.fillRect(0,0,canvas.width,canvas.height); hasSignature = false; input.value = ''; });

        form.addEventListener('submit', async function(e) {
            if (!hasSignature) {
                return;
            }
            const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
            const pixels = imageData.data;
            let top = canvas.height, bottom = 0, left = canvas.width, right = 0;
            for (let y = 0; y < canvas.height; y++) {
                for (let x = 0; x < canvas.width; x++) {
                    const i = (y * canvas.width + x) * 4;
                    if (pixels[i] < 245 || pixels[i+1] < 245 || pixels[i+2] < 245) {
                        if (y < top) top = y;
                        if (y > bottom) bottom = y;
                        if (x < left) left = x;
                        if (x > right) right = x;
                    }
                }
            }
            const pad = 20;
            top = Math.max(0, top - pad); bottom = Math.min(canvas.height, bottom + pad);
            left = Math.max(0, left - pad); right = Math.min(canvas.width, right + pad);
            const w = right - left || canvas.width;
            const h = bottom - top || canvas.height;
            const tmp = document.createElement('canvas');
            tmp.width = w; tmp.height = h;
            tmp.getContext('2d').drawImage(canvas, left, top, w, h, 0, 0, w, h);
            input.value = tmp.toDataURL('image/png');
        });
    });
    </script>
</x-app-layout>
