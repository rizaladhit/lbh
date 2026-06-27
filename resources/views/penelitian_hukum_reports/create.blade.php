<x-app-layout>
    <x-slot name="header">Buat Laporan Penelitian Hukum</x-slot>

    <div class="row justify-content-center">
        <div class="col-xl-10">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 fw-bold text-primary text-center fs-5 text-uppercase">Check List Berkas Reimbursement Non Litigasi</h6>
                </div>
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('penelitian-hukum-reports.store') }}" method="POST">
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
                            <div class="col-sm-8 text-primary fw-bold">: &nbsp; PENELITIAN HUKUM</div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label fw-bold py-0">TGL PELAKSANAAN KEGIATAN</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                : <input type="date" name="tgl_pelaksanaan" class="form-control ms-2 border-secondary border-opacity-50" style="max-width:220px;" value="{{ old('tgl_pelaksanaan') }}">
                                @error('tgl_pelaksanaan')<div class="text-danger small ms-2">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row mb-5">
                            <label class="col-sm-4 col-form-label fw-bold py-0">JUDUL PENELITIAN</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                : <input type="text" name="judul_penelitian" class="form-control ms-2 border-secondary border-opacity-50" value="{{ old('judul_penelitian') }}" required>
                                @error('judul_penelitian')<div class="text-danger small ms-2">{{ $message }}</div>@enderror
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
                                            'item1' => 'SK Panitia Penelitian',
                                            'item2' => 'Proposal Penelitian Hukum',
                                            'item3' => 'Pembuatan Instrumen',
                                            'item4' => 'Penelitian Lapangan',
                                            'item5' => 'Pengolahan Data',
                                            'item6' => 'Laporan Sementara',
                                            'item7' => 'Pertemuan ilmiah/FGD',
                                            'item8' => 'Laporan Akhir hasil penelitian hukum',
                                            'item9' => 'Kuitansi:',
                                        ];
                                        $item9_sub = [
                                            'item9_1' => 'Pembuatan Proposal',
                                            'item9_2' => 'Pembuatan Instrumen',
                                            'item9_3' => 'Penelitian Lapangan',
                                            'item9_4' => 'Tabulasi/Pengolahan Data',
                                            'item9_5' => 'Pembuatan Laporan Sementara',
                                            'item9_6' => 'Pertemuan ilmiah/FGD',
                                            'item9_7' => 'Penggandaan dan Penjilidan akhir',
                                        ];
                                    @endphp

                                    @foreach($items as $key => $label)
                                    <tr>
                                        <td class="text-center fw-bold">{{ substr($key, 4) }}.</td>
                                        <td class="fw-medium">{{ $label }}
                                            <input type="hidden" name="checklist_data[{{ $key }}][label]" value="{{ $label }}">
                                        </td>
                                        @if($key !== 'item9')
                                            <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[{{ $key }}][obh]" value="1" {{ old('checklist_data.'.$key.'.obh') ? 'checked' : '' }}></td>
                                            <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[{{ $key }}][kanwil]" value="1" {{ old('checklist_data.'.$key.'.kanwil') ? 'checked' : '' }}></td>
                                            <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[{{ $key }}][bphn]" value="1" {{ old('checklist_data.'.$key.'.bphn') ? 'checked' : '' }}></td>
                                        @else
                                            <td></td><td></td><td></td>
                                        @endif
                                    </tr>
                                    @if($key === 'item9')
                                        @foreach($item9_sub as $subkey => $sublabel)
                                        <tr>
                                            <td></td>
                                            <td class="ps-4 text-muted">- {{ $sublabel }}
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
                            - Proposal Penelitian diajukan anggota panitia kepada Pemberi Bantuan Hukum.<br>
                            - Berkas harus ASLI dan di <em>fotocopy</em>.
                        </div>

                        <div class="d-flex justify-content-end align-items-center pt-3 border-top">
                            <a href="{{ route('penelitian-hukum-reports.index') }}" class="btn btn-light border me-2 fw-medium">Batal</a>
                            <button type="submit" class="btn btn-primary fw-bold px-4 shadow-sm"><i class="fa-solid fa-save me-1"></i> Simpan Laporan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
