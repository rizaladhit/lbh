<x-app-layout>
    <x-slot name="header">Detail Laporan Perdata</x-slot>

    <style>
        @media screen { .print-view { display: none; } }

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
            .pv-label { flex-shrink: 0; text-transform: uppercase; white-space: nowrap; }
            .pv-sep   { flex-shrink: 0; padding: 0 5px; white-space: nowrap; }
            .pv-val   { flex: 1; min-width: 0; border-bottom: 1px dotted #000; padding-left: 3px; word-break: break-word; }
            .pv-val-fixed { flex: 1; font-weight: bold; padding-left: 3px; }

            .pv-g1 .pv-label { min-width: 32mm; }
            .pv-g2 .pv-label { min-width: 55mm; }

            .pv-gap { height: 10px; }

            .pv-table { width: 100%; border-collapse: collapse; margin: 18px 0 14px 0; font-size: 9.5pt; }
            .pv-table th, .pv-table td { border: 1px solid #000 !important; padding: 4px 8px; }
            .pv-table thead th {
                background: #d0d0d0 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                text-align: center;
                font-weight: bold;
                text-transform: uppercase;
            }
            .pv-table td.no-col  { text-align: center; font-weight: bold; width: 40px; }
            .pv-table td.chk-col { text-align: center; width: 68px; }
            .pv-table th.chk-th  { width: 68px; }
            .pv-table th.no-th   { width: 40px; }

            .pv-chk {
                display: inline-block;
                width: 14px; height: 14px;
                border: 1px solid #000;
                text-align: center;
                line-height: 14px;
                font-size: 10pt;
                font-weight: bold;
            }

            .pv-sub-val { flex: 1; border-bottom: 1px dotted #000; min-width: 0; padding-left: 2px; }

            .pv-keterangan { font-size: 9pt; margin-top: 10px; line-height: 1.5; }
            .pv-keterangan .pv-ket-title { font-weight: bold; margin-bottom: 3px; }
        }

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
                        CHECK LIST BERKAS LAPORAN PERDATA
                    </h5>
                </div>

                <div class="card-body p-0" style="font-size:0.95rem;">
                    <div class="d-flex mb-1">
                        <div class="fw-bold form-preview-label">OBH</div>
                        <div>: {{ $perdataReport->obh }}</div>
                    </div>
                    <div class="d-flex mb-1">
                        <div class="fw-bold form-preview-label">ALAMAT</div>
                        <div>: {{ $perdataReport->alamat }}</div>
                    </div>
                    <div class="d-flex mb-4">
                        <div class="fw-bold form-preview-label">PROVINSI</div>
                        <div>: {{ $perdataReport->provinsi }}</div>
                    </div>

                    <div class="d-flex mb-1">
                        <div class="fw-bold form-preview-label">PERKARA</div>
                        <div class="text-uppercase fw-semibold">: {{ $perdataReport->perkara }}</div>
                    </div>
                    <div class="d-flex mb-1">
                        <div class="fw-bold form-preview-label">KASUS</div>
                        <div>: {{ $perdataReport->kasus ?? '-' }}</div>
                    </div>
                    <div class="d-flex mb-1">
                        <div class="fw-bold form-preview-label">NOMOR PERKARA</div>
                        <div>: {{ $perdataReport->nomor_perkara ?? '-' }}</div>
                    </div>
                    <div class="d-flex mb-4">
                        <div class="fw-bold form-preview-label">PENERIMA BANTUAN HUKUM</div>
                        <div class="w-100">: {{ $perdataReport->penerima_bantuan ?? '-' }}
                            <span class="float-end pe-5"><strong>L/P:</strong> {{ $perdataReport->jk_penerima ?? '-' }}</span>
                        </div>
                    </div>

                    @php
                        $items = [
                            'item1'  => 'Surat Permohonan Bantuan Hukum',
                            'item2'  => 'Surat Kuasa',
                            'item3'  => 'SKTM Asli/ Legalisir Kartu JAMKESMAS/Kartu GAKIN/BLSM',
                            'item4'  => 'Relaas/Bukti Persidangan',
                            'item5'  => 'Pendapat hukum (legal opinion)',
                            'item6'  => 'Somasi',
                            'item7'  => 'Gugatan atau jawaban',
                            'item8'  => 'Tawaran mediasi atau jawaban',
                            'item9'  => 'Replik',
                            'item10' => 'Putusan',
                            'item11' => 'Memori banding atau kontra memori banding (wajib melampirkan putusan sebelumnya)',
                            'item12' => 'Memori kasasi atau kontra memori kasasi (wajib melampirkan putusan sebelumnya)',
                            'item13' => 'Memori peninjauan kembali atau kontra memori peninjauan kembali (wajib melampirkan putusan sebelumnya)',
                            'item14' => 'Dokumen lain yang berkenaan dengan perkara, sebutkan:',
                            'item15' => 'Kuitansi (diberi materai 6000 dan stempel OBH)',
                        ];
                        $item14_sub = ['item14_a' => 'a', 'item14_b' => 'b', 'item14_c' => 'c'];
                        $cl = $perdataReport->checklist_data ?? [];
                        $chk = function($k, $f) use ($cl) { return !empty($cl[$k][$f]) ? 'v' : '&nbsp;'; };
                    @endphp

                    <table class="table table-bordered border-secondary align-middle mb-4">
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
                            @foreach($items as $key => $label)
                            <tr>
                                <td class="text-center fw-bold">{{ substr($key,4) }}.</td>
                                <td class="fw-medium">{{ $label }}</td>
                                @if($key !== 'item14')
                                    <td class="text-center"><span class="checklist-square">{!! $chk($key,'obh') !!}</span></td>
                                    <td class="text-center"><span class="checklist-square">{!! $chk($key,'kanwil') !!}</span></td>
                                    <td class="text-center"><span class="checklist-square">{!! $chk($key,'bphn') !!}</span></td>
                                @else
                                    <td></td><td></td><td></td>
                                @endif
                            </tr>
                            @if($key === 'item14')
                                @foreach($item14_sub as $sk => $letter)
                                <tr>
                                    <td></td>
                                    <td class="ps-3 text-muted">
                                        {{ $letter }}. &nbsp; {{ $cl[$sk]['text'] ?? '' }}
                                    </td>
                                    <td class="text-center"><span class="checklist-square">{!! $chk($sk,'obh') !!}</span></td>
                                    <td class="text-center"><span class="checklist-square">{!! $chk($sk,'kanwil') !!}</span></td>
                                    <td class="text-center"><span class="checklist-square">{!! $chk($sk,'bphn') !!}</span></td>
                                </tr>
                                @endforeach
                            @endif
                            @endforeach
                        </tbody>
                    </table>

                    <div class="small lh-sm">
                        <strong>KETERANGAN :</strong><br>
                        - Jika <strong>ada</strong> beri tanda (&check;), <strong>tidak ada</strong> biarkan kosong.<br>
                        - Form ini harus dilampirkan diatas dokumen.<br>
                        - Berkas harus disusun berdasarkan urutan nomor.<br>
                        - Dokumen dari pengadilan harus <strong>ASLI</strong> atau <strong>LEGALISIR</strong> Pengadilan.<br>
                        - Dokumen yang wajib dilampirkan adalah yang terdapat dalam aplikasi.
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mb-4">
                <a href="{{ route('perdata-reports.index') }}" class="btn btn-secondary px-4 fw-bold shadow-sm">Kembali</a>
                <a href="{{ route('perdata-reports.edit', $perdataReport) }}" class="btn btn-warning px-4 fw-bold shadow-sm">
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

        <div class="pv-title">Check List Berkas Reimbursement Litigasi</div>

        {{-- Grup 1 --}}
        <div class="pv-group pv-g1">
            <div class="pv-row">
                <span class="pv-label">OBH</span>
                <span class="pv-sep">:</span>
                <span class="pv-val">{{ $perdataReport->obh }}</span>
            </div>
            <div class="pv-row">
                <span class="pv-label">ALAMAT</span>
                <span class="pv-sep">:</span>
                <span class="pv-val">{{ $perdataReport->alamat }}</span>
            </div>
            <div class="pv-row">
                <span class="pv-label">PROVINSI</span>
                <span class="pv-sep">:</span>
                <span class="pv-val">{{ $perdataReport->provinsi }}</span>
            </div>
        </div>

        <div class="pv-gap"></div>

        {{-- Grup 2 --}}
        <div class="pv-group pv-g2">
            <div class="pv-row">
                <span class="pv-label">PERKARA</span>
                <span class="pv-sep">:</span>
                <span class="pv-val-fixed">PERDATA</span>
            </div>
            <div class="pv-row">
                <span class="pv-label">KASUS</span>
                <span class="pv-sep">:</span>
                <span class="pv-val">{{ $perdataReport->kasus }}</span>
            </div>
            <div class="pv-row">
                <span class="pv-label">NOMOR PERKARA</span>
                <span class="pv-sep">:</span>
                <span class="pv-val">{{ $perdataReport->nomor_perkara }}</span>
            </div>
            <div class="pv-row">
                <span class="pv-label">PENERIMA BANTUAN HUKUM</span>
                <span class="pv-sep">:</span>
                <span class="pv-val" style="display:flex;justify-content:space-between;">
                    <span>{{ $perdataReport->penerima_bantuan }}</span>
                    <strong>L/P : {{ $perdataReport->jk_penerima }}</strong>
                </span>
            </div>
        </div>

        {{-- Tabel Checklist --}}
        @php
            $pv_items = [
                'item1'  => 'Surat Permohonan Bantuan Hukum',
                'item2'  => 'Surat Kuasa',
                'item3'  => 'SKTM Asli/ Legalisir Kartu JAMKESMAS/Kartu GAKIN/BLSM',
                'item4'  => 'Relaas/Bukti Persidangan',
                'item5'  => 'Pendapat hukum (legal opinion)',
                'item6'  => 'Somasi',
                'item7'  => 'Gugatan atau jawaban',
                'item8'  => 'Tawaran mediasi atau jawaban',
                'item9'  => 'Replik',
                'item10' => 'Putusan',
                'item11' => 'Memori banding atau kontra memori banding (wajib melampirkan putusan sebelumnya)',
                'item12' => 'Memori kasasi atau kontra memori kasasi (wajib melampirkan putusan sebelumnya)',
                'item13' => 'Memori peninjauan kembali atau kontra memori peninjauan kembali (wajib melampirkan putusan sebelumnya)',
                'item14' => 'Dokumen lain yang berkenaan dengan perkara, sebutkan:',
                'item15' => 'Kuitansi (diberi materai 6000 dan stempel OBH)',
            ];
            $pv_item14_sub = ['item14_a' => 'a', 'item14_b' => 'b', 'item14_c' => 'c'];
            $pv_cl = $perdataReport->checklist_data ?? [];
            $pv_chk = function($k, $f) use ($pv_cl) { return !empty($pv_cl[$k][$f]) ? 'v' : ''; };
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
                @foreach($pv_items as $key => $label)
                <tr>
                    <td class="no-col">{{ substr($key,4) }}.</td>
                    <td>{{ $label }}</td>
                    @if($key !== 'item14')
                        <td class="chk-col"><span class="pv-chk">{{ $pv_chk($key,'obh') }}</span></td>
                        <td class="chk-col"><span class="pv-chk">{{ $pv_chk($key,'kanwil') }}</span></td>
                        <td class="chk-col"><span class="pv-chk">{{ $pv_chk($key,'bphn') }}</span></td>
                    @else
                        <td></td><td></td><td></td>
                    @endif
                </tr>
                @if($key === 'item14')
                    @foreach($pv_item14_sub as $sk => $letter)
                    <tr>
                        <td></td>
                        <td>
                            <div style="display:flex;align-items:flex-end;gap:4px;">
                                <span style="flex-shrink:0;">{{ $letter }}.</span>
                                <span class="pv-sub-val">{{ $pv_cl[$sk]['text'] ?? '' }}</span>
                            </div>
                        </td>
                        <td class="chk-col"><span class="pv-chk">{{ $pv_chk($sk,'obh') }}</span></td>
                        <td class="chk-col"><span class="pv-chk">{{ $pv_chk($sk,'kanwil') }}</span></td>
                        <td class="chk-col"><span class="pv-chk">{{ $pv_chk($sk,'bphn') }}</span></td>
                    </tr>
                    @endforeach
                @endif
                @endforeach
            </tbody>
        </table>

        <div class="pv-keterangan">
            <div class="pv-ket-title">KETERANGAN :</div>
            - Jika <strong>ada</strong> beri tanda (&#10003;), <strong>tidak ada</strong> beri tanda (&#10007;).<br>
            - Form ini harus dilampirkan diatas dokumen.<br>
            - Berkas harus disusun berdasarkan urutan nomor.<br>
            - Dokumen dari pengadilan harus <strong>ASLI</strong> atau <strong>LEGALISIR</strong> Pengadilan.<br>
            - Dokumen yang wajib dilampirkan adalah yang terdapat dalam aplikasi.
        </div>

    </div>

</x-app-layout>
