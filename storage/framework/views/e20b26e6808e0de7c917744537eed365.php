<?php if (isset($component)) { $__componentOriginal69dc84650370d1d4dc1b42d016d7226b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b = $attributes; } ?>
<?php $component = App\View\Components\GuestLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\GuestLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div style="margin-bottom:28px;text-align:center;">
        <h4 style="font-weight:800;font-size:1.35rem;letter-spacing:-0.5px;" class="text-body mb-2">Buat Akun Baru ✨</h4>
        <p style="color:#64748b;font-size:.85rem;margin:0;">Daftar untuk mengakses sistem LBH Panel.</p>
    </div>

    <form method="POST" action="<?php echo e(route('register')); ?>">
        <?php echo csrf_field(); ?>

        <!-- Name -->
        <div style="margin-bottom:18px;">
            <label for="name" style="display:block;margin-bottom:6px;font-size:.8rem;font-weight:600;" class="text-body"><?php echo e(__('Nama Lengkap')); ?></label>
            <div class="input-icon-wrap">
                <i class="fa-regular fa-user"></i>
                <input id="name" class="form-control form-control-mod w-100" type="text" name="name" value="<?php echo e(old('name')); ?>" required autofocus autocomplete="name" placeholder="Budi Santoso" />
            </div>
            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div style="color:#ef4444;font-size:.75rem;margin-top:6px;font-weight:500;"><i class="fa-solid fa-circle-exclamation me-1"></i> <?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Email -->
        <div style="margin-bottom:18px;">
            <label for="email" style="display:block;margin-bottom:6px;font-size:.8rem;font-weight:600;" class="text-body"><?php echo e(__('Alamat Email')); ?></label>
            <div class="input-icon-wrap">
                <i class="fa-regular fa-envelope"></i>
                <input id="email" class="form-control form-control-mod w-100" type="email" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="username" placeholder="nama@email.com" />
            </div>
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div style="color:#ef4444;font-size:.75rem;margin-top:6px;font-weight:500;"><i class="fa-solid fa-circle-exclamation me-1"></i> <?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Password -->
        <div style="margin-bottom:18px;">
            <label for="password" style="display:block;margin-bottom:6px;font-size:.8rem;font-weight:600;" class="text-body"><?php echo e(__('Kata Sandi')); ?></label>
            <div class="input-icon-wrap">
                <i class="fa-solid fa-lock"></i>
                <input id="password" class="form-control form-control-mod w-100" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
            </div>
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div style="color:#ef4444;font-size:.75rem;margin-top:6px;font-weight:500;"><i class="fa-solid fa-circle-exclamation me-1"></i> <?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Confirm Password -->
        <div style="margin-bottom:28px;">
            <label for="password_confirmation" style="display:block;margin-bottom:6px;font-size:.8rem;font-weight:600;" class="text-body"><?php echo e(__('Konfirmasi Kata Sandi')); ?></label>
            <div class="input-icon-wrap">
                <i class="fa-solid fa-lock"></i>
                <input id="password_confirmation" class="form-control form-control-mod w-100" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            </div>
            <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div style="color:#ef4444;font-size:.75rem;margin-top:6px;font-weight:500;"><i class="fa-solid fa-circle-exclamation me-1"></i> <?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <button type="submit" class="btn-auth mb-4">
            <?php echo e(__('Daftar Sekarang')); ?>

        </button>
        
        <div style="display:flex;align-items:center;margin-bottom:24px;">
            <div style="flex:1;height:1px;background:rgba(0,0,0,0.08);"></div>
            <div style="padding:0 12px;font-size:.7rem;font-weight:700;color:#94a3b8;letter-spacing:1px;">ATAU</div>
            <div style="flex:1;height:1px;background:rgba(0,0,0,0.08);"></div>
        </div>
        
        <a href="<?php echo e(route('google.login')); ?>" class="btn-google mb-4" style="text-decoration:none;">
            <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google" style="width:18px;height:18px;">
            Daftar dengan Google
        </a>
        
        <div style="text-align:center;">
            <a href="<?php echo e(route('login')); ?>" style="font-size:.82rem;font-weight:500;color:#64748b;text-decoration:none;">
                <?php echo e(__('Sudah punya akun?')); ?> <span style="color:var(--brand-1);font-weight:700;">Masuk di sini</span>
            </a>
        </div>
    </form>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $attributes = $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $component = $__componentOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\lbh\resources\views\auth\register.blade.php ENDPATH**/ ?>