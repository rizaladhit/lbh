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
        Detail Laporan Reimbursement
     <?php $__env->endSlot(); ?>

    <div class="row justify-content-center">
        <div class="col-xl-10">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header py-3 bg-primary">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="m-0 fw-bold text-white">
                            <i class="fa-solid fa-file-invoice me-2"></i><?php echo e($reimbursementReport->kegiatan); ?>

                        </h6>
                        <span class="badge <?php echo e($reimbursementReport->getStatusBadgeColor()); ?>">
                            <?php echo e($reimbursementReport->getStatusLabel()); ?>

                        </span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <!-- Header Info -->
                    <div class="row mb-4 pb-3 border-bottom">
                        <div class="col-md-6">
                            <p class="mb-2">
                                <span class="fw-bold text-muted d-block">OBH</span>
                                <?php echo e($reimbursementReport->obh); ?>

                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2">
                                <span class="fw-bold text-muted d-block">PROVINSI</span>
                                <?php echo e($reimbursementReport->provinsi); ?>

                            </p>
                        </div>
                    </div>

                    <div class="row mb-4 pb-3 border-bottom">
                        <div class="col-md-12">
                            <p class="mb-2">
                                <span class="fw-bold text-muted d-block">ALAMAT</span>
                                <?php echo e($reimbursementReport->alamat); ?>

                            </p>
                        </div>
                    </div>

                    <!-- Activity Details -->
                    <div class="row mb-4 pb-3 border-bottom">
                        <div class="col-md-6">
                            <p class="mb-3">
                                <span class="fw-bold text-muted d-block">KEGIATAN</span>
                                <span class="badge bg-info text-white"><?php echo e($reimbursementReport->kegiatan); ?></span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-3">
                                <span class="fw-bold text-muted d-block">TGL PELAKSANAAN</span>
                                <?php echo e($reimbursementReport->tgl_pelaksanaan->format('d M Y')); ?>

                            </p>
                        </div>
                    </div>

                    <!-- Dynamic Fields -->
                    <?php if($reimbursementReport->penerima_bantuan): ?>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-2">
                                <span class="fw-bold text-muted d-block">PENERIMA BANTUAN</span>
                                <?php echo e($reimbursementReport->penerima_bantuan); ?>

                            </p>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if($reimbursementReport->tempat_pelaksanaan): ?>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-2">
                                <span class="fw-bold text-muted d-block">TEMPAT PELAKSANAAN</span>
                                <?php echo e($reimbursementReport->tempat_pelaksanaan); ?>

                            </p>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if($reimbursementReport->materi): ?>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-2">
                                <span class="fw-bold text-muted d-block">MATERI</span>
                                <?php echo e($reimbursementReport->materi); ?>

                            </p>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if($reimbursementReport->narasumber): ?>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-2">
                                <span class="fw-bold text-muted d-block">NARASUMBER</span>
                                <?php echo e($reimbursementReport->narasumber); ?>

                            </p>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if($reimbursementReport->kasus): ?>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-2">
                                <span class="fw-bold text-muted d-block">KASUS</span>
                                <?php echo e($reimbursementReport->kasus); ?>

                            </p>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Checklist Section -->
                    <?php if($reimbursementReport->checklist_data && count($reimbursementReport->checklist_data) > 0): ?>
                    <?php
                        $isTableChecklist = false;
                        foreach ($reimbursementReport->checklist_data as $item) {
                            if (is_array($item) && (isset($item['obh']) || isset($item['kanwil']) || isset($item['bphn']))) {
                                $isTableChecklist = true;
                                break;
                            }
                        }
                        $renderCheck = function ($item, $col) {
                            return isset($item[$col]) && $item[$col] ? '☑' : '☒';
                        };
                    ?>
                    <div class="mb-4 pt-3 border-top">
                        <h6 class="fw-bold mb-3">
                            <i class="fa-solid fa-list-check me-2"></i>BERKAS / DOKUMEN
                        </h6>
                        <?php if($isTableChecklist): ?>
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle">
                                    <thead>
                                        <tr class="text-center align-middle" style="background-color: var(--bs-secondary-bg) !important;">
                                            <th style="width: 50px;">NO</th>
                                            <th>BERKAS</th>
                                            <th style="width: 80px;">OBH</th>
                                            <th style="width: 80px;">KANWIL</th>
                                            <th style="width: 80px;">BPHN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $reimbursementReport->checklist_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(is_array($item) && isset($item['label'])): ?>
                                                <tr>
                                                    <td class="text-center fw-bold"><?php echo e(preg_match('/^item(\d+)(_\d+)?$/', $key, $matches) ? $matches[1] . (isset($matches[2]) ? $matches[2] : '') : $loop->iteration); ?></td>
                                                    <td><?php echo e($item['label']); ?></td>
                                                    <td class="text-center"><?php echo e($renderCheck($item, 'obh')); ?></td>
                                                    <td class="text-center"><?php echo e($renderCheck($item, 'kanwil')); ?></td>
                                                    <td class="text-center"><?php echo e($renderCheck($item, 'bphn')); ?></td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="row">
                                <?php $__currentLoopData = $reimbursementReport->checklist_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item => $checked): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" <?php echo e($checked ? 'checked' : ''); ?> disabled>
                                            <label class="form-check-label">
                                                <?php echo e($item); ?>

                                            </label>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>

                    <!-- Notes -->
                    <?php if($reimbursementReport->notes): ?>
                    <div class="alert alert-info">
                        <strong>Catatan:</strong> <?php echo e($reimbursementReport->notes); ?>

                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="card shadow-sm border-0">
                <div class="card-body p-3">
                    <div class="d-flex gap-2 justify-content-end flex-wrap">
                        <a href="<?php echo e(route('reimbursement-reports.index')); ?>" class="btn btn-secondary">
                            <i class="fa-solid fa-arrow-left me-2"></i>Kembali
                        </a>
                        <?php if($reimbursementReport->status === 'draft'): ?>
                        <a href="<?php echo e(route('reimbursement-reports.edit', $reimbursementReport)); ?>" class="btn btn-warning">
                            <i class="fa-solid fa-pen-to-square me-2"></i>Edit
                        </a>
                        <?php endif; ?>
                        <?php if(auth()->user()->role === 'admin' && $reimbursementReport->status === 'submitted'): ?>
                        <form method="POST" action="<?php echo e(route('reimbursement-reports.update', $reimbursementReport)); ?>" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <input type="hidden" name="status" value="approved">
                            <button type="submit" class="btn btn-success">
                                <i class="fa-solid fa-check me-2"></i>Setujui
                            </button>
                        </form>
                        <form method="POST" action="<?php echo e(route('reimbursement-reports.update', $reimbursementReport)); ?>" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <input type="hidden" name="status" value="rejected">
                            <button type="submit" class="btn btn-danger">
                                <i class="fa-solid fa-times me-2"></i>Tolak
                            </button>
                        </form>
                        <?php endif; ?>
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
<?php /**PATH C:\xampp\htdocs\lbh\resources\views\reimbursement_reports\show.blade.php ENDPATH**/ ?>