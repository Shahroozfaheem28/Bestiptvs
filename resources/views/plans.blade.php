@extends('layouts.app')

@section('title', 'Subscription Plans')

@section('content')
    <style>
        .plan-card {
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: 0.3s ease;
            overflow: hidden;
            height: 100%;
        }

        .plan-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .plan-title {
            font-size: 1.25rem;
            font-weight: 600;
        }

        .plan-price {
            font-size: 2rem;
            color: #ff6600;
            font-weight: bold;
        }

        .plan-old-price {
            text-decoration: line-through;
            color: #888;
            font-size: 0.9rem;
        }

        .plan-validity {
            font-size: 0.9rem;
            color: #555;
        }

        .plan-btn {
            background-color: #ff6600;
            color: white;
            border-radius: 30px;
            font-weight: bold;
            padding: 8px 20px;
        }

        .plan-btn:hover {
            background-color: #e65c00;
        }
    </style>

    <div class="container py-5">
        <h2 class="mb-5 text-center fw-bold">Choose Your Subscription Plan</h2>
        <div class="row">
            @forelse($plans as $plan)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="plan-card bg-white p-4 d-flex flex-column">
                        <div class="mb-3">
                            <div class="plan-title">{{ $plan->title }}</div>
                            <div class="d-flex align-items-baseline gap-2">
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
                                @if ($plan->sale_price && $plan->sale_price > 0)
                                    <div class="mb-2">
                                        <span
                                            class="fw-bold fs-4 text-danger">£{{ number_format($plan->sale_price, 2) }}</span>
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
                            </div>
                            @if ($plan->validity_days == 1)
                                12-24 Hours
                            @elseif($plan->validity_days == 30)
                                1 Month
                            @elseif($plan->validity_days == 90)
                                3 Months
                            @elseif($plan->validity_days == 180)
                                6 Months
                            @elseif($plan->validity_days == 365)
                                12 Months
                            @else
                                {{ $plan->validity_days }} Days
                            @endif
                        </div>

                        <div class="mb-3 text-muted small" style="flex-grow: 1;">
                            {{ Str::limit(strip_tags($plan->description), 200) }}
                        </div>

                        <a href="{{ route('plan.show', $plan->slug) }}" class="plan-btn text-center">View Details</a>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center text-muted">No subscription plans available right now.</p>
                </div>
            @endforelse
        </div>
    </div>
    <section
        style="display: flex; flex-wrap: wrap; justify-content: center; align-items: center; padding: 40px; gap: 40px; background-color: #fff; font-family: Arial, sans-serif;">

        <!-- Left Side: Image -->
        <div style="flex: 1; min-width: 300px; text-align: center;">
            <img src="{{ asset('images/IPTV24.png') }}" alt="24hr Trial Devices" style="max-width: 100%; height: auto;">
        </div>

        <!-- Right Side: Text -->
        <div style="flex: 1; min-width: 300px;">
            <h2 style="font-size: 28px; margin-bottom: 20px;">IPTV 24Hr Trial For Free <br>
                @if ($monthlyPlan->sale_price && $monthlyPlan->sale_price > 0)
                    <span
                        class="font-weight: normal;">(£{{ number_format($monthlyPlan->sale_price ?? $monthlyPlan->price, 2) }}/Monthly)</span>
                @else
                    <span
                        class="font-weight: normal;">(£{{ number_format($monthlyPlan->price ?? $monthlyPlan->price, 2) }}/Monthly)</span>>
                @endif
            </h2>
            @php
                $rounded = round($monthlyPlan->reviews_avg_rating); // Har plan ka individual average
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

            <p style="font-size: 16px; line-height: 1.7; color: #444;">
                IPTV UK offers you a free trial to test our servers for 24 hours — enjoy unlimited access to over 20,000 TV
                channels along with popular movies and series. We are one of the leading subscription providers in the UK.
                To get started, simply visit our shop and choose a plan that suits you. With our service, you can watch
                channels from around the world in HD, Full HD, and 4K quality.
            </p>

            <p style="font-size: 16px; line-height: 1.7; color: #444;">
                Take advantage of our exclusive deals and enjoy your favorite content — movies, TV shows, and live channels
                — from any location on any device.
                Latest cinema releases are available in Full HD and translated into English, French, Spanish, Italian,
                Arabic, German, Romanian, and more.
            </p>

            <div style="margin-top: 20px; font-size: 20px; font-weight: bold;">
                Try For 1 Month — Only
                @if ($monthlyPlan->sale_price && $monthlyPlan->sale_price > 0)
                    <span class="font-weight: normal;">£{{ number_format($monthlyPlan->sale_price ?? $monthlyPlan->price, 2) }}</span>
                @else
                    <span class="font-weight: normal;">£{{ number_format($monthlyPlan->price ?? $monthlyPlan->price, 2) }}</span>>
                @endif/Monthly
            </div>

            <a href="{{ route('plans.index', ['tag' => 'Free Trial']) }}"
                style="display: inline-block; margin-top: 20px; background-color: orange; color: white; padding: 12px 24px; border-radius: 5px; text-decoration: none; font-weight: bold;">
                FREE TRIAL →
            </a>
        </div>

    </section>
@endsection
