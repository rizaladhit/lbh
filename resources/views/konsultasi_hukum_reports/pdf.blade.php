<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Checklist Konsultasi Hukum - {{ $konsultasiHukumReport->obh }}</title>
    <style>
        @page {
            size: A4;
            margin: 20px 28px 130px 28px;
        }

        body {
            font-family: "Calibri", "DejaVu Sans", sans-serif;
            font-size: 13px;
            color: #111;
        }

        .title {
            text-align: center;
            font-weight: bold;
            font-size: 17px;
            text-decoration: underline;
            text-transform: uppercase;
            margin-bottom: 16px;
        }

        table.info { width: 100%; border-collapse: collapse; margin-bottom: 6px; }
        table.info td { padding: 2px 0; vertical-align: bottom; }
        table.info td.lbl { width: 190px; font-weight: bold; text-transform: uppercase; white-space: nowrap; }
        table.info td.sep { width: 12px; }
        table.info td.val { border-bottom: 1px dotted #555; }
        table.info td.val-fixed { font-weight: bold; }

        table.checklist { width: 100%; border-collapse: collapse; margin: 4px 0 10px 0; }
        table.checklist th, table.checklist td {
            border: 1px solid #333;
            padding: 4px 6px;
        }
        table.checklist th {
            background: #e0e0e0;
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
        }
        table.checklist td.no-col { text-align: center; font-weight: bold; width: 30px; }
        table.checklist td.chk-col { text-align: center; width: 55px; }
        table.checklist th.chk-th { width: 55px; }
        table.checklist th.no-th { width: 30px; }

        .keterangan { font-size: 11px; margin-top: 8px; line-height: 1.6; page-break-inside: avoid; }
        .keterangan .ket-title { font-weight: bold; margin-bottom: 3px; }

        .section-block { margin-bottom: 12px; }
        .section-block.page-break { page-break-before: always; }

        .signature-fixed {
            position: fixed;
            bottom: 20px;
            right: 0;
            width: 100%;
            text-align: right;
        }
        .signature-box { display: inline-block; text-align: center; min-width: 220px; }
        .signature-name { border-top: 1px solid #333; padding-top: 4px; font-weight: bold; margin-top: 45px; }
    </style>
</head>
<body>

    <div class="title">Check List Berkas Reimbursement Non Litigasi</div>

    <table class="info">
        <tr>
            <td class="lbl">OBH</td>
            <td class="sep">:</td>
            <td class="val">{{ $konsultasiHukumReport->obh }}</td>
        </tr>
        <tr>
            <td class="lbl">ALAMAT</td>
            <td class="sep">:</td>
            <td class="val">{{ $konsultasiHukumReport->alamat }}</td>
        </tr>
        <tr>
            <td class="lbl">PROVINSI</td>
            <td class="sep">:</td>
            <td class="val">{{ $konsultasiHukumReport->provinsi }}</td>
        </tr>
        <tr>
            <td class="lbl">KEGIATAN</td>
            <td class="sep">:</td>
            <td class="val-fixed">KONSULTASI HUKUM</td>
        </tr>
    </table>

    @php
        $section_names = ['I', 'II', 'III', 'IV', 'V'];
        $items_std = [
            'item1' => 'SKTM Asli/ Legalisir Kartu JAMKESMAS/Kartu GAKIN/BLSM, dll.',
            'item2' => 'Formulir Konsultasi yang sudah diisi lengkap',
            'item3' => 'Laporan hasil konsultasi',
            'item4' => 'Kuitansi Biaya Konsultan (diberi stempel OBH)',
        ];
        $items_iv = [
            'item1' => 'SKTM Asli/ Legalisir Kartu JAMKESMAS/Kartu GAKIN/BLSM, dll.',
            'item2' => 'Formulir Konsultasi yang sudah diisi lengkap',
            'item3' => 'Laporan hasil konsultasi',
            'item4' => 'Kuitansi Biaya Konsultan',
        ];
        $items_v = [
            'item1' => 'SKTM Asli/ Legalisir Kartu JAMKESMAS/Kartu GAKIN/BLSM, dll.',
            'item2' => 'Formulir Konsultasi yang sudah diisi lengkap',
            'item3' => 'Laporan hasil konsultasi',
            'item4' => 'Kuitansi Biaya Konsultan (diberi stempel OBH)',
            'item5' => 'Kuitansi Biaya Penggandaan dan Laporan Akhir',
        ];
        $section_items = [0 => $items_std, 1 => $items_std, 2 => $items_std, 3 => $items_iv, 4 => $items_v];
        $secs = $konsultasiHukumReport->sections ?? [];
    @endphp

    @for ($i = 0; $i < 5; $i++)
        @php
            $sec = $secs[$i] ?? [];
            $cl  = $sec['checklist'] ?? [];
            $chk = function ($k, $f) use ($cl) { return !empty($cl[$k][$f]) ? 'v' : ''; };
        @endphp

        <div class="section-block {{ ($i === 2 || $i === 4) ? 'page-break' : '' }}">
            <table class="info">
                <tr>
                    <td class="lbl">MATERI KONSULTASI {{ $section_names[$i] }}</td>
                    <td class="sep">:</td>
                    <td class="val">{{ $sec['materi'] ?? '' }}</td>
                </tr>
                <tr>
                    <td class="lbl">TGL PELAKSANAAN KEGIATAN</td>
                    <td class="sep">:</td>
                    <td class="val">{{ !empty($sec['tgl_pelaksanaan']) ? \Carbon\Carbon::parse($sec['tgl_pelaksanaan'])->translatedFormat('d F Y') : '' }}</td>
                </tr>
                <tr>
                    <td class="lbl">PENERIMA BANTUAN HUKUM</td>
                    <td class="sep">:</td>
                    <td class="val">{{ $sec['penerima_bantuan'] ?? '' }} &nbsp;&nbsp; (L/P : {{ $sec['jk_penerima'] ?? '-' }})</td>
                </tr>
                <tr>
                    <td class="lbl">NAMA KONSULTAN</td>
                    <td class="sep">:</td>
                    <td class="val">{{ $sec['nama_konsultan'] ?? '' }}</td>
                </tr>
            </table>

            <table class="checklist">
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
                    @foreach ($section_items[$i] as $key => $label)
                        <tr>
                            <td class="no-col">{{ substr($key, 4) }}.</td>
                            <td>{{ $label }}</td>
                            <td class="chk-col">{{ $chk($key, 'obh') }}</td>
                            <td class="chk-col">{{ $chk($key, 'kanwil') }}</td>
                            <td class="chk-col">{{ $chk($key, 'bphn') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endfor

    <div class="keterangan">
        <div class="ket-title">KETERANGAN :</div>
        - Jika <strong>ada</strong> beri tanda (&#10003;), <strong>tidak ada</strong> beri tanda (&#10007;).<br>
        - Form ini harus dilampirkan diatas dokumen.<br>
        - Berkas harus disusun berdasarkan urutan nomor.<br>
        - Konsultasi diajukan per-paket 5 kasus.<br>
        - Berkas harus <strong>ASLI</strong> dan di <em>fotocopy</em>.<br>
        - Kartu BPJS tidak diperkenankan.<br>
        - Form laporan Konsultasi bisa dilihat di Buku Panduan Implementasi Undang-Undang Nomor 16 Tahun 2011 Tentang Bantuan Hukum.<br>
        - Kuitansi biaya penggandaan harus dibubuhi stempel usaha fotokopi ybs. dan melampirkan bon berkop dari usaha ybs.
    </div>

    @php
        $ketuaLbhName = trim($appSetting->ketua_lbh ?? '');
    @endphp
    <div class="signature-fixed">
        <div class="signature-box">
            <div>Ketua LBH UNSUB,</div>
            <div class="signature-name">{{ $ketuaLbhName !== '' ? $ketuaLbhName : 'Ketua LBH UNSUB' }}</div>
        </div>
    </div>

</body>
</html>
