<x-app-layout>
    <x-slot name="header">
        Add New Category
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-transparent py-3">
                    <h6 class="m-0 fw-bold text-primary">Category Details</h6>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('categories.store') }}">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold small text-muted">Category Name</label>
                            <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" required autofocus />
                            @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="d-flex justify-content-end align-items-center pt-3 border-top">
                            <a href="{{ route('categories.index') }}" class="btn btn-light me-2 fw-medium">Cancel</a>
                            <button type="submit" class="btn btn-primary fw-bold shadow-sm"><i class="fa-solid fa-floppy-disk me-1"></i> Save Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
