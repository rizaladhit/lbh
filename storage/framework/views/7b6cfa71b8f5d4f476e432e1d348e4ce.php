<form method="post" action="<?php echo e(route('profile.update')); ?>">
    <?php echo csrf_field(); ?>
    <?php echo method_field('patch'); ?>

    <div class="mb-3">
        <label for="name" class="form-label fw-semibold"><?php echo e(__('Nama')); ?></label>
        <input id="name" name="name" type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
               value="<?php echo e(old('name', $user->name)); ?>" required autofocus autocomplete="name">
        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label fw-semibold"><?php echo e(__('Email')); ?></label>
        <input id="email" name="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
               value="<?php echo e(old('email', $user->email)); ?>" required autocomplete="username">
        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

        <?php if($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail()): ?>
            <div class="mt-2">
                <form id="send-verification" method="post" action="<?php echo e(route('verification.send')); ?>">
                    <?php echo csrf_field(); ?>
                </form>
                <p class="small text-muted mb-0">
                    <?php echo e(__('Alamat email Anda belum terverifikasi.')); ?>

                    <button form="send-verification" class="btn btn-link btn-sm p-0 align-baseline">
                        <?php echo e(__('Klik di sini untuk kirim ulang email verifikasi.')); ?>

                    </button>
                </p>

                <?php if(session('status') === 'verification-link-sent'): ?>
                    <p class="small text-success fw-semibold mt-1 mb-0">
                        <?php echo e(__('Tautan verifikasi baru telah dikirim ke alamat email Anda.')); ?>

                    </p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="d-flex align-items-center gap-3 pt-2 border-top">
        <button type="submit" class="btn btn-primary fw-bold px-4 shadow-sm mt-3">
            <i class="fa-solid fa-floppy-disk me-1"></i> <?php echo e(__('Simpan')); ?>

        </button>

        <?php if(session('status') === 'profile-updated'): ?>
            <span class="text-success small mt-3" id="profile-updated-status">
                <i class="fa-solid fa-check me-1"></i><?php echo e(__('Tersimpan.')); ?>

            </span>
            <script>
                setTimeout(() => {
                    const el = document.getElementById('profile-updated-status');
                    if (el) el.style.display = 'none';
                }, 2000);
            </script>
        <?php endif; ?>
    </div>
</form>
<?php /**PATH C:\xampp\htdocs\lbh\resources\views/profile/partials/update-profile-information-form.blade.php ENDPATH**/ ?>