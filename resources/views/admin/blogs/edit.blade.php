@extends('layouts.admin')
@section('title', 'Edit Blog')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4">Edit Blog</h2>

    <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $blog->title }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Content</label>
            <textarea name="content" id="content" class="form-control" rows="7" required>{{ $blog->content }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Current Image</label><br>
            @if($blog->image)
                <img src="{{ asset('storage/' . $blog->image) }}" width="150">
            @else
                <span>No image uploaded.</span>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Change Image (optional)</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update Blog</button>
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
