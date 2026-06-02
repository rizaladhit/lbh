<x-app-layout>
    <x-slot name="header">
        Detail Permohonan Litigasi
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-xl-8">
            <!-- Status Card -->
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted d-block">Status Permohonan</small>
                            <span class="badge {{ $permohonanLitigasi->getStatusBadgeColor() }} fs-6 px-3 py-2">
                                {{ $permohonanLitigasi->getStatusLabel() }} ({{ $permohonanLitigasi->status }})
                            </span>
                        </div>
                        @if(auth()->user()->role === 'admin')
                        <div class="btn-group" role="group">
                            @if($permohonanLitigasi->canBeApproved())
                            <a href="{{ route('permohonan-litigasi.approve', $permohonanLitigasi) }}" class="btn btn-sm btn-info">Setujui</a>
                            <a href="{{ route('permohonan-litigasi.reject', $permohonanLitigasi) }}" class="btn btn-sm btn-danger">Tolak</a>
                            @endif
                            @if($permohonanLitigasi->canBeVerified())
                            <a href="{{ route('permohonan-litigasi.verify', $permohonanLitigasi) }}" class="btn btn-sm btn-success">Verifikasi</a>
                            @endif
                            @if($permohonanLitigasi->canBeAssigned())
                            <a href="{{ route('permohonan-litigasi.assignForm', $permohonanLitigasi) }}" class="btn btn-sm btn-info">Tugaskan</a>
                            @endif
                            @if($permohonanLitigasi->canBeCompleted())
                            <a href="{{ route('permohonan-litigasi.completeForm', $permohonanLitigasi) }}" class="btn btn-sm btn-primary">Selesaikan</a>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 fw-bold text-primary"><i class="fa-solid fa-scale-balanced me-2"></i>Detail Permohonan Bantuan Litigasi</h6>
                    <span class="badge bg-primary fs-6">{{ $permohonanLitigasi->no_registrasi }}</span>
                </div>
                <div class="card-body p-4" style="font-size: 0.95rem;">
                    @php $fields = [
                        'Nama' => $permohonanLitigasi->nama,
                        'Alamat' => $permohonanLitigasi->alamat,
                        'Telp/HP' => $permohonanLitigasi->telp_hp,
                        'NIK' => $permohonanLitigasi->nik,
                        'Jenis Perkara' => $permohonanLitigasi->jenis_perkara,
                        'No. Perkara' => $permohonanLitigasi->no_perkara,
                        'Tgl. Rencana Kunjungan' => $permohonanLitigasi->tgl_rencana_kunjungan->format('d M Y'),
                        'Uraian Singkat' => $permohonanLitigasi->uraian_singkat,
                        'Diajukan Oleh' => optional($permohonanLitigasi->user)->name ?? '-',
                        'Tanggal Pengajuan' => $permohonanLitigasi->created_at->format('d M Y, H:i'),
                    ]; @endphp
                    @foreach($fields as $label => $value)
                    <div class="d-flex border-bottom py-2">
                        <div class="fw-semibold" style="min-width: 220px;">{{ $label }}</div>
                        <div class="text-muted">: {{ $value }}</div>
                    </div>
                    @endforeach

                    @if($permohonanLitigasi->verification_notes)
                    <div class="d-flex border-bottom py-2">
                        <div class="fw-semibold" style="min-width: 220px;">Catatan Verifikasi</div>
                        <div class="text-muted">: {{ $permohonanLitigasi->verification_notes }}</div>
                    </div>
                    @endif

                    @if($permohonanLitigasi->assignedLawyer)
                    <div class="d-flex border-bottom py-2">
                        <div class="fw-semibold" style="min-width: 220px;">Advocate</div>
                        <div class="text-muted">: {{ $permohonanLitigasi->assignedLawyer->name }}</div>
                    </div>
                    @endif

                    @if($permohonanLitigasi->assignedParalegal)
                    <div class="d-flex border-bottom py-2">
                        <div class="fw-semibold" style="min-width: 220px;">Paralegal</div>
                        <div class="text-muted">: {{ $permohonanLitigasi->assignedParalegal->name }}</div>
                    </div>
                    @endif

                    @if($permohonanLitigasi->activity_notes)
                    <div class="d-flex border-bottom py-2">
                        <div class="fw-semibold" style="min-width: 220px;">Catatan Aktivitas</div>
                        <div class="text-muted">: {{ $permohonanLitigasi->activity_notes }}</div>
                    </div>
                    @endif

                    <div class="mt-4 row g-3">
                        @if($permohonanLitigasi->file_ktp_kk)
                        <div class="col-md-4">
                            <p class="fw-semibold small mb-1">KTP / KK</p>
                            <a href="{{ Storage::url($permohonanLitigasi->file_ktp_kk) }}" target="_blank" class="btn btn-sm btn-outline-primary w-100"><i class="fa-solid fa-file me-1"></i> Lihat File</a>
                        </div>
                        @endif
                        @if($permohonanLitigasi->file_sktm)
                        <div class="col-md-4">
                            <p class="fw-semibold small mb-1">SKTM</p>
                            <a href="{{ Storage::url($permohonanLitigasi->file_sktm) }}" target="_blank" class="btn btn-sm btn-outline-primary w-100"><i class="fa-solid fa-file me-1"></i> Lihat File</a>
                        </div>
                        @endif
                        @if($permohonanLitigasi->file_ttd)
                        <div class="col-md-4">
                            <p class="fw-semibold small mb-1">Tanda Tangan</p>
                            <img src="{{ Storage::url($permohonanLitigasi->file_ttd) }}" class="img-thumbnail" style="max-height: 100px;" alt="TTD">
                        </div>
                        @endif
                    </div>
                </div>
                <div class="card-footer py-3 d-flex gap-2 justify-content-end">
                    <a href="{{ route('permohonan-litigasi.index') }}" class="btn btn-light border fw-medium">Kembali</a>
                    <a href="{{ route('permohonan-litigasi.print', $permohonanLitigasi) }}" target="_blank" class="btn btn-success fw-bold shadow-sm"><i class="fa-solid fa-print me-1"></i> Cetak Formulir</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
