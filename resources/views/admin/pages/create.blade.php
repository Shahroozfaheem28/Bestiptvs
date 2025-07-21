@extends('layouts.admin')

@section('title', 'Create New Page')

@section('content')
<div class="container mt-5">
    <h2>Create New Page</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Please fix the following errors:<br><br>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.pages.store') }}" method="POST">
        @csrf

        <div class="row mb-3">
            <label for="title" class="col-form-label col-sm-3">Page Title</label>
            <div class="col-sm-9">
                <input type="text" name="title" id="title" class="form-control" placeholder="Enter Page Title" required>
            </div>
        </div>

        <div class="row mb-4">
            <label for="content" class="col-form-label col-sm-3">Page Content</label>
            <div class="col-sm-9">

                <textarea name="content" id="content" class="form-control" rows="8" placeholder="Enter Page Content" required></textarea>
            </div>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Create Page</button>
            <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
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
