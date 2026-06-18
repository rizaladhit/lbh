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
     <?php $__env->slot('header', null, []); ?> Buat Laporan Reimbursement <?php $__env->endSlot(); ?>

    <div class="row justify-content-center">
        <div class="col-xl-10">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header py-3 bg-primary">
                    <h6 class="m-0 fw-bold text-white">
                        <i class="fa-solid fa-file-pen me-2"></i>Check List Berkas Reimbursement
                    </h6>
                </div>
                <div class="card-body p-4 p-md-5">
                    <form method="POST" action="<?php echo e(route('reimbursement-reports.store')); ?>">
                        <?php echo csrf_field(); ?>

                        <!-- Pilih Tipe Kegiatan -->
                        <div class="alert alert-info mb-4">
                            <i class="fa-solid fa-circle-info me-2"></i>
                            <strong>Pilih Jenis Kegiatan:</strong>
                            <div class="mt-2">
                                <?php $__currentLoopData = \App\Models\ReimbursementReport::KEGIATAN_TYPES; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="kegiatan" id="kegiatan_<?php echo e($loop->index); ?>" value="<?php echo e($type); ?>" 
                                        <?php echo e($type === $kegiatan_type ? 'checked' : ''); ?> required onchange="updateForm(this.value)">
                                    <label class="form-check-label" for="kegiatan_<?php echo e($loop->index); ?>">
                                        <?php echo e($type); ?>

                                    </label>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <!-- Top Header fields -->
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

                        <!-- Dynamic Fields -->
                        <div id="dynamic-fields">
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label fw-bold">TGL PELAKSANAAN</label>
                                <div class="col-sm-9">
                                    <input type="date" name="tgl_pelaksanaan" class="form-control border-secondary border-opacity-50" value="<?php echo e(old('tgl_pelaksanaan')); ?>" required>
                                    <?php $__errorArgs = ['tgl_pelaksanaan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger small"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <div class="row mb-3" id="field-penerima">
                                <label class="col-sm-3 col-form-label fw-bold">PENERIMA BANTUAN</label>
                                <div class="col-sm-9">
                                    <input type="text" name="penerima_bantuan" class="form-control border-secondary border-opacity-50" value="<?php echo e(old('penerima_bantuan')); ?>">
                                    <?php $__errorArgs = ['penerima_bantuan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger small"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <div class="row mb-3" id="field-tempat" style="display:none;">
                                <label class="col-sm-3 col-form-label fw-bold">TEMPAT PELAKSANAAN</label>
                                <div class="col-sm-9">
                                    <input type="text" name="tempat_pelaksanaan" class="form-control border-secondary border-opacity-50" value="<?php echo e(old('tempat_pelaksanaan')); ?>">
                                </div>
                            </div>

                            <div class="row mb-3" id="field-materi" style="display:none;">
                                <label class="col-sm-3 col-form-label fw-bold">MATERI</label>
                                <div class="col-sm-9">
                                    <input type="text" name="materi" class="form-control border-secondary border-opacity-50" value="<?php echo e(old('materi')); ?>">
                                </div>
                            </div>

                            <div class="row mb-3" id="field-narasumber" style="display:none;">
                                <label class="col-sm-3 col-form-label fw-bold">NARASUMBER</label>
                                <div class="col-sm-9">
                                    <input type="text" name="narasumber" class="form-control border-secondary border-opacity-50" value="<?php echo e(old('narasumber')); ?>">
                                </div>
                            </div>

                            <div class="row mb-3" id="field-kasus" style="display:none;">
                                <label class="col-sm-3 col-form-label fw-bold">KASUS</label>
                                <div class="col-sm-9">
                                    <input type="text" name="kasus" class="form-control border-secondary border-opacity-50" value="<?php echo e(old('kasus')); ?>">
                                </div>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <!-- Checklist Items -->
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">BERKAS / DOKUMEN</h6>
                            <div id="checklist-container">
                                <p class="text-muted">Pilih jenis kegiatan terlebih dahulu</p>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <!-- Buttons -->
                        <div class="d-grid gap-2 d-sm-flex justify-content-sm-end">
                            <a href="<?php echo e(route('reimbursement-reports.index')); ?>" class="btn btn-secondary px-4">Batal</a>
                            <button type="submit" class="btn btn-primary px-5 fw-bold">
                                <i class="fa-solid fa-save me-2"></i>Simpan Laporan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const checklistTemplates = {
            'Penelitian Hukum': [
                'SK Panitia Penelitian',
                'Proposal Penelitian Hukum',
                'Pembuatan Instrumen',
                'Penelitian Lapangan',
                'Pengolahan Data',
                'Laporan Sementara',
                'Pertemuan ilmiah/FGD',
                'Laporan Akhir hasil penelitian hukum',
                'Kuitansi - Pembuatan Proposal',
                'Kuitansi - Pembuatan Instrumen',
                'Kuitansi - Penelitian Lapangan',
                'Kuitansi - Tabulasi/Pengolahan Data',
                'Kuitansi - Pembuatan Laporan Sementara',
                'Kuitansi - Pertemuan ilmiah/FGD',
                'Kuitansi - Penggandaan dan Penjilidan akhir'
            ],
            'Penyuluhan Hukum': [
                'Surat Permohonan Penyuluhan Hukum',
                'SK Panitia',
                'Daftar Hadir (Peserta dan Narasumber)',
                'Materi Penyuluhan',
                'Notula',
                'Laporan',
                'Dokumentasi kegiatan',
                'Kuitansi - Konsumsi',
                'Kuitansi - Jasa Profesi/Narasumber',
                'Kuitansi - Penggandaan dan Penjilidan laporan akhir',
                'Kuitansi - Dokumentasi kegiatan',
                'Kuitansi - Pembuatan Spanduk/Banner Kegiatan'
            ],
            'Investigasi Kasus': [
                'SKTM Asli/ Legalisir Kartu JAMKESMAS/Kartu GAKIN/BLSM',
                'Formulir investigasi kasus yang sudah diisi lengkap',
                'Laporan hasil investigasi kasus',
                'Kuitansi - Biaya Investigator',
                'Kuitansi - Biaya Penggandaan laporan Akhir'
            ],
            'Konsultasi Hukum': [
                'SKTM Asli/ Legalisir Kartu JAMKESMAS/Kartu GAKIN/BLSM',
                'Formulir Konsultasi yang sudah diisi lengkap',
                'Laporan hasil konsultasi',
                'Kuitansi Biaya Konsultan'
            ],
            'Mediasi': [
                'Formulir permohonan bantuan hukum',
                'SKTM Asli/ Legalisir Kartu JAMKESMAS/Kartu GAKIN/BLSM',
                'Berita acara mediasi (ditandantangani para pihak)',
                'Laporan mediasi',
                'Kuitansi - Biaya Mediator',
                'Kuitansi - Biaya penggandaan dan penjilidan laporan akhir'
            ],
            'Negosiasi': [
                'Formulir permohonan bantuan hukum',
                'SKTM Asli/ Legalisir Kartu JAMKESMAS/Kartu GAKIN/BLSM',
                'Berita acara Negosiasi',
                'Laporan Pelaksanaan Negosiasi',
                'Kuitansi - Biaya Negosiator',
                'Kuitansi - Biaya Penggandaan dan Penjilidan Laporan Akhir'
            ],
            'Pemberdayaan Masyarakat': [
                'Formulir permohonan bantuan hukum',
                'SK Panitia',
                'Materi mengenai pengetahuan hukum',
                'Daftar Hadir Peserta',
                'Notula',
                'Dokumentasi kegiatan',
                'Laporan Kegiatan',
                'Kuitansi - Biaya Konsumsi',
                'Kuitansi - Biaya jasa Profesi/Narasumber',
                'Kuitansi - Biaya Penggandaan dan Penjilidan Laporan Akhir',
                'Kuitansi - Dokumentasi Kegiatan',
                'Kuitansi - Pembuatan Spanduk/Banner'
            ],
            'Pendampingan Diluar Pengadilan': [
                'Surat permohonan bantuan hukum',
                'SKTM Asli/ Legalisir Kartu JAMKESMAS/Kartu GAKIN/BLSM',
                'Berita Acara Pendampingan I',
                'Berita Acara Pendampingan II',
                'Berita Acara Pendampingan III',
                'Berita Acara Pendampingan IV',
                'Laporan Pendampingan',
                'Kuitansi - Pendampingan terhadap saksi dan/atau korban tindak pidana',
                'Kuitansi - Biaya penggandaan dan penjilidan laporan akhir'
            ],
            'Litigasi Perdata': [
                'Surat Permohonan Bantuan Hukum',
                'Surat Kuasa',
                'SKTM Asli/ Legalisir Kartu JAMKESMAS/Kartu GAKIN/BLSM',
                'Relaas/Bukti Persidangan',
                'Pendapat hukum (legal opinion)',
                'Somasi',
                'Gugatan atau jawaban',
                'Tawaran mediasi atau jawaban',
                'Replik',
                'Putusan',
                'Memori banding atau kontra memori banding',
                'Memori kasasi atau kontra memori kasasi',
                'Memori peninjauan kembali',
                'Dokumen lain yang berkenaan dengan perkara',
                'Kuitansi'
            ],
            'Litigasi Pidana': [
                'Surat Permohonan Bantuan Hukum / Surat Penunjukan dari Hakim',
                'Surat Kuasa',
                'SKTM Asli/ Legalisir Kartu JAMKESMAS/Kartu GAKIN/BLSM',
                'Bukti dan saksi pendukung',
                'Pendapat hukum (legal opinion)',
                'Eksepsi atau keberatan',
                'Surat dakwaan',
                'Surat tuntutan',
                'Pledoi atau pembelaan',
                'Replik',
                'Duplik',
                'Putusan',
                'Memori banding atau kontra memori banding',
                'Memori kasasi atau kontra memori kasasi',
                'Memori peninjauan kembali',
                'Dokumen lain yang berkenaan dengan perkara',
                'Kuitansi'
            ],
            'Litigasi TUN': [
                'Surat Permohonan Bantuan Hukum',
                'Surat Kuasa',
                'SKTM Asli/ Legalisir Kartu JAMKESMAS/Kartu GAKIN/BLSM',
                'Pendapat hukum (legal opinion)',
                'Somasi',
                'Gugatan atau jawaban gugatan',
                'Eksepsi atau replik',
                'Putusan',
                'Memori banding atau kontra memori banding',
                'Memori kasasi atau kontra memori kasasi',
                'Memori peninjauan kembali',
                'Dokumen lain yang berkenaan dengan perkara',
                'Kuitansi'
            ]
        };

        function updateForm(kegiatan) {
            const visibleFields = {
                'Penelitian Hukum': ['penerima'],
                'Penyuluhan Hukum': ['tempat', 'materi', 'narasumber', 'penerima'],
                'Investigasi Kasus': ['penerima'],
                'Konsultasi Hukum': ['penerima'],
                'Mediasi': ['kasus', 'penerima'],
                'Negosiasi': ['kasus', 'penerima'],
                'Pemberdayaan Masyarakat': ['tempat', 'materi', 'narasumber', 'penerima'],
                'Pendampingan Diluar Pengadilan': ['kasus', 'penerima'],
                'Litigasi Perdata': ['kasus', 'penerima'],
                'Litigasi Pidana': ['kasus', 'penerima'],
                'Litigasi TUN': ['kasus', 'penerima']
            };

            // Hide all fields first
            document.getElementById('field-tempat').style.display = 'none';
            document.getElementById('field-materi').style.display = 'none';
            document.getElementById('field-narasumber').style.display = 'none';
            document.getElementById('field-kasus').style.display = 'none';
            document.getElementById('field-penerima').style.display = 'none';

            // Show required fields
            const fields = visibleFields[kegiatan] || [];
            fields.forEach(field => {
                document.getElementById('field-' + field).style.display = 'flex';
            });

            // Update checklist
            updateChecklist(kegiatan);
        }

        function updateChecklist(kegiatan) {
            const container = document.getElementById('checklist-container');
            const items = checklistTemplates[kegiatan] || [];

            if (items.length === 0) {
                container.innerHTML = '<p class="text-muted">Tidak ada checklist untuk kegiatan ini</p>';
                return;
            }

            let html = '<div class="row">';
            items.forEach((item, index) => {
                html += `
                    <div class="col-md-6 mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="checklist_items[${index}]" 
                                   id="checklist_${index}" value="${item}">
                            <label class="form-check-label" for="checklist_${index}">
                                ${item}
                            </label>
                        </div>
                    </div>
                `;
            });
            html += '</div>';
            container.innerHTML = html;
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            const selectedKegiatan = document.querySelector('input[name="kegiatan"]:checked')?.value;
            if (selectedKegiatan) {
                updateForm(selectedKegiatan);
            }
        });
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
<?php /**PATH C:\xampp\htdocs\lbh\resources\views/reimbursement_reports/create.blade.php ENDPATH**/ ?>