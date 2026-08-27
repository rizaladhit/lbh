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
     <?php $__env->slot('header', null, []); ?> Detail Laporan Konsultasi Hukum <?php $__env->endSlot(); ?>

    <style>
        .checklist-square { width: 18px; height: 18px; display: inline-flex; justify-content: center; align-items: center; border: 1px solid currentColor; font-weight: bold; font-family: monospace; font-size: 14px; }
        .form-preview-label { width: 240px; flex-shrink: 0; }
        .form-preview-label-sm { width: 200px; flex-shrink: 0; }
    </style>

    <?php
        $section_names = ['I', 'II', 'III', 'IV', 'V'];
        $items_std = [
            'item1' => 'SKTM Asli/ Legalisir Kartu JAMKESMAS/Kartu GAKIN/BLSM, dll.',
            'item2' => 'Formulir Konsultasi yang sudah diisi lengkap',
            'item3' => 'Laporan hasil konsultasi',
            'item4' => 'Kuitansi Biaya Konsultan (diberi stempel OBH)',
        ];
        $items_iv = [
            'item1' => 'SKTM Asli/ Legalisir Kartu JAMKESMAS/Kartu GAKIN/BLSM, dll.',
            'item2' => 'Formulir Konsultasi yang sudah diisi lengkap',
            'item3' => 'Laporan hasil konsultasi',
            'item4' => 'Kuitansi Biaya Konsultan',
        ];
        $items_v = [
            'item1' => 'SKTM Asli/ Legalisir Kartu JAMKESMAS/Kartu GAKIN/BLSM, dll.',
            'item2' => 'Formulir Konsultasi yang sudah diisi lengkap',
            'item3' => 'Laporan hasil konsultasi',
            'item4' => 'Kuitansi Biaya Konsultan (diberi stempel OBH)',
            'item5' => 'Kuitansi Biaya Penggandaan dan Laporan Akhir',
        ];
        $section_items = [0 => $items_std, 1 => $items_std, 2 => $items_std, 3 => $items_iv, 4 => $items_v];
        $secs = $konsultasiHukumReport->sections ?? [];
    ?>

    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card shadow-md border-0 mb-4 p-4 p-md-5">

                <div class="card-header bg-transparent border-0 mb-4 pb-0 text-center">
                    <h5 class="fw-bold text-uppercase d-inline-block text-decoration-underline" style="text-underline-offset:4px;">
                        CHECK LIST BERKAS LAPORAN KONSULTASI HUKUM
                    </h5>
                </div>

                <div class="card-body p-0" style="font-size:0.95rem;">
                    <div class="d-flex mb-1"><div class="fw-bold form-preview-label">OBH</div><div>: <?php echo e($konsultasiHukumReport->obh); ?></div></div>
                    <div class="d-flex mb-1"><div class="fw-bold form-preview-label">ALAMAT</div><div>: <?php echo e($konsultasiHukumReport->alamat); ?></div></div>
                    <div class="d-flex mb-3"><div class="fw-bold form-preview-label">PROVINSI</div><div>: <?php echo e($konsultasiHukumReport->provinsi); ?></div></div>
                    <div class="d-flex mb-4"><div class="fw-bold form-preview-label">KEGIATAN</div><div class="text-uppercase fw-semibold text-primary">: <?php echo e($konsultasiHukumReport->kegiatan); ?></div></div>

                    <?php for($i = 0; $i < 5; $i++): ?>
                    <?php
                        $sec = $secs[$i] ?? [];
                        $cl  = $sec['checklist'] ?? [];
                        $chk = function($k, $f) use ($cl) { return !empty($cl[$k][$f]) ? 'v' : '&nbsp;'; };
                    ?>
                    <div class="border rounded p-3 mb-4" style="background: var(--bs-secondary-bg);">
                        <h6 class="fw-bold text-uppercase text-primary mb-3">Materi Konsultasi <?php echo e($section_names[$i]); ?></h6>
                        <div class="d-flex mb-1"><div class="fw-bold form-preview-label-sm" style="font-size:.88rem;">MATERI KONSULTASI <?php echo e($section_names[$i]); ?></div><div>: <?php echo e($sec['materi'] ?? '-'); ?></div></div>
                        <div class="d-flex mb-1"><div class="fw-bold form-preview-label-sm" style="font-size:.88rem;">TGL PELAKSANAAN KEGIATAN</div><div>: <?php echo e($sec['tgl_pelaksanaan'] ? \Carbon\Carbon::parse($sec['tgl_pelaksanaan'])->translatedFormat('d F Y') : '-'); ?></div></div>
                        <div class="d-flex mb-1">
                            <div class="fw-bold form-preview-label-sm" style="font-size:.88rem;">PENERIMA BANTUAN HUKUM</div>
                            <div class="w-100">: <?php echo e($sec['penerima_bantuan'] ?? '-'); ?>

                                <span class="float-end pe-5"><strong>L/P:</strong> <?php echo e($sec['jk_penerima'] ?? '-'); ?></span>
                            </div>
                        </div>
                        <div class="d-flex mb-3"><div class="fw-bold form-preview-label-sm" style="font-size:.88rem;">NAMA KONSULTAN</div><div>: <?php echo e($sec['nama_konsultan'] ?? '-'); ?></div></div>

                        <table class="table table-bordered border-secondary align-middle mb-0" style="font-size:.88rem;">
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
                                <?php $__currentLoopData = $section_items[$i]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-center fw-bold"><?php echo e(substr($key,4)); ?>.</td>
                                    <td class="fw-medium"><?php echo e($label); ?></td>
                                    <td class="text-center"><span class="checklist-square"><?php echo $chk($key,'obh'); ?></span></td>
                                    <td class="text-center"><span class="checklist-square"><?php echo $chk($key,'kanwil'); ?></span></td>
                                    <td class="text-center"><span class="checklist-square"><?php echo $chk($key,'bphn'); ?></span></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <?php endfor; ?>

                    <div class="small lh-sm">
                        <strong>KETERANGAN :</strong><br>
                        - Jika <strong>ada</strong> beri tanda (&check;), <strong>tidak ada</strong> beri tanda (&cross;).<br>
                        - Form ini harus dilampirkan diatas dokumen.<br>
                        - Berkas harus disusun berdasarkan urutan nomor.<br>
                        - Konsultasi diajukan per-paket 5 kasus.<br>
                        - Berkas harus <strong>ASLI</strong> dan di <em>fotocopy</em>.<br>
                        - Kartu BPJS tidak diperkenankan.<br>
                        - Form laporan Konsultasi bisa dilihat di Buku Panduan Implementasi Undang-Undang Nomor 16 Tahun 2011 Tentang Bantuan Hukum.<br>
                        - Kuitansi biaya penggandaan harus dibubuhi stempel usaha fotokopi ybs. dan melampirkan bon berkop dari usaha ybs.
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mb-4">
                <a href="<?php echo e(route('konsultasi-hukum-reports.index')); ?>" class="btn btn-secondary px-4 fw-bold shadow-sm">Kembali</a>
                <a href="<?php echo e(route('konsultasi-hukum-reports.edit', $konsultasiHukumReport)); ?>" class="btn btn-warning px-4 fw-bold shadow-sm">
                    <i class="fa-solid fa-pen-to-square me-1"></i> Edit
                </a>
                <a href="<?php echo e(route('konsultasi-hukum-reports.print', $konsultasiHukumReport)); ?>" target="_blank" class="btn btn-success px-4 fw-bold shadow-sm">
                    <i class="fa-solid fa-print me-1"></i> Cetak Formulir
                </a>
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
<?php /**PATH C:\xampp\htdocs\lbh\resources\views/konsultasi_hukum_reports/show.blade.php ENDPATH**/ ?>