<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Permohonan Non-Litigasi Baru</title>
</head>
<body style="font-family: Arial, sans-serif; color: #1f2937; line-height: 1.6; margin: 0; padding: 24px; background: #f8fafc;">
    <div style="max-width: 640px; margin: 0 auto; background: #ffffff; border: 1px solid #e5e7eb; border-radius: 8px; padding: 24px;">
        <h1 style="font-size: 20px; margin: 0 0 16px; color: #111827;">Permohonan Non-Litigasi Baru Masuk</h1>

        <p>Yth. Admin,</p>

        <p>
            Terdapat permohonan non-litigasi baru yang telah dikirimkan dan memerlukan tindak lanjut:
        </p>

        <table style="width: 100%; border-collapse: collapse; margin: 16px 0;">
            <tr>
                <td style="width: 180px; padding: 8px; border-bottom: 1px solid #e5e7eb; font-weight: bold;">No. Registrasi</td>
                <td style="padding: 8px; border-bottom: 1px solid #e5e7eb;">{{ $permohonanNonLitigasi->no_registrasi }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border-bottom: 1px solid #e5e7eb; font-weight: bold;">Nama Pemohon</td>
                <td style="padding: 8px; border-bottom: 1px solid #e5e7eb;">{{ $permohonanNonLitigasi->nama_pemohon }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border-bottom: 1px solid #e5e7eb; font-weight: bold;">NIK</td>
                <td style="padding: 8px; border-bottom: 1px solid #e5e7eb;">{{ $permohonanNonLitigasi->nik_pemohon }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border-bottom: 1px solid #e5e7eb; font-weight: bold;">Jenis Perkara</td>
                <td style="padding: 8px; border-bottom: 1px solid #e5e7eb;">{{ $permohonanNonLitigasi->jenis_perkara }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border-bottom: 1px solid #e5e7eb; font-weight: bold;">Tgl. Rencana Kunjungan</td>
                <td style="padding: 8px; border-bottom: 1px solid #e5e7eb;">{{ optional($permohonanNonLitigasi->tgl_rencana_kunjungan)->format('d/m/Y') ?? '-' }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border-bottom: 1px solid #e5e7eb; font-weight: bold;">Tanggal Dikirim</td>
                <td style="padding: 8px; border-bottom: 1px solid #e5e7eb;">{{ $permohonanNonLitigasi->created_at->format('d/m/Y H:i') }}</td>
            </tr>
        </table>

        <p>
            Silakan masuk ke aplikasi untuk meninjau dan memproses permohonan ini.
        </p>

        <p style="margin: 24px 0;">
            <a href="{{ route('permohonan-non-litigasi.show', $permohonanNonLitigasi) }}" style="display: inline-block; background: #6366f1; color: #ffffff; text-decoration: none; padding: 10px 16px; border-radius: 6px; font-weight: bold;">
                Lihat Permohonan
            </a>
        </p>

        <p style="margin-top: 24px; color: #6b7280; font-size: 13px;">
            Email ini dikirim otomatis oleh sistem.
        </p>
    </div>
</body>
</html>
