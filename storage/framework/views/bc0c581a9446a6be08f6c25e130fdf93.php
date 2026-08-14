<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Checklist Berkas - <?php echo e($penelitianHukumReport->obh); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            background: #fff;
            color: #111;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11px;
        }

        .page {
            max-width: 900px;
            margin: 24px auto;
            padding: 24px;
        }

        .print-actions {
            position: fixed;
            top: 18px;
            right: 18px;
            z-index: 999;
            display: flex;
            gap: 8px;
        }

        .pv-title {
            text-align: center;
            font-weight: bold;
            font-size: 14px;
            text-decoration: underline;
            text-transform: uppercase;
            margin-bottom: 18px;
        }

        .pv-group { margin-bottom: 6px; }

        .pv-row {
            display: flex;
            align-items: flex-end;
            margin-bottom: 6px;
            line-height: 1.4;
        }

        .pv-label {
            flex-shrink: 0;
            text-transform: uppercase;
            white-space: nowrap;
            font-weight: bold;
        }

        .pv-sep {
            flex-shrink: 0;
            padding: 0 5px;
            white-space: nowrap;
        }

        .pv-val {
            flex: 1;
            min-width: 0;
            border-bottom: 1px dotted #555;
            padding-left: 3px;
            word-break: break-word;
        }

        .pv-val-fixed { flex: 1; font-weight: bold; padding-left: 3px; }

        .pv-g1 .pv-label { min-width: 32mm; }
        .pv-g2 .pv-label { min-width: 72mm; }

        .pv-gap { height: 10px; }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 16px 0 12px 0;
        }

        th, td {
            border: 1px solid #333;
            padding: 5px 8px;
            vertical-align: top;
        }

        th {
            background: #e0e0e0;
            text-align: center;
            font-weight: 700;
            text-transform: uppercase;
        }

        td.no-col { text-align: center; font-weight: bold; width: 46px; }
        td.chk-col { text-align: center; width: 68px; }
        th.chk-th  { width: 68px; }
        th.no-th   { width: 46px; }

        .pv-chk {
            display: inline-block;
            width: 14px;
            height: 14px;
            border: 1px solid #333;
            text-align: center;
            line-height: 14px;
            font-size: 11px;
            font-weight: bold;
        }

        .pv-keterangan {
            font-size: 10px;
            margin-top: 10px;
            line-height: 1.6;
        }

        .pv-keterangan .pv-ket-title {
            font-weight: bold;
            margin-bottom: 3px;
        }

        @page { size: A4; margin: 1cm; }

        @media print {
            .print-actions { display: none !important; }
            body { margin: 0; }
            .page { max-width: 100%; margin: 0; padding: 0; }
        }
    </style>
</head>

