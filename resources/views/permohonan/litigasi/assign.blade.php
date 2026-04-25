<x-app-layout>
    <x-slot name="header">
        Tugaskan Permohonan Litigasi
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-xl-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header py-3 bg-info">
                    <h6 class="m-0 fw-bold text-white"><i class="fa-solid fa-user-check me-2"></i>Tugaskan Permohonan Litigasi</h6>
                </div>
                <div class="card-body p-4">
                    <p class="text-muted mb-4">
                        Tugaskan permohonan litigasi dari <strong>{{ $permohonanLitigasi->nama }}</strong> 
                        (No. Registrasi: <strong>{{ $permohonanLitigasi->no_registrasi }}</strong>) 
                        kepada lawyer atau paralegal.
                    </p>

                    <form method="POST" action="{{ route('permohonan-litigasi.storeAssign', $permohonanLitigasi) }}" class="needs-validation" novalidate>
                        @csrf
                        
                        <div class="mb-3">
                            <label for="assigned_lawyer_id" class="form-label fw-semibold">Pilih Lawyer</label>
                            <select class="form-select @error('assigned_lawyer_id') is-invalid @enderror" 
                                id="assigned_lawyer_id" name="assigned_lawyer_id">
                                <option value="">-- Tidak ada --</option>
                                @foreach($lawyers as $lawyer)
                                <option value="{{ $lawyer->id }}" {{ old('assigned_lawyer_id') == $lawyer->id ? 'selected' : '' }}>
                                    {{ $lawyer->name }} - {{ $lawyer->specialization }} ({{ $lawyer->no_identitas }})
                                </option>
                                @endforeach
                            </select>
                            @error('assigned_lawyer_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="text-muted d-block mt-2">Opsional - Pilih jika ada lawyer yang menangani kasus ini.</small>
                        </div>

                        <div class="mb-3">
                            <label for="assigned_paralegal_id" class="form-label fw-semibold">Pilih Paralegal</label>
                            <select class="form-select @error('assigned_paralegal_id') is-invalid @enderror" 
                                id="assigned_paralegal_id" name="assigned_paralegal_id">
                                <option value="">-- Tidak ada --</option>
                                @foreach($lawyers as $lawyer)
                                <option value="{{ $lawyer->id }}" {{ old('assigned_paralegal_id') == $lawyer->id ? 'selected' : '' }}>
                                    {{ $lawyer->name }} - {{ $lawyer->specialization }} ({{ $lawyer->no_identitas }})
                                </option>
                                @endforeach
                            </select>
                            @error('assigned_paralegal_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="text-muted d-block mt-2">Opsional - Pilih jika ada paralegal yang membantu penanganan kasus.</small>
                        </div>

                        <div class="alert alert-info" role="alert">
                            <i class="fa-solid fa-circle-info me-2"></i>
                            <strong>Catatan:</strong> Minimal pilih satu (lawyer atau paralegal) untuk menugaskan permohonan ini.
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <a href="{{ route('permohonan-litigasi.show', $permohonanLitigasi) }}" class="btn btn-light border fw-medium w-100">Batalkan</a>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-info fw-bold w-100">
                                    <i class="fa-solid fa-user-check me-1"></i> Tugaskan Permohonan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Detail Permohonan Summary -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 fw-bold text-primary"><i class="fa-solid fa-info-circle me-2"></i>Detail Permohonan & Status</h6>
                </div>
                <div class="card-body p-4" style="font-size: 0.95rem;">
                    <div class="d-flex border-bottom py-2 mb-3">
                        <div class="fw-semibold" style="min-width: 180px;">Status Saat Ini</div>
                        <div>
                            <span class="badge {{ $permohonanLitigasi->getStatusBadgeColor() }} fs-6">
                                {{ $permohonanLitigasi->getStatusLabel() }} ({{ $permohonanLitigasi->status }})
                            </span>
                        </div>
                    </div>

                    @php $fields = [
                        'Nama Pemohon' => $permohonanLitigasi->nama,
                        'Nomor Registrasi' => $permohonanLitigasi->no_registrasi,
                        'Jenis Perkara' => $permohonanLitigasi->jenis_perkara,
                        'Nomor Perkara' => $permohonanLitigasi->no_perkara,
                        'Catatan Verifikasi' => $permohonanLitigasi->verification_notes ?? '-',
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
