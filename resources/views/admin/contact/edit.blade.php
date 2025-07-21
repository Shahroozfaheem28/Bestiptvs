@extends('layouts.admin')

@section('title', 'Edit Contact Info')

@section('content')
<div class="container py-4">
    <div class="card shadow rounded-4">
        <div class="card-header bg-primary text-white">
            <h4>Contact Info</h4>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('admin.contact.update', $info->id) }}" method="POST">
                @csrf
                 @method('PUT')  <!-- or PATCH -->

                <div class="mb-3">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $info->address ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $info->email ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="whatsapp_number">WhatsApp Number</label>
                    <input type="text" name="whatsapp_number" id="whatsapp_number" class="form-control" value="{{ old('whatsapp_number', $info->whatsapp_number ?? '') }}" required>
                </div>

                <button type="submit" class="btn btn-success">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection
