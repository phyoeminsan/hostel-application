@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <h2 class="fw-bold text-dark mb-0">Student Details</h2>
    </div>

    <div id="step-student-info" class="step-section active">
        <div class="card shadow-sm p-4 bg-white rounded">
            <div class="d-flex align-items-center p-3 mb-4 bg-warning-subtle rounded-3 border-start border-4 border-warning shadow-sm">
                <div class="bg-warning text-white rounded-3 p-3 d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 48px; height: 48px;">
                    <i class="fa-solid fa-user-pen fs-5"></i>
                </div>
                <div>
                    <h5 class="fw-bold text-dark mb-1">Edit Student Info</h5>
                    <small class="text-secondary">Update the student's personal, academic, or registration details below.</small>
                </div>
            </div>
            <form action="{{ route('backend.students.update', $student->student_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                 <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Roll No</label>
                        <input type="text" name="roll_no" class="form-control @error('roll_no') is-invalid @elseif(old('roll_no')) is-valid
                        @enderror" id="roll_no" value="{{ $student->roll_no }}">
                        @error('roll_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @elseif(old('name')) is-valid
                        @enderror" id="name" value="{{ $student->name }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Gender</label>
                        <select name="gender" id="gender" class="form-select bg-light @error('gender') is-invalid @elseif(old('gender')) is-valid @enderror" value="{{ $student->gender }}">
                                <option value="">Select Gender</option>
                                <option value="Male" {{ $student->gender == 'Male' ? 'selected' : '' }}>Male </option>
                                <option value="Female" {{ $student->gender == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">NRC</label>
                        <input type="text" name="nrc" class="form-control @error('nrc') is-invalid @elseif(old('nrc')) is-valid
                        @enderror" id="nrc" value="{{ $student->nrc }}">
                        @error('nrc')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Date Of Birth</label>
                        <input type="date" name="date_of_birth" class="form-control @error('date_of_birth') is-invalid @elseif(old('date_of_birth')) is-valid
                        @enderror" id="date_of_birth" value="{{ $student->date_of_birth }}">
                        @error('date_of_birth')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Phone No</label>
                        <input type="text" name="phone_no" class="form-control @error('phone_no') is-invalid @elseif(old('phone_no')) is-valid
                        @enderror" id="phone_no" value="{{ $student->phone_no }}">
                        @error('phone_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Email</label>
                        <input type="text" name="email" class="form-control @error('email') is-invalid @elseif(old('email')) is-valid
                        @enderror" id="email" value="{{ $student->email }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @elseif(old('password')) is-valid
                        @enderror" id="password" value="{{ $student->password }}">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold">Address</label>
                        <input type="text" name="address" class="form-control @error('address') is-invalid @elseif(old('address')) is-valid
                        @enderror" id="address" value="{{ $student->address }}">
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="true">Profile</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="new_profile-tab" data-bs-toggle="tab" data-bs-target="#new_profile-tab-pane" type="button" role="tab" aria-controls="new_profile-tab-pane" aria-selected="false">New profile</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                                <img src="{{ $student->profile }}" class="w-25 h-25 my-3" alt="">
                                <input type="hidden" name="profile" id="" value="{{ $student->profile }}">
                            </div>
                            <div class="tab-pane fade" id="new_profile-tab-pane" role="tabpanel" aria-labelledby="new_profile-tab" tabindex="0">
                                <input type="file" name="profile" class="form-control my-3 @error('profile') is-invalid @elseif(old('profile')) is-valid
                                @enderror" id="profile" accept="jpg,jpeg,png,webp"value="{{ old('profile') }}">
                            </div>
                        </div>    
                        @error('profile')
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