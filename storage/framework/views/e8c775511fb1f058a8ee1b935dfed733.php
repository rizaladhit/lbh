<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        $isTypePengadilan = $type === 'pengadilan';
        $typeLabel = $isTypePengadilan ? 'Pengadilan Subang' : 'Lapas Subang';
        $backRoute = $isTypePengadilan ? 'laporan-ph.pengadilan.index' : 'laporan-ph.lapas.index';
        $dateFrom = request('date_from');
        $dateTo = request('date_to');
        $rangeLabel = 'Semua tanggal';

        if ($dateFrom && $dateTo) {
            $rangeLabel = \Carbon\Carbon::parse($dateFrom)->format('d M Y') . ' - ' . \Carbon\Carbon::parse($dateTo)->format('d M Y');
        } elseif ($dateFrom) {
            $rangeLabel = 'Mulai ' . \Carbon\Carbon::parse($dateFrom)->format('d M Y');
        } elseif ($dateTo) {
            $rangeLabel = 'Sampai ' . \Carbon\Carbon::parse($dateTo)->format('d M Y');
        }
    ?>
    <title>Cetak Daftar Laporan <?php echo e($typeLabel); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #fff;
            color: #111;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11px;
        }
        .page {
            max-width: 1180px;
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
        .doc-title {
            text-align: center;
            margin-bottom: 18px;
        }
        .doc-title h1 {
            font-size: 18px;
            font-weight: 800;
            margin: 0 0 6px;
            text-transform: uppercase;
        }
        .doc-title p {
            margin: 0;
            font-size: 12px;
        }
        .meta {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 14px;
            font-size: 11px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th,
        td {
            border: 1px solid #333;
            padding: 6px 7px;
            vertical-align: top;
        }
        th {
            background: #f0f0f0;
            text-align: center;
            font-weight: 700;
        }
        td.number {
            text-align: center;
            width: 34px;
        }
        .empty {
            text-align: center;
            padding: 18px;
            color: #555;
        }
        @page {
            size: A4 landscape;
            margin: 1cm;
        }
        @media print {
            .print-actions {
                display: none !important;
            }
            body {
                margin: 0;
            }
            .page {
                max-width: 100%;
                margin: 0;
                padding: 0;
            }
        }
    </style>
</head>
<body>
    <div class="print-actions">
        <button onclick="window.print()" class="btn btn-success btn-sm fw-bold">
            <i class="fa-solid fa-print me-1"></i> Cetak / Simpan PDF
        </button>
        <a href="<?php echo e(route($backRoute, request()->only(['date_from', 'date_to']))); ?>" class="btn btn-secondary btn-sm fw-medium">
            Kembali
        </a>
    </div>

    <main class="page">
        <div class="doc-title">
            <p>LEMBAGA BANTUAN HUKUM (LBH)</p>
            <h1>Daftar Laporan Penasehat Hukum <?php echo e($typeLabel); ?></h1>
            <p>Periode dibuat: <?php echo e($rangeLabel); ?></p>
        </div>

        <div class="meta">
            <div><strong>Total data:</strong> <?php echo e($reports->count()); ?> laporan</div>
            <div><strong>Tanggal cetak:</strong> <?php echo e(now()->format('d M Y H:i')); ?></div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>No. Registrasi</th>
                    <th>Nama</th>
                    <th>Terdakwa</th>
                    <th>Nama Jaksa</th>
                    <th>Nama PH</th>
                    <th>Jenis Perkara</th>
                    <th>Tanggal Dibuat</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="number"><?php echo e($i + 1); ?></td>
                    <td><?php echo e($report->no_registrasi_perkara ?: '-'); ?></td>
                    <td><?php echo e($report->nama ?: '-'); ?></td>
                    <td><?php echo e($report->terdakwa ?: '-'); ?></td>
                    <td><?php echo e($report->nama_jaksa ?: '-'); ?></td>
                    <td><?php echo e($report->nama_penasehat_hukum ?: '-'); ?></td>
                    <td><?php echo e($report->jenis_perkara ?: '-'); ?></td>
                    <td><?php echo e($report->created_at->format('d M Y H:i')); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="8" class="empty">Tidak ada laporan pada periode ini.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</body>
</html>
<?php /**PATH C:\xampp\htdocs\lbh\resources\views\reports\ph\print.blade.php ENDPATH**/ ?>