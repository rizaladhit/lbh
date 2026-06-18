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
        @media screen { .print-view { display: none; } }

        @media print {
            body * { visibility: hidden; }

            .print-view {
                display: block !important;
                visibility: visible !important;
                position: absolute;
                top: 0; left: 0;
                width: 100%;
                box-sizing: border-box;
                padding: 10mm 18mm;
                font-family: Arial, sans-serif;
                font-size: 9.5pt;
                color: #000;
                background: #fff;
            }
            .print-view * { visibility: visible !important; }

            .pv-title { text-align: center; font-weight: bold; font-size: 11.5pt; text-decoration: underline; text-transform: uppercase; margin-bottom: 14px; }

            .pv-group { margin-bottom: 4px; }
            .pv-row { display: flex; align-items: flex-end; margin-bottom: 4px; line-height: 1.2; }
            .pv-label { flex-shrink: 0; text-transform: uppercase; white-space: nowrap; }
            .pv-sep   { flex-shrink: 0; padding: 0 5px; white-space: nowrap; }
            .pv-val   { flex: 1; min-width: 0; border-bottom: 1px dotted #000; padding-left: 3px; word-break: break-word; }
            .pv-val-fixed { flex: 1; font-weight: bold; padding-left: 3px; }

            .pv-g1 .pv-label { min-width: 32mm; }
            .pv-g2 .pv-label { min-width: 72mm; }

            .pv-gap { height: 8px; }
            .pv-section-gap { height: 10px; }

            .pv-table { width: 100%; border-collapse: collapse; margin: 8px 0 10px 0; font-size: 9pt; }
            .pv-table th, .pv-table td { border: 1px solid #000 !important; padding: 3px 6px; }
            .pv-table thead th {
                background: #d0d0d0 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                text-align: center; font-weight: bold; text-transform: uppercase;
            }
            .pv-table td.no-col  { text-align: center; font-weight: bold; width: 36px; }
            .pv-table td.chk-col { text-align: center; width: 60px; }
            .pv-table th.chk-th  { width: 60px; }
            .pv-table th.no-th   { width: 36px; }

            .pv-chk { display: inline-block; width: 13px; height: 13px; border: 1px solid #000; text-align: center; line-height: 13px; font-size: 9.5pt; font-weight: bold; }

            .pv-keterangan { font-size: 8.5pt; margin-top: 8px; line-height: 1.45; }
            .pv-keterangan .pv-ket-title { font-weight: bold; margin-bottom: 2px; }
        }

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

    
    
    
    <div class="d-print-none row justify-content-center">
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
                <button onclick="window.print()" class="btn btn-success px-4 fw-bold shadow-sm">
                    <i class="fa-solid fa-print me-1"></i> Cetak Formulir
                </button>
            </div>
        </div>
    </div>

    
    
    
    <div class="print-view">

        <div class="pv-title">Check List Berkas Reimbursement Non Litigasi</div>

        <div class="pv-group pv-g1">
            <div class="pv-row"><span class="pv-label">OBH</span><span class="pv-sep">:</span><span class="pv-val"><?php echo e($konsultasiHukumReport->obh); ?></span></div>
            <div class="pv-row"><span class="pv-label">ALAMAT</span><span class="pv-sep">:</span><span class="pv-val"><?php echo e($konsultasiHukumReport->alamat); ?></span></div>
            <div class="pv-row"><span class="pv-label">PROVINSI</span><span class="pv-sep">:</span><span class="pv-val"><?php echo e($konsultasiHukumReport->provinsi); ?></span></div>
        </div>

        <div class="pv-gap"></div>

        <div class="pv-group pv-g2">
            <div class="pv-row"><span class="pv-label">KEGIATAN</span><span class="pv-sep">:</span><span class="pv-val-fixed">KONSULTASI HUKUM</span></div>
        </div>

        <?php for($i = 0; $i < 5; $i++): ?>
        <?php
            $pv_sec = $secs[$i] ?? [];
            $pv_cl  = $pv_sec['checklist'] ?? [];
            $pv_chk = function($k, $f) use ($pv_cl) { return !empty($pv_cl[$k][$f]) ? 'v' : ''; };
        ?>

        <?php if($i === 3): ?>
        <div style="page-break-before: always;"></div>
        <div style="height: 12mm;"></div>
        <?php else: ?>
        <div class="pv-section-gap"></div>
        <?php endif; ?>

        <div class="pv-group pv-g2">
            <div class="pv-row"><span class="pv-label">MATERI KONSULTASI <?php echo e($section_names[$i]); ?></span><span class="pv-sep">:</span><span class="pv-val"><?php echo e($pv_sec['materi'] ?? ''); ?></span></div>
            <div class="pv-row"><span class="pv-label">TGL PELAKSANAAN KEGIATAN</span><span class="pv-sep">:</span><span class="pv-val"><?php echo e($pv_sec['tgl_pelaksanaan'] ? \Carbon\Carbon::parse($pv_sec['tgl_pelaksanaan'])->translatedFormat('d F Y') : ''); ?></span></div>
            <div class="pv-row">
                <span class="pv-label">PENERIMA BANTUAN HUKUM</span>
                <span class="pv-sep">:</span>
                <span class="pv-val" style="display:flex;justify-content:space-between;">
                    <span><?php echo e($pv_sec['penerima_bantuan'] ?? ''); ?></span>
                    <strong>L/P : <?php echo e($pv_sec['jk_penerima'] ?? ''); ?></strong>
                </span>
            </div>
            <div class="pv-row"><span class="pv-label">NAMA KONSULTAN</span><span class="pv-sep">:</span><span class="pv-val"><?php echo e($pv_sec['nama_konsultan'] ?? ''); ?></span></div>
        </div>

        <table class="pv-table">
            <thead>
                <tr>
                    <th class="no-th">NO</th>
                    <th>BERKAS</th>
                    <th class="chk-th">OBH</th>
                    <th class="chk-th">KANWIL</th>
                    <th class="chk-th">BPHN</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $section_items[$i]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td class="no-col"><?php echo e(substr($key,4)); ?>.</td>
                    <td><?php echo e($label); ?></td>
                    <td class="chk-col"><span class="pv-chk"><?php echo e($pv_chk($key,'obh')); ?></span></td>
                    <td class="chk-col"><span class="pv-chk"><?php echo e($pv_chk($key,'kanwil')); ?></span></td>
                    <td class="chk-col"><span class="pv-chk"><?php echo e($pv_chk($key,'bphn')); ?></span></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <?php endfor; ?>

        <div class="pv-keterangan">
            <div class="pv-ket-title">KETERANGAN :</div>
            - Jika <strong>ada</strong> beri tanda (&#10003;), <strong>tidak ada</strong> beri tanda (&#10007;).<br>
            - Form ini harus dilampirkan diatas dokumen.<br>
            - Berkas harus disusun berdasarkan urutan nomor.<br>
            - Konsultasi diajukan per-paket 5 kasus.<br>
            - Berkas harus <strong>ASLI</strong> dan di <em>fotocopy</em>.<br>
            - Kartu BPJS tidak diperkenankan.<br>
            - Form laporan Konsultasi bisa dilihat di Buku Panduan Implementasi Undang-Undang Nomor 16 Tahun 2011 Tentang Bantuan Hukum.<br>
            - Kuitansi biaya penggandaan harus dibubuhi stempel usaha fotokopi ybs. dan melampirkan bon berkop dari usaha ybs.
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