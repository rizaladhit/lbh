<x-app-layout>
    <x-slot name="header">Buat Laporan Mediasi</x-slot>

    <div class="row justify-content-center">
        <div class="col-xl-10">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 fw-bold text-primary text-center fs-5 text-uppercase">Check List Berkas Laporan Mediasi</h6>
                </div>
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('mediasi-reports.store') }}" method="POST">
                        @csrf

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-bold">OBH</label>
                            <div class="col-sm-9">
                                <input type="text" name="obh" class="form-control border-secondary border-opacity-50" value="{{ old('obh') }}" required>
                                @error('obh')<div class="text-danger small">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-bold">ALAMAT</label>
                            <div class="col-sm-9">
                                <input type="text" name="alamat" class="form-control border-secondary border-opacity-50" value="{{ old('alamat') }}" required>
                                @error('alamat')<div class="text-danger small">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label fw-bold">PROVINSI</label>
                            <div class="col-sm-9">
                                <input type="text" name="provinsi" class="form-control border-secondary border-opacity-50" value="{{ old('provinsi') }}" required>
                                @error('provinsi')<div class="text-danger small">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <hr class="mb-4">

                        <div class="row mb-3 align-items-center">
                            <label class="col-sm-4 col-form-label fw-bold py-0">KEGIATAN</label>
                            <div class="col-sm-8 text-primary fw-bold">
                                : &nbsp; MEDIASI
                                <input type="hidden" name="kegiatan" value="MEDIASI">
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
                            <label class="col-sm-4 col-form-label fw-bold py-0">KASUS</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                : <input type="text" name="kasus" class="form-control ms-2 border-secondary border-opacity-50" value="{{ old('kasus') }}" required>
                                @error('kasus')<div class="text-danger small ms-3">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label fw-bold py-0">PENERIMA BANTUAN HUKUM</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                : <input type="text" name="penerima_bantuan" class="form-control mx-2 border-secondary border-opacity-50" value="{{ old('penerima_bantuan') }}" required>
                                <select name="jk_penerima" class="form-select w-auto border-secondary border-opacity-50" required>
                                    <option value="" {{ old('jk_penerima') == '' ? 'selected' : '' }}>L/P</option>
                                    <option value="L" {{ old('jk_penerima') == 'L' ? 'selected' : '' }}>L</option>
                                    <option value="P" {{ old('jk_penerima') == 'P' ? 'selected' : '' }}>P</option>
                                </select>
                                @error('penerima_bantuan')<div class="text-danger small ms-3">{{ $message }}</div>@enderror
                                @error('jk_penerima')<div class="text-danger small ms-3">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row mb-5">
                            <label class="col-sm-4 col-form-label fw-bold py-0">NAMA MEDIATOR</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                : <input type="text" name="nama_mediator" class="form-control ms-2 border-secondary border-opacity-50" value="{{ old('nama_mediator') }}" required>
                                @error('nama_mediator')<div class="text-danger small ms-3">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="table-responsive mb-4">
                            <table class="table table-bordered align-middle">
                                <thead>
                                    <tr class="text-center align-middle" style="background-color: var(--bs-tertiary-bg) !important;">
                                        <th style="width: 50px;">NO</th>
                                        <th>BERKAS</th>
                                        <th style="width: 80px;">OBH</th>
                                        <th style="width: 80px;">KANWIL</th>
                                        <th style="width: 80px;">BPHN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $berkas_list = [
                                            '1' => 'Formulir permohonan bantuan hukum',
                                            '2' => 'SKTM Asli/ Legalisir Kartu JAMKESMAS/Kartu GAKIN/BLSM, dll.',
                                            '3' => 'Berita acara mediasi (ditandantangani para pihak)',
                                            '4' => 'Laporan mediasi',
                                            '5' => 'Kuitansi: Biaya Mediator (diberi stempel OBH)',
                                            '6' => 'Kuitansi: Biaya penggandaan dan penjilidan laporan akhir',
                                        ];
                                    @endphp
                                    @foreach($berkas_list as $idx => $label)
                                        <tr>
                                            <td class="text-center fw-bold">{{ $idx }}.</td>
                                            <td class="fw-medium">{{ $label }}
                                                <input type="hidden" name="checklist_data[{{ $idx }}][label]" value="{{ $label }}">
                                            </td>
                                            <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[{{ $idx }}][obh]" value="1" {{ old('checklist_data.'.$idx.'.obh') ? 'checked' : '' }}></td>
                                            <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[{{ $idx }}][kanwil]" value="1" {{ old('checklist_data.'.$idx.'.kanwil') ? 'checked' : '' }}></td>
                                            <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[{{ $idx }}][bphn]" value="1" {{ old('checklist_data.'.$idx.'.bphn') ? 'checked' : '' }}></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="alert border small" style="background-color: var(--bs-secondary-bg);">
                            <strong>KETERANGAN:</strong><br>
                            - Jika <strong>ada</strong> beri tanda (&check;), <strong>tidak ada</strong> biarkan kosong.<br>
                            - Form ini harus dilampirkan di atas dokumen.<br>
                            - Berkas harus disusun berdasarkan urutan nomor.<br>
                            - Kuitansi biaya mediator harus diberi stempel OBH.<br>
                            - Berkas harus ASLI dan dapat difotokopi.<br>
                            - Semua dokumen pendukung harus dilengkapi sebelum diserahkan ke BPHN.
                        </div>

                        <div class="d-flex justify-content-end align-items-center pt-3 border-top">
                            <a href="{{ route('mediasi-reports.index') }}" class="btn btn-light border me-2 fw-medium">Batal</a>
                            <button type="submit" class="btn btn-primary fw-bold px-4 shadow-sm"><i class="fa-solid fa-save me-1"></i> Simpan Laporan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
