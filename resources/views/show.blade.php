@extends('layouts.app')
@section('title', 'IPTV Shop')

@section('content')
    <style>
        .plan-card {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            transition: 0.3s ease;
            background: #fff;
        }

        .plan-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .plan-image {
            height: 180px;
            object-fit: cover;
            width: 100%;
        }

        .plan-body {
            padding: 20px;
        }

        .plan-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #333;
        }

        .plan-price {
            font-size: 1.6rem;
            color: #ff6600;
            font-weight: bold;
            display: block;
        }

        .plan-desc {
            color: #555;
            font-size: 0.9rem;
            margin: 10px 0;
        }

        .btn-buy {
            background-color: #ff6600;
            border: none;
            color: white;
            font-weight: 600;
            width: 100%;
            transition: 0.3s;
        }

        .btn-buy:hover {
            background-color: #e65c00;
        }

        .filter-box {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.05);
        }

        .filter-box h5 {
            border-bottom: 2px solid #ff6600;
            padding-bottom: 5px;
            margin-bottom: 15px;
            font-weight: bold;
        }

        /* Responsive Fixes */
        @media (max-width: 991.98px) {
            aside.col-lg-3 {
                margin-bottom: 30px;
            }
        }
    </style>

    <section class="py-5 bg-light">
        <div class="container">
            @if (isset($filterName))
                <h2 class="fw-bold mb-5">{{ $filterName }}</h2>
            @else
                <h2 class="fw-bold mb-5">IPTV UK Shop</h2>
            @endif
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row">
                <!-- Sidebar Filters -->
                <aside class="col-lg-3">
                    <div class="filter-box mb-4">
                        <h5>Categories</h5>
                        <ul class="list-unstyled">
                            @foreach ($categories as $category)
                                <li>
                                    <a href="{{ route('plans.index', ['category' => $category->id]) }}"
                                        class="badge bg-secondary mb-1 text-decoration-none">
                                        {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="filter-box">
                        <h5>Tags</h5>
                        <div>
                            @php
                                $tags = ['', '4K Quality', 'Free Trial', 'monthly IPTV service'];
                            @endphp
                            @foreach ($tags as $tag)
                                <a href="{{ route('plans.index', ['tag' => $tag]) }}"
                                    class="badge bg-secondary mb-1 text-decoration-none">{{ $tag }}</a>
                            @endforeach
                        </div>
                    </div>
                </aside>

                <!-- IPTV Plans -->
                <main class="col-lg-9">
                    <div class="row g-4">
                        @forelse($plans as $plan)
                            <div class="col-md-6 col-lg-4">
                                <div class="plan-card h-100 d-flex flex-column">
                                    @if ($plan->image)
                                        <img src="{{ asset('storage/' . $plan->image) }}" class="plan-image"
                                            alt="{{ $plan->title }}">
                                    @else
                                        <img src="https://via.placeholder.com/350x180?text=No+Image" class="plan-image"
                                            alt="No image">
                                    @endif
                                    <div class="plan-body text-center mt-auto">
                                        <h4 class="plan-title">{{ Str::limit($plan->title, 50) }}</h4>
                                        @php
                                            $rounded = round($plan->reviews_avg_rating); // Har plan ka individual average
                                        @endphp

                                        <div>
                                            {{-- Show Stars --}}
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $rounded)
                                                    <span style="color: gold;">&#9733;</span>
                                                @else
                                                    <span style="color: #ccc;">&#9733;</span>
                                                @endif
                                            @endfor
                                        </div>

                                        {{-- Price Section --}}
                                        @if ($plan->sale_price && $plan->sale_price > 0)
                                            <span class="plan-price">£{{ number_format($plan->sale_price, 2) }}</span>
                                            <span
                                                class="text-muted text-decoration-line-through">£{{ number_format($plan->price, 2) }}</span>
                                        @else
                                            <span class="plan-price">£{{ number_format($plan->price, 2) }}</span>
                                        @endif
                                        <a href="{{ route('plan.show', $plan->slug) }}" class="btn btn-buy mt-3">Buy
                                            Now</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>No plans found for selected filters.</p>
                        @endforelse
                    </div>
                </main>
            </div>
        </div>
    </section>
@endsection
