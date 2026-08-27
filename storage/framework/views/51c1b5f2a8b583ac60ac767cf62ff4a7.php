<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Checklist Investigasi Kasus - <?php echo e($investigasiKasusReport->obh); ?></title>
    <style>
        @page {
            size: A4;
            margin: 20px 28px 130px 28px;
        }

        body {
            font-family: "Calibri", "DejaVu Sans", sans-serif;
            font-size: 13px;
            color: #111;
        }

        .title {
            text-align: center;
            font-weight: bold;
            font-size: 17px;
            text-decoration: underline;
            text-transform: uppercase;
            margin-bottom: 16px;
        }

        table.info { width: 100%; border-collapse: collapse; margin-bottom: 6px; }
        table.info td { padding: 2px 0; vertical-align: bottom; }
        table.info td.lbl { width: 200px; font-weight: bold; text-transform: uppercase; white-space: nowrap; }
        table.info td.sep { width: 12px; }
        table.info td.val { border-bottom: 1px dotted #555; }
        table.info td.val-fixed { font-weight: bold; }

        table.checklist { width: 100%; border-collapse: collapse; margin: 4px 0 10px 0; }
        table.checklist th, table.checklist td {
            border: 1px solid #333;
            padding: 4px 6px;
        }
        table.checklist th {
            background: #e0e0e0;
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
        }
        table.checklist td.no-col { text-align: center; font-weight: bold; width: 30px; }
        table.checklist td.chk-col { text-align: center; width: 55px; }
        table.checklist th.chk-th { width: 55px; }
        table.checklist th.no-th { width: 30px; }
        table.checklist td.sub-label { padding-left: 18px; color: #444; }

        .keterangan { font-size: 11px; margin-top: 8px; line-height: 1.6; page-break-inside: avoid; }
        .keterangan .ket-title { font-weight: bold; margin-bottom: 3px; }

        .section-block { margin-bottom: 12px; }
        .section-block.page-break { page-break-before: always; }

        .signature-fixed {
            position: fixed;
            bottom: 20px;
            right: 0;
            width: 100%;
            text-align: right;
        }
        .signature-box { display: inline-block; text-align: center; min-width: 220px; }
        .signature-name { border-top: 1px solid #333; padding-top: 4px; font-weight: bold; margin-top: 45px; }
    </style>
</head>
<body>

    <div class="title">Check List Berkas Reimbursement Non Litigasi</div>

    <table class="info">
        <tr>
            <td class="lbl">OBH</td>
            <td class="sep">:</td>
            <td class="val"><?php echo e($investigasiKasusReport->obh); ?></td>
        </tr>
        <tr>
            <td class="lbl">ALAMAT</td>
            <td class="sep">:</td>
            <td class="val"><?php echo e($investigasiKasusReport->alamat); ?></td>
        </tr>
        <tr>
            <td class="lbl">PROVINSI</td>
            <td class="sep">:</td>
            <td class="val"><?php echo e($investigasiKasusReport->provinsi); ?></td>
        </tr>
    </table>

    <?php
        $sub_items = [
            0 => ['item4_1' => 'Biaya Investigator (diberi stempel OBH)'],
            1 => ['item4_1' => 'Biaya Investigator (diberi stempel OBH)'],
            2 => ['item4_1' => 'Biaya Investigator (diberi stempel OBH)'],
            3 => ['item4_1' => 'Biaya Investigator'],
            4 => ['item4_1' => 'Biaya Investigator (diberi stempel OBH)', 'item4_2' => 'Biaya Penggandaan laporan Akhir'],
        ];
        $secs = $investigasiKasusReport->sections ?? [];
    ?>

    <?php for($i = 0; $i < 5; $i++): ?>
        <?php
            $sec = $secs[$i] ?? [];
            $cl  = $sec['checklist'] ?? [];
            $chk = function ($k, $f) use ($cl) { return !empty($cl[$k][$f]) ? 'v' : ''; };
        ?>

        <div class="section-block <?php echo e(($i === 2 || $i === 4) ? 'page-break' : ''); ?>">
            <table class="info">
                <tr>
                    <td class="lbl">KEGIATAN</td>
                    <td class="sep">:</td>
                    <td class="val-fixed">INVESTIGASI KASUS</td>
                </tr>
                <tr>
                    <td class="lbl">JENIS KEGIATAN INVESTIGASI</td>
                    <td class="sep">:</td>
                    <td class="val"><?php echo e($sec['jenis_investigasi'] ?? ''); ?></td>
                </tr>
                <tr>
                    <td class="lbl">TGL PELAKSANAAN KEGIATAN</td>
                    <td class="sep">:</td>
                    <td class="val"><?php echo e(!empty($sec['tgl_pelaksanaan']) ? \Carbon\Carbon::parse($sec['tgl_pelaksanaan'])->translatedFormat('d F Y') : ''); ?></td>
                </tr>
                <tr>
                    <td class="lbl">PENERIMA BANTUAN HUKUM</td>
                    <td class="sep">:</td>
                    <td class="val"><?php echo e($sec['penerima_bantuan'] ?? ''); ?> &nbsp;&nbsp; (L/P : <?php echo e($sec['jk_penerima'] ?? '-'); ?>)</td>
                </tr>
                <tr>
                    <td class="lbl">NAMA INVESTIGATOR</td>
                    <td class="sep">:</td>
                    <td class="val"><?php echo e($sec['nama_investigator'] ?? ''); ?></td>
                </tr>
            </table>

            <table class="checklist">
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
                    <tr>
                        <td class="no-col">1.</td>
                        <td>SKTM Asli/ Legalisir Kartu JAMKESMAS/Kartu GAKIN/BLSM, dll.</td>
                        <td class="chk-col"><?php echo e($chk('item1', 'obh')); ?></td>
                        <td class="chk-col"><?php echo e($chk('item1', 'kanwil')); ?></td>
                        <td class="chk-col"><?php echo e($chk('item1', 'bphn')); ?></td>
                    </tr>
                    <tr>
                        <td class="no-col">2.</td>
                        <td>Formulir investigasi kasus yang sudah diisi lengkap</td>
                        <td class="chk-col"><?php echo e($chk('item2', 'obh')); ?></td>
                        <td class="chk-col"><?php echo e($chk('item2', 'kanwil')); ?></td>
                        <td class="chk-col"><?php echo e($chk('item2', 'bphn')); ?></td>
                    </tr>
                    <tr>
                        <td class="no-col">3.</td>
                        <td>Laporan hasil investigasi kasus</td>
                        <td class="chk-col"><?php echo e($chk('item3', 'obh')); ?></td>
                        <td class="chk-col"><?php echo e($chk('item3', 'kanwil')); ?></td>
                        <td class="chk-col"><?php echo e($chk('item3', 'bphn')); ?></td>
                    </tr>
                    <tr>
                        <td class="no-col">4.</td>
                        <td>Kuitansi:</td>
                        <td></td><td></td><td></td>
                    </tr>
                    <?php $__currentLoopData = $sub_items[$i]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sk => $slabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td></td>
                            <td class="sub-label">- <?php echo e($slabel); ?></td>
                            <td class="chk-col"><?php echo e($chk($sk, 'obh')); ?></td>
                            <td class="chk-col"><?php echo e($chk($sk, 'kanwil')); ?></td>
                            <td class="chk-col"><?php echo e($chk($sk, 'bphn')); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    <?php endfor; ?>

    <div class="keterangan">
        <div class="ket-title">KETERANGAN :</div>
        - Jika <strong>ada</strong> beri tanda (&#10003;), <strong>tidak ada</strong> beri tanda (&#10007;).<br>
        - Form ini harus dilampirkan diatas dokumen.<br>
        - Berkas harus disusun berdasarkan urutan nomor.<br>
        - Investigasi diajukan per-paket 5 kasus.<br>
        - Berkas harus <strong>ASLI</strong> dan di <em>fotocopy</em>.<br>
        - Kartu BPJS tidak diperkenankan.<br>
        - Form investigasi bisa dilihat di Buku Panduan Implementasi Undang-Undang Nomor 16 Tahun 2011 Tentang Bantuan Hukum.<br>
        - Kuitansi biaya penggandaan harus dibubuhi stempel usaha fotokopi ybs. dan melampirkan bon berkop dari usaha ybs.
    </div>

    <?php
        $ketuaLbhName = trim($appSetting->ketua_lbh ?? '');
    ?>
    <div class="signature-fixed">
        <div class="signature-box">
            <div>Ketua LBH UNSUB,</div>
            <div class="signature-name"><?php echo e($ketuaLbhName !== '' ? $ketuaLbhName : 'Ketua LBH UNSUB'); ?></div>
        </div>
    </div>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\lbh\resources\views/investigasi_kasus_reports/pdf.blade.php ENDPATH**/ ?>