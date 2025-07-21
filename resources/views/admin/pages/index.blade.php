@extends('layouts.admin')


@section('content')
<h2>Pages</h2>
<a href="{{ route('admin.pages.create') }}" class="btn btn-success">Add New Page</a>
<table class="table mt-3">
    <tr><th>Title</th><th>Slug</th><th>Action</th></tr>
    @foreach($pages as $page)
    <tr>
        <td>{{ $page->title }}</td>
        <td>{{ $page->slug }}</td>
        <td>
            <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-primary btn-sm">Edit</a>
            <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" style="display:inline">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-sm">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection

