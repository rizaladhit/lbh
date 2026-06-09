<x-app-layout>
    <x-slot name="header">Laporan Penasehat Hukum - Lapas Subang</x-slot>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header">Form Laporan Lapas Subang</div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('laporan-ph.lapas.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">No. Registrasi Perkara</label>
                            <input type="text" name="no_registrasi_perkara" id="no_registrasi_perkara"
                                class="form-control" list="litigasiOptions"
                                placeholder="Ketik No. Registrasi / Nama / Jenis Perkara" autocomplete="off" required>
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
                            <a href="{{ route('laporan-ph.lapas.index') }}" class="btn btn-light border">Kembali</a>
                            <button class="btn btn-primary">Simpan Laporan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            const nomorRegistrasiInput = document.getElementById('no_registrasi_perkara');
            const litigasiOptions = document.getElementById('litigasiOptions');
            let autocompleteTimer;

            async function fillLitigasiData(noRegistrasi) {
                const val = noRegistrasi.trim();
                if (!val) return;

                try {
                    const res = await fetch("{{ route('litigasi.lookup') }}?no_registrasi=" + encodeURIComponent(val), { headers: { 'Accept': 'application/json' } });
                    if (!res.ok) return;
                    const data = await res.json();
                    if (data) {
                        document.getElementById('nama').value = data.nama || '';
                        document.getElementById('jenis_perkara').value = data.jenis_perkara || '';
                    }
                } catch (e) { console.error(e); }
            }

            nomorRegistrasiInput?.addEventListener('input', function () {
                const keyword = this.value.trim();
                clearTimeout(autocompleteTimer);

                if (keyword.length < 2) {
                    litigasiOptions.innerHTML = '';
                    return;
                }

                autocompleteTimer = setTimeout(async () => {
                    try {
                        const res = await fetch("{{ route('litigasi.lookup') }}?q=" + encodeURIComponent(keyword), { headers: { 'Accept': 'application/json' } });
                        if (!res.ok) return;

                        const items = await res.json();
                        litigasiOptions.innerHTML = '';

                        items.forEach(item => {
                            const option = document.createElement('option');
                            option.value = item.no_registrasi;
                            option.label = item.label;
                            litigasiOptions.appendChild(option);
                        });
                    } catch (e) {
                        console.error(e);
                    }
                }, 250);
            });

            nomorRegistrasiInput?.addEventListener('change', function () {
                fillLitigasiData(this.value);
            });

            nomorRegistrasiInput?.addEventListener('blur', function () {
                fillLitigasiData(this.value);
            });
        </script>
    @endpush
</x-app-layout>