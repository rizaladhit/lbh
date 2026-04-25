<x-app-layout>
    <x-slot name="header">Edit Data Lawyer</x-slot>

    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-transparent py-3 d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="m-0 fw-bold text-primary"><i class="fa-solid fa-edit me-2"></i>Form Edit Lawyer</h6>
                        <div class="text-muted small">Perbarui data lawyer atau paralegal secara cepat dan jelas.</div>
                    </div>
                    <span class="badge bg-warning text-dark">Edit</span>
                </div>
                <div class="card-body p-4">
                        <form method="POST" action="{{ route('lawyers.update', $lawyer) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold small text-muted">Nama Lengkap</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                                name="name" value="{{ old('name', $lawyer->name) }}" placeholder="Pilih akun pengacara terlebih dahulu" required autofocus>
                            @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="no_identitas" class="form-label fw-bold small text-muted">Nomor Identitas (SIU/No. Advokat)</label>
                            <input id="no_identitas" type="text" class="form-control @error('no_identitas') is-invalid @enderror" 
                                name="no_identitas" value="{{ old('no_identitas', $lawyer->no_identitas) }}" placeholder="Contoh: SIU/001/2024" required>
                            @error('no_identitas')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            <div class="text-muted small mt-1">Nomor SIU atau Nomor Advokat yang unik.</div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="user_id" class="form-label fw-bold small text-muted">Email (Akun Pengacara)</label>
                                <select id="user_id" class="form-select @error('user_id') is-invalid @enderror" name="user_id" required>
                                    <option value="" data-name="">-- Pilih Akun Pengacara --</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" 
                                                data-name="{{ $user->name }}" 
                                                data-email="{{ $user->email }}"
                                                {{ old('user_id', $lawyer->user_id) == $user->id ? 'selected' : '' }}>
                                            {{ $user->email }}
                                        </option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="email" id="email" value="{{ old('email', $lawyer->email) }}">
                                @error('user_id')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label fw-bold small text-muted">Nomor Telepon</label>
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" 
                                    name="phone" value="{{ old('phone', $lawyer->phone) }}" placeholder="Contoh: 08xxxxxxxxxx" required>
                                @error('phone')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="specialization" class="form-label fw-bold small text-muted">Keahlian/Spesialisasi</label>
                            <select id="specialization" class="form-select @error('specialization') is-invalid @enderror" 
                                name="specialization" required>
                                <option value="">-- Pilih Keahlian --</option>
                                <option value="Hukum Pidana" {{ old('specialization', $lawyer->specialization) === 'Hukum Pidana' ? 'selected' : '' }}>Hukum Pidana</option>
                                <option value="Hukum Perdata" {{ old('specialization', $lawyer->specialization) === 'Hukum Perdata' ? 'selected' : '' }}>Hukum Perdata</option>
                                <option value="Hukum Keluarga" {{ old('specialization', $lawyer->specialization) === 'Hukum Keluarga' ? 'selected' : '' }}>Hukum Keluarga</option>
                                <option value="Hukum Kerja" {{ old('specialization', $lawyer->specialization) === 'Hukum Kerja' ? 'selected' : '' }}>Hukum Kerja</option>
                                <option value="Hukum Tata Negara" {{ old('specialization', $lawyer->specialization) === 'Hukum Tata Negara' ? 'selected' : '' }}>Hukum Tata Negara</option>
                                <option value="Hukum Administrasi" {{ old('specialization', $lawyer->specialization) === 'Hukum Administrasi' ? 'selected' : '' }}>Hukum Administrasi</option>
                                <option value="Lainnya" {{ old('specialization', $lawyer->specialization) === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('specialization')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label fw-bold small text-muted">Alamat</label>
                            <textarea id="address" class="form-control @error('address') is-invalid @enderror" 
                                name="address" rows="3" placeholder="Masukkan alamat kantor atau alamat pribadi">{{ old('address', $lawyer->address) }}</textarea>
                            @error('address')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label fw-bold small text-muted">Status</label>
                            <select id="status" class="form-select @error('status') is-invalid @enderror" 
                                name="status" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="active" {{ old('status', $lawyer->status) === 'active' ? 'selected' : '' }}>Aktif</option>
                                <option value="inactive" {{ old('status', $lawyer->status) === 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                            @error('status')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="notes" class="form-label fw-bold small text-muted">Catatan</label>
                            <textarea id="notes" class="form-control @error('notes') is-invalid @enderror" 
                                name="notes" rows="2" placeholder="Catatan tambahan tentang lawyer">{{ old('notes', $lawyer->notes) }}</textarea>
                            @error('notes')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                            <a href="{{ route('lawyers.show', $lawyer) }}" class="btn btn-light fw-medium">Batalkan</a>
                            <button type="submit" class="btn btn-primary fw-bold shadow-sm"><i class="fa-solid fa-save me-1"></i> Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('user_id').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const name = selectedOption.getAttribute('data-name');
            const email = selectedOption.getAttribute('data-email');
            
            const nameInput = document.getElementById('name');
            const emailInput = document.getElementById('email');
            
            if (name && email) {
                nameInput.value = name;
                emailInput.value = email;
                nameInput.readOnly = true;
                emailInput.readOnly = true;
                nameInput.classList.add('bg-light');
                emailInput.classList.add('bg-light');
            } else {
                nameInput.readOnly = false;
                emailInput.readOnly = false;
                nameInput.classList.remove('bg-light');
                emailInput.classList.remove('bg-light');
            }
        });

        // Trigger on load for existing data
        window.addEventListener('load', function() {
            const userIdSelect = document.getElementById('user_id');
            if (userIdSelect.value) {
                userIdSelect.dispatchEvent(new Event('change'));
            }
        });
    </script>
</x-app-layout>
