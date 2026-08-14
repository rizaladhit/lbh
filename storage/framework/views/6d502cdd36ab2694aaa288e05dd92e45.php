<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Checklist Berkas - <?php echo e($tunReport->obh); ?></title>
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
        .pv-g2 .pv-label { min-width: 55mm; }

        .pv-gap { height: 10px; }

        .pv-sub-val { flex: 1; border-bottom: 1px dotted #555; min-width: 0; padding-left: 2px; }

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

        td.no-col { text-align: center; font-weight: bold; width: 40px; }
        td.chk-col { text-align: center; width: 68px; }
        th.chk-th  { width: 68px; }
        th.no-th   { width: 40px; }

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
        <a href="<?php echo e(route('tun-reports.show', $tunReport)); ?>" class="btn btn-secondary btn-sm fw-medium">
            Kembali
        </a>
    </div>

    <main class="page">
        <div class="pv-title">Check List Berkas Reimbursement Litigasi</div>

        
        <div class="pv-group pv-g1">
            <div class="pv-row">
                <span class="pv-label">OBH</span>
                <span class="pv-sep">:</span>
                <span class="pv-val"><?php echo e($tunReport->obh); ?></span>
            </div>
            <div class="pv-row">
                <span class="pv-label">ALAMAT</span>
                <span class="pv-sep">:</span>
                <span class="pv-val"><?php echo e($tunReport->alamat); ?></span>
            </div>
            <div class="pv-row">
                <span class="pv-label">PROVINSI</span>
                <span class="pv-sep">:</span>
                <span class="pv-val"><?php echo e($tunReport->provinsi); ?></span>
            </div>
        </div>

        <div class="pv-gap"></div>

        
        <div class="pv-group pv-g2">
            <div class="pv-row">
                <span class="pv-label">PERKARA</span>
                <span class="pv-sep">:</span>
                <span class="pv-val-fixed">TUN</span>
            </div>
            <div class="pv-row">
                <span class="pv-label">KASUS</span>
                <span class="pv-sep">:</span>
                <span class="pv-val"><?php echo e($tunReport->kasus); ?></span>
            </div>
            <div class="pv-row">
                <span class="pv-label">NOMOR PERKARA</span>
                <span class="pv-sep">:</span>
                <span class="pv-val"><?php echo e($tunReport->nomor_perkara); ?></span>
            </div>
            <div class="pv-row">
                <span class="pv-label">PENERIMA BANTUAN HUKUM</span>
                <span class="pv-sep">:</span>
                <span class="pv-val" style="display:flex;justify-content:space-between;">
                    <span><?php echo e($tunReport->penerima_bantuan); ?></span>
                    <strong>L/P : <?php echo e($tunReport->jk_penerima); ?></strong>
                </span>
            </div>
        </div>

        
        <?php
            $pv_items = [
                'item1'  => 'Surat Permohonan Bantuan Hukum',
                'item2'  => 'Surat Kuasa',
                'item3'  => 'SKTM Asli/ Legalisir Kartu JAMKESMAS/Kartu GAKIN/BLSM',
                'item4'  => 'Pendapat hukum (legal opinion)',
                'item5'  => 'Somasi',
                'item6'  => 'Gugatan atau jawaban gugatan',
                'item7'  => 'Eksepsi atau replik',
                'item8'  => 'Putusan',
                'item9'  => 'Memori banding atau kontra memori banding (wajib melampirkan putusan sebelumnya)',
                'item10' => 'Memori kasasi atau kontra memori kasasi (wajib melampirkan putusan sebelumnya)',
                'item11' => 'Memori peninjauan kembali atau kontra memori peninjauan kembali (wajib melampirkan putusan sebelumnya)',
                'item12' => 'Dokumen lain yang berkenaan dengan perkara, sebutkan:',
                'item13' => 'Kuitansi (diberi materai 6000 dan stempel OBH)',
            ];
            $pv_item12_sub = ['item12_a' => 'a', 'item12_b' => 'b', 'item12_c' => 'c'];
            $pv_cl = $tunReport->checklist_data ?? [];
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
                        <?php if($key !== 'item12'): ?>
                            <td class="chk-col"><span class="pv-chk"><?php echo e($pv_chk($key, 'obh')); ?></span></td>
                            <td class="chk-col"><span class="pv-chk"><?php echo e($pv_chk($key, 'kanwil')); ?></span></td>
                            <td class="chk-col"><span class="pv-chk"><?php echo e($pv_chk($key, 'bphn')); ?></span></td>
                        <?php else: ?>
                            <td></td><td></td><td></td>
                        <?php endif; ?>
                    </tr>
                    <?php if($key === 'item12'): ?>
                        <?php $__currentLoopData = $pv_item12_sub; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sk => $letter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td></td>
                                <td>
                                    <div style="display:flex;align-items:flex-end;gap:4px;">
                                        <span style="flex-shrink:0;"><?php echo e($letter); ?>.</span>
                                        <span class="pv-sub-val"><?php echo e($pv_cl[$sk]['text'] ?? ''); ?></span>
                                    </div>
                                </td>
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
            - Jika <strong>ada</strong> beri tanda (&#10003;), <strong>tidak ada</strong> beri tanda (&#10007;).<br>
            - Form ini harus dilampirkan diatas dokumen.<br>
            - Berkas harus disusun berdasarkan urutan nomor.<br>
            - Dokumen dari pengadilan harus <strong>ASLI</strong> atau <strong>LEGALISIR</strong> Pengadilan.<br>
            - Dokumen yang wajib dilampirkan adalah yang terdapat dalam aplikasi.
        </div>

        <?php echo $__env->make('partials.ketua-lbh-signature', ['space' => '42px'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </main>

</body>

</html>
<?php /**PATH C:\xampp\htdocs\lbh\resources\views/tun_reports/print.blade.php ENDPATH**/ ?>