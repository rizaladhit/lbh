<x-app-layout>
    <x-slot name="header">Edit Laporan Perdata</x-slot>

    <div class="row justify-content-center">
        <div class="col-xl-10">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 fw-bold text-primary text-center fs-5 text-uppercase">Check List Berkas Reimbursement Litigasi</h6>
                </div>
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('perdata-reports.update', $perdataReport) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-bold">OBH</label>
                            <div class="col-sm-9">
                                <input type="text" name="obh" class="form-control border-secondary border-opacity-50" value="{{ old('obh', $perdataReport->obh) }}" required>
                                @error('obh')<div class="text-danger small">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-bold">ALAMAT</label>
                            <div class="col-sm-9">
                                <input type="text" name="alamat" class="form-control border-secondary border-opacity-50" value="{{ old('alamat', $perdataReport->alamat) }}" required>
                                @error('alamat')<div class="text-danger small">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label fw-bold">PROVINSI</label>
                            <div class="col-sm-9">
                                <input type="text" name="provinsi" class="form-control border-secondary border-opacity-50" value="{{ old('provinsi', $perdataReport->provinsi) }}" required>
                                @error('provinsi')<div class="text-danger small">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <hr class="mb-4">

                        <div class="row mb-3 align-items-center">
                            <label class="col-sm-4 col-form-label fw-bold py-0">PERKARA</label>
                            <div class="col-sm-8 text-primary fw-bold">: &nbsp; PERDATA</div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label fw-bold py-0">KASUS</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                : <input type="text" name="kasus" class="form-control ms-2 border-secondary border-opacity-50" value="{{ old('kasus', $perdataReport->kasus) }}">
                                @error('kasus')<div class="text-danger small ms-2">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label fw-bold py-0">NOMOR PERKARA</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                : <input type="text" name="nomor_perkara" class="form-control ms-2 border-secondary border-opacity-50" value="{{ old('nomor_perkara', $perdataReport->nomor_perkara) }}">
                                @error('nomor_perkara')<div class="text-danger small ms-2">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label class="col-sm-4 col-form-label fw-bold py-0">PENERIMA BANTUAN HUKUM</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                : <input type="text" name="penerima_bantuan" class="form-control mx-2 border-secondary border-opacity-50" value="{{ old('penerima_bantuan', $perdataReport->penerima_bantuan) }}">
                                <select name="jk_penerima" class="form-select w-auto border-secondary border-opacity-50">
                                    <option value="">L/P</option>
                                    <option value="L" {{ old('jk_penerima', $perdataReport->jk_penerima) == 'L' ? 'selected' : '' }}>L</option>
                                    <option value="P" {{ old('jk_penerima', $perdataReport->jk_penerima) == 'P' ? 'selected' : '' }}>P</option>
                                </select>
                                @error('penerima_bantuan')<div class="text-danger small ms-2">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        @php
                            $cl = old('checklist_data', $perdataReport->checklist_data ?? []);
                        @endphp
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
                                            'item1'  => 'Surat Permohonan Bantuan Hukum',
                                            'item2'  => 'Surat Kuasa',
                                            'item3'  => 'SKTM Asli/ Legalisir Kartu JAMKESMAS/Kartu GAKIN/BLSM',
                                            'item4'  => 'Relaas/Bukti Persidangan',
                                            'item5'  => 'Pendapat hukum (legal opinion)',
                                            'item6'  => 'Somasi',
                                            'item7'  => 'Gugatan atau jawaban',
                                            'item8'  => 'Tawaran mediasi atau jawaban',
                                            'item9'  => 'Replik',
                                            'item10' => 'Putusan',
                                            'item11' => 'Memori banding atau kontra memori banding (wajib melampirkan putusan sebelumnya)',
                                            'item12' => 'Memori kasasi atau kontra memori kasasi (wajib melampirkan putusan sebelumnya)',
                                            'item13' => 'Memori peninjauan kembali atau kontra memori peninjauan kembali (wajib melampirkan putusan sebelumnya)',
                                            'item14' => 'Dokumen lain yang berkenaan dengan perkara, sebutkan:',
                                            'item15' => 'Kuitansi (diberi materai 6000 dan stempel OBH)',
                                        ];
                                        $item14_sub = ['item14_a' => 'a', 'item14_b' => 'b', 'item14_c' => 'c'];
                                    @endphp

                                    @foreach($items as $key => $label)
                                    <tr>
                                        <td class="text-center fw-bold">{{ substr($key, 4) }}.</td>
                                        <td class="fw-medium">{{ $label }}</td>
                                        @if($key !== 'item14')
                                            <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[{{ $key }}][obh]" value="1" {{ !empty($cl[$key]['obh']) ? 'checked' : '' }}></td>
                                            <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[{{ $key }}][kanwil]" value="1" {{ !empty($cl[$key]['kanwil']) ? 'checked' : '' }}></td>
                                            <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[{{ $key }}][bphn]" value="1" {{ !empty($cl[$key]['bphn']) ? 'checked' : '' }}></td>
                                        @else
                                            <td></td><td></td><td></td>
                                        @endif
                                    </tr>
                                    @if($key === 'item14')
                                        @foreach($item14_sub as $sk => $letter)
                                        <tr>
                                            <td></td>
                                            <td class="ps-3">
                                                <div class="d-flex align-items-center gap-2">
                                                    <span class="fw-semibold text-muted" style="min-width:18px;">{{ $letter }}.</span>
                                                    <input type="text" name="checklist_data[{{ $sk }}][text]" class="form-control form-control-sm border-secondary border-opacity-50" placeholder="Sebutkan dokumen..." value="{{ old('checklist_data.'.$sk.'.text', $cl[$sk]['text'] ?? '') }}">
                                                </div>
                                            </td>
                                            <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[{{ $sk }}][obh]" value="1" {{ !empty($cl[$sk]['obh']) ? 'checked' : '' }}></td>
                                            <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[{{ $sk }}][kanwil]" value="1" {{ !empty($cl[$sk]['kanwil']) ? 'checked' : '' }}></td>
                                            <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[{{ $sk }}][bphn]" value="1" {{ !empty($cl[$sk]['bphn']) ? 'checked' : '' }}></td>
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
                            - Dokumen dari pengadilan harus <strong>ASLI</strong> atau <strong>LEGALISIR</strong> Pengadilan.<br>
                            - Dokumen yang wajib dilampirkan adalah yang terdapat dalam aplikasi.
                        </div>

                        <div class="d-flex justify-content-end align-items-center pt-3 border-top">
                            <a href="{{ route('perdata-reports.show', $perdataReport) }}" class="btn btn-light border me-2 fw-medium">Batal</a>
                            <button type="submit" class="btn btn-primary fw-bold px-4 shadow-sm"><i class="fa-solid fa-save me-1"></i> Update Laporan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
