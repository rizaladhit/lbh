<x-app-layout>
    <x-slot name="header">
        Persetujuan Kelengkapan Permohonan Litigasi
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-xl-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header py-3 bg-info">
                    <h6 class="m-0 fw-bold text-white"><i class="fa-solid fa-thumbs-up me-2"></i>Persetujuan Kelengkapan</h6>
                </div>
                <div class="card-body p-4">
                    <p class="text-muted mb-4">
                        Anda akan menandai permohonan litigasi dari <strong>{{ $permohonanLitigasi->nama }}</strong>
                        dengan nomor registrasi <strong>{{ $permohonanLitigasi->no_registrasi }}</strong> sebagai lengkap.
                    </p>

                    <form method="POST" action="{{ route('permohonan-litigasi.storeApprove', $permohonanLitigasi) }}" class="needs-validation" novalidate>
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
                                <a href="{{ route('permohonan-litigasi.show', $permohonanLitigasi) }}" class="btn btn-light border fw-medium w-100">Batalkan</a>
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

            <!-- Detail Permohonan Summary -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 fw-bold text-primary"><i class="fa-solid fa-info-circle me-2"></i>Detail Permohonan</h6>
                </div>
                <div class="card-body p-4" style="font-size: 0.95rem;">
                    @php $fields = [
                        'Nama Pemohon' => $permohonanLitigasi->nama,
                        'Nomor Registrasi' => $permohonanLitigasi->no_registrasi,
                        'Jenis Perkara' => $permohonanLitigasi->jenis_perkara,
                        'Nomor Perkara' => $permohonanLitigasi->no_perkara,
                        'Uraian Singkat' => $permohonanLitigasi->uraian_singkat,
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
