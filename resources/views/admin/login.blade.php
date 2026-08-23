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
            position: relative;
        }
        /* Back Button Style */
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #6c757d;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .btn-back:hover {
            color: #083372;
            transform: translateX(-3px);
        }
        /* Left Section Style */
        .login-section {
            padding: 40px 50px;
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
        .btn-primary {
            background-color: #2a5ecf;
            border: none;
            border-radius: 12px;
            padding: 12px;
            font-weight: 600;
            color: #ffffff;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #06295a;
            color: #ffffff;
        }
        /* Right Section Style */
        .gradient-section {
            background-image: url('{{ asset("front-assets/images/Faculty.jpg") }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100%;
        }
    </style>
</head>
<body>

    <div class="card main-card">
        <div class="row g-0">
            <!-- Left Side: Login Form -->
            <div class="col-lg-6 login-section d-flex flex-column justify-content-between">
                <div>
                    <!-- Back Button Inside Layout -->
                    <div class="mb-3">
                        <a href="{{ route('index') }}" class="btn-back">
                            <i class="bi bi-arrow-left fs-5"></i> Back to Home
                        </a>
                    </div>

                    <div class="my-3 text-center">
                        <h1 class="brand-title mb-1">ADMIN</h1>
                        <p class="text-muted small">Welcome back to the Student Hostel Management System</p>
                    </div>

                    <form action="{{ route('admin.login') }}" method="POST">
                        @csrf

                        <!-- Email / Username Field -->
                        <div class="mb-3">
                            <label class="form-label small text-muted fw-semibold">Email or Username</label>
                            <input type="email" name="email" class="form-control" 
                            value="{{ old('email') }}" placeholder="Enter your email">
                            @error('email')
                                <span class="text-danger small ms-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div class="mb-2">
                            <label for="password" class="form-label small fw-semibold text-dark">Password</label>
                            <div class="position-relative">
                                <input type="password" name="password" id="password" class="form-control px-3 py-2 pe-5" placeholder="Password">
                                
                                <button type="button" id="togglePassword" class="btn btn-link position-absolute end-0 top-50 translate-middle-y text-decoration-none pe-3 text-dark" style="z-index: 10;">
                                    <i class="bi bi-eye-slash-fill fs-5" id="eyeIcon"></i>
                                </button>
                            </div>

                            @error('password')
                                <span class="text-danger small ms-1">{{ $message }}</span>
                            @enderror
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
                            <i class="bi bi-box-arrow-in-right me-1"></i> Sign In
                        </button>
                    </form>
                </div>

                <div class="mt-4 text-center">
                    <small class="text-muted">Students Hostel Management System &copy; {{ date('Y') }}</small>
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
        document.addEventListener('DOMContentLoaded', function () {
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password');
            const eyeIcon = document.querySelector('#eyeIcon');

            togglePassword.addEventListener('click', function () {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                
                if (type === 'text') {
                    eyeIcon.classList.remove('bi-eye-slash-fill');
                    eyeIcon.classList.add('bi-eye-fill');
                } else {
                    eyeIcon.classList.remove('bi-eye-fill');
                    eyeIcon.classList.add('bi-eye-slash-fill');
                }
            });
        });
    </script>
</body>
</html>