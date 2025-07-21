@extends('layouts.app')
@section('title', 'About Us')

@section('content')
<style>
    .about-hero {
        background: url('https://iptv-uk.world/assets/about-banner.jpg') center/cover no-repeat;
        height: 300px;
        display: flex;
        align-items: center;

        color: rgb(88, 82, 82);
        font-size: 2.5rem;
        font-weight: bold;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.6);
    }

    .about-section {
        padding: 60px 0;
        background-color: #f9f9f9;
    }

    .about-section h2 {
        font-size: 2rem;
        margin-bottom: 20px;
        font-weight: bold;
    }

    .about-section p {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #333;
    }

    .about-icons i {
        font-size: 2rem;
        color: #ff6600;
        margin-right: 15px;
    }
</style>

<div class="about-hero">
    About IPTV UK World
</div>

<section class="about-section">
    <div class="container">
        <h2>Who We Are</h2>
        <p>
            At <strong>IPTV UK World</strong>, we offer premium IPTV services that deliver more than 24,000 live TV channels, movies, and sports content from around the world. Whether you’re in the UK or abroad, our service ensures uninterrupted streaming and exceptional customer support.
        </p>

        <h2 class="mt-5">Why Choose Us?</h2>
        <div class="row about-icons">
            <div class="col-md-6 mb-3 d-flex align-items-start">
                <i class="fas fa-bolt"></i>
                <p><strong>Instant Activation:</strong> No waiting – get started in minutes after purchase.</p>
            </div>
            <div class="col-md-6 mb-3 d-flex align-items-start">
                <i class="fas fa-headset"></i>
                <p><strong>24/7 Support:</strong> Our WhatsApp support is available round the clock.</p>
            </div>
            <div class="col-md-6 mb-3 d-flex align-items-start">
                <i class="fas fa-tv"></i>
                <p><strong>Works On All Devices:</strong> Smart TVs, Android, Firestick, MAG & more.</p>
            </div>
            <div class="col-md-6 mb-3 d-flex align-items-start">
                <i class="fas fa-thumbs-up"></i>
                <p><strong>Thousands of Happy Customers:</strong> Trusted and reliable service since day one.</p>
            </div>
        </div>

        <h2 class="mt-5">Our Mission</h2>
        <p>
            To bring affordable, reliable, and high-quality IPTV services to users across the UK and beyond. We believe in transparency, reliability, and customer satisfaction above all.
        </p>

        <h2 class="mt-5">Contact Us</h2>
        <p>
            For any inquiries, feel free to <a href="{{ route('contact') }}">contact us</a> via email or WhatsApp. We’re always here to help!
        </p>
    </div>
</section>
@endsection
