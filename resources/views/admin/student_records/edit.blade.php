@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-3">

    <!-- Top Header Navigation -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Student Record Details</h3>
        </div>
    </div>

    <!-- Main Edit Form Card -->
    <div id="step-student-record-info" class="step-section active">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5">

                    <!-- Banner Header -->
                    <div class="card-header bg-warning bg-opacity-10 border-0 p-4">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-warning text-white p-3 d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 50px; height: 50px;">
                                <i class="fa-solid fa-file-signature fs-4"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold text-dark mb-1">Edit Student Record</h5>
                                <small class="text-secondary">Modify the assigned room, academic year, or registration details below.</small>
                            </div>
                        </div>
                    </div>

                    <!-- Card Body / Form -->
                    <div class="card-body p-4">
                        <form action="{{ route('backend.student_records.update', $student_record->record_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <div class="row g-4">
                                <!-- Academic Year Select -->
                                <div class="col-12">
                                    <label class="form-label fw-semibold text-dark" for="academic_year_id">Academic Year</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted">
                                            <i class="fa-solid fa-book-open-reader"></i>
                                        </span>
                                        <select name="academic_year_id" id="academic_year_id" class="form-select border-start-0 ps-0 @error('academic_year_id') is-invalid @elseif(old('academic_year_id')) is-valid @enderror">
                                            <option value="">Select Academic Year</option>
                                            @foreach($academic_years as $academic_year)
                                                <option value="{{ $academic_year->academic_year_id }}" {{ $student_record->academic_year_id == $academic_year->academic_year_id ? 'selected' : '' }}>
                                                    {{ $academic_year->academic_year }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('academic_year_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Year Select -->
                                <div class="col-12">
                                    <label class="form-label fw-semibold text-dark" for="year_id">Year</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <select name="year_id" id="year_id" class="form-select border-start-0 ps-0 @error('year_id') is-invalid @elseif(old('year_id')) is-valid @enderror">
                                            <option value="">Select Year</option>
                                            @foreach($years as $year)
                                                <option value="{{ $year->year_id }}" {{ $student_record->year_id == $year->year_id ? 'selected' : '' }}>
                                                    {{ $year->year_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('year_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Student Select -->
                                <div class="col-12">
                                    <label class="form-label fw-semibold text-dark" for="student_id">Student</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted">
                                            <i class="fa-solid fa-user-graduate"></i>
                                        </span>
                                        <select name="student_id" id="student_id" class="form-select border-start-0 ps-0 @error('student_id') is-invalid @elseif(old('student_id')) is-valid @enderror">
                                            <option value="">Select Student</option>
                                            @foreach($students as $student)
                                                <option value="{{ $student->student_id }}" {{ $student_record->student_id == $student->student_id ? 'selected' : '' }}>
                                                    {{ $student->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('student_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4 text-muted opacity-25">

                            <!-- Action Buttons -->
                            <div class="d-flex align-items-center justify-content-end gap-2">
                                <a href="{{ route('backend.student_records.index') }}" class="btn btn-outline-danger border px-4 py-2 rounded-pill fw-semibold">
                                    မလုပ်တော့ပါ
                                </a>
                                <button type="submit" class="btn btn-warning px-4 py-2 rounded-pill fw-semibold shadow-sm">
                                    <i class="fa-solid fa-rotate me-1"></i> ပြင်ဆင်ချက်များ သိမ်းမည်
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