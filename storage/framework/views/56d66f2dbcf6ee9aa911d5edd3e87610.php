<form method="post" action="<?php echo e(route('password.update')); ?>">
    <?php echo csrf_field(); ?>
    <?php echo method_field('put'); ?>

    <div class="mb-3">
        <label for="update_password_current_password" class="form-label fw-semibold"><?php echo e(__('Password Saat Ini')); ?></label>
        <input id="update_password_current_password" name="current_password" type="password"
               class="form-control <?php $__errorArgs = ['current_password', 'updatePassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
               autocomplete="current-password">
        <?php $__errorArgs = ['current_password', 'updatePassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div class="mb-3">
        <label for="update_password_password" class="form-label fw-semibold"><?php echo e(__('Password Baru')); ?></label>
        <input id="update_password_password" name="password" type="password"
               class="form-control <?php $__errorArgs = ['password', 'updatePassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
               autocomplete="new-password">
        <?php $__errorArgs = ['password', 'updatePassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div class="mb-3">
        <label for="update_password_password_confirmation" class="form-label fw-semibold"><?php echo e(__('Konfirmasi Password Baru')); ?></label>
        <input id="update_password_password_confirmation" name="password_confirmation" type="password"
               class="form-control <?php $__errorArgs = ['password_confirmation', 'updatePassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
               autocomplete="new-password">
        <?php $__errorArgs = ['password_confirmation', 'updatePassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div class="d-flex align-items-center gap-3 pt-2 border-top">
        <button type="submit" class="btn btn-primary fw-bold px-4 shadow-sm mt-3">
            <i class="fa-solid fa-floppy-disk me-1"></i> <?php echo e(__('Simpan')); ?>

        </button>

        <?php if(session('status') === 'password-updated'): ?>
            <span class="text-success small mt-3" id="password-updated-status">
                <i class="fa-solid fa-check me-1"></i><?php echo e(__('Tersimpan.')); ?>

            </span>
            <script>
                setTimeout(() => {
                    const el = document.getElementById('password-updated-status');
                    if (el) el.style.display = 'none';
                }, 2000);
            </script>
        <?php endif; ?>
    </div>
</form>
<?php /**PATH C:\xampp\htdocs\lbh\resources\views/profile/partials/update-password-form.blade.php ENDPATH**/ ?>