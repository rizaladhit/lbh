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
    <?php
        $isTypePengadilan = $type === 'pengadilan';
        $isTypeLapas = $type === 'lapas';
        $typeLabel = $isTypePengadilan ? 'Pengadilan Subang' : ($isTypeLapas ? 'Lapas Subang' : 'PH');
        $headerTitle = "Daftar Laporan {$typeLabel}";
        $cardTitle = "Daftar Laporan {$typeLabel}";
        $createButtonRoute = $isTypePengadilan ? 'laporan-ph.pengadilan.create' : 'laporan-ph.lapas.create';
        $indexRoute = $isTypePengadilan ? 'laporan-ph.pengadilan.index' : 'laporan-ph.lapas.index';
        $printRoute = $isTypePengadilan ? 'laporan-ph.pengadilan.print' : 'laporan-ph.lapas.print';
        $printParams = array_filter(request()->only(['date_from', 'date_to']));
        $emptyMessage = $isTypePengadilan ? 'Belum ada laporan pengadilan.' : ($isTypeLapas ? 'Belum ada laporan lapas.' : 'Belum ada laporan.');
    ?>
    
     <?php $__env->slot('header', null, []); ?> <?php echo e($headerTitle); ?> <?php $__env->endSlot(); ?>

    <style>
        :root {
            --radius-card: 16px;
            --shadow-soft: 0 4px 24px rgba(0,0,0,.07);
            --shadow-hover: 0 8px 32px rgba(0,0,0,.13);
            --transition: all .22s cubic-bezier(.4,0,.2,1);
        }

        .stat-card {
            border-radius: var(--radius-card);
            border: none;
            overflow: hidden;
            display: block;
            box-shadow: var(--shadow-soft);
            transition: var(--transition);
            position: relative;
            min-height: 132px;
        }
        .stat-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-hover); }
        .stat-icon-wrap {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: rgba(255,255,255,.2);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .stat-count { font-size: 2rem; font-weight: 800; line-height: 1; color: #fff; }
        .stat-label { font-size: .78rem; color: rgba(255,255,255,.85); font-weight: 500; margin-top: 2px; }

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
        .data-table tbody tr { transition: var(--transition); }
        .data-table tbody tr:hover { background: rgba(16,185,129,.04); }
        [data-bs-theme="dark"] .data-table tbody tr:hover { background: rgba(255,255,255,.03); }
        .data-table td { padding: 16px; vertical-align: middle; border: none; }

        .reg-chip {
            font-size: .73rem;
            font-weight: 700;
            letter-spacing: .8px;
            padding: 4px 10px;
            border-radius: 999px;
            background: linear-gradient(135deg,rgba(16,185,129,.15),rgba(5,150,105,.15));
            color: #10b981;
            border: 1px solid rgba(16,185,129,.25);
            white-space: nowrap;
        }
        [data-bs-theme="dark"] .reg-chip { color: #6ee7b7; background: rgba(110,231,183,.1); border-color: rgba(110,231,183,.2); }

        .info-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 12px;
            border-radius: 999px;
            font-size: .75rem;
            font-weight: 700;
            white-space: nowrap;
            background: rgba(16,185,129,.12);
            color: #10b981;
            border: 1px solid rgba(16,185,129,.22);
        }

        .btn-cta {
            background: linear-gradient(135deg,#10b981,#059669);
            border: none;
            color: #fff;
            font-weight: 600;
            font-size: .83rem;
            padding: 9px 18px;
            border-radius: 10px;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 7px;
            text-decoration: none;
            box-shadow: 0 4px 14px rgba(16,185,129,.35);
        }
        .btn-cta:hover { opacity: .92; transform: translateY(-1px); color: #fff; box-shadow: 0 6px 20px rgba(16,185,129,.45); }

        .btn-print {
            background: linear-gradient(135deg,#4facfe,#00b8d9);
            border: none;
            color: #fff;
            font-weight: 600;
            font-size: .83rem;
            padding: 9px 18px;
            border-radius: 10px;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 7px;
            text-decoration: none;
            box-shadow: 0 4px 14px rgba(79,172,254,.32);
        }
        .btn-print:hover { opacity: .92; transform: translateY(-1px); color: #fff; box-shadow: 0 6px 20px rgba(79,172,254,.42); }

        .filter-form {
            display: flex;
            align-items: end;
            gap: 10px;
            flex-wrap: wrap;
        }
        .filter-field label {
            display: block;
            margin-bottom: 4px;
            color: #94a3b8;
            font-size: .68rem;
            font-weight: 700;
            letter-spacing: .5px;
            text-transform: uppercase;
        }
        .filter-input {
            border-radius: 10px;
            border: 1px solid rgba(0,0,0,.1);
            font-size: .83rem;
            height: 38px;
            background: transparent;
            transition: var(--transition);
            min-width: 150px;
        }
        .filter-input:focus { border-color: #10b981; box-shadow: 0 0 0 3px rgba(16,185,129,.15); outline: none; }
        [data-bs-theme="dark"] .filter-input { border-color: rgba(255,255,255,.1); color: #f1f1f1; }

        .empty-state { padding: 72px 24px; text-align: center; }
        .empty-icon {
            width: 80px;
            height: 80px;
            border-radius: 20px;
            background: linear-gradient(135deg,rgba(16,185,129,.12),rgba(5,150,105,.12));
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 2rem;
            color: #10b981;
        }
    </style>

    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="stat-card" style="background: linear-gradient(135deg,#10b981,#059669);">
                <div class="p-3 d-flex flex-column gap-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="stat-icon-wrap">
                            <i class="fa-solid fa-file-lines text-white" style="font-size:1.1rem;"></i>
                        </div>
                    </div>
                    <div>
                        <div class="stat-count"><?php echo e($reports->total()); ?></div>
                        <div class="stat-label">Total Laporan <?php echo e($typeLabel); ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="stat-card" style="background: linear-gradient(135deg,#4facfe,#00f2fe);">
                <div class="p-3 d-flex flex-column gap-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="stat-icon-wrap">
                            <i class="fa-solid fa-building-columns text-white" style="font-size:1.1rem;"></i>
                        </div>
                    </div>
                    <div>
                        <div class="stat-count"><?php echo e($reports->count()); ?></div>
                        <div class="stat-label">Ditampilkan di Halaman Ini</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-4">
            <a href="<?php echo e(route($createButtonRoute)); ?>" class="stat-card text-decoration-none" style="background: linear-gradient(135deg,#fa8231,#f7b733);">
                <div class="p-3 d-flex flex-column gap-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="stat-icon-wrap">
                            <i class="fa-solid fa-plus text-white" style="font-size:1.1rem;"></i>
                        </div>
                    </div>
                    <div>
                        <div class="stat-count" style="font-size:1.35rem;">Buat Baru</div>
                        <div class="stat-label">Tambah laporan penasehat hukum</div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="panel-card" style="background: var(--bs-card-bg, #fff);">
        <div class="panel-header flex-wrap gap-3">
            <div class="d-flex align-items-center gap-3">
                <div style="width:38px;height:38px;border-radius:10px;background:linear-gradient(135deg,#10b981,#059669);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="fa-solid fa-file-signature text-white" style="font-size:.9rem;"></i>
                </div>
                <div>
                    <h6 class="mb-0 fw-bold text-body" style="font-size:.95rem;"><?php echo e($cardTitle); ?></h6>
                    <p class="mb-0 text-muted" style="font-size:.75rem;"><?php echo e($reports->total()); ?> laporan ditemukan</p>
                </div>
            </div>
            <div class="d-flex align-items-end gap-2 flex-wrap ms-auto">
                <form method="GET" action="<?php echo e(route($indexRoute)); ?>" class="filter-form">
                    <div class="filter-field">
                        <label for="date_from">Dari</label>
                        <input id="date_from" name="date_from" type="date" class="form-control filter-input" value="<?php echo e(request('date_from')); ?>">
                    </div>
                    <div class="filter-field">
                        <label for="date_to">Sampai</label>
                        <input id="date_to" name="date_to" type="date" class="form-control filter-input" value="<?php echo e(request('date_to')); ?>">
                    </div>
                    <button type="submit" class="btn-cta">
                        <i class="fa-solid fa-filter"></i><span class="d-none d-sm-inline">Filter</span>
                    </button>
                </form>
                <?php if(request()->filled('date_from') || request()->filled('date_to')): ?>
                <a href="<?php echo e(route($indexRoute)); ?>" class="btn btn-light border fw-medium" style="height:38px;border-radius:10px;font-size:.83rem;display:inline-flex;align-items:center;">
                    Reset
                </a>
                <?php endif; ?>
                <a href="<?php echo e(route($printRoute, $printParams)); ?>" target="_blank" class="btn-print">
                    <i class="fa-solid fa-print"></i><span class="d-none d-sm-inline">Print</span>
                </a>
                <a href="<?php echo e(route($createButtonRoute)); ?>" class="btn-cta">
                    <i class="fa-solid fa-plus"></i><span class="d-none d-sm-inline">Buat Laporan</span>
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="data-table table">
                <thead>
                    <tr>
                        <th style="padding-left:24px;">No</th>
                        <th>No. Registrasi</th>
                        <th>Nama</th>
                        <th>Terdakwa</th>
                        <th>Jaksa</th>
                        <th>Penasehat Hukum</th>
                        <th>Jenis Perkara</th>
                        <th style="padding-right:24px;">Dibuat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td style="padding-left:24px;">
                            <span class="text-muted fw-semibold" style="font-size:.8rem;"><?php echo e($reports->firstItem() + $i); ?></span>
                        </td>
                        <td>
                            <span class="reg-chip"><?php echo e($r->no_registrasi_perkara ?: '-'); ?></span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div style="width:34px;height:34px;border-radius:10px;background:linear-gradient(135deg,rgba(16,185,129,.15),rgba(5,150,105,.15));display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                    <i class="fa-solid fa-user" style="color:#10b981;font-size:.75rem;"></i>
                                </div>
                                <div class="fw-semibold text-body" style="font-size:.87rem;"><?php echo e($r->nama ?: '-'); ?></div>
                            </div>
                        </td>
                        <td>
                            <span class="text-body fw-medium" style="font-size:.83rem;"><?php echo e($r->terdakwa ?: '-'); ?></span>
                        </td>
                        <td>
                            <span class="text-body fw-medium" style="font-size:.83rem;"><?php echo e($r->nama_jaksa ?: '-'); ?></span>
                        </td>
                        <td>
                            <span class="text-body fw-medium" style="font-size:.83rem;"><?php echo e($r->nama_penasehat_hukum ?: '-'); ?></span>
                        </td>
                        <td>
                            <span class="info-chip">
                                <i class="fa-solid fa-scale-balanced" style="font-size:.7rem;"></i>
                                <?php echo e($r->jenis_perkara ?: '-'); ?>

                            </span>
                        </td>
                        <td style="padding-right:24px;">
                            <div class="d-flex align-items-center gap-2">
                                <div style="width:30px;height:30px;border-radius:8px;background:rgba(250,130,49,.1);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                    <i class="fa-solid fa-calendar-days" style="font-size:.75rem;color:#fa8231;"></i>
                                </div>
                                <div>
                                    <div class="fw-medium text-body" style="font-size:.82rem;"><?php echo e($r->created_at->format('d M Y')); ?></div>
                                    <div class="text-muted" style="font-size:.7rem;"><?php echo e($r->created_at->diffForHumans()); ?></div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="8">
                            <div class="empty-state">
                                <div class="empty-icon"><i class="fa-solid fa-folder-open"></i></div>
                                <h6 class="fw-bold text-body mb-1">Belum Ada Laporan</h6>
                                <p class="text-muted mb-4" style="font-size:.85rem;"><?php echo e($emptyMessage); ?></p>
                                <a href="<?php echo e(route($createButtonRoute)); ?>" class="btn-cta" style="margin:auto;width:fit-content;">
                                    <i class="fa-solid fa-plus"></i> Buat Sekarang
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if($reports->hasPages()): ?>
        <div style="padding:16px 24px;border-top:1px solid rgba(0,0,0,.05);display:flex;justify-content:space-between;align-items:center;gap:16px;flex-wrap:wrap;">
            <span style="font-size:.75rem;color:#94a3b8;">Halaman <?php echo e($reports->currentPage()); ?> dari <?php echo e($reports->lastPage()); ?></span>
            <?php echo e($reports->links('pagination::bootstrap-5')); ?>

        </div>
        <?php endif; ?>
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
<?php /**PATH C:\xampp\htdocs\lbh\resources\views/reports/ph/index.blade.php ENDPATH**/ ?>