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
     <?php $__env->slot('header', null, []); ?> Laporan Reimbursement <?php $__env->endSlot(); ?>

    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="mb-0">Daftar Laporan Reimbursement</h5>
                <a href="<?php echo e(route('reimbursement-reports.create')); ?>" class="btn btn-primary">
                    <i class="fa-solid fa-plus me-2"></i>Buat Laporan Baru
                </a>
            </div>

            <?php if($reports->count() > 0): ?>
            <div class="card shadow-sm border-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>No.</th>
                                <th>Kegiatan</th>
                                <th>OBH</th>
                                <th>Tgl Pelaksanaan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td>
                                    <span class="fw-semibold"><?php echo e($report->kegiatan); ?></span>
                                </td>
                                <td><?php echo e($report->obh); ?></td>
                                <td><?php echo e($report->tgl_pelaksanaan->format('d M Y')); ?></td>
                                <td>
                                    <span class="badge <?php echo e($report->getStatusBadgeColor()); ?>">
                                        <?php echo e($report->getStatusLabel()); ?>

                                    </span>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('reimbursement-reports.show', $report)); ?>" class="btn btn-sm btn-info text-white">
                                        <i class="fa-solid fa-eye"></i> Lihat
                                    </a>
                                    <?php if($report->status === 'draft'): ?>
                                    <a href="<?php echo e(route('reimbursement-reports.edit', $report)); ?>" class="btn btn-sm btn-warning">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </a>
                                    <form method="POST" action="<?php echo e(route('reimbursement-reports.destroy', $report)); ?>" style="display:inline;">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                            <i class="fa-solid fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="fa-solid fa-inbox" style="font-size: 2rem; opacity: 0.3;"></i>
                                    <p class="mt-2">Belum ada laporan reimbursement</p>
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-4">
                <?php echo e($reports->links()); ?>

            </div>
            <?php else: ?>
            <div class="card shadow-sm border-0">
                <div class="card-body text-center py-5">
                    <i class="fa-solid fa-file-invoice-dollar" style="font-size: 3rem; color: #cbd5e1;"></i>
                    <p class="mt-3 text-muted">Belum ada laporan reimbursement yang dibuat</p>
                    <a href="<?php echo e(route('reimbursement-reports.create')); ?>" class="btn btn-primary mt-3">
                        <i class="fa-solid fa-plus me-2"></i>Buat Laporan Pertama
                    </a>
                </div>
            </div>
            <?php endif; ?>
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
<?php /**PATH C:\xampp\htdocs\lbh\resources\views/reimbursement_reports/index.blade.php ENDPATH**/ ?>