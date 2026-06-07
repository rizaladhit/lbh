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
        Tugaskan Permohonan Litigasi
     <?php $__env->endSlot(); ?>

    <div class="row justify-content-center">
        <div class="col-xl-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header py-3 bg-info">
                    <h6 class="m-0 fw-bold text-white"><i class="fa-solid fa-user-check me-2"></i>Tugaskan Permohonan Litigasi</h6>
                </div>
                <div class="card-body p-4">
                    <form action="<?php echo e(route('permohonan-litigasi.storeAssign', $permohonanLitigasi)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <p class="text-muted mb-4">
                            Tugaskan permohonan litigasi dari <strong><?php echo e($permohonanLitigasi->nama); ?></strong> 
                            (No. Registrasi: <strong><?php echo e($permohonanLitigasi->no_registrasi); ?></strong>) 
                            kepada advocate atau paralegal.
                        </p>

                        <div class="mb-3">
                            <label for="assigned_lawyer_id" class="form-label fw-semibold">Pilih Advocate</label>
                            <select class="form-select <?php $__errorArgs = ['assigned_lawyer_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                id="assigned_lawyer_id" name="assigned_lawyer_id">
                                <option value="">-- Tidak ada --</option>
                                <?php $__currentLoopData = $lawyers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lawyer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($lawyer->id); ?>" <?php echo e(old('assigned_lawyer_id', $permohonanLitigasi->assigned_lawyer_id) == $lawyer->id ? 'selected' : ''); ?>>
                                    <?php echo e($lawyer->name); ?> - <?php echo e($lawyer->specialization); ?> (<?php echo e($lawyer->no_identitas); ?>)
                                </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['assigned_lawyer_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <small class="text-muted d-block mt-2">Opsional - Pilih jika ada Advocate yang menangani kasus ini.</small>
                        </div>

                        <div class="mb-3">
                            <label for="assigned_paralegal_id" class="form-label fw-semibold">Pilih Paralegal</label>
                            <select class="form-select <?php $__errorArgs = ['assigned_paralegal_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                id="assigned_paralegal_id" name="assigned_paralegal_id">
                                <option value="">-- Tidak ada --</option>
                                <?php $__currentLoopData = $paralegals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paralegal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($paralegal->id); ?>" <?php echo e(old('assigned_paralegal_id', $permohonanLitigasi->assigned_paralegal_id) == $paralegal->id ? 'selected' : ''); ?>>
                                    <?php echo e($paralegal->name); ?> - <?php echo e($paralegal->specialization); ?> (<?php echo e($paralegal->no_identitas); ?>)
                                </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['assigned_paralegal_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <small class="text-muted d-block mt-2">Opsional - Pilih jika ada paralegal yang membantu penanganan kasus.</small>
                        </div>

                        <div class="alert alert-info" role="alert">
                            <i class="fa-solid fa-circle-info me-2"></i>
                            <strong>Catatan:</strong> Minimal pilih satu (Advocate atau paralegal) untuk menugaskan permohonan ini.
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <a href="<?php echo e(route('permohonan-litigasi.show', $permohonanLitigasi)); ?>" class="btn btn-light border fw-medium w-100">Batalkan</a>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-info fw-bold w-100">
                                    <i class="fa-solid fa-user-check me-1"></i> Tugaskan Permohonan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Detail Permohonan Summary -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 fw-bold text-primary"><i class="fa-solid fa-info-circle me-2"></i>Detail Permohonan & Status</h6>
                </div>
                <div class="card-body p-4" style="font-size: 0.95rem;">
                    <div class="d-flex border-bottom py-2 mb-3">
                        <div class="fw-semibold" style="min-width: 180px;">Status Saat Ini</div>
                        <div>
                            <span class="badge <?php echo e($permohonanLitigasi->getStatusBadgeColor()); ?> fs-6">
                                <?php echo e($permohonanLitigasi->getStatusLabel()); ?> (<?php echo e($permohonanLitigasi->status); ?>)
                            </span>
                        </div>
                    </div>

                    <?php $fields = [
                        'Nama Pemohon' => $permohonanLitigasi->nama,
                        'Nomor Registrasi' => $permohonanLitigasi->no_registrasi,
                        'Jenis Perkara' => $permohonanLitigasi->jenis_perkara,
                        'Nomor Perkara' => $permohonanLitigasi->no_perkara,
                        'Catatan Verifikasi' => $permohonanLitigasi->verification_notes ?? '-',
                    ]; ?>
                    <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="d-flex border-bottom py-2">
                        <div class="fw-semibold" style="min-width: 180px;"><?php echo e($label); ?></div>
                        <div class="text-muted">: <?php echo e($value); ?></div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
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
<?php /**PATH C:\xampp\htdocs\lbh\resources\views\permohonan\litigasi\assign.blade.php ENDPATH**/ ?>