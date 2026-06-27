<x-app-layout>
    <x-slot name="header">Buat Laporan Penyuluhan Hukum</x-slot>

    <div class="row justify-content-center">
        <div class="col-xl-10">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 fw-bold text-primary text-center fs-5 text-uppercase">Check List Berkas Reimbursement Non Litigasi</h6>
                </div>
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('penyuluhan-hukum-reports.store') }}" method="POST">
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
                            <div class="col-sm-8 text-primary fw-bold">: &nbsp; PENYULUHAN HUKUM</div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label fw-bold py-0">TGL PELAKSANAAN KEGIATAN</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                : <input type="date" name="tgl_pelaksanaan" class="form-control ms-2 border-secondary border-opacity-50" style="max-width:220px;" value="{{ old('tgl_pelaksanaan') }}">
                                @error('tgl_pelaksanaan')<div class="text-danger small ms-2">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label fw-bold py-0">PENERIMA BANTUAN HUKUM</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                : <input type="text" name="penerima_bantuan" class="form-control ms-2 border-secondary border-opacity-50" value="{{ old('penerima_bantuan') }}">
                                @error('penerima_bantuan')<div class="text-danger small ms-2">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label fw-bold py-0">TEMPAT PELAKSANAAN KEG.</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                : <input type="text" name="tempat_pelaksanaan" class="form-control ms-2 border-secondary border-opacity-50" value="{{ old('tempat_pelaksanaan') }}">
                                @error('tempat_pelaksanaan')<div class="text-danger small ms-2">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label fw-bold py-0">MATERI</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                : <input type="text" name="materi" class="form-control ms-2 border-secondary border-opacity-50" value="{{ old('materi') }}">
                                @error('materi')<div class="text-danger small ms-2">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row mb-5">
                            <label class="col-sm-4 col-form-label fw-bold py-0">NARASUMBER</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                : <input type="text" name="narasumber" class="form-control ms-2 border-secondary border-opacity-50" value="{{ old('narasumber') }}">
                                @error('narasumber')<div class="text-danger small ms-2">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="table-responsive mb-4">
                            <table class="table table-bordered align-middle">
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
                                    @php
                                        $items = [
                                            'item1' => 'Surat Permohonan Penyuluhan Hukum',
                                            'item2' => 'SK Panitia',
                                            'item3' => 'Daftar Hadir (Peserta dan Narasumber)',
                                            'item4' => 'Materi Penyuluhan',
                                            'item5' => 'Notula',
                                            'item6' => 'Laporan',
                                            'item7' => 'Dokumentasi kegiatan',
                                            'item8' => 'Kuitansi:',
                                        ];
                                        $item8_sub = [
                                            'item8_a' => 'Konsumsi',
                                            'item8_b' => 'Jasa Profesi/Narasumber',
                                            'item8_c' => 'Penggandaan dan Penjilidan laporan akhir',
                                            'item8_d' => 'Dokumentasi kegiatan',
                                            'item8_e' => 'Pembuatan Spanduk/Banner Kegiatan',
                                        ];
                                        $letters = ['item8_a'=>'a','item8_b'=>'b','item8_c'=>'c','item8_d'=>'d','item8_e'=>'e'];
                                    @endphp

                                    @foreach($items as $key => $label)
                                    <tr>
                                        <td class="text-center fw-bold">{{ substr($key, 4) }}.</td>
                                        <td class="fw-medium">{{ $label }}
                                            <input type="hidden" name="checklist_data[{{ $key }}][label]" value="{{ $label }}">
                                        </td>
                                        @if($key !== 'item8')
                                            <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[{{ $key }}][obh]" value="1" {{ old('checklist_data.'.$key.'.obh') ? 'checked' : '' }}></td>
                                            <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[{{ $key }}][kanwil]" value="1" {{ old('checklist_data.'.$key.'.kanwil') ? 'checked' : '' }}></td>
                                            <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[{{ $key }}][bphn]" value="1" {{ old('checklist_data.'.$key.'.bphn') ? 'checked' : '' }}></td>
                                        @else
                                            <td></td><td></td><td></td>
                                        @endif
                                    </tr>
                                    @if($key === 'item8')
                                        @foreach($item8_sub as $subkey => $sublabel)
                                        <tr>
                                            <td></td>
                                            <td class="ps-4 text-muted fw-medium">{{ $letters[$subkey] }}. &nbsp; {{ $sublabel }}
                                                <input type="hidden" name="checklist_data[{{ $subkey }}][label]" value="{{ $sublabel }}">
                                            </td>
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
                            - Form ini harus dilampirkan diatas dokumen.<br>
                            - Berkas harus disusun berdasarkan urutan nomor.<br>
                            - Berkas harus ASLI dan difotokopi.
                        </div>

                        <div class="d-flex justify-content-end align-items-center pt-3 border-top">
                            <a href="{{ route('penyuluhan-hukum-reports.index') }}" class="btn btn-light border me-2 fw-medium">Batal</a>
                            <button type="submit" class="btn btn-primary fw-bold px-4 shadow-sm"><i class="fa-solid fa-save me-1"></i> Simpan Laporan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
