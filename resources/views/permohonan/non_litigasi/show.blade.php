<x-app-layout>
    <x-slot name="header">
        Detail Permohonan Non-Litigasi
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-xl-8">
            <!-- Status Card -->
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body p-3">
                    <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center gap-3">
                        <div>
                            <small class="text-muted d-block">Status Permohonan</small>
                            <span class="badge {{ $permohonanNonLitigasi->getStatusBadgeColor() }} fs-6 px-3 py-2">
                                {{ $permohonanNonLitigasi->getStatusLabel() }} ({{ $permohonanNonLitigasi->status }})
                            </span>
                        </div>
                        @if(auth()->user()->role === 'admin')
                        <div class="d-flex flex-wrap gap-2 justify-content-start justify-content-md-end">
                            <a href="{{ route('permohonan-non-litigasi.edit', $permohonanNonLitigasi) }}" class="btn btn-sm btn-secondary">Edit</a>
                            @if($permohonanNonLitigasi->canBeApproved())
                            <a href="{{ route('permohonan-non-litigasi.approve', $permohonanNonLitigasi) }}" class="btn btn-sm btn-info">Setujui</a>
                            <a href="{{ route('permohonan-non-litigasi.reject', $permohonanNonLitigasi) }}" class="btn btn-sm btn-danger">Tolak</a>
                            @endif
                            @if($permohonanNonLitigasi->canBeVerified())
                            <a href="{{ route('permohonan-non-litigasi.verify', $permohonanNonLitigasi) }}" class="btn btn-sm btn-success">Verifikasi</a>
                            @endif
                            @if($permohonanNonLitigasi->canBeAssigned())
                            <a href="{{ route('permohonan-non-litigasi.assignForm', $permohonanNonLitigasi) }}" class="btn btn-sm btn-info">Tugaskan</a>
                            @endif
                            @if($permohonanNonLitigasi->canBeCompleted())
                            <a href="{{ route('permohonan-non-litigasi.completeForm', $permohonanNonLitigasi) }}" class="btn btn-sm btn-primary">Selesaikan</a>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 fw-bold text-primary"><i class="fa-solid fa-handshake me-2"></i>Detail Permohonan Bantuan Non-Litigasi</h6>
                    <span class="badge bg-success fs-6">{{ $permohonanNonLitigasi->no_registrasi }}</span>
                </div>
                <div class="card-body p-3 p-md-4" style="font-size: 0.95rem;">
                    @php $fields = [
                        'Nama Pemohon' => $permohonanNonLitigasi->nama_pemohon,
                        'Alamat Pemohon' => $permohonanNonLitigasi->alamat_pemohon,
                        'Telp/HP Pemohon' => $permohonanNonLitigasi->telp_hp_pemohon,
                        'NIK Pemohon' => $permohonanNonLitigasi->nik_pemohon,
                        'Jenis Perkara' => $permohonanNonLitigasi->jenis_perkara,
                        'Tgl. Rencana Kunjungan' => $permohonanNonLitigasi->tgl_rencana_kunjungan->format('d M Y'),
                        'Uraian Singkat' => $permohonanNonLitigasi->uraian_singkat,
                        'Diajukan Oleh' => optional($permohonanNonLitigasi->user)->name ?? '-',
                        'Tanggal Pengajuan' => $permohonanNonLitigasi->created_at->format('d M Y, H:i'),
                    ]; @endphp
                    @foreach($fields as $label => $value)
                    <div class="d-flex flex-column flex-md-row border-bottom py-2">
                        <div class="fw-semibold text-nowrap pe-md-3" style="min-width: fit-content;">{{ $label }}</div>
                        <div class="text-muted"><span class="d-md-none">: </span><span class="d-none d-md-inline">: </span>{{ $value }}</div>
                    </div>
                    @endforeach

                    @if($permohonanNonLitigasi->verification_notes)
                    <div class="d-flex flex-column flex-md-row border-bottom py-2">
                        <div class="fw-semibold text-nowrap pe-md-3" style="min-width: fit-content;">Catatan Verifikasi</div>
                        <div class="text-muted"><span class="d-md-none">: </span><span class="d-none d-md-inline">: </span>{{ $permohonanNonLitigasi->verification_notes }}</div>
                    </div>
                    @endif

                    @if($permohonanNonLitigasi->assignedLawyer)
                    <div class="d-flex flex-column flex-md-row border-bottom py-2">
                        <div class="fw-semibold text-nowrap pe-md-3" style="min-width: fit-content;">Advocate</div>
                        <div class="text-muted"><span class="d-md-none">: </span><span class="d-none d-md-inline">: </span>{{ $permohonanNonLitigasi->assignedLawyer->name }}</div>
                    </div>
                    @endif

                    @if($permohonanNonLitigasi->assignedParalegal)
                    <div class="d-flex flex-column flex-md-row border-bottom py-2">
                        <div class="fw-semibold text-nowrap pe-md-3" style="min-width: fit-content;">Paralegal</div>
                        <div class="text-muted"><span class="d-md-none">: </span><span class="d-none d-md-inline">: </span>{{ $permohonanNonLitigasi->assignedParalegal->name }}</div>
                    </div>
                    @endif

                    @if($permohonanNonLitigasi->activity_notes)
                    <div class="d-flex flex-column flex-md-row border-bottom py-2">
                        <div class="fw-semibold text-nowrap pe-md-3" style="min-width: fit-content;">Catatan Aktivitas</div>
                        <div class="text-muted"><span class="d-md-none">: </span><span class="d-none d-md-inline">: </span>{{ $permohonanNonLitigasi->activity_notes }}</div>
                    </div>
                    @endif

                    <div class="mt-4 row g-2 g-md-3">
                        @if($permohonanNonLitigasi->file_ktp_kk)
                        <div class="col-12 col-sm-6 col-md-4">
                            <p class="fw-semibold small mb-1">KTP / KK</p>
                            <a href="{{ Storage::url($permohonanNonLitigasi->file_ktp_kk) }}" target="_blank" class="btn btn-sm btn-outline-primary w-100"><i class="fa-solid fa-file me-1"></i> Lihat File</a>
                        </div>
                        @endif
                        @if($permohonanNonLitigasi->file_sktm)
                        <div class="col-12 col-sm-6 col-md-4">
                            <p class="fw-semibold small mb-1">SKTM</p>
                            <a href="{{ Storage::url($permohonanNonLitigasi->file_sktm) }}" target="_blank" class="btn btn-sm btn-outline-primary w-100"><i class="fa-solid fa-file me-1"></i> Lihat File</a>
                        </div>
                        @endif
                        @if($permohonanNonLitigasi->file_ttd)
                        <div class="col-12 col-sm-6 col-md-4">
                            <p class="fw-semibold small mb-1">Tanda Tangan</p>
                            <img src="{{ Storage::url($permohonanNonLitigasi->file_ttd) }}" class="img-thumbnail" style="max-height: 100px;" alt="TTD">
                        </div>
                        @endif
                    </div>
                </div>
                <div class="card-footer py-2 py-md-3 d-flex flex-column flex-md-row gap-2 justify-content-end">
                    <a href="{{ route('permohonan-non-litigasi.index') }}" class="btn btn-light border fw-medium">Kembali</a>
                    <a href="{{ route('permohonan-non-litigasi.print', $permohonanNonLitigasi) }}" target="_blank" class="btn btn-success fw-bold shadow-sm"><i class="fa-solid fa-print me-1"></i> Cetak Formulir</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


