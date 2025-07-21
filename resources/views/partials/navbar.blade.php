{{-- Topbar with address and login/register --}}
<div class="bg-light py-2">
  <div class="container d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center text-dark">
      <small class="me-3 d-flex align-items-center">
        <i class="fas fa-map-marker-alt me-1"></i>
        {{ $contact->address }}
      </small>
      <small class="d-flex align-items-center">
        <i class="fas fa-clock me-1"></i>
        | Opening Hours: 24/7
      </small>
    </div>

    <ul class="navbar-nav flex-row mb-0">
      @guest
        <li class="nav-item me-3"><a class="nav-link text-dark p-0" href="/login">Login</a></li>
        <li class="nav-item"><a class="nav-link text-dark p-0" href="/register">Register</a></li>
      @else
        <li class="nav-item me-3"><a class="nav-link text-dark p-0" href="/dashboard">Dashboard</a></li>
        <li class="nav-item">
          <form method="POST" action="/logout">
            @csrf
            <button class="btn btn-link nav-link text-dark p-0" type="submit" style="text-decoration: none;">Logout</button>
          </form>
        </li>
      @endguest
    </ul>
  </div>
</div>

{{-- Main Navbar --}}
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
  <div class="container">
    {{-- Logo on the left --}}
    <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
      <img src="{{ asset('images/logo.png') }}" alt="Best_IPTV UK " height="100" class="me-2">

    </a>

    {{-- Toggler for mobile --}}
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    {{-- Navbar links on the right --}}
    <div class="collapse navbar-collapse justify-content-end" id="mainNavbar">
      <ul class="navbar-nav mb-2 mb-lg-0 align-items-lg-center">
        <li class="nav-item">
          <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('/plan') ? 'active' : '' }}" href="{{ url('/plan') }}">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('plans') ? 'active' : '' }}" href="{{ url('/plans') }}">Pricing</a>
        </li>
        {{-- <li class="nav-item">
          <a class="nav-link {{ request()->is('reviews') ? 'active' : '' }}" href="{{ url('/reviews') }}">Reviews</a>
        </li> --}}
        <li class="nav-item">
          <a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="{{ url('/about') }}">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('faq') ? 'active' : '' }}" href="{{ url('/faq') }}">Faq Page</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('blogs') ? 'active' : '' }}" href="{{ url('/blogs') }}">Blogs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}" href="{{ url('/contact') }}">Contact</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('plans.index', ['tag' => 'Free Trial']) }}" class="btn btn-info get-free-trial-btn fw-bold px-4 ms-lg-3 mt-2 mt-lg-0">
             Get Free Trial &rarr;
          </a>
          <!-- <button href="/free-trial" type="button" class="btn btn-outline-info">Get Free Trial &rarr;</button> -->
        </li>
      </ul>
    </div>
  </div>
</nav>

{{-- Navbar Styles --}}
<style>
  .navbar-nav .nav-link {
    font-size: 1.15rem;
    padding-left: 1.2rem;
    padding-right: 1.2rem;
    transition: color 0.3s ease;
  }

  .navbar-nav .nav-link:hover {
    color: #0d6efd;
  }

  .navbar-nav .nav-link.active {
    font-weight: 600;
    color: #0d6efd;
  }

  .get-free-trial-btn:hover {
    background-color: #0b5ed7;
    color: #fff;
    text-decoration: none;
    box-shadow: 0 4px 12px rgba(13, 110, 253, 0.5);
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
  }

  @media (max-width: 991.98px) {
    .get-free-trial-btn {
      width: 100%;
    }
  }
   .get-free-trial-btn {
    background-color: #64bcc6ff;
    border: 1px solid #0d6efd;
    color: #ffffffff; /* dark text */
    transition: all 0.3s ease;
  }

  .get-free-trial-btn:hover {
    background-color: hsla(185, 91%, 57%, 1.00);
    color: #fff !important; /* white on hover */
    box-shadow: 0 4px 12px rgba(13, 110, 253, 0.5);
    text-decoration: none;
  }
</style>
