@extends('layouts.admin')

@section('title', 'All Plans')

@section('content')
    <div class="container mt-4">
        <h2>All Plans</h2>

        <a href="{{ route('admin.plans.create') }}" class="btn btn-primary mb-3">
            <i class="fas fa-plus"></i> Add
        </a>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Price</th>
                    <th>Duration</th>
                    <th>Tags</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($plans as $plan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if ($plan->image)
                                <img src="{{ asset('storage/' . $plan->image) }}" alt="{{ $plan->title }}"
                                    style="max-width: 100px;">
                            @endif
                        </td>
                        <td>{{ $plan->title }}</td>
                        <td>{{ $plan->slug }}</td>
                        <td>
                            @if ($plan->sale_price && $plan->sale_price > 0)
                                <span class="text-success">£{{ number_format($plan->sale_price, 2) }}</span>
                                <span
                                    class="text-muted text-decoration-line-through">£{{ number_format($plan->price, 2) }}</span>
                            @else
                                <span class="text-success">£{{ number_format($plan->price, 2) }}</span>
                            @endif
                        </td>
                        <td>
                            @if ($plan->validity_days < 30)
                                12-24Hours
                            @elseif ($plan->validity_days == 30)
                                1 Month
                            @elseif($plan->validity_days == 90)
                                3 Months
                            @elseif($plan->validity_days == 180)
                                6 Months
                            @elseif($plan->validity_days == 365)
                                12 Months
                            @endif
                        </td>
                        <td>{{ $plan->tags }}</td>
                        <td>{{ Str::limit($plan->expiry_date, 50) }}</td>
                        <td class="d-flex gap-1">

                            <a href="{{ route('admin.plans.edit', $plan->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.plans.destroy', $plan->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Are you sure? you want to delete' $plan->title)"
                                    class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                @if ($plans->count() == 0)
                    <tr>
                        <td colspan="7" class="text-center">No plans found.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection
