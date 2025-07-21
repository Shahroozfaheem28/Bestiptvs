@extends('layouts.admin')

@section('title', 'Contact Info List')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between mb-3">
        <h4>Contact Info List</h4>
        <a href="{{ route('admin.contact.create') }}" class="btn btn-primary">Add New</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Address</th>
                <th>Email</th>
                <th>WhatsApp</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $contact->address }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->whatsapp_number }}</td>
                    <td>
                        <a href="{{ route('admin.contact.edit', $contact->id) }}" class="btn btn-sm btn-info">Edit</a>
                        <form action="{{ route('admin.contact.destroy', $contact->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this entry?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
