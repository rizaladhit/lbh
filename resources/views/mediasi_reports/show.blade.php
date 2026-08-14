<x-app-layout>
    <x-slot name="header">Detail Laporan Mediasi</x-slot>

    <style>
        .checklist-square { width: 18px; height: 18px; display: inline-flex; justify-content: center; align-items: center; border: 1px solid currentColor; font-weight: bold; font-family: monospace; font-size: 14px; }
        .form-preview-label { width: 220px; flex-shrink: 0; }
    </style>

    {{-- ================================================================ --}}
    {{-- SCREEN VIEW                                                        --}}
    {{-- ================================================================ --}}
    <div class="d-print-none row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-md border-0 mb-4 p-4 p-md-5">

                <div class="card-header bg-transparent border-0 mb-4 pb-0 text-center">
                    <h5 class="fw-bold text-uppercase d-inline-block text-decoration-underline" style="text-underline-offset:4px;">
                        CHECK LIST BERKAS LAPORAN MEDIASI
                    </h5>
                </div>

                <div class="card-body p-0" style="font-size:0.95rem;">
                    <div class="d-flex mb-1">
                        <div class="fw-bold form-preview-label">OBH</div>
                        <div>: {{ $mediasiReport->obh }}</div>
                    </div>
                    <div class="d-flex mb-1">
                        <div class="fw-bold form-preview-label">ALAMAT</div>
                        <div>: {{ $mediasiReport->alamat }}</div>
                    </div>
                    <div class="d-flex mb-4">
                        <div class="fw-bold form-preview-label">PROVINSI</div>
                        <div>: {{ $mediasiReport->provinsi }}</div>
                    </div>

                    <div class="d-flex mb-1">
                        <div class="fw-bold form-preview-label">KEGIATAN</div>
                        <div class="text-uppercase">: {{ $mediasiReport->kegiatan }}</div>
                    </div>
                    <div class="d-flex mb-1">
                        <div class="fw-bold form-preview-label">TGL PELAKSANAAN KEGIATAN</div>
                        <div>: {{ $mediasiReport->tgl_pelaksanaan->format('d M Y') }}</div>
                    </div>
                    <div class="d-flex mb-1">
                        <div class="fw-bold form-preview-label">KASUS</div>
                        <div>: {{ $mediasiReport->kasus }}</div>
                    </div>
                    <div class="d-flex mb-1">
                        <div class="fw-bold form-preview-label">PENERIMA BANTUAN HUKUM</div>
                        <div class="w-100">: {{ $mediasiReport->penerima_bantuan }}
                            <span class="float-end pe-5"><strong>L/P:</strong> {{ $mediasiReport->jk_penerima }}</span>
                        </div>
                    </div>
                    <div class="d-flex mb-4">
                        <div class="fw-bold form-preview-label">NAMA MEDIATOR</div>
                        <div>: {{ $mediasiReport->nama_mediator }}</div>
                    </div>

                    @php
                        $berkas_list = [
                            '1' => 'Formulir permohonan bantuan hukum',
                            '2' => 'SKTM Asli/ Legalisir Kartu JAMKESMAS/Kartu GAKIN/BLSM, dll.',
                            '3' => 'Berita acara mediasi (ditandatangani para pihak)',
                            '4' => 'Laporan mediasi',
                            '5' => 'Kuitansi: Biaya Mediator (diberi stempel OBH)',
                            '6' => 'Kuitansi: Biaya penggandaan dan penjilidan laporan akhir',
                        ];
                        $checklist_data = $mediasiReport->checklist_data ?? [];
                        $get_check = function($idx, $field) use ($checklist_data) {
                            return isset($checklist_data[$idx][$field]) && $checklist_data[$idx][$field] ? 'v' : '&nbsp;';
                        };
                    @endphp

                    <table class="table table-bordered border-secondary align-middle mb-4" style="font-size:.88rem;">
                        <thead>
                            <tr class="text-center align-middle" style="background-color: var(--bs-tertiary-bg) !important;">
                                <th style="width:50px;">NO</th>
                                <th>BERKAS</th>
                                <th style="width:80px;">OBH</th>
                                <th style="width:80px;">KANWIL</th>
                                <th style="width:80px;">BPHN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($berkas_list as $idx => $label)
                            <tr>
                                <td class="text-center fw-bold">{{ $idx }}.</td>
                                <td class="fw-medium">{{ $label }}</td>
                                <td class="text-center"><span class="checklist-square">{!! $get_check($idx, 'obh') !!}</span></td>
                                <td class="text-center"><span class="checklist-square">{!! $get_check($idx, 'kanwil') !!}</span></td>
                                <td class="text-center"><span class="checklist-square">{!! $get_check($idx, 'bphn') !!}</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="small lh-sm">
                        <strong>KETERANGAN :</strong><br>
                        - Jika <strong>ada</strong> beri tanda (&check;), <strong>tidak ada</strong> biarkan kosong.<br>
                        - Form ini harus dilampirkan di atas dokumen.<br>
                        - Berkas harus disusun berdasarkan urutan nomor.<br>
                        - Kuitansi biaya mediator harus diberi stempel OBH.<br>
                        - Berkas harus ASLI dan difotokopi.<br>
                        - Semua dokumen pendukung wajib dilengkapi sebelum diserahkan.
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mb-4">
                <a href="{{ route('mediasi-reports.index') }}" class="btn btn-secondary px-4 fw-bold shadow-sm">Kembali</a>
                <a href="{{ route('mediasi-reports.edit', $mediasiReport) }}" class="btn btn-warning px-4 fw-bold shadow-sm">
                    <i class="fa-solid fa-pen-to-square me-1"></i> Edit
                </a>
                <a href="{{ route('mediasi-reports.print', $mediasiReport) }}" class="btn btn-success px-4 fw-bold shadow-sm">
                    <i class="fa-solid fa-print me-1"></i> Cetak Formulir
                </a>
            </div>
        </div>
    </div>

</x-app-layout>
