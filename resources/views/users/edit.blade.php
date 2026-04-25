<x-app-layout>
    <x-slot name="header">
        Edit User
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-transparent py-3 d-flex justify-content-between">
                    <h6 class="m-0 fw-bold text-primary">User Details</h6>
                    <span class="badge bg-light text-body border">{{ $user->email }}</span>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('users.update', $user) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold small text-muted">Full Name</label>
                            <input id="name" class="form-control" type="text" name="name" value="{{ old('name', $user->name) }}" required autofocus />
                            @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold small text-muted">Email Address</label>
                            <input id="email" class="form-control" type="email" name="email" value="{{ old('email', $user->email) }}" required />
                            @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold small text-muted">Password <span class="fw-normal">(Leave blank to keep current)</span></label>
                            <input id="password" class="form-control" type="password" name="password" autocomplete="new-password" />
                            @error('password')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="role" class="form-label fw-bold small text-muted">System Role</label>
                            <select id="role" name="role" class="form-select" required>
                                <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="pengacara" {{ old('role', $user->role) == 'pengacara' ? 'selected' : '' }}>Pengacara</option>
                            </select>
                            @error('role')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="d-flex justify-content-end align-items-center pt-3 border-top">
                            <a href="{{ route('users.index') }}" class="btn btn-light me-2 fw-medium">Cancel</a>
                            <button type="submit" class="btn btn-primary fw-bold shadow-sm"><i class="fa-solid fa-floppy-disk me-1"></i> Update User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
