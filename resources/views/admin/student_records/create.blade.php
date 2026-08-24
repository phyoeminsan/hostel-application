@extends('layouts.admin')
@section('content')
   <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <h2 class="fw-bold text-dark mb-0">Add New Student Record</h2>
    </div>

    <div id="step-student-record-info" class="step-section active">
        <div class="card shadow-sm p-4 bg-white rounded">
            <div class="d-flex align-items-center p-3 mb-4 bg-primary-subtle rounded-3 border-start border-4 border-primary shadow-sm">
                <div class="bg-primary text-white rounded-3 p-3 d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 48px; height: 48px;">
                    <i class="fa-solid fa-file-signature fs-5"></i> 
                </div>
                <div>
                    <h5 class="fw-bold text-dark mb-1">Student Record Registration</h5>
                    <small class="text-secondary">Provide the required student details, academic year, and room allocation to register a new record.</small>
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
            <form action="{{ route('backend.student_records.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label fw-bold">Academic Year</label>
                        <select name="academic_year_id" id="academic_year_id" class="form-select bg-light @error('academic_year_id') is-invalid @elseif(old('academic_year_id')) is-valid @enderror">
                            <option value="">Select Academic Year</option>
                            @foreach($academic_years as $academic_year)
                                <option value="{{ $academic_year->academic_year_id }}" {{ old('academic_year_id') == $academic_year->academic_year_id? 'selected' : '' }}>{{ $academic_year->academic_year }}</option>
                            @endforeach
                        </select>
                        @error('academic_year_id')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold">Year</label>
                        <select name="year_id" id="year_id" class="form-select bg-light @error('year_id') is-invalid @elseif(old('year_id')) is-valid @enderror">
                            <option value="">Select Year</option>
                            @foreach($years as $year)
                                <option value="{{ $year->year_id }}" {{ old('year_id') == $year->year_id? 'selected' : '' }}>{{ $year->year_name }}</option>
                            @endforeach
                        </select>
                        @error('academic_year_id')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold">Students</label>
                        <select name="student_id" id="student_id" class="form-select bg-light @error('student_id') is-invalid @elseif(old('student_id')) is-valid @enderror">
                            <option value="">Select Students</option>
                            @foreach($students as $student)
                                <option value="{{ $student->student_id }}" {{ old('student_id') == $student->student_id? 'selected' : '' }}>{{ $student->name }}</option>
                            @endforeach
                        </select>
                        @error('student_id')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mt-4 text-end">
                        <a href="{{ route('backend.student_records.index') }}" class="btn btn-outline-danger me-2">မလုပ်တော့ပါ</a>
                        <button type="submit" class="btn btn-primary px-4">
                            သိမ်းဆည်းမည်
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection