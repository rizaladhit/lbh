<x-app-layout>
    <x-slot name="header">Laporan Reimbursement</x-slot>

    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="mb-0">Daftar Laporan Reimbursement</h5>
                <a href="{{ route('reimbursement-reports.create') }}" class="btn btn-primary">
                    <i class="fa-solid fa-plus me-2"></i>Buat Laporan Baru
                </a>
            </div>

            @if($reports->count() > 0)
            <div class="card shadow-sm border-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>No.</th>
                                <th>Kegiatan</th>
                                <th>OBH</th>
                                <th>Tgl Pelaksanaan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reports as $report)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <span class="fw-semibold">{{ $report->kegiatan }}</span>
                                </td>
                                <td>{{ $report->obh }}</td>
                                <td>{{ $report->tgl_pelaksanaan->format('d M Y') }}</td>
                                <td>
                                    <span class="badge {{ $report->getStatusBadgeColor() }}">
                                        {{ $report->getStatusLabel() }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('reimbursement-reports.show', $report) }}" class="btn btn-sm btn-info text-white">
                                        <i class="fa-solid fa-eye"></i> Lihat
                                    </a>
                                    @if($report->status === 'draft')
                                    <a href="{{ route('reimbursement-reports.edit', $report) }}" class="btn btn-sm btn-warning">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </a>
                                    <form method="POST" action="{{ route('reimbursement-reports.destroy', $report) }}" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                            <i class="fa-solid fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="fa-solid fa-inbox" style="font-size: 2rem; opacity: 0.3;"></i>
                                    <p class="mt-2">Belum ada laporan reimbursement</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-4">
                {{ $reports->links() }}
            </div>
            @else
            <div class="card shadow-sm border-0">
                <div class="card-body text-center py-5">
                    <i class="fa-solid fa-file-invoice-dollar" style="font-size: 3rem; color: #cbd5e1;"></i>
                    <p class="mt-3 text-muted">Belum ada laporan reimbursement yang dibuat</p>
                    <a href="{{ route('reimbursement-reports.create') }}" class="btn btn-primary mt-3">
                        <i class="fa-solid fa-plus me-2"></i>Buat Laporan Pertama
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
