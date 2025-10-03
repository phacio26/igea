<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - @yield('title', 'Inclusive Green Energy Africa')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
    </style>
</head>
<body>
    <div class="container-fluid p-0">
        <div class="row g-0">
            <!-- Fixed Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar">
                <div class="sidebar-content">
                    <div class="d-flex flex-column align-items-center py-4">
                        <img src="{{ asset('images/MANGANI/LOGO.png') }}" alt="Logo" height="40" class="mb-2" onerror="this.style.display='none'">
                        <h5 class="text-center">Admin Panel</h5>
                    </div>
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
                        <!-- FIXED: View Site Link -->
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
                        <span class="navbar-brand">Welcome, {{ Auth::user()->name ?? 'Admin' }}</span>
                        <div class="d-flex">
                            <span class="navbar-text me-3">
                                {{ now()->format('F j, Y') }}
                            </span>
                        </div>
                    </div>
                </nav>

                <!-- Page content -->
                <main class="p-4">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
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
        // Optional: Add smooth scrolling for sidebar
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.querySelector('.sidebar');
            const mainContent = document.querySelector('.main-content');
            
            // Make sidebar scroll independently
            if (sidebar && mainContent) {
                const handleScroll = function() {
                    sidebar.scrollTop = mainContent.scrollTop;
                };
                
                // Uncomment below if you want synchronized scrolling
                // mainContent.addEventListener('scroll', handleScroll);
            }
        });
    </script>
    @yield('scripts')
</body>
</html>