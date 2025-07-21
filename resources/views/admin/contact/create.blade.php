@extends('layouts.admin')

@section('title', 'Add Contact Info')

@section('content')
    <div class="container py-4">
        <h4>Add Contact Info</h4>
        <form action="{{ route('admin.contact.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Address</label>
                <input type="text" name="address" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="whatsapp_number" class="form-label">WhatsApp Number</label>
                <input type="text" name="whatsapp_number" id="whatsapp_number" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Create</button>
            <a href="{{ route('admin.contact.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
