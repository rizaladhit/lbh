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
        Detail Data Lawyer
     <?php $__env->endSlot(); ?>

    <div class="row justify-content-center">
        <div class="col-xl-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 fw-bold text-primary"><i class="fa-solid fa-gavel me-2"></i>Detail Lawyer</h6>
                    <span class="badge <?php echo e($lawyer->getStatusBadgeColor()); ?> fs-6"><?php echo e($lawyer->getStatusLabel()); ?></span>
                </div>
                <div class="card-body p-4" style="font-size: 0.95rem;">
                    <?php $fields = [
                        'Nama Lengkap' => $lawyer->name,
                        'No. Identitas (SIU)' => $lawyer->no_identitas,
                        'Email' => $lawyer->email,
                        'Telepon' => $lawyer->phone,
                        'Keahlian' => $lawyer->specialization,
                        'Alamat' => $lawyer->address ?? '-',
                        'Catatan' => $lawyer->notes ?? '-',
                        'Terdaftar pada' => $lawyer->created_at->format('d M Y, H:i'),
                        'Diperbarui' => $lawyer->updated_at->format('d M Y, H:i'),
                    ]; ?>
                    <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="d-flex border-bottom py-3">
                        <div class="fw-semibold" style="min-width: 180px;"><?php echo e($label); ?></div>
                        <div class="text-muted" style="word-break: break-word;">: <?php echo e($value); ?></div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="card-footer py-3 d-flex gap-2 justify-content-end">
                    <a href="<?php echo e(route('lawyers.index')); ?>" class="btn btn-light border fw-medium">Kembali</a>
                    <a href="<?php echo e(route('lawyers.edit', $lawyer)); ?>" class="btn btn-warning fw-bold"><i class="fa-solid fa-edit me-1"></i> Edit</a>
                </div>
            </div>

            <?php if($lawyer->permohonanLitigasiAsLawyer()->count() > 0 || $lawyer->permohonanLitigasiAsParalegal()->count() > 0): ?>
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 fw-bold text-primary"><i class="fa-solid fa-scale-balanced me-2"></i>Permohonan Litigasi yang Ditugaskan</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-4">No. Registrasi</th>
                                    <th>Nama Pemohon</th>
                                    <th>Jenis Perkara</th>
                                    <th>Peran</th>
                                    <th>Status</th>
                                    <th class="pe-4 text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $lawyer->permohonanLitigasiAsLawyer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permohonan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="ps-4"><span class="badge bg-primary-subtle text-primary"><?php echo e($permohonan->no_registrasi); ?></span></td>
                                    <td><?php echo e($permohonan->nama); ?></td>
                                    <td><?php echo e($permohonan->jenis_perkara); ?></td>
                                    <td><span class="badge bg-primary">Lawyer</span></td>
                                    <td><span class="badge <?php echo e($permohonan->getStatusBadgeColor()); ?>"><?php echo e($permohonan->getStatusLabel()); ?></span></td>
                                    <td class="pe-4 text-end">
                                        <a href="<?php echo e(route('permohonan-litigasi.show', $permohonan)); ?>" class="btn btn-light btn-sm text-info border"><i class="fa-solid fa-eye"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $lawyer->permohonanLitigasiAsParalegal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permohonan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="ps-4"><span class="badge bg-info-subtle text-info"><?php echo e($permohonan->no_registrasi); ?></span></td>
                                    <td><?php echo e($permohonan->nama); ?></td>
                                    <td><?php echo e($permohonan->jenis_perkara); ?></td>
                                    <td><span class="badge bg-info">Paralegal</span></td>
                                    <td><span class="badge <?php echo e($permohonan->getStatusBadgeColor()); ?>"><?php echo e($permohonan->getStatusLabel()); ?></span></td>
                                    <td class="pe-4 text-end">
                                        <a href="<?php echo e(route('permohonan-litigasi.show', $permohonan)); ?>" class="btn btn-light btn-sm text-info border"><i class="fa-solid fa-eye"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
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
<?php /**PATH C:\xampp\htdocs\lbh\resources\views/lawyers/show.blade.php ENDPATH**/ ?>