<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak - <?php echo e($permohonanNonLitigasi->no_registrasi); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            background: white;
            color: black;
            font-size: 13pt;
        }

        .page {
            max-width: 800px;
            margin: 30px auto;
            padding: 40px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #333;
            padding: 8px 12px;
            vertical-align: top;
        }

        table th {
            background-color: #f0f0f0;
            width: 35%;
        }

        .section-title {
            font-weight: bold;
            text-transform: uppercase;
            font-size: 11pt;
            border-bottom: 2px solid #333;
            padding-bottom: 4px;
            margin-top: 24px;
            margin-bottom: 12px;
        }

        .print-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 999;
        }

        .page-header {
            margin-bottom: 20px;
        }

        @media print {
            .print-btn {
                display: none !important;
            }

            body {
                margin: 0;
                padding: 0;
                font-size: 12pt;
            }

            .page {
                margin: 0;
                padding: 0;
                max-width: 100%;
            }
        }

        img.doc-img {
            max-height: 250px;
            border: 1px solid #ccc;
            object-fit: contain;
            display: block;
            margin-top: 8px;
        }

        .signature-block {
            margin-top: 40px;
            text-align: right;
        }

        .signature-block .sig-label {
            font-size: 12pt;
            margin-bottom: 4px;
        }

        .signature-block .sig-placeholder {
            height: 80px;
            border-bottom: 1px solid #333;
            width: 220px;
            display: inline-block;
        }

        .signature-block .sig-name {
            font-weight: bold;
            font-size: 12pt;
        }

        @page {
            size: A4;
            margin: 1cm;
            margin-top: 0.5cm;
            margin-bottom: 0.5cm;
        }
    </style>
</head>

<body>

    <div class="print-btn no-print">
        <button onclick="window.print()" class="btn btn-success fw-bold shadow"><i class="fa-solid fa-print me-1"></i>
            Cetak / Simpan PDF</button>
        <a href="<?php echo e(route('permohonan-non-litigasi.show', $permohonanNonLitigasi)); ?>"
            class="btn btn-secondary fw-medium ms-2">← Kembali</a>
    </div>

    <div class="page">

        
        <div class="page-header text-center mb-4">
            <h4 class="fw-bold text-uppercase mb-2" style="font-size: 15pt;">LEMBAGA BANTUAN HUKUM
                UNSUB</h4>
            <h4 class="fw-bold text-uppercase mb-2"
                style="text-decoration: underline; text-underline-offset: 5px; font-size: 15pt;">
                Formulir Permohonan Bantuan Layanan Non-Litigasi
            </h4>
        </div>

        <div style="display: flex; justify-content: space-between; margin-bottom: 20px; font-size: 12pt;">
            <div><strong>No. Registrasi :</strong> <?php echo e($permohonanNonLitigasi->no_registrasi); ?></div>
            <div><strong>Tanggal Pengajuan :</strong> <?php echo e($permohonanNonLitigasi->created_at->format('d M Y')); ?></div>
        </div>

        <hr style="border: 1.5px solid #333; margin-bottom: 20px;">

        
        <div class="section-title">A. Data Pemohon</div>
        <table>
            <tbody>
                <tr>
                    <th>Nama Pemohon</th>
                    <td><?php echo e($permohonanNonLitigasi->nama_pemohon); ?></td>
                </tr>
                <tr>
                    <th>NIK Pemohon</th>
                    <td><?php echo e($permohonanNonLitigasi->nik_pemohon); ?></td>
                </tr>
                <tr>
                    <th>Alamat Pemohon</th>
                    <td><?php echo e($permohonanNonLitigasi->alamat_pemohon); ?></td>
                </tr>
                <tr>
                    <th>Telp / HP</th>
                    <td><?php echo e($permohonanNonLitigasi->telp_hp_pemohon); ?></td>
                </tr>
            </tbody>
        </table>

        
        <div class="section-title mt-4">B. Data Layanan</div>
        <table>
            <tbody>
                <tr>
                    <th>Jenis Layanan</th>
                    <td><?php echo e($permohonanNonLitigasi->jenis_perkara); ?></td>
                </tr>
                <tr>
                    <th>Tgl. Rencana Kunjungan</th>
                    <td><?php echo e($permohonanNonLitigasi->tgl_rencana_kunjungan->format('d M Y')); ?></td>
                </tr>
                <tr>
                    <th style="vertical-align: top;">Uraian Singkat</th>
                    <td style="white-space: pre-line;"><?php echo e($permohonanNonLitigasi->uraian_singkat); ?></td>
                </tr>
            </tbody>
        </table>

        
        <?php if($permohonanNonLitigasi->file_ktp_kk): ?>
            <?php $ktpExt = strtolower(pathinfo($permohonanNonLitigasi->file_ktp_kk, PATHINFO_EXTENSION)); ?>
            <div class="section-title mt-4">C. Foto KTP / Kartu Keluarga (KK)</div>
            <?php if(in_array($ktpExt, ['jpg', 'jpeg', 'png'])): ?>
                <img src="<?php echo e(Storage::url($permohonanNonLitigasi->file_ktp_kk)); ?>" class="doc-img" alt="KTP/KK">
            <?php else: ?>
                <p style="font-size: 11pt; color: #555;">[File PDF terlampir –
                    <?php echo e(basename($permohonanNonLitigasi->file_ktp_kk)); ?>]
                </p>
            <?php endif; ?>
        <?php endif; ?>

        
        <?php if($permohonanNonLitigasi->file_sktm): ?>
            <?php $sktmExt = strtolower(pathinfo($permohonanNonLitigasi->file_sktm, PATHINFO_EXTENSION)); ?>
            <div class="section-title mt-4">D. SKTM (Surat Keterangan Tidak Mampu)</div>
            <?php if(in_array($sktmExt, ['jpg', 'jpeg', 'png'])): ?>
                <img src="<?php echo e(Storage::url($permohonanNonLitigasi->file_sktm)); ?>" class="doc-img" alt="SKTM">
            <?php else: ?>
                <p style="font-size: 11pt; color: #555;">[File PDF terlampir –
                    <?php echo e(basename($permohonanNonLitigasi->file_sktm)); ?>]
                </p>
            <?php endif; ?>
        <?php endif; ?>

        
        <div style="margin-top: 48px; display: flex; justify-content: flex-end;">
            <div style="text-align: center; min-width: 240px;">
                <p style="margin-bottom: 8px; font-size: 12pt;">Pemohon,</p>
                <?php if($permohonanNonLitigasi->file_ttd): ?>
                    <img src="<?php echo e(Storage::url($permohonanNonLitigasi->file_ttd)); ?>"
                        style="height: 150px; max-width: 280px; object-fit: contain; display: block; margin: 0 auto 4px;"
                        alt="TTD">
                <?php else: ?>
                    <div style="height: 90px;"></div>
                <?php endif; ?>
                <div style="border-top: 1px solid #333; padding-top: 6px; font-weight: bold; font-size: 12pt;">
                    <?php echo e($permohonanNonLitigasi->nama_pemohon); ?>

                </div>
                <div style="font-size: 11pt; margin-top: 4px;"><?php echo e($permohonanNonLitigasi->created_at->format('d M Y')); ?>

                </div>
            </div>
        </div>

    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</body>

</html><?php /**PATH C:\xampp\htdocs\lbh\resources\views/permohonan/non_litigasi/print.blade.php ENDPATH**/ ?>