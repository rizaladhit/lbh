<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak - {{ $permohonanLitigasi->no_registrasi }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            background: white;
            color: black;
            font-size: 13pt;
        }

        .page {
            max-width: 800px;
            margin: 30px auto;
            padding: 40px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #333;
            padding: 8px 12px;
            vertical-align: top;
        }

        table th {
            background-color: #f0f0f0;
            width: 35%;
        }

        .section-title {
            font-weight: bold;
            text-transform: uppercase;
            font-size: 11pt;
            border-bottom: 2px solid #333;
            padding-bottom: 4px;
            margin-top: 24px;
            margin-bottom: 12px;
        }

        .print-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 999;
        }

        @media print {
            .print-btn {
                display: none !important;
            }

            body {
                margin: 0;
                padding: 0;
                font-size: 12pt;
            }

            .page {
                margin: 0;
                padding: 0;
                max-width: 100%;
            }
        }

        img.doc-img {
            max-height: 250px;
            border: 1px solid #ccc;
            object-fit: contain;
            display: block;
            margin-top: 8px;
        }

        .signature-block {
            margin-top: 40px;
            text-align: right;
        }

        .page-header {
            margin-bottom: 20px;
        }

        @page {
            size: A4;
            margin: 1cm;
            margin-top: 0.5cm;
            margin-bottom: 0.5cm;
        }
    </style>
</head>

<body>

    <div class="print-btn no-print">
        <button onclick="window.print()" class="btn btn-success fw-bold shadow"><i class="fa-solid fa-print me-1"></i>
            Cetak / Simpan PDF</button>
        <a href="{{ route('permohonan-litigasi.show', $permohonanLitigasi) }}"
            class="btn btn-secondary fw-medium ms-2">← Kembali</a>
    </div>

    <div class="page">

        {{-- Header --}}
        <div class="text-center mb-4">
            <p class="mb-1" style="font-size: 12pt;">LEMBAGA BANTUAN HUKUM UNSUB</p>
            <h4 class="fw-bold text-uppercase mb-2"
                style="text-decoration: underline; text-underline-offset: 5px; font-size: 15pt;">
                Formulir Permohonan Bantuan Layanan Litigasi
            </h4>
        </div>

        <div style="display: flex; justify-content: space-between; margin-bottom: 20px; font-size: 12pt;">
            <div><strong>No. Registrasi :</strong> {{ $permohonanLitigasi->no_registrasi }}</div>
            <div><strong>Tanggal Pengajuan :</strong> {{ $permohonanLitigasi->created_at->format('d M Y') }}</div>
        </div>

        <hr style="border: 1.5px solid #333; margin-bottom: 20px;">

        {{-- Data Pemohon --}}
        <div class="section-title">A. Data Pemohon</div>
        <table>
            <tbody>
                <tr>
                    <th>Nama</th>
                    <td>{{ $permohonanLitigasi->nama }}</td>
                </tr>
                <tr>
                    <th>NIK</th>
                    <td>{{ $permohonanLitigasi->nik }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{{ $permohonanLitigasi->alamat }}</td>
                </tr>
                <tr>
                    <th>Telp / HP</th>
                    <td>{{ $permohonanLitigasi->telp_hp }}</td>
                </tr>
            </tbody>
        </table>

        {{-- Perkara --}}
        <div class="section-title mt-4">B. Data Perkara</div>
        <table>
            <tbody>
                <tr>
                    <th>Jenis Perkara</th>
                    <td>{{ $permohonanLitigasi->jenis_perkara }}</td>
                </tr>
                <tr>
                    <th>No. Perkara</th>
                    <td>{{ $permohonanLitigasi->no_perkara }}</td>
                </tr>
                <tr>
                    <th>Tgl. Rencana Kunjungan</th>
                    <td>{{ $permohonanLitigasi->tgl_rencana_kunjungan->format('d M Y') }}</td>
                </tr>
                <tr>
                    <th style="vertical-align: top;">Uraian Singkat</th>
                    <td style="white-space: pre-line;">{{ $permohonanLitigasi->uraian_singkat }}</td>
                </tr>
            </tbody>
        </table>

        {{-- KTP/KK --}}
        @if($permohonanLitigasi->file_ktp_kk)
            @php $ktpExt = strtolower(pathinfo($permohonanLitigasi->file_ktp_kk, PATHINFO_EXTENSION)); @endphp
            <div class="section-title mt-4">C. Foto KTP / Kartu Keluarga (KK)</div>
            @if(in_array($ktpExt, ['jpg', 'jpeg', 'png']))
                <img src="{{ Storage::url($permohonanLitigasi->file_ktp_kk) }}" class="doc-img" alt="KTP/KK">
            @else
                <p style="font-size: 11pt; color:#555;">[File PDF terlampir – {{ basename($permohonanLitigasi->file_ktp_kk) }}]
                </p>
            @endif
        @endif

        {{-- SKTM --}}
        @if($permohonanLitigasi->file_sktm)
            @php $sktmExt = strtolower(pathinfo($permohonanLitigasi->file_sktm, PATHINFO_EXTENSION)); @endphp
            <div class="section-title mt-4">D. SKTM (Surat Keterangan Tidak Mampu)</div>
            @if(in_array($sktmExt, ['jpg', 'jpeg', 'png']))
                <img src="{{ Storage::url($permohonanLitigasi->file_sktm) }}" class="doc-img" alt="SKTM">
            @else
                <p style="font-size: 11pt; color:#555;">[File PDF terlampir – {{ basename($permohonanLitigasi->file_sktm) }}]
                </p>
            @endif
        @endif

        {{-- Signature --}}
        <div style="margin-top: 48px; display: flex; justify-content: flex-end;">
            <div style="text-align: center; min-width: 240px;">
                <p style="margin-bottom: 8px; font-size: 12pt;">Pemohon,</p>
                @if($permohonanLitigasi->file_ttd)
                    <img src="{{ Storage::url($permohonanLitigasi->file_ttd) }}"
                        style="height: 150px; max-width: 280px; object-fit: contain; display: block; margin: 0 auto 4px;"
                        alt="TTD">
                @else
                    <div style="height: 90px;"></div>
                @endif
                <div style="border-top: 1px solid #333; padding-top: 6px; font-weight: bold; font-size: 12pt;">
                    {{ $permohonanLitigasi->nama }}
                </div>
            </div>
        </div>

    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</body>

</html>