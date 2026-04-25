<x-app-layout>
    <x-slot name="header">
        Detail Laporan Reimbursement
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-xl-10">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header py-3 bg-primary">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="m-0 fw-bold text-white">
                            <i class="fa-solid fa-file-invoice me-2"></i>{{ $reimbursementReport->kegiatan }}
                        </h6>
                        <span class="badge {{ $reimbursementReport->getStatusBadgeColor() }}">
                            {{ $reimbursementReport->getStatusLabel() }}
                        </span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <!-- Header Info -->
                    <div class="row mb-4 pb-3 border-bottom">
                        <div class="col-md-6">
                            <p class="mb-2">
                                <span class="fw-bold text-muted d-block">OBH</span>
                                {{ $reimbursementReport->obh }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2">
                                <span class="fw-bold text-muted d-block">PROVINSI</span>
                                {{ $reimbursementReport->provinsi }}
                            </p>
                        </div>
                    </div>

                    <div class="row mb-4 pb-3 border-bottom">
                        <div class="col-md-12">
                            <p class="mb-2">
                                <span class="fw-bold text-muted d-block">ALAMAT</span>
                                {{ $reimbursementReport->alamat }}
                            </p>
                        </div>
                    </div>

                    <!-- Activity Details -->
                    <div class="row mb-4 pb-3 border-bottom">
                        <div class="col-md-6">
                            <p class="mb-3">
                                <span class="fw-bold text-muted d-block">KEGIATAN</span>
                                <span class="badge bg-info text-white">{{ $reimbursementReport->kegiatan }}</span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-3">
                                <span class="fw-bold text-muted d-block">TGL PELAKSANAAN</span>
                                {{ $reimbursementReport->tgl_pelaksanaan->format('d M Y') }}
                            </p>
                        </div>
                    </div>

                    <!-- Dynamic Fields -->
                    @if($reimbursementReport->penerima_bantuan)
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-2">
                                <span class="fw-bold text-muted d-block">PENERIMA BANTUAN</span>
                                {{ $reimbursementReport->penerima_bantuan }}
                            </p>
                        </div>
                    </div>
                    @endif

                    @if($reimbursementReport->tempat_pelaksanaan)
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-2">
                                <span class="fw-bold text-muted d-block">TEMPAT PELAKSANAAN</span>
                                {{ $reimbursementReport->tempat_pelaksanaan }}
                            </p>
                        </div>
                    </div>
                    @endif

                    @if($reimbursementReport->materi)
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-2">
                                <span class="fw-bold text-muted d-block">MATERI</span>
                                {{ $reimbursementReport->materi }}
                            </p>
                        </div>
                    </div>
                    @endif

                    @if($reimbursementReport->narasumber)
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-2">
                                <span class="fw-bold text-muted d-block">NARASUMBER</span>
                                {{ $reimbursementReport->narasumber }}
                            </p>
                        </div>
                    </div>
                    @endif

                    @if($reimbursementReport->kasus)
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-2">
                                <span class="fw-bold text-muted d-block">KASUS</span>
                                {{ $reimbursementReport->kasus }}
                            </p>
                        </div>
                    </div>
                    @endif

                    <!-- Checklist Section -->
                    @if($reimbursementReport->checklist_data && count($reimbursementReport->checklist_data) > 0)
                    @php
                        $isTableChecklist = false;
                        foreach ($reimbursementReport->checklist_data as $item) {
                            if (is_array($item) && (isset($item['obh']) || isset($item['kanwil']) || isset($item['bphn']))) {
                                $isTableChecklist = true;
                                break;
                            }
                        }
                        $renderCheck = function ($item, $col) {
                            return isset($item[$col]) && $item[$col] ? '☑' : '☒';
                        };
                    @endphp
                    <div class="mb-4 pt-3 border-top">
                        <h6 class="fw-bold mb-3">
                            <i class="fa-solid fa-list-check me-2"></i>BERKAS / DOKUMEN
                        </h6>
                        @if($isTableChecklist)
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle">
                                    <thead>
                                        <tr class="text-center align-middle" style="background-color: var(--bs-secondary-bg) !important;">
                                            <th style="width: 50px;">NO</th>
                                            <th>BERKAS</th>
                                            <th style="width: 80px;">OBH</th>
                                            <th style="width: 80px;">KANWIL</th>
                                            <th style="width: 80px;">BPHN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($reimbursementReport->checklist_data as $key => $item)
                                            @if(is_array($item) && isset($item['label']))
                                                <tr>
                                                    <td class="text-center fw-bold">{{ preg_match('/^item(\d+)(_\d+)?$/', $key, $matches) ? $matches[1] . (isset($matches[2]) ? $matches[2] : '') : $loop->iteration }}</td>
                                                    <td>{{ $item['label'] }}</td>
                                                    <td class="text-center">{{ $renderCheck($item, 'obh') }}</td>
                                                    <td class="text-center">{{ $renderCheck($item, 'kanwil') }}</td>
                                                    <td class="text-center">{{ $renderCheck($item, 'bphn') }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="row">
                                @foreach($reimbursementReport->checklist_data as $item => $checked)
                                    <div class="col-md-6 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" {{ $checked ? 'checked' : '' }} disabled>
                                            <label class="form-check-label">
                                                {{ $item }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    @endif

                    <!-- Notes -->
                    @if($reimbursementReport->notes)
                    <div class="alert alert-info">
                        <strong>Catatan:</strong> {{ $reimbursementReport->notes }}
                    </div>
                    @endif
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="card shadow-sm border-0">
                <div class="card-body p-3">
                    <div class="d-flex gap-2 justify-content-end flex-wrap">
                        <a href="{{ route('reimbursement-reports.index') }}" class="btn btn-secondary">
                            <i class="fa-solid fa-arrow-left me-2"></i>Kembali
                        </a>
                        @if($reimbursementReport->status === 'draft')
                        <a href="{{ route('reimbursement-reports.edit', $reimbursementReport) }}" class="btn btn-warning">
                            <i class="fa-solid fa-pen-to-square me-2"></i>Edit
                        </a>
                        @endif
                        @if(auth()->user()->role === 'admin' && $reimbursementReport->status === 'submitted')
                        <form method="POST" action="{{ route('reimbursement-reports.update', $reimbursementReport) }}" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="approved">
                            <button type="submit" class="btn btn-success">
                                <i class="fa-solid fa-check me-2"></i>Setujui
                            </button>
                        </form>
                        <form method="POST" action="{{ route('reimbursement-reports.update', $reimbursementReport) }}" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="rejected">
                            <button type="submit" class="btn btn-danger">
                                <i class="fa-solid fa-times me-2"></i>Tolak
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
