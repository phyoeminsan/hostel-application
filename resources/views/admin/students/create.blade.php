@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <h2 class="fw-bold text-dark mb-0">Add New Student</h2>
    </div>

    <div id="step-student-info" class="step-section active">
        <div class="card shadow-sm p-4 bg-white rounded">
            <div class="d-flex align-items-center p-3 mb-4 bg-primary-subtle rounded-3 border-start border-4 border-primary shadow-sm">
                <div class="bg-primary text-white rounded-3 p-3 d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 48px; height: 48px;">
                    <i class="fa-solid fa-user-plus fs-5"></i>
                </div>
                <div>
                    <h5 class="fw-bold text-dark mb-1">Student Personal Information</h5>
                    <small class="text-secondary">Fill in the student's personal, contact, and enrollment details below to create a new profile.</small>
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
            <form action="{{ route('backend.students.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                 <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Roll No</label>
                        <input type="text" name="roll_no" class="form-control @error('roll_no') is-invalid @elseif(old('roll_no')) is-valid
                        @enderror" id="roll_no" value="{{ old('roll_no') }}">
                        @error('roll_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @elseif(old('name')) is-valid
                        @enderror" id="name" value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Gender</label>
                        <select name="gender" id="gender" class="form-select bg-light @error('gender') is-invalid @elseif(old('gender')) is-valid @enderror" value="{{ old('gender') }}">
                                <option value="">Select Gender</option>
                                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male </option>
                                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">NRC</label>
                        <input type="text" name="nrc" class="form-control @error('nrc') is-invalid @elseif(old('nrc')) is-valid
                        @enderror" id="nrc" value="{{ old('nrc') }}">
                        @error('nrc')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Date Of Birth</label>
                        <input type="date" name="date_of_birth" class="form-control @error('date_of_birth') is-invalid @elseif(old('date_of_birth')) is-valid
                        @enderror" id="date_of_birth" value="{{ old('date_of_birth') }}">
                        @error('date_of_birth')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Phone No</label>
                        <input type="text" name="phone_no" class="form-control @error('phone_no') is-invalid @elseif(old('phone_no')) is-valid
                        @enderror" id="phone_no" value="{{ old('phone_no') }}">
                        @error('phone_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Address</label>
                        <input type="text" name="address" class="form-control @error('address') is-invalid @elseif(old('address')) is-valid
                        @enderror" id="address" value="{{ old('address') }}">
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Profile</label>
                        <input type="file" name="profile" class="form-control @error('profile') is-invalid @elseif(old('profile')) is-valid
                        @enderror" id="profile" value="{{ old('profile') }}">
                        @error('profile')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Email</label>
                        <input type="text" name="email" class="form-control @error('email') is-invalid @elseif(old('email')) is-valid
                        @enderror" id="email" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @elseif(old('password')) is-valid
                        @enderror" id="password" value="{{ old('password') }}">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mt-4 text-end">
                    <a href="{{ route('backend.students.index') }}" class="btn btn-outline-danger me-2">မလုပ်တော့ပါ</a>
                    <button type="submit" class="btn btn-primary px-4">
                        သိမ်းဆည်းမည်
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection