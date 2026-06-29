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
     <?php $__env->slot('header', null, []); ?> Tambah Data SIMBAKUM <?php $__env->endSlot(); ?>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header py-3">
            <h6 class="mb-0 fw-bold" style="font-size:.9rem;">
                <i class="fa-solid fa-plus-circle me-2 text-primary"></i>Form Input SIMBAKUM
            </h6>
        </div>
        <div class="card-body p-4">
            <form action="<?php echo e(route('simbakum.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                <div class="row g-3">
                    
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size:.83rem;">No. Perkara <span class="text-danger">*</span></label>
                        <input type="text" name="no_perkara" class="form-control <?php $__errorArgs = ['no_perkara'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               value="<?php echo e(old('no_perkara')); ?>" placeholder="Contoh: 123/Pid.B/2026/PN.Sbn" required>
                        <?php $__errorArgs = ['no_perkara'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size:.83rem;">Tanggal Register <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_register" class="form-control <?php $__errorArgs = ['tanggal_register'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               value="<?php echo e(old('tanggal_register')); ?>" required>
                        <?php $__errorArgs = ['tanggal_register'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div class="col-md-12">
                        <label class="form-label fw-semibold" style="font-size:.83rem;">Klasifikasi Perkara <span class="text-danger">*</span></label>
                        <input type="text" name="klasifikasi_perkara" class="form-control <?php $__errorArgs = ['klasifikasi_perkara'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               value="<?php echo e(old('klasifikasi_perkara')); ?>" placeholder="Contoh: Pidana Umum" required>
                        <?php $__errorArgs = ['klasifikasi_perkara'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size:.83rem;">Terdakwa <span class="text-danger">*</span></label>
                        <input type="text" name="terdakwa" class="form-control <?php $__errorArgs = ['terdakwa'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               value="<?php echo e(old('terdakwa')); ?>" placeholder="Nama terdakwa" required>
                        <?php $__errorArgs = ['terdakwa'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size:.83rem;">Penuntut Umum <span class="text-danger">*</span></label>
                        <input type="text" name="penuntut_umum" class="form-control <?php $__errorArgs = ['penuntut_umum'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               value="<?php echo e(old('penuntut_umum')); ?>" placeholder="Nama jaksa penuntut umum" required>
                        <?php $__errorArgs = ['penuntut_umum'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size:.83rem;">Advokat Pendamping <span class="text-danger">*</span></label>
                        <input type="text" name="advokat_pendamping" class="form-control <?php $__errorArgs = ['advokat_pendamping'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               value="<?php echo e(old('advokat_pendamping')); ?>" placeholder="Nama advokat pendamping" required>
                        <?php $__errorArgs = ['advokat_pendamping'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size:.83rem;">Status Perkara <span class="text-danger">*</span></label>
                        <select name="status_perkara_id" class="form-select <?php $__errorArgs = ['status_perkara_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                            <option value="">-- Pilih Status --</option>
                            <?php $__currentLoopData = $statusPerkaras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($sp->id); ?>" <?php echo e(old('status_perkara_id') == $sp->id ? 'selected' : ''); ?>>
                                <?php echo e($sp->nama); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['status_perkara_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                
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

                <?php $__errorArgs = ['file.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-danger mt-1" style="font-size:.8rem;"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                
                <div class="d-flex gap-2 justify-content-end mt-4 pt-3 border-top">
                    <a href="<?php echo e(route('simbakum.index')); ?>" class="btn btn-outline-secondary" style="border-radius:9px;font-size:.83rem;">
                        <i class="fa-solid fa-arrow-left me-1"></i>Batalkan
                    </a>
                    <button type="submit" class="btn btn-primary" style="border-radius:9px;font-size:.83rem;background:linear-gradient(135deg,#6366f1,#8b5cf6);border:none;">
                        <i class="fa-solid fa-save me-1"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
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
<?php /**PATH C:\xampp\htdocs\lbh\resources\views/simbakum/create.blade.php ENDPATH**/ ?>