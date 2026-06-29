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
     <?php $__env->slot('header', null, []); ?> Edit Status Perkara <?php $__env->endSlot(); ?>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header py-3">
            <h6 class="mb-0 fw-bold" style="font-size:.9rem;">
                <i class="fa-solid fa-pen-to-square me-2 text-warning"></i>Edit Status Perkara — <?php echo e($statusPerkara->nama); ?>

            </h6>
        </div>
        <div class="card-body p-4">
            <form action="<?php echo e(route('status-perkara.update', $statusPerkara)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="row g-3">
                    
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size:.83rem;">Nama <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               value="<?php echo e(old('nama', $statusPerkara->nama)); ?>" placeholder="Contoh: Sidang Pertama" required>
                        <?php $__errorArgs = ['nama'];
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

                    
                    <div class="col-md-3">
                        <label class="form-label fw-semibold" style="font-size:.83rem;">Warna <span class="text-danger">*</span></label>
                        <select name="warna" class="form-select <?php $__errorArgs = ['warna'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                            <option value="secondary" <?php echo e(old('warna', $statusPerkara->warna) === 'secondary' ? 'selected' : ''); ?>>Abu-abu (secondary)</option>
                            <option value="info"      <?php echo e(old('warna', $statusPerkara->warna) === 'info'      ? 'selected' : ''); ?>>Biru (info)</option>
                            <option value="warning"   <?php echo e(old('warna', $statusPerkara->warna) === 'warning'   ? 'selected' : ''); ?>>Kuning (warning)</option>
                            <option value="danger"    <?php echo e(old('warna', $statusPerkara->warna) === 'danger'    ? 'selected' : ''); ?>>Merah (danger)</option>
                            <option value="success"   <?php echo e(old('warna', $statusPerkara->warna) === 'success'   ? 'selected' : ''); ?>>Hijau (success)</option>
                            <option value="primary"   <?php echo e(old('warna', $statusPerkara->warna) === 'primary'   ? 'selected' : ''); ?>>Ungu (primary)</option>
                        </select>
                        <?php $__errorArgs = ['warna'];
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

                    
                    <div class="col-md-3">
                        <label class="form-label fw-semibold" style="font-size:.83rem;">Urutan <span class="text-danger">*</span></label>
                        <input type="number" name="urutan" class="form-control <?php $__errorArgs = ['urutan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               value="<?php echo e(old('urutan', $statusPerkara->urutan)); ?>" min="0" required>
                        <?php $__errorArgs = ['urutan'];
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
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_final" id="is_final" value="1"
                                   <?php echo e(old('is_final', $statusPerkara->is_final) ? 'checked' : ''); ?>>
                            <label class="form-check-label fw-semibold" for="is_final" style="font-size:.83rem;">
                                Tandai sebagai status Selesai (membekukan counter Lama Proses)
                            </label>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2 justify-content-end mt-4 pt-3 border-top">
                    <a href="<?php echo e(route('status-perkara.index')); ?>" class="btn btn-outline-secondary" style="border-radius:9px;font-size:.83rem;">
                        <i class="fa-solid fa-arrow-left me-1"></i>Batalkan
                    </a>
                    <button type="submit" class="btn btn-warning text-white" style="border-radius:9px;font-size:.83rem;">
                        <i class="fa-solid fa-save me-1"></i>Perbarui
                    </button>
                </div>
            </form>
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
<?php /**PATH C:\xampp\htdocs\lbh\resources\views/status-perkara/edit.blade.php ENDPATH**/ ?>