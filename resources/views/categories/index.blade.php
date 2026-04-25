<x-app-layout>
    <x-slot name="header">
        Categories Management
    </x-slot>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-transparent py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 fw-bold text-primary"><i class="fa-solid fa-tags me-2"></i>Legal Service Categories</h6>
            <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm fw-bold shadow-sm"><i class="fa-solid fa-plus me-1"></i> Add Category</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4" style="width: 100px;">ID</th>
                            <th>Category Name</th>
                            <th class="pe-4 text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td class="ps-4 text-muted">#{{ $category->id }}</td>
                            <td class="fw-medium text-body">{{ $category->name }}</td>
                            <td class="pe-4 text-end">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-light btn-sm text-primary border" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Delete this category?');" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-light btn-sm text-danger border border-start-0" title="Delete"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @if($categories->hasPages())
        <div class="card-footer bg-transparent py-3">
            {{ $categories->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>
</x-app-layout>
