<x-app-layout>
    <x-slot name="header">Buat Laporan Reimbursement - Pemberdayaan Masyarakat</x-slot>

    <div class="row justify-content-center">
        <div class="col-xl-10">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header py-3 bg-primary">
                    <h6 class="m-0 fw-bold text-white text-uppercase">Check List Berkas Reimbursement Non Litigasi</h6>
                </div>
                <div class="card-body p-4 p-md-5">
                    <form method="POST" action="{{ route('reimbursement-reports.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-bold">OBH</label>
                            <div class="col-sm-9">
                                <input type="text" name="obh" class="form-control border-secondary border-opacity-50" value="{{ old('obh') }}" required>
                                @error('obh')<span class="text-danger small">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-bold">ALAMAT</label>
                            <div class="col-sm-9">
                                <input type="text" name="alamat" class="form-control border-secondary border-opacity-50" value="{{ old('alamat') }}" required>
                                @error('alamat')<span class="text-danger small">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label fw-bold">PROVINSI</label>
                            <div class="col-sm-9">
                                <input type="text" name="provinsi" class="form-control border-secondary border-opacity-50" value="{{ old('provinsi') }}" required>
                                @error('provinsi')<span class="text-danger small">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <hr class="mb-4">

                        <div class="row mb-3 align-items-center">
                            <label class="col-sm-4 col-form-label fw-bold py-0">KEGIATAN</label>
                            <div class="col-sm-8 text-primary fw-bold">
                                : &nbsp; PEMBERDAYAAN MASYARAKAT
                                <input type="hidden" name="kegiatan" value="Pemberdayaan Masyarakat">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label fw-bold py-0">TGL PELAKSANAAN KEGIATAN</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                : <input type="date" name="tgl_pelaksanaan" class="form-control ms-2 border-secondary border-opacity-50" value="{{ old('tgl_pelaksanaan') }}" style="max-width: 220px;" required>
                                @error('tgl_pelaksanaan')<div class="text-danger small ms-3">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label fw-bold py-0">PENERIMA BANTUAN HUKUM</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                : <input type="text" name="penerima_bantuan" class="form-control ms-2 border-secondary border-opacity-50" value="{{ old('penerima_bantuan') }}" required>
                                @error('penerima_bantuan')<div class="text-danger small ms-3">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label fw-bold py-0">TEMPAT PELAKSANAAN KEG.</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                : <input type="text" name="tempat_pelaksanaan" class="form-control ms-2 border-secondary border-opacity-50" value="{{ old('tempat_pelaksanaan') }}" required>
                                @error('tempat_pelaksanaan')<div class="text-danger small ms-3">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label fw-bold py-0">MATERI</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                : <input type="text" name="materi" class="form-control ms-2 border-secondary border-opacity-50" value="{{ old('materi') }}" required>
                                @error('materi')<div class="text-danger small ms-3">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row mb-5">
                            <label class="col-sm-4 col-form-label fw-bold py-0">NARASUMBER</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                : <input type="text" name="narasumber" class="form-control ms-2 border-secondary border-opacity-50" value="{{ old('narasumber') }}" required>
                                @error('narasumber')<div class="text-danger small ms-3">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="table-responsive mb-4">
                            <table class="table table-bordered align-middle">
                                <thead>
                                    <tr class="text-center align-middle" style="background-color: var(--bs-secondary-bg) !important;">
                                        <th style="width: 50px;">NO</th>
                                        <th>BERKAS</th>
                                        <th style="width: 80px;">OBH</th>
                                        <th style="width: 80px;">KANWIL</th>
                                        <th style="width: 80px;">BPHN</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                                    @endphp

                                    @foreach($items as $key => $label)
                                        <tr>
                                            <td class="text-center fw-bold">{{ substr($key, 4) }}.</td>
                                            <td class="fw-medium">{{ $label }}<input type="hidden" name="checklist_data[{{ $key }}][label]" value="{{ $label }}"></td>
                                            @if($key !== 'item8')
                                                <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[{{ $key }}][obh]" value="1" {{ old('checklist_data.'.$key.'.obh') ? 'checked' : '' }}></td>
                                                <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[{{ $key }}][kanwil]" value="1" {{ old('checklist_data.'.$key.'.kanwil') ? 'checked' : '' }}></td>
                                                <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[{{ $key }}][bphn]" value="1" {{ old('checklist_data.'.$key.'.bphn') ? 'checked' : '' }}></td>
                                            @else
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            @endif
                                        </tr>
                                        @if($key === 'item8')
                                            @foreach($subitems as $subkey => $sublabel)
                                                <tr>
                                                    <td></td>
                                                    <td class="ps-4 text-muted">- {{ $sublabel }}<input type="hidden" name="checklist_data[{{ $subkey }}][label]" value="{{ $sublabel }}"></td>
                                                    <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[{{ $subkey }}][obh]" value="1" {{ old('checklist_data.'.$subkey.'.obh') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[{{ $subkey }}][kanwil]" value="1" {{ old('checklist_data.'.$subkey.'.kanwil') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[{{ $subkey }}][bphn]" value="1" {{ old('checklist_data.'.$subkey.'.bphn') ? 'checked' : '' }}></td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="alert border small" style="background-color: var(--bs-secondary-bg);">
                            <strong>KETERANGAN:</strong><br>
                            - Jika <strong>ada</strong> beri tanda (&check;), <strong>tidak ada</strong> biarkan kosong.<br>
                            - Form ini harus dilampirkan di atas dokumen.<br>
                            - Berkas harus disusun berdasarkan urutan nomor.<br>
                            - Kartu BPJS tidak diperkenankan.<br>
                            - Formulir laporan pelaksanaan kegiatan pemberdayaan hukum bisa dilihat di Buku Panduan Implementasi Undang-Undang Nomor 16 Tahun 2011 Tentang Bantuan Hukum.<br>
                            - Kuitansi konsumsi dan penggandaan harus diberi materai (>Rp. 250rb diberi materai 3000), dan dibubuhi stempel Rumah Makan dan usaha fotokopi ybs.
                        </div>

                        <div class="d-flex justify-content-end align-items-center pt-3 border-top">
                            <a href="{{ route('reimbursement-reports.index') }}" class="btn btn-light border me-2 fw-medium">Batal</a>
                            <button type="submit" class="btn btn-primary fw-bold px-4 shadow-sm"><i class="fa-solid fa-save me-1"></i> Simpan Laporan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