<body>

    <div class="print-actions">
        <button onclick="window.print()" class="btn btn-success btn-sm fw-bold">
            <i class="fa-solid fa-print me-1"></i> Cetak / Simpan PDF
        </button>
        <a href="<?php echo e(route('penelitian-hukum-reports.show', $penelitianHukumReport)); ?>" class="btn btn-secondary btn-sm fw-medium">
            Kembali
        </a>
    </div>

    <main class="page">
        <div class="pv-title">Check List Berkas Laporan Penelitian Hukum</div>

        
        <div class="pv-group pv-g1">
            <div class="pv-row">
                <span class="pv-label">OBH</span>
                <span class="pv-sep">:</span>
                <span class="pv-val"><?php echo e($penelitianHukumReport->obh); ?></span>
            </div>
            <div class="pv-row">
                <span class="pv-label">ALAMAT</span>
                <span class="pv-sep">:</span>
                <span class="pv-val"><?php echo e($penelitianHukumReport->alamat); ?></span>
            </div>
            <div class="pv-row">
                <span class="pv-label">PROVINSI</span>
                <span class="pv-sep">:</span>
                <span class="pv-val"><?php echo e($penelitianHukumReport->provinsi); ?></span>
            </div>
        </div>

        <div class="pv-gap"></div>

        
        <div class="pv-group pv-g2">
            <div class="pv-row">
                <span class="pv-label">KEGIATAN</span>
                <span class="pv-sep">:</span>
                <span class="pv-val-fixed">PENELITIAN HUKUM</span>
            </div>
            <div class="pv-row">
                <span class="pv-label">TGL PELAKSANAAN KEGIATAN</span>
                <span class="pv-sep">:</span>
                <span class="pv-val"><?php echo e($penelitianHukumReport->tgl_pelaksanaan?->format('d M Y')); ?></span>
            </div>
            <div class="pv-row">
                <span class="pv-label">JUDUL PENELITIAN</span>
                <span class="pv-sep">:</span>
                <span class="pv-val"><?php echo e($penelitianHukumReport->judul_penelitian); ?></span>
            </div>
        </div>

        
        <?php
            $pv_items = [
                'item1' => 'SK Panitia Penelitian',
                'item2' => 'Proposal Penelitian Hukum',
                'item3' => 'Pembuatan Instrumen',
                'item4' => 'Penelitian Lapangan',
                'item5' => 'Pengolahan Data',
                'item6' => 'Laporan Sementara',
                'item7' => 'Pertemuan ilmiah/FGD',
                'item8' => 'Laporan Akhir hasil penelitian hukum',
                'item9' => 'Kuitansi:',
            ];
            $pv_item9_sub = [
                'item9_1' => 'Pembuatan Proposal',
                'item9_2' => 'Pembuatan Instrumen',
                'item9_3' => 'Penelitian Lapangan',
                'item9_4' => 'Tabulasi/Pengolahan Data',
                'item9_5' => 'Pembuatan Laporan Sementara',
                'item9_6' => 'Pertemuan ilmiah/FGD',
                'item9_7' => 'Penggandaan dan Penjilidan akhir',
            ];
            $pv_cl = $penelitianHukumReport->checklist_data ?? [];
            $pv_chk = function ($k, $f) use ($pv_cl) { return !empty($pv_cl[$k][$f]) ? 'v' : ''; };
        ?>

        <table>
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
                        <?php if($key !== 'item9'): ?>
                            <td class="chk-col"><span class="pv-chk"><?php echo e($pv_chk($key, 'obh')); ?></span></td>
                            <td class="chk-col"><span class="pv-chk"><?php echo e($pv_chk($key, 'kanwil')); ?></span></td>
                            <td class="chk-col"><span class="pv-chk"><?php echo e($pv_chk($key, 'bphn')); ?></span></td>
                        <?php else: ?>
                            <td></td><td></td><td></td>
                        <?php endif; ?>
                    </tr>
                    <?php if($key === 'item9'): ?>
                        <?php $__currentLoopData = $pv_item9_sub; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sk => $sl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td></td>
                                <td style="padding-left:20px;">- <?php echo e($sl); ?></td>
                                <td class="chk-col"><span class="pv-chk"><?php echo e($pv_chk($sk, 'obh')); ?></span></td>
                                <td class="chk-col"><span class="pv-chk"><?php echo e($pv_chk($sk, 'kanwil')); ?></span></td>
                                <td class="chk-col"><span class="pv-chk"><?php echo e($pv_chk($sk, 'bphn')); ?></span></td>
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
            - Proposal Penelitian diajukan anggota panitia kepada Pemberi Bantuan Hukum.<br>
            - Berkas harus ASLI dan difotokopi.<br>
            - Form Sistematika Proposal Penelitian dan Form Sistematika Laporan Akhir Penelitian Hukum bisa dilihat di Buku Panduan Implementasi Undang-Undang Nomor 16 Tahun 2011 Tentang Bantuan Hukum.<br>
            - Kuitansi Pembuatan Proposal, Pembuatan Instrumen, Tabulasi/Pengolahan data, dan Pembuatan Laporan Sementara diberi stempel OBH (&gt;Rp. 250rb diberi materai 3000).<br>
            - Kuitansi Penelitian lapangan sementara dan Pertemuan Ilmiah /FGD harus melampirkan bukti pengeluaran. Kuitansi harus dibubuhi stempel usaha ybs. dan melampirkan bon berkop dari usaha ybs. (&ge; 1jt diberi materai 6000).<br>
            - Kuitansi biaya penggandaan harus dibubuhi stempel usaha fotokopi ybs. dan melampirkan bon berkop dari usaha ybs.
        </div>

        <?php echo $__env->make('partials.ketua-lbh-signature', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </main>

</body>

</html>
<?php /**PATH C:\xampp\htdocs\lbh\resources\views/penelitian_hukum_reports/print.blade.php ENDPATH**/ ?>