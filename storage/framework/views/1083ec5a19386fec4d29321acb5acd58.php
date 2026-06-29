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
     <?php $__env->slot('header', null, []); ?> Detail SIMBAKUM <?php $__env->endSlot(); ?>

    
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="mb-0 fw-bold" style="font-size:.9rem;">
                <i class="fa-solid fa-circle-info me-2 text-primary"></i>Detail Data Perkara
            </h6>
            <span class="<?php echo e($simbakum->getStatusBadgeClass()); ?>"><?php echo e($simbakum->getStatusLabel()); ?></span>
        </div>
        <div class="card-body p-4">
            <div class="d-flex mb-3" style="font-size:.85rem;">
                <span class="fw-semibold text-muted" style="min-width:200px;">No. Perkara</span>
                <span class="text-body fw-bold"><?php echo e($simbakum->no_perkara); ?></span>
            </div>
            <div class="d-flex mb-3" style="font-size:.85rem;">
                <span class="fw-semibold text-muted" style="min-width:200px;">Tanggal Register</span>
                <span class="text-body"><?php echo e($simbakum->tanggal_register?->format('d M Y') ?? '-'); ?></span>
            </div>
            <div class="d-flex mb-3" style="font-size:.85rem;">
                <span class="fw-semibold text-muted" style="min-width:200px;">Klasifikasi Perkara</span>
                <span class="text-body"><?php echo e($simbakum->klasifikasi_perkara); ?></span>
            </div>
            <div class="d-flex mb-3" style="font-size:.85rem;">
                <span class="fw-semibold text-muted" style="min-width:200px;">Terdakwa</span>
                <span class="text-body"><?php echo e($simbakum->terdakwa); ?></span>
            </div>
            <div class="d-flex mb-3" style="font-size:.85rem;">
                <span class="fw-semibold text-muted" style="min-width:200px;">Penuntut Umum</span>
                <span class="text-body"><?php echo e($simbakum->penuntut_umum); ?></span>
            </div>
            <div class="d-flex mb-3" style="font-size:.85rem;">
                <span class="fw-semibold text-muted" style="min-width:200px;">Advokat Pendamping</span>
                <span class="text-body"><?php echo e($simbakum->advokat_pendamping); ?></span>
            </div>
            <div class="d-flex mb-3" style="font-size:.85rem;">
                <span class="fw-semibold text-muted" style="min-width:200px;">Status Perkara</span>
                <span class="<?php echo e($simbakum->getStatusBadgeClass()); ?>"><?php echo e($simbakum->getStatusLabel()); ?></span>
            </div>
            <div class="d-flex mb-0" style="font-size:.85rem;">
                <span class="fw-semibold text-muted" style="min-width:200px;">Lama Proses</span>
                <span class="text-body"><?php echo e($simbakum->getLamaProses()); ?></span>
            </div>
        </div>
    </div>

    
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header py-3">
            <h6 class="mb-0 fw-bold" style="font-size:.9rem;">
                <i class="fa-solid fa-folder-open me-2 text-muted"></i>Dokumen Terlampir
            </h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-sm mb-0" style="font-size:.83rem;">
                    <thead style="background:rgba(99,102,241,.05);">
                        <tr>
                            <th style="padding:12px 20px;font-size:.7rem;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;">No.</th>
                            <th style="padding:12px 16px;font-size:.7rem;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;">Nama Dokumen</th>
                            <th style="padding:12px 16px;font-size:.7rem;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;text-align:right;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="dokumenTableBody">
                        <?php $__empty_1 = true; $__currentLoopData = $simbakum->dokumens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dokumen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr id="dokumen-row-<?php echo e($dokumen->id); ?>" style="border-bottom:1px solid rgba(0,0,0,.04);">
                            <td style="padding:12px 20px;color:#94a3b8;"><?php echo e($loop->iteration); ?></td>
                            <td style="padding:12px 16px;">
                                <i class="fa-solid fa-file-pdf text-danger me-2" style="font-size:.85rem;"></i>
                                <?php echo e($dokumen->nama_dokumen); ?>

                            </td>
                            <td style="padding:12px 16px;text-align:right;">
                                <div class="d-flex gap-1 justify-content-end">
                                    <a href="<?php echo e($dokumen->url); ?>" target="_blank" class="btn btn-sm btn-outline-primary" style="font-size:.73rem;border-radius:7px;">
                                        <i class="fa-solid fa-download me-1"></i>Unduh
                                    </a>
                                    <?php if(auth()->user()->role === 'admin'): ?>
                                    <button type="button"
                                        class="btn btn-sm btn-outline-danger btn-hapus-dokumen"
                                        style="font-size:.73rem;border-radius:7px;"
                                        data-id="<?php echo e($dokumen->id); ?>"
                                        data-url="<?php echo e(route('simbakum.dokumen.destroy', $dokumen)); ?>">
                                        <i class="fa-solid fa-trash me-1"></i>Hapus
                                    </button>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr id="emptyDokumenRow">
                            <td colspan="3" class="text-center text-muted py-4" style="font-size:.83rem;">
                                <i class="fa-solid fa-folder-open me-2"></i>Belum ada dokumen terlampir.
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            
            <?php if(auth()->user()->role === 'admin'): ?>
            <div class="p-4 border-top" style="border-color:rgba(0,0,0,.06)!important;">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="mb-0 fw-semibold" style="font-size:.83rem;">
                        <i class="fa-solid fa-upload me-2 text-muted"></i>Upload Dokumen Baru
                    </h6>
                    <button type="button" id="btnTambahDokumenShow" class="btn btn-sm btn-outline-primary" style="font-size:.78rem;border-radius:8px;">
                        <i class="fa-solid fa-plus me-1"></i>Tambah Baris
                    </button>
                </div>
                <form action="<?php echo e(route('simbakum.dokumen.upload', $simbakum)); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div id="uploadDokumenContainer">
                        <div class="upload-dok-row row g-2 mb-2 align-items-end">
                            <div class="col-md-5">
                                <label class="form-label" style="font-size:.78rem;color:#94a3b8;">Nama Dokumen</label>
                                <input type="text" name="new_nama_dokumen[]" class="form-control form-control-sm" placeholder="Nama dokumen">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" style="font-size:.78rem;color:#94a3b8;">File PDF</label>
                                <input type="file" name="new_file[]" class="form-control form-control-sm" accept=".pdf">
                            </div>
                            <div class="col-md-1 d-flex align-items-end pb-1">
                                <button type="button" class="btn btn-sm btn-outline-danger btn-hapus-upload-row" style="border-radius:8px;" title="Hapus">
                                    <i class="fa-solid fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-sm btn-primary" style="border-radius:8px;font-size:.8rem;background:linear-gradient(135deg,#6366f1,#8b5cf6);border:none;">
                            <i class="fa-solid fa-cloud-upload-alt me-1"></i>Upload
                        </button>
                    </div>
                </form>
            </div>
            <?php endif; ?>
        </div>
    </div>

    
    <div class="d-flex gap-2">
        <a href="<?php echo e(route('simbakum.index')); ?>" class="btn btn-outline-secondary" style="border-radius:9px;font-size:.83rem;">
            <i class="fa-solid fa-arrow-left me-1"></i>Kembali
        </a>
        <?php if(auth()->user()->role === 'admin'): ?>
        <a href="<?php echo e(route('simbakum.edit', $simbakum)); ?>" class="btn btn-warning text-white" style="border-radius:9px;font-size:.83rem;">
            <i class="fa-solid fa-pen-to-square me-1"></i>Edit
        </a>
        <?php endif; ?>
    </div>

    <?php $__env->startPush('scripts'); ?>
    <script>
        // Add new upload row
        document.getElementById('btnTambahDokumenShow')?.addEventListener('click', function() {
            const container = document.getElementById('uploadDokumenContainer');
            const newRow = document.createElement('div');
            newRow.className = 'upload-dok-row row g-2 mb-2 align-items-end';
            newRow.innerHTML = `
                <div class="col-md-5">
                    <label class="form-label" style="font-size:.78rem;color:#94a3b8;">Nama Dokumen</label>
                    <input type="text" name="new_nama_dokumen[]" class="form-control form-control-sm" placeholder="Nama dokumen">
                </div>
                <div class="col-md-6">
                    <label class="form-label" style="font-size:.78rem;color:#94a3b8;">File PDF</label>
                    <input type="file" name="new_file[]" class="form-control form-control-sm" accept=".pdf">
                </div>
                <div class="col-md-1 d-flex align-items-end pb-1">
                    <button type="button" class="btn btn-sm btn-outline-danger btn-hapus-upload-row" style="border-radius:8px;" title="Hapus">
                        <i class="fa-solid fa-times"></i>
                    </button>
                </div>
            `;
            container.appendChild(newRow);
            attachUploadRemoveHandlers();
        });

        function attachUploadRemoveHandlers() {
            document.querySelectorAll('.btn-hapus-upload-row').forEach(function(btn) {
                btn.onclick = function() {
                    const row = this.closest('.upload-dok-row');
                    if (row) row.remove();
                };
            });
        }

        attachUploadRemoveHandlers();

        // AJAX delete dokumen
        document.querySelectorAll('.btn-hapus-dokumen').forEach(function(btn) {
            btn.addEventListener('click', function() {
                if (!confirm('Hapus dokumen ini secara permanen?')) return;

                const id  = this.dataset.id;
                const url = this.dataset.url;
                const row = document.getElementById('dokumen-row-' + id);
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    }
                })
                .then(function(response) { return response.json(); })
                .then(function(data) {
                    if (data.success && row) {
                        row.remove();
                    }
                })
                .catch(function() {
                    alert('Terjadi kesalahan saat menghapus dokumen.');
                });
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
<?php /**PATH C:\xampp\htdocs\lbh\resources\views/simbakum/show.blade.php ENDPATH**/ ?>