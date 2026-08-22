<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal - Login</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background-color: #eef2f7;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
        }
        .main-card {
            width: 100%;
            max-width: 960px;
            border: none;
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            background: #ffffff;
        }
        /* Left Section Style */
        .login-section {
            padding: 50px;
        }
        .brand-title {
            font-size: 2.2rem;
            font-weight: 800;
            letter-spacing: -0.5px;
            color: #1a1d20;
        }
        .form-control {
            border-radius: 12px;
            padding: 12px 16px;
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
        }
        .form-control:focus {
            background-color: #ffffff;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
        }
        .input-group-text {
            border-radius: 12px;
            border: 1px solid #e9ecef;
        }
        .btn-login {
            background-color: #111827;
            border: none;
            border-radius: 12px;
            padding: 12px;
            font-weight: 600;
            color: #ffffff;
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            background-color: #1f2937;
            color: #ffffff;
        }
        /* Right Section Style */
       .gradient-section {
            background-image: url('/front-assets/images/Faculty.jpg'); /* မိမိပုံ Path သို့ ပြောင်းပါ */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100%;
        }
        .top-nav .btn-join {
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 20px;
            color: #ffffff;
            padding: 6px 18px;
            font-size: 0.875rem;
        }
        .top-nav .btn-join:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
        }
        .hero-title {
            font-size: 2rem;
            font-weight: 700;
            line-height: 1.3;
        }
        .toggle-password {
            cursor: pointer;
        }
    </style>
</head>
<body>

    <div class="card main-card">
        <div class="row g-0">
            <!-- Left Side: Login Form -->
            <div class="col-lg-6 login-section d-flex flex-column justify-content-between">
                <div>
                    <div class="my-4">
                        <h1 class="brand-title mb-1">ADMIN</h1>
                        <p class="text-muted small">Welcome back to the Student Hostel Portal</p>
                    </div>

                    <form action="{{ route('admin.login') }}" method="POST">
                        @csrf

                        <!-- Email / Username Field -->
                        <div class="mb-3">
                            <label class="form-label small text-muted fw-semibold">Email or Username</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                            value="{{ old('email') }}" placeholder="Enter your email">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div class="mb-3">
                            <label class="form-label small text-muted fw-semibold">Password</label>
                            <div class="input-group">
                                <input type="password" name="password" id="passwordInput" class="form-control @error('password') is-invalid @enderror" placeholder="••••••••">
                                <span class="input-group-text bg-light text-muted toggle-password" id="togglePassword">
                                    <i class="bi bi-eye-slash" id="toggleIcon"></i>
                                </span>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Forgot Password & Remember -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label small text-muted" for="remember">
                                    Remember me
                                </label>
                            </div>
                            <a href="#" class="small text-decoration-none text-primary fw-semibold">Forgot Password?</a>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-box-arrow-in-right me-1"></i>Sign In
                        </button>
                    </form>
                </div>

                <div class="mt-4 text-center">
                    <small class="text-muted">Students Hostel Management System &copy; 2026</small>
                </div>
            </div>

            <!-- Right Side: Background Image Only -->
            <div class="col-lg-6 gradient-section d-none d-lg-block">
            </div>
        </div>
    </div>

    <!-- Alert Scripts -->
    @if ($errors->has('email') || $errors->has('password'))
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'အချက်အလက် လိုအပ်နေပါသည်!',
                text: 'ကျေးဇူးပြု၍ Email သို့မဟုတ် Username နှင့် Password ဖြည့်သွင်းပေးပါ',
                confirmButtonColor: '#f39c12',
                confirmButtonText: 'နားလည်ပါပြီ'
            });
        </script>
    @endif
    @if ($errors->has('auth_failed'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'ဝင်ရောက်၍ မရပါ!',
                text: '{{ $errors->first("auth_failed") }}',
                confirmButtonColor: '#d33',
                confirmButtonText: 'ပြန်လည်ကြိုးစားပါ'
            });
        </script>
    @endif

    <!-- Password Toggle Script -->
    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordInput = document.getElementById('passwordInput');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('bi-eye-slash');
                toggleIcon.classList.add('bi-eye');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('bi-eye');
                toggleIcon.classList.add('bi-eye-slash');
            }
        });
    </script>
</body>
</html>