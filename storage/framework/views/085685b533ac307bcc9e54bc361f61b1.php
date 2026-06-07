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
        Report Details: <?php echo e($report->report_id); ?>

     <?php $__env->endSlot(); ?>

    <div class="row justify-content-center">
        <div class="col-lg-10 mt-3">
            <div class="card shadow-lg border-0 mb-4 rounded-3 overflow-hidden">
                <!-- Header -->
                <div class="card-header bg-transparent p-4 p-md-5 border-bottom d-flex justify-content-between align-items-center flex-wrap">
                    <div>
                        <h3 class="mb-2 fw-bold text-body"><?php echo e($report->case_title); ?></h3>
                        <p class="mb-0 text-muted"><span class="badge bg-light text-body border me-2"><i class="fa-solid fa-tag me-1 text-primary"></i> <?php echo e($report->category->name); ?></span> <span class="text-muted"><i class="fa-regular fa-calendar me-1"></i> <?php echo e(\Carbon\Carbon::parse($report->date)->format('d F Y')); ?></span></p>
                    </div>
                    <div>
                        <?php
                            $bg = 'bg-secondary';
                            if($report->status == 'Submitted') $bg = 'bg-primary';
                            if($report->status == 'In Progress') $bg = 'bg-warning text-body';
                            if($report->status == 'Completed') $bg = 'bg-success';
                        ?>
                        <span class="badge <?php echo e($bg); ?> rounded-pill px-4 py-2 fs-6 shadow-sm"><?php echo e($report->status); ?></span>
                    </div>
                </div>

                <!-- Body -->
                <div class="card-body p-4 p-md-5 bg-transparent">
                    <div class="row g-5 mb-5 border-bottom pb-5">
                        <div class="col-md-6">
                            <h6 class="text-uppercase text-muted fw-bold small mb-3"><i class="fa-solid fa-user me-2 text-primary"></i>Client Information</h6>
                            <div class="ps-3 border-start border-4 border-primary bg-light p-3 rounded-end">
                                <p class="mb-1 fw-bold fs-5 text-body"><?php echo e($report->client_name); ?></p>
                                <p class="mb-0 text-muted"><?php echo e($report->client_contact); ?></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-uppercase text-muted fw-bold small mb-3"><i class="fa-solid fa-id-badge me-2 text-info"></i>Assigned User</h6>
                            <div class="ps-3 border-start border-4 border-info bg-light p-3 rounded-end d-flex align-items-center">
                                <i class="fa-solid fa-circle-user fa-2x text-body-tertiary me-3"></i>
                                <p class="mb-0 fw-bold fs-5 text-body"><?php echo e($report->user->name ?? 'None'); ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-5">
                        <h6 class="text-uppercase text-muted fw-bold small mb-3 d-flex align-items-center"><i class="fa-solid fa-align-left me-2"></i>Case Description</h6>
                        <div class="bg-transparent border rounded p-4 p-md-5 shadow-sm text-body fs-6" style="white-space: pre-line; line-height: 1.8;"><?php echo e($report->description); ?></div>
                    </div>
                    
                    <?php if($report->notes): ?>
                    <div class="mb-5">
                        <h6 class="text-uppercase text-danger fw-bold small mb-3 d-flex align-items-center"><i class="fa-solid fa-note-sticky me-2"></i>Internal Notes</h6>
                        <div class="bg-warning bg-opacity-10 border border-warning rounded p-4 text-body shadow-sm" style="white-space: pre-line;"><?php echo e($report->notes); ?></div>
                    </div>
                    <?php endif; ?>

                    <?php if($report->attachment_path): ?>
                    <div class="mb-4 text-center text-md-start">
                        <h6 class="text-uppercase text-muted fw-bold small mb-3 d-flex align-items-center justify-content-center justify-content-md-start"><i class="fa-solid fa-paperclip me-2"></i>Attachment</h6>
                        <a href="<?php echo e(asset('storage/'.$report->attachment_path)); ?>" target="_blank" class="btn btn-outline-primary btn-lg shadow-sm px-5 py-3 rounded-pill fw-bold">
                            <i class="fa-solid fa-file-download me-2"></i> View Attached Document
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
                
                <div class="card-footer bg-light p-4 d-flex flex-column flex-md-row justify-content-end gap-2 border-top-0">
                    <a href="<?php echo e(route('reports.index')); ?>" class="btn btn-secondary px-4 me-md-auto mb-2 mb-md-0 fw-bold"><i class="fa-solid fa-arrow-left me-1"></i> Back to List</a>
                    <!-- Assuming you can download the PDF by filtering the id -->
                    <a href="<?php echo e(route('reports.edit', $report)); ?>" class="btn btn-primary px-5 fw-bold shadow-sm mb-2 mb-md-0"><i class="fa-solid fa-pen-to-square me-2"></i> Edit Case</a>
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
<?php /**PATH C:\xampp\htdocs\lbh\resources\views\reports\show.blade.php ENDPATH**/ ?>