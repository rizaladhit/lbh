<x-app-layout>
    <x-slot name="header">
        Edit Laporan Negosiasi
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-xl-10">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 fw-bold text-primary text-center fs-5 text-uppercase">Check List Berkas Laporan Negosiasi</h6>
                </div>
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('negosiasi-reports.update', $negosiasiReport) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-bold">OBH</label>
                            <div class="col-sm-9">
                                <input type="text" name="obh" class="form-control border-secondary border-opacity-50" value="{{ old('obh', $negosiasiReport->obh) }}" required>
                                @error('obh')<div class="text-danger small">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-bold">ALAMAT</label>
                            <div class="col-sm-9">
                                <input type="text" name="alamat" class="form-control border-secondary border-opacity-50" value="{{ old('alamat', $negosiasiReport->alamat) }}" required>
                                @error('alamat')<div class="text-danger small">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label fw-bold">PROVINSI</label>
                            <div class="col-sm-9">
                                <input type="text" name="provinsi" class="form-control border-secondary border-opacity-50" value="{{ old('provinsi', $negosiasiReport->provinsi) }}" required>
                                @error('provinsi')<div class="text-danger small">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <hr class="mb-4">

                        <div class="row mb-3 align-items-center">
                            <label class="col-sm-4 col-form-label fw-bold py-0">KEGIATAN</label>
                            <div class="col-sm-8 text-primary fw-bold">
                                : &nbsp; NEGOSIASI
                                <input type="hidden" name="kegiatan" value="NEGOSIASI">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label fw-bold py-0">TGL PELAKSANAAN KEGIATAN</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                : <input type="date" name="tgl_pelaksanaan" class="form-control ms-2 border-secondary border-opacity-50" value="{{ old('tgl_pelaksanaan', $negosiasiReport->tgl_pelaksanaan) }}" style="max-width: 220px;" required>
                                @error('tgl_pelaksanaan')<div class="text-danger small ms-3">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label fw-bold py-0">KASUS</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                : <input type="text" name="kasus" class="form-control ms-2 border-secondary border-opacity-50" value="{{ old('kasus', $negosiasiReport->kasus) }}" required>
                                @error('kasus')<div class="text-danger small ms-3">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label fw-bold py-0">PENERIMA BANTUAN HUKUM</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                : <input type="text" name="penerima_bantuan" class="form-control mx-2 border-secondary border-opacity-50" value="{{ old('penerima_bantuan', $negosiasiReport->penerima_bantuan) }}" required>
                                <select name="jk_penerima" class="form-select w-auto border-secondary border-opacity-50" required>
                                    <option value="" {{ old('jk_penerima', $negosiasiReport->jk_penerima) == '' ? 'selected' : '' }}>L/P</option>
                                    <option value="L" {{ old('jk_penerima', $negosiasiReport->jk_penerima) == 'L' ? 'selected' : '' }}>L</option>
                                    <option value="P" {{ old('jk_penerima', $negosiasiReport->jk_penerima) == 'P' ? 'selected' : '' }}>P</option>
                                </select>
                                @error('jk_penerima')<div class="text-danger small ms-3">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row mb-5">
                            <label class="col-sm-4 col-form-label fw-bold py-0">NAMA NEGOSIATOR</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                : <input type="text" name="nama_negosiator" class="form-control ms-2 border-secondary border-opacity-50" value="{{ old('nama_negosiator', $negosiasiReport->nama_negosiator) }}" required>
                                @error('nama_negosiator')<div class="text-danger small ms-3">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        @php
                            $neg_cl = [];
                            foreach(($negosiasiReport->checklist_data ?? []) as $i => $item) {
                                $neg_cl[$i+1] = [
                                    'obh' => $item['obh'] ? '1' : null,
                                    'kanwil' => $item['kanwil'] ? '1' : null,
                                    'bphn' => $item['bphn'] ? '1' : null,
                                ];
                            }
                            $cl = old('checklist', $neg_cl);
                        @endphp
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
                                            '3' => 'Berita acara Negosiasi (ditandatangani oleh Pemberi Bantuan Hukum dan Penerima Bantuan Hukum)',
                                            '4' => 'Laporan Pelaksanaan Negosiasi',
                                            '5' => 'Kuitansi: Biaya Negosiator (diberi stempel OBH)',
                                            '6' => 'Kuitansi: Biaya Penggandaan dan Penjilidan Laporan Akhir',
                                        ];
                                    @endphp
                                    @foreach($berkas_list as $idx => $label)
                                        <tr>
                                            <td class="text-center fw-bold">{{ $idx }}.</td>
                                            <td class="fw-medium">{{ $label }}
                                                <input type="hidden" name="checklist[{{ $idx }}][label]" value="{{ $label }}">
                                            </td>
                                            <td class="text-center">
                                                <input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist[{{ $idx }}][obh]" value="1" {{ !empty($cl[$idx]['obh']) ? 'checked' : '' }}>
                                            </td>
                                            <td class="text-center">
                                                <input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist[{{ $idx }}][kanwil]" value="1" {{ !empty($cl[$idx]['kanwil']) ? 'checked' : '' }}>
                                            </td>
                                            <td class="text-center">
                                                <input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist[{{ $idx }}][bphn]" value="1" {{ !empty($cl[$idx]['bphn']) ? 'checked' : '' }}>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="alert border small" style="background-color: var(--bs-secondary-bg);">
                            <strong>KETERANGAN:</strong><br>
                            - Jika <strong>ada</strong> beri tanda (&check;), <strong>tidak ada</strong> biarkan kosong.<br>
                            - Form ini harus dilampirkan di atas dokumen.
                            <br>- Berkas harus disusun berdasarkan urutan nomor.
                            <br>- Kuitansi biaya negosiator harus diberi stempel OBH.
                            <br>- Berkas harus ASLI dan dapat difotokopi.
                            <br>- Semua dokumen pendukung harus disertakan sebelum diserahkan ke BPHN.
                        </div>

                        <div class="d-flex justify-content-end align-items-center pt-3 border-top">
                            <a href="{{ route('negosiasi-reports.show', $negosiasiReport) }}" class="btn btn-light border me-2 fw-medium">Batal</a>
                            <button type="submit" class="btn btn-primary fw-bold px-4 shadow-sm"><i class="fa-solid fa-save me-1"></i> Update Laporan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
