@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4 py-3">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-dark mb-1">Add New Student</h3>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5">
                    
                    <div class="card-header bg-primary bg-opacity-10 border-0 p-4">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-primary text-white p-3 d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 52px; height: 52px;">
                                <i class="fa-solid fa-user-plus fs-4"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold text-dark mb-1">Student Enrollment Form</h5>
                                <p class="text-muted small mb-0">Ensure all required student details are accurate before saving.</p>
                            </div>
                        </div>
                    </div>
                    @if ($errors->any())
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        <script>
                            Swal.fire({
                                icon: 'warning',
                                title: 'အချက်အလက် မပြည့်စုံပါ!',
                                text: 'ကျေးဇူးပြု၍ လိုအပ်သော အချက်အလက်များကို ပြည့်စုံစွာ ဖြည့်သွင်းပေးပါ။',
                                confirmButtonText: 'လက်ခံသည်',
                                confirmButtonColor: '#0d6efd'
                            });
                        </script>
                    @endif
                    <div class="card-body p-4">
                        <form action="{{ route('backend.students.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <h6 class="fw-bold text-primary mb-3">
                                <i class="fa-solid fa-graduation-cap me-2"></i>Academic Details
                            </h6>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label for="roll_no" class="form-label fw-semibold text-dark">
                                        Student Number <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted">
                                            <i class="fa-solid fa-user"></i>
                                        </span>
                                        <input type="text" name="roll_no" id="roll_no" 
                                            class="form-control border-start-0 ps-0 @error('roll_no') is-invalid @elseif(old('roll_no')) is-valid @enderror" 
                                            placeholder="UCSPL-####" value="{{ old('roll_no') }}">
                                        @error('roll_no')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="major_id" class="form-label fw-semibold text-dark">
                                        Major <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted">
                                            <i class="fa-solid fa-graduation-cap"></i>
                                        </span>
                                        <select name="major_id" id="major_id" class="form-select border-start-0 ps-0 @error('major_id') is-invalid @elseif(old('major_id')) is-valid @enderror">
                                            <option value="">Select Major</option>
                                            @foreach($majors as $major)
                                                <option value="{{ $major->major_id }}" {{ old('major_id') == $major->major_id ? 'selected' : '' }}>
                                                    {{ $major->major_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('major_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4 text-muted opacity-25">

                            <h6 class="fw-bold text-primary mb-3">
                                <i class="fa-solid fa-user me-2"></i>Personal Profile Information
                            </h6>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label for="name" class="form-label fw-semibold text-dark">
                                        Full Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted">
                                            <i class="fa-solid fa-user-gear"></i>
                                        </span>
                                        <input type="text" name="name" id="name" 
                                            class="form-control border-start-0 ps-0 @error('name') is-invalid @elseif(old('name')) is-valid @enderror" 
                                            placeholder="Enter full name" value="{{ old('name') }}">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="gender" class="form-label fw-semibold text-dark">
                                        Gender <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted">
                                            <i class="fa-solid fa-venus-mars"></i>
                                        </span>
                                        <select name="gender" id="gender" class="form-select border-start-0 ps-0 @error('gender') is-invalid @elseif(old('gender')) is-valid @enderror">
                                            <option value="">Select Gender</option>
                                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                        </select>
                                        @error('gender')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="nrc" class="form-label fw-semibold text-dark">
                                        NRC <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted">
                                            <i class="fa-solid fa-address-card"></i>
                                        </span>
                                        <input type="text" name="nrc" id="nrc" 
                                            class="form-control border-start-0 ps-0 @error('nrc') is-invalid @elseif(old('nrc')) is-valid @enderror" 
                                            placeholder="12/MAMANA(N)123456" value="{{ old('nrc') }}">
                                        @error('nrc')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="date_of_birth" class="form-label fw-semibold text-dark">
                                        Date Of Birth <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                        <input type="date" name="date_of_birth" id="date_of_birth" 
                                            class="form-control border-start-0 ps-0 @error('date_of_birth') is-invalid @elseif(old('date_of_birth')) is-valid @enderror" 
                                            value="{{ old('date_of_birth') }}">
                                        @error('date_of_birth')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="phone_no" class="form-label fw-semibold text-dark">
                                        Phone Number <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted">
                                            <i class="fa-solid fa-phone"></i>
                                        </span>
                                        <input type="text" name="phone_no" id="phone_no" 
                                            class="form-control border-start-0 ps-0 @error('phone_no') is-invalid @elseif(old('phone_no')) is-valid @enderror" 
                                            placeholder="09xxxxxxxxx" value="{{ old('phone_no') }}">
                                        @error('phone_no')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="profile" class="form-label fw-semibold text-dark">
                                        Profile Picture
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted">
                                            <i class="fa-solid fa-image"></i>
                                        </span>
                                        <input type="file" name="profile" id="profile" 
                                            class="form-control border-start-0 @error('profile') is-invalid @enderror">
                                        @error('profile')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="address" class="form-label fw-semibold text-dark">
                                        Address <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted">
                                            <i class="fa-solid fa-location-dot"></i>
                                        </span>
                                        <textarea name="address" id="address" rows="3" 
                                                class="form-control border-start-0 ps-0 @error('address') is-invalid @elseif(old('address')) is-valid @enderror" 
                                                placeholder="Enter detailed street address">{{ old('address') }}</textarea>
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4 text-muted opacity-25">

                            <h6 class="fw-bold text-primary mb-3">
                                <i class="fa-solid fa-lock me-2"></i>Account Credentials
                            </h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="email" class="form-label fw-semibold text-dark">
                                        Email Address <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted">
                                            <i class="fa-solid fa-envelope"></i>
                                        </span>
                                        <input type="email" name="email" id="email" 
                                            class="form-control border-start-0 ps-0 @error('email') is-invalid @elseif(old('email')) is-valid @enderror" 
                                            placeholder="student@example.com" value="{{ old('email') }}">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="password" class="form-label fw-semibold text-dark">
                                        Password <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted">
                                            <i class="fa-solid fa-key"></i>
                                        </span>
                                        <input type="password" name="password" id="password" 
                                            class="form-control border-start-0 border-end-0 ps-0 @error('password') is-invalid @enderror" 
                                            placeholder="••••••••">
                                        <button class="btn btn-outline-secondary border-start-0 bg-light text-muted" type="button" id="togglePassword">
                                            <i class="fa-solid fa-eye" id="togglePasswordIcon"></i>
                                        </button>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4 text-muted opacity-25">

                            <div class="d-flex align-items-center justify-content-end gap-2">
                                <a href="{{ route('backend.students.index') }}" class="btn btn-outline-danger border px-4 py-2 rounded-pill fw-semibold">
                                    <i class="fa-solid fa-xmark fs-8 me-1"></i> မလုပ်တော့ပါ
                                </a>
                                <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill fw-semibold shadow-sm">
                                    <i class="fa-solid fa-check fs-8 me-1 text-light"></i> သိမ်းဆည်းမည်
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Toggle Password Visibility
        $('#togglePassword').on('click', function() {
            const passwordInput = $('#password');
            const icon = $('#togglePasswordIcon');
            
            const type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
            passwordInput.attr('type', type);
            
            icon.toggleClass('fa-eye fa-eye-slash');
        });
    });
</script>
@endsection