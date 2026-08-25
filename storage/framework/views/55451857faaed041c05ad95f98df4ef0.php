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
        Profil Saya
     <?php $__env->endSlot(); ?>

    <style>
        .profile-card { border-radius: 16px; border: none; box-shadow: 0 4px 24px rgba(0,0,0,.07); }
        [data-bs-theme="dark"] .profile-card { background: #1a2035; }
        .profile-card .card-header {
            background: transparent; padding: 18px 24px;
            border-bottom: 1px solid rgba(0,0,0,.06);
        }
        [data-bs-theme="dark"] .profile-card .card-header { border-color: rgba(255,255,255,.06); }
        .profile-card .card-body { padding: 24px; }

        .profile-summary { text-align: center; padding: 36px 24px; }
        .profile-summary img {
            width: 96px; height: 96px; border-radius: 50%;
            object-fit: cover; box-shadow: 0 6px 20px rgba(99,102,241,.3);
            margin-bottom: 16px;
        }
        .profile-summary .name { font-weight: 700; font-size: 1.1rem; margin-bottom: 4px; }
        .profile-summary .email { color: #94a3b8; font-size: .85rem; margin-bottom: 12px; }

        .role-badge {
            padding: 4px 12px; border-radius: 99px;
            font-size: .72rem; font-weight: 700;
            display: inline-flex; align-items: center; gap: 6px;
        }
        .role-badge.admin { background: rgba(239,68,68,.12); color: #ef4444; }
        .role-badge.user { background: rgba(99,102,241,.12); color: #6366f1; }
        .role-badge.pengacara { background: rgba(14,165,233,.12); color: #0ea5e9; }
        .role-badge.paralegal { background: rgba(245,158,11,.12); color: #f59e0b; }

        .profile-meta {
            margin-top: 20px; padding-top: 20px;
            border-top: 1px solid rgba(0,0,0,.06);
            text-align: left; font-size: .82rem;
        }
        [data-bs-theme="dark"] .profile-meta { border-color: rgba(255,255,255,.06); }
        .profile-meta div { display: flex; justify-content: space-between; padding: 6px 0; }
        .profile-meta span:first-child { color: #94a3b8; }
        .profile-meta span:last-child { font-weight: 600; }
    </style>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card profile-card">
                <div class="profile-summary">
                    <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($user->name)); ?>&background=6366f1&color=fff&size=128"
                         alt="<?php echo e($user->name); ?>">
                    <div class="name"><?php echo e($user->name); ?></div>
                    <div class="email"><?php echo e($user->email); ?></div>
                    <?php if(isset($user->role)): ?>
                        <span class="role-badge <?php echo e($user->role); ?>">
                            <i class="fa-solid <?php echo e($user->role === 'admin' ? 'fa-shield-halved' : 'fa-user'); ?>"></i>
                            <?php echo e(ucfirst($user->role)); ?>

                        </span>
                    <?php endif; ?>

                    <div class="profile-meta">
                        <div><span>Bergabung sejak</span><span><?php echo e($user->created_at->isoFormat('D MMMM YYYY')); ?></span></div>
                        <div>
                            <span>Status email</span>
                            <?php if($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail()): ?>
                                <span class="text-warning"><i class="fa-solid fa-triangle-exclamation me-1"></i>Belum verifikasi</span>
                            <?php else: ?>
                                <span class="text-success"><i class="fa-solid fa-circle-check me-1"></i>Terverifikasi</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="d-flex flex-column gap-4">
                <div class="card profile-card">
                    <div class="card-header">
                        <h6 class="m-0 fw-bold text-primary"><i class="fa-solid fa-id-card me-2"></i>Informasi Profil</h6>
                    </div>
                    <div class="card-body">
                        <?php echo $__env->make('profile.partials.update-profile-information-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>

                <div class="card profile-card">
                    <div class="card-header">
                        <h6 class="m-0 fw-bold text-primary"><i class="fa-solid fa-lock me-2"></i>Ubah Password</h6>
                    </div>
                    <div class="card-body">
                        <?php echo $__env->make('profile.partials.update-password-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
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
<?php /**PATH C:\xampp\htdocs\lbh\resources\views/profile/edit.blade.php ENDPATH**/ ?>