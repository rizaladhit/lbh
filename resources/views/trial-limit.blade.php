<x-app-layout>
    <x-slot name="header">Batas Trial Tercapai</x-slot>

    <div class="d-flex align-items-center justify-content-center" style="min-height: calc(100vh - 220px);">
        <div class="card" style="max-width: 720px; width: 100%; border-radius: 22px; padding: 36px;">
            <div class="text-center mb-4">
                <div class="fs-1 fw-bold mb-3">Akses Trial Habis</div>
                <p class="text-secondary mb-0">Kamu sudah mencapai batas input yang diizinkan oleh konfigurasi trial.</p>
            </div>

            <!--<div class="p-4 mb-4" style="background: rgba(99,102,241,.08); border-radius: 20px;">
                <div class="d-flex align-items-center justify-content-between gap-3 flex-column flex-sm-row">
                    <div>
                        <div class="text-uppercase fw-semibold text-muted" style="font-size:.78rem;">Status Trial</div>
                        <div class="fw-bold" style="font-size:2rem;">{{ $trialCount }} dari {{ $limit }}</div>
                    </div>
                    <div class="badge bg-danger rounded-pill py-2 px-3" style="font-size:.85rem;">Trial Terbatas</div>
                </div>
                <div class="mt-3 text-muted">Jika kamu ingin melanjutkan, hapus atau kosongkan nilai <code>LIMIT</code> di file <code>.env</code>.</div>
            </div>-->

            <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg px-4">Kembali ke Dashboard</a>
                <button type="button" class="btn btn-outline-secondary btn-lg px-4" onclick="history.back()">Kembali</button>
            </div>
        </div>
    </div>
</x-app-layout>
