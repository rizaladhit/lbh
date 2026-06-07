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
     <?php $__env->slot('header', null, []); ?> Permohonan Non-Litigasi <?php $__env->endSlot(); ?>

    <?php
        $activeFilter = request('status', 'ALL');
        $stats = [
            'ALL'        => ['label' => 'Total Semua',     'icon' => 'fa-solid fa-layer-group',      'grad' => 'linear-gradient(135deg,#10b981,#059669)', 'count' => $totalAll],
            'REGISTERED' => ['label' => 'Terdaftar',       'icon' => 'fa-solid fa-file-circle-plus', 'grad' => 'linear-gradient(135deg,#4facfe,#00f2fe)', 'count' => $statusCounts['REGISTERED'] ?? 0],
            'APPROVED'   => ['label' => 'Disetujui',       'icon' => 'fa-solid fa-thumbs-up',       'grad' => 'linear-gradient(135deg,#2d98da,#4ac6ff)', 'count' => $statusCounts['APPROVED']   ?? 0],
            'VERIFIED'   => ['label' => 'Terverifikasi',   'icon' => 'fa-solid fa-circle-check',     'grad' => 'linear-gradient(135deg,#43e97b,#38f9d7)', 'count' => $statusCounts['VERIFIED']   ?? 0],
            'ASSIGNED'   => ['label' => 'Ditugaskan',      'icon' => 'fa-solid fa-user-tie',         'grad' => 'linear-gradient(135deg,#fa8231,#f7b733)', 'count' => $statusCounts['ASSIGNED']   ?? 0],
            'DONE'       => ['label' => 'Selesai',         'icon' => 'fa-solid fa-flag-checkered',   'grad' => 'linear-gradient(135deg,#a18cd1,#fbc2eb)', 'count' => $statusCounts['DONE']       ?? 0],
            'REJECTED'   => ['label' => 'Ditolak',         'icon' => 'fa-solid fa-ban',             'grad' => 'linear-gradient(135deg,#d63031,#ff6b6b)', 'count' => $statusCounts['REJECTED']   ?? 0],
        ];
    ?>

    <style>
        /* ── Page Variables ── */
        :root {
            --radius-card : 16px;
            --shadow-soft : 0 4px 24px rgba(0,0,0,.07);
            --shadow-hover: 0 8px 32px rgba(0,0,0,.13);
            --transition  : all .22s cubic-bezier(.4,0,.2,1);
        }

        /* ── Stat Cards ── */
        .stat-card {
            border-radius: var(--radius-card);
            border: none;
            overflow: hidden;
            cursor: pointer;
            text-decoration: none;
            display: block;
            box-shadow: var(--shadow-soft);
            transition: var(--transition);
            position: relative;
        }
        .stat-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-hover); }
        .stat-card.active-card { transform: translateY(-4px); box-shadow: var(--shadow-hover); }
        .stat-card.active-card::after {
            content: '';
            position: absolute; inset: 0;
            border-radius: var(--radius-card);
            border: 2.5px solid rgba(255,255,255,.55);
            pointer-events: none;
        }
        .stat-icon-wrap {
            width: 48px; height: 48px;
            border-radius: 12px;
            background: rgba(255,255,255,.2);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .stat-count { font-size: 2rem; font-weight: 800; line-height: 1; color: #fff; }
        .stat-label { font-size: .78rem; color: rgba(255,255,255,.85); font-weight: 500; margin-top: 2px; }
        .stat-card.active-card .active-indicator {
            position: absolute; bottom: 0; left: 0; right: 0;
            height: 3px; background: rgba(255,255,255,.6);
        }

        /* ── Table Panel ── */
        .panel-card {
            border-radius: var(--radius-card);
            border: none;
            box-shadow: var(--shadow-soft);
            overflow: hidden;
        }
        .panel-header {
            padding: 18px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid rgba(0,0,0,.06);
        }
        [data-bs-theme="dark"] .panel-header { border-color: rgba(255,255,255,.07); }

        .data-table { margin: 0; border-collapse: separate; border-spacing: 0; }
        .data-table thead th {
            font-size: .72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .6px;
            padding: 14px 16px;
            color: #8b9cb6;
            background: transparent;
            border-bottom: 1px solid rgba(0,0,0,.06);
            white-space: nowrap;
        }
        [data-bs-theme="dark"] .data-table thead th {
            color: #6b7a93;
            border-color: rgba(255,255,255,.07);
        }
        .data-table tbody tr {
            transition: var(--transition);
            border-bottom: 1px solid transparent;
        }
        .data-table tbody tr:hover { background: rgba(16,185,129,.04); }
        [data-bs-theme="dark"] .data-table tbody tr:hover { background: rgba(255,255,255,.03); }
        .data-table td { padding: 16px; vertical-align: middle; border: none; }

        .reg-chip {
            font-size: .73rem; font-weight: 700;
            letter-spacing: .8px;
            padding: 4px 10px;
            border-radius: 999px;
            background: linear-gradient(135deg,rgba(16,185,129,.15),rgba(5,150,105,.15));
            color: #10b981;
            border: 1px solid rgba(16,185,129,.25);
            white-space: nowrap;
        }
        [data-bs-theme="dark"] .reg-chip { color: #6ee7b7; background: rgba(110,231,183,.1); border-color: rgba(110,231,183,.2); }

        .action-btn {
            width: 32px; height: 32px;
            border-radius: 8px;
            border: 1px solid rgba(0,0,0,.08);
            background: transparent;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: .8rem;
            transition: var(--transition);
            text-decoration: none;
            cursor: pointer;
        }
        .action-btn:hover { background: rgba(0,0,0,.05); border-color: rgba(0,0,0,.15); transform: scale(1.08); }
        [data-bs-theme="dark"] .action-btn { border-color: rgba(255,255,255,.1); }
        [data-bs-theme="dark"] .action-btn:hover { background: rgba(255,255,255,.07); }

        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 12px;
            border-radius: 999px;
            font-size: .75rem;
            font-weight: 700;
            white-space: nowrap;
        }
        .status-dot { width: 7px; height: 7px; border-radius: 50%; display: inline-block; }

        .wf-stepper { display: flex; align-items: center; gap: 4px; margin-top: 6px; }
        .wf-step {
            width: 22px; height: 4px; border-radius: 2px;
            background: rgba(0,0,0,.08);
            transition: var(--transition);
        }
        [data-bs-theme="dark"] .wf-step { background: rgba(255,255,255,.1); }
        .wf-step.done { opacity: 1; }

        .btn-cta {
            background: linear-gradient(135deg,#10b981,#059669);
            border: none; color: #fff; font-weight: 600; font-size: .83rem;
            padding: 9px 18px; border-radius: 10px; transition: var(--transition);
            display: inline-flex; align-items: center; gap: 7px; text-decoration: none;
            box-shadow: 0 4px 14px rgba(16,185,129,.35);
        }
        .btn-cta:hover { opacity: .92; transform: translateY(-1px); color: #fff; box-shadow: 0 6px 20px rgba(16,185,129,.45); }

        .empty-state { padding: 72px 24px; text-align: center; }
        .empty-icon {
            width: 80px; height: 80px; border-radius: 20px;
            background: linear-gradient(135deg,rgba(16,185,129,.12),rgba(5,150,105,.12));
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 20px; font-size: 2rem; color: #10b981;
        }

        .search-wrap { position: relative; }
        .search-wrap .search-icon {
            position: absolute; left: 12px; top: 50%; transform: translateY(-50%);
            color: #aab; font-size: .85rem; pointer-events: none;
        }
        .search-input {
            padding-left: 36px; border-radius: 10px;
            border: 1px solid rgba(0,0,0,.1);
            font-size: .83rem;
            height: 36px;
            background: transparent;
            transition: var(--transition);
        }
        .search-input:focus { border-color: #10b981; box-shadow: 0 0 0 3px rgba(16,185,129,.15); outline: none; }
        [data-bs-theme="dark"] .search-input { border-color: rgba(255,255,255,.1); color: #f1f1f1; }
    </style>

    
    <div class="row g-3 mb-4">
        <?php $__currentLoopData = $stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $isActive = $activeFilter === $key; ?>
        <div class="col-6 col-sm-4 col-xl">
            <a href="<?php echo e($key === 'ALL' ? route('permohonan-non-litigasi.index') : route('permohonan-non-litigasi.index', ['status' => $key])); ?>"
               class="stat-card <?php echo e($isActive ? 'active-card' : ''); ?>"
               style="background: <?php echo e($s['grad']); ?>;">
                <?php if($isActive): ?><div class="active-indicator"></div><?php endif; ?>
                <div class="p-3 d-flex flex-column gap-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="stat-icon-wrap">
                            <i class="<?php echo e($s['icon']); ?> text-white" style="font-size:1.1rem;"></i>
                        </div>
                        <?php if($isActive): ?>
                        <span style="background:rgba(255,255,255,.2);color:#fff;font-size:.65rem;font-weight:700;padding:2px 8px;border-radius:999px;letter-spacing:.5px;">
                            AKTIF
                        </span>
                        <?php endif; ?>
                    </div>
                    <div>
                        <div class="stat-count"><?php echo e($s['count']); ?></div>
                        <div class="stat-label"><?php echo e($s['label']); ?></div>
                    </div>
                </div>
            </a>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    
    <div class="panel-card" style="background: var(--bs-card-bg, #fff);">
        <div class="panel-header flex-wrap gap-3">
            <div class="d-flex align-items-center gap-3">
                <div style="width:38px;height:38px;border-radius:10px;background:linear-gradient(135deg,#10b981,#059669);
                            display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="fa-solid fa-handshake text-white" style="font-size:.9rem;"></i>
                </div>
                <div>
                    <h6 class="mb-0 fw-bold text-body" style="font-size:.95rem;">Daftar Permohonan Non-Litigasi</h6>
                    <p class="mb-0 text-muted" style="font-size:.75rem;">
                        <?php if($activeFilter !== 'ALL'): ?>
                            Menampilkan filter: <strong><?php echo e($stats[$activeFilter]['label']); ?></strong> &bull;
                        <?php endif; ?>
                        <?php echo e($permohonan->total()); ?> permohonan ditemukan
                    </p>
                </div>
            </div>
            
            <div class="d-flex align-items-center gap-2 ms-auto">
                
                <form method="GET" action="<?php echo e(route('permohonan-non-litigasi.index')); ?>" class="d-none d-md-block">
                    <?php if($activeFilter !== 'ALL'): ?>
                        <input type="hidden" name="status" value="<?php echo e($activeFilter); ?>">
                    <?php endif; ?>
                    <div class="search-wrap">
                        <i class="fa-solid fa-magnifying-glass search-icon"></i>
                        <input type="text" name="search" value="<?php echo e(request('search')); ?>"
                               class="form-control search-input" placeholder="Cari nama / perkara…">
                    </div>
                </form>
                <?php if(!in_array(auth()->user()->role, ['pengacara', 'paralegal'])): ?>
                <a href="<?php echo e(route('permohonan-non-litigasi.create')); ?>" class="btn-cta">
                    <i class="fa-solid fa-plus"></i><span class="d-none d-sm-inline">Ajukan Permohonan</span>
                </a>
                <?php endif; ?>
            </div>
        </div>

        <div class="table-responsive">
            <table class="data-table table">
                <thead>
                    <tr>
                        <th style="padding-left:24px;">No. Registrasi</th>
                        <th>Pemohon</th>
                        <th>Jenis Perkara</th>
                        <th>Status & Alur</th>
                        <th>Tgl Kunjungan</th>
                        <?php if(auth()->user()->role === 'admin'): ?>
                        <th>Diajukan Oleh</th>
                        <?php endif; ?>
                        <th style="padding-right:24px;text-align:right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $permohonan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php
                        $statusConfig = [
                            'REGISTERED' => ['badge' => '#4facfe', 'bg'  => 'rgba(79,172,254,.12)', 'label' => 'Terdaftar',     'icon' => 'fa-solid fa-file-circle-plus'],
                            'APPROVED'   => ['badge' => '#2d98da', 'bg'  => 'rgba(45,152,218,.12)', 'label' => 'Disetujui',     'icon' => 'fa-solid fa-thumbs-up'],
                            'VERIFIED'   => ['badge' => '#43e97b', 'bg'  => 'rgba(67,233,123,.12)', 'label' => 'Terverifikasi', 'icon' => 'fa-solid fa-circle-check'],
                            'ASSIGNED'   => ['badge' => '#fa8231', 'bg'  => 'rgba(250,130,49,.12)', 'label' => 'Ditugaskan',    'icon' => 'fa-solid fa-user-tie'],
                            'DONE'       => ['badge' => '#a18cd1', 'bg'  => 'rgba(161,140,209,.12)','label' => 'Selesai',       'icon' => 'fa-solid fa-flag-checkered'],
                            'REJECTED'   => ['badge' => '#d63031', 'bg'  => 'rgba(214,48,49,.12)', 'label' => 'Ditolak',       'icon' => 'fa-solid fa-ban'],
                        ];
                        $sc   = $statusConfig[$item->status] ?? $statusConfig['REGISTERED'];
                        $steps= ['REGISTERED','APPROVED','VERIFIED','ASSIGNED','DONE'];
                        $idx  = array_search($item->status, $steps);
                        $idx  = $idx === false ? -1 : $idx;
                        $stepColors = ['#4facfe','#2d98da','#43e97b','#fa8231','#a18cd1'];
                    ?>
                    <tr>
                        <td style="padding-left:24px;">
                            <span class="reg-chip"><?php echo e($item->no_registrasi ?? '—'); ?></span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div style="width:34px;height:34px;border-radius:10px;background:linear-gradient(135deg,rgba(16,185,129,.15),rgba(5,150,105,.15));display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                    <i class="fa-solid fa-user" style="color:#10b981;font-size:.75rem;"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold text-body" style="font-size:.87rem;"><?php echo e($item->nama_pemohon); ?></div>
                                    <div class="text-muted" style="font-size:.72rem;">NIK: <?php echo e(substr($item->nik_pemohon, 0, 6)); ?>••••••</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="text-body fw-medium" style="font-size:.83rem;"><?php echo e($item->jenis_perkara); ?></span>
                            <div class="text-muted" style="font-size:.72rem;margin-top:2px;max-width:250px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                                <?php echo e($item->uraian_singkat); ?>

                            </div>
                        </td>
                        <td>
                            <span class="status-pill"
                                  style="background:<?php echo e($sc['bg']); ?>;color:<?php echo e($sc['badge']); ?>;border:1px solid <?php echo e($sc['badge']); ?>22;">
                                <span class="status-dot" style="background:<?php echo e($sc['badge']); ?>;box-shadow:0 0 0 2px <?php echo e($sc['badge']); ?>33;"></span>
                                <i class="<?php echo e($item->getStatusIcon()); ?>" style="font-size:.7rem;"></i>
                                <?php echo e($sc['label']); ?>

                            </span>
                            
                            <div class="wf-stepper" title="Progress alur: <?php echo e(implode(' → ', array_map(fn($s) => $statusConfig[$s]['label'], $steps))); ?>">
                                <?php $__currentLoopData = $steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="wf-step <?php echo e($i <= $idx ? 'done' : ''); ?>"
                                         style="<?php echo e($i <= $idx ? 'background:'.$stepColors[$i].';' : ''); ?>"></div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div style="width:30px;height:30px;border-radius:8px;background:rgba(250,130,49,.1);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                    <i class="fa-solid fa-calendar-days" style="font-size:.75rem;color:#fa8231;"></i>
                                </div>
                                <div>
                                    <div class="fw-medium text-body" style="font-size:.82rem;"><?php echo e($item->tgl_rencana_kunjungan->format('d M Y')); ?></div>
                                    <div class="text-muted" style="font-size:.7rem;"><?php echo e($item->tgl_rencana_kunjungan->diffForHumans()); ?></div>
                                </div>
                            </div>
                        </td>
                        <?php if(auth()->user()->role === 'admin'): ?>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($item->user->name ?? 'U')); ?>&background=10b981&color=fff&size=28"
                                     width="28" height="28" class="rounded-circle" alt="">
                                <span class="text-body" style="font-size:.8rem;"><?php echo e($item->user->name ?? '—'); ?></span>
                            </div>
                        </td>
                        <?php endif; ?>
                        <td style="padding-right:24px;text-align:right;">
                            <div class="d-flex justify-content-end align-items-center gap-1">
                                <a href="<?php echo e(route('permohonan-non-litigasi.show', $item)); ?>" class="action-btn btn-view" style="color:#10b981;" title="Lihat Detail">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <?php if(auth()->user()->role === 'admin'): ?>
                                <button onclick="confirmDelete('<?php echo e(route('permohonan-non-litigasi.destroy', $item)); ?>')" class="action-btn btn-delete" style="color:#ef4444;" title="Hapus">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="<?php echo e(auth()->user()->role === 'admin' ? 7 : 6); ?>">
                            <div class="empty-state">
                                <div class="empty-icon"><i class="fa-solid fa-folder-open"></i></div>
                                <h6 class="fw-bold text-body mb-1">Belum Ada Permohonan</h6>
                                <p class="text-muted mb-4" style="font-size:.85rem;">
                                    <?php if($activeFilter !== 'ALL'): ?>
                                        Tidak ada permohonan dengan status <strong><?php echo e($stats[$activeFilter]['label']); ?></strong>.
                                    <?php else: ?>
                                        Ajukan permohonan bantuan layanan non-litigasi pertama Anda.
                                    <?php endif; ?>
                                </p>
                                <a href="<?php echo e(route('permohonan-non-litigasi.create')); ?>" class="btn-cta" style="margin:auto;width:fit-content;">
                                    <i class="fa-solid fa-plus"></i> Ajukan Sekarang
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if($permohonan->hasPages()): ?>
        <div style="padding:16px 24px;border-top:1px solid rgba(0,0,0,.05);display:flex;justify-content:space-between;align-items:center;">
            <span style="font-size:.75rem;color:#94a3b8;">Halaman <?php echo e($permohonan->currentPage()); ?> dari <?php echo e($permohonan->lastPage()); ?></span>
            <?php echo e($permohonan->links('pagination::bootstrap-5')); ?>

        </div>
        <?php endif; ?>
    </div>

    <form id="deleteForm" method="POST" style="display:none;"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?></form>
    <script>
        function confirmDelete(action){
            if(!confirm('Hapus data permohonan ini?')) return;
            const f = document.getElementById('deleteForm'); f.action = action; f.submit();
        }
    </script>
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


<?php /**PATH C:\xampp\htdocs\lbh\resources\views\permohonan\non_litigasi\index.blade.php ENDPATH**/ ?>