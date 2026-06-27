<x-app-layout>
    <x-slot name="header">Edit Laporan Konsultasi Hukum</x-slot>

    <div class="row justify-content-center">
        <div class="col-xl-10">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 fw-bold text-primary text-center fs-5 text-uppercase">Check List Berkas Reimbursement Non Litigasi</h6>
                </div>
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('konsultasi-hukum-reports.update', $konsultasiHukumReport) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-bold">OBH</label>
                            <div class="col-sm-9">
                                <input type="text" name="obh" class="form-control border-secondary border-opacity-50" value="{{ old('obh', $konsultasiHukumReport->obh) }}" required>
                                @error('obh')<div class="text-danger small">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-bold">ALAMAT</label>
                            <div class="col-sm-9">
                                <input type="text" name="alamat" class="form-control border-secondary border-opacity-50" value="{{ old('alamat', $konsultasiHukumReport->alamat) }}" required>
                                @error('alamat')<div class="text-danger small">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label fw-bold">PROVINSI</label>
                            <div class="col-sm-9">
                                <input type="text" name="provinsi" class="form-control border-secondary border-opacity-50" value="{{ old('provinsi', $konsultasiHukumReport->provinsi) }}" required>
                                @error('provinsi')<div class="text-danger small">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <hr class="mb-4">

                        <div class="row mb-4 align-items-center">
                            <label class="col-sm-3 col-form-label fw-bold">KEGIATAN</label>
                            <div class="col-sm-9 text-primary fw-bold">: &nbsp; KONSULTASI HUKUM</div>
                        </div>

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
                        @endphp

                        @for($i = 0; $i < 5; $i++)
                        @php $sec = $konsultasiHukumReport->sections[$i] ?? []; @endphp
                        <div class="border rounded p-4 mb-4" style="background: var(--bs-secondary-bg);">
                            <h6 class="fw-bold text-uppercase mb-3 text-primary">Materi Konsultasi {{ $section_names[$i] }}</h6>

                            <div class="row mb-2">
                                <label class="col-sm-5 col-form-label fw-bold py-0" style="font-size:.9rem;">MATERI KONSULTASI {{ $section_names[$i] }}</label>
                                <div class="col-sm-7 d-flex align-items-center">
                                    : <input type="text" name="sections[{{ $i }}][materi]" class="form-control ms-2 border-secondary border-opacity-50" value="{{ old('sections.'.$i.'.materi', $sec['materi'] ?? '') }}">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label class="col-sm-5 col-form-label fw-bold py-0" style="font-size:.9rem;">TGL PELAKSANAAN KEGIATAN</label>
                                <div class="col-sm-7 d-flex align-items-center">
                                    : <input type="date" name="sections[{{ $i }}][tgl_pelaksanaan]" class="form-control ms-2 border-secondary border-opacity-50" value="{{ old('sections.'.$i.'.tgl_pelaksanaan', $sec['tgl_pelaksanaan'] ?? '') }}">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label class="col-sm-5 col-form-label fw-bold py-0" style="font-size:.9rem;">PENERIMA BANTUAN HUKUM</label>
                                <div class="col-sm-7 d-flex align-items-center">
                                    : <input type="text" name="sections[{{ $i }}][penerima_bantuan]" class="form-control mx-2 border-secondary border-opacity-50" value="{{ old('sections.'.$i.'.penerima_bantuan', $sec['penerima_bantuan'] ?? '') }}">
                                    <select name="sections[{{ $i }}][jk_penerima]" class="form-select w-auto border-secondary border-opacity-50">
                                        <option value="">L/P</option>
                                        <option value="L" {{ old('sections.'.$i.'.jk_penerima', $sec['jk_penerima'] ?? '') == 'L' ? 'selected' : '' }}>L</option>
                                        <option value="P" {{ old('sections.'.$i.'.jk_penerima', $sec['jk_penerima'] ?? '') == 'P' ? 'selected' : '' }}>P</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-5 col-form-label fw-bold py-0" style="font-size:.9rem;">NAMA KONSULTAN</label>
                                <div class="col-sm-7 d-flex align-items-center">
                                    : <input type="text" name="sections[{{ $i }}][nama_konsultan]" class="form-control ms-2 border-secondary border-opacity-50" value="{{ old('sections.'.$i.'.nama_konsultan', $sec['nama_konsultan'] ?? '') }}">
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered align-middle mb-0">
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
                                        @foreach($section_items[$i] as $key => $label)
                                        <tr>
                                            <td class="text-center fw-bold">{{ substr($key, 4) }}.</td>
                                            <td class="fw-medium">{{ $label }}</td>
                                            <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="sections[{{ $i }}][checklist][{{ $key }}][obh]" value="1" {{ old('sections.'.$i.'.checklist.'.$key.'.obh', $sec['checklist'][$key]['obh'] ?? '') ? 'checked' : '' }}></td>
                                            <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="sections[{{ $i }}][checklist][{{ $key }}][kanwil]" value="1" {{ old('sections.'.$i.'.checklist.'.$key.'.kanwil', $sec['checklist'][$key]['kanwil'] ?? '') ? 'checked' : '' }}></td>
                                            <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="sections[{{ $i }}][checklist][{{ $key }}][bphn]" value="1" {{ old('sections.'.$i.'.checklist.'.$key.'.bphn', $sec['checklist'][$key]['bphn'] ?? '') ? 'checked' : '' }}></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endfor

                        <div class="alert border small" style="background-color: var(--bs-secondary-bg);">
                            <strong>KETERANGAN:</strong><br>
                            - Jika <strong>ada</strong> beri tanda (&check;), <strong>tidak ada</strong> beri tanda (&cross;).<br>
                            - Form ini harus dilampirkan diatas dokumen.<br>
                            - Berkas harus disusun berdasarkan urutan nomor.<br>
                            - Konsultasi diajukan per-paket 5 kasus.<br>
                            - Berkas harus <strong>ASLI</strong> dan di <em>fotocopy</em>.<br>
                            - Kartu BPJS tidak diperkenankan.<br>
                            - Form laporan Konsultasi bisa dilihat di Buku Panduan Implementasi Undang-Undang Nomor 16 Tahun 2011 Tentang Bantuan Hukum.<br>
                            - Kuitansi biaya penggandaan harus dibubuhi stempel usaha fotokopi ybs. dan melampirkan bon berkop dari usaha ybs.
                        </div>

                        <div class="d-flex justify-content-end align-items-center pt-3 border-top">
                            <a href="{{ route('konsultasi-hukum-reports.show', $konsultasiHukumReport) }}" class="btn btn-light border me-2 fw-medium">Batal</a>
                            <button type="submit" class="btn btn-primary fw-bold px-4 shadow-sm"><i class="fa-solid fa-save me-1"></i> Update Laporan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
