@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4 p-sm-5">
                        
                        <!-- Header -->
                        <div class="text-center mb-4">
                            <div class="bg-primary text-white d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 50px; height: 50px;">
                                <i class="bi bi-box-arrow-in-right fs-4"></i>
                            </div>
                            <h4 class="fw-bold text-dark mb-1">Welcome Back</h4>
                            <p class="text-muted small">Log in to your account</p>
                        </div>

                        <!-- Form -->
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            
                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label small font-medium">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-envelope"></i></span>
                                    <input type="email" name="email" id="email" class="form-control border-start-0" placeholder="name@example.com" required>
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label small font-medium">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-lock"></i></span>
                                    <input type="password" name="password" id="password" class="form-control border-start-0" placeholder="••••••••" required>
                                </div>
                            </div>

                            <!-- Remember Me -->
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input type="checkbox" name="remember" class="form-check-input" id="remember">
                                    <label class="form-check-label small text-secondary" for="remember">Remember me</label>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary w-100 py-2 rounded-3 fw-medium">
                                Log In
                            </button>
                        </form>

                        <!-- Footer Link -->
                        <div class="text-center mt-4">
                            <p class="small text-secondary mb-0">Don't have an account? 
                                <a href="/register" class="text-primary text-decoration-none fw-bold">Register</a>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
