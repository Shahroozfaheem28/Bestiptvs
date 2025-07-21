@extends('layouts.admin')
@section('title', 'Create Blog')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4">Create Blog</h2>

    <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Content</label>
            <textarea name="content" id="content" class="form-control" rows="7"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Image (optional)</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Create Blog</button>
        <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>

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
