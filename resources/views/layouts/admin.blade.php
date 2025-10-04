<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Page Title -->
    <title>@yield('title', 'Admin Dashboard - Inclusive Green Energy Africa')</title>
    
    <!-- Meta Description -->
    <meta name="description" content="Admin dashboard for Inclusive Green Energy Africa - Manage website content, team members, gallery, and pages.">
    
    <!-- Keywords -->
    <meta name="keywords" content="admin dashboard, website management, content management, team management, gallery management">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="@yield('title', 'Admin Dashboard - Inclusive Green Energy Africa')">
    <meta property="og:description" content="Admin dashboard for managing Inclusive Green Energy Africa website content">
    <meta property="og:image" content="{{ asset('images/MANGANI/LOGO.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Inclusive Green Energy Africa Admin">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/MANGANI/LOGO.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/MANGANI/LOGO.png') }}">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        .sidebar {
            min-height: 100vh;
            background-color: #28a745;
            color: white;
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            z-index: 1000;
            overflow-y: auto;
            height: 100vh;
        }
        .sidebar .nav-link {
            color: white;
            padding: 10px 15px;
            margin: 5px 0;
            border-radius: 5px;
        }
        .sidebar .nav-link:hover {
            background-color: rgba(255,255,255,0.1);
        }
        .sidebar .nav-link.active {
            background-color: white;
            color: #28a745;
        }
        .navbar-admin {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            position: sticky;
            top: 0;
            z-index: 999;
        }
        .main-content {
            margin-left: 250px;
            width: calc(100% - 250px);
        }
        .sidebar-content {
            padding: 20px 15px;
        }
        
        /* Brand styling */
        .brand-container {
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 1rem 0;
            border-bottom: 1px solid rgba(255,255,255,0.2);
            margin-bottom: 1rem;
        }
        .brand-logo {
            height: 40px;
            width: auto;
            margin-right: 10px;
        }
        .brand-text {
            color: white;
            font-weight: 600;
            font-size: 1.1rem;
            line-height: 1.2;
        }
        .brand-subtitle {
            color: rgba(255,255,255,0.8);
            font-size: 0.8rem;
            margin-top: 2px;
        }
        
        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: relative;
                height: auto;
                min-height: auto;
            }
            .main-content {
                margin-left: 0;
                width: 100%;
            }
            .brand-container {
                flex-direction: column;
                text-align: center;
            }
            .brand-logo {
                margin-right: 0;
                margin-bottom: 8px;
            }
            .brand-text {
                font-size: 1rem;
            }
        }
        
        /* Custom scrollbar for sidebar */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }
        .sidebar::-webkit-scrollbar-track {
            background: rgba(255,255,255,0.1);
        }
        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.3);
            border-radius: 3px;
        }
        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255,255,255,0.5);
        }
        
        /* Alert styling */
        .alert {
            border-radius: 8px;
            border: none;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        /* Card styling */
        .card {
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border: none;
            margin-bottom: 1.5rem;
        }
        
        /* Button styling */
        .btn {
            border-radius: 6px;
            font-weight: 500;
        }
        
        /* Form styling */
        .form-control {
            border-radius: 6px;
            border: 1px solid #dee2e6;
        }
        
        /* Table styling */
        .table {
            border-radius: 8px;
            overflow: hidden;
        }
    </style>
</head>
<body>
    <div class="container-fluid p-0">
        <div class="row g-0">
            <!-- Fixed Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar">
                <div class="sidebar-content">
                    <!-- Brand Section -->
                    <div class="brand-container">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('images/MANGANI/LOGO.png') }}" 
                                 alt="Inclusive Green Energy Africa Logo" 
                                 class="brand-logo"
                                 onerror="this.style.display='none'">
                            <div class="brand-content">
                                <div class="brand-text">Inclusive Green Energy Africa</div>
                                <div class="brand-subtitle">Admin Panel</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Navigation Menu -->
                    <nav class="nav flex-column">
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                           href="{{ route('admin.dashboard') }}">
                            <i class="bi bi-speedometer2 me-2"></i>Dashboard
                        </a>
                        <a class="nav-link {{ request()->routeIs('admin.pages.*') ? 'active' : '' }}" 
                           href="{{ route('admin.pages.index') }}">
                            <i class="bi bi-file-text me-2"></i>Pages
                        </a>
                        <a class="nav-link {{ request()->routeIs('admin.team.*') ? 'active' : '' }}" 
                           href="{{ route('admin.team.index') }}">
                            <i class="bi bi-people me-2"></i>Team
                        </a>
                        <a class="nav-link {{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}" 
                           href="{{ route('admin.gallery.index') }}">
                            <i class="bi bi-images me-2"></i>Gallery
                        </a>
                        <hr>
                        <!-- View Site Link -->
                        <a class="nav-link" href="{{ url('/') }}" target="_blank" rel="noopener">
                            <i class="bi bi-eye me-2"></i>View Site
                        </a>
                        <a class="nav-link" href="{{ route('logout') }}" 
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </nav>
                </div>
            </div>

            <!-- Main content -->
            <div class="col-md-9 col-lg-10 main-content">
                <!-- Top navbar -->
                <nav class="navbar navbar-admin">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center">
                            <span class="navbar-brand fw-bold text-dark">
                                @yield('page-title', 'Admin Dashboard')
                            </span>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="navbar-text me-3 text-muted">
                                <i class="bi bi-calendar me-1"></i>{{ now()->format('F j, Y') }}
                            </span>
                            <span class="navbar-text text-muted">
                                <i class="bi bi-clock me-1"></i>{{ now()->format('g:i A') }}
                            </span>
                        </div>
                    </div>
                </nav>

                <!-- Page content -->
                <main class="p-4">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            Please fix the following errors:
                            <ul class="mb-0 mt-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Update time every minute
        function updateTime() {
            const now = new Date();
            const timeElement = document.querySelector('.navbar-text:last-child');
            if (timeElement) {
                timeElement.innerHTML = `<i class="bi bi-clock me-1"></i>${now.toLocaleTimeString([], {hour: 'numeric', minute: '2-digit'})}`;
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Update time initially and every minute
            updateTime();
            setInterval(updateTime, 60000);
            
            // Auto-dismiss alerts after 5 seconds
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });
            
            // Add active class based on current route
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.sidebar .nav-link');
            navLinks.forEach(link => {
                if (link.href === window.location.href) {
                    link.classList.add('active');
                }
            });
        });
    </script>
    @yield('scripts')
</body>
</html>