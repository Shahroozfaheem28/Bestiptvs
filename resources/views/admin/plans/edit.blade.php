@extends('layouts.admin')

@section('title', 'Edit Plan')

@section('content')
    <div class="container py-3">
        <div class="row justify-content-center">
            <div class="col-md-7">

                <div class="card shadow-sm rounded-3 border-0">
                    <div class="card-header bg-primary text-white rounded-top-3 py-2">
                        <h5 class="mb-0">Edit Plan</h5>
                    </div>

                    <div class="card-body p-3">

                        @if ($errors->any())
                            <div class="alert alert-danger rounded-2 py-2 px-3 mb-3">
                                <ul class="mb-0" style="font-size: 0.9rem;">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.plans.update', $plan->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-2">
                                <label for="title" class="form-label small fw-semibold">Title <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="title" id="title" class="form-control form-control-sm"
                                    required value="{{ old('title', $plan->title) }}">
                            </div>

                            <div class="mb-3">
                                <label for="category_id" class="form-label small fw-semibold">Category <span
                                        class="text-danger">*</span></label>
                                <select name="category_id" id="category_id" class="form-select form-select-sm" required>
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id', $plan->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="price" class="form-label small fw-semibold">Price (£) <span
                                            class="text-danger">*</span></label>
                                    <input type="number" name="price" id="price" step="0.01"
                                        class="form-control form-control-sm" required
                                        value="{{ old('price', $plan->price) }}">
                                </div>

                                <div class="col-md-6 mb-2">
                                    <label for="sale_price" class="form-label small fw-semibold">Sale Price (£)</label>
                                    <input type="number" name="sale_price" id="sale_price" step="0.01"
                                        class="form-control form-control-sm"
                                        value="{{ old('sale_price', $plan->sale_price) }}">
                                </div>
                            </div>

                            <div class="mb-2">
                                <label for="validity_days" class="form-label small fw-semibold">Validity Days <span
                                        class="text-danger">*</span></label>
                                <input type="number" name="validity_days" id="validity_days"
                                    class="form-control form-control-sm" required
                                    value="{{ old('validity_days', $plan->validity_days) }}">
                            </div>

                            <div class="mb-2">
                                <label for="description" class="form-label small fw-semibold">Description</label>
                                <textarea name="description" id="description" class="form-control form-control-sm" rows="3">{{ old('description', $plan->description) }}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="expiry_date">Expiry Date</label>
                                <input type="datetime-local" name="expiry_date" class="form-control"
                                    value="{{ old('expiry_date', \Carbon\Carbon::parse($plan->expiry_date)->format('Y-m-d\TH:i')) }}">
                            </div>
                            <div class="mb-2">
                                <label for="tags" class="form-label small fw-semibold">Tags (comma separated)</label>
                                <input type="text" name="tags" id="tags" class="form-control form-control-sm"
                                    value="{{ old('tags', $plan->tags) }}">
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label small fw-semibold">Image</label>
                                <input type="file" name="image" id="image" class="form-control form-control-sm">
                                <small class="text-muted">Leave blank if you don’t want to change the image.</small>

                                @if ($plan->image)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $plan->image) }}" alt="Plan Image"
                                            class="img-thumbnail" style="height: 100px;">
                                    </div>
                                @endif
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.plans.index') }}" class="btn btn-sm btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-sm btn-primary">Update Plan</button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
