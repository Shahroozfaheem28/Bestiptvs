@extends('layouts.admin')
@section('title', 'Manage Blogs')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4">Blog Management</h2>
    <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary mb-3">+ Create New Blog</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Image</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($blogs as $blog)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $blog->title }}</td>
                    <td>{{ $blog->slug }}</td>
                    <td>
                        @if($blog->image)
                            <img src="{{ asset('storage/' . $blog->image) }}" width="80">
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $blog->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Are you sure to delete this blog?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                    <tr><td colspan="6" class="text-center">No blogs found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
