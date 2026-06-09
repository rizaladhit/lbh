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
     <?php $__env->slot('header', null, []); ?> Laporan Penasehat Hukum - Lapas Subang <?php $__env->endSlot(); ?>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header">Form Laporan Lapas Subang</div>
                <div class="card-body p-4">
                    <form method="POST" action="<?php echo e(route('laporan-ph.lapas.store')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label class="form-label">No. Registrasi Perkara</label>
                            <input type="text" name="no_registrasi_perkara" id="no_registrasi_perkara" class="form-control" list="litigasiOptions" placeholder="Ketik No. Registrasi / Nama / Jenis Perkara" autocomplete="off" required>
                            <datalist id="litigasiOptions"></datalist>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Terdakwa</label>
                            <input type="text" name="nama" id="nama" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Jaksa</label>
                            <input type="text" name="nama_jaksa" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Penasehat Hukum</label>
                            <input type="text" name="nama_penasehat_hukum" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jenis Perkara</label>
                            <input type="text" name="jenis_perkara" id="jenis_perkara" class="form-control">
                        </div>

                        <div class="d-flex gap-2 justify-content-end">
                            <a href="<?php echo e(route('laporan-ph.lapas.index')); ?>" class="btn btn-light border">Batal</a>
                            <button class="btn btn-primary">Simpan Laporan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
    <script>
        const nomorRegistrasiInput = document.getElementById('no_registrasi_perkara');
        const litigasiOptions = document.getElementById('litigasiOptions');
        let autocompleteTimer;

        async function fillLitigasiData(noRegistrasi) {
            const val = noRegistrasi.trim();
            if(!val) return;

            try{
                const res = await fetch("<?php echo e(route('litigasi.lookup')); ?>?no_registrasi="+encodeURIComponent(val), { headers: { 'Accept': 'application/json' } });
                if(!res.ok) return;
                const data = await res.json();
                if(data){
                    document.getElementById('nama').value = data.nama || '';
                    document.getElementById('jenis_perkara').value = data.jenis_perkara || '';
                }
            }catch(e){ console.error(e); }
        }

        nomorRegistrasiInput?.addEventListener('input', function(){
            const keyword = this.value.trim();
            clearTimeout(autocompleteTimer);

            if(keyword.length < 2) {
                litigasiOptions.innerHTML = '';
                return;
            }

            autocompleteTimer = setTimeout(async () => {
                try {
                    const res = await fetch("<?php echo e(route('litigasi.lookup')); ?>?q="+encodeURIComponent(keyword), { headers: { 'Accept': 'application/json' } });
                    if(!res.ok) return;

                    const items = await res.json();
                    litigasiOptions.innerHTML = '';

                    items.forEach(item => {
                        const option = document.createElement('option');
                        option.value = item.no_registrasi;
                        option.label = item.label;
                        litigasiOptions.appendChild(option);
                    });
                } catch(e) {
                    console.error(e);
                }
            }, 250);
        });

        nomorRegistrasiInput?.addEventListener('change', function(){
            fillLitigasiData(this.value);
        });

        nomorRegistrasiInput?.addEventListener('blur', function(){
            fillLitigasiData(this.value);
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
<?php /**PATH C:\xampp\htdocs\lbh\resources\views/reports/ph/lapas.blade.php ENDPATH**/ ?>