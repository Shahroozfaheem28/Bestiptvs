@extends('layouts.admin')

@section('title', 'Create Category')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow rounded border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Create New Category</h5>
                </div>

                <div class="card-body p-3">
                    @if ($errors->any())
                        <div class="alert alert-danger small">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label small fw-semibold">Category Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control form-control-sm" required value="{{ old('name') }}" placeholder="e.g. IPTV">
                        </div>

                        <div class="mb-3">
                            <label for="slug" class="form-label small fw-semibold">Slug (optional)</label>
                            <input type="text" name="slug" id="slug" class="form-control form-control-sm" value="{{ old('slug') }}" placeholder="e.g. iptv">
                            <small class="text-muted">If left blank, slug will be generated automatically.</small>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-sm btn-success">Create Category</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
