<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Inclusive Green Energy Africa</title>

    <!-- STRONG CACHE PREVENTION -->
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate, max-age=0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- BOOTSTRAP & ICONS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #28a745, #20c997);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        .login-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            padding: 2rem;
            width: 100%;
            max-width: 400px;
        }

        .logo {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo img {
            height: 60px;
            margin-bottom: 1rem;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .input-group-text {
            background: transparent;
            border-left: none;
            cursor: pointer;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #28a745;
        }

        .spinner-border-sm {
            width: 1rem;
            height: 1rem;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="logo">
            <img src="{{ asset('images/MANGANI/LOGO.png') }}" alt="Inclusive Green Energy Africa" onerror="this.style.display='none'">
            <h4 class="text-success">Admin Login</h4>
            <p class="text-muted">Access the admin dashboard</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" id="loginForm">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror"
                       id="email" name="email" value="{{ old('email') }}" required autofocus
                       placeholder="Enter your email" autocomplete="email">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                           id="password" name="password" required placeholder="Enter your password"
                           autocomplete="current-password">
                    <span class="input-group-text" id="togglePassword">
                        <i class="bi bi-eye"></i>
                    </span>
                </div>
                @error('password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Remember Me</label>
            </div>

            <button type="submit" class="btn btn-success w-100 py-2" id="loginBtn">Login</button>
        </form>

        <div class="text-center mt-3">
            <a href="{{ route('home') }}" class="text-decoration-none text-success">
                <i class="bi bi-arrow-left"></i> Back to Website
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- FUNCTIONALITY SCRIPTS -->
    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        });

        // Cache and navigation protection
        sessionStorage.clear();
        localStorage.clear();

        if (window.performance && performance.navigation.type === 2) {
            window.location.reload(true);
        }

        history.pushState(null, null, location.href);
        window.onpopstate = function() {
            history.go(1);
            if (window.location.pathname.startsWith('/admin')) {
                window.location.href = '{{ route("login") }}';
            }
        };

        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const loginForm = document.getElementById('loginForm');
            const loginBtn = document.getElementById('loginBtn');
            if (loginForm) {
                loginForm.addEventListener('submit', function() {
                    loginBtn.disabled = true;
                    loginBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Logging in...';
                    sessionStorage.clear();
                    localStorage.clear();
                });
            }

            if (!window.location.search.includes('t=')) {
                const newUrl = window.location.href + (window.location.search ? '&' : '?') + 't=' + Date.now();
                window.history.replaceState(null, null, newUrl);
            }
        });

        document.addEventListener('visibilitychange', function() {
            if (document.hidden) sessionStorage.clear();
        });
        window.addEventListener('beforeunload', function() {
            sessionStorage.clear();
            localStorage.clear();
        });
    </script>
</body>
</html>
