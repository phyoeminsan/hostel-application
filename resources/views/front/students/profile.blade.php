@extends('layouts.front')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    .profile-card {
        max-width: 520px;
        border-radius: 28px;
        background: #ffffff;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }
    .avatar-wrapper {
        position: relative;
        width: 120px;
        height: 120px;
        margin: 0 auto;
    }
    .avatar-img {
        width: 120px;
        height: 120px;
        object-fit: cover;
        background-color: #e2e8f0;
    }
    .upload-btn-badge {
        position: absolute;
        top: 2px;
        right: 2px;
        width: 34px;
        height: 34px;
        background-color: #f1f5f9;
        border: 2px solid #ffffff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: #64748b;
        transition: all 0.2s ease;
    }
    .upload-btn-badge:hover {
        background-color: #e2e8f0;
        color: #0f172a;
    }
    .form-control-custom, .form-select-custom {
        border-radius: 12px;
        padding: 0.75rem 1rem;
        border: 1px solid #e2e8f0;
        color: #334155;
    }
    .form-control-custom:focus, .form-select-custom:focus {
        border-color: #0d9488;
        box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.15);
    }
    .input-group-text-custom {
        background-color: transparent;
        border: 1px solid #e2e8f0;
        color: #94a3b8;
    }
    .btn-submit-theme {
        background-color: #0d9488;
        color: #ffffff;
        border-radius: 12px;
        padding: 0.8rem;
        font-weight: 600;
        border: none;
    }
    .btn-submit-theme:hover {
        background-color: #0f766e;
        color: #ffffff;
    }
</style>

<div class="container py-5 d-flex justify-content-center">
    <div class="card profile-card border-0 p-4 w-100">
        
        @if(session('success'))
            <div class="alert alert-success border-0 rounded-3 mb-4 text-center">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger border-0 rounded-3 mb-4">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('student.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Profile Image Upload Area -->
            <div class="text-center mb-4">
                <div class="avatar-wrapper">
                    <img id="avatarPreview" 
                         src="{{ $student->profile ? asset($student->profile) : 'https://via.placeholder.com/150' }}" 
                         alt="Profile" 
                         class="rounded-circle avatar-img">
                         
                    <label for="profileInput" class="upload-btn-badge" title="Upload Photo">
                        <i class="bi bi-plus-lg fs-6"></i>
                    </label>
                    <input type="file" name="profile" id="profileInput" class="d-none" accept="image/*" onchange="previewImage(event)">
                </div>
            </div>

            <!-- Roll No & Gender (Row) -->
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold text-dark small">Roll No</label>
                    <input type="text" class="form-control form-control-custom bg-light" value="{{ $student->roll_no }}" disabled>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold text-dark small">Gender</label>
                    <select name="gender" class="form-select form-select-custom bg-light" disabled>
                        <option value="Male" {{ old('gender', $student->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender', $student->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>
            </div>

            <!-- Full Name -->
            <div class="mb-3">
                <label class="form-label fw-bold text-dark small">Full Name</label>
                <div class="input-group">
                    <input type="text" name="name" class="form-control form-control-custom border-end-0" value="{{ old('name', $student->name) }}" placeholder="Your Name" required>
                    <span class="input-group-text input-group-text-custom border-start-0 rounded-end-3">
                        <i class="bi bi-person-fill"></i>
                    </span>
                </div>
            </div>

            <!-- Email Address (Readonly) -->
            <div class="mb-3">
                <label class="form-label fw-bold text-dark small">Email Address</label>
                <div class="input-group">
                    <input type="email" name="email" class="form-control form-control-custom border-end-0 bg-light" value="{{ old('email',$student->email) }}" placeholder="example@email.com">
                    <span class="input-group-text input-group-text-custom border-start-0 rounded-end-3 bg-light">
                        <i class="bi bi-envelope-fill"></i>
                    </span>
                </div>
            </div>

            <!-- NRC & Date of Birth (Row) -->
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold text-dark small">NRC No</label>
                    <input type="text" name="nrc" class="form-control form-control-custom" value="{{ old('nrc', $student->nrc) }}" placeholder="12/XXX(N)000000">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold text-dark small">Date of Birth</label>
                    <input type="date" name="date_of_birth" class="form-control form-control-custom" value="{{ old('date_of_birth', $student->date_of_birth) }}">
                </div>
            </div>

            <!-- Phone Number -->
            <div class="mb-3">
                <label class="form-label fw-bold text-dark small">Phone Number</label>
                <div class="input-group">
                    <input type="text" name="phone_no" class="form-control form-control-custom border-end-0" value="{{ old('phone_no', $student->phone_no) }}" placeholder="09123456789">
                    <span class="input-group-text input-group-text-custom border-start-0 rounded-end-3">
                        <i class="bi bi-telephone-fill"></i>
                    </span>
                </div>
            </div>

            <!-- Home Address -->
            <div class="mb-3">
                <label class="form-label fw-bold text-dark small">Home Address</label>
                <textarea name="address" class="form-control form-control-custom" rows="2" placeholder="Your Address">{{ old('address', $student->address) }}</textarea>
            </div>

            <!-- Change Password Accordion / Section -->
            <div class="mb-4">
                <a class="text-decoration-none fw-semibold small text-primary d-flex align-items-center gap-1" data-bs-toggle="collapse" href="#passwordSection" role="button">
                    <i class="bi bi-key-fill"></i> Change Password?
                </a>
                <div class="collapse mt-2" id="passwordSection">
                    <div class="card card-body border-0 bg-light rounded-3 p-3">
                        <div class="mb-2">
                            <label class="form-label fw-semibold text-dark small">New Password</label>
                            <div class="input-group">
                                <input type="password" name="password" id="passwordInput" class="form-control form-control-custom border-end-0" placeholder="Leave blank if no change">
                                <button type="button" class="input-group-text input-group-text-custom border-start-0 rounded-end-3 bg-white" onclick="togglePasswordVisibility()">
                                    <i class="bi bi-eye-slash-fill" id="toggleIcon"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit & Cancel Buttons -->
            <div class="d-grid gap-3">
                <button type="submit" class="btn btn-submit-theme">Update Profile</button>
                <a href="{{ route('index') }}" class="text-center text-secondary text-decoration-none fw-semibold small">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('avatarPreview');
            output.src = reader.result;
        };
        if(event.target.files[0]){
            reader.readAsDataURL(event.target.files[0]);
        }
    }

        function togglePasswordVisibility() {
        const passwordInput = document.getElementById('passwordInput');
        const toggleIcon = document.getElementById('toggleIcon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('bi-eye-slash-fill');
            toggleIcon.classList.add('bi-eye-fill');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('bi-eye-fill');
            toggleIcon.classList.add('bi-eye-slash-fill');
        }
    }
</script>
@endsection