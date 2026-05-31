<x-app-layout>
    <x-slot name="header">
        Persetujuan Kelengkapan Permohonan Non-Litigasi
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-xl-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header py-3 bg-info">
                    <h6 class="m-0 fw-bold text-white"><i class="fa-solid fa-thumbs-up me-2"></i>Persetujuan Kelengkapan</h6>
                </div>
                <div class="card-body p-4">
                    <p class="text-muted mb-4">
                        Anda akan menandai permohonan non-litigasi dari <strong>{{ $permohonanNonLitigasi->nama_pemohon }}</strong>
                        dengan nomor registrasi <strong>{{ $permohonanNonLitigasi->no_registrasi }}</strong> sebagai lengkap.
                    </p>

                    <form method="POST" action="{{ route('permohonan-non-litigasi.storeApprove', $permohonanNonLitigasi) }}" class="needs-validation" novalidate>
                        @csrf

                        <div class="mb-3">
                            <label for="verification_notes" class="form-label fw-semibold">Catatan Pemeriksaan Kelengkapan</label>
                            <textarea class="form-control @error('verification_notes') is-invalid @enderror"
                                id="verification_notes" name="verification_notes" rows="5"
                                placeholder="Tambahkan catatan pemeriksaan kelengkapan dokumen...">{{ old('verification_notes') }}</textarea>
                            @error('verification_notes')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="text-muted d-block mt-2">Opsional, namun disarankan untuk mencatat hasil pemeriksaan.</small>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <a href="{{ route('permohonan-non-litigasi.show', $permohonanNonLitigasi) }}" class="btn btn-light border fw-medium w-100">Batalkan</a>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-info fw-bold w-100">
                                    <i class="fa-solid fa-check me-1"></i> Setujui Kelengkapan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 fw-bold text-primary"><i class="fa-solid fa-info-circle me-2"></i>Detail Permohonan</h6>
                </div>
                <div class="card-body p-4" style="font-size: 0.95rem;">
                    @php $fields = [
                        'Nama Pemohon' => $permohonanNonLitigasi->nama_pemohon,
                        'Nomor Registrasi' => $permohonanNonLitigasi->no_registrasi,
                        'Jenis Perkara' => $permohonanNonLitigasi->jenis_perkara,
                        'Tgl. Rencana Kunjungan' => $permohonanNonLitigasi->tgl_rencana_kunjungan->format('d M Y'),
                        'Uraian Singkat' => $permohonanNonLitigasi->uraian_singkat,
                    ]; @endphp
                    @foreach($fields as $label => $value)
                    <div class="d-flex border-bottom py-2">
                        <div class="fw-semibold" style="min-width: 180px;">{{ $label }}</div>
                        <div class="text-muted">: {{ $value }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


