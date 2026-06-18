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
        /* ── Screen only: hide print-view ─────────────────────────── */
        @media screen { .print-view { display: none; } }

        /* ── Print only ────────────────────────────────────────────── */
        @media print {
            body * { visibility: hidden; }

            .print-view {
                display: block !important;
                visibility: visible !important;
                position: absolute;
                top: 0; left: 0;
                width: 100%;
                box-sizing: border-box;
                padding: 14mm 18mm;
                font-family: Arial, sans-serif;
                font-size: 10pt;
                color: #000;
                background: #fff;
            }
            .print-view * { visibility: visible !important; }

            /* Title */
            .pv-title {
                text-align: center;
                font-weight: bold;
                font-size: 12pt;
                text-decoration: underline;
                text-transform: uppercase;
                margin-bottom: 18px;
            }

            /* Field rows — flexbox agar label tidak terpotong */
            .pv-group { margin-bottom: 6px; }
            .pv-row {
                display: flex;
                align-items: flex-end;
                margin-bottom: 6px;
                line-height: 1.2;
            }
            .pv-label {
                flex-shrink: 0;
                text-transform: uppercase;
                white-space: nowrap;
            }
            .pv-sep {
                flex-shrink: 0;
                padding: 0 5px;
                white-space: nowrap;
            }
            .pv-val {
                flex: 1;
                min-width: 0;
                border-bottom: 1px dotted #000;
                padding-left: 3px;
                word-break: break-word;
            }
            .pv-val-fixed {
                flex: 1;
                font-weight: bold;
                padding-left: 3px;
            }
            /* Lebar label per grup */
            .pv-g1 .pv-label { min-width: 32mm; }
            .pv-g2 .pv-label { min-width: 72mm; }

            /* Gap between field groups */
            .pv-gap { height: 10px; }

            /* Checklist table */
            .pv-table {
                width: 100%;
                border-collapse: collapse;
                margin: 18px 0 14px 0;
                font-size: 9.5pt;
            }
            .pv-table th, .pv-table td { border: 1px solid #000 !important; padding: 4px 8px; }
            .pv-table thead th {
                background: #d0d0d0 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                text-align: center;
                font-weight: bold;
                text-transform: uppercase;
            }
            .pv-table td.no-col  { text-align: center; font-weight: bold; width: 46px; }
            .pv-table td.chk-col { text-align: center; width: 68px; }
            .pv-table th.chk-th  { width: 68px; }
            .pv-table th.no-th   { width: 46px; }

            /* Checkbox square */
            .pv-chk {
                display: inline-block;
                width: 14px; height: 14px;
                border: 1px solid #000;
                text-align: center;
                line-height: 14px;
                font-size: 10pt;
                font-weight: bold;
            }

            /* Keterangan */
            .pv-keterangan { font-size: 9pt; margin-top: 10px; line-height: 1.5; }
            .pv-keterangan .pv-ket-title { font-weight: bold; margin-bottom: 3px; }
        }

        /* ── Screen card styles ─────────────────────────────────────── */
        .checklist-square { width: 18px; height: 18px; display: inline-flex; justify-content: center; align-items: center; border: 1px solid currentColor; font-weight: bold; font-family: monospace; font-size: 14px; }
        .form-preview-label { width: 220px; flex-shrink: 0; }
    </style>

    
    
    
    <div class="d-print-none row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-md border-0 mb-4 p-4 p-md-5">

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

                    <table class="table table-bordered border-secondary align-middle mb-4">
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
                                    <td class="ps-4 text-muted">- <?php echo e($sublabel); ?></td>
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
                <button onclick="window.print()" class="btn btn-success px-4 fw-bold shadow-sm">
                    <i class="fa-solid fa-print me-1"></i> Cetak Formulir
                </button>
            </div>
        </div>
    </div>

    
    
    
    <div class="print-view">

        <div class="pv-title">Check List Berkas Reimbursement Non Litigasi</div>

        
        <div class="pv-group pv-g1">
            <div class="pv-row">
                <span class="pv-label">OBH</span>
                <span class="pv-sep">:</span>
                <span class="pv-val"><?php echo e($reimbursementReport->obh); ?></span>
            </div>
            <div class="pv-row">
                <span class="pv-label">ALAMAT</span>
                <span class="pv-sep">:</span>
                <span class="pv-val"><?php echo e($reimbursementReport->alamat); ?></span>
            </div>
            <div class="pv-row">
                <span class="pv-label">PROVINSI</span>
                <span class="pv-sep">:</span>
                <span class="pv-val"><?php echo e($reimbursementReport->provinsi); ?></span>
            </div>
        </div>

        <div class="pv-gap"></div>

        
        <div class="pv-group pv-g2">
            <div class="pv-row">
                <span class="pv-label">KEGIATAN</span>
                <span class="pv-sep">:</span>
                <span class="pv-val-fixed">PEMBERDAYAAN MASYARAKAT</span>
            </div>
            <div class="pv-row">
                <span class="pv-label">TGL PELAKSANAAN KEGIATAN</span>
                <span class="pv-sep">:</span>
                <span class="pv-val"><?php echo e($reimbursementReport->tgl_pelaksanaan->format('d M Y')); ?></span>
            </div>
            <div class="pv-row">
                <span class="pv-label">PENERIMA BANTUAN HUKUM</span>
                <span class="pv-sep">:</span>
                <span class="pv-val"><?php echo e($reimbursementReport->penerima_bantuan); ?></span>
            </div>
            <div class="pv-row">
                <span class="pv-label">TEMPAT PELAKSANAAN KEG.</span>
                <span class="pv-sep">:</span>
                <span class="pv-val"><?php echo e($reimbursementReport->tempat_pelaksanaan); ?></span>
            </div>
            <div class="pv-row">
                <span class="pv-label">MATERI</span>
                <span class="pv-sep">:</span>
                <span class="pv-val"><?php echo e($reimbursementReport->materi); ?></span>
            </div>
            <div class="pv-row">
                <span class="pv-label">NARASUMBER</span>
                <span class="pv-sep">:</span>
                <span class="pv-val"><?php echo e($reimbursementReport->narasumber); ?></span>
            </div>
        </div>

        
        <?php
            $pv_items = [
                'item1' => 'Formulir permohonan bantuan hukum',
                'item2' => 'SK Panitia',
                'item3' => 'Materi mengenai pengetahuan hukum',
                'item4' => 'Daftar Hadir Peserta',
                'item5' => 'Notula',
                'item6' => 'Dokumentasi kegiatan',
                'item7' => 'Laporan Kegiatan',
                'item8' => 'Kuitansi:'
            ];
            $pv_subitems = [
                'item8_1' => 'Biaya Konsumsi',
                'item8_2' => 'Biaya jasa Profesi/Narasumber (diberi stempel OBH)',
                'item8_3' => 'Biaya Penggandaan dan Penjilidan Laporan Akhir',
                'item8_4' => 'Dokumentasi Kegiatan',
                'item8_5' => 'Pembuatan Spanduk/Banner'
            ];
            $pv_checklist = $reimbursementReport->checklist_data ?? [];
            $pv_chk = function($key, $field) use ($pv_checklist) {
                return !empty($pv_checklist[$key][$field]) ? 'v' : '';
            };
        ?>

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
                <?php $__currentLoopData = $pv_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td class="no-col"><?php echo e(substr($key, 4)); ?>.</td>
                    <td><?php echo e($label); ?></td>
                    <?php if($key !== 'item8'): ?>
                        <td class="chk-col"><span class="pv-chk"><?php echo e($pv_chk($key, 'obh')); ?></span></td>
                        <td class="chk-col"><span class="pv-chk"><?php echo e($pv_chk($key, 'kanwil')); ?></span></td>
                        <td class="chk-col"><span class="pv-chk"><?php echo e($pv_chk($key, 'bphn')); ?></span></td>
                    <?php else: ?>
                        <td></td><td></td><td></td>
                    <?php endif; ?>
                </tr>
                <?php if($key === 'item8'): ?>
                    <?php $__currentLoopData = $pv_subitems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subkey => $sublabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td></td>
                        <td style="padding-left:20px;">- <?php echo e($sublabel); ?></td>
                        <td class="chk-col"><span class="pv-chk"><?php echo e($pv_chk($subkey, 'obh')); ?></span></td>
                        <td class="chk-col"><span class="pv-chk"><?php echo e($pv_chk($subkey, 'kanwil')); ?></span></td>
                        <td class="chk-col"><span class="pv-chk"><?php echo e($pv_chk($subkey, 'bphn')); ?></span></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        
        <div class="pv-keterangan">
            <div class="pv-ket-title">KETERANGAN :</div>
            - Jika <strong>ada</strong> beri tanda (&#10003;), <strong>tidak ada</strong> biarkan kosong.<br>
            - Form ini harus dilampirkan diatas dokumen.<br>
            - Berkas harus disusun berdasarkan urutan nomor.<br>
            - Berkas harus ASLI dan di <em>fotocopy</em>.<br>
            - Kartu BPJS tidak diperkenankan.<br>
            - Formulir laporan pelaksanaan kegiatan pemberdayaan hukum bisa dilihat di Buku Panduan Implementasi Undang-Undang Nomor 16 Tahun 2011 Tentang Bantuan Hukum.<br>
            - Kuitansi konsumsi, penggandaan, dokumentasi, dan pembuatan spanduk harus melampirkan bon berkop dari usaha ybs.
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
<?php /**PATH C:\xampp\htdocs\lbh\resources\views/reimbursement_reports/show_pemberdayaan.blade.php ENDPATH**/ ?>