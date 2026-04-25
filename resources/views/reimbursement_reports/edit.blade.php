<x-app-layout>
    <x-slot name="header">Edit Laporan Reimbursement</x-slot>

    <div class="row justify-content-center">
        <div class="col-xl-10">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header py-3 bg-primary">
                    <h6 class="m-0 fw-bold text-white">
                        <i class="fa-solid fa-pen-to-square me-2"></i>Edit Check List Berkas Reimbursement
                    </h6>
                </div>
                <div class="card-body p-4 p-md-5">
                    <form method="POST" action="{{ route('reimbursement-reports.update', $reimbursementReport) }}">
                        @csrf
                        @method('PUT')

                        <!-- Top Header fields -->
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-bold">OBH</label>
                            <div class="col-sm-9">
                                <input type="text" name="obh" class="form-control border-secondary border-opacity-50" value="{{ old('obh', $reimbursementReport->obh) }}" required>
                                @error('obh')<span class="text-danger small">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-bold">ALAMAT</label>
                            <div class="col-sm-9">
                                <input type="text" name="alamat" class="form-control border-secondary border-opacity-50" value="{{ old('alamat', $reimbursementReport->alamat) }}" required>
                                @error('alamat')<span class="text-danger small">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label fw-bold">PROVINSI</label>
                            <div class="col-sm-9">
                                <input type="text" name="provinsi" class="form-control border-secondary border-opacity-50" value="{{ old('provinsi', $reimbursementReport->provinsi) }}" required>
                                @error('provinsi')<span class="text-danger small">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <hr class="mb-4">

                        <!-- Jenis Kegiatan (Read-only) -->
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-bold">KEGIATAN</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control border-secondary border-opacity-50" value="{{ $reimbursementReport->kegiatan }}" disabled>
                                <input type="hidden" name="kegiatan" value="{{ $reimbursementReport->kegiatan }}">
                                <small class="text-muted">Jenis kegiatan tidak dapat diubah</small>
                            </div>
                        </div>

                        <!-- Dynamic Fields -->
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-bold">TGL PELAKSANAAN</label>
                            <div class="col-sm-9">
                                <input type="date" name="tgl_pelaksanaan" class="form-control border-secondary border-opacity-50" value="{{ old('tgl_pelaksanaan', $reimbursementReport->tgl_pelaksanaan->format('Y-m-d')) }}" required>
                                @error('tgl_pelaksanaan')<span class="text-danger small">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-bold">PENERIMA BANTUAN</label>
                            <div class="col-sm-9">
                                <input type="text" name="penerima_bantuan" class="form-control border-secondary border-opacity-50" value="{{ old('penerima_bantuan', $reimbursementReport->penerima_bantuan) }}">
                            </div>
                        </div>

                        @if($reimbursementReport->tempat_pelaksanaan || in_array($reimbursementReport->kegiatan, ['Penyuluhan Hukum', 'Pemberdayaan Masyarakat']))
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-bold">TEMPAT PELAKSANAAN</label>
                            <div class="col-sm-9">
                                <input type="text" name="tempat_pelaksanaan" class="form-control border-secondary border-opacity-50" value="{{ old('tempat_pelaksanaan', $reimbursementReport->tempat_pelaksanaan) }}">
                            </div>
                        </div>
                        @endif

                        @if($reimbursementReport->materi || in_array($reimbursementReport->kegiatan, ['Penyuluhan Hukum', 'Pemberdayaan Masyarakat']))
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-bold">MATERI</label>
                            <div class="col-sm-9">
                                <input type="text" name="materi" class="form-control border-secondary border-opacity-50" value="{{ old('materi', $reimbursementReport->materi) }}">
                            </div>
                        </div>
                        @endif

                        @if($reimbursementReport->narasumber || in_array($reimbursementReport->kegiatan, ['Penyuluhan Hukum', 'Pemberdayaan Masyarakat']))
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-bold">NARASUMBER</label>
                            <div class="col-sm-9">
                                <input type="text" name="narasumber" class="form-control border-secondary border-opacity-50" value="{{ old('narasumber', $reimbursementReport->narasumber) }}">
                            </div>
                        </div>
                        @endif

                        @if($reimbursementReport->kasus || in_array($reimbursementReport->kegiatan, ['Mediasi', 'Negosiasi', 'Pendampingan Diluar Pengadilan', 'Litigasi Perdata', 'Litigasi Pidana', 'Litigasi TUN']))
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-bold">KASUS</label>
                            <div class="col-sm-9">
                                <input type="text" name="kasus" class="form-control border-secondary border-opacity-50" value="{{ old('kasus', $reimbursementReport->kasus) }}">
                            </div>
                        </div>
                        @endif

                        <hr class="mb-4">

                        <!-- Checklist Items -->
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">BERKAS / DOKUMEN</h6>
                            <div id="checklist-container">
                                @if($reimbursementReport->checklist_data)
                                    @foreach($reimbursementReport->checklist_data as $item => $checked)
                                    <div class="col-md-6 mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="checklist_items[{{ $loop->index }}]" 
                                                   id="checklist_{{ $loop->index }}" value="{{ $item }}"
                                                   {{ $checked ? 'checked' : '' }}>
                                            <label class="form-check-label" for="checklist_{{ $loop->index }}">
                                                {{ $item }}
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <hr class="mb-4">

                        <!-- Notes -->
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-bold">CATATAN</label>
                            <div class="col-sm-9">
                                <textarea name="notes" class="form-control border-secondary border-opacity-50" rows="3">{{ old('notes', $reimbursementReport->notes) }}</textarea>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <!-- Buttons -->
                        <div class="d-grid gap-2 d-sm-flex justify-content-sm-end">
                            <a href="{{ route('reimbursement-reports.show', $reimbursementReport) }}" class="btn btn-secondary px-4">Batal</a>
                            <button type="submit" class="btn btn-primary px-5 fw-bold">
                                <i class="fa-solid fa-save me-2"></i>Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
