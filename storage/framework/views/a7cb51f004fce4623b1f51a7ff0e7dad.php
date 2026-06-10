<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        Ajukan Permohonan Bantuan Layanan Litigasi
     <?php $__env->endSlot(); ?>

    <div class="row justify-content-center">
        <div class="col-xl-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 fw-bold text-primary"><i class="fa-solid fa-scale-balanced me-2"></i>Form Bantuan Layanan Litigasi</h6>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="<?php echo e(route('permohonan-litigasi.store')); ?>" enctype="multipart/form-data" id="litigasiForm">
                        <?php echo csrf_field(); ?>

                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-semibold small">No. Registrasi</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border-secondary border-opacity-50 bg-secondary bg-opacity-10" value="(Otomatis)" disabled>
                                <div class="form-text">Nomor akan dibuat otomatis saat pengiriman.</div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-semibold small">Nama <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" name="nama" class="form-control border-secondary border-opacity-50 <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('nama')); ?>" required>
                                <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-semibold small">Alamat <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <textarea name="alamat" class="form-control border-secondary border-opacity-50 <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" rows="3" required><?php echo e(old('alamat')); ?></textarea>
                                <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-semibold small">Telp/HP <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="tel" name="telp_hp" class="form-control border-secondary border-opacity-50 <?php $__errorArgs = ['telp_hp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('telp_hp')); ?>" required>
                                <?php $__errorArgs = ['telp_hp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-semibold small">NIK <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" name="nik" class="form-control border-secondary border-opacity-50 <?php $__errorArgs = ['nik'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('nik')); ?>" maxlength="16" required>
                                <?php $__errorArgs = ['nik'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-semibold small">Jenis Perkara <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" name="jenis_perkara" class="form-control border-secondary border-opacity-50 <?php $__errorArgs = ['jenis_perkara'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('jenis_perkara')); ?>" required>
                                <?php $__errorArgs = ['jenis_perkara'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-semibold small">Tgl. Rencana Kunjungan <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="date" name="tgl_rencana_kunjungan" class="form-control border-secondary border-opacity-50 <?php $__errorArgs = ['tgl_rencana_kunjungan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('tgl_rencana_kunjungan')); ?>" required>
                                <?php $__errorArgs = ['tgl_rencana_kunjungan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-semibold small">Uraian Singkat <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <textarea name="uraian_singkat" class="form-control border-secondary border-opacity-50 <?php $__errorArgs = ['uraian_singkat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" rows="4" required><?php echo e(old('uraian_singkat')); ?></textarea>
                                <?php $__errorArgs = ['uraian_singkat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <hr class="my-4">
                        <p class="small text-muted fw-semibold text-uppercase mb-3">Upload Dokumen</p>

                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-semibold small">Upload KTP/KK <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="file" name="file_ktp_kk" class="form-control border-secondary border-opacity-50 <?php $__errorArgs = ['file_ktp_kk'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" accept=".jpg,.jpeg,.png,.pdf" required>
                                <div class="form-text">Format: JPG, PNG, PDF. Maks. 2MB.</div>
                                <?php $__errorArgs = ['file_ktp_kk'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-semibold small">Upload SKTM</label>
                            <div class="col-sm-8">
                                <input type="file" name="file_sktm" class="form-control border-secondary border-opacity-50 <?php $__errorArgs = ['file_sktm'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" accept=".jpg,.jpeg,.png,.pdf">
                                <div class="form-text">Opsional. Format: JPG, PNG, PDF. Maks. 2MB.</div>
                                <?php $__errorArgs = ['file_sktm'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <hr class="my-4">
                        <p class="small text-muted fw-semibold text-uppercase mb-3">Tanda Tangan Pemohon <span class="text-danger">*</span></p>

                        <div class="mb-4">
                            <div class="border rounded p-2 mb-2" style="background-color: var(--bs-secondary-bg);">
                                <canvas id="signaturePad" class="w-100 rounded" style="height: 180px; cursor: crosshair; touch-action: none;"></canvas>
                            </div>
                            <div class="d-flex gap-2 mb-2">
                                <button type="button" class="btn btn-sm btn-outline-secondary" id="clearSignature"><i class="fa-solid fa-eraser me-1"></i>Hapus TTD</button>
                            </div>
                            <input type="hidden" name="file_ttd" id="signatureInput">
                            <?php $__errorArgs = ['file_ttd'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger small"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <div id="signatureError" class="text-danger small d-none">Tanda tangan wajib diisi.</div>
                        </div>

                        <div class="d-flex justify-content-end pt-3 border-top gap-2">
                            <a href="<?php echo e(route('permohonan-litigasi.index')); ?>" class="btn btn-light border fw-medium">Batal</a>
                            <button type="submit" class="btn btn-primary fw-bold px-4 shadow-sm" id="submitBtn"><i class="fa-solid fa-paper-plane me-1"></i> Kirim Permohonan</button>
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
        const sigError = document.getElementById('signatureError');
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

        form.addEventListener('submit', function(e) {
            if (!hasSignature) { e.preventDefault(); sigError.classList.remove('d-none'); return; }
            sigError.classList.add('d-none');
            // Crop canvas to just the signature area before saving
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
    <?php $__env->startPush('scripts'); ?>
    <script>
    // Convert dataURL signature to file upload
    document.getElementById('litigasiForm').addEventListener('submit', async function(e) {
        const input = document.getElementById('signatureInput');
        if (input.value && input.value.startsWith('data:')) {
            const res = await fetch(input.value);
            const blob = await res.blob();
            const dt = new DataTransfer();
            dt.items.add(new File([blob], 'signature.png', {type:'image/png'}));
            // Create a real file input to send
            const fileInput = document.createElement('input');
            fileInput.type = 'file';
            fileInput.name = 'file_ttd';
            fileInput.files = dt.files;
            this.appendChild(fileInput);
            input.remove();
        }
    });
    </script>
    <?php $__env->stopPush(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\lbh\resources\views/permohonan/litigasi/create.blade.php ENDPATH**/ ?>