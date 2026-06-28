<x-app-layout>
    <x-slot name="header">Detail Data Paralegal</x-slot>

    <div class="row justify-content-center">
        <div class="col-xl-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 fw-bold text-success"><i class="fa-solid fa-user-shield me-2"></i>Detail Paralegal</h6>
                    <span class="badge {{ $paralegal->getStatusBadgeColor() }} fs-6">{{ $paralegal->getStatusLabel() }}</span>
                </div>
                <div class="card-body p-4" style="font-size: 0.95rem;">
                    @php $fields = [
                        'Nama Lengkap' => $paralegal->name,
                        'No. KTA Paralegal / No. Sertifikat' => $paralegal->no_identitas,
                        'No. KTA LBH Unsub / No. SK Paralegal LBH Unsub' => $paralegal->no_kta_lbh ?? '-',
                        'Email' => $paralegal->email,
                        'Telepon' => $paralegal->phone,
                        'Keahlian' => $paralegal->specialization,
                        'Alamat' => $paralegal->address ?? '-',
                        'Catatan' => $paralegal->notes ?? '-',
                        'Terdaftar pada' => $paralegal->created_at->format('d M Y, H:i'),
                        'Diperbarui' => $paralegal->updated_at->format('d M Y, H:i'),
                    ]; @endphp
                    @foreach($fields as $label => $value)
                    <div class="d-flex border-bottom py-3">
                        <div class="fw-semibold" style="min-width: 380px;">{{ $label }}</div>
                        <div class="text-muted" style="word-break: break-word;">: {{ $value }}</div>
                    </div>
                    @endforeach
                </div>
                <div class="card-footer py-3 d-flex gap-2 justify-content-end">
                    <a href="{{ route('paralegals.index') }}" class="btn btn-light border fw-medium">Kembali</a>
                    <a href="{{ route('paralegals.edit', $paralegal) }}" class="btn btn-warning fw-bold"><i class="fa-solid fa-edit me-1"></i> Edit</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
