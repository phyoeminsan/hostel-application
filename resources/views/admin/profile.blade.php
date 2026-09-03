@extends('layouts.admin')

@section('content')
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if ($errors->has('current_password'))
    <script>
        Swal.fire({
            title: 'Password အဟောင်းလိုအပ်နေပါသည်!',
            text: 'ကျေးဇူးပြု၍ လက်ရှိအသုံးပြုနေတဲ့ password အဟောင်းကိုဖြည့်သွင်းပေးပါ။',
            icon: 'warning',
            iconColor: '#f8bb86',
            confirmButtonText: 'လက်ခံသည်',
            confirmButtonColor: '#0d6efd',
            customClass: {
                popup: 'rounded-4 p-4 shadow-lg',
                title: 'fw-bold fs-4 text-dark mb-2',
                confirmButton: 'btn btn-primary px-4 py-2 rounded-3 fw-semibold'
            },
            buttonsStyling: false
        });
    </script>
@endif

@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'အောင်မြင်ပါသည်!',
            text: '{{ session("success") }}',
            showConfirmButton: false,
            timer: 2500,
            timerProgressBar: true,
            customClass: {
                popup: 'rounded-4 shadow-lg'
            }
        });
    </script>
@endif

<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="d-flex align-items-center justify-content-between mb-4 pb-3 border-bottom">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center p-3" style="width: 52px; height: 52px;">
                <i class="fa-solid fa-user-gear fs-3"></i>
            </div>
            <div>
                <h4 class="fw-bold text-dark mb-1">Admin Profile Settings</h4>
                <p class="text-muted small mb-0">Manage your account credentials and update security preferences.</p>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Account Info Card -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-transparent border-bottom py-3 px-4">
                    <h6 class="mb-0 fw-bold text-dark d-flex align-items-center">
                        <i class="fa-solid fa-id-card text-primary me-2"></i> Account Details
                    </h6>
                </div>
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <form action="{{ route('backend.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Name Field -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary small">Administrator Name</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted">
                                    <i class="fa-solid fa-user"></i>
                                </span>
                                <input type="text" class="form-control bg-light border-start-0 text-muted" value="{{ $admin->name ?? 'Admin' }}" readonly>
                            </div>
                        </div>

                        <!-- Email Address Field -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark small">
                                Email Address <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted">
                                    <i class="fa-solid fa-envelope"></i>
                                </span>
                                <input type="email" name="email" class="form-control border-start-0 @error('email') is-invalid @enderror" value="{{ old('email', $admin->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="text-end pt-3 border-top">
                            <button type="submit" class="btn btn-primary px-4 fw-semibold rounded-3">
                                <i class="fa-solid fa-floppy-disk me-1"></i> Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Password Update Card -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-transparent border-bottom py-3 px-4">
                    <h6 class="mb-0 fw-bold text-dark d-flex align-items-center">
                        <i class="fa-solid fa-shield-halved text-danger me-2"></i> Password & Security
                    </h6>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('backend.profile.password.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Current Password -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-dark small">
                                Current Password <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted">
                                    <i class="fa-solid fa-lock"></i>
                                </span>
                                <input type="password" name="current_password" id="current_password" class="form-control border-start-0 border-end-0 @error('current_password') is-invalid @enderror" required>
                                <button class="btn btn-light border border-start-0 text-muted" type="button" onclick="togglePassword('current_password', this)">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                                @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- New Password -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-dark small">
                                New Password <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted">
                                    <i class="fa-solid fa-key"></i>
                                </span>
                                <input type="password" name="password" id="new_password" class="form-control border-start-0 border-end-0 @error('password') is-invalid @enderror" required>
                                <button class="btn btn-light border border-start-0 text-muted" type="button" onclick="togglePassword('new_password', this)">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Confirm New Password -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark small">
                                Confirm New Password <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted">
                                    <i class="fa-solid fa-key"></i>
                                </span>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control border-start-0 border-end-0" required>
                                <button class="btn btn-light border border-start-0 text-muted" type="button" onclick="togglePassword('password_confirmation', this)">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="text-end pt-3 border-top">
                            <button type="submit" class="btn btn-danger px-4 fw-semibold rounded-3">
                                <i class="fa-solid fa-key me-1"></i> Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword(inputId, btn) {
        const input = document.getElementById(inputId);
        const icon = btn.querySelector('i');
        
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }
</script>
@endsection