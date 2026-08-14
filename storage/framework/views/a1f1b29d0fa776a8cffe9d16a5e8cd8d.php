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
     <?php $__env->slot('header', null, []); ?> Pemberdayaan Masyarakat <?php $__env->endSlot(); ?>

    <style>
        .checklist-square { width: 18px; height: 18px; display: inline-flex; justify-content: center; align-items: center; border: 1px solid currentColor; font-weight: bold; font-family: monospace; font-size: 14px; }
        .form-preview-label { width: 220px; flex-shrink: 0; }
    </style>

    
    
    
    <div class="d-print-none row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-md border-0 mb-4 p-4 p-md-5">

                <div class="card-header bg-transparent border-0 mb-4 pb-0 text-center">
                    <h5 class="fw-bold text-uppercase d-inline-block text-decoration-underline" style="text-underline-offset:4px;">
                        CHECK LIST BERKAS REIMBURSEMENT NON LITIGASI
                    </h5>
                </div>

                <div class="card-body p-0" style="font-size: 0.95rem;">
                    <div class="d-flex mb-1">
                        <div class="fw-bold form-preview-label">OBH</div>
                        <div>: <?php echo e($reimbursementReport->obh); ?></div>
                    </div>
                    <div class="d-flex mb-1">
                        <div class="fw-bold form-preview-label">ALAMAT</div>
                        <div>: <?php echo e($reimbursementReport->alamat); ?></div>
                    </div>
                    <div class="d-flex mb-4">
                        <div class="fw-bold form-preview-label">PROVINSI</div>
                        <div>: <?php echo e($reimbursementReport->provinsi); ?></div>
                    </div>

                    <div class="d-flex mb-1">
                        <div class="fw-bold form-preview-label">KEGIATAN</div>
                        <div class="text-uppercase">: <?php echo e($reimbursementReport->kegiatan); ?></div>
                    </div>
                    <div class="d-flex mb-1">
                        <div class="fw-bold form-preview-label">TGL PELAKSANAAN KEGIATAN</div>
                        <div>: <?php echo e($reimbursementReport->tgl_pelaksanaan->format('d M Y')); ?></div>
                    </div>
                    <div class="d-flex mb-1">
                        <div class="fw-bold form-preview-label">PENERIMA BANTUAN HUKUM</div>
                        <div>: <?php echo e($reimbursementReport->penerima_bantuan ?? '-'); ?></div>
                    </div>
                    <div class="d-flex mb-1">
                        <div class="fw-bold form-preview-label">TEMPAT PELAKSANAAN KEG.</div>
                        <div>: <?php echo e($reimbursementReport->tempat_pelaksanaan ?? '-'); ?></div>
                    </div>
                    <div class="d-flex mb-1">
                        <div class="fw-bold form-preview-label">MATERI</div>
                        <div>: <?php echo e($reimbursementReport->materi ?? '-'); ?></div>
                    </div>
                    <div class="d-flex mb-4">
                        <div class="fw-bold form-preview-label">NARASUMBER</div>
                        <div>: <?php echo e($reimbursementReport->narasumber ?? '-'); ?></div>
                    </div>

                    <?php
                        $items = [
                            'item1' => 'Formulir permohonan bantuan hukum',
                            'item2' => 'SK Panitia',
                            'item3' => 'Materi mengenai pengetahuan hukum',
                            'item4' => 'Daftar Hadir Peserta',
                            'item5' => 'Notula',
                            'item6' => 'Dokumentasi kegiatan',
                            'item7' => 'Laporan Kegiatan',
                            'item8' => 'Kuitansi:'
                        ];
                        $subitems = [
                            'item8_1' => 'Biaya Konsumsi',
                            'item8_2' => 'Biaya jasa Profesi/Narasumber (diberi stempel OBH)',
                            'item8_3' => 'Biaya Penggandaan dan Penjilidan Laporan Akhir',
                            'item8_4' => 'Dokumentasi Kegiatan',
                            'item8_5' => 'Pembuatan Spanduk/Banner'
                        ];
                        $checklist = $reimbursementReport->checklist_data ?? [];
                        $chk = function($key, $field) use ($checklist) {
                            return !empty($checklist[$key][$field]) ? 'v' : '&nbsp;';
                        };
                    ?>

                    <table class="table table-bordered border-secondary align-middle mb-4" style="font-size:.88rem;">
                        <thead>
                            <tr class="text-center align-middle" style="background-color: var(--bs-tertiary-bg) !important;">
                                <th style="width:50px;">NO</th>
                                <th>BERKAS</th>
                                <th style="width:80px;">OBH</th>
                                <th style="width:80px;">KANWIL</th>
                                <th style="width:80px;">BPHN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="text-center fw-bold"><?php echo e(substr($key, 4)); ?>.</td>
                                <td class="fw-medium"><?php echo e($label); ?></td>
                                <?php if($key !== 'item8'): ?>
                                    <td class="text-center"><span class="checklist-square"><?php echo $chk($key, 'obh'); ?></span></td>
                                    <td class="text-center"><span class="checklist-square"><?php echo $chk($key, 'kanwil'); ?></span></td>
                                    <td class="text-center"><span class="checklist-square"><?php echo $chk($key, 'bphn'); ?></span></td>
                                <?php else: ?>
                                    <td></td><td></td><td></td>
                                <?php endif; ?>
                            </tr>
                            <?php if($key === 'item8'): ?>
                                <?php $__currentLoopData = $subitems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subkey => $sublabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td></td>
                                    <td class="ps-4 text-muted fw-medium">- <?php echo e($sublabel); ?></td>
                                    <td class="text-center"><span class="checklist-square"><?php echo $chk($subkey, 'obh'); ?></span></td>
                                    <td class="text-center"><span class="checklist-square"><?php echo $chk($subkey, 'kanwil'); ?></span></td>
                                    <td class="text-center"><span class="checklist-square"><?php echo $chk($subkey, 'bphn'); ?></span></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>

                    <div class="small lh-sm">
                        <strong>KETERANGAN :</strong><br>
                        - Jika <strong>ada</strong> beri tanda (&check;), <strong>tidak ada</strong> biarkan kosong.<br>
                        - Form ini harus dilampirkan di atas dokumen.<br>
                        - Berkas harus disusun berdasarkan urutan nomor.<br>
                        - Kartu BPJS tidak diperkenankan.<br>
                        - Formulir laporan pelaksanaan kegiatan pemberdayaan hukum bisa dilihat di Buku Panduan Implementasi Undang-Undang Nomor 16 Tahun 2011 Tentang Bantuan Hukum.<br>
                        - Kuitansi konsumsi dan penggandaan harus diberi materai (&gt;Rp. 250rb diberi materai 3000), dan dibubuhi stempel Rumah Makan dan usaha fotokopi ybs.
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mb-4 d-print-none">
                <a href="<?php echo e(route('pemberdayaan-masyarakat.index')); ?>" class="btn btn-secondary px-4 fw-bold shadow-sm">Kembali</a>
                <a href="<?php echo e(route('pemberdayaan-masyarakat.print', $reimbursementReport)); ?>" class="btn btn-success px-4 fw-bold shadow-sm">
                    <i class="fa-solid fa-print me-1"></i> Cetak Formulir
                </a>
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
<?php /**PATH C:\xampp\htdocs\lbh\resources\views\reimbursement_reports\show_pemberdayaan.blade.php ENDPATH**/ ?>