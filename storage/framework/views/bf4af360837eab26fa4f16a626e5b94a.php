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
     <?php $__env->slot('header', null, []); ?> Buat Laporan Pemberdayaan Masyarakat <?php $__env->endSlot(); ?>

    <div class="row justify-content-center">
        <div class="col-xl-9">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 fw-bold text-primary text-center fs-5 text-uppercase">Check List Berkas Reimbursement Non Litigasi</h6>
                </div>
                <div class="card-body p-4 p-md-5">
                    <form method="POST" action="<?php echo e(route('reimbursement-reports.store')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-bold">OBH</label>
                            <div class="col-sm-9">
                                <input type="text" name="obh" class="form-control border-secondary border-opacity-50" value="<?php echo e(old('obh')); ?>" required>
                                <?php $__errorArgs = ['obh'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger small"><?php echo e($message); ?></span><?php unset($message);
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
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger small"><?php echo e($message); ?></span><?php unset($message);
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
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger small"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <div class="row mb-3 align-items-center">
                            <label class="col-sm-4 col-form-label fw-bold py-0">KEGIATAN</label>
                            <div class="col-sm-8 text-primary fw-bold">
                                : &nbsp; PEMBERDAYAAN MASYARAKAT
                                <input type="hidden" name="kegiatan" value="Pemberdayaan Masyarakat">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label fw-bold py-0">TGL PELAKSANAAN KEGIATAN</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                : <input type="date" name="tgl_pelaksanaan" class="form-control ms-2 border-secondary border-opacity-50" value="<?php echo e(old('tgl_pelaksanaan')); ?>" style="max-width: 220px;" required>
                                <?php $__errorArgs = ['tgl_pelaksanaan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger small ms-3"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label fw-bold py-0">PENERIMA BANTUAN HUKUM</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                : <input type="text" name="penerima_bantuan" class="form-control ms-2 border-secondary border-opacity-50" value="<?php echo e(old('penerima_bantuan')); ?>" required>
                                <?php $__errorArgs = ['penerima_bantuan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger small ms-3"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label fw-bold py-0">TEMPAT PELAKSANAAN KEG.</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                : <input type="text" name="tempat_pelaksanaan" class="form-control ms-2 border-secondary border-opacity-50" value="<?php echo e(old('tempat_pelaksanaan')); ?>" required>
                                <?php $__errorArgs = ['tempat_pelaksanaan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger small ms-3"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label fw-bold py-0">MATERI</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                : <input type="text" name="materi" class="form-control ms-2 border-secondary border-opacity-50" value="<?php echo e(old('materi')); ?>" required>
                                <?php $__errorArgs = ['materi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger small ms-3"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <label class="col-sm-4 col-form-label fw-bold py-0">NARASUMBER</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                : <input type="text" name="narasumber" class="form-control ms-2 border-secondary border-opacity-50" value="<?php echo e(old('narasumber')); ?>" required>
                                <?php $__errorArgs = ['narasumber'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger small ms-3"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="table-responsive mb-4">
                            <table class="table table-bordered align-middle">
                                <thead>
                                    <tr class="text-center align-middle" style="background-color: var(--bs-secondary-bg) !important;">
                                        <th style="width: 50px;">NO</th>
                                        <th>BERKAS</th>
                                        <th style="width: 80px;">OBH</th>
                                        <th style="width: 80px;">KANWIL</th>
                                        <th style="width: 80px;">BPHN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $items = [
                                            'item1' => 'Formulir permohonan bantuan hukum',
                                            'item2' => 'SK Panitia',
                                            'item3' => 'Materi mengenai pengetahuan hukum',
                                            'item4' => 'Daftar Hadir Peserta',
                                            'item5' => 'Notula',
                                            'item6' => 'Dokumentasi kegiatan',
                                            'item7' => 'Laporan Kegiatan',
                                            'item8' => 'Kuitansi:'
                                        ];
                                        $subitems = [
                                            'item8_1' => 'Biaya Konsumsi',
                                            'item8_2' => 'Biaya jasa Profesi/Narasumber (diberi stempel OBH)',
                                            'item8_3' => 'Biaya Penggandaan dan Penjilidan Laporan Akhir',
                                            'item8_4' => 'Dokumentasi Kegiatan',
                                            'item8_5' => 'Pembuatan Spanduk/Banner'
                                        ];
                                    ?>

                                    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="text-center fw-bold"><?php echo e(substr($key, 4)); ?>.</td>
                                            <td class="fw-medium"><?php echo e($label); ?><input type="hidden" name="checklist_data[<?php echo e($key); ?>][label]" value="<?php echo e($label); ?>"></td>
                                            <?php if($key !== 'item8'): ?>
                                                <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[<?php echo e($key); ?>][obh]" value="1" <?php echo e(old('checklist_data.'.$key.'.obh') ? 'checked' : ''); ?>></td>
                                                <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[<?php echo e($key); ?>][kanwil]" value="1" <?php echo e(old('checklist_data.'.$key.'.kanwil') ? 'checked' : ''); ?>></td>
                                                <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[<?php echo e($key); ?>][bphn]" value="1" <?php echo e(old('checklist_data.'.$key.'.bphn') ? 'checked' : ''); ?>></td>
                                            <?php else: ?>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            <?php endif; ?>
                                        </tr>
                                        <?php if($key === 'item8'): ?>
                                            <?php $__currentLoopData = $subitems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subkey => $sublabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td></td>
                                                    <td class="ps-4 text-muted">- <?php echo e($sublabel); ?><input type="hidden" name="checklist_data[<?php echo e($subkey); ?>][label]" value="<?php echo e($sublabel); ?>"></td>
                                                    <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[<?php echo e($subkey); ?>][obh]" value="1" <?php echo e(old('checklist_data.'.$subkey.'.obh') ? 'checked' : ''); ?>></td>
                                                    <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[<?php echo e($subkey); ?>][kanwil]" value="1" <?php echo e(old('checklist_data.'.$subkey.'.kanwil') ? 'checked' : ''); ?>></td>
                                                    <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[<?php echo e($subkey); ?>][bphn]" value="1" <?php echo e(old('checklist_data.'.$subkey.'.bphn') ? 'checked' : ''); ?>></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="alert border small" style="background-color: var(--bs-secondary-bg);">
                            <strong>KETERANGAN:</strong><br>
                            - Jika <strong>ada</strong> beri tanda (&check;), <strong>tidak ada</strong> biarkan kosong.<br>
                            - Form ini harus dilampirkan di atas dokumen.<br>
                            - Berkas harus disusun berdasarkan urutan nomor.<br>
                            - Kartu BPJS tidak diperkenankan.<br>
                            - Formulir laporan pelaksanaan kegiatan pemberdayaan hukum bisa dilihat di Buku Panduan Implementasi Undang-Undang Nomor 16 Tahun 2011 Tentang Bantuan Hukum.<br>
                            - Kuitansi konsumsi dan penggandaan harus diberi materai (>Rp. 250rb diberi materai 3000), dan dibubuhi stempel Rumah Makan dan usaha fotokopi ybs.
                        </div>

                        <div class="d-flex justify-content-end align-items-center pt-3 border-top">
                            <a href="<?php echo e(route('pemberdayaan-masyarakat.index')); ?>" class="btn btn-light border me-2 fw-medium">Batal</a>
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
<?php /**PATH C:\xampp\htdocs\lbh\resources\views/reimbursement_reports/create_pemberdayaan.blade.php ENDPATH**/ ?>