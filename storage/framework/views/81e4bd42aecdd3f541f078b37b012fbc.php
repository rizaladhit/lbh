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
     <?php $__env->slot('header', null, []); ?> <?php echo e($isAdmin ? 'Dashboard Admin' : ($isLawyer ? 'Dashboard Advocate' : 'Dashboard Pengguna')); ?> <?php $__env->endSlot(); ?>

    <?php
        $cards = $dashboardCards;
    ?>

    <style>
        .dash-card {
            border-radius: 16px; border: none;
            color: #fff; padding: 24px;
            box-shadow: 0 8px 28px rgba(0,0,0,.14);
            position: relative; overflow: hidden;
            transition: transform .2s, box-shadow .2s;
        }
        .dash-card:hover { transform: translateY(-3px); box-shadow: 0 12px 36px rgba(0,0,0,.18); }
        .dash-card::after {
            content: ''; position: absolute;
            width: 120px; height: 120px; border-radius: 50%;
            background: rgba(255,255,255,.1);
            right: -24px; bottom: -24px;
        }
        .dash-card-icon {
            width: 46px; height: 46px; border-radius: 12px;
            background: rgba(255,255,255,.2);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.15rem; margin-bottom: 16px;
        }
        .dash-card-val { font-size: 2.4rem; font-weight: 800; line-height: 1; }
        .dash-card-label { font-size: .78rem; font-weight: 600; opacity: .9; margin-top: 4px; }
        .dash-card-sub { font-size: .7rem; opacity: .7; margin-top: 2px; }

        .panel { border-radius: 16px; border: none; box-shadow: 0 4px 24px rgba(0,0,0,.07); overflow: hidden; }
        [data-bs-theme="dark"] .panel { background: #1a2035; }
        .panel-head {
            padding: 18px 22px;
            border-bottom: 1px solid rgba(0,0,0,.06);
            display: flex; align-items: center; gap: 12px;
        }
        [data-bs-theme="dark"] .panel-head { border-color: rgba(255,255,255,.06); }
        .panel-head-icon {
            width: 34px; height: 34px; border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            font-size: .8rem;
        }
        .panel-title { font-weight: 700; font-size: .9rem; color: #1e293b; }
        [data-bs-theme="dark"] .panel-title { color: #f1f5f9; }

        .type-row {
            display: flex; align-items: center; justify-content: space-between;
            padding: 14px 22px;
            border-bottom: 1px solid rgba(0,0,0,.04);
            transition: background .15s;
        }
        .type-row:last-child { border: none; }
        .type-row:hover { background: rgba(99,102,241,.04); }
        [data-bs-theme="dark"] .type-row:hover { background: rgba(255,255,255,.03); }

        .activity-item {
            display: flex; align-items: flex-start; gap: 12px;
            padding: 14px 22px;
            border-bottom: 1px solid rgba(0,0,0,.04);
            transition: background .15s;
        }
        .activity-item:last-child { border: none; }
        .activity-item:hover { background: rgba(99,102,241,.04); }
        .activity-dot {
            width: 32px; height: 32px; border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0; font-size: .72rem;
        }

        .quick-link {
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            gap: 8px; padding: 20px 12px;
            border-radius: 12px;
            text-decoration: none;
            border: 1.5px dashed rgba(99,102,241,.2);
            transition: all .2s;
            color: #64748b;
            font-size: .75rem; font-weight: 600; text-align: center;
        }
        .quick-link:hover {
            border-color: #6366f1;
            background: rgba(99,102,241,.05);
            color: #6366f1;
            transform: translateY(-2px);
        }
        .quick-link-icon {
            width: 40px; height: 40px; border-radius: 11px;
            display: flex; align-items: center; justify-content: center;
            font-size: .95rem;
        }
    </style>

    
    <div class="row g-4 mb-4">
        <?php $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="dash-card" style="background: <?php echo e($c['g']); ?>;">
                <div class="dash-card-icon"><i class="<?php echo e($c['icon']); ?> text-white"></i></div>
                <div class="dash-card-val"><?php echo e($c['val']); ?></div>
                <div class="dash-card-label"><?php echo e($c['label']); ?></div>
                <div class="dash-card-sub"><?php echo e($c['sub']); ?></div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    
    <div class="row g-3 mb-4">
        <?php $__currentLoopData = $quickLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-6 col-md-3">
            <a href="<?php echo e($l['href']); ?>" class="quick-link">
                <div class="quick-link-icon" style="background:<?php echo e($l['bg']); ?>;">
                    <i class="<?php echo e($l['icon']); ?>" style="color:<?php echo e($l['ic']); ?>;"></i>
                </div>
                <?php echo e($l['label']); ?>

            </a>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <?php if(isset($statusSummary) && count($statusSummary)): ?>
    <div class="row g-4 mb-4">
        <div class="col-12">
            <div class="panel">
                <div class="panel-head">
                    <div class="panel-head-icon" style="background:rgba(59,130,246,.12);">
                        <i class="fa-solid fa-chart-pie" style="color:#3b82f6;"></i>
                    </div>
                    <div class="panel-title">Ringkasan Status Permohonan</div>
                </div>
                <div class="row g-3 p-3">
                    <?php $__currentLoopData = $statusSummary; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $summary): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-sm-6 col-xl-3">
                        <div class="dash-card" style="background: linear-gradient(135deg, <?php echo e($summary['color']); ?>, rgba(255,255,255,.08)); color: #111;">
                            <div class="dash-card-icon" style="background: rgba(255,255,255,.4);">
                                <i class="fa-solid fa-circle-dot text-dark"></i>
                            </div>
                            <div class="dash-card-val" style="color:#111;"><?php echo e($summary['count']); ?></div>
                            <div class="dash-card-label" style="color:#111;"><?php echo e($summary['name']); ?></div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="row g-4">
        
        <div class="col-lg-5">
            <div class="panel h-100">
                <div class="panel-head">
                    <div class="panel-head-icon" style="background:rgba(99,102,241,.1);">
                        <i class="fa-solid fa-chart-bar" style="color:#6366f1;"></i>
                    </div>
                    <div class="panel-title">Permohonan by Tipe</div>
                    <div class="ms-auto">
                        <span style="font-size:.7rem;color:#94a3b8;">Ringkasan</span>
                    </div>
                </div>
                <?php $__empty_1 = true; $__currentLoopData = $permohonanByType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="type-row">
                    <div class="d-flex align-items-center gap-3">
                        <div style="width:8px;height:8px;border-radius:50%;background:<?php echo e($loop->first ? '#6366f1' : '#10b981'); ?>;"></div>
                        <span style="font-weight:600;font-size:.85rem;color:#1e293b;" class="text-body"><?php echo e($type->name); ?></span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <div style="width:80px;height:6px;border-radius:99px;background:rgba(0,0,0,.06);overflow:hidden;">
                            <div style="height:100%;border-radius:99px;background:<?php echo e($loop->first ? '#6366f1' : '#10b981'); ?>;
                                width:<?php echo e($totalPermohonan > 0 ? round($type->count / $totalPermohonan * 100) : 0); ?>%;"></div>
                        </div>
                        <span style="font-weight:700;font-size:.82rem;color:<?php echo e($loop->first ? '#6366f1' : '#10b981'); ?>;min-width:20px;"><?php echo e($type->count); ?></span>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div style="padding:48px 22px;text-align:center;">
                    <i class="fa-solid fa-inbox" style="font-size:2rem;color:#cbd5e1;display:block;margin-bottom:8px;"></i>
                    <span style="color:#94a3b8;font-size:.8rem;">Belum ada data</span>
                </div>
                <?php endif; ?>
            </div>
        </div>

        
        <div class="col-lg-7">
            <div class="panel h-100">
                <div class="panel-head">
                    <div class="panel-head-icon" style="background:rgba(245,158,11,.1);">
                        <i class="fa-solid fa-clock-rotate-left" style="color:#f59e0b;"></i>
                    </div>
                    <div class="panel-title">Aktivitas Terkini</div>
                </div>
                <div style="max-height:420px;overflow-y:auto;">
                    <?php $__empty_1 = true; $__currentLoopData = $recentActivities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php
                        $dotBg = match($activity->action ?? '') {
                            'Created' => ['bg'=>'rgba(16,185,129,.12)', 'ic'=>'#10b981', 'icon'=>'fa-solid fa-plus'],
                            'Updated' => ['bg'=>'rgba(245,158,11,.12)', 'ic'=>'#f59e0b', 'icon'=>'fa-solid fa-pen'],
                            'Deleted' => ['bg'=>'rgba(239,68,68,.12)',  'ic'=>'#ef4444', 'icon'=>'fa-solid fa-trash'],
                            default   => ['bg'=>'rgba(99,102,241,.12)', 'ic'=>'#6366f1', 'icon'=>'fa-solid fa-bolt'],
                        };
                        $relatedUrl = $activity->getRelatedUrl();
                        $relatedLabel = $activity->getRelatedLabel();
                    ?>
                    <div class="activity-item">
                        <div class="activity-dot" style="background:<?php echo e($dotBg['bg']); ?>;">
                            <i class="<?php echo e($dotBg['icon']); ?>" style="color:<?php echo e($dotBg['ic']); ?>;"></i>
                        </div>
                        <div style="flex:1;">
                            <div style="display:flex;justify-content:space-between;align-items:flex-start;gap:10px;">
                                <div>
                                    <span style="font-weight:600;font-size:.83rem;color:#1e293b;" class="text-body"><?php echo e($activity->user->name ?? 'System'); ?></span>
                                    <div style="font-size:.76rem;color:#64748b;margin-top:2px;"><?php echo e($activity->action); ?> <?php echo e($relatedLabel); ?></div>
                                </div>
                                <span style="font-size:.68rem;color:#94a3b8;white-space:nowrap;"><?php echo e($activity->created_at->diffForHumans()); ?></span>
                            </div>
                            <p style="margin:8px 0 0;font-size:.8rem;color:#475569;"><?php echo e($activity->description); ?></p>
                            <?php if($relatedUrl): ?>
                            <a href="<?php echo e($relatedUrl); ?>" class="small fw-semibold text-primary" style="text-decoration:none;">
                                Lihat <?php echo e($relatedLabel); ?> <i class="fa-solid fa-arrow-right-long" style="font-size:.7rem;"></i>
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div style="padding:48px 22px;text-align:center;">
                        <i class="fa-solid fa-circle-info" style="font-size:2rem;color:#cbd5e1;display:block;margin-bottom:8px;"></i>
                        <span style="color:#94a3b8;font-size:.8rem;">Belum ada aktivitas.</span>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
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
<?php /**PATH C:\xampp\htdocs\lbh\resources\views\dashboard.blade.php ENDPATH**/ ?>