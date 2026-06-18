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
     <?php $__env->slot('header', null, []); ?> Buat Laporan Investigasi Kasus <?php $__env->endSlot(); ?>

    <div class="row justify-content-center">
        <div class="col-xl-10">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 fw-bold text-primary text-center fs-5 text-uppercase">Check List Berkas Reimbursement Non Litigasi</h6>
                </div>
                <div class="card-body p-4 p-md-5">
                    <form action="<?php echo e(route('investigasi-kasus-reports.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-bold">OBH</label>
                            <div class="col-sm-9">
                                <input type="text" name="obh" class="form-control border-secondary border-opacity-50" value="<?php echo e(old('obh')); ?>" required>
                                <?php $__errorArgs = ['obh'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger small"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-bold">ALAMAT</label>
                            <div class="col-sm-9">
                                <input type="text" name="alamat" class="form-control border-secondary border-opacity-50" value="<?php echo e(old('alamat')); ?>" required>
                                <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger small"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label fw-bold">PROVINSI</label>
                            <div class="col-sm-9">
                                <input type="text" name="provinsi" class="form-control border-secondary border-opacity-50" value="<?php echo e(old('provinsi')); ?>" required>
                                <?php $__errorArgs = ['provinsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger small"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <div class="row mb-4 align-items-center">
                            <label class="col-sm-3 col-form-label fw-bold">KEGIATAN</label>
                            <div class="col-sm-9 text-primary fw-bold">: &nbsp; INVESTIGASI KASUS</div>
                        </div>

                        <?php
                            $sub_items = [
                                0 => ['item4_1' => 'Biaya Investigator (diberi stempel OBH)'],
                                1 => ['item4_1' => 'Biaya Investigator (diberi stempel OBH)'],
                                2 => ['item4_1' => 'Biaya Investigator (diberi stempel OBH)'],
                                3 => ['item4_1' => 'Biaya Investigator'],
                                4 => ['item4_1' => 'Biaya Investigator (diberi stempel OBH)', 'item4_2' => 'Biaya Penggandaan laporan Akhir'],
                            ];
                        ?>

                        <?php for($i = 0; $i < 5; $i++): ?>
                        <div class="border rounded p-4 mb-4" style="background: var(--bs-secondary-bg);">
                            <h6 class="fw-bold text-uppercase mb-3 text-primary">Investigasi <?php echo e($i + 1); ?></h6>

                            <div class="row mb-2">
                                <label class="col-sm-5 col-form-label fw-bold py-0" style="font-size:.9rem;">JENIS KEGIATAN INVESTIGASI</label>
                                <div class="col-sm-7 d-flex align-items-center">
                                    : <input type="text" name="sections[<?php echo e($i); ?>][jenis_investigasi]" class="form-control ms-2 border-secondary border-opacity-50" value="<?php echo e(old('sections.'.$i.'.jenis_investigasi')); ?>">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label class="col-sm-5 col-form-label fw-bold py-0" style="font-size:.9rem;">TGL PELAKSANAAN KEGIATAN</label>
                                <div class="col-sm-7 d-flex align-items-center">
                                    : <input type="date" name="sections[<?php echo e($i); ?>][tgl_pelaksanaan]" class="form-control ms-2 border-secondary border-opacity-50" value="<?php echo e(old('sections.'.$i.'.tgl_pelaksanaan')); ?>">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label class="col-sm-5 col-form-label fw-bold py-0" style="font-size:.9rem;">PENERIMA BANTUAN HUKUM</label>
                                <div class="col-sm-7 d-flex align-items-center">
                                    : <input type="text" name="sections[<?php echo e($i); ?>][penerima_bantuan]" class="form-control mx-2 border-secondary border-opacity-50" value="<?php echo e(old('sections.'.$i.'.penerima_bantuan')); ?>">
                                    <select name="sections[<?php echo e($i); ?>][jk_penerima]" class="form-select w-auto border-secondary border-opacity-50">
                                        <option value="">L/P</option>
                                        <option value="L" <?php echo e(old('sections.'.$i.'.jk_penerima') == 'L' ? 'selected' : ''); ?>>L</option>
                                        <option value="P" <?php echo e(old('sections.'.$i.'.jk_penerima') == 'P' ? 'selected' : ''); ?>>P</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-5 col-form-label fw-bold py-0" style="font-size:.9rem;">NAMA INVESTIGATOR</label>
                                <div class="col-sm-7 d-flex align-items-center">
                                    : <input type="text" name="sections[<?php echo e($i); ?>][nama_investigator]" class="form-control ms-2 border-secondary border-opacity-50" value="<?php echo e(old('sections.'.$i.'.nama_investigator')); ?>">
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered align-middle mb-0">
                                    <thead>
                                        <tr class="text-center align-middle" style="background-color: var(--bs-tertiary-bg) !important;">
                                            <th style="width:50px;">NO</th>
                                            <th>BERKAS</th>
                                            <th style="width:80px;">OBH</th>
                                            <th style="width:80px;">KANWIL</th>
                                            <th style="width:80px;">BPHN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center fw-bold">1.</td>
                                            <td class="fw-medium">SKTM Asli/ Legalisir Kartu JAMKESMAS/Kartu GAKIN/BLSM, dll.</td>
                                            <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="sections[<?php echo e($i); ?>][checklist][item1][obh]" value="1" <?php echo e(old('sections.'.$i.'.checklist.item1.obh') ? 'checked' : ''); ?>></td>
                                            <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="sections[<?php echo e($i); ?>][checklist][item1][kanwil]" value="1" <?php echo e(old('sections.'.$i.'.checklist.item1.kanwil') ? 'checked' : ''); ?>></td>
                                            <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="sections[<?php echo e($i); ?>][checklist][item1][bphn]" value="1" <?php echo e(old('sections.'.$i.'.checklist.item1.bphn') ? 'checked' : ''); ?>></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center fw-bold">2.</td>
                                            <td class="fw-medium">Formulir investigasi kasus yang sudah diisi lengkap</td>
                                            <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="sections[<?php echo e($i); ?>][checklist][item2][obh]" value="1" <?php echo e(old('sections.'.$i.'.checklist.item2.obh') ? 'checked' : ''); ?>></td>
                                            <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="sections[<?php echo e($i); ?>][checklist][item2][kanwil]" value="1" <?php echo e(old('sections.'.$i.'.checklist.item2.kanwil') ? 'checked' : ''); ?>></td>
                                            <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="sections[<?php echo e($i); ?>][checklist][item2][bphn]" value="1" <?php echo e(old('sections.'.$i.'.checklist.item2.bphn') ? 'checked' : ''); ?>></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center fw-bold">3.</td>
                                            <td class="fw-medium">Laporan hasil investigasi kasus</td>
                                            <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="sections[<?php echo e($i); ?>][checklist][item3][obh]" value="1" <?php echo e(old('sections.'.$i.'.checklist.item3.obh') ? 'checked' : ''); ?>></td>
                                            <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="sections[<?php echo e($i); ?>][checklist][item3][kanwil]" value="1" <?php echo e(old('sections.'.$i.'.checklist.item3.kanwil') ? 'checked' : ''); ?>></td>
                                            <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="sections[<?php echo e($i); ?>][checklist][item3][bphn]" value="1" <?php echo e(old('sections.'.$i.'.checklist.item3.bphn') ? 'checked' : ''); ?>></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center fw-bold">4.</td>
                                            <td class="fw-medium">Kuitansi:</td>
                                            <td></td><td></td><td></td>
                                        </tr>
                                        <?php $__currentLoopData = $sub_items[$i]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sk => $slabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td></td>
                                            <td class="ps-4 text-muted fw-medium">- <?php echo e($slabel); ?></td>
                                            <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="sections[<?php echo e($i); ?>][checklist][<?php echo e($sk); ?>][obh]" value="1" <?php echo e(old('sections.'.$i.'.checklist.'.$sk.'.obh') ? 'checked' : ''); ?>></td>
                                            <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="sections[<?php echo e($i); ?>][checklist][<?php echo e($sk); ?>][kanwil]" value="1" <?php echo e(old('sections.'.$i.'.checklist.'.$sk.'.kanwil') ? 'checked' : ''); ?>></td>
                                            <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="sections[<?php echo e($i); ?>][checklist][<?php echo e($sk); ?>][bphn]" value="1" <?php echo e(old('sections.'.$i.'.checklist.'.$sk.'.bphn') ? 'checked' : ''); ?>></td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php endfor; ?>

                        <div class="alert border small" style="background-color: var(--bs-secondary-bg);">
                            <strong>KETERANGAN:</strong><br>
                            - Jika <strong>ada</strong> beri tanda (&check;), <strong>tidak ada</strong> beri tanda (&cross;).<br>
                            - Form ini harus dilampirkan diatas dokumen.<br>
                            - Berkas harus disusun berdasarkan urutan nomor.<br>
                            - Investigasi diajukan per-paket 5 kasus.<br>
                            - Berkas harus <strong>ASLI</strong> dan di <em>fotocopy</em>.<br>
                            - Kartu BPJS tidak diperkenankan.<br>
                            - Form investigasi bisa dilihat di Buku Panduan Implementasi Undang-Undang Nomor 16 Tahun 2011 Tentang Bantuan Hukum.<br>
                            - Kuitansi biaya penggandaan harus dibubuhi stempel usaha fotokopi ybs. dan melampirkan bon berkop dari usaha ybs.
                        </div>

                        <div class="d-flex justify-content-end align-items-center pt-3 border-top">
                            <a href="<?php echo e(route('investigasi-kasus-reports.index')); ?>" class="btn btn-light border me-2 fw-medium">Batal</a>
                            <button type="submit" class="btn btn-primary fw-bold px-4 shadow-sm"><i class="fa-solid fa-save me-1"></i> Simpan Laporan</button>
                        </div>
                    </form>
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
<?php /**PATH C:\xampp\htdocs\lbh\resources\views/investigasi_kasus_reports/create.blade.php ENDPATH**/ ?>