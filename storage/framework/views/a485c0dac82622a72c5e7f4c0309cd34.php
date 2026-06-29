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
     <?php $__env->slot('header', null, []); ?> SIMBAKUM <?php $__env->endSlot(); ?>

    <style>
        .panel { border-radius: 16px; border: none; box-shadow: 0 4px 24px rgba(0,0,0,.07); overflow: hidden; }
        [data-bs-theme="dark"] .panel { background: #1a2035; }
        .panel-head { padding: 18px 24px; border-bottom: 1px solid rgba(0,0,0,.06); display: flex; align-items: center; justify-content: space-between; }
        [data-bs-theme="dark"] .panel-head { border-color: rgba(255,255,255,.06); }
        .data-table { margin: 0; }
        .data-table thead th { font-size: .7rem; font-weight: 700; text-transform: uppercase; letter-spacing: .6px; color: #94a3b8; padding: 14px 18px; background: transparent; border-bottom: 1px solid rgba(0,0,0,.06); }
        [data-bs-theme="dark"] .data-table thead th { border-color: rgba(255,255,255,.06); }
        .data-table tbody tr { border-bottom: 1px solid rgba(0,0,0,.04); transition: background .15s; }
        .data-table tbody tr:hover { background: rgba(99,102,241,.04); }
        [data-bs-theme="dark"] .data-table tbody tr:hover { background: rgba(255,255,255,.03); }
        .data-table td { padding: 16px 18px; vertical-align: middle; border: none; }
        .action-btn { width: 32px; height: 32px; border-radius: 8px; border: 1px solid rgba(0,0,0,.08); background: transparent; display: inline-flex; align-items: center; justify-content: center; font-size: .8rem; text-decoration: none; cursor: pointer; transition: all .15s; }
        .action-btn:hover { background: rgba(0,0,0,.05); transform: scale(1.08); }
        [data-bs-theme="dark"] .action-btn { border-color: rgba(255,255,255,.1); }
        .btn-cta { background: linear-gradient(135deg,#6366f1,#8b5cf6); border: none; color: #fff; font-weight: 600; font-size: .8rem; padding: 8px 18px; border-radius: 9px; transition: all .2s; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; box-shadow: 0 4px 14px rgba(99,102,241,.35); }
        .btn-cta:hover { opacity: .9; color: #fff; transform: translateY(-1px); }
        .empty-state { padding: 72px 24px; text-align: center; }
        .empty-icon { width: 80px; height: 80px; border-radius: 20px; background: rgba(99,102,241,.1); display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 2rem; color: #6366f1; }
    </style>

    <div class="panel">
        <div class="panel-head">
            <div class="d-flex align-items-center gap-3">
                <div style="width:36px;height:36px;border-radius:10px;background:rgba(99,102,241,.15);display:flex;align-items:center;justify-content:center;">
                    <i class="fa-solid fa-scale-balanced text-primary"></i>
                </div>
                <div>
                    <h6 style="font-size:.85rem;font-weight:600;" class="mb-0 fw-bold text-body">Daftar Data SIMBAKUM</h6>
                    <div style="font-size:.72rem;color:#94a3b8;">Total <?php echo e($simbakums->total()); ?> data terdata</div>
                </div>
            </div>
            <?php if(auth()->user()->role === 'admin'): ?>
            <a href="<?php echo e(route('simbakum.create')); ?>" class="btn-cta">
                <i class="fa-solid fa-plus"></i><span class="d-none d-sm-inline">Tambah Data</span>
            </a>
            <?php endif; ?>
        </div>

        <div class="table-responsive">
            <table class="data-table table">
                <thead>
                    <tr>
                        <th style="padding-left:24px;width:50px;">No.</th>
                        <th>No. Perkara</th>
                        <th>Tgl. Register</th>
                        <th>Klasifikasi</th>
                        <th>Terdakwa</th>
                        <th>Status</th>
                        <th>Lama Proses</th>
                        <th style="padding-right:24px;text-align:right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $simbakums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $simbakum): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td style="padding-left:24px;">
                            <span style="font-size:.8rem;color:#94a3b8;">
                                <?php echo e(($simbakums->currentPage() - 1) * $simbakums->perPage() + $loop->iteration); ?>

                            </span>
                        </td>
                        <td>
                            <div style="font-size:.85rem;font-weight:600;" class="text-body"><?php echo e($simbakum->no_perkara); ?></div>
                        </td>
                        <td>
                            <div style="font-size:.85rem;" class="text-body">
                                <?php echo e($simbakum->tanggal_register?->format('d M Y') ?? '-'); ?>

                            </div>
                        </td>
                        <td>
                            <div style="font-size:.85rem;" class="text-body"><?php echo e(Str::limit($simbakum->klasifikasi_perkara, 30)); ?></div>
                        </td>
                        <td>
                            <div style="font-size:.85rem;font-weight:600;" class="text-body"><?php echo e($simbakum->terdakwa); ?></div>
                        </td>
                        <td>
                            <span class="<?php echo e($simbakum->getStatusBadgeClass()); ?>"><?php echo e($simbakum->getStatusLabel()); ?></span>
                        </td>
                        <td>
                            <div style="font-size:.8rem;" class="text-body"><?php echo e($simbakum->getLamaProses()); ?></div>
                        </td>
                        <td style="padding-right:24px;text-align:right;">
                            <div class="d-flex justify-content-end gap-1">
                                
                                <button type="button"
                                    class="action-btn btn-lihat-dokumen"
                                    style="color:#6366f1;"
                                    title="Lihat Dokumen"
                                    data-bs-toggle="modal"
                                    data-bs-target="#dokumenModal"
                                    data-no-perkara="<?php echo e($simbakum->no_perkara); ?>"
                                    data-dokumens="<?php echo e($simbakum->dokumens->map(fn($d) => ['nama' => $d->nama_dokumen, 'url' => $d->url])->toJson()); ?>">
                                    <i class="fa-solid fa-file-pdf"></i>
                                </button>

                                
                                <a href="<?php echo e(route('simbakum.show', $simbakum)); ?>" class="action-btn" style="color:#0ea5e9;" title="Detail">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                <?php if(auth()->user()->role === 'admin'): ?>
                                
                                <a href="<?php echo e(route('simbakum.edit', $simbakum)); ?>" class="action-btn" style="color:#f59e0b;" title="Edit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                
                                <button type="button"
                                    onclick="confirmDelete('<?php echo e(route('simbakum.destroy', $simbakum)); ?>')"
                                    class="action-btn" style="color:#ef4444;" title="Hapus">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="8">
                            <div class="empty-state">
                                <div class="empty-icon"><i class="fa-solid fa-scale-balanced"></i></div>
                                <h6 style="font-size:.85rem;font-weight:600;" class="fw-bold text-body mb-1">Belum Ada Data SIMBAKUM</h6>
                                <p class="text-muted mb-4" style="font-size:.85rem;">Mulai dengan menambahkan data SIMBAKUM yang pertama.</p>
                                <?php if(auth()->user()->role === 'admin'): ?>
                                <a href="<?php echo e(route('simbakum.create')); ?>" class="btn-cta" style="margin:auto;width:fit-content;">
                                    <i class="fa-solid fa-plus"></i> Tambah Data
                                </a>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if($simbakums->hasPages()): ?>
        <div style="padding:16px 24px;border-top:1px solid rgba(0,0,0,.05);display:flex;justify-content:space-between;align-items:center;">
            <span style="font-size:.75rem;color:#94a3b8;">Halaman <?php echo e($simbakums->currentPage()); ?> dari <?php echo e($simbakums->lastPage()); ?></span>
            <?php echo e($simbakums->links('pagination::bootstrap-5')); ?>

        </div>
        <?php endif; ?>
    </div>

    
    <div class="modal fade" id="dokumenModal" tabindex="-1" aria-labelledby="dokumenModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius:14px;border:none;box-shadow:0 8px 32px rgba(0,0,0,.12);">
                <div class="modal-header" style="border-bottom:1px solid rgba(0,0,0,.06);">
                    <h5 class="modal-title fw-bold" id="dokumenModalLabel" style="font-size:.9rem;">
                        <i class="fa-solid fa-folder-open me-2 text-primary"></i>
                        Dokumen Perkara — <span id="modalNoPerkara"></span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalDokumenBody">
                    
                </div>
                <div class="modal-footer" style="border-top:1px solid rgba(0,0,0,.06);">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <form id="deleteForm" method="POST" style="display:none;"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?></form>

    <?php $__env->startPush('scripts'); ?>
    <script>
        function confirmDelete(action) {
            if (!confirm('Hapus data SIMBAKUM ini secara permanen?')) return;
            const f = document.getElementById('deleteForm');
            f.action = action;
            f.submit();
        }

        document.querySelectorAll('.btn-lihat-dokumen').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const noPerkara = this.dataset.noPerkara;
                const dokumens  = JSON.parse(this.dataset.dokumens || '[]');

                document.getElementById('modalNoPerkara').textContent = noPerkara;

                const body = document.getElementById('modalDokumenBody');
                if (dokumens.length === 0) {
                    body.innerHTML = '<p class="text-muted text-center py-3" style="font-size:.85rem;"><i class="fa-solid fa-folder-open me-2"></i>Belum ada dokumen untuk perkara ini.</p>';
                    return;
                }

                let html = '<ul class="list-group list-group-flush">';
                dokumens.forEach(function(doc, i) {
                    html += `<li class="list-group-item d-flex align-items-center justify-content-between px-0" style="border-color:rgba(0,0,0,.06);">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fa-solid fa-file-pdf text-danger" style="font-size:.9rem;"></i>
                            <span style="font-size:.85rem;font-weight:500;">${doc.nama}</span>
                        </div>
                        <a href="${doc.url}" target="_blank" class="btn btn-sm btn-outline-primary" style="font-size:.75rem;border-radius:8px;">
                            <i class="fa-solid fa-download me-1"></i>Unduh
                        </a>
                    </li>`;
                });
                html += '</ul>';
                body.innerHTML = html;
            });
        });
    </script>
    <?php $__env->stopPush(); ?>
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
<?php /**PATH C:\xampp\htdocs\lbh\resources\views/simbakum/index.blade.php ENDPATH**/ ?>