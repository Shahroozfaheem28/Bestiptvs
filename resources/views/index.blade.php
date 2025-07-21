@extends('layouts.app')
@section('title', 'Best_IPTV')

@section('content')

    <style>
        /* Button Stylish Animation */
        .btn-success {
            transition: all 0.3s ease-in-out;
            position: relative;
            overflow: hidden;
            z-index: 0;
            font-weight: 600;
            letter-spacing: 0.05em;
        }

        .btn-success:hover {
            background-color: #c800ff !important;
            /* Purple glow */
            color: #fff !important;
            box-shadow: 0 0 15px rgba(200, 0, 255, 0.8);
            transform: scale(1.1);
            z-index: 1;
        }

        .btn-success::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -25%;
            width: 50%;
            height: 200%;
            background: rgba(255, 255, 255, 0.3);
            transform: rotate(25deg);
            transition: all 0.7s ease-in-out;
            opacity: 0;
            pointer-events: none;
            z-index: 0;
        }

        .btn-success:hover::before {
            opacity: 1;
            left: 120%;
            transition: all 0.7s ease-in-out;
        }

        /* Button Stylish Animation */
        .btn-primary: {
            transition: all 0.3s ease-in-out;
            position: relative;
            overflow: hidden;
            z-index: 0;
            font-weight: 600;
            letter-spacing: 0.05em;
        }

        .btn-primary:hover {
            background-color: #c800ff !important;
            /* Purple glow */
            color: #fff !important;
            box-shadow: 0 0 15px rgba(200, 0, 255, 0.8);
            transform: scale(1.1);
            z-index: 1;
        }

        .btn-light:hover {
            background-color: #c800ff !important;
            /* Purple glow */
            color: #fff !important;
            box-shadow: 0 0 15px rgba(200, 0, 255, 0.8);
            transform: scale(1.1);
            z-index: 1;
        }


        .btn-primary::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -25%;
            width: 50%;
            height: 200%;
            background: rgba(255, 255, 255, 0.3);
            transform: rotate(25deg);
            transition: all 0.7s ease-in-out;
            opacity: 0;
            pointer-events: none;
            z-index: 0;
        }

        .btn-primary:hover::before {
            opacity: 1;
            left: 120%;
            transition: all 0.7s ease-in-out;
        }


        /* Star Ratings */
        .star {
            font-size: 1.3rem;
            margin-right: 2px;
        }



        /* Feature Boxes */
        .feature-box {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: #fff;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 12px rgb(0 0 0 / 0.05);
        }

        .feature-box:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 25px rgb(0 0 0 / 0.15);
        }

        /* Limited Offer */
        section.text-center {
            background: #fff8f5;
            border-radius: 20px;
            box-shadow: 0 6px 20px rgb(0 0 0 / 0.1);

            margin: 0 auto 3rem;
            padding: 3rem 2rem;
        }

        .countdown-timer {
            font-family: 'Courier New', Courier, monospace;
            letter-spacing: 0.1em;
            font-weight: 700;
        }

        /* Package Cards */

        .package-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 35px rgb(0 0 0 / 0.15);
        }

        /* Video Section */
        .video-play-btn {
            width: 80px;
            height: 80px;
            font-size: 3rem;
            background: #007bff;
            border-radius: 50%;
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.6);
            transition: background 0.3s ease;
        }

        .video-play-btn:hover {
            background: #0056b3;
        }

        /* Trial Section */
        .trial-text h2 {
            font-size: 2rem;
            font-weight: 700;
        }

        .trial-text p {
            font-size: 1rem;
            color: #555;
            line-height: 1.6;
        }

        /* CTA Help */
        section.bg-dark {
            background: linear-gradient(135deg, #1a1a1a 0%, #2e2e2e 100%);
        }

        section.bg-dark h2,
        section.bg-dark p {
            color: #eee;
        }

        /* Blog Cards */
        .card {
            border-radius: 15px;
            transition: box-shadow 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            transform: translateY(-10px);
        }

        .card-img-top {
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            height: 200px;
        }
    </style>
@php
    use Carbon\Carbon;

    // Default values taake undefined error na aaye
    $discount = 0;
    $percent = 0;
    $expiryJsDate = null;
    $isExpired = true;

    if (isset($offerPlan) && $offerPlan->price > $offerPlan->sale_price && $offerPlan->expiry_date) {
        $discount = $offerPlan->price - $offerPlan->sale_price;
        $percent = ($discount / $offerPlan->price) * 100;
        $expiryJsDate = Carbon::parse($offerPlan->expiry_date)->format('M d, Y H:i:s');
        $isExpired = Carbon::parse($offerPlan->expiry_date)->isPast();
    }
@endphp
    {{-- HERO / PROMO --}}
    <section class="py-5 bg-white position-relative overflow-hidden">
        <div class="container">
            <div class="row align-items-center">
                <!-- Left Content -->
                <div class="col-md-6 mb-4">
                    <h1 class="display-4 fw-bold text-dark">UK IPTV Provider</h1>
                    <p class="lead text-muted mb-3">
                        Enjoy 24,000+ live channels, 98,000+ VODs, sports, and movies in stunning 4K quality. Works on all
                        devices worldwide.
                    </p>

                    @php
                        $rounded = round($monthlyPlan->reviews_avg_rating ?? 0);
                    @endphp
                    <div class="mb-3">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $rounded)
                                <span class="star text-warning">&#9733;</span>
                            @else
                                <span class="star text-muted">&#9733;</span>
                            @endif
                        @endfor
                    </div>

                    @if ($monthlyPlan)
                        <h2 class="fw-bold text-primary mb-3">£{{ number_format($monthlyPlan->sale_price, 2) }} <small
                                class="fs-6 fw-normal text-muted">/month</small></h2>
                    @endif

                    <a href="{{ url('/plans') }}" class="btn btn-success btn-lg rounded-pill px-4 shadow-sm">Start Watching
                        →</a>

                    <p class="text-success mt-3 fw-semibold">
                        @foreach ($plans as $plan)
                            @php
                                $isOneMonth = $plan->validity_days == 30;
                                $discountAmount = $plan->price - $plan->sale_price;
                                $discountPercent = $plan->price > 0 ? round(($discountAmount / $plan->price) * 100) : 0;
                            @endphp
                            @if ($isOneMonth && $discountAmount > 0)
                                <div class="plan-item">
                                    <p><i class="bi bi-check-circle-fill me-2"></i>
                                        Save £{{ number_format($discountAmount, 2) }} — {{ $discountPercent }}% for 1month!
                                    </p>
                                </div>
                            @endif
                        @endforeach
                    </p>
                </div>

                <!-- Right Image -->
                <div class="col-md-6 text-center">
                    <img src="{{ asset('images/logo.webp') }}" alt="WORLD IPTV Logo" class="img-fluid"
                        style="max-height: 300px;">
                </div>
            </div>
        </div>
    </section>

    {{-- FEATURES --}}
    <section class="py-5" style="background-color: #f9f9f9;">
        <div class="container">
            <div class="row text-center">
                @php
                    $features = [
                        [
                            'icon' => 'headset',
                            'title' => '24/7 Support',
                            'desc' => 'Support via WhatsApp, Email & Live Chat',
                        ],
                        ['icon' => 'gift', 'title' => 'Free Trial', 'desc' => 'Try before you buy — no card required'],
                        [
                            'icon' => 'tv',
                            'title' => '4K Ultra Quality',
                            'desc' => 'Crystal clear streaming — Buffer Free',
                        ],
                    ];
                @endphp

                @foreach ($features as $feature)
                    <div class="col-md-4 mb-4">
                        <div class="feature-box">
                            <i class="bi bi-{{ $feature['icon'] }} display-5 text-primary mb-3"></i>
                            <h5 class="fw-bold">{{ $feature['title'] }}</h5>
                            <p class="text-muted mb-0">{{ $feature['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- LIMITED TIME OFFER --}}

    @if ($offerPlan && $offerPlan->price > $offerPlan->sale_price)
        <section class="py-5 text-center">
            <div class="container">
                @php
                    $discount = $offerPlan->price - $offerPlan->sale_price;
                    $percent = ($discount / $offerPlan->price) * 100;
                    $expiryJsDate =
                        $offerPlan && $offerPlan->expiry_date
                            ? \Carbon\Carbon::parse($offerPlan->expiry_date)->format('M d, Y H:i:s')
                            : null;
                @endphp
                <p class="text-dark fw-bold">
                    {{ $offerPlan->title }}
                </p>
                <p class="text-success fw-bold">
                    You save £{{ number_format($discount, 2) }} ({{ round($percent) }}% off)
                </p>

                <h2 class="fw-bold mb-3">LIMITED TIME OFFER</h2>

                <p class="fs-2 fw-bold text-warning mb-0">
                    £{{ number_format($offerPlan->sale_price, 2) }}
                    <span class="fs-5 text-muted text-decoration-line-through">
                        £{{ number_format($offerPlan->price, 2) }}
                    </span>
                </p>

                <h5 class="text-danger mb-4 countdown-timer" id="countdown-timer">Loading...</h5>

                <a href="{{ route('plan.show', $offerPlan->id) }}" id="offer-btn"
                    class="btn btn-success mt-3 fw-semibold px-5 py-2 rounded-pill">
                    GET THIS OFFER NOW
                </a>
            </div>
        </section>
    @endif


    {{-- PACKAGES --}}
    <section class="py-5 bg-white text-center">
        <div class="container">
            <h2 class="fw-bold mb-2">Choose Your Plan – Simple & Affordable</h2>
            <p class="text-muted mb-5">Exclusive Limited-Time Offers!</p>

            <div class="row justify-content-center">
                @foreach ($plans as $plan)
                    <div class="col-md-4 mb-4">
                        <div class="package-card border rounded-4 shadow-sm p-4 h-100 bg-light text-start">

                            <h3 class="text-center fw-bold">
                                @if ($plan->validity_days == 30)
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
                            </h3>
                            @php
                                $rounded = round($plan->reviews_avg_rating); // Har plan ka individual average
                            @endphp

                            <div class="text-center fw-bold">
                                {{-- Show Stars --}}
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $rounded)
                                        <span style="color: gold;">&#9733;</span>
                                    @else
                                        <span style="color: #ccc;">&#9733;</span>
                                    @endif
                                @endfor
                            </div>
                            <p class="text-center text-muted mb-3">TV SUBSCRIPTION</p>

                            <ul class="list-unstyled small mb-4">
                                @php
                                    $features = [
                                        '24,000+ Channels',
                                        '98,000+ VODs',
                                        '8K, 4K, FHD, HD & SD',
                                        'Proxy / Identity Protection',
                                        'PPV Channels Access',
                                        'One Time Payment, No Contract',
                                        'Anti-Freeze Technology',
                                        'Support 24/7',
                                        '99.9% Server Uptime',
                                    ];
                                @endphp

                                @foreach ($features as $feature)
                                    <li class="mb-3 d-flex align-items-start">
                                        <div class="bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center rounded-circle me-3"
                                            style="width: 28px; height: 28px;">
                                            <i class="bi bi-check-lg"></i>
                                        </div>
                                        <span>{{ $feature }}</span>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="text-center mb-3">
                                @if ($plan->sale_price && $plan->sale_price > 0)
                                    <span class="text-danger fw-bold">£{{ number_format($plan->sale_price, 2) }}</span>
                                    <span
                                        class="text-muted text-decoration-line-through">£{{ number_format($plan->price, 2) }}</span>
                                @else
                                    <span class="text-success">£{{ number_format($plan->price, 2) }}</span>
                                @endif
                            </div>

                            <div class="text-center">
                                @php
                                    $message =
                                        "Hi, I'm interested in buying the '{$plan->title}' IPTV plan for £" .
                                        number_format($plan->sale_price ?? $plan->price, 2) .
                                        '. Please provide more details.';
                                    $encodedMessage = urlencode($message);
                                @endphp
                                <a href="https://wa.me/{{ $contact->whatsapp_number }}?text={{ $encodedMessage }}"
                                    class="btn btn-primary rounded-pill px-4 shadow-sm">Upgrade Now</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- VIDEO INSTALL SECTION --}}
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row align-items-center">
                <!-- Left Text Section -->
                <div class="col-md-6 mb-4 mb-md-0">
                    <h2 class="fw-bold mb-3">How To Install<br> Smarters Pro App On <br>Fire TV Stick 4K Max</h2>
                    <p class="mb-4 text-muted">
                        Watch the video below for a quick and easy guide. To get your login details (username &
                        password),
                        simply purchase one of our streaming plans.

                        <strong>Enjoy <span class="text-danger">{{ round($percent) }}% off</span> for a limited
                            time</strong> — don’t miss
                        this
                        exclusive offer!
                    </p>

                    <ul class="list-unstyled mb-4">
                        <li class="mb-2 text-success">✔ Watch Video</li>
                        <li class="mb-2 text-success">✔ Buy Logins</li>
                    </ul>

                    <!-- Countdown Timer -->
                      <h5 class="text-danger mb-4 countdown-timer" id="countdown-timer">Loading...</h5>
                </div>

                <!-- Right Video/Image Section -->
                <div class="col-md-6 text-center">
                    <div class="position-relative">
                        <img src="{{ asset('images/WEB.jpeg') }}" alt="Smarters Pro App" class="img-fluid" />
                        <a href="https://youtu.be/ISFfMWa_9xI" target="_blank"
                            class="position-absolute top-50 start-50 translate-middle video-play-btn d-flex align-items-center justify-content-center">
                            <i class="fas fa-play text-light"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- TRIAL SECTION --}}
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row align-items-center justify-content-center gy-4">
                <!-- Left Side: Image -->
                <div class="col-md-6 text-center">
                    <img src="{{ asset('images/IPTV24.png') }}" alt="24hr Trial Devices" class="img-fluid" />
                </div>

                <!-- Right Side: Text -->
                <div class="col-md-6 trial-text">
                    <h3 class="mb-3" style="font-size: 28px;">
                        IPTV 24Hr Trial For Free <br>
                    </h3>
                    <h1>
                        @if ($freePlan->sale_price <= 0)
                            <span style="color: #2a9a08;">Free</span><span style="color: #ccc;">/12-24 Hours</span>
                        @endif
                    </h1>


                    <p class="mb-3">
                        IPTV UK offers you a free trial to test our servers for 24 hours — enjoy unlimited access to
                        over
                        20,000 TV
                        channels along with popular movies and series. We are one of the leading subscription providers
                        in
                        the UK.
                        To get started, simply visit our shop and choose a plan that suits you. With our service, you
                        can
                        watch
                        channels from around the world in HD, Full HD, and 4K quality.
                    </p>
                    <p class="mb-3">
                        Take advantage of our exclusive deals and enjoy your favorite content — movies, TV shows, and
                        live
                        channels
                        — from any location on any device.
                        Latest cinema releases are available in Full HD and translated into English, French, Spanish,
                        Italian,
                        Arabic, German, Romanian, and more.
                    </p>
                    @php
                        $rounded = round($freePlan->reviews_avg_rating ?? 0);
                    @endphp

                    <div class="mb-3">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $rounded)
                                <span style="color: gold;">&#9733;</span>
                            @else
                                <span style="color: #ccc;">&#9733;</span>
                            @endif
                        @endfor
                    </div>
                    <div class="mt-3 mb-3 fw-bold" style="font-size: 20px;">
                        Try For 12-24 Hours — Only
                        @if ($freePlan->sale_price <= 0)
                            <span style="color: #2a9a08;">Free</span><span style="color: #ccc;">/12-24 Hours</span>
                        @endif
                    </div>
                    <a href="{{ route('plans.index', ['tag' => 'Free Trial']) }}"
                        class="btn btn-success fw-bold px-4 py-2 rounded">
                        FREE TRIAL →
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA HELP SECTION --}}
    <section class="bg-dark text-white py-5">
        <div class="container text-center">
            <h2 class="fw-bold mb-2">Need Help Choosing a Plan?</h2>
            <p class="mb-4">Let us help you pick the perfect IPTV plan for your needs.</p>
            <a href="/contact" class="btn btn-light btn-lg rounded-pill px-4">Contact Support</a>
        </div>
    </section>

    {{-- BLOGS SECTION --}}
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="fw-bold text-center mb-4">Latest From Our Blog</h2>
            <div class="row">
                @forelse($blogs as $blog)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm border-0">
                            @if ($blog->image)
                                <img src="{{ asset('storage/' . $blog->image) }}" class="card-img-top"
                                    alt="{{ $blog->title }}">
                            @else
                                <img src="" class="card-img-top" alt="Default Image">
                            @endif
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $blog->title }}</h5>
                                <p class="card-text text-muted small">
                                    {{ Str::limit(strip_tags($blog->content), 100) }}
                                </p>
                                <a href="{{ route('blog.show', $blog->slug) }}"
                                    class="mt-auto btn btn-primary rounded-pill  btn-sm">
                                    Read More →
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">No blog posts found.</p>
                @endforelse
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const expiryDate = new Date("{{ $expiryJsDate }}").getTime();
            const timerText = document.getElementById("countdown-timer");
            const btn = document.getElementById("offer-btn");

            function updateTimer() {
                const now = new Date().getTime();
                const distance = expiryDate - now;

                if (distance > 0) {
                    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    timerText.innerText = `${days}d ${hours}h ${minutes}m ${seconds}s left`;
                } else {
                    clearInterval(x);
                    timerText.innerText = "Offer expired";
                    timerText.classList.remove('text-danger');



                    btn.innerText = "Offer is expired now";
                    btn.classList.remove('btn-success');
                    btn.classList.add('btn-danger');
                    btn.removeAttribute('href');
                    btn.setAttribute('disabled', 'disabled');
                    btn.style.pointerEvents = "none";
                    btn.style.opacity = 0.6;

                }
            }

            const x = setInterval(updateTimer, 1000);
            updateTimer(); // call once instantly
        });
    </script>
@endpush
