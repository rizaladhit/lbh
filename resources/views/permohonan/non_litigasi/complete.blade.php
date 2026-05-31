<x-app-layout>
    <x-slot name="header">
        Selesaikan Permohonan Non-Litigasi
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-xl-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header py-3 bg-primary">
                    <h6 class="m-0 fw-bold text-white"><i class="fa-solid fa-check-double me-2"></i>Selesaikan Permohonan Non-Litigasi</h6>
                </div>
                <div class="card-body p-4">
                    <p class="text-muted mb-4">
                        Tandai penanganan permohonan litigasi dari <strong>{{ \$permohonanNonLitigasi->nama }}</strong> 
                        (No. Registrasi: <strong>{{ \$permohonanNonLitigasi->no_registrasi }}</strong>) 
                        sebagai selesai dan buat catatan kegiatan penanganan.
                    </p>

                    <form method="POST" action="{{ route('permohonan-non-litigasi.storeComplete', \$permohonanNonLitigasi) }}" class="needs-validation" novalidate>
                        @csrf
                        
                        <div class="mb-3">
                            <label for="activity_notes" class="form-label fw-semibold">Catatan Kegiatan Penanganan <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('activity_notes') is-invalid @enderror" 
                                id="activity_notes" name="activity_notes" rows="6" 
                                placeholder="Jelaskan detail kegiatan penanganan kasus, hasil yang dicapai, kesimpulan dan rekomendasi..." required>{{ old('activity_notes') }}</textarea>
                            @error('activity_notes')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="text-muted d-block mt-2">Minimal 10 karakter. Dokumentasikan semua kegiatan penanganan kasus secara lengkap.</small>
                        </div>

                        <div class="alert alert-warning" role="alert">
                            <i class="fa-solid fa-triangle-exclamation me-2"></i>
                            <strong>Perhatian:</strong> Setelah disubmit, permohonan akan ditandai sebagai DONE dan tidak dapat diubah lagi.
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <a href="{{ route('permohonan-non-litigasi.show', \$permohonanNonLitigasi) }}" class="btn btn-light border fw-medium w-100">Batalkan</a>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary fw-bold w-100">
                                    <i class="fa-solid fa-check-double me-1"></i> Tandai Sebagai Selesai
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Detail Permohonan & Penugasan -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 fw-bold text-primary"><i class="fa-solid fa-info-circle me-2"></i>Detail Permohonan & Penugasan</h6>
                </div>
                <div class="card-body p-4" style="font-size: 0.95rem;">
                    <div class="d-flex border-bottom py-2 mb-3">
                        <div class="fw-semibold" style="min-width: 180px;">Status Saat Ini</div>
                        <div>
                            <span class="badge {{ \$permohonanNonLitigasi->getStatusBadgeColor() }} fs-6">
                                {{ \$permohonanNonLitigasi->getStatusLabel() }} ({{ \$permohonanNonLitigasi->status }})
                            </span>
                        </div>
                    </div>

                    @php $fields = [
                        'Nama Pemohon' => \$permohonanNonLitigasi->nama,
                        'Nomor Registrasi' => \$permohonanNonLitigasi->no_registrasi,
                        'Jenis Perkara' => \$permohonanNonLitigasi->jenis_perkara,
                        'Nomor Perkara' => \$permohonanNonLitigasi->no_perkara,
                    ]; @endphp
                    @foreach($fields as $label => $value)
                    <div class="d-flex border-bottom py-2">
                        <div class="fw-semibold" style="min-width: 180px;">{{ $label }}</div>
                        <div class="text-muted">: {{ $value }}</div>
                    </div>
                    @endforeach

                    @if(\$permohonanNonLitigasi->assignedLawyer)
                    <div class="d-flex border-bottom py-2">
                        <div class="fw-semibold" style="min-width: 180px;">Lawyer Penanganan</div>
                        <div class="text-muted">: {{ \$permohonanNonLitigasi->assignedLawyer->name }}</div>
                    </div>
                    @endif

                    @if(\$permohonanNonLitigasi->assignedParalegal)
                    <div class="d-flex border-bottom py-2">
                        <div class="fw-semibold" style="min-width: 180px;">Paralegal Penanganan</div>
                        <div class="text-muted">: {{ \$permohonanNonLitigasi->assignedParalegal->name }}</div>
                    </div>
                    @endif

                    @if(\$permohonanNonLitigasi->verification_notes)
                    <div class="d-flex border-bottom py-2">
                        <div class="fw-semibold" style="min-width: 180px;">Catatan Verifikasi</div>
                        <div class="text-muted">: {{ Str::limit(\$permohonanNonLitigasi->verification_notes, 100) }}</div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

