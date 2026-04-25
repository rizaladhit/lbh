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
     <?php $__env->slot('header', null, []); ?> 
        Buat Laporan Mediasi
     <?php $__env->endSlot(); ?>

    <div class="row justify-content-center">
        <div class="col-xl-9">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header py-3 bg-white border-bottom">
                    <h6 class="m-0 fw-bold text-primary text-center fs-5 text-uppercase">Check List Berkas Reimbursement Non Litigasi (Mediasi)</h6>
                </div>
                <div class="card-body p-4 p-md-5">
                    <form method="POST" action="<?php echo e(route('mediasi-reports.store')); ?>">
                        <?php echo csrf_field(); ?>

                        <!-- Top Header fields -->
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-bold">OBH</label>
                            <div class="col-sm-9">
                                <input type="text" name="obh" class="form-control border-secondary border-opacity-50" value="<?php echo e(old('obh')); ?>" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-bold">ALAMAT</label>
                            <div class="col-sm-9">
                                <input type="text" name="alamat" class="form-control border-secondary border-opacity-50" value="<?php echo e(old('alamat')); ?>" required>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label fw-bold">PROVINSI</label>
                            <div class="col-sm-9">
                                <input type="text" name="provinsi" class="form-control border-secondary border-opacity-50" value="<?php echo e(old('provinsi')); ?>" required>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <!-- Main Form details -->
                        <div class="row mb-3 align-items-center">
                            <label class="col-sm-4 col-form-label fw-bold py-0">KEGIATAN</label>
                            <div class="col-sm-8 text-primary fw-bold">
                                : &nbsp; MEDIASI
                                <input type="hidden" name="kegiatan" value="MEDIASI">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label fw-bold py-0">TGL PELAKSANAAN KEGIATAN</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                : <input type="date" name="tgl_pelaksanaan" class="form-control ms-2 border-secondary border-opacity-50" style="max-width: 200px;" value="<?php echo e(old('tgl_pelaksanaan')); ?>" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label fw-bold py-0">KASUS</label>
                            <div class="col-sm-8 d-flex">
                                : <input type="text" name="kasus" class="form-control ms-2 border-secondary border-opacity-50" value="<?php echo e(old('kasus')); ?>" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label fw-bold py-0">PENERIMA BANTUAN HUKUM</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                : <input type="text" name="penerima_bantuan" class="form-control mx-2 border-secondary border-opacity-50" value="<?php echo e(old('penerima_bantuan')); ?>" required>
                                <select name="jk_penerima" class="form-select w-auto border-secondary border-opacity-50" required>
                                    <option value="L" <?php echo e(old('jk_penerima') == 'L' ? 'selected' : ''); ?>>L</option>
                                    <option value="P" <?php echo e(old('jk_penerima') == 'P' ? 'selected' : ''); ?>>P</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label class="col-sm-4 col-form-label fw-bold py-0">NAMA MEDIATOR</label>
                            <div class="col-sm-8 d-flex">
                                : <input type="text" name="nama_mediator" class="form-control ms-2 border-secondary border-opacity-50" value="<?php echo e(old('nama_mediator')); ?>" required>
                            </div>
                        </div>

                        <!-- Checklists Table -->
                        <div class="table-responsive mb-4">
                            <table class="table table-bordered align-middle">
                                <thead class="table-light">
                                    <tr class="text-center align-middle">
                                        <th style="width: 50px;">NO</th>
                                        <th>BERKAS</th>
                                        <th style="width: 80px;">OBH</th>
                                        <th style="width: 80px;">KANWIL</th>
                                        <th style="width: 80px;">BPHN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $berkas_list = [
                                            'item1' => 'Formulir permohonan bantuan hukum',
                                            'item2' => 'SKTM Asli/ Legalisir Kartu JAMKESMAS/Kartu GAKIN/BLSM, dll.',
                                            'item3' => 'Berita acara mediasi (ditandantangani para pihak)',
                                            'item4' => 'Laporan mediasi',
                                            'item5_parent' => 'Kuitansi:'
                                        ];
                                    ?>
                                    <?php $__currentLoopData = $berkas_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="text-center fw-bold"><?php echo e($key == 'item5_parent' ? '5.' : $loop->iteration . '.'); ?></td>
                                        <td class="fw-medium"><?php echo e($label); ?></td>
                                        <?php if($key != 'item5_parent'): ?>
                                        <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[<?php echo e($key); ?>][obh]" value="1"></td>
                                        <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[<?php echo e($key); ?>][kanwil]" value="1"></td>
                                        <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[<?php echo e($key); ?>][bphn]" value="1"></td>
                                        <?php else: ?>
                                        <td></td><td></td><td></td>
                                        <?php endif; ?>
                                    </tr>
                                    <?php if($key == 'item5_parent'): ?>
                                    <tr>
                                        <td></td>
                                        <td class="ps-4 text-muted">- Biaya Mediator (diberi stempel OBH)</td>
                                        <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[item5][obh]" value="1"></td>
                                        <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[item5][kanwil]" value="1"></td>
                                        <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[item5][bphn]" value="1"></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td class="ps-4 text-muted">- Biaya penggandaan dan penjilidan laporan akhir</td>
                                        <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[item6][obh]" value="1"></td>
                                        <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[item6][kanwil]" value="1"></td>
                                        <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[item6][bphn]" value="1"></td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="alert border small bg-light">
                            <strong>KETERANGAN :</strong><br>
                            <ul class="mb-0 ps-3">
                                <li>Jika <b>ada</b> beri tanda centang, <b>tidak ada</b> biarkan kosong.</li>
                                <li>Form ini harus dilampirkan diatas dokumen</li>
                                <li>Berkas harus disusun berdasarkan urutan nomor</li>
                                <li>Mediasi diajukan per-paket 1 kasus</li>
                                <li>Berkas harus ASLI dan di <i>fotocopy</i></li>
                                <li>Pemegang Kartu BPJS tidak diperkenankan</li>
                                <li>Form mediasi bisa dilihat di Buku Panduan Implementasi Undang-Undang Nomor 16 Tahun 2011 Tentang Bantuan Hukum</li>
                                <li>Kuitansi biaya penggandaan harus dibubuhi stempel usaha fotokopi ybs. dan melampirkan bon berkop dari usaha ybs.</li>
                            </ul>
                        </div>

                        <div class="d-flex justify-content-end align-items-center pt-3 border-top">
                            <a href="<?php echo e(route('mediasi-reports.index')); ?>" class="btn btn-light border me-2 fw-medium">Batal</a>
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
<?php /**PATH C:\xampp\htdocs\lbh\resources\views/mediasi_reports/create.blade.php ENDPATH**/ ?>