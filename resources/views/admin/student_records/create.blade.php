@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-3">

    <!-- Top Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark mb-0">Add New Student Record</h2>
    </div>

    <!-- Main Form Card -->
    <div id="step-student-record-info" class="step-section active">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5">

                    <!-- Form Banner Header -->
                    <div class="card-header bg-primary bg-opacity-10 border-0 p-4">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-primary text-white p-3 d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 50px; height: 50px;">
                                <i class="fa-solid fa-file-signature fs-4"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold text-dark mb-1">Student Record Registration</h5>
                                <small class="text-secondary">Provide the required student details, academic year, and study level to register a new record.</small>
                            </div>
                        </div>
                    </div>

                    <!-- Validation Alert (SweetAlert) -->
                    @if ($errors->any())
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        <script>
                            Swal.fire({
                                icon: 'warning',
                                title: 'အချက်အလက် မပြည့်စုံပါ!',
                                text: 'ကျေးဇူးပြု၍ လိုအပ်သော အချက်အလက်များကို ပြည့်စုံစွာ ဖြည့်သွင်းပေးပါ။',
                                confirmButtonText: 'လက်ခံသည်',
                                confirmButtonColor: '#0d6efd',
                                customClass: {
                                    popup: 'rounded-4'
                                }
                            });
                        </script>
                    @endif

                    <!-- Form Body -->
                    <div class="card-body p-4">
                        <form action="{{ route('backend.student_records.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-4">
                                
                                <!-- Academic Year Field -->
                                <div class="col-12">
                                    <label class="form-label fw-semibold text-dark" for="academic_year_id">Academic Year</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fa-solid fa-book-open-reader"></i></span>
                                        <select name="academic_year_id" id="academic_year_id" class="form-select border-start-0 ps-0 @error('academic_year_id') is-invalid @elseif(old('academic_year_id')) is-valid @enderror">
                                            <option value="">Select Academic Year</option>
                                            @foreach($academic_years as $academic_year)
                                                <option value="{{ $academic_year->academic_year_id }}" {{ old('academic_year_id') == $academic_year->academic_year_id ? 'selected' : '' }}>
                                                    {{ $academic_year->academic_year }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('academic_year_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Year Field -->
                                <div class="col-12">
                                    <label class="form-label fw-semibold text-dark" for="year_id">Year</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fa-solid fa-layer-group"></i></span>
                                        <select name="year_id" id="year_id" class="form-select border-start-0 ps-0 @error('year_id') is-invalid @elseif(old('year_id')) is-valid @enderror">
                                            <option value="">Select Year</option>
                                            @foreach($years as $year)
                                                <option value="{{ $year->year_id }}" {{ old('year_id') == $year->year_id ? 'selected' : '' }}>
                                                    {{ $year->year_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('year_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Students Field -->
                                <div class="col-12">
                                    <label class="form-label fw-semibold text-dark" for="student_id">Students</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fa-solid fa-user-graduate"></i></span>
                                        <select name="student_id" id="student_id" class="form-select border-start-0 ps-0 @error('student_id') is-invalid @elseif(old('student_id')) is-valid @enderror">
                                            <option value="">Select Students</option>
                                            @foreach($students as $student)
                                                <option value="{{ $student->student_id }}" {{ old('student_id') == $student->student_id ? 'selected' : '' }}>
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

                            <!-- Buttons -->
                            <div class="d-flex align-items-center justify-content-end gap-2">
                                <a href="{{ route('backend.student_records.index') }}" class="btn btn-outline-danger border px-4 py-2 rounded-pill fw-semibold">
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
</div>
@endsection