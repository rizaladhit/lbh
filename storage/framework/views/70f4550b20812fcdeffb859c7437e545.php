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
        Detail Permohonan Litigasi
     <?php $__env->endSlot(); ?>

    <div class="row justify-content-center">
        <div class="col-xl-8">
            <!-- Status Card -->
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body p-3">
                    <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center gap-3">
                        <div>
                            <small class="text-muted d-block">Status Permohonan</small>
                            <span class="badge <?php echo e($permohonanLitigasi->getStatusBadgeColor()); ?> fs-6 px-3 py-2">
                                <?php echo e($permohonanLitigasi->getStatusLabel()); ?> (<?php echo e($permohonanLitigasi->status); ?>)
                            </span>
                        </div>
                        <?php if(auth()->user()->role === 'admin'): ?>
                        <div class="d-flex flex-wrap gap-2 justify-content-start justify-content-md-end">
                            <a href="<?php echo e(route('permohonan-litigasi.edit', $permohonanLitigasi)); ?>" class="btn btn-sm btn-secondary">Edit</a>
                            <?php if($permohonanLitigasi->canBeApproved()): ?>
                            <a href="<?php echo e(route('permohonan-litigasi.approve', $permohonanLitigasi)); ?>" class="btn btn-sm btn-info">Setujui</a>
                            <a href="<?php echo e(route('permohonan-litigasi.reject', $permohonanLitigasi)); ?>" class="btn btn-sm btn-danger">Tolak</a>
                            <?php endif; ?>
                            <?php if($permohonanLitigasi->canBeVerified()): ?>
                            <a href="<?php echo e(route('permohonan-litigasi.verify', $permohonanLitigasi)); ?>" class="btn btn-sm btn-success">Verifikasi</a>
                            <?php endif; ?>
                            <?php if($permohonanLitigasi->canBeAssigned()): ?>
                            <a href="<?php echo e(route('permohonan-litigasi.assignForm', $permohonanLitigasi)); ?>" class="btn btn-sm btn-info">Tugaskan</a>
                            <?php endif; ?>
                            <?php if($permohonanLitigasi->canBeCompleted()): ?>
                            <a href="<?php echo e(route('permohonan-litigasi.completeForm', $permohonanLitigasi)); ?>" class="btn btn-sm btn-primary">Selesaikan</a>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 fw-bold text-primary"><i class="fa-solid fa-scale-balanced me-2"></i>Detail Permohonan Bantuan Litigasi</h6>
                    <span class="badge bg-primary fs-6"><?php echo e($permohonanLitigasi->no_registrasi); ?></span>
                </div>
                <div class="card-body p-3 p-md-4" style="font-size: 0.95rem;">
                    <?php $fields = [
                        'Nama' => $permohonanLitigasi->nama,
                        'Alamat' => $permohonanLitigasi->alamat,
                        'Telp/HP' => $permohonanLitigasi->telp_hp,
                        'NIK' => $permohonanLitigasi->nik,
                        'Jenis Perkara' => $permohonanLitigasi->jenis_perkara,
                        'No. Perkara' => $permohonanLitigasi->no_perkara,
                        'Tgl. Rencana Kunjungan' => $permohonanLitigasi->tgl_rencana_kunjungan->format('d M Y'),
                        'Uraian Singkat' => $permohonanLitigasi->uraian_singkat,
                        'Diajukan Oleh' => optional($permohonanLitigasi->user)->name ?? '-',
                        'Tanggal Pengajuan' => $permohonanLitigasi->created_at->format('d M Y, H:i'),
                    ]; ?>
                    <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="d-flex flex-column flex-md-row border-bottom py-2">
                        <div class="fw-semibold text-nowrap pe-md-3" style="min-width: fit-content;"><?php echo e($label); ?></div>
                        <div class="text-muted"><span class="d-md-none">: </span><span class="d-none d-md-inline">: </span><?php echo e($value); ?></div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php if($permohonanLitigasi->verification_notes): ?>
                    <div class="d-flex flex-column flex-md-row border-bottom py-2">
                        <div class="fw-semibold text-nowrap pe-md-3" style="min-width: fit-content;">Catatan Verifikasi</div>
                        <div class="text-muted"><span class="d-md-none">: </span><span class="d-none d-md-inline">: </span><?php echo e($permohonanLitigasi->verification_notes); ?></div>
                    </div>
                    <?php endif; ?>

                    <?php if($permohonanLitigasi->assignedLawyer): ?>
                    <div class="d-flex flex-column flex-md-row border-bottom py-2">
                        <div class="fw-semibold text-nowrap pe-md-3" style="min-width: fit-content;">Advocate</div>
                        <div class="text-muted"><span class="d-md-none">: </span><span class="d-none d-md-inline">: </span><?php echo e($permohonanLitigasi->assignedLawyer->name); ?></div>
                    </div>
                    <?php endif; ?>

                    <?php if($permohonanLitigasi->assignedParalegal): ?>
                    <div class="d-flex flex-column flex-md-row border-bottom py-2">
                        <div class="fw-semibold text-nowrap pe-md-3" style="min-width: fit-content;">Paralegal</div>
                        <div class="text-muted"><span class="d-md-none">: </span><span class="d-none d-md-inline">: </span><?php echo e($permohonanLitigasi->assignedParalegal->name); ?></div>
                    </div>
                    <?php endif; ?>

                    <?php if($permohonanLitigasi->activity_notes): ?>
                    <div class="d-flex flex-column flex-md-row border-bottom py-2">
                        <div class="fw-semibold text-nowrap pe-md-3" style="min-width: fit-content;">Catatan Aktivitas</div>
                        <div class="text-muted"><span class="d-md-none">: </span><span class="d-none d-md-inline">: </span><?php echo e($permohonanLitigasi->activity_notes); ?></div>
                    </div>
                    <?php endif; ?>

                    <div class="mt-4 row g-2 g-md-3">
                        <?php if($permohonanLitigasi->file_ktp_kk): ?>
                        <div class="col-12 col-sm-6 col-md-4">
                            <p class="fw-semibold small mb-1">KTP / KK</p>
                            <a href="<?php echo e(Storage::url($permohonanLitigasi->file_ktp_kk)); ?>" target="_blank" class="btn btn-sm btn-outline-primary w-100"><i class="fa-solid fa-file me-1"></i> Lihat File</a>
                        </div>
                        <?php endif; ?>
                        <?php if($permohonanLitigasi->file_sktm): ?>
                        <div class="col-12 col-sm-6 col-md-4">
                            <p class="fw-semibold small mb-1">SKTM</p>
                            <a href="<?php echo e(Storage::url($permohonanLitigasi->file_sktm)); ?>" target="_blank" class="btn btn-sm btn-outline-primary w-100"><i class="fa-solid fa-file me-1"></i> Lihat File</a>
                        </div>
                        <?php endif; ?>
                        <?php if($permohonanLitigasi->file_ttd): ?>
                        <div class="col-12 col-sm-6 col-md-4">
                            <p class="fw-semibold small mb-1">Tanda Tangan</p>
                            <img src="<?php echo e(Storage::url($permohonanLitigasi->file_ttd)); ?>" class="img-thumbnail" style="max-height: 100px;" alt="TTD">
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-footer py-2 py-md-3 d-flex flex-column flex-md-row gap-2 justify-content-end">
                    <a href="<?php echo e(route('permohonan-litigasi.index')); ?>" class="btn btn-light border fw-medium">Kembali</a>
                    <a href="<?php echo e(route('permohonan-litigasi.print', $permohonanLitigasi)); ?>" target="_blank" class="btn btn-success fw-bold shadow-sm"><i class="fa-solid fa-print me-1"></i> Cetak Formulir</a>
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
<?php /**PATH C:\xampp\htdocs\lbh\resources\views\permohonan\litigasi\show.blade.php ENDPATH**/ ?>