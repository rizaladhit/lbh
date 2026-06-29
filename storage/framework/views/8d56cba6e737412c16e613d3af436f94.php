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
     <?php $__env->slot('header', null, []); ?> Edit Data SIMBAKUM <?php $__env->endSlot(); ?>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header py-3">
            <h6 class="mb-0 fw-bold" style="font-size:.9rem;">
                <i class="fa-solid fa-pen-to-square me-2 text-warning"></i>Edit Data SIMBAKUM — <?php echo e($simbakum->no_perkara); ?>

            </h6>
        </div>
        <div class="card-body p-4">
            <form action="<?php echo e(route('simbakum.update', $simbakum)); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="row g-3">
                    
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size:.83rem;">No. Perkara <span class="text-danger">*</span></label>
                        <input type="text" name="no_perkara" class="form-control <?php $__errorArgs = ['no_perkara'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               value="<?php echo e(old('no_perkara', $simbakum->no_perkara)); ?>" required>
                        <?php $__errorArgs = ['no_perkara'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size:.83rem;">Tanggal Register <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_register" class="form-control <?php $__errorArgs = ['tanggal_register'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               value="<?php echo e(old('tanggal_register', $simbakum->tanggal_register?->format('Y-m-d'))); ?>" required>
                        <?php $__errorArgs = ['tanggal_register'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div class="col-md-12">
                        <label class="form-label fw-semibold" style="font-size:.83rem;">Klasifikasi Perkara <span class="text-danger">*</span></label>
                        <input type="text" name="klasifikasi_perkara" class="form-control <?php $__errorArgs = ['klasifikasi_perkara'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               value="<?php echo e(old('klasifikasi_perkara', $simbakum->klasifikasi_perkara)); ?>" required>
                        <?php $__errorArgs = ['klasifikasi_perkara'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size:.83rem;">Terdakwa <span class="text-danger">*</span></label>
                        <input type="text" name="terdakwa" class="form-control <?php $__errorArgs = ['terdakwa'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               value="<?php echo e(old('terdakwa', $simbakum->terdakwa)); ?>" required>
                        <?php $__errorArgs = ['terdakwa'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size:.83rem;">Penuntut Umum <span class="text-danger">*</span></label>
                        <input type="text" name="penuntut_umum" class="form-control <?php $__errorArgs = ['penuntut_umum'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               value="<?php echo e(old('penuntut_umum', $simbakum->penuntut_umum)); ?>" required>
                        <?php $__errorArgs = ['penuntut_umum'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size:.83rem;">Advokat Pendamping <span class="text-danger">*</span></label>
                        <input type="text" name="advokat_pendamping" class="form-control <?php $__errorArgs = ['advokat_pendamping'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               value="<?php echo e(old('advokat_pendamping', $simbakum->advokat_pendamping)); ?>" required>
                        <?php $__errorArgs = ['advokat_pendamping'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size:.83rem;">Status Perkara <span class="text-danger">*</span></label>
                        <select name="status_perkara_id" class="form-select <?php $__errorArgs = ['status_perkara_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                            <option value="">-- Pilih Status --</option>
                            <?php $__currentLoopData = $statusPerkaras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($sp->id); ?>" <?php echo e(old('status_perkara_id', $simbakum->status_perkara_id) == $sp->id ? 'selected' : ''); ?>>
                                <?php echo e($sp->nama); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['status_perkara_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                
                <?php if($simbakum->dokumens->isNotEmpty()): ?>
                <hr class="my-4">
                <h6 class="fw-semibold mb-3" style="font-size:.85rem;">
                    <i class="fa-solid fa-folder-open me-2 text-muted"></i>Dokumen Yang Sudah Ada
                </h6>
                <div class="table-responsive mb-3">
                    <table class="table table-sm table-bordered" style="font-size:.83rem;border-color:rgba(0,0,0,.07);">
                        <thead style="background:rgba(99,102,241,.06);">
                            <tr>
                                <th style="font-size:.7rem;color:#94a3b8;text-transform:uppercase;letter-spacing:.5px;">Nama Dokumen</th>
                                <th style="font-size:.7rem;color:#94a3b8;text-transform:uppercase;letter-spacing:.5px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="existingDokumensTable">
                            <?php $__currentLoopData = $simbakum->dokumens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dokumen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr id="dokumen-row-<?php echo e($dokumen->id); ?>">
                                <td>
                                    <i class="fa-solid fa-file-pdf text-danger me-2" style="font-size:.8rem;"></i>
                                    <?php echo e($dokumen->nama_dokumen); ?>

                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="<?php echo e($dokumen->url); ?>" target="_blank" class="btn btn-sm btn-outline-primary" style="font-size:.73rem;border-radius:7px;">
                                            <i class="fa-solid fa-download me-1"></i>Unduh
                                        </a>
                                        <button type="button"
                                            class="btn btn-sm btn-outline-danger btn-hapus-dokumen-existing"
                                            style="font-size:.73rem;border-radius:7px;"
                                            data-id="<?php echo e($dokumen->id); ?>"
                                            data-url="<?php echo e(route('simbakum.dokumen.destroy', $dokumen)); ?>">
                                            <i class="fa-solid fa-trash me-1"></i>Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <?php endif; ?>

                
                <hr class="my-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="mb-0 fw-semibold" style="font-size:.85rem;">
                        <i class="fa-solid fa-upload me-2 text-muted"></i>Upload Dokumen Baru <span class="text-muted fw-normal">(opsional, PDF)</span>
                    </h6>
                    <button type="button" id="btnTambahDokumenBaru" class="btn btn-sm btn-outline-primary" style="font-size:.78rem;border-radius:8px;">
                        <i class="fa-solid fa-plus me-1"></i>Tambah Dokumen
                    </button>
                </div>

                <div id="newDokumenContainer">
                    <div class="new-dokumen-row row g-2 mb-2 align-items-end">
                        <div class="col-md-5">
                            <label class="form-label" style="font-size:.78rem;color:#94a3b8;">Nama Dokumen</label>
                            <input type="text" name="new_nama_dokumen[]" class="form-control form-control-sm" placeholder="Contoh: Putusan Hakim">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-size:.78rem;color:#94a3b8;">File PDF</label>
                            <input type="file" name="new_file[]" class="form-control form-control-sm" accept=".pdf">
                        </div>
                        <div class="col-md-1 d-flex align-items-end pb-1">
                            <button type="button" class="btn btn-sm btn-outline-danger btn-hapus-new-dokumen" style="border-radius:8px;" title="Hapus baris">
                                <i class="fa-solid fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <?php $__errorArgs = ['new_file.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-danger mt-1" style="font-size:.8rem;"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                
                <div class="d-flex gap-2 justify-content-end mt-4 pt-3 border-top">
                    <a href="<?php echo e(route('simbakum.show', $simbakum)); ?>" class="btn btn-outline-secondary" style="border-radius:9px;font-size:.83rem;">
                        <i class="fa-solid fa-arrow-left me-1"></i>Batalkan
                    </a>
                    <button type="submit" class="btn btn-warning text-white" style="border-radius:9px;font-size:.83rem;">
                        <i class="fa-solid fa-save me-1"></i>Perbarui
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
    <script>
        // Add new document row
        document.getElementById('btnTambahDokumenBaru').addEventListener('click', function() {
            const container = document.getElementById('newDokumenContainer');
            const newRow = document.createElement('div');
            newRow.className = 'new-dokumen-row row g-2 mb-2 align-items-end';
            newRow.innerHTML = `
                <div class="col-md-5">
                    <label class="form-label" style="font-size:.78rem;color:#94a3b8;">Nama Dokumen</label>
                    <input type="text" name="new_nama_dokumen[]" class="form-control form-control-sm" placeholder="Contoh: Putusan Hakim">
                </div>
                <div class="col-md-6">
                    <label class="form-label" style="font-size:.78rem;color:#94a3b8;">File PDF</label>
                    <input type="file" name="new_file[]" class="form-control form-control-sm" accept=".pdf">
                </div>
                <div class="col-md-1 d-flex align-items-end pb-1">
                    <button type="button" class="btn btn-sm btn-outline-danger btn-hapus-new-dokumen" style="border-radius:8px;" title="Hapus baris">
                        <i class="fa-solid fa-times"></i>
                    </button>
                </div>
            `;
            container.appendChild(newRow);
            attachNewRemoveHandlers();
        });

        function attachNewRemoveHandlers() {
            document.querySelectorAll('.btn-hapus-new-dokumen').forEach(function(btn) {
                btn.onclick = function() {
                    const row = this.closest('.new-dokumen-row');
                    if (row) row.remove();
                };
            });
        }

        attachNewRemoveHandlers();

        // AJAX delete existing dokumen
        document.querySelectorAll('.btn-hapus-dokumen-existing').forEach(function(btn) {
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
                .catch(function(err) {
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
<?php /**PATH C:\xampp\htdocs\lbh\resources\views/simbakum/edit.blade.php ENDPATH**/ ?>