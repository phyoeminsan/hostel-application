@extends('layouts.front')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<div class="container py-5 d-flex align-items-center min-vh-100">
    <div class="row justify-content-center w-100">
        <div class="col-lg-10 col-xl-9">
            <div class="card border-0 shadow-lg rounded-5 overflow-hidden">
                <div class="row g-0">
                    
                    <!-- Left Side: Image -->
                    <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center p-0 position-relative" style="background-color: #0f172a;">
                        <img src="{{ asset('front-assets/images/F.jpg') }}" alt="Hostel Image" class="w-100 h-100" style="object-fit: cover; opacity: 0.85;">
                    </div>

                    <!-- Right Side: Login Form -->
                    <div class="col-md-6 bg-white p-4 p-sm-5 d-flex flex-column justify-content-between">
                        <div>
                            <div class="text-center mb-4">
                               <h2 class="fw-bold mb-1" style="color: #0f172a;">STUDENT LOGIN</h2>
                                <p class="text-muted small">အဆောင်လျှောက်လွှာနှင့် အချက်အလက်များကို ကြည့်ရှုရန် ဝင်ရောက်ပါ</p>
                            </div>

                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                
                                <!-- Email Label & Input -->
                                <div class="mb-3">
                                    <label for="roll_no" class="form-label small fw-semibold text-dark">Student Number</label>
                                    <input type="text" name="roll_no" id="roll_no" class="form-control form-control-lg rounded-4 fs-6 bg-light border-0 px-3 py-3" placeholder="Enter student number">
                                    @error('roll_no')
                                        <span class="text-danger small ms-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Password Label & Input with Eye Toggle -->
                                <div class="mb-2">
                                    <label for="password" class="form-label small fw-semibold text-dark">Password</label>
                                    <div class="position-relative">
                                        <input type="password" name="password" id="password" class="form-control form-control-lg rounded-4 fs-6 bg-light border-0 px-3 py-3 pe-5" placeholder="Password">
                                        
                                        <button type="button" id="togglePassword" class="btn btn-link position-absolute end-0 top-50 translate-middle-y text-decoration-none pe-3 text-dark" style="z-index: 10;">
                                            <i class="bi bi-eye-slash-fill fs-5" id="eyeIcon"></i>
                                        </button>

                                        @error('password')
                                            <span class="text-danger small ms-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-end mb-4">
                                    <a href="{{ route('password.request') }}" class="small text-muted text-decoration-none">Recovery Password</a>
                                </div>

                                <button type="submit" class="btn text-white w-100 py-3 rounded-4 fw-bold shadow-sm" style="background-color: #147fe2; border: none;">
                                    Sign In
                                </button>
                            </form>
                        </div>

                        <div class="mt-4 text-center">
                            <small class="text-muted">&copy; {{ date('Y') }} UniLodge Hostel System</small>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
@endsection