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
     <?php $__env->slot('header', null, []); ?> Edit Laporan Reimbursement <?php $__env->endSlot(); ?>

    <div class="row justify-content-center">
        <div class="col-xl-10">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header py-3 bg-primary">
                    <h6 class="m-0 fw-bold text-white">
                        <i class="fa-solid fa-pen-to-square me-2"></i>Edit Check List Berkas Reimbursement
                    </h6>
                </div>
                <div class="card-body p-4 p-md-5">
                    <form method="POST" action="<?php echo e(route('reimbursement-reports.update', $reimbursementReport)); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <!-- Top Header fields -->
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-bold">OBH</label>
                            <div class="col-sm-9">
                                <input type="text" name="obh" class="form-control border-secondary border-opacity-50" value="<?php echo e(old('obh', $reimbursementReport->obh)); ?>" required>
                                <?php $__errorArgs = ['obh'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger small"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-bold">ALAMAT</label>
                            <div class="col-sm-9">
                                <input type="text" name="alamat" class="form-control border-secondary border-opacity-50" value="<?php echo e(old('alamat', $reimbursementReport->alamat)); ?>" required>
                                <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger small"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label fw-bold">PROVINSI</label>
                            <div class="col-sm-9">
                                <input type="text" name="provinsi" class="form-control border-secondary border-opacity-50" value="<?php echo e(old('provinsi', $reimbursementReport->provinsi)); ?>" required>
                                <?php $__errorArgs = ['provinsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger small"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <!-- Jenis Kegiatan (Read-only) -->
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-bold">KEGIATAN</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control border-secondary border-opacity-50" value="<?php echo e($reimbursementReport->kegiatan); ?>" disabled>
                                <input type="hidden" name="kegiatan" value="<?php echo e($reimbursementReport->kegiatan); ?>">
                                <small class="text-muted">Jenis kegiatan tidak dapat diubah</small>
                            </div>
                        </div>

                        <!-- Dynamic Fields -->
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-bold">TGL PELAKSANAAN</label>
                            <div class="col-sm-9">
                                <input type="date" name="tgl_pelaksanaan" class="form-control border-secondary border-opacity-50" value="<?php echo e(old('tgl_pelaksanaan', $reimbursementReport->tgl_pelaksanaan->format('Y-m-d'))); ?>" required>
                                <?php $__errorArgs = ['tgl_pelaksanaan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger small"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-bold">PENERIMA BANTUAN</label>
                            <div class="col-sm-9">
                                <input type="text" name="penerima_bantuan" class="form-control border-secondary border-opacity-50" value="<?php echo e(old('penerima_bantuan', $reimbursementReport->penerima_bantuan)); ?>">
                            </div>
                        </div>

                        <?php if($reimbursementReport->tempat_pelaksanaan || in_array($reimbursementReport->kegiatan, ['Penyuluhan Hukum', 'Pemberdayaan Masyarakat'])): ?>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-bold">TEMPAT PELAKSANAAN</label>
                            <div class="col-sm-9">
                                <input type="text" name="tempat_pelaksanaan" class="form-control border-secondary border-opacity-50" value="<?php echo e(old('tempat_pelaksanaan', $reimbursementReport->tempat_pelaksanaan)); ?>">
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if($reimbursementReport->materi || in_array($reimbursementReport->kegiatan, ['Penyuluhan Hukum', 'Pemberdayaan Masyarakat'])): ?>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-bold">MATERI</label>
                            <div class="col-sm-9">
                                <input type="text" name="materi" class="form-control border-secondary border-opacity-50" value="<?php echo e(old('materi', $reimbursementReport->materi)); ?>">
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if($reimbursementReport->narasumber || in_array($reimbursementReport->kegiatan, ['Penyuluhan Hukum', 'Pemberdayaan Masyarakat'])): ?>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-bold">NARASUMBER</label>
                            <div class="col-sm-9">
                                <input type="text" name="narasumber" class="form-control border-secondary border-opacity-50" value="<?php echo e(old('narasumber', $reimbursementReport->narasumber)); ?>">
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if($reimbursementReport->kasus || in_array($reimbursementReport->kegiatan, ['Mediasi', 'Negosiasi', 'Pendampingan Diluar Pengadilan', 'Litigasi Perdata', 'Litigasi Pidana', 'Litigasi TUN'])): ?>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-bold">KASUS</label>
                            <div class="col-sm-9">
                                <input type="text" name="kasus" class="form-control border-secondary border-opacity-50" value="<?php echo e(old('kasus', $reimbursementReport->kasus)); ?>">
                            </div>
                        </div>
                        <?php endif; ?>

                        <hr class="mb-4">

                        <!-- Checklist Items -->
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">BERKAS / DOKUMEN</h6>
                            <div id="checklist-container">
                                <?php if($reimbursementReport->checklist_data): ?>
                                    <?php $__currentLoopData = $reimbursementReport->checklist_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item => $checked): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="checklist_items[<?php echo e($loop->index); ?>]" 
                                                   id="checklist_<?php echo e($loop->index); ?>" value="<?php echo e($item); ?>"
                                                   <?php echo e($checked ? 'checked' : ''); ?>>
                                            <label class="form-check-label" for="checklist_<?php echo e($loop->index); ?>">
                                                <?php echo e($item); ?>

                                            </label>
                                        </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <!-- Notes -->
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-bold">CATATAN</label>
                            <div class="col-sm-9">
                                <textarea name="notes" class="form-control border-secondary border-opacity-50" rows="3"><?php echo e(old('notes', $reimbursementReport->notes)); ?></textarea>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <!-- Buttons -->
                        <div class="d-grid gap-2 d-sm-flex justify-content-sm-end">
                            <a href="<?php echo e(route('reimbursement-reports.show', $reimbursementReport)); ?>" class="btn btn-secondary px-4">Batal</a>
                            <button type="submit" class="btn btn-primary px-5 fw-bold">
                                <i class="fa-solid fa-save me-2"></i>Simpan Perubahan
                            </button>
                        </div>
                    </form>
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
<?php /**PATH C:\xampp\htdocs\lbh\resources\views\reimbursement_reports\edit.blade.php ENDPATH**/ ?>