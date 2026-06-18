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
     <?php $__env->slot('header', null, []); ?> Buat Laporan Pendampingan Diluar Pengadilan <?php $__env->endSlot(); ?>

    <div class="row justify-content-center">
        <div class="col-xl-9">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 fw-bold text-primary text-center fs-5 text-uppercase">Check List Berkas Reimbursement Non Litigasi</h6>
                </div>
                <div class="card-body p-4 p-md-5">
                    <form action="<?php echo e(route('pendampingan-reports.store')); ?>" method="POST">
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

                        <div class="row mb-3 align-items-center">
                            <label class="col-sm-4 col-form-label fw-bold py-0">KEGIATAN</label>
                            <div class="col-sm-8 text-primary fw-bold">: &nbsp; PENDAMPINGAN DILUAR PENGADILAN</div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label fw-bold py-0">KASUS</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                : <input type="text" name="kasus" class="form-control ms-2 border-secondary border-opacity-50" value="<?php echo e(old('kasus')); ?>" required>
                                <?php $__errorArgs = ['kasus'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger small ms-2"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label fw-bold py-0">TGL PELAKSANAAN KEGIATAN</label>
                            <div class="col-sm-8 ps-3">
                                <?php $__currentLoopData = ['A' => '1', 'B' => '2', 'C' => '3', 'D' => '4']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $letter => $num): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="d-flex align-items-center mb-2">
                                    <span class="me-2 fw-semibold" style="width:20px;"><?php echo e($letter); ?>.</span>
                                    <span class="me-2 text-muted">Pendampingan <?php echo e(['A'=>'I','B'=>'II','C'=>'III','D'=>'IV'][$letter]); ?>: tanggal</span>
                                    <input type="date" name="tgl_pendampingan_<?php echo e($num); ?>" class="form-control border-secondary border-opacity-50" style="max-width:200px;" value="<?php echo e(old('tgl_pendampingan_'.$num)); ?>">
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php $__errorArgs = ['tgl_pendampingan_1'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger small"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <label class="col-sm-4 col-form-label fw-bold py-0">PENERIMA BANTUAN HUKUM</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                : <input type="text" name="penerima_bantuan" class="form-control mx-2 border-secondary border-opacity-50" value="<?php echo e(old('penerima_bantuan')); ?>" required>
                                <select name="jk_penerima" class="form-select w-auto border-secondary border-opacity-50" required>
                                    <option value="">L/P</option>
                                    <option value="L" <?php echo e(old('jk_penerima') == 'L' ? 'selected' : ''); ?>>L</option>
                                    <option value="P" <?php echo e(old('jk_penerima') == 'P' ? 'selected' : ''); ?>>P</option>
                                </select>
                                <?php $__errorArgs = ['penerima_bantuan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger small ms-2"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="table-responsive mb-4">
                            <table class="table table-bordered align-middle">
                                <thead>
                                    <tr class="text-center align-middle" style="background-color: var(--bs-secondary-bg) !important;">
                                        <th style="width:50px;">NO</th>
                                        <th>BERKAS</th>
                                        <th style="width:80px;">OBH</th>
                                        <th style="width:80px;">KANWIL</th>
                                        <th style="width:80px;">BPHN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $items = [
                                            'item1' => 'Surat permohonan bantuan hukum',
                                            'item2' => 'SKTM Asli/ Legalisir Kartu JAMKESMAS/Kartu GAKIN/BLSM, dll.',
                                            'item3' => 'Berita Acara Pendampingan di luar pengadilan (ditandatangani oleh Penerima dan Pemberi Bantuan Hukum):',
                                            'item4' => 'Laporan Pendampingan',
                                            'item5' => 'Kuitansi:',
                                        ];
                                        $item3_sub = ['item3_a' => 'Pendampingan I', 'item3_b' => 'Pendampingan II', 'item3_c' => 'Pendampingan III', 'item3_d' => 'Pendampingan IV'];
                                        $item5_sub = ['item5_1' => 'Pendampingan terhadap saksi dan/atau korban tindak pidana', 'item5_2' => 'Biaya penggandaan dan penjilidan laporan akhir'];
                                        $letters = ['item3_a'=>'A','item3_b'=>'B','item3_c'=>'C','item3_d'=>'D'];
                                    ?>

                                    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="text-center fw-bold"><?php echo e(substr($key, 4)); ?>.</td>
                                        <td class="fw-medium"><?php echo e($label); ?>

                                            <input type="hidden" name="checklist_data[<?php echo e($key); ?>][label]" value="<?php echo e($label); ?>">
                                        </td>
                                        <?php if(!in_array($key, ['item3','item5'])): ?>
                                            <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[<?php echo e($key); ?>][obh]" value="1" <?php echo e(old('checklist_data.'.$key.'.obh') ? 'checked' : ''); ?>></td>
                                            <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[<?php echo e($key); ?>][kanwil]" value="1" <?php echo e(old('checklist_data.'.$key.'.kanwil') ? 'checked' : ''); ?>></td>
                                            <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[<?php echo e($key); ?>][bphn]" value="1" <?php echo e(old('checklist_data.'.$key.'.bphn') ? 'checked' : ''); ?>></td>
                                        <?php else: ?>
                                            <td></td><td></td><td></td>
                                        <?php endif; ?>
                                    </tr>
                                    <?php if($key === 'item3'): ?>
                                        <?php $__currentLoopData = $item3_sub; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subkey => $sublabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td></td>
                                            <td class="ps-4 text-muted"><?php echo e($letters[$subkey]); ?>. &nbsp; <?php echo e($sublabel); ?>

                                                <input type="hidden" name="checklist_data[<?php echo e($subkey); ?>][label]" value="<?php echo e($sublabel); ?>">
                                            </td>
                                            <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[<?php echo e($subkey); ?>][obh]" value="1" <?php echo e(old('checklist_data.'.$subkey.'.obh') ? 'checked' : ''); ?>></td>
                                            <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[<?php echo e($subkey); ?>][kanwil]" value="1" <?php echo e(old('checklist_data.'.$subkey.'.kanwil') ? 'checked' : ''); ?>></td>
                                            <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[<?php echo e($subkey); ?>][bphn]" value="1" <?php echo e(old('checklist_data.'.$subkey.'.bphn') ? 'checked' : ''); ?>></td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                    <?php if($key === 'item5'): ?>
                                        <?php $__currentLoopData = $item5_sub; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subkey => $sublabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td></td>
                                            <td class="ps-4 text-muted">- <?php echo e($sublabel); ?>

                                                <input type="hidden" name="checklist_data[<?php echo e($subkey); ?>][label]" value="<?php echo e($sublabel); ?>">
                                            </td>
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
                            - Form ini harus dilampirkan diatas dokumen.<br>
                            - Berkas harus disusun berdasarkan urutan nomor.<br>
                            - Pendampingan di luar pengadilan dilakukan paling sedikit empat kali untuk waktu paling lama dua bulan.<br>
                            - Setiap kegiatan pendampingan di luar Pengadilan dibuat berita acara yang ditandatangani oleh Penerima dan Pemberi Bantuan Hukum.<br>
                            - Berkas harus ASLI dan di <em>fotocopy</em>.<br>
                            - Kartu BPJS tidak diperkenankan.
                        </div>

                        <div class="d-flex justify-content-end align-items-center pt-3 border-top">
                            <a href="<?php echo e(route('pendampingan-reports.index')); ?>" class="btn btn-light border me-2 fw-medium">Batal</a>
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
<?php /**PATH C:\xampp\htdocs\lbh\resources\views/pendampingan_reports/create.blade.php ENDPATH**/ ?>