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
     <?php $__env->slot('header', null, []); ?> Master Jenis Pelayanan <?php $__env->endSlot(); ?>

    <style>
        .panel { border-radius: 16px; border: none; box-shadow: 0 4px 24px rgba(0,0,0,.07); overflow: hidden; }
        [data-bs-theme="dark"] .panel { background: #1a2035; }
        .panel-head { padding: 18px 24px; border-bottom: 1px solid rgba(0,0,0,.06); display: flex; align-items: center; justify-content: space-between; }
        [data-bs-theme="dark"] .panel-head { border-color: rgba(255,255,255,.06); }
        .data-table { margin: 0; }
        .data-table thead th { font-size: .7rem; font-weight: 700; text-transform: uppercase; letter-spacing: .6px; color: #94a3b8; padding: 14px 18px; background: transparent; border-bottom: 1px solid rgba(0,0,0,.06); }
        [data-bs-theme="dark"] .data-table thead th { border-color: rgba(255,255,255,.06); }
        .data-table tbody tr { border-bottom: 1px solid rgba(0,0,0,.04); transition: background .15s; }
        .data-table tbody tr:hover { background: rgba(99,102,241,.04); }
        [data-bs-theme="dark"] .data-table tbody tr:hover { background: rgba(255,255,255,.03); }
        .data-table td { padding: 16px 18px; vertical-align: middle; border: none; }
        .action-btn { width: 32px; height: 32px; border-radius: 8px; border: 1px solid rgba(0,0,0,.08); background: transparent; display: inline-flex; align-items: center; justify-content: center; font-size: .8rem; text-decoration: none; cursor: pointer; transition: all .15s; }
        .action-btn:hover { background: rgba(0,0,0,.05); transform: scale(1.08); }
        [data-bs-theme="dark"] .action-btn { border-color: rgba(255,255,255,.1); }
        .btn-cta { background: linear-gradient(135deg,#6366f1,#8b5cf6); border: none; color: #fff; font-weight: 600; font-size: .8rem; padding: 8px 18px; border-radius: 9px; transition: all .2s; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; box-shadow: 0 4px 14px rgba(99,102,241,.35); }
        .btn-cta:hover { opacity: .9; color: #fff; transform: translateY(-1px); }
        .empty-state { padding: 72px 24px; text-align: center; }
        .empty-icon { width: 80px; height: 80px; border-radius: 20px; background: rgba(99,102,241,.1); display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 2rem; color: #6366f1; }
    </style>

    <?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show mb-3" role="alert" style="border-radius:12px;font-size:.85rem;">
        <i class="fa-solid fa-circle-check me-2"></i><?php echo e(session('success')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert" style="border-radius:12px;font-size:.85rem;">
        <i class="fa-solid fa-circle-xmark me-2"></i><?php echo e(session('error')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <div class="panel">
        <div class="panel-head">
            <div class="d-flex align-items-center gap-3">
                <div style="width:36px;height:36px;border-radius:10px;background:rgba(99,102,241,.15);display:flex;align-items:center;justify-content:center;">
                    <i class="fa-solid fa-handshake text-primary"></i>
                </div>
                <div>
                    <h6 style="font-size:.85rem;font-weight:600;" class="mb-0 fw-bold text-body">Daftar Jenis Pelayanan</h6>
                    <div style="font-size:.72rem;color:#94a3b8;">Total <?php echo e($jenisPelayanans->count()); ?> jenis terdaftar</div>
                </div>
            </div>
            <a href="<?php echo e(route('jenis-pelayanan.create')); ?>" class="btn-cta">
                <i class="fa-solid fa-plus"></i><span class="d-none d-sm-inline">Tambah Jenis</span>
            </a>
        </div>

        <div class="table-responsive">
            <table class="data-table table">
                <thead>
                    <tr>
                        <th style="padding-left:24px;width:50px;">No.</th>
                        <th>Nama Jenis Pelayanan</th>
                        <th style="padding-right:24px;text-align:right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $jenisPelayanans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jenis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td style="padding-left:24px;">
                            <span style="font-size:.8rem;color:#94a3b8;"><?php echo e($loop->iteration); ?></span>
                        </td>
                        <td>
                            <div style="font-size:.85rem;font-weight:600;" class="text-body"><?php echo e($jenis->nama); ?></div>
                        </td>
                        <td style="padding-right:24px;text-align:right;">
                            <div class="d-flex justify-content-end gap-1">
                                <a href="<?php echo e(route('jenis-pelayanan.edit', $jenis)); ?>" class="action-btn" style="color:#f59e0b;" title="Edit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="<?php echo e(route('jenis-pelayanan.destroy', $jenis)); ?>" method="POST" style="display:inline;"
                                      onsubmit="return confirm('Hapus jenis pelayanan ini?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="action-btn" style="color:#ef4444;" title="Hapus">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="3">
                            <div class="empty-state">
                                <div class="empty-icon"><i class="fa-solid fa-handshake"></i></div>
                                <h6 style="font-size:.85rem;font-weight:600;" class="fw-bold text-body mb-1">Belum Ada Jenis Pelayanan</h6>
                                <p class="text-muted mb-4" style="font-size:.85rem;">Mulai dengan menambahkan jenis pelayanan yang pertama.</p>
                                <a href="<?php echo e(route('jenis-pelayanan.create')); ?>" class="btn-cta" style="margin:auto;width:fit-content;">
                                    <i class="fa-solid fa-plus"></i> Tambah Jenis
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
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
<?php /**PATH C:\xampp\htdocs\lbh\resources\views/jenis-pelayanan/index.blade.php ENDPATH**/ ?>