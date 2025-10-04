<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Page Title -->
    <title>@yield('title', 'Inclusive Green Energy Africa - Sustainable Energy Solutions')</title>
    
    <!-- Meta Description -->
    <meta name="description" content="@yield('description', 'Inclusive Green Energy Africa provides innovative solar energy solutions, solar home systems, and solar water pumps for sustainable development across Africa.')">
    
    <!-- Keywords -->
    <meta name="keywords" content="@yield('keywords', 'solar energy, renewable energy, solar home systems, solar water pumps, sustainable energy, Africa, Malawi')">
    
    <!-- Open Graph Meta Tags for Social Media -->
    <meta property="og:title" content="@yield('title', 'Inclusive Green Energy Africa - Sustainable Energy Solutions')">
    <meta property="og:description" content="@yield('description', 'Providing innovative solar energy solutions to drive economic growth and environmental sustainability across Africa.')">
    <meta property="og:image" content="@yield('og-image', asset('images/MANGANI/LOGO.png'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Inclusive Green Energy Africa">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'Inclusive Green Energy Africa - Sustainable Energy Solutions')">
    <meta name="twitter:description" content="@yield('description', 'Providing innovative solar energy solutions to drive economic growth and environmental sustainability across Africa.')">
    <meta name="twitter:image" content="@yield('og-image', asset('images/MANGANI/LOGO.png'))">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/MANGANI/LOGO.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/MANGANI/LOGO.png') }}">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    @yield('styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/MANGANI/LOGO.png') }}" alt="Inclusive Green Energy Africa Logo" class="navbar-logo">
               
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="{{ route('about') }}">About Us</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('products') ? 'active' : '' }}" href="{{ route('products') }}">Products & Services</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('team') ? 'active' : '' }}" href="{{ route('team') }}">Our Team</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('gallery') ? 'active' : '' }}" href="{{ route('gallery') }}">Gallery</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="copyright">
                © <span id="current-year"></span> Inclusive Green Energy Africa. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        // Set current year in footer
        document.getElementById('current-year').textContent = new Date().getFullYear();
        
        // Add smooth scrolling
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });
    </script>
    
    @yield('scripts')
</body>
</html>