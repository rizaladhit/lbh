<x-app-layout>
    <x-slot name="header">
        Isi Laporan Drafting Dokumen Hukum Form
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-xl-10">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 fw-bold text-primary text-center fs-5 text-uppercase">Check List Berkas Reimbursement Non Litigasi</h6>
                </div>
                <div class="card-body p-4 p-md-5">
                    <form method="POST" action="{{ route('drafting-reports.store') }}">
                        @csrf

                        <!-- Top Header fields -->
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-bold">OBH</label>
                            <div class="col-sm-9">
                                <input type="text" name="obh" class="form-control border-secondary border-opacity-50" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-bold">ALAMAT</label>
                            <div class="col-sm-9">
                                <input type="text" name="alamat" class="form-control border-secondary border-opacity-50" required>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label fw-bold">PROVINSI</label>
                            <div class="col-sm-9">
                                <input type="text" name="provinsi" class="form-control border-secondary border-opacity-50" required>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <!-- Main Form details -->
                        <div class="row mb-3 align-items-center">
                            <label class="col-sm-4 col-form-label fw-bold py-0">KEGIATAN</label>
                            <div class="col-sm-8 text-primary fw-bold">
                                : &nbsp; DRAFTING DOKUMEN HUKUM
                                <input type="hidden" name="kegiatan" value="Drafting Dokumen Hukum">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label fw-bold py-0">TGL PELAKSANAAN KEGIATAN</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                : <input type="date" name="tgl_pelaksanaan" class="form-control ms-2 border-secondary border-opacity-50" style="max-width: 200px;" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label fw-bold py-0">KASUS</label>
                            <div class="col-sm-8 d-flex">
                                : <input type="text" name="kasus" class="form-control ms-2 border-secondary border-opacity-50" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label fw-bold py-0">PENERIMA BANTUAN HUKUM</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                : <input type="text" name="penerima_bantuan" class="form-control mx-2 border-secondary border-opacity-50" required>
                                <select name="jk_penerima" class="form-select w-auto border-secondary border-opacity-50" required>
                                    <option value="L">L</option>
                                    <option value="P">P</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label class="col-sm-4 col-form-label fw-bold py-0">NAMA DRAFTER</label>
                            <div class="col-sm-8 d-flex">
                                : <input type="text" name="nama_drafter" class="form-control ms-2 border-secondary border-opacity-50" required>
                            </div>
                        </div>

                        <!-- Checklists Table -->
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
                                            '3' => 'Dokumen hasil drafting (ditandatangani para pihak)',
                                            '4' => 'Laporan pelaksanaan drafting dokumen hukum',
                                            '5' => 'Kuitansi:'
                                        ];
                                    @endphp
                                    @foreach($berkas_list as $idx => $label)
                                    <tr>
                                        <td class="text-center fw-bold">{{ $idx }}.</td>
                                        <td class="fw-medium">{{ $label }}</td>
                                        @if($idx != 5)
                                        <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[{{ $idx }}][obh]" value="1"></td>
                                        <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[{{ $idx }}][kanwil]" value="1"></td>
                                        <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[{{ $idx }}][bphn]" value="1"></td>
                                        @else
                                        <td></td><td></td><td></td>
                                        @endif
                                    </tr>
                                    @if($idx == 5)
                                    <tr>
                                        <td></td>
                                        <td class="ps-4 text-muted fw-medium">- Biaya Drafter (diberi stempel OBH)</td>
                                        <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[5_1][obh]" value="1"></td>
                                        <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[5_1][kanwil]" value="1"></td>
                                        <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[5_1][bphn]" value="1"></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td class="ps-4 text-muted fw-medium">- Biaya penggandaan dan penjilidan laporan akhir</td>
                                        <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[5_2][obh]" value="1"></td>
                                        <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[5_2][kanwil]" value="1"></td>
                                        <td class="text-center"><input class="form-check-input border-secondary shadow-none fs-4" type="checkbox" name="checklist_data[5_2][bphn]" value="1"></td>
                                    </tr>
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
                            - Kuitansi pengadaan harus dibubuhi stempel.<br>
                            - Berkas harus ASLI dan di fotocopy.
                        </div>

                        <div class="d-flex justify-content-end align-items-center pt-3 border-top">
                            <a href="{{ route('drafting-reports.index') }}" class="btn btn-light border me-2 fw-medium">Batal</a>
                            <button type="submit" class="btn btn-primary fw-bold px-4 shadow-sm"><i class="fa-solid fa-save me-1"></i> Simpan Laporan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
