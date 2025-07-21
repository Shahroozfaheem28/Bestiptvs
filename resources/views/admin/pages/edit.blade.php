@extends('layouts.admin')

@section('title', 'Edit Page')


@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow rounded-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Edit Page - {{ $page->title }}</h4>
                </div>
                <div class="card-body p-4">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('admin.pages.update', $page->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">Page Title</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $page->title) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug (URL)</label>
                            <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $page->slug) }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="content" class="form-label">Content</label>
                            <textarea name="content" id="content" class="form-control" rows="10" required>{{ old('content', $page->content) }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-success">Update Page</button>
                        <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary ms-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Optional: Include TinyMCE or CKEditor --}}

<script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#content' ), {
            toolbar: [ 'heading', '|', 'bold', 'italic', 'underline', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo' ]
        })
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection
