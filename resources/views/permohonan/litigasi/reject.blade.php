<x-app-layout>
    <x-slot name="header">
        Penolakan Permohonan Litigasi
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-xl-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header py-3 bg-danger">
                    <h6 class="m-0 fw-bold text-white"><i class="fa-solid fa-ban me-2"></i>Penolakan Permohonan</h6>
                </div>
                <div class="card-body p-4">
                    <p class="text-muted mb-4">
                        Anda akan menolak permohonan litigasi dari <strong>{{ $permohonanLitigasi->nama }}</strong>
                        dengan nomor registrasi <strong>{{ $permohonanLitigasi->no_registrasi }}</strong>.
                    </p>

                    <form method="POST" action="{{ route('permohonan-litigasi.storeReject', $permohonanLitigasi) }}" class="needs-validation" novalidate>
                        @csrf

                        <div class="mb-3">
                            <label for="verification_notes" class="form-label fw-semibold">Alasan Penolakan</label>
                            <textarea class="form-control @error('verification_notes') is-invalid @enderror"
                                id="verification_notes" name="verification_notes" rows="5"
                                placeholder="Tuliskan alasan penolakan permohonan...">{{ old('verification_notes') }}</textarea>
                            @error('verification_notes')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="text-muted d-block mt-2">Opsional, tetapi disarankan agar pemohon mengetahui alasan penolakan.</small>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <a href="{{ route('permohonan-litigasi.show', $permohonanLitigasi) }}" class="btn btn-light border fw-medium w-100">Batalkan</a>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-danger fw-bold w-100">
                                    <i class="fa-solid fa-ban me-1"></i> Tolak Permohonan
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
