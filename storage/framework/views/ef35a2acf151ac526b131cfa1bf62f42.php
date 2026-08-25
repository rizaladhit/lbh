<p class="text-muted small mb-3">
    <?php echo e(__('Setelah akun Anda dihapus, semua data dan sumber daya terkait akan dihapus secara permanen. Silakan unduh data yang ingin Anda simpan sebelum menghapus akun.')); ?>

</p>

<button type="button" class="btn btn-outline-danger fw-semibold" data-bs-toggle="modal" data-bs-target="#confirmUserDeletion">
    <i class="fa-solid fa-trash-can me-1"></i> <?php echo e(__('Hapus Akun')); ?>

</button>

<div class="modal fade" id="confirmUserDeletion" tabindex="-1" aria-labelledby="confirmUserDeletionLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:14px;border:none;box-shadow:0 8px 32px rgba(0,0,0,.12);">
            <form method="post" action="<?php echo e(route('profile.destroy')); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('delete'); ?>

                <div class="modal-header" style="border-bottom:1px solid rgba(0,0,0,.06);">
                    <h5 class="modal-title fw-bold text-danger" id="confirmUserDeletionLabel">
                        <i class="fa-solid fa-triangle-exclamation me-2"></i><?php echo e(__('Yakin ingin menghapus akun?')); ?>

                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted small">
                        <?php echo e(__('Setelah akun dihapus, semua data akan hilang secara permanen. Masukkan password Anda untuk mengonfirmasi.')); ?>

                    </p>

                    <label for="password" class="form-label fw-semibold"><?php echo e(__('Password')); ?></label>
                    <input id="password" name="password" type="password"
                           class="form-control <?php $__errorArgs = ['password', 'userDeletion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           placeholder="<?php echo e(__('Password')); ?>">
                    <?php $__errorArgs = ['password', 'userDeletion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="modal-footer" style="border-top:1px solid rgba(0,0,0,.06);">
                    <button type="button" class="btn btn-light fw-medium" data-bs-dismiss="modal"><?php echo e(__('Batal')); ?></button>
                    <button type="submit" class="btn btn-danger fw-bold"><?php echo e(__('Hapus Akun')); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php if($errors->userDeletion->isNotEmpty()): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new bootstrap.Modal(document.getElementById('confirmUserDeletion')).show();
        });
    </script>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\lbh\resources\views/profile/partials/delete-user-form.blade.php ENDPATH**/ ?>