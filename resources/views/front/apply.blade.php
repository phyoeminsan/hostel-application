@extends('layouts.front')
@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="bg-primary text-white p-4 position-relative">
                        <span class="badge bg-primary-subtle text-primary mb-2 px-3 py-1 rounded-pill fw-medium">Accommodation</span>
                        <h5 class="fw-bold fs-4 mb-0">Hostel Application Form - {{ $hostel->hostel_name }}</h5>
                        <p class="text-white-50 fs-7 mb-0 mt-1">Please fill in your academic and personal details below.</p>
                    </div>

                    <div class="card-body p-4 p-md-5 bg-light-subtle">
                        <form action="{{ route('hostels.apply.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="hostel_id" value="{{ $hostel->hostel_id }}">
                            <input type="hidden" name="record_id" value="{{ $student_record->record_id ?? ''}}">

                            <!-- Academic Details -->
                            <div class="mb-4">
                                <h6 class="text-uppercase text-muted fw-bold fs-7 mb-3">
                                    <i class="bi bi-mortarboard me-1 text-primary"></i> Academic Details
                                </h6>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label text-secondary fw-semibold small">Academic Year</label>
                                        <input type="text" name="academic_year" class="form-control form-control-lg fs-6 border-1 rounded-3 shadow-sm" value="{{ $student_record->academic_year->academic_year ?? '' }}" id="academic_year" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-secondary fw-semibold small">Year</label>
                                        <input type="text" name="year_name" class="form-control form-control-lg fs-6 border-1 rounded-3 shadow-sm" value="{{ $student_record->year->year_name ?? '' }}" id="year_name" readonly>
                                    </div>
                                </div>
                            </div>

                            <hr class="text-secondary opacity-10 my-4">

                            <!-- Personal Details -->
                            <div class="mb-4">
                                <h6 class="text-uppercase text-muted fw-bold fs-7 mb-3">
                                    <i class="bi bi-person me-1 text-primary"></i> Personal Information
                                </h6>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label text-secondary fw-semibold small">Student Number</label>
                                        <input type="text" name="roll_number" value="{{ $student_record->student->roll_no ?? '' }}" class="form-control form-control-lg fs-6 border-1 rounded-3 shadow-sm">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-secondary fw-semibold small">Full Name</label>
                                        <input type="text" name="name" value="{{ $student_record->student->name ?? '' }}" class="form-control form-control-lg fs-6 border-1 rounded-3 shadow-sm" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-secondary fw-semibold small">Gender</label>
                                        <input type="text" name="gender" value="{{ $student_record->student->gender ?? '' }}" class="form-control form-control-lg fs-6 border-1 rounded-3 shadow-sm" placeholder="Enter full name" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-secondary fw-semibold small">Phone Number</label>
                                        <input type="tel" name="phone_no" value="{{ $student_record->student->phone_no ?? '' }}" class="form-control form-control-lg fs-6 border-1 rounded-3 shadow-sm" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-secondary fw-semibold small">Email</label>
                                        <input type="tel" name="email" value="{{ $student_record->student->email ?? '' }}" class="form-control form-control-lg fs-6 border-1 rounded-3 shadow-sm" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-secondary fw-semibold small">Apply Date</label>
                                        <input type="date" name="date" class="form-control form-control-lg fs-6 border-1 rounded-3 shadow-sm" placeholder="your apply date">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label text-secondary fw-semibold small">Address</label>
                                        <textarea name="reason" class="form-control border-1 rounded-3 shadow-sm" rows="3" placeholder="Briefly describe why you require hostel accommodation..." readonly>{{ $student_record->student->address ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="alert alert-primary border-0 bg-primary-subtle text-primary rounded-3 d-flex align-items-center p-3 mb-4">
                                <i class="bi bi-info-circle-fill fs-5 me-3 flex-shrink-0"></i>
                                <div class="small">
                                    လျှောက်လွှာ တင်သွင်းပြီးပါက Status မှာ <strong>Pending</strong> ဖြစ်မည်ဖြစ်ပြီး Admin မှ အတည်ပြုပြီးမှသာ Room & Payment ဆက်လက်လုပ်ဆောင်ရပါမည်။
                                </div>
                            </div>

                            <div class="d-flex align-items-center justify-content-end gap-2 pt-2">
                                <a href="{{ url()->previous() }}" class="btn btn-light btn-lg fs-6 rounded-3 px-4 fw-medium text-secondary">Back</a>
                                <button type="submit" class="btn btn-primary btn-lg fs-6 rounded-3 px-4 fw-medium shadow-sm">Submit Application</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection