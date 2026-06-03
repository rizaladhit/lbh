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
        Detail Permohonan Non-Litigasi
     <?php $__env->endSlot(); ?>

    <div class="row justify-content-center">
        <div class="col-xl-8">
            <!-- Status Card -->
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted d-block">Status Permohonan</small>
                            <span class="badge <?php echo e($permohonanNonLitigasi->getStatusBadgeColor()); ?> fs-6 px-3 py-2">
                                <?php echo e($permohonanNonLitigasi->getStatusLabel()); ?> (<?php echo e($permohonanNonLitigasi->status); ?>)
                            </span>
                        </div>
                        <?php if(auth()->user()->role === 'admin'): ?>
                        <div class="btn-group" role="group">
                            <?php if($permohonanNonLitigasi->canBeApproved()): ?>
                            <a href="<?php echo e(route('permohonan-non-litigasi.approve', $permohonanNonLitigasi)); ?>" class="btn btn-sm btn-info">Setujui</a>
                            <a href="<?php echo e(route('permohonan-non-litigasi.reject', $permohonanNonLitigasi)); ?>" class="btn btn-sm btn-danger">Tolak</a>
                            <?php endif; ?>
                            <?php if($permohonanNonLitigasi->canBeVerified()): ?>
                            <a href="<?php echo e(route('permohonan-non-litigasi.verify', $permohonanNonLitigasi)); ?>" class="btn btn-sm btn-success">Verifikasi</a>
                            <?php endif; ?>
                            <?php if($permohonanNonLitigasi->canBeAssigned()): ?>
                            <a href="<?php echo e(route('permohonan-non-litigasi.assignForm', $permohonanNonLitigasi)); ?>" class="btn btn-sm btn-info">Tugaskan</a>
                            <?php endif; ?>
                            <?php if($permohonanNonLitigasi->canBeCompleted()): ?>
                            <a href="<?php echo e(route('permohonan-non-litigasi.completeForm', $permohonanNonLitigasi)); ?>" class="btn btn-sm btn-primary">Selesaikan</a>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 fw-bold text-primary"><i class="fa-solid fa-handshake me-2"></i>Detail Permohonan Bantuan Non-Litigasi</h6>
                    <span class="badge bg-success fs-6"><?php echo e($permohonanNonLitigasi->no_registrasi); ?></span>
                </div>
                <div class="card-body p-4" style="font-size: 0.95rem;">
                    <?php $fields = [
                        'Nama Pemohon' => $permohonanNonLitigasi->nama_pemohon,
                        'Alamat Pemohon' => $permohonanNonLitigasi->alamat_pemohon,
                        'Telp/HP Pemohon' => $permohonanNonLitigasi->telp_hp_pemohon,
                        'NIK Pemohon' => $permohonanNonLitigasi->nik_pemohon,
                        'Jenis Perkara' => $permohonanNonLitigasi->jenis_perkara,
                        'Tgl. Rencana Kunjungan' => $permohonanNonLitigasi->tgl_rencana_kunjungan->format('d M Y'),
                        'Uraian Singkat' => $permohonanNonLitigasi->uraian_singkat,
                        'Diajukan Oleh' => optional($permohonanNonLitigasi->user)->name ?? '-',
                        'Tanggal Pengajuan' => $permohonanNonLitigasi->created_at->format('d M Y, H:i'),
                    ]; ?>
                    <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="d-flex border-bottom py-2">
                        <div class="fw-semibold" style="min-width: 220px;"><?php echo e($label); ?></div>
                        <div class="text-muted">: <?php echo e($value); ?></div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php if($permohonanNonLitigasi->verification_notes): ?>
                    <div class="d-flex border-bottom py-2">
                        <div class="fw-semibold" style="min-width: 220px;">Catatan Verifikasi</div>
                        <div class="text-muted">: <?php echo e($permohonanNonLitigasi->verification_notes); ?></div>
                    </div>
                    <?php endif; ?>

                    <?php if($permohonanNonLitigasi->assignedLawyer): ?>
                    <div class="d-flex border-bottom py-2">
                        <div class="fw-semibold" style="min-width: 220px;">Advocate</div>
                        <div class="text-muted">: <?php echo e($permohonanNonLitigasi->assignedLawyer->name); ?></div>
                    </div>
                    <?php endif; ?>

                    <?php if($permohonanNonLitigasi->assignedParalegal): ?>
                    <div class="d-flex border-bottom py-2">
                        <div class="fw-semibold" style="min-width: 220px;">Paralegal</div>
                        <div class="text-muted">: <?php echo e($permohonanNonLitigasi->assignedParalegal->name); ?></div>
                    </div>
                    <?php endif; ?>

                    <?php if($permohonanNonLitigasi->activity_notes): ?>
                    <div class="d-flex border-bottom py-2">
                        <div class="fw-semibold" style="min-width: 220px;">Catatan Aktivitas</div>
                        <div class="text-muted">: <?php echo e($permohonanNonLitigasi->activity_notes); ?></div>
                    </div>
                    <?php endif; ?>

                    <div class="mt-4 row g-3">
                        <?php if($permohonanNonLitigasi->file_ktp_kk): ?>
                        <div class="col-md-4">
                            <p class="fw-semibold small mb-1">KTP / KK</p>
                            <a href="<?php echo e(Storage::url($permohonanNonLitigasi->file_ktp_kk)); ?>" target="_blank" class="btn btn-sm btn-outline-primary w-100"><i class="fa-solid fa-file me-1"></i> Lihat File</a>
                        </div>
                        <?php endif; ?>
                        <?php if($permohonanNonLitigasi->file_sktm): ?>
                        <div class="col-md-4">
                            <p class="fw-semibold small mb-1">SKTM</p>
                            <a href="<?php echo e(Storage::url($permohonanNonLitigasi->file_sktm)); ?>" target="_blank" class="btn btn-sm btn-outline-primary w-100"><i class="fa-solid fa-file me-1"></i> Lihat File</a>
                        </div>
                        <?php endif; ?>
                        <?php if($permohonanNonLitigasi->file_ttd): ?>
                        <div class="col-md-4">
                            <p class="fw-semibold small mb-1">Tanda Tangan</p>
                            <img src="<?php echo e(Storage::url($permohonanNonLitigasi->file_ttd)); ?>" class="img-thumbnail" style="max-height: 100px;" alt="TTD">
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-footer py-3 d-flex gap-2 justify-content-end">
                    <a href="<?php echo e(route('permohonan-non-litigasi.index')); ?>" class="btn btn-light border fw-medium">Kembali</a>
                    <a href="<?php echo e(route('permohonan-non-litigasi.print', $permohonanNonLitigasi)); ?>" target="_blank" class="btn btn-success fw-bold shadow-sm"><i class="fa-solid fa-print me-1"></i> Cetak Formulir</a>
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


<?php /**PATH C:\xampp\htdocs\lbh\resources\views/permohonan/non_litigasi/show.blade.php ENDPATH**/ ?>