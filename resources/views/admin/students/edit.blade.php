@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-3">

    <!-- Top Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Student Details</h3>
        </div>
    </div>

    <div id="step-student-info" class="step-section active">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5">
                    
                    <!-- Form Header Banner -->
                    <div class="card-header bg-warning bg-opacity-10 border-0 p-4">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-warning text-white p-3 d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 50px; height: 50px;">
                                <i class="fa-solid fa-user-pen fs-4"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold text-dark mb-1">Edit Student Info</h5>
                                <small class="text-secondary">Update the student's personal, academic, or registration details below.</small>
                            </div>
                        </div>
                    </div>

                    <!-- Form Body -->
                    <div class="card-body p-4">
                        <form action="{{ route('backend.students.update', $student->student_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <!-- Section 1: Academic Info -->
                            <h6 class="fw-bold text-primary mb-3">
                                <i class="fa-solid fa-graduation-cap me-2"></i>Academic Information
                            </h6>
                            <div class="row g-3 mb-4">
                                <!-- Roll No -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-dark" for="roll_no">Student Number</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fa-solid fa-user"></i></span>
                                        <input type="text" name="roll_no" class="form-control border-start-0 ps-0 @error('roll_no') is-invalid @elseif(old('roll_no')) is-valid @enderror" id="roll_no" value="{{ $student->roll_no }}">
                                        @error('roll_no')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Major -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-dark" for="major_id">Majors</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fa-solid fa-graduation-cap"></i></span>
                                        <select name="major_id" id="major_id" class="form-select border-start-0 ps-0 @error('major_id') is-invalid @elseif(old('student_id')) is-valid @enderror">
                                            <option value="">Select Majors</option>
                                            @foreach($majors as $major)
                                                <option value="{{ $major->major_id }}" {{ $student->major_id == $major->major_id ? 'selected' : '' }}>{{ $major->major_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('major_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4 text-muted opacity-25">

                            <!-- Section 2: Personal Profile -->
                            <h6 class="fw-bold text-primary mb-3">
                                <i class="fa-solid fa-user me-2"></i>Personal Details
                            </h6>
                            <div class="row g-3 mb-4">
                                <!-- Name -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-dark" for="name">Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fa-solid fa-user-gear"></i></span>
                                        <input type="text" name="name" class="form-control border-start-0 ps-0 @error('name') is-invalid @elseif(old('name')) is-valid @enderror" id="name" value="{{ $student->name }}">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Gender -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-dark" for="gender">Gender</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fa-solid fa-venus-mars"></i></span>
                                        <select name="gender" id="gender" class="form-select border-start-0 ps-0 @error('gender') is-invalid @elseif(old('gender')) is-valid @enderror" value="{{ $student->gender }}">
                                            <option value="">Select Gender</option>
                                            <option value="Male" {{ $student->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                            <option value="Female" {{ $student->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                        </select>
                                        @error('gender')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- NRC -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-dark" for="nrc">NRC</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fa-solid fa-address-card"></i></span>
                                        <input type="text" name="nrc" class="form-control border-start-0 ps-0 @error('nrc') is-invalid @elseif(old('nrc')) is-valid @enderror" id="nrc" value="{{ $student->nrc }}">
                                        @error('nrc')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Date of Birth -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-dark" for="date_of_birth">Date Of Birth</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fa-solid fa-calendar-days"></i></span>
                                        <input type="date" name="date_of_birth" class="form-control border-start-0 ps-0 @error('date_of_birth') is-invalid @elseif(old('date_of_birth')) is-valid @enderror" id="date_of_birth" value="{{ $student->date_of_birth }}">
                                        @error('date_of_birth')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Phone No -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-dark" for="phone_no">Phone No</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fa-solid fa-phone"></i></span>
                                        <input type="text" name="phone_no" class="form-control border-start-0 ps-0 @error('phone_no') is-invalid @elseif(old('phone_no')) is-valid @enderror" id="phone_no" value="{{ $student->phone_no }}">
                                        @error('phone_no')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Address -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-dark" for="address">Address</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fa-solid fa-location-dot"></i></span>
                                        <input type="text" name="address" class="form-control border-start-0 ps-0 @error('address') is-invalid @elseif(old('address')) is-valid @enderror" id="address" value="{{ $student->address }}">
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4 text-muted opacity-25">

                            <!-- Section 3: Credentials & Profile Media -->
                            <h6 class="fw-bold text-primary mb-3">
                                <i class="fa-solid fa-lock me-2"></i>Account & Media
                            </h6>
                            <div class="row g-3 mb-4">
                                <!-- Email -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-dark" for="email">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fa-solid fa-envelope"></i></span>
                                        <input type="text" name="email" class="form-control border-start-0 ps-0 @error('email') is-invalid @elseif(old('email')) is-valid @enderror" id="email" value="{{ $student->email }}">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Password (With Eye Icon) -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-dark" for="password">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fa-solid fa-key"></i></span>
                                        <input type="password" name="password" class="form-control border-start-0 border-end-0 ps-0 @error('password') is-invalid @elseif(old('password')) is-valid @enderror" id="password" value="{{ $student->password }}">
                                        <button class="btn btn-outline-secondary border-start-0 bg-light text-muted" type="button" id="togglePassword">
                                            <i class="fa-solid fa-eye" id="togglePasswordIcon"></i>
                                        </button>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Profile Selection Tabs -->
                                <div class="col-12 mt-4">
                                    <label class="form-label fw-semibold text-dark mb-2">Profile Image Setup</label>
                                    <div class="card border rounded-3 bg-light p-3">
                                        <ul class="nav nav-pills mb-3" id="myTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active rounded-pill px-4 btn-sm" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="true">
                                                    <i class="fa-solid fa-image me-1"></i> Current Profile
                                                </button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link rounded-pill px-4 btn-sm" id="new_profile-tab" data-bs-toggle="tab" data-bs-target="#new_profile-tab-pane" type="button" role="tab" aria-controls="new_profile-tab-pane" aria-selected="false">
                                                    <i class="fa-solid fa-cloud-arrow-up me-1"></i> Upload New Profile
                                                </button>
                                            </li>
                                        </ul>
                                        <div class="tab-content bg-white p-3 rounded-3 border" id="myTabContent">
                                            <div class="tab-pane fade show active text-center" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                                                <div class="d-inline-block position-relative">
                                                    <img src="{{ $student->profile }}" class="rounded-3 shadow-sm border p-1" style="max-width: 140px; max-height: 140px; object-fit: cover;" alt="Student Profile">
                                                </div>
                                                <input type="hidden" name="profile" id="" value="{{ $student->profile }}">
                                            </div>
                                            <div class="tab-pane fade" id="new_profile-tab-pane" role="tabpanel" aria-labelledby="new_profile-tab" tabindex="0">
                                                <input type="file" name="profile" class="form-control @error('profile') is-invalid @elseif(old('profile')) is-valid @enderror" id="profile" accept="image/*" value="{{ old('profile') }}">
                                            </div>
                                        </div>    
                                        @error('profile')
                                            <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4 text-muted opacity-25">

                            <!-- Action Buttons -->
                            <div class="d-flex align-items-center justify-content-end gap-2">
                                <a href="{{ route('backend.students.index') }}" class="btn btn-outline-danger border px-4 py-2 rounded-pill fw-semibold">
                                    <i class="fa-solid fa-xmark fs-8 me-1"></i> မလုပ်တော့ပါ
                                </a>
                                <button type="submit" class="btn btn-warning px-4 py-2 rounded-pill fw-semibold shadow-sm">
                                    <i class="fa-solid fa-check fs-8 me-1 text-dark"></i> ပြင်ဆင်ချက်များ သိမ်းမည်
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        // Password Show/Hide Toggle Logic
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