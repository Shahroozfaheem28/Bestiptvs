@extends('layouts.app')
@section('title', $plan->title)

@section('content')
    <style>
        .product-section {
            background-color: #f8f9fa;
            padding: 60px 0;
        }

        .product-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            padding: 30px;
        }

        .product-image {
            border-radius: 12px;
            width: 100%;
            max-height: 400px;
            object-fit: cover;
        }

        .product-title {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .product-price {
            font-size: 1.5rem;
            font-weight: bold;
            color: #ff6600;
            margin-bottom: 20px;
        }

        .btn-whatsapp {
            background-color: #25d366;
            border: none;
            color: white;
            padding: 12px 24px;
            font-weight: bold;
            border-radius: 8px;
            display: inline-block;
            transition: 0.3s ease;
        }

        .btn-whatsapp:hover {
            background-color: #1ebe5d;
            text-decoration: none;
            color: white;
        }

        .reviews p {
            margin-bottom: 0.5rem;
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

        .star-rating {
            direction: rtl;
            display: inline-flex;
            font-size: 1.5rem;
        }

        .star-rating input[type="radio"] {
            display: none;
        }

        .star-rating label {
            color: #ddd;
            cursor: pointer;
        }

        .star-rating input[type="radio"]:checked~label {
            color: #ffc107;
        }

        .star-rating label:hover,
        .star-rating label:hover~label {
            color: #ffc107;
        }
    </style>
    <section class="py-5 bg-light">
        <div class="container">
            <h1 class="product-title">{{ $plan->title }}</h1>
        </div>
    </section>
    <section class="product-section">
        <div class="container">
            <div class="row">
                <!-- Image -->
                <div class="col-md-6 mb-4">
                    @if ($plan->image)
                        <img src="{{ asset('storage/' . $plan->image) }}" alt="{{ $plan->title }}" class="product-image">
                    @else
                        <img src="https://via.placeholder.com/500x350?text=No+Image" class="product-image" alt="No Image">
                    @endif
                </div>

                <!-- Info + WhatsApp -->
                <div class="col-md-6">
                    <div class="product-card">
                        <h1 class="product-title">{{ $plan->title }}</h1>
                        <p>
                            @php
                                $rounded = round($averageRating);
                            @endphp

                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $rounded)
                                    <span style="color: gold;">&#9733;</span> {{-- filled star --}}
                                @else
                                    <span style="color: #ccc;">&#9733;</span> {{-- empty star --}}
                                @endif
                            @endfor
                        </p>
                        @if ($plan->sale_price && $plan->sale_price > 0)
                            <div class="mb-2">
                                <span class="fw-bold fs-4 text-danger">£{{ number_format($plan->sale_price, 2) }}</span>
                                <span
                                    class="text-muted text-decoration-line-through ms-2 fs-6">£{{ number_format($plan->price, 2) }}</span>
                                <span class="badge bg-success ms-2">On Sale</span>
                            </div>
                        @elseif($plan->sale_price == 0)
                            <div class="mb-2">
                                <span class="fw-bold fs-4 text-success">Free</span>
                                <span
                                    class="text-muted text-decoration-line-through ms-2 fs-6">£{{ number_format($plan->price, 2) }}</span>
                                <span class="badge bg-info ms-2">Trial</span>
                            </div>
                        @else
                            <div class="mb-2">
                                <span class="fw-bold fs-4 text-dark">£{{ number_format($plan->price, 2) }}</span>
                            </div>
                        @endif
                        <p>Enjoy a full month of premium IPTV service featuring over 24,000 live channels and an extensive
                            video-on-demand (VOD) library. Our service is compatible with all major devices including Smart
                            TVs, Firestick, Android boxes, MAG, and more. Benefit from fast activation and 24/7 dedicated
                            customer support to ensure a smooth and uninterrupted streaming experience.</p>
                        <p><strong>Category:</strong> {{ $plan->category->title ?? 'N/A' }}</p>
                        <p class="mb-2">
                            <strong>Duration:</strong>
                            <span class="ms-1">
                                @if ($plan->validity_days == 1)
                                    <span class="badge bg-info text-dark">12–24 Hours</span>
                                @elseif ($plan->validity_days == 30)
                                    <span class="badge bg-primary">1 Month</span>
                                @elseif ($plan->validity_days == 90)
                                    <span class="badge bg-primary">3 Months</span>
                                @elseif ($plan->validity_days == 180)
                                    <span class="badge bg-primary">6 Months</span>
                                @elseif ($plan->validity_days == 365)
                                    <span class="badge bg-primary">12 Months</span>
                                @else
                                    <span class="badge bg-secondary">{{ $plan->validity_days }} Days</span>
                                @endif
                            </span>
                        </p>
                        <p><strong>Tags:</strong>
                            @php
                                $tags = explode(',', $plan->tags); // convert string to array
                            @endphp
                            @foreach ($tags as $tag)
                                <a href="{{ route('plans.index', ['tag' => $tag]) }}"
                                    class="badge bg-secondary mb-1">{{ $tag }}</a>
                            @endforeach
                        </p>
                        @php

                            $message =
                                "Hi, I'm interested in buying the '{$plan->title}' IPTV plan for £" .
                                number_format($plan->sale_price ?? $plan->price, 2) .
                                '. Please provide more details.';
                            $encodedMessage = urlencode($message);
                        @endphp

                        <a href="https://wa.me/{{ $contact->whatsapp_number }}?text={{ $encodedMessage }}" target="_blank"
                            class="btn-whatsapp mt-3">
                            <i class="fab fa-whatsapp me-1"></i> Buy Now
                        </a>
                    </div>
                </div>
            </div>

            <!-- Tabs Section -->
            <div class="row mt-5">
                <div class="col-md-12">
                    <ul class="nav nav-tabs" id="productTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="desc-tab" data-bs-toggle="tab" data-bs-target="#desc"
                                type="button" role="tab">Description</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="review-tab" data-bs-toggle="tab" data-bs-target="#review"
                                type="button" role="tab">Reviews</button>
                        </li>
                    </ul>

                    <div class="tab-content product-card" id="productTabsContent">
                        <!-- Description Tab -->
                        <div class="tab-pane fade show active" id="desc" role="tabpanel">
                            <h4 class="mt-3">Description</h4>
                            <p class="product-description">{{ $plan->description }}</p>
                        </div>

                        <!-- Reviews Tab -->
                        <!-- Reviews Tab -->
                        <div class="tab-pane fade" id="review" role="tabpanel">
                            <h4 class="mt-3">Customer Reviews</h4>

                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if ($reviews->count() > 0)
                                @foreach ($reviews as $review)
                                    <div class="review-item mt-3">
                                        <h6>{{ $review->user ? $review->user->name : 'Anonymous' }}</h6>
                                        <p>
                                            @for ($i = 0; $i < $review->rating; $i++)
                                                ⭐
                                            @endfor
                                        </p>
                                        <p>{{ $review->comment }}</p>
                                    </div>
                                @endforeach
                            @else
                                <p>No reviews yet. Be the first to review this plan!</p>
                            @endif

                            @auth
                                <form action="{{ route('reviews.store') }}" method="POST" class="mt-4">
                                    @csrf
                                    <input type="hidden" name="plan_id" value="{{ $plan->id }}">

                                    {{-- ⭐ Star Rating --}}
                                    <div class="mb-3">
                                        <label class="form-label d-block">Your Rating</label>
                                        <div class="star-rating">
                                            @for ($i = 5; $i >= 1; $i--)
                                                <input type="radio" id="star{{ $i }}" name="rating"
                                                    value="{{ $i }}" required />
                                                <label for="star{{ $i }}">&#9733;</label>
                                            @endfor
                                        </div>
                                    </div>

                                    {{-- 💬 Comment --}}
                                    <div class="mb-3 mt-3">
                                        <label for="comment" class="form-label">Comment</label>
                                        <textarea name="comment" id="comment" class="form-control" rows="3" required></textarea>
                                    </div>

                                    {{-- ✅ Submit --}}
                                    <button type="submit" class="btn btn-primary">Submit Review</button>
                                </form>
                            @else
                                <p>Please <a href="{{ route('login') }}">login</a> to submit a review.</p>
                            @endauth

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Related Plans Section -->
    <section class="py-5 bg-white">
        <div class="container">
            <h3 class="mb-4">Related Plans</h3>
            <div class="row">
                @foreach ($relatedPlans as $related)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm h-100">
                            <img src="{{ asset('storage/' . $related->image) }}" class="plan-image"
                                alt="{{ $related->title }}">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $related->title }}</h5>

                                {{-- Average Rating for this related plan --}}
                                @php
                                    $avg = round($related->reviews_avg_rating); // withAvg() se ye field aati hai
                                @endphp
                                <div>
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $avg)
                                            <span style="color: gold;">&#9733;</span>
                                        @else
                                            <span style="color: #ccc;">&#9733;</span>
                                        @endif
                                    @endfor
                                    <span>({{ number_format($related->reviews_avg_rating ?? 0, 1) }})</span>
                                </div>

                                <p class="product-price mb-2">
                                    @if ($related->sale_price)
                                        <span
                                            class="text-danger fw-bold">£{{ number_format($related->sale_price, 2) }}</span>
                                        <small
                                            class="text-muted text-decoration-line-through">£{{ number_format($related->price, 2) }}</small>
                                    @else
                                        <span class="fw-bold">£{{ number_format($related->price, 2) }}</span>
                                    @endif
                                </p>
                                <a href="{{ route('plan.show', $related->slug) }}" class="btn btn-buy">Buy Now</a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>



    <!-- Bootstrap JS (if not already included) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
