<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Checklist Berkas - {{ $pendampinganReport->obh }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            background: #fff;
            color: #111;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11px;
        }

        .page {
            max-width: 900px;
            margin: 24px auto;
            padding: 24px;
        }

        .print-actions {
            position: fixed;
            top: 18px;
            right: 18px;
            z-index: 999;
            display: flex;
            gap: 8px;
        }

        .pv-title {
            text-align: center;
            font-weight: bold;
            font-size: 14px;
            text-decoration: underline;
            text-transform: uppercase;
            margin-bottom: 18px;
        }

        .pv-group { margin-bottom: 6px; }

        .pv-row {
            display: flex;
            align-items: flex-end;
            margin-bottom: 6px;
            line-height: 1.4;
        }

        .pv-row-top { align-items: flex-start; }

        .pv-label {
            flex-shrink: 0;
            text-transform: uppercase;
            white-space: nowrap;
            font-weight: bold;
        }

        .pv-sep {
            flex-shrink: 0;
            padding: 0 5px;
            white-space: nowrap;
        }

        .pv-val {
            flex: 1;
            min-width: 0;
            border-bottom: 1px dotted #555;
            padding-left: 3px;
            word-break: break-word;
        }

        .pv-val-fixed { flex: 1; font-weight: bold; padding-left: 3px; }
        .pv-val-block { flex: 1; min-width: 0; padding-left: 3px; }

        .pv-g1 .pv-label { min-width: 32mm; }
        .pv-g2 .pv-label { min-width: 72mm; }

        .pv-gap { height: 10px; }

        .pv-date-row {
            display: flex;
            align-items: flex-end;
            margin-bottom: 5px;
            padding-left: 6mm;
        }
        .pv-date-label { flex-shrink: 0; white-space: nowrap; padding-right: 4px; }
        .pv-date-val   { flex: 1; border-bottom: 1px dotted #555; min-width: 0; padding-left: 3px; }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 16px 0 12px 0;
        }

        th, td {
            border: 1px solid #333;
            padding: 5px 8px;
            vertical-align: top;
        }

        th {
            background: #e0e0e0;
            text-align: center;
            font-weight: 700;
            text-transform: uppercase;
        }

        td.no-col { text-align: center; font-weight: bold; width: 46px; }
        td.chk-col { text-align: center; width: 68px; }
        th.chk-th  { width: 68px; }
        th.no-th   { width: 46px; }

        .pv-chk {
            display: inline-block;
            width: 14px;
            height: 14px;
            border: 1px solid #333;
            text-align: center;
            line-height: 14px;
            font-size: 11px;
            font-weight: bold;
        }

        .pv-keterangan {
            font-size: 10px;
            margin-top: 10px;
            line-height: 1.6;
        }

        .pv-keterangan .pv-ket-title {
            font-weight: bold;
            margin-bottom: 3px;
        }

        @page { size: A4; margin: 1cm; }

        @media print {
            .print-actions { display: none !important; }
            body { margin: 0; }
            .page { max-width: 100%; margin: 0; padding: 0; }
        }
    </style>
</head>

<body>

    <div class="print-actions">
        <button onclick="window.print()" class="btn btn-success btn-sm fw-bold">
            <i class="fa-solid fa-print me-1"></i> Cetak / Simpan PDF
        </button>
        <a href="{{ route('pendampingan-reports.show', $pendampinganReport) }}" class="btn btn-secondary btn-sm fw-medium">
            Kembali
        </a>
    </div>

    <main class="page">
        <div class="pv-title">Check List Berkas Laporan Pendampingan Diluar Pengadilan</div>

        {{-- Grup 1 --}}
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

        {{-- Grup 2 --}}
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
            {{-- TGL PELAKSANAAN — multi baris --}}
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
            $pv_item3_sub = [
                'item3_a' => 'A. &nbsp; Pendampingan I',
                'item3_b' => 'B. &nbsp; Pendampingan II',
                'item3_c' => 'C. &nbsp; Pendampingan III',
                'item3_d' => 'D. &nbsp; Pendampingan IV',
            ];
            $pv_item5_sub = [
                'item5_1' => 'Pendampingan terhadap saksi dan/atau korban tindak pidana',
                'item5_2' => 'Biaya penggandaan dan penjilidan laporan akhir',
            ];
            $pv_cl = $pendampinganReport->checklist_data ?? [];
            $pv_chk = function ($k, $f) use ($pv_cl) { return !empty($pv_cl[$k][$f]) ? 'v' : ''; };
        @endphp

        <table>
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
                @foreach ($pv_items as $key => $label)
                    <tr>
                        <td class="no-col">{{ substr($key, 4) }}.</td>
                        <td>{{ $label }}</td>
                        @if (!in_array($key, ['item3', 'item5']))
                            <td class="chk-col"><span class="pv-chk">{{ $pv_chk($key, 'obh') }}</span></td>
                            <td class="chk-col"><span class="pv-chk">{{ $pv_chk($key, 'kanwil') }}</span></td>
                            <td class="chk-col"><span class="pv-chk">{{ $pv_chk($key, 'bphn') }}</span></td>
                        @else
                            <td></td><td></td><td></td>
                        @endif
                    </tr>
                    @if ($key === 'item3')
                        @foreach ($pv_item3_sub as $sk => $sl)
                            <tr>
                                <td></td>
                                <td style="padding-left:20px;">{!! $sl !!}</td>
                                <td class="chk-col"><span class="pv-chk">{{ $pv_chk($sk, 'obh') }}</span></td>
                                <td class="chk-col"><span class="pv-chk">{{ $pv_chk($sk, 'kanwil') }}</span></td>
                                <td class="chk-col"><span class="pv-chk">{{ $pv_chk($sk, 'bphn') }}</span></td>
                            </tr>
                        @endforeach
                    @endif
                    @if ($key === 'item5')
                        @foreach ($pv_item5_sub as $sk => $sl)
                            <tr>
                                <td></td>
                                <td style="padding-left:20px;">- {{ $sl }}</td>
                                <td class="chk-col"><span class="pv-chk">{{ $pv_chk($sk, 'obh') }}</span></td>
                                <td class="chk-col"><span class="pv-chk">{{ $pv_chk($sk, 'kanwil') }}</span></td>
                                <td class="chk-col"><span class="pv-chk">{{ $pv_chk($sk, 'bphn') }}</span></td>
                            </tr>
                        @endforeach
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
            - Pendampingan di luar pengadilan dilakukan paling sedikit empat kali untuk waktu paling lama dua bulan.<br>
            - Setiap kegiatan pendampingan di luar Pengadilan dibuat berita acara yang ditandatangani oleh Penerima dan Pemberi Bantuan Hukum.<br>
            - Pencairan Pendampingan dilakukan dengan mengumpulkan paling sedikit empat kasus kecuali pada tahap terkhir dapat dilakukan berdasarkan alokasi yang ditentukan.<br>
            - Berkas harus ASLI dan di <em>fotocopy</em>.<br>
            - Kartu BPJS tidak diperkenankan.<br>
            - Surat permohonan pendampingan di luar pengadilan bisa dilihat di Buku Panduan Implementasi Undang-Undang Nomor 16 Tahun 2011 Tentang Bantuan Hukum.<br>
            - Kuitansi biaya penggandaan harus dibubuhi stempel usaha fotokopi ybs. dan melampirkan bon berkop dari usaha ybs.
        </div>

        @include('partials.ketua-lbh-signature')
    </main>

</body>

</html>
