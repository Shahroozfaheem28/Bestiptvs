@extends('layouts.app')

@section('title', $blog->title)

@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        <!-- Left: Main Blog Content -->
        <div class="col-md-8">
            <h2 class="mb-3">{{ $blog->title }}</h2>
            <p class="text-muted">Published on {{ $blog->created_at->format('d M, Y') }}</p>

            @if($blog->image)
                <img src="{{ asset('storage/' . $blog->image) }}" class="img-fluid mb-4 rounded" alt="{{ $blog->title }}">
            @endif

            <div>{!! $blog->content !!}</div>
        </div>

        <!-- Right: Sidebar for Recent Posts -->
        <div class="col-md-4">
            <h4 class="mb-4">Recent Posts</h4>
            @foreach($recentBlogs as $recent)
                <div class="d-flex mb-3">
                    @if($recent->image)
                        <img src="{{ asset('storage/' . $recent->image) }}" alt="{{ $recent->title }}" style="width: 80px; height: 60px; object-fit: cover;" class="me-3 rounded">
                    @endif
                    <div>
                        <a href="{{ route('blog.show', $recent->slug) }}" class="fw-bold d-block text-dark">{{ Str::limit($recent->title, 50) }}</a>
                        <small class="text-muted">{{ $recent->created_at->format('d M Y') }}</small>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
