@extends('layouts.app')

@section('title', 'All Blogs')

@section('content')
<div class="container mt-5 mb-5">
    <h2 class="mb-4 text-center">Latest Blog Posts</h2>

    <div class="row">
        {{-- Blog Listing --}}
        <div class="col-md-9">
            <div class="row">
                @forelse($blogs as $blog)
                    <div class="col-md-6 mb-4">
                        <div class="card h-100 shadow-sm border-0">
                            @if($blog->image)
                                <img src="{{ asset('storage/' . $blog->image) }}" class="card-img-top" alt="{{ $blog->title }}">
                            @endif
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $blog->title }}</h5>
                                <p class="card-text text-muted small">
                                    {{ Str::limit(strip_tags($blog->content), 100) }}
                                </p>
                                <a href="{{ route('blog.show', $blog->slug) }}" class="mt-auto btn btn-primary btn-sm">
                                    Read More →
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">No blog posts found.</p>
                @endforelse
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $blogs->links() }}
            </div>
        </div>

        {{-- Sidebar: Recent Posts with image and date --}}
        <div class="col-md-3">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-primary text-white">
                    <h6 class="mb-0">Recent Posts</h6>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach($recentBlogs as $recent)
                        <li class="list-group-item p-2">
                            <div class="d-flex">
                                @if($recent->image)
                                    <img src="{{ asset('storage/' . $recent->image) }}" alt="{{ $recent->title }}"
                                         style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px;" class="me-2">
                                @endif
                                <div>
                                    <a href="{{ route('blog.show', $recent->slug) }}" class="text-dark fw-bold">
                                        {{ Str::limit($recent->title, 40) }}
                                    </a>
                                    <br>
                                    <small class="text-muted">{{ $recent->created_at->format('d M Y') }}</small>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
