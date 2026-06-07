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
     <?php $__env->slot('header', null, []); ?> Detail Data Paralegal <?php $__env->endSlot(); ?>

    <div class="row justify-content-center">
        <div class="col-xl-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 fw-bold text-success"><i class="fa-solid fa-user-shield me-2"></i>Detail Paralegal</h6>
                    <span class="badge <?php echo e($paralegal->getStatusBadgeColor()); ?> fs-6"><?php echo e($paralegal->getStatusLabel()); ?></span>
                </div>
                <div class="card-body p-4" style="font-size: 0.95rem;">
                    <?php $fields = [
                        'Nama Lengkap' => $paralegal->name,
                        'No. Identitas' => $paralegal->no_identitas,
                        'Email' => $paralegal->email,
                        'Telepon' => $paralegal->phone,
                        'Keahlian' => $paralegal->specialization,
                        'Alamat' => $paralegal->address ?? '-',
                        'Catatan' => $paralegal->notes ?? '-',
                        'Terdaftar pada' => $paralegal->created_at->format('d M Y, H:i'),
                        'Diperbarui' => $paralegal->updated_at->format('d M Y, H:i'),
                    ]; ?>
                    <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="d-flex border-bottom py-3">
                        <div class="fw-semibold" style="min-width: 180px;"><?php echo e($label); ?></div>
                        <div class="text-muted" style="word-break: break-word;">: <?php echo e($value); ?></div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="card-footer py-3 d-flex gap-2 justify-content-end">
                    <a href="<?php echo e(route('paralegals.index')); ?>" class="btn btn-light border fw-medium">Kembali</a>
                    <a href="<?php echo e(route('paralegals.edit', $paralegal)); ?>" class="btn btn-warning fw-bold"><i class="fa-solid fa-edit me-1"></i> Edit</a>
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
<?php /**PATH C:\xampp\htdocs\lbh\resources\views\paralegals\show.blade.php ENDPATH**/ ?>