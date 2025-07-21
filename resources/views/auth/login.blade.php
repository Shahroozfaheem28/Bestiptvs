@extends('layouts.app')
@section('title', 'Login')

@section('content')
    <div class="container py-5 d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="row shadow-lg w-100" style="max-width: 900px; border-radius: 1rem; overflow: hidden; background: #fff;">

            {{-- Left Side - Logo/Image --}}
            <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center"
                style="background-color: #f0f0f0;">
                <img src="{{ asset('images/logo.png') }}" alt="Login Logo" class="img-fluid p-4" style="max-height: 300px;">
            </div>

            {{-- Right Side - Form --}}
            <div class="col-md-6 p-5">
                <h2 class="mb-4 text-center text-primary">Login to Your Account</h2>

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email"
                            required autofocus>
                        <label for="email">Email address</label>
                    </div>

                    <div class="form-floating mb-4 position-relative">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password"
                            required>
                        <label for="password">Password</label>
                        <span toggle="#password" class="toggle-password position-absolute"
                            style="top: 12px; right: 15px; cursor: pointer;">
                            <i class="bi bi-eye-fill"></i>
                        </span>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2">Login</button>

                    <div class="mt-3 text-center">
                        <small>Don't have an account? <a href="{{ route('register') }}">Register here</a></small>
                    </div>
                </form>
            </div>

        </div>
    </div>

    {{-- Password Show/Hide Script --}}
    @push('scripts')
        <script>
            document.querySelectorAll('.toggle-password').forEach(toggle => {
                toggle.addEventListener('click', function() {
                    const input = document.querySelector(this.getAttribute('toggle'));
                    const icon = this.querySelector('i');

                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.classList.remove('bi-eye-fill');
                        icon.classList.add('bi-eye-slash-fill');
                    } else {
                        input.type = 'password';
                        icon.classList.remove('bi-eye-slash-fill');
                        icon.classList.add('bi-eye-fill');
                    }
                });
            });
        </script>
    @endpush

@endsection
