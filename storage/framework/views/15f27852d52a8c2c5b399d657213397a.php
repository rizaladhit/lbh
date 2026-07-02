<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Update Status Permohonan Litigasi</title>
</head>
<body style="font-family: Arial, sans-serif; color: #1f2937; line-height: 1.6; margin: 0; padding: 24px; background: #f8fafc;">
    <div style="max-width: 640px; margin: 0 auto; background: #ffffff; border: 1px solid #e5e7eb; border-radius: 8px; overflow: hidden;">

        
        <div style="background: <?php echo e($headerColor); ?>; padding: 20px 24px;">
            <h1 style="font-size: 18px; margin: 0; color: #ffffff;">Update Permohonan Litigasi</h1>
            <p style="margin: 4px 0 0; font-size: 13px; color: rgba(255,255,255,.8);">No. Registrasi: <?php echo e($permohonanLitigasi->no_registrasi); ?></p>
        </div>

        <div style="padding: 24px;">
            <p>Yth. <?php echo e($permohonanLitigasi->nama); ?>,</p>

            <p><?php echo e($pesan); ?></p>

            <table style="width: 100%; border-collapse: collapse; margin: 16px 0;">
                <tr>
                    <td style="width: 180px; padding: 8px; border-bottom: 1px solid #e5e7eb; font-weight: bold;">No. Registrasi</td>
                    <td style="padding: 8px; border-bottom: 1px solid #e5e7eb;"><?php echo e($permohonanLitigasi->no_registrasi); ?></td>
                </tr>
                <tr>
                    <td style="padding: 8px; border-bottom: 1px solid #e5e7eb; font-weight: bold;">Jenis Perkara</td>
                    <td style="padding: 8px; border-bottom: 1px solid #e5e7eb;"><?php echo e($permohonanLitigasi->jenis_perkara); ?></td>
                </tr>
                <tr>
                    <td style="padding: 8px; border-bottom: 1px solid #e5e7eb; font-weight: bold;">Status Terbaru</td>
                    <td style="padding: 8px; border-bottom: 1px solid #e5e7eb;">
                        <strong><?php echo e($statusLabel); ?></strong>
                    </td>
                </tr>
                <?php if($catatanNilai): ?>
                <tr>
                    <td style="padding: 8px; border-bottom: 1px solid #e5e7eb; font-weight: bold;"><?php echo e($catatanLabel); ?></td>
                    <td style="padding: 8px; border-bottom: 1px solid #e5e7eb;"><?php echo e($catatanNilai); ?></td>
                </tr>
                <?php endif; ?>
                <?php if($permohonanLitigasi->assignedLawyer): ?>
                <tr>
                    <td style="padding: 8px; border-bottom: 1px solid #e5e7eb; font-weight: bold;">Advocate</td>
                    <td style="padding: 8px; border-bottom: 1px solid #e5e7eb;"><?php echo e($permohonanLitigasi->assignedLawyer->name); ?></td>
                </tr>
                <?php endif; ?>
                <?php if($permohonanLitigasi->assignedParalegal): ?>
                <tr>
                    <td style="padding: 8px; border-bottom: 1px solid #e5e7eb; font-weight: bold;">Paralegal</td>
                    <td style="padding: 8px; border-bottom: 1px solid #e5e7eb;"><?php echo e($permohonanLitigasi->assignedParalegal->name); ?></td>
                </tr>
                <?php endif; ?>
            </table>

            <p>
                Silakan masuk ke aplikasi untuk melihat detail permohonan Anda.
            </p>

            <p style="margin: 24px 0;">
                <a href="<?php echo e(route('permohonan-litigasi.show', $permohonanLitigasi)); ?>"
                   style="display: inline-block; background: <?php echo e($headerColor); ?>; color: #ffffff; text-decoration: none; padding: 10px 16px; border-radius: 6px; font-weight: bold;">
                    Lihat Permohonan
                </a>
            </p>

            <p style="margin-top: 24px; color: #6b7280; font-size: 13px;">
                Email ini dikirim otomatis oleh sistem.
            </p>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\lbh\resources\views/emails/permohonan-litigasi-status.blade.php ENDPATH**/ ?>