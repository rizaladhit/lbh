<x-app-layout>
    <x-slot name="header">Detail Laporan Investigasi Kasus</x-slot>

    <style>
        .checklist-square { width: 18px; height: 18px; display: inline-flex; justify-content: center; align-items: center; border: 1px solid currentColor; font-weight: bold; font-family: monospace; font-size: 14px; }
        .form-preview-label { width: 240px; flex-shrink: 0; }
        .form-preview-label-sm { width: 220px; flex-shrink: 0; }
    </style>

    @php
        $sub_items = [
            0 => ['item4_1' => 'Biaya Investigator (diberi stempel OBH)'],
            1 => ['item4_1' => 'Biaya Investigator (diberi stempel OBH)'],
            2 => ['item4_1' => 'Biaya Investigator (diberi stempel OBH)'],
            3 => ['item4_1' => 'Biaya Investigator'],
            4 => ['item4_1' => 'Biaya Investigator (diberi stempel OBH)', 'item4_2' => 'Biaya Penggandaan laporan Akhir'],
        ];
        $secs = $investigasiKasusReport->sections ?? [];
    @endphp

    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card shadow-md border-0 mb-4 p-4 p-md-5">

                <div class="card-header bg-transparent border-0 mb-4 pb-0 text-center">
                    <h5 class="fw-bold text-uppercase d-inline-block text-decoration-underline" style="text-underline-offset:4px;">
                        CHECK LIST BERKAS LAPORAN INVESTIGASI KASUS
                    </h5>
                </div>

                <div class="card-body p-0" style="font-size:0.95rem;">
                    <div class="d-flex mb-1"><div class="fw-bold form-preview-label">OBH</div><div>: {{ $investigasiKasusReport->obh }}</div></div>
                    <div class="d-flex mb-1"><div class="fw-bold form-preview-label">ALAMAT</div><div>: {{ $investigasiKasusReport->alamat }}</div></div>
                    <div class="d-flex mb-3"><div class="fw-bold form-preview-label">PROVINSI</div><div>: {{ $investigasiKasusReport->provinsi }}</div></div>
                    <div class="d-flex mb-4"><div class="fw-bold form-preview-label">KEGIATAN</div><div class="text-uppercase fw-semibold text-primary">: {{ $investigasiKasusReport->kegiatan }}</div></div>

                    @for($i = 0; $i < 5; $i++)
                    @php
                        $sec = $secs[$i] ?? [];
                        $cl  = $sec['checklist'] ?? [];
                        $chk = function($k, $f) use ($cl) { return !empty($cl[$k][$f]) ? 'v' : '&nbsp;'; };
                    @endphp
                    <div class="border rounded p-3 mb-4" style="background: var(--bs-secondary-bg);">
                        <div class="d-flex mb-1"><div class="fw-bold form-preview-label-sm" style="font-size:.88rem;">JENIS KEGIATAN INVESTIGASI</div><div>: {{ $sec['jenis_investigasi'] ?? '-' }}</div></div>
                        <div class="d-flex mb-1"><div class="fw-bold form-preview-label-sm" style="font-size:.88rem;">TGL PELAKSANAAN KEGIATAN</div><div>: {{ !empty($sec['tgl_pelaksanaan']) ? \Carbon\Carbon::parse($sec['tgl_pelaksanaan'])->translatedFormat('d F Y') : '-' }}</div></div>
                        <div class="d-flex mb-1">
                            <div class="fw-bold form-preview-label-sm" style="font-size:.88rem;">PENERIMA BANTUAN HUKUM</div>
                            <div class="w-100">: {{ $sec['penerima_bantuan'] ?? '-' }}
                                <span class="float-end pe-5"><strong>L/P:</strong> {{ $sec['jk_penerima'] ?? '-' }}</span>
                            </div>
                        </div>
                        <div class="d-flex mb-3"><div class="fw-bold form-preview-label-sm" style="font-size:.88rem;">NAMA INVESTIGATOR</div><div>: {{ $sec['nama_investigator'] ?? '-' }}</div></div>

                        <table class="table table-bordered border-secondary align-middle mb-0" style="font-size:.88rem;">
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
                                <tr>
                                    <td class="text-center fw-bold">1.</td>
                                    <td class="fw-medium">SKTM Asli/ Legalisir Kartu JAMKESMAS/Kartu GAKIN/BLSM, dll.</td>
                                    <td class="text-center"><span class="checklist-square">{!! $chk('item1','obh') !!}</span></td>
                                    <td class="text-center"><span class="checklist-square">{!! $chk('item1','kanwil') !!}</span></td>
                                    <td class="text-center"><span class="checklist-square">{!! $chk('item1','bphn') !!}</span></td>
                                </tr>
                                <tr>
                                    <td class="text-center fw-bold">2.</td>
                                    <td class="fw-medium">Formulir investigasi kasus yang sudah diisi lengkap</td>
                                    <td class="text-center"><span class="checklist-square">{!! $chk('item2','obh') !!}</span></td>
                                    <td class="text-center"><span class="checklist-square">{!! $chk('item2','kanwil') !!}</span></td>
                                    <td class="text-center"><span class="checklist-square">{!! $chk('item2','bphn') !!}</span></td>
                                </tr>
                                <tr>
                                    <td class="text-center fw-bold">3.</td>
                                    <td class="fw-medium">Laporan hasil investigasi kasus</td>
                                    <td class="text-center"><span class="checklist-square">{!! $chk('item3','obh') !!}</span></td>
                                    <td class="text-center"><span class="checklist-square">{!! $chk('item3','kanwil') !!}</span></td>
                                    <td class="text-center"><span class="checklist-square">{!! $chk('item3','bphn') !!}</span></td>
                                </tr>
                                <tr>
                                    <td class="text-center fw-bold">4.</td>
                                    <td class="fw-medium">Kuitansi:</td>
                                    <td></td><td></td><td></td>
                                </tr>
                                @foreach($sub_items[$i] as $sk => $slabel)
                                <tr>
                                    <td></td>
                                    <td class="ps-4 text-muted fw-medium">- {{ $slabel }}</td>
                                    <td class="text-center"><span class="checklist-square">{!! $chk($sk,'obh') !!}</span></td>
                                    <td class="text-center"><span class="checklist-square">{!! $chk($sk,'kanwil') !!}</span></td>
                                    <td class="text-center"><span class="checklist-square">{!! $chk($sk,'bphn') !!}</span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endfor

                    <div class="small lh-sm">
                        <strong>KETERANGAN :</strong><br>
                        - Jika <strong>ada</strong> beri tanda (&check;), <strong>tidak ada</strong> beri tanda (&cross;).<br>
                        - Form ini harus dilampirkan diatas dokumen.<br>
                        - Berkas harus disusun berdasarkan urutan nomor.<br>
                        - Investigasi diajukan per-paket 5 kasus.<br>
                        - Berkas harus <strong>ASLI</strong> dan di <em>fotocopy</em>.<br>
                        - Kartu BPJS tidak diperkenankan.<br>
                        - Form investigasi bisa dilihat di Buku Panduan Implementasi Undang-Undang Nomor 16 Tahun 2011 Tentang Bantuan Hukum.<br>
                        - Kuitansi biaya penggandaan harus dibubuhi stempel usaha fotokopi ybs. dan melampirkan bon berkop dari usaha ybs.
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mb-4">
                <a href="{{ route('investigasi-kasus-reports.index') }}" class="btn btn-secondary px-4 fw-bold shadow-sm">Kembali</a>
                <a href="{{ route('investigasi-kasus-reports.edit', $investigasiKasusReport) }}" class="btn btn-warning px-4 fw-bold shadow-sm">
                    <i class="fa-solid fa-pen-to-square me-1"></i> Edit
                </a>
                <a href="{{ route('investigasi-kasus-reports.print', $investigasiKasusReport) }}" target="_blank" class="btn btn-success px-4 fw-bold shadow-sm">
                    <i class="fa-solid fa-print me-1"></i> Cetak Formulir
                </a>
            </div>
        </div>
    </div>

</x-app-layout>
