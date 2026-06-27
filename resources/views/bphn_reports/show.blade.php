<x-app-layout>
    <x-slot name="header">Detail Laporan Drafting Dokumen Hukum</x-slot>

    <style>
        /* ── Screen only: hide print-view ─────────────────────────── */
        @media screen { .print-view { display: none; } }

        /* ── Print only ────────────────────────────────────────────── */
        @media print {
            body * { visibility: hidden; }

            .print-view {
                display: block !important;
                visibility: visible !important;
                position: absolute;
                top: 0; left: 0;
                width: 100%;
                box-sizing: border-box;
                padding: 14mm 18mm;
                font-family: Arial, sans-serif;
                font-size: 10pt;
                color: #000;
                background: #fff;
            }
            .print-view * { visibility: visible !important; }

            .pv-title {
                text-align: center;
                font-weight: bold;
                font-size: 12pt;
                text-decoration: underline;
                text-transform: uppercase;
                margin-bottom: 18px;
            }

            .pv-group { margin-bottom: 6px; }
            .pv-row {
                display: flex;
                align-items: flex-end;
                margin-bottom: 6px;
                line-height: 1.2;
            }
            .pv-label {
                flex-shrink: 0;
                text-transform: uppercase;
                white-space: nowrap;
            }
            .pv-sep { flex-shrink: 0; padding: 0 5px; white-space: nowrap; }
            .pv-val {
                flex: 1;
                min-width: 0;
                border-bottom: 1px dotted #000;
                padding-left: 3px;
                word-break: break-word;
            }
            .pv-val-fixed { flex: 1; font-weight: bold; padding-left: 3px; }

            .pv-g1 .pv-label { min-width: 32mm; }
            .pv-g2 .pv-label { min-width: 72mm; }

            .pv-gap { height: 10px; }

            .pv-table {
                width: 100%;
                border-collapse: collapse;
                margin: 18px 0 14px 0;
                font-size: 9pt;
            }
            .pv-table th, .pv-table td { border: 1px solid #000 !important; padding: 4px 8px; }
            .pv-table thead th {
                background: #d0d0d0 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                text-align: center;
                font-weight: bold;
                text-transform: uppercase;
            }
            .pv-table td.no-col  { text-align: center; font-weight: bold; width: 46px; }
            .pv-table td.chk-col { text-align: center; width: 68px; }
            .pv-table th.chk-th  { width: 68px; }
            .pv-table th.no-th   { width: 46px; }

            .pv-chk {
                display: inline-block;
                width: 14px; height: 14px;
                border: 1px solid #000;
                text-align: center;
                line-height: 14px;
                font-size: 10pt;
                font-weight: bold;
            }

            .pv-keterangan { font-size: 9pt; margin-top: 10px; line-height: 1.5; }
            .pv-keterangan .pv-ket-title { font-weight: bold; margin-bottom: 3px; }
        }

        /* ── Screen styles ──────────────────────────────────────────── */
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
                        CHECK LIST BERKAS LAPORAN DRAFTING DOKUMEN HUKUM
                    </h5>
                </div>

                <div class="card-body p-0" style="font-size:0.95rem;">
                    <div class="d-flex mb-1">
                        <div class="fw-bold form-preview-label">OBH</div>
                        <div>: {{ $draftingReport->obh }}</div>
                    </div>
                    <div class="d-flex mb-1">
                        <div class="fw-bold form-preview-label">ALAMAT</div>
                        <div>: {{ $draftingReport->alamat }}</div>
                    </div>
                    <div class="d-flex mb-4">
                        <div class="fw-bold form-preview-label">PROVINSI</div>
                        <div>: {{ $draftingReport->provinsi }}</div>
                    </div>

                    <div class="d-flex mb-1">
                        <div class="fw-bold form-preview-label">KEGIATAN</div>
                        <div class="text-uppercase">: {{ $draftingReport->kegiatan }}</div>
                    </div>
                    <div class="d-flex mb-1">
                        <div class="fw-bold form-preview-label">TGL PELAKSANAAN KEGIATAN</div>
                        <div>: {{ $draftingReport->tgl_pelaksanaan->format('d M Y') }}</div>
                    </div>
                    <div class="d-flex mb-1">
                        <div class="fw-bold form-preview-label">KASUS</div>
                        <div>: {{ $draftingReport->kasus }}</div>
                    </div>
                    <div class="d-flex mb-1">
                        <div class="fw-bold form-preview-label">PENERIMA BANTUAN HUKUM</div>
                        <div class="w-100">: {{ $draftingReport->penerima_bantuan }}
                            <span class="float-end pe-5"><strong>L/P:</strong> {{ $draftingReport->jk_penerima }}</span>
                        </div>
                    </div>
                    <div class="d-flex mb-4">
                        <div class="fw-bold form-preview-label">NAMA DRAFTER</div>
                        <div>: {{ $draftingReport->nama_drafter }}</div>
                    </div>

                    @php
                        $d = $draftingReport->checklist_data ?? [];
                        $berkas_list = [
                            '1' => 'Formulir permohonan bantuan hukum',
                            '2' => 'SKTM Asli/ Legalisir Kartu JAMKESMAS/Kartu GAKIN/BLSM, dll.',
                            '3' => 'Dokumen hasil drafting (ditandatangani para pihak)',
                            '4' => 'Laporan pelaksanaan drafting dokumen hukum',
                            '5' => 'Kuitansi:',
                        ];
                        $get_check = function($arr, $idx, $col) {
                            return isset($arr[$idx][$col]) && $arr[$idx][$col] == '1' ? 'v' : '&nbsp;';
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
                                @if($idx != 5)
                                    <td class="text-center"><span class="checklist-square">{!! $get_check($d, $idx, 'obh') !!}</span></td>
                                    <td class="text-center"><span class="checklist-square">{!! $get_check($d, $idx, 'kanwil') !!}</span></td>
                                    <td class="text-center"><span class="checklist-square">{!! $get_check($d, $idx, 'bphn') !!}</span></td>
                                @else
                                    <td></td><td></td><td></td>
                                @endif
                            </tr>
                            @if($idx == 5)
                            <tr>
                                <td></td>
                                <td class="ps-4 text-muted fw-medium">- Biaya Drafter (diberi stempel OBH)</td>
                                <td class="text-center"><span class="checklist-square">{!! $get_check($d, '5_1', 'obh') !!}</span></td>
                                <td class="text-center"><span class="checklist-square">{!! $get_check($d, '5_1', 'kanwil') !!}</span></td>
                                <td class="text-center"><span class="checklist-square">{!! $get_check($d, '5_1', 'bphn') !!}</span></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="ps-4 text-muted fw-medium">- Biaya penggandaan dan penjilidan laporan akhir</td>
                                <td class="text-center"><span class="checklist-square">{!! $get_check($d, '5_2', 'obh') !!}</span></td>
                                <td class="text-center"><span class="checklist-square">{!! $get_check($d, '5_2', 'kanwil') !!}</span></td>
                                <td class="text-center"><span class="checklist-square">{!! $get_check($d, '5_2', 'bphn') !!}</span></td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>

                    <div class="small lh-sm">
                        <strong>KETERANGAN :</strong><br>
                        - Jika <strong>ada</strong> beri tanda (&check;), <strong>tidak ada</strong> biarkan kosong.<br>
                        - Form ini harus dilampirkan diatas dokumen.<br>
                        - Berkas harus disusun berdasarkan urutan nomor.<br>
                        - Drafting Dokumen Hukum diajukan per-paket 1 kasus.<br>
                        - Berkas harus ASLI dan di fotocopy.<br>
                        - Pemegang Kartu BPJS tidak diperkenankan.<br>
                        - Form Pelaksanaan bisa dilihat di Buku Panduan.<br>
                        - Kuitansi biaya penggandaan harus dibubuhi stempel usaha fotokopi ybs. dan melampirkan bon berkop dari usaha ybs.
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mb-4">
                <a href="{{ route('drafting-reports.index') }}" class="btn btn-secondary px-4 fw-bold shadow-sm">Kembali</a>
                <a href="{{ route('drafting-reports.edit', $draftingReport) }}" class="btn btn-warning px-4 fw-bold shadow-sm">
                    <i class="fa-solid fa-pen-to-square me-1"></i> Edit
                </a>
                <button onclick="window.print()" class="btn btn-success px-4 fw-bold shadow-sm">
                    <i class="fa-solid fa-print me-1"></i> Cetak Formulir
                </button>
            </div>
        </div>
    </div>

    {{-- ================================================================ --}}
    {{-- PRINT VIEW                                                         --}}
    {{-- ================================================================ --}}
    <div class="print-view">

        <div class="pv-title">Check List Berkas Reimbursement Non Litigasi</div>

        {{-- Grup 1 --}}
        <div class="pv-group pv-g1">
            <div class="pv-row">
                <span class="pv-label">OBH</span>
                <span class="pv-sep">:</span>
                <span class="pv-val">{{ $draftingReport->obh }}</span>
            </div>
            <div class="pv-row">
                <span class="pv-label">ALAMAT</span>
                <span class="pv-sep">:</span>
                <span class="pv-val">{{ $draftingReport->alamat }}</span>
            </div>
            <div class="pv-row">
                <span class="pv-label">PROVINSI</span>
                <span class="pv-sep">:</span>
                <span class="pv-val">{{ $draftingReport->provinsi }}</span>
            </div>
        </div>

        <div class="pv-gap"></div>

        {{-- Grup 2 --}}
        <div class="pv-group pv-g2">
            <div class="pv-row">
                <span class="pv-label">KEGIATAN</span>
                <span class="pv-sep">:</span>
                <span class="pv-val-fixed">DRAFTING DOKUMEN HUKUM</span>
            </div>
            <div class="pv-row">
                <span class="pv-label">TGL PELAKSANAAN KEGIATAN</span>
                <span class="pv-sep">:</span>
                <span class="pv-val">{{ $draftingReport->tgl_pelaksanaan->format('d M Y') }}</span>
            </div>
            <div class="pv-row">
                <span class="pv-label">KASUS</span>
                <span class="pv-sep">:</span>
                <span class="pv-val">{{ $draftingReport->kasus }}</span>
            </div>
            <div class="pv-row">
                <span class="pv-label">PENERIMA BANTUAN HUKUM</span>
                <span class="pv-sep">:</span>
                <span class="pv-val" style="display:flex;justify-content:space-between;">
                    <span>{{ $draftingReport->penerima_bantuan }}</span>
                    <strong>L/P : {{ $draftingReport->jk_penerima }}</strong>
                </span>
            </div>
            <div class="pv-row">
                <span class="pv-label">NAMA DRAFTER</span>
                <span class="pv-sep">:</span>
                <span class="pv-val">{{ $draftingReport->nama_drafter }}</span>
            </div>
        </div>

        {{-- Tabel Checklist --}}
        @php
            $pv_d = $draftingReport->checklist_data ?? [];
            $pv_berkas = [
                '1' => 'Formulir permohonan bantuan hukum',
                '2' => 'SKTM Asli/ Legalisir Kartu JAMKESMAS/Kartu GAKIN/BLSM, dll.',
                '3' => 'Dokumen hasil drafting (ditandatangani para pihak)',
                '4' => 'Laporan pelaksanaan drafting dokumen hukum',
                '5' => 'Kuitansi:',
            ];
            $pv_chk = function($arr, $idx, $col) {
                return isset($arr[$idx][$col]) && $arr[$idx][$col] == '1' ? 'v' : '';
            };
        @endphp

        <table class="pv-table">
            <thead>
                <tr>
                    <th class="no-th">NO</th>
                    <th>BERKAS</th>
                    <th class="chk-th">OBH</th>
                    <th class="chk-th">KANWIL</th>
                    <th class="chk-th">BPHN</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pv_berkas as $idx => $label)
                <tr>
                    <td class="no-col">{{ $idx }}.</td>
                    <td>{{ $label }}</td>
                    @if($idx != 5)
                        <td class="chk-col"><span class="pv-chk">{{ $pv_chk($pv_d, $idx, 'obh') }}</span></td>
                        <td class="chk-col"><span class="pv-chk">{{ $pv_chk($pv_d, $idx, 'kanwil') }}</span></td>
                        <td class="chk-col"><span class="pv-chk">{{ $pv_chk($pv_d, $idx, 'bphn') }}</span></td>
                    @else
                        <td></td><td></td><td></td>
                    @endif
                </tr>
                @if($idx == 5)
                <tr>
                    <td></td>
                    <td style="padding-left:20px;">- Biaya Drafter (diberi stempel OBH)</td>
                    <td class="chk-col"><span class="pv-chk">{{ $pv_chk($pv_d, '5_1', 'obh') }}</span></td>
                    <td class="chk-col"><span class="pv-chk">{{ $pv_chk($pv_d, '5_1', 'kanwil') }}</span></td>
                    <td class="chk-col"><span class="pv-chk">{{ $pv_chk($pv_d, '5_1', 'bphn') }}</span></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="padding-left:20px;">- Biaya penggandaan dan penjilidan laporan akhir</td>
                    <td class="chk-col"><span class="pv-chk">{{ $pv_chk($pv_d, '5_2', 'obh') }}</span></td>
                    <td class="chk-col"><span class="pv-chk">{{ $pv_chk($pv_d, '5_2', 'kanwil') }}</span></td>
                    <td class="chk-col"><span class="pv-chk">{{ $pv_chk($pv_d, '5_2', 'bphn') }}</span></td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>

        {{-- KETERANGAN --}}
        <div class="pv-keterangan">
            <div class="pv-ket-title">KETERANGAN :</div>
            - Jika <strong>ada</strong> beri tanda (&#10003;), <strong>tidak ada</strong> biarkan kosong.<br>
            - Form ini harus dilampirkan diatas dokumen.<br>
            - Berkas harus disusun berdasarkan urutan nomor.<br>
            - Drafting Dokumen Hukum diajukan per-paket 1 kasus.<br>
            - Berkas harus ASLI dan di fotocopy.<br>
            - Pemegang Kartu BPJS tidak diperkenankan.<br>
            - Form Pelaksanaan bisa dilihat di Buku Panduan.<br>
            - Kuitansi biaya penggandaan harus dibubuhi stempel usaha fotokopi ybs. dan melampirkan bon berkop dari usaha ybs.
        </div>

    </div>

</x-app-layout>
