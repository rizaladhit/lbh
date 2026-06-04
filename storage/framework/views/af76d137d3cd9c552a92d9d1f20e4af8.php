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
     <?php $__env->slot('header', null, []); ?> Master Data Advocate <?php $__env->endSlot(); ?>

    <style>
        .panel { border-radius: 16px; border: none; box-shadow: 0 4px 24px rgba(0,0,0,.07); overflow: hidden; }
        [data-bs-theme="dark"] .panel { background: #1a2035; }
        .panel-head {
            padding: 18px 24px;
            border-bottom: 1px solid rgba(0,0,0,.06);
            display: flex; align-items: center; justify-content: space-between;
        }
        [data-bs-theme="dark"] .panel-head { border-color: rgba(255,255,255,.06); }
        .data-table { margin: 0; }
        .data-table thead th {
            font-size: .7rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: .6px;
            color: #94a3b8; padding: 14px 18px;
            background: transparent; border-bottom: 1px solid rgba(0,0,0,.06);
        }
        [data-bs-theme="dark"] .data-table thead th { border-color: rgba(255,255,255,.06); }
        .data-table tbody tr { border-bottom: 1px solid rgba(0,0,0,.04); transition: background .15s; }
        .data-table tbody tr:hover { background: rgba(14,165,233,.04); }
        [data-bs-theme="dark"] .data-table tbody tr:hover { background: rgba(255,255,255,.03); }
        .data-table td { padding: 16px 18px; vertical-align: middle; border: none; }
        .role-badge {
            padding: 4px 10px; border-radius: 99px;
            font-size: .72rem; font-weight: 700;
            display: inline-flex; align-items: center; gap: 6px;
        }
        .role-badge.admin { background: rgba(239,68,68,.12); color: #ef4444; }
        .role-badge.user { background: rgba(99,102,241,.12); color: #6366f1; }
        .action-btn {
            width: 32px; height: 32px; border-radius: 8px;
            border: 1px solid rgba(0,0,0,.08); background: transparent;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: .8rem; text-decoration: none; cursor: pointer; transition: all .15s;
        }
        .action-btn:hover { background: rgba(0,0,0,.05); transform: scale(1.08); }
        [data-bs-theme="dark"] .action-btn { border-color: rgba(255,255,255,.1); }
        .btn-cta {
            background: linear-gradient(135deg,#0ea5e9,#0284c7);
            border: none; color: #fff; font-weight: 600; font-size: .8rem;
            padding: 8px 18px; border-radius: 9px; transition: all .2s;
            display: inline-flex; align-items: center; gap: 8px; text-decoration: none;
            box-shadow: 0 4px 14px rgba(14,165,233,.35);
        }
        .btn-cta:hover { opacity: .9; color: #fff; transform: translateY(-1px); }
    </style>

    <div class="panel">
        <div class="panel-head">
            <div class="d-flex align-items-center gap-3">
                <div style="width:36px;height:36px;border-radius:10px;background:rgba(59,130,246,.15);display:flex;align-items:center;justify-content:center;">
                    <i class="fa-solid fa-gavel text-primary"></i>
                </div>
                <div>
                    <h6 class="mb-0 fw-bold text-body">Daftar Advocate</h6>
                    <div style="font-size:.72rem;color:#94a3b8;">Total <?php echo e($lawyers->total()); ?> advocate terdaftar</div>
                </div>
            </div>
            <a href="<?php echo e(route('lawyers.create')); ?>" class="btn-cta">
                <i class="fa-solid fa-plus"></i><span class="d-none d-sm-inline">Tambah Advocate</span>
            </a>
        </div>

        <div class="table-responsive">
            <table class="data-table table">
                <thead>
                    <tr>
                        <th style="padding-left:24px;">Advocate</th>
                        <th>Email & Info</th>
                        <th>Identitas</th>
                        <th>Keahlian</th>
                        <th>Status</th>
                        <th style="padding-right:24px;text-align:right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $lawyers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lawyer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td style="padding-left:24px;">
                            <div class="d-flex align-items-center gap-3">
                                <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($lawyer->name)); ?>&background=3b82f6&color=fff&size=40" 
                                     style="width:38px;height:38px;border-radius:10px;" alt="<?php echo e($lawyer->name); ?>">
                                <div>
                                    <div style="font-weight:600;font-size:.88rem;" class="text-body"><?php echo e($lawyer->name); ?></div>
                                    <div style="font-size:.72rem;color:#94a3b8;"><?php echo e($lawyer->phone); ?></div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="font-size:.82rem;font-weight:500;" class="text-body"><?php echo e($lawyer->email); ?></div>
                            <div style="font-size:.72rem;color:#94a3b8;"><?php echo e($lawyer->created_at->diffForHumans()); ?></div>
                        </td>
                        <td><span class="role-badge user"><?php echo e($lawyer->no_identitas); ?></span></td>
                        <td><?php echo e($lawyer->specialization); ?></td>
                        <td>
                            <span class="badge <?php echo e($lawyer->getStatusBadgeColor()); ?>">
                                <?php echo e($lawyer->getStatusLabel()); ?>

                            </span>
                        </td>
                        <td style="padding-right:24px;text-align:right;">
                            <div class="d-flex justify-content-end gap-1">
                                <a href="<?php echo e(route('lawyers.show', $lawyer)); ?>" class="action-btn" style="color:#0ea5e9;" title="Detail">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="<?php echo e(route('lawyers.edit', $lawyer)); ?>" class="action-btn" style="color:#f59e0b;" title="Edit">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <button onclick="confirmDelete('<?php echo e(route('lawyers.destroy', $lawyer)); ?>')" class="action-btn" style="color:#ef4444;" title="Hapus">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="6" class="text-center text-muted py-4">Belum ada data advocate tercatat.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if($lawyers->hasPages()): ?>
        <div style="padding:16px 24px;border-top:1px solid rgba(0,0,0,.05);display:flex;justify-content:space-between;align-items:center;">
            <span style="font-size:.75rem;color:#94a3b8;">Menampilkan hal. <?php echo e($lawyers->currentPage()); ?> dari <?php echo e($lawyers->lastPage()); ?></span>
            <?php echo e($lawyers->links('pagination::bootstrap-5')); ?>

        </div>
        <?php endif; ?>
    </div>

    <form id="deleteForm" method="POST" style="display:none;"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?></form>
    <script>
        function confirmDelete(action){
            if(!confirm('Hapus data advocate ini? Pastikan tidak ada penugasan aktif.')) return;
            const f = document.getElementById('deleteForm'); f.action = action; f.submit();
        }
    </script>
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
<?php /**PATH C:\xampp\htdocs\lbh\resources\views/lawyers/index.blade.php ENDPATH**/ ?>