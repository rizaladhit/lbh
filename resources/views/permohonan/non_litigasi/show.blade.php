<x-app-layout>
    <x-slot name="header">
        Detail Permohonan Non-Litigasi
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-xl-8">
            <!-- Status Card -->
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted d-block">Status Permohonan</small>
                            <span class="badge {{ $permohonanNonLitigasi->getStatusBadgeColor() }} fs-6 px-3 py-2">
                                {{ $permohonanNonLitigasi->getStatusLabel() }} ({{ $permohonanNonLitigasi->status }})
                            </span>
                        </div>
                        @if(auth()->user()->role === 'admin')
                        <div class="btn-group" role="group">
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
                <div class="card-body p-4" style="font-size: 0.95rem;">
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
                    <div class="d-flex border-bottom py-2">
                        <div class="fw-semibold" style="min-width: 220px;">{{ $label }}</div>
                        <div class="text-muted">: {{ $value }}</div>
                    </div>
                    @endforeach

                    @if($permohonanNonLitigasi->verification_notes)
                    <div class="d-flex border-bottom py-2">
                        <div class="fw-semibold" style="min-width: 220px;">Catatan Verifikasi</div>
                        <div class="text-muted">: {{ $permohonanNonLitigasi->verification_notes }}</div>
                    </div>
                    @endif

                    @if($permohonanNonLitigasi->assignedLawyer)
                    <div class="d-flex border-bottom py-2">
                        <div class="fw-semibold" style="min-width: 220px;">Advocate</div>
                        <div class="text-muted">: {{ $permohonanNonLitigasi->assignedLawyer->name }}</div>
                    </div>
                    @endif

                    @if($permohonanNonLitigasi->assignedParalegal)
                    <div class="d-flex border-bottom py-2">
                        <div class="fw-semibold" style="min-width: 220px;">Paralegal</div>
                        <div class="text-muted">: {{ $permohonanNonLitigasi->assignedParalegal->name }}</div>
                    </div>
                    @endif

                    @if($permohonanNonLitigasi->activity_notes)
                    <div class="d-flex border-bottom py-2">
                        <div class="fw-semibold" style="min-width: 220px;">Catatan Aktivitas</div>
                        <div class="text-muted">: {{ $permohonanNonLitigasi->activity_notes }}</div>
                    </div>
                    @endif

                    <div class="mt-4 row g-3">
                        @if($permohonanNonLitigasi->file_ktp_kk)
                        <div class="col-md-4">
                            <p class="fw-semibold small mb-1">KTP / KK</p>
                            <a href="{{ Storage::url($permohonanNonLitigasi->file_ktp_kk) }}" target="_blank" class="btn btn-sm btn-outline-primary w-100"><i class="fa-solid fa-file me-1"></i> Lihat File</a>
                        </div>
                        @endif
                        @if($permohonanNonLitigasi->file_sktm)
                        <div class="col-md-4">
                            <p class="fw-semibold small mb-1">SKTM</p>
                            <a href="{{ Storage::url($permohonanNonLitigasi->file_sktm) }}" target="_blank" class="btn btn-sm btn-outline-primary w-100"><i class="fa-solid fa-file me-1"></i> Lihat File</a>
                        </div>
                        @endif
                        @if($permohonanNonLitigasi->file_ttd)
                        <div class="col-md-4">
                            <p class="fw-semibold small mb-1">Tanda Tangan</p>
                            <img src="{{ Storage::url($permohonanNonLitigasi->file_ttd) }}" class="img-thumbnail" style="max-height: 100px;" alt="TTD">
                        </div>
                        @endif
                    </div>
                </div>
                <div class="card-footer py-3 d-flex gap-2 justify-content-end">
                    <a href="{{ route('permohonan-non-litigasi.index') }}" class="btn btn-light border fw-medium">Kembali</a>
                    <a href="{{ route('permohonan-non-litigasi.print', $permohonanNonLitigasi) }}" target="_blank" class="btn btn-success fw-bold shadow-sm"><i class="fa-solid fa-print me-1"></i> Cetak Formulir</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


