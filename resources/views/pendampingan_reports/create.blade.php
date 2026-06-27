<x-app-layout>
    <x-slot name="header">Buat Laporan Pendampingan Diluar Pengadilan</x-slot>

    <div class="row justify-content-center">
        <div class="col-xl-10">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 fw-bold text-primary text-center fs-5 text-uppercase">Check List Berkas Reimbursement Non Litigasi</h6>
                </div>
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('pendampingan-reports.store') }}" method="POST">
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
                            <div class="col-sm-8 text-primary fw-bold">: &nbsp; PENDAMPINGAN DILUAR PENGADILAN</div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label fw-bold py-0">KASUS</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                : <input type="text" name="kasus" class="form-control ms-2 border-secondary border-opacity-50" value="{{ old('kasus') }}" required>
                                @error('kasus')<div class="text-danger small ms-2">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label fw-bold py-0">TGL PELAKSANAAN KEGIATAN</label>
                            <div class="col-sm-8 ps-3">
                                @foreach(['A' => '1', 'B' => '2', 'C' => '3', 'D' => '4'] as $letter => $num)
                                <div class="d-flex align-items-center mb-2">
                                    <span class="me-2 fw-semibold" style="width:20px;">{{ $letter }}.</span>
                                    <span class="me-2 text-muted">Pendampingan {{ ['A'=>'I','B'=>'II','C'=>'III','D'=>'IV'][$letter] }}: tanggal</span>
                                    <input type="date" name="tgl_pendampingan_{{ $num }}" class="form-control border-secondary border-opacity-50" style="max-width:200px;" value="{{ old('tgl_pendampingan_'.$num) }}">
                                </div>
                                @endforeach
                                @error('tgl_pendampingan_1')<div class="text-danger small">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row mb-5">
                            <label class="col-sm-4 col-form-label fw-bold py-0">PENERIMA BANTUAN HUKUM</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                : <input type="text" name="penerima_bantuan" class="form-control mx-2 border-secondary border-opacity-50" value="{{ old('penerima_bantuan') }}" required>
                                <select name="jk_penerima" class="form-select w-auto border-secondary border-opacity-50" required>
                                    <option value="">L/P</option>
                                    <option value="L" {{ old('jk_penerima') == 'L' ? 'selected' : '' }}>L</option>
                                    <option value="P" {{ old('jk_penerima') == 'P' ? 'selected' : '' }}>P</option>
                                </select>
                                @error('penerima_bantuan')<div class="text-danger small ms-2">{{ $message }}</div>@enderror
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
                                            'item1' => 'Surat permohonan bantuan hukum',
                                            'item2' => 'SKTM Asli/ Legalisir Kartu JAMKESMAS/Kartu GAKIN/BLSM, dll.',
                                            'item3' => 'Berita Acara Pendampingan di luar pengadilan (ditandatangani oleh Penerima dan Pemberi Bantuan Hukum):',
                                            'item4' => 'Laporan Pendampingan',
                                            'item5' => 'Kuitansi:',
                                        ];
                                        $item3_sub = ['item3_a' => 'Pendampingan I', 'item3_b' => 'Pendampingan II', 'item3_c' => 'Pendampingan III', 'item3_d' => 'Pendampingan IV'];
                                        $item5_sub = ['item5_1' => 'Pendampingan terhadap saksi dan/atau korban tindak pidana', 'item5_2' => 'Biaya penggandaan dan penjilidan laporan akhir'];
                                        $letters = ['item3_a'=>'A','item3_b'=>'B','item3_c'=>'C','item3_d'=>'D'];
                                    @endphp

                                    @foreach($items as $key => $label)
                                    <tr>
                                        <td class="text-center fw-bold">{{ substr($key, 4) }}.</td>
                                        <td class="fw-medium">{{ $label }}
                                            <input type="hidden" name="checklist_data[{{ $key }}][label]" value="{{ $label }}">
                                        </td>
                                        @if(!in_array($key, ['item3','item5']))
                                            <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[{{ $key }}][obh]" value="1" {{ old('checklist_data.'.$key.'.obh') ? 'checked' : '' }}></td>
                                            <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[{{ $key }}][kanwil]" value="1" {{ old('checklist_data.'.$key.'.kanwil') ? 'checked' : '' }}></td>
                                            <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[{{ $key }}][bphn]" value="1" {{ old('checklist_data.'.$key.'.bphn') ? 'checked' : '' }}></td>
                                        @else
                                            <td></td><td></td><td></td>
                                        @endif
                                    </tr>
                                    @if($key === 'item3')
                                        @foreach($item3_sub as $subkey => $sublabel)
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
                                    @if($key === 'item5')
                                        @foreach($item5_sub as $subkey => $sublabel)
                                        <tr>
                                            <td></td>
                                            <td class="ps-4 text-muted fw-medium">- {{ $sublabel }}
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
                            - Pendampingan di luar pengadilan dilakukan paling sedikit empat kali untuk waktu paling lama dua bulan.<br>
                            - Setiap kegiatan pendampingan di luar Pengadilan dibuat berita acara yang ditandatangani oleh Penerima dan Pemberi Bantuan Hukum.<br>
                            - Berkas harus ASLI dan di <em>fotocopy</em>.<br>
                            - Kartu BPJS tidak diperkenankan.
                        </div>

                        <div class="d-flex justify-content-end align-items-center pt-3 border-top">
                            <a href="{{ route('pendampingan-reports.index') }}" class="btn btn-light border me-2 fw-medium">Batal</a>
                            <button type="submit" class="btn btn-primary fw-bold px-4 shadow-sm"><i class="fa-solid fa-save me-1"></i> Simpan Laporan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
