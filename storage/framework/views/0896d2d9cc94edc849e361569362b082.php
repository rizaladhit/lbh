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
        Detail Laporan Negosiasi
     <?php $__env->endSlot(); ?>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-md border-0 mb-4 p-4 p-md-5" id="printableArea">
                <style>
                    @media print {
                        body * { visibility: hidden; }
                        header, footer, nav, #sidebar { display: none !important; }
                        #printableArea, #printableArea * { visibility: visible; }
                        #printableArea { position: absolute; left: 0; top: 0; width: 100%; border: none; box-shadow: none; padding: 0 !important; }
                        .table-bordered th, .table-bordered td { border: 1px solid black !important; }
                        body.dark-mode #printableArea { background-color: white !important; color: black !important; }
                    }
                    .checklist-square { width: 18px; height: 18px; display: inline-flex; justify-content: center; align-items: center; border: 1px solid currentColor; font-weight: bold; font-family: monospace; font-size: 14px; }
                    .form-preview-label { width: 220px; flex-shrink: 0; }
                </style>

                <div class="card-header bg-transparent border-0 mb-4 pb-0 text-center">
                    <h5 class="fw-bold text-uppercase d-inline-block text-decoration-underline" style="text-underline-offset: 4px;">CHECK LIST BERKAS LAPORAN NEGOSIASI</h5>
                </div>

                <div class="card-body p-0" style="font-size: 0.95rem;">
                    <div class="d-flex mb-1">
                        <div class="fw-bold form-preview-label">OBH</div>
                        <div>: <?php echo e($negosiasiReport->obh); ?></div>
                    </div>
                    <div class="d-flex mb-1">
                        <div class="fw-bold form-preview-label">ALAMAT</div>
                        <div>: <?php echo e($negosiasiReport->alamat); ?></div>
                    </div>
                    <div class="d-flex mb-4">
                        <div class="fw-bold form-preview-label">PROVINSI</div>
                        <div>: <?php echo e($negosiasiReport->provinsi); ?></div>
                    </div>

                    <div class="d-flex mb-1">
                        <div class="fw-bold form-preview-label">KEGIATAN</div>
                        <div class="text-uppercase">: <?php echo e($negosiasiReport->kegiatan); ?></div>
                    </div>
                    <div class="d-flex mb-1">
                        <div class="fw-bold form-preview-label">TGL PELAKSANAAN KEGIATAN</div>
                        <div>: <?php echo e($negosiasiReport->tgl_pelaksanaan->format('d M Y')); ?></div>
                    </div>
                    <div class="d-flex mb-1">
                        <div class="fw-bold form-preview-label">KASUS</div>
                        <div>: <?php echo e($negosiasiReport->kasus); ?></div>
                    </div>
                    <div class="d-flex mb-1">
                        <div class="fw-bold form-preview-label">PENERIMA BANTUAN HUKUM</div>
                        <div class="w-100">: <?php echo e($negosiasiReport->penerima_bantuan); ?> <span class="float-end pe-5"><strong>L/P:</strong> <?php echo e($negosiasiReport->jk_penerima); ?></span></div>
                    </div>
                    <div class="d-flex mb-4">
                        <div class="fw-bold form-preview-label">NAMA NEGOSIATOR</div>
                        <div>: <?php echo e($negosiasiReport->nama_negosiator); ?></div>
                    </div>

                    <table class="table table-bordered border-secondary align-middle mb-4">
                        <thead>
                            <tr class="text-center align-middle" style="background-color: var(--bs-tertiary-bg) !important;">
                                <th style="width: 50px;">NO</th>
                                <th>BERKAS</th>
                                <th style="width: 80px;">OBH</th>
                                <th style="width: 80px;">KANWIL</th>
                                <th style="width: 80px;">BPHN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $checklist = $negosiasiReport->checklist_data ?? [];
                                $get_check = function($item, $field) {
                                    return isset($item[$field]) && $item[$field] ? 'v' : '&nbsp;';
                                };
                            ?>
                            <?php $__currentLoopData = $checklist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-center fw-bold"><?php echo e($loop->iteration); ?>.</td>
                                    <td class="fw-medium"><?php echo e($item['label'] ?? '-'); ?></td>
                                    <td class="text-center"><span class="checklist-square"><?php echo $get_check($item, 'obh'); ?></span></td>
                                    <td class="text-center"><span class="checklist-square"><?php echo $get_check($item, 'kanwil'); ?></span></td>
                                    <td class="text-center"><span class="checklist-square"><?php echo $get_check($item, 'bphn'); ?></span></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>

                    <div class="small lh-sm">
                        <strong>KETERANGAN :</strong><br>
                        - Jika <strong>ada</strong> beri tanda (v), <strong>tidak ada</strong> biarkan kosong.<br>
                        - Form ini harus dilampirkan di atas dokumen.
                        <br>- Berkas harus disusun berdasarkan urutan nomor.
                        <br>- Kuitansi biaya negosiator harus diberi stempel OBH.
                        <br>- Berkas harus ASLI dan difotokopi.
                        <br>- Semua dokumen pendukung wajib dilengkapi sebelum diserahkan.
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mb-4 d-print-none">
                <a href="<?php echo e(route('negosiasi-reports.index')); ?>" class="btn btn-secondary px-4 fw-bold shadow-sm">Kembali</a>
                <button onclick="window.print()" class="btn btn-success px-4 fw-bold shadow-sm"><i class="fa-solid fa-print me-1"></i> Cetak Formulir</button>
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
<?php /**PATH C:\xampp\htdocs\lbh\resources\views\negosiasi_reports\show.blade.php ENDPATH**/ ?>