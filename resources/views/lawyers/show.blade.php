<x-app-layout>
    <x-slot name="header">
        Detail Data Advocate
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-xl-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 fw-bold text-primary"><i class="fa-solid fa-gavel me-2"></i>Detail Advocate</h6>
                    <span class="badge {{ $lawyer->getStatusBadgeColor() }} fs-6">{{ $lawyer->getStatusLabel() }}</span>
                </div>
                <div class="card-body p-4" style="font-size: 0.95rem;">
                    @php $fields = [
                        'Nama Lengkap' => $lawyer->name,
                        'No. Identitas (SIU)' => $lawyer->no_identitas,
                        'Email' => $lawyer->email,
                        'Telepon' => $lawyer->phone,
                        'Keahlian' => $lawyer->specialization,
                        'Alamat' => $lawyer->address ?? '-',
                        'Catatan' => $lawyer->notes ?? '-',
                        'Terdaftar pada' => $lawyer->created_at->format('d M Y, H:i'),
                        'Diperbarui' => $lawyer->updated_at->format('d M Y, H:i'),
                    ]; @endphp
                    @foreach($fields as $label => $value)
                    <div class="d-flex border-bottom py-3">
                        <div class="fw-semibold" style="min-width: 180px;">{{ $label }}</div>
                        <div class="text-muted" style="word-break: break-word;">: {{ $value }}</div>
                    </div>
                    @endforeach
                </div>
                <div class="card-footer py-3 d-flex gap-2 justify-content-end">
                    <a href="{{ route('lawyers.index') }}" class="btn btn-light border fw-medium">Kembali</a>
                    <a href="{{ route('lawyers.edit', $lawyer) }}" class="btn btn-warning fw-bold"><i class="fa-solid fa-edit me-1"></i> Edit</a>
                </div>
            </div>

            @if($lawyer->permohonanLitigasiAsLawyer()->count() > 0)
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 fw-bold text-primary"><i class="fa-solid fa-scale-balanced me-2"></i>Permohonan Litigasi yang Ditugaskan</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-4">No. Registrasi</th>
                                    <th>Nama Pemohon</th>
                                    <th>Jenis Perkara</th>
                                    <th>Peran</th>
                                    <th>Status</th>
                                    <th class="pe-4 text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lawyer->permohonanLitigasiAsLawyer as $permohonan)
                                <tr>
                                    <td class="ps-4"><span class="badge bg-primary-subtle text-primary">{{ $permohonan->no_registrasi }}</span></td>
                                    <td>{{ $permohonan->nama }}</td>
                                    <td>{{ $permohonan->jenis_perkara }}</td>
                                    <td><span class="badge bg-primary">Advocate</span></td>
                                    <td><span class="badge {{ $permohonan->getStatusBadgeColor() }}">{{ $permohonan->getStatusLabel() }}</span></td>
                                    <td class="pe-4 text-end">
                                        <a href="{{ route('permohonan-litigasi.show', $permohonan) }}" class="btn btn-light btn-sm text-info border"><i class="fa-solid fa-eye"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
