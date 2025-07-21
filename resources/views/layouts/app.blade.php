<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Best IPTV UK')</title>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* WhatsApp Floating Button Style */
        a.whatsapp-float {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #25D366;
            color: white;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            z-index: 1000;
            text-decoration: none;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        a.whatsapp-float:hover {
            background-color: #128C7E;
            box-shadow: 0 6px 12px rgba(0,0,0,0.3);
        }
    </style>
</head>
<body>

@include('partials.navbar')

<div class="container mt-4">
    @yield('content')
</div>
    @php
        $message = "Hi! I'm interested in your IPTV services. Please provide details. Thanks!";
        $encodedMessage = urlencode($message);
    @endphp
<!-- WhatsApp Floating Button -->
<a href="https://wa.me/{{ $contact->whatsapp_number }}?text={{ $encodedMessage }}" target="_blank" class="whatsapp-float" aria-label="Chat on WhatsApp">
    <i class="fab fa-whatsapp" style="font-size: 30px;"></i>
</a>
@include('partials.footer')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
