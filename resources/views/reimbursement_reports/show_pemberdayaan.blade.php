<x-app-layout>
    <x-slot name="header">Pemberdayaan Masyarakat</x-slot>

    <style>
        .checklist-square { width: 18px; height: 18px; display: inline-flex; justify-content: center; align-items: center; border: 1px solid currentColor; font-weight: bold; font-family: monospace; font-size: 14px; }
        .form-preview-label { width: 220px; flex-shrink: 0; }
    </style>

    {{-- ================================================================ --}}
    {{-- SCREEN VIEW — style sama dengan /mediasi-reports                  --}}
    {{-- ================================================================ --}}
    <div class="d-print-none row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-md border-0 mb-4 p-4 p-md-5">

                <div class="card-header bg-transparent border-0 mb-4 pb-0 text-center">
                    <h5 class="fw-bold text-uppercase d-inline-block text-decoration-underline" style="text-underline-offset:4px;">
                        CHECK LIST BERKAS REIMBURSEMENT NON LITIGASI
                    </h5>
                </div>

                <div class="card-body p-0" style="font-size: 0.95rem;">
                    <div class="d-flex mb-1">
                        <div class="fw-bold form-preview-label">OBH</div>
                        <div>: {{ $reimbursementReport->obh }}</div>
                    </div>
                    <div class="d-flex mb-1">
                        <div class="fw-bold form-preview-label">ALAMAT</div>
                        <div>: {{ $reimbursementReport->alamat }}</div>
                    </div>
                    <div class="d-flex mb-4">
                        <div class="fw-bold form-preview-label">PROVINSI</div>
                        <div>: {{ $reimbursementReport->provinsi }}</div>
                    </div>

                    <div class="d-flex mb-1">
                        <div class="fw-bold form-preview-label">KEGIATAN</div>
                        <div class="text-uppercase">: {{ $reimbursementReport->kegiatan }}</div>
                    </div>
                    <div class="d-flex mb-1">
                        <div class="fw-bold form-preview-label">TGL PELAKSANAAN KEGIATAN</div>
                        <div>: {{ $reimbursementReport->tgl_pelaksanaan->format('d M Y') }}</div>
                    </div>
                    <div class="d-flex mb-1">
                        <div class="fw-bold form-preview-label">PENERIMA BANTUAN HUKUM</div>
                        <div>: {{ $reimbursementReport->penerima_bantuan ?? '-' }}</div>
                    </div>
                    <div class="d-flex mb-1">
                        <div class="fw-bold form-preview-label">TEMPAT PELAKSANAAN KEG.</div>
                        <div>: {{ $reimbursementReport->tempat_pelaksanaan ?? '-' }}</div>
                    </div>
                    <div class="d-flex mb-1">
                        <div class="fw-bold form-preview-label">MATERI</div>
                        <div>: {{ $reimbursementReport->materi ?? '-' }}</div>
                    </div>
                    <div class="d-flex mb-4">
                        <div class="fw-bold form-preview-label">NARASUMBER</div>
                        <div>: {{ $reimbursementReport->narasumber ?? '-' }}</div>
                    </div>

                    @php
                        $items = [
                            'item1' => 'Formulir permohonan bantuan hukum',
                            'item2' => 'SK Panitia',
                            'item3' => 'Materi mengenai pengetahuan hukum',
                            'item4' => 'Daftar Hadir Peserta',
                            'item5' => 'Notula',
                            'item6' => 'Dokumentasi kegiatan',
                            'item7' => 'Laporan Kegiatan',
                            'item8' => 'Kuitansi:'
                        ];
                        $subitems = [
                            'item8_1' => 'Biaya Konsumsi',
                            'item8_2' => 'Biaya jasa Profesi/Narasumber (diberi stempel OBH)',
                            'item8_3' => 'Biaya Penggandaan dan Penjilidan Laporan Akhir',
                            'item8_4' => 'Dokumentasi Kegiatan',
                            'item8_5' => 'Pembuatan Spanduk/Banner'
                        ];
                        $checklist = $reimbursementReport->checklist_data ?? [];
                        $chk = function($key, $field) use ($checklist) {
                            return !empty($checklist[$key][$field]) ? 'v' : '&nbsp;';
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
                            @foreach($items as $key => $label)
                            <tr>
                                <td class="text-center fw-bold">{{ substr($key, 4) }}.</td>
                                <td class="fw-medium">{{ $label }}</td>
                                @if($key !== 'item8')
                                    <td class="text-center"><span class="checklist-square">{!! $chk($key, 'obh') !!}</span></td>
                                    <td class="text-center"><span class="checklist-square">{!! $chk($key, 'kanwil') !!}</span></td>
                                    <td class="text-center"><span class="checklist-square">{!! $chk($key, 'bphn') !!}</span></td>
                                @else
                                    <td></td><td></td><td></td>
                                @endif
                            </tr>
                            @if($key === 'item8')
                                @foreach($subitems as $subkey => $sublabel)
                                <tr>
                                    <td></td>
                                    <td class="ps-4 text-muted fw-medium">- {{ $sublabel }}</td>
                                    <td class="text-center"><span class="checklist-square">{!! $chk($subkey, 'obh') !!}</span></td>
                                    <td class="text-center"><span class="checklist-square">{!! $chk($subkey, 'kanwil') !!}</span></td>
                                    <td class="text-center"><span class="checklist-square">{!! $chk($subkey, 'bphn') !!}</span></td>
                                </tr>
                                @endforeach
                            @endif
                            @endforeach
                        </tbody>
                    </table>

                    <div class="small lh-sm">
                        <strong>KETERANGAN :</strong><br>
                        - Jika <strong>ada</strong> beri tanda (&check;), <strong>tidak ada</strong> biarkan kosong.<br>
                        - Form ini harus dilampirkan di atas dokumen.<br>
                        - Berkas harus disusun berdasarkan urutan nomor.<br>
                        - Kartu BPJS tidak diperkenankan.<br>
                        - Formulir laporan pelaksanaan kegiatan pemberdayaan hukum bisa dilihat di Buku Panduan Implementasi Undang-Undang Nomor 16 Tahun 2011 Tentang Bantuan Hukum.<br>
                        - Kuitansi konsumsi dan penggandaan harus diberi materai (&gt;Rp. 250rb diberi materai 3000), dan dibubuhi stempel Rumah Makan dan usaha fotokopi ybs.
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mb-4 d-print-none">
                <a href="{{ route('pemberdayaan-masyarakat.index') }}" class="btn btn-secondary px-4 fw-bold shadow-sm">Kembali</a>
                <a href="{{ route('pemberdayaan-masyarakat.print', $reimbursementReport) }}" class="btn btn-success px-4 fw-bold shadow-sm">
                    <i class="fa-solid fa-print me-1"></i> Cetak Formulir
                </a>
        </div>
    </div>
</x-app-layout>
