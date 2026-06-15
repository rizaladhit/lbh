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
        Persetujuan Kelengkapan Permohonan Litigasi
     <?php $__env->endSlot(); ?>

    <div class="row justify-content-center">
        <div class="col-xl-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header py-3 bg-info">
                    <h6 class="m-0 fw-bold text-white"><i class="fa-solid fa-thumbs-up me-2"></i>Persetujuan Kelengkapan</h6>
                </div>
                <div class="card-body p-4">
                    <p class="text-muted mb-4">
                        Anda akan menandai permohonan litigasi dari <strong><?php echo e($permohonanLitigasi->nama); ?></strong>
                        dengan nomor registrasi <strong><?php echo e($permohonanLitigasi->no_registrasi); ?></strong> sebagai lengkap.
                    </p>

                    <form method="POST" action="<?php echo e(route('permohonan-litigasi.storeApprove', $permohonanLitigasi)); ?>" class="needs-validation" novalidate>
                        <?php echo csrf_field(); ?>

                        <div class="mb-3">
                            <label for="verification_notes" class="form-label fw-semibold">Catatan Pemeriksaan Kelengkapan</label>
                            <textarea class="form-control <?php $__errorArgs = ['verification_notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                id="verification_notes" name="verification_notes" rows="5"
                                placeholder="Tambahkan catatan pemeriksaan kelengkapan dokumen..."><?php echo e(old('verification_notes')); ?></textarea>
                            <?php $__errorArgs = ['verification_notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <small class="text-muted d-block mt-2">Opsional, namun disarankan untuk mencatat hasil pemeriksaan.</small>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <a href="<?php echo e(route('permohonan-litigasi.show', $permohonanLitigasi)); ?>" class="btn btn-light border fw-medium w-100">Batalkan</a>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-info fw-bold w-100">
                                    <i class="fa-solid fa-check me-1"></i> Setujui Kelengkapan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Detail Permohonan Summary -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 fw-bold text-primary"><i class="fa-solid fa-info-circle me-2"></i>Detail Permohonan</h6>
                </div>
                <div class="card-body p-4" style="font-size: 0.95rem;">
                    <?php $fields = [
                        'Nama Pemohon' => $permohonanLitigasi->nama,
                        'Nomor Registrasi' => $permohonanLitigasi->no_registrasi,
                        'Jenis Perkara' => $permohonanLitigasi->jenis_perkara,
                        'Nomor Perkara' => $permohonanLitigasi->no_perkara,
                        'Uraian Singkat' => $permohonanLitigasi->uraian_singkat,
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
<?php /**PATH C:\xampp\htdocs\lbh\resources\views/permohonan/litigasi/approve.blade.php ENDPATH**/ ?>