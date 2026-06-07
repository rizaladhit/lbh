<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reports Export</title>
    <style>
        body { font-family: sans-serif; font-size: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 6px; text-align: left; }
        th { background-color: #f4f4f4; color: #333; }
        h1 { text-align: center; color: #333; font-size: 16px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <h1>LBH Legal Service Reports</h1>
    <table>
        <thead>
            <tr>
                <th>Report ID</th>
                <th>Category</th>
                <th>Date</th>
                <th>Client Name</th>
                <th>Case Title</th>
                <th>Status</th>
                <th>User</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($report->report_id); ?></td>
                    <td><?php echo e($report->category->name ?? 'N/A'); ?></td>
                    <td><?php echo e($report->date); ?></td>
                    <td><?php echo e($report->client_name); ?></td>
                    <td><?php echo e($report->case_title); ?></td>
                    <td><?php echo e($report->status); ?></td>
                    <td><?php echo e($report->user->name ?? 'N/A'); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\lbh\resources\views\reports\pdf.blade.php ENDPATH**/ ?>