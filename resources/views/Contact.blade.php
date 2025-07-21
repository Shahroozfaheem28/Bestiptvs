@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <!-- Left side: Contact Form -->
        <div class="col-md-7 mb-4">
            <h2 class="mb-4 fw-bold">Get in Touch</h2>

            {{-- Success Message --}}
            @if(session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Contact Form --}}
            <form method="POST" action="{{ route('contact.submit') }}">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">First Name*</label>
                        <input type="text" name="name" class="form-control form-control-lg rounded-3" placeholder="Enter your name" required>
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Your Phone</label>
                        <input type="text" name="phone" class="form-control form-control-lg rounded-3" placeholder="Enter your phone">
                        @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Your Email*</label>
                        <input type="email" name="email" class="form-control form-control-lg rounded-3" placeholder="Enter your email" required>
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Select Topic</label>
                        <select name="topic" class="form-select form-select-lg rounded-3">
                            <option selected disabled>Choose an option</option>
                            <option value="Support">Support</option>
                            <option value="Sales">Sales</option>
                            <option value="Other">Other</option>
                        </select>
                        @error('topic') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Your Message*</label>
                        <textarea name="message" rows="5" class="form-control form-control-lg rounded-3" placeholder="Type your message..." required></textarea>
                        @error('message') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="d-grid mt-3">
                        <button type="submit" class="btn btn-primary btn-lg rounded-3 shadow-sm">
                            <i class="fas fa-paper-plane me-1"></i> Send Message
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Right side: Direct Contact Info -->
        <div class="col-md-5">
            <div class="bg-light rounded-4 shadow-sm p-4 h-100">
                <h5 class="fw-bold mb-4">Direct Contact</h5>

                {{-- Phone --}}
                <div class="mb-3">
                    <i class="fab fa-whatsapp me-2 text-primary"></i>
                    <strong>Whatsapp:</strong><br>
                    <span class="ms-4">{{ $contact->whatsapp_number }}</span>
                </div>

                {{-- Email --}}
                <div class="mb-3">
                    <i class="fas fa-envelope me-2 text-primary"></i>
                    <strong>Email:</strong><br>
                    <span class="ms-4"><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></span>
                </div>

                {{-- Address --}}
                <div class="mb-3">
                    <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                    <strong>Address:</strong><br>
                    <span class="ms-4">{{ $contact->address }}</span>
                </div>

                <hr>

                {{-- Live Chat --}}
                <h6 class="fw-bold mb-2">Live Chat</h6>
                @php
                    $message = "Hi! I'm interested in your IPTV services. I need help. Can you assist me?";
                    $encodedMessage = urlencode($message);
                @endphp

                <a href="https://wa.me/{{ $contact->whatsapp_number }}?text={{ $encodedMessage }}" target="_blank" class="btn btn-success btn-lg w-100 mb-3">
                    <i class="fab fa-whatsapp me-2"></i> WhatsApp Us
                </a>

                {{-- FAQ Suggestion --}}
                <div class="alert alert-info mt-3 text-center mb-0">
                    <strong>Not interested to talk?</strong><br>
                    <small>Please check out our best suggested
                    <a href="{{ route('faq.page') }}" class="alert-link">Help Center & FAQ</a>.</small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Separate Section: Google Map -->
<section class="bg-light py-5 border-top">
    <div class="container-fluid">
        <h3 class="text-center fw-bold mb-4">📍 Our Location</h3>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="ratio ratio-16x9 rounded-4 shadow">
                    <iframe
                        src="https://www.google.com/maps?q={{ urlencode($contact->address) }}&output=embed"
                        allowfullscreen
                        loading="lazy"
                        style="border:0; width: 100%; height: 100%;"
                        class="rounded-4">
                    </iframe>
                </div>
                <p class="text-center mt-3 text-muted">
                    <i class="fas fa-map-marker-alt me-2"></i>{{ $contact->address }}
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
