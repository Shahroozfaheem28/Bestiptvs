<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

</head>
<body>
    <div class="d-flex">
        {{-- Sidebar --}}
        <div class="bg-dark text-white p-3 vh-100" style="width: 250px;">
            <h4 class="mb-4">Admin Panel</h4>
            <ul class="nav flex-column">
                <li class="nav-item mb-2"><a href="{{ route('admin.dashboard') }}" class="nav-link text-white"> <i class="fas fa-tachometer-alt me-2"></i> Dashboard</a></li>
                <li class="nav-item mb-2"><a href="{{ route('admin.categories.index') }}" class="nav-link text-white"><i class="fas fa-tags me-2"></i> Catagories</a></li>
                <li class="nav-item mb-2"><a href="{{ route('admin.plans.index') }}" class="nav-link text-white"><i class="fas fa-tv me-2"></i> Plans</a></li>
                <li class="nav-item mb-2"><a href="{{ route('admin.blogs.index') }}" class="nav-link text-white"><i class="fas fa-tv me-2"></i> Blogs</a></li>
                <li class="nav-item mb-2"><a href="{{ route('admin.pages.index') }}" class="nav-link text-white"><i class="fas fa-tv me-2"></i> Pages Policies</a></li>
                <li class="nav-item mb-2"><a href="{{ route('admin.contact.index') }}" class="nav-link text-white"><i class="fas fa-tv me-2"></i> Contact Info</a></li>
                <li class="nav-item"><a href="" class="nav-link text-white"
                  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
            </ul>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>

        {{-- Main Content --}}
        <div class="flex-grow-1 p-4">
            @yield('content')
        </div>
    </div>
    @stack('scripts')
</body>
</html>
