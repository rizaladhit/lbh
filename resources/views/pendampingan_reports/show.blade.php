<x-app-layout>
    <x-slot name="header">Detail Laporan Pendampingan Diluar Pengadilan</x-slot>

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

            /* Field rows — flexbox */
            .pv-group { margin-bottom: 6px; }
            .pv-row {
                display: flex;
                align-items: flex-end;
                margin-bottom: 6px;
                line-height: 1.2;
            }
            .pv-row-top { align-items: flex-start; }
            .pv-label {
                flex-shrink: 0;
                text-transform: uppercase;
                white-space: nowrap;
            }
            .pv-sep {
                flex-shrink: 0;
                padding: 0 5px;
                white-space: nowrap;
            }
            .pv-val {
                flex: 1;
                min-width: 0;
                border-bottom: 1px dotted #000;
                padding-left: 3px;
                word-break: break-word;
            }
            .pv-val-fixed { flex: 1; font-weight: bold; padding-left: 3px; }
            .pv-val-block { flex: 1; min-width: 0; padding-left: 3px; }

            /* Lebar label per grup */
            .pv-g1 .pv-label { min-width: 32mm; }
            .pv-g2 .pv-label { min-width: 72mm; }

            .pv-gap { height: 10px; }

            /* Sub-date rows (inside TGL PELAKSANAAN) */
            .pv-date-row {
                display: flex;
                align-items: flex-end;
                margin-bottom: 5px;
                padding-left: 6mm;
            }
            .pv-date-label { flex-shrink: 0; white-space: nowrap; padding-right: 4px; }
            .pv-date-val   { flex: 1; border-bottom: 1px dotted #000; min-width: 0; padding-left: 3px; }

            /* Checklist table */
            .pv-table {
                width: 100%;
                border-collapse: collapse;
                margin: 18px 0 14px 0;
                font-size: 9.5pt;
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

        /* ── Screen card styles ─────────────────────────────────────── */
        .checklist-square { width: 18px; height: 18px; display: inline-flex; justify-content: center; align-items: center; border: 1px solid currentColor; font-weight: bold; font-family: monospace; font-size: 14px; }
        .form-preview-label { width: 220px; flex-shrink: 0; }
    </style>

    {{-- ================================================================ --}}
    {{-- SCREEN VIEW — style sama dengan /mediasi-reports & /negosiasi     --}}
    {{-- ================================================================ --}}
    <div class="d-print-none row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-md border-0 mb-4 p-4 p-md-5">

                <div class="card-header bg-transparent border-0 mb-4 pb-0 text-center">
                    <h5 class="fw-bold text-uppercase d-inline-block text-decoration-underline" style="text-underline-offset:4px;">
                        CHECK LIST BERKAS LAPORAN PENDAMPINGAN DILUAR PENGADILAN
                    </h5>
                </div>

                <div class="card-body p-0" style="font-size:0.95rem;">
                    <div class="d-flex mb-1">
                        <div class="fw-bold form-preview-label">OBH</div>
                        <div>: {{ $pendampinganReport->obh }}</div>
                    </div>
                    <div class="d-flex mb-1">
                        <div class="fw-bold form-preview-label">ALAMAT</div>
                        <div>: {{ $pendampinganReport->alamat }}</div>
                    </div>
                    <div class="d-flex mb-4">
                        <div class="fw-bold form-preview-label">PROVINSI</div>
                        <div>: {{ $pendampinganReport->provinsi }}</div>
                    </div>

                    <div class="d-flex mb-1">
                        <div class="fw-bold form-preview-label">KEGIATAN</div>
                        <div class="text-uppercase">: {{ $pendampinganReport->kegiatan }}</div>
                    </div>
                    <div class="d-flex mb-1">
                        <div class="fw-bold form-preview-label">KASUS</div>
                        <div>: {{ $pendampinganReport->kasus }}</div>
                    </div>
                    <div class="d-flex mb-1">
                        <div class="fw-bold form-preview-label">TGL PELAKSANAAN KEGIATAN</div>
                        <div>
                            <div>A. Pendampingan I: {{ $pendampinganReport->tgl_pendampingan_1?->format('d M Y') ?? '-' }}</div>
                            <div>B. Pendampingan II: {{ $pendampinganReport->tgl_pendampingan_2?->format('d M Y') ?? '-' }}</div>
                            <div>C. Pendampingan III: {{ $pendampinganReport->tgl_pendampingan_3?->format('d M Y') ?? '-' }}</div>
                            <div>D. Pendampingan IV: {{ $pendampinganReport->tgl_pendampingan_4?->format('d M Y') ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="d-flex mb-4">
                        <div class="fw-bold form-preview-label">PENERIMA BANTUAN HUKUM</div>
                        <div class="w-100">: {{ $pendampinganReport->penerima_bantuan }}
                            <span class="float-end pe-5"><strong>L/P:</strong> {{ $pendampinganReport->jk_penerima }}</span>
                        </div>
                    </div>

                    @php
                        $items = [
                            'item1' => 'Surat permohonan bantuan hukum',
                            'item2' => 'SKTM Asli/ Legalisir Kartu JAMKESMAS/Kartu GAKIN/BLSM, dll.',
                            'item3' => 'Berita Acara Pendampingan di luar pengadilan (ditandatangani oleh Penerima dan Pemberi Bantuan Hukum):',
                            'item4' => 'Laporan Pendampingan',
                            'item5' => 'Kuitansi:',
                        ];
                        $item3_sub = ['item3_a'=>'A. Pendampingan I','item3_b'=>'B. Pendampingan II','item3_c'=>'C. Pendampingan III','item3_d'=>'D. Pendampingan IV'];
                        $item5_sub = ['item5_1'=>'Pendampingan terhadap saksi dan/atau korban tindak pidana','item5_2'=>'Biaya penggandaan dan penjilidan laporan akhir'];
                        $cl = $pendampinganReport->checklist_data ?? [];
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
                                @if(!in_array($key,['item3','item5']))
                                    <td class="text-center"><span class="checklist-square">{!! $chk($key,'obh') !!}</span></td>
                                    <td class="text-center"><span class="checklist-square">{!! $chk($key,'kanwil') !!}</span></td>
                                    <td class="text-center"><span class="checklist-square">{!! $chk($key,'bphn') !!}</span></td>
                                @else
                                    <td></td><td></td><td></td>
                                @endif
                            </tr>
                            @if($key === 'item3')
                                @foreach($item3_sub as $sk => $sl)
                                <tr>
                                    <td></td>
                                    <td class="ps-4 text-muted">{{ $sl }}</td>
                                    <td class="text-center"><span class="checklist-square">{!! $chk($sk,'obh') !!}</span></td>
                                    <td class="text-center"><span class="checklist-square">{!! $chk($sk,'kanwil') !!}</span></td>
                                    <td class="text-center"><span class="checklist-square">{!! $chk($sk,'bphn') !!}</span></td>
                                </tr>
                                @endforeach
                            @endif
                            @if($key === 'item5')
                                @foreach($item5_sub as $sk => $sl)
                                <tr>
                                    <td></td>
                                    <td class="ps-4 text-muted">- {{ $sl }}</td>
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
                        - Pendampingan di luar pengadilan dilakukan paling sedikit empat kali untuk waktu paling lama dua bulan.<br>
                        - Setiap kegiatan pendampingan di luar Pengadilan dibuat berita acara yang ditandatangani oleh Penerima dan Pemberi Bantuan Hukum.<br>
                        - Berkas harus ASLI dan difotokopi.<br>
                        - Kartu BPJS tidak diperkenankan.
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mb-4">
                <a href="{{ route('pendampingan-reports.index') }}" class="btn btn-secondary px-4 fw-bold shadow-sm">Kembali</a>
                <button onclick="window.print()" class="btn btn-success px-4 fw-bold shadow-sm">
                    <i class="fa-solid fa-print me-1"></i> Cetak Formulir
                </button>
            </div>
        </div>
    </div>

    {{-- ================================================================ --}}
    {{-- PRINT VIEW — layout dokumen sesuai gambar                         --}}
    {{-- ================================================================ --}}
    <div class="print-view">

        <div class="pv-title">Check List Berkas Reimbursement Non Litigasi</div>

        {{-- Grup 1: OBH, ALAMAT, PROVINSI --}}
        <div class="pv-group pv-g1">
            <div class="pv-row">
                <span class="pv-label">OBH</span>
                <span class="pv-sep">:</span>
                <span class="pv-val">{{ $pendampinganReport->obh }}</span>
            </div>
            <div class="pv-row">
                <span class="pv-label">ALAMAT</span>
                <span class="pv-sep">:</span>
                <span class="pv-val">{{ $pendampinganReport->alamat }}</span>
            </div>
            <div class="pv-row">
                <span class="pv-label">PROVINSI</span>
                <span class="pv-sep">:</span>
                <span class="pv-val">{{ $pendampinganReport->provinsi }}</span>
            </div>
        </div>

        <div class="pv-gap"></div>

        {{-- Grup 2: KEGIATAN, KASUS, TGL (4 sub-dates), PENERIMA --}}
        <div class="pv-group pv-g2">
            <div class="pv-row">
                <span class="pv-label">KEGIATAN</span>
                <span class="pv-sep">:</span>
                <span class="pv-val-fixed">PENDAMPINGAN DILUAR PENGADILAN</span>
            </div>
            <div class="pv-row">
                <span class="pv-label">KASUS</span>
                <span class="pv-sep">:</span>
                <span class="pv-val">{{ $pendampinganReport->kasus }}</span>
            </div>
            {{-- TGL PELAKSANAAN — multi-baris --}}
            <div class="pv-row pv-row-top">
                <span class="pv-label">TGL PELAKSANAAN KEGIATAN</span>
                <span class="pv-sep">:</span>
                <div class="pv-val-block">
                    <div class="pv-date-row">
                        <span class="pv-date-label">A. &nbsp; Pendampingan I: &nbsp; tanggal</span>
                        <span class="pv-date-val">{{ $pendampinganReport->tgl_pendampingan_1?->format('d M Y') }}</span>
                    </div>
                    <div class="pv-date-row">
                        <span class="pv-date-label">B. &nbsp; Pendampingan II: &nbsp; tanggal</span>
                        <span class="pv-date-val">{{ $pendampinganReport->tgl_pendampingan_2?->format('d M Y') }}</span>
                    </div>
                    <div class="pv-date-row">
                        <span class="pv-date-label">C. &nbsp; Pendampingan III: &nbsp; tanggal</span>
                        <span class="pv-date-val">{{ $pendampinganReport->tgl_pendampingan_3?->format('d M Y') }}</span>
                    </div>
                    <div class="pv-date-row">
                        <span class="pv-date-label">D. &nbsp; Pendampingan IV: &nbsp; tanggal</span>
                        <span class="pv-date-val">{{ $pendampinganReport->tgl_pendampingan_4?->format('d M Y') }}</span>
                    </div>
                </div>
            </div>
            <div class="pv-gap"></div>
            <div class="pv-row">
                <span class="pv-label">PENERIMA BANTUAN HUKUM</span>
                <span class="pv-sep">:</span>
                <span class="pv-val" style="display:flex;justify-content:space-between;">
                    <span>{{ $pendampinganReport->penerima_bantuan }}</span>
                    <strong>L/P : {{ $pendampinganReport->jk_penerima }}</strong>
                </span>
            </div>
        </div>

        {{-- Tabel Checklist --}}
        @php
            $pv_items = [
                'item1' => 'Surat permohonan bantuan hukum',
                'item2' => 'SKTM Asli/ Legalisir Kartu JAMKESMAS/Kartu GAKIN/BLSM, dll.',
                'item3' => 'Berita Acara Pendampingan di luar pengadilan (ditandatangani oleh Penerima dan Pemberi Bantuan Hukum) :',
                'item4' => 'Laporan Pendampingan',
                'item5' => 'Kuitansi:',
            ];
            $pv_item3_sub = ['item3_a'=>'A. &nbsp; Pendampingan I','item3_b'=>'B. &nbsp; Pendampingan II','item3_c'=>'C. &nbsp; Pendampingan III','item3_d'=>'D. &nbsp; Pendampingan IV'];
            $pv_item5_sub = ['item5_1'=>'Pendampingan terhadap saksi dan/atau korban tindak pidana','item5_2'=>'Biaya penggandaan dan penjilidan laporan akhir'];
            $pv_cl = $pendampinganReport->checklist_data ?? [];
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
                    @if(!in_array($key,['item3','item5']))
                        <td class="chk-col"><span class="pv-chk">{{ $pv_chk($key,'obh') }}</span></td>
                        <td class="chk-col"><span class="pv-chk">{{ $pv_chk($key,'kanwil') }}</span></td>
                        <td class="chk-col"><span class="pv-chk">{{ $pv_chk($key,'bphn') }}</span></td>
                    @else
                        <td></td><td></td><td></td>
                    @endif
                </tr>
                @if($key === 'item3')
                    @foreach($pv_item3_sub as $sk => $sl)
                    <tr>
                        <td></td>
                        <td style="padding-left:20px;">{!! $sl !!}</td>
                        <td class="chk-col"><span class="pv-chk">{{ $pv_chk($sk,'obh') }}</span></td>
                        <td class="chk-col"><span class="pv-chk">{{ $pv_chk($sk,'kanwil') }}</span></td>
                        <td class="chk-col"><span class="pv-chk">{{ $pv_chk($sk,'bphn') }}</span></td>
                    </tr>
                    @endforeach
                @endif
                @if($key === 'item5')
                    @foreach($pv_item5_sub as $sk => $sl)
                    <tr>
                        <td></td>
                        <td style="padding-left:20px;">- {{ $sl }}</td>
                        <td class="chk-col"><span class="pv-chk">{{ $pv_chk($sk,'obh') }}</span></td>
                        <td class="chk-col"><span class="pv-chk">{{ $pv_chk($sk,'kanwil') }}</span></td>
                        <td class="chk-col"><span class="pv-chk">{{ $pv_chk($sk,'bphn') }}</span></td>
                    </tr>
                    @endforeach
                @endif
                @endforeach
            </tbody>
        </table>

        {{-- KETERANGAN --}}
        <div class="pv-keterangan">
            <div class="pv-ket-title">KETERANGAN :</div>
            - Jika <strong>ada</strong> beri tanda (&#10003;), <strong>tidak ada</strong> beri tanda (&#10007;).<br>
            - Form ini harus dilampirkan diatas dokumen.<br>
            - Berkas harus disusun berdasarkan urutan nomor.<br>
            - Pendampingan di luar pengadilan dilakukan paling sedikit empat kali untuk waktu paling lama dua bulan.<br>
            - Setiap kegiatan pendampingan di luar Pengadilan dibuat berita acara yang ditandatangani oleh Penerima dan Pemberi Bantuan Hukum.<br>
            - Pencairan Pendampingan dilakukan dengan mengumpulkan paling sedikit empat kasus kecuali pada tahap terkhir dapat dilakukan berdasarkan alokasi yang ditentukan.<br>
            - Berkas harus disusun berdasarkan urutan nomor.<br>
            - Berkas harus ASLI dan di <em>fotocopy</em>.<br>
            - Kartu BPJS tidak diperkenankan.<br>
            - Surat permohonan pendampingan di luar pengadilan bisa dilihat di Buku Panduan Implementasi Undang-Undang Nomor 16 Tahun 2011 Tentang Bantuan Hukum.<br>
            - Kuitansi biaya penggandaan harus dibubuhi stempel usaha fotokopi ybs. dan melampirkan bon berkop dari usaha ybs.
        </div>

    </div>

</x-app-layout>
