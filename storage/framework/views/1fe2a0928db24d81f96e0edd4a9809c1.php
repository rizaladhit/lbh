<?php
    $ketuaLbhName = trim($appSetting->ketua_lbh ?? '');
    $signatureMarginTop = $marginTop ?? '48px';
    $signatureSpace = $space ?? '72px';
    $isFixedBottom = $fixedBottom ?? false;
    $signatureWrapperStyle = $isFixedBottom
        ? 'position: fixed; right: 18mm; bottom: 18mm; z-index: 2147483647; display: flex; justify-content: flex-end; page-break-inside: avoid; break-inside: avoid; background: #fff; color: #000;'
        : "margin-top: {$signatureMarginTop}; display: flex; justify-content: flex-end; page-break-inside: avoid; break-inside: avoid;";
?>

<style>
    @media print {
        .ketua-lbh-signature,
        .ketua-lbh-signature * {
            display: flex !important;
            visibility: visible !important;
            opacity: 1 !important;
            color: #000 !important;
        }

        .ketua-lbh-signature-inner,
        .ketua-lbh-signature-inner * {
            display: block !important;
        }

        .ketua-lbh-signature-fixed {
            position: fixed !important;
            right: 18mm !important;
            bottom: 18mm !important;
            z-index: 2147483647 !important;
            background: #fff !important;
        }
    }
</style>

<div class="ketua-lbh-signature <?php echo e($isFixedBottom ? 'ketua-lbh-signature-fixed' : ''); ?>" style="<?php echo e($signatureWrapperStyle); ?>">
    <div class="ketua-lbh-signature-inner" style="text-align: center; min-width: 260px;">
        <div style="font-size: 12pt; margin-bottom: <?php echo e($signatureSpace); ?>;">Ketua LBH UNSUB,</div>
        <div style="border-top: 1px solid #333; padding-top: 6px; font-weight: bold; font-size: 12pt;">
            <?php echo e($ketuaLbhName !== '' ? $ketuaLbhName : 'Ketua LBH UNSUB'); ?>

        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\lbh\resources\views/partials/ketua-lbh-signature.blade.php ENDPATH**/ ?>