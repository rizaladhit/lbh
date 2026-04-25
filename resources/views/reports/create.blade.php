<x-app-layout>
    <x-slot name="header">
        Add New Report
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-transparent py-3">
                    <h6 class="m-0 fw-bold text-primary">Report Details</h6>
                </div>
                <div class="card-body p-4 p-md-5">
                    <form method="POST" action="{{ route('reports.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row g-4 mb-4">
                            <!-- Category -->
                            <div class="col-md-6">
                                <label for="category_id" class="form-label fw-bold small text-muted">Report Type</label>
                                <select id="category_id" name="category_id" class="form-select border-start border-primary border-4" required>
                                    <option value="">Select Type</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>

                            <!-- Date -->
                            <div class="col-md-6">
                                <label for="date" class="form-label fw-bold small text-muted">Date</label>
                                <input id="date" class="form-control border-start border-primary border-4" type="date" name="date" value="{{ old('date', date('Y-m-d')) }}" required />
                                @error('date')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>

                            <!-- Client Name -->
                            <div class="col-md-6">
                                <label for="client_name" class="form-label fw-bold small text-muted">Client Name</label>
                                <input id="client_name" class="form-control" type="text" name="client_name" value="{{ old('client_name') }}" required />
                                @error('client_name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>

                            <!-- Client Contact -->
                            <div class="col-md-6">
                                <label for="client_contact" class="form-label fw-bold small text-muted">Client Contact (Phone/Email)</label>
                                <input id="client_contact" class="form-control" type="text" name="client_contact" value="{{ old('client_contact') }}" required />
                                @error('client_contact')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>

                            <!-- Case Title -->
                            <div class="col-md-12">
                                <label for="case_title" class="form-label fw-bold small text-muted">Case Title</label>
                                <input id="case_title" class="form-control" type="text" name="case_title" value="{{ old('case_title') }}" required />
                                @error('case_title')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>

                            <!-- Description -->
                            <div class="col-md-12">
                                <label for="description" class="form-label fw-bold small text-muted">Description / Case Details</label>
                                <textarea id="description" name="description" rows="4" class="form-control" required>{{ old('description') }}</textarea>
                                @error('description')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>

                            <!-- Status -->
                            <div class="col-md-6">
                                <label for="status" class="form-label fw-bold small text-muted">Status</label>
                                <select id="status" name="status" class="form-select" required>
                                    <option value="Draft" {{ old('status') == 'Draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="Submitted" {{ old('status') == 'Submitted' ? 'selected' : '' }}>Submitted</option>
                                    <option value="In Progress" {{ old('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="Completed" {{ old('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                                @error('status')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>

                            <!-- Assigned User -->
                            <div class="col-md-6">
                                <label for="user_id" class="form-label fw-bold small text-muted">Assigned User</label>
                                <select id="user_id" name="user_id" class="form-select" required>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('user_id', auth()->id()) == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('user_id')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>

                            <!-- File Attachment -->
                            <div class="col-md-12 bg-light p-3 rounded border">
                                <label for="attachment" class="form-label fw-bold small text-muted">Attachment <span class="fw-normal">(Optional, max 5MB, PDF/Word/Image)</span></label>
                                <input id="attachment" type="file" name="attachment" class="form-control" />
                                @error('attachment')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>

                            <!-- Notes -->
                            <div class="col-md-12">
                                <label for="notes" class="form-label fw-bold small text-muted">Internal Notes</label>
                                <textarea id="notes" name="notes" rows="2" class="form-control" placeholder="Optional internal notes...">{{ old('notes') }}</textarea>
                                @error('notes')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end align-items-center pt-4 border-top">
                            <a href="{{ route('reports.index') }}" class="btn btn-light me-3 fw-medium">Cancel</a>
                            <button type="submit" class="btn btn-primary px-4 fw-bold shadow-sm"><i class="fa-solid fa-paper-plane me-2"></i> Submit Report</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
