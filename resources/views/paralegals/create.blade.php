<x-app-layout>
    <x-slot name="header">Tambah Data Paralegal Baru</x-slot>

    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-transparent py-3 d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="m-0 fw-bold text-success"><i class="fa-solid fa-user-shield me-2"></i>Form Tambah Paralegal</h6>
                        <div class="text-muted small">Tambahkan paralegal untuk penugasan permohonan.</div>
                    </div>
                    <span class="badge bg-success text-white">Baru</span>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('paralegals.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold small text-muted">Nama Lengkap</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" placeholder="Pilih akun Paralegal terlebih dahulu" required autofocus>
                            @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="no_identitas" class="form-label fw-bold small text-muted">No. KTA Paralegal/ No. Sertifikat Paralegal</label>
                            <input id="no_identitas" type="text" class="form-control @error('no_identitas') is-invalid @enderror"
                                name="no_identitas" value="{{ old('no_identitas') }}" placeholder="Contoh: PRL/001/2026" required>
                            @error('no_identitas')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            <div class="text-muted small mt-1">No KTA LBH Unsub / No SK Paralegal LBH Unsub.</div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="user_id" class="form-label fw-bold small text-muted">Email (Akun Paralegal)</label>
                                <select id="user_id" class="form-select @error('user_id') is-invalid @enderror" name="user_id" required>
                                    <option value="" data-name="">-- Pilih Akun Paralegal --</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}"
                                                data-name="{{ $user->name }}"
                                                data-email="{{ $user->email }}"
                                                {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->email }}
                                        </option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="email" id="email" value="{{ old('email') }}">
                                @error('user_id')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label fw-bold small text-muted">Nomor Telepon</label>
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" value="{{ old('phone') }}" placeholder="Contoh: 08xxxxxxxxxx" required>
                                @error('phone')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="specialization" class="form-label fw-bold small text-muted">Keahlian/Spesialisasi</label>
                            <input id="specialization" type="text" class="form-control @error('specialization') is-invalid @enderror"
                                name="specialization" value="{{ old('specialization') }}" placeholder="Contoh: Pendampingan masyarakat / Administrasi perkara" required>
                            @error('specialization')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label fw-bold small text-muted">Alamat</label>
                            <textarea id="address" class="form-control @error('address') is-invalid @enderror"
                                name="address" rows="3" placeholder="Masukkan alamat">{{ old('address') }}</textarea>
                            @error('address')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label fw-bold small text-muted">Status</label>
                            <select id="status" class="form-select @error('status') is-invalid @enderror" name="status" required>
                                <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>Aktif</option>
                                <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                            @error('status')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="notes" class="form-label fw-bold small text-muted">Catatan</label>
                            <textarea id="notes" class="form-control @error('notes') is-invalid @enderror"
                                name="notes" rows="2" placeholder="Catatan tambahan">{{ old('notes') }}</textarea>
                            @error('notes')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                            <a href="{{ route('paralegals.index') }}" class="btn btn-light fw-medium">Batalkan</a>
                            <button type="submit" class="btn btn-success fw-bold shadow-sm"><i class="fa-solid fa-save me-1"></i> Simpan Data Paralegal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('paralegals.partials.user-autofill')
</x-app-layout>
