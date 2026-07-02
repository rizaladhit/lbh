<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Penugasan Permohonan Non-Litigasi</title>
</head>
<body style="font-family: Arial, sans-serif; color: #1f2937; line-height: 1.6; margin: 0; padding: 24px; background: #f8fafc;">
    <div style="max-width: 640px; margin: 0 auto; background: #ffffff; border: 1px solid #e5e7eb; border-radius: 8px; padding: 24px;">
        <h1 style="font-size: 20px; margin: 0 0 16px; color: #111827;">Penugasan Permohonan Non-Litigasi</h1>

        <p>Yth. <?php echo e($recipientName); ?>,</p>

        <p>
            Anda ditugaskan sebagai <strong><?php echo e($recipientRole); ?></strong> untuk menangani permohonan non-litigasi berikut:
        </p>

        <table style="width: 100%; border-collapse: collapse; margin: 16px 0;">
            <tr>
                <td style="width: 180px; padding: 8px; border-bottom: 1px solid #e5e7eb; font-weight: bold;">No. Registrasi</td>
                <td style="padding: 8px; border-bottom: 1px solid #e5e7eb;"><?php echo e($permohonanNonLitigasi->no_registrasi); ?></td>
            </tr>
            <tr>
                <td style="padding: 8px; border-bottom: 1px solid #e5e7eb; font-weight: bold;">Nama Pemohon</td>
                <td style="padding: 8px; border-bottom: 1px solid #e5e7eb;"><?php echo e($permohonanNonLitigasi->nama_pemohon); ?></td>
            </tr>
            <tr>
                <td style="padding: 8px; border-bottom: 1px solid #e5e7eb; font-weight: bold;">Jenis Perkara</td>
                <td style="padding: 8px; border-bottom: 1px solid #e5e7eb;"><?php echo e($permohonanNonLitigasi->jenis_perkara); ?></td>
            </tr>
            <tr>
                <td style="padding: 8px; border-bottom: 1px solid #e5e7eb; font-weight: bold;">Tanggal Penugasan</td>
                <td style="padding: 8px; border-bottom: 1px solid #e5e7eb;"><?php echo e(optional($permohonanNonLitigasi->assigned_at)->format('d/m/Y H:i')); ?></td>
            </tr>
        </table>

        <p>
            Silakan masuk ke aplikasi untuk melihat detail permohonan.
        </p>

        <p style="margin: 24px 0;">
            <a href="<?php echo e(route('permohonan-non-litigasi.show', $permohonanNonLitigasi)); ?>" style="display: inline-block; background: #0ea5e9; color: #ffffff; text-decoration: none; padding: 10px 16px; border-radius: 6px; font-weight: bold;">
                Lihat Permohonan
            </a>
        </p>

        <p style="margin-top: 24px; color: #6b7280; font-size: 13px;">
            Email ini dikirim otomatis oleh sistem.
        </p>
    </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\lbh\resources\views/emails/permohonan-non-litigasi-assigned.blade.php ENDPATH**/ ?>