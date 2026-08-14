<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Checklist Berkas - {{ $reimbursementReport->obh }}</title>
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

        .pv-group {
            margin-bottom: 6px;
        }

        .pv-row {
            display: flex;
            align-items: flex-end;
            margin-bottom: 6px;
            line-height: 1.4;
        }

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

        .pv-val-fixed {
            flex: 1;
            font-weight: bold;
            padding-left: 3px;
        }

        .pv-g1 .pv-label { min-width: 32mm; }
        .pv-g2 .pv-label { min-width: 72mm; }

        .pv-gap { height: 10px; }

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

        @page {
            size: A4;
            margin: 1cm;
        }

        @media print {
            .print-actions {
                display: none !important;
            }

            body {
                margin: 0;
            }

            .page {
                max-width: 100%;
                margin: 0;
                padding: 0;
            }
        }
    </style>
</head>

<body>

    <div class="print-actions">
        <button onclick="window.print()" class="btn btn-success btn-sm fw-bold">
            <i class="fa-solid fa-print me-1"></i> Cetak / Simpan PDF
        </button>
        <a href="{{ route('pemberdayaan-masyarakat.show', $reimbursementReport) }}"
            class="btn btn-secondary btn-sm fw-medium">
            Kembali
        </a>
    </div>

    <main class="page">
        <div class="pv-title">Check List Berkas Reimbursement Non Litigasi</div>

        {{-- Grup 1 --}}
        <div class="pv-group pv-g1">
            <div class="pv-row">
                <span class="pv-label">OBH</span>
                <span class="pv-sep">:</span>
                <span class="pv-val">{{ $reimbursementReport->obh }}</span>
            </div>
            <div class="pv-row">
                <span class="pv-label">ALAMAT</span>
                <span class="pv-sep">:</span>
                <span class="pv-val">{{ $reimbursementReport->alamat }}</span>
            </div>
            <div class="pv-row">
                <span class="pv-label">PROVINSI</span>
                <span class="pv-sep">:</span>
                <span class="pv-val">{{ $reimbursementReport->provinsi }}</span>
            </div>
        </div>

        <div class="pv-gap"></div>

        {{-- Grup 2 --}}
        <div class="pv-group pv-g2">
            <div class="pv-row">
                <span class="pv-label">KEGIATAN</span>
                <span class="pv-sep">:</span>
                <span class="pv-val-fixed">PEMBERDAYAAN MASYARAKAT</span>
            </div>
            <div class="pv-row">
                <span class="pv-label">TGL PELAKSANAAN KEGIATAN</span>
                <span class="pv-sep">:</span>
                <span class="pv-val">{{ $reimbursementReport->tgl_pelaksanaan->format('d M Y') }}</span>
            </div>
            <div class="pv-row">
                <span class="pv-label">PENERIMA BANTUAN HUKUM</span>
                <span class="pv-sep">:</span>
                <span class="pv-val">{{ $reimbursementReport->penerima_bantuan ?? '-' }}</span>
            </div>
            <div class="pv-row">
                <span class="pv-label">TEMPAT PELAKSANAAN KEG.</span>
                <span class="pv-sep">:</span>
                <span class="pv-val">{{ $reimbursementReport->tempat_pelaksanaan ?? '-' }}</span>
            </div>
            <div class="pv-row">
                <span class="pv-label">MATERI</span>
                <span class="pv-sep">:</span>
                <span class="pv-val">{{ $reimbursementReport->materi ?? '-' }}</span>
            </div>
            <div class="pv-row">
                <span class="pv-label">NARASUMBER</span>
                <span class="pv-sep">:</span>
                <span class="pv-val">{{ $reimbursementReport->narasumber ?? '-' }}</span>
            </div>
        </div>

        {{-- Tabel Checklist --}}
        @php
            $pv_items = [
                'item1' => 'Formulir permohonan bantuan hukum',
                'item2' => 'SK Panitia',
                'item3' => 'Materi mengenai pengetahuan hukum',
                'item4' => 'Daftar Hadir Peserta',
                'item5' => 'Notula',
                'item6' => 'Dokumentasi kegiatan',
                'item7' => 'Laporan Kegiatan',
                'item8' => 'Kuitansi:'
            ];
            $pv_subitems = [
                'item8_1' => 'Biaya Konsumsi',
                'item8_2' => 'Biaya jasa Profesi/Narasumber (diberi stempel OBH)',
                'item8_3' => 'Biaya Penggandaan dan Penjilidan Laporan Akhir',
                'item8_4' => 'Dokumentasi Kegiatan',
                'item8_5' => 'Pembuatan Spanduk/Banner'
            ];
            $pv_checklist = $reimbursementReport->checklist_data ?? [];
            $pv_chk = function ($key, $field) use ($pv_checklist) {
                return !empty($pv_checklist[$key][$field]) ? 'v' : '';
            };
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
                        @if ($key !== 'item8')
                            <td class="chk-col"><span class="pv-chk">{{ $pv_chk($key, 'obh') }}</span></td>
                            <td class="chk-col"><span class="pv-chk">{{ $pv_chk($key, 'kanwil') }}</span></td>
                            <td class="chk-col"><span class="pv-chk">{{ $pv_chk($key, 'bphn') }}</span></td>
                        @else
                            <td></td><td></td><td></td>
                        @endif
                    </tr>
                    @if ($key === 'item8')
                        @foreach ($pv_subitems as $subkey => $sublabel)
                            <tr>
                                <td></td>
                                <td style="padding-left:20px;">- {{ $sublabel }}</td>
                                <td class="chk-col"><span class="pv-chk">{{ $pv_chk($subkey, 'obh') }}</span></td>
                                <td class="chk-col"><span class="pv-chk">{{ $pv_chk($subkey, 'kanwil') }}</span></td>
                                <td class="chk-col"><span class="pv-chk">{{ $pv_chk($subkey, 'bphn') }}</span></td>
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
            - Berkas harus ASLI dan di <em>fotocopy</em>.<br>
            - Kartu BPJS tidak diperkenankan.<br>
            - Formulir laporan pelaksanaan kegiatan pemberdayaan hukum bisa dilihat di Buku Panduan Implementasi Undang-Undang Nomor 16 Tahun 2011 Tentang Bantuan Hukum.<br>
            - Kuitansi konsumsi, penggandaan, dokumentasi, dan pembuatan spanduk harus melampirkan bon berkop dari usaha ybs.
        </div>

        @include('partials.ketua-lbh-signature')
    </main>

</body>

</html>
