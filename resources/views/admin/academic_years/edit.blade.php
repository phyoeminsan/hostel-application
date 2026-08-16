@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <h2 class="fw-bold text-dark mb-0">Details</h2>
    </div>

     <div id="step-student-info" class="step-section active">
        <div class="card shadow-sm p-4 bg-white rounded">
           <div class="d-flex align-items-center p-3 mb-4 bg-warning-subtle rounded-3 border-start border-4 border-warning shadow-sm">
                <div class="bg-warning text-white rounded-3 p-3 d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 48px; height: 48px;">
                    <i class="fa-solid fa-book-open-reader"></i>
                </div>
                <div>
                    <h5 class="fw-bold text-dark mb-1">Edit Academic Year</h5>
                    <small class="text-secondary">Modify the session details below to update this academic year record.</small>
                </div>
            </div>
            <form action="{{ route('backend.academic_years.update', $academic_year->academic_year_id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="col-12">
                    <label class="form-label fw-bold">Academic Year</label>
                    <input type="text" name="academic_year" id="academic_year" class="form-control @error('academic_year') is-invalid @elseif(old('academic_year')) is-valid @enderror" value="{{ $academic_year->academic_year }}">
                    @error('academic_year')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label class="form-label fw-bold">Status</label>
                    <select name="status" id="status" class="form-select bg-light @error('status') is-invalid @elseif(old('status')) is-valid @enderror" value="{{ old('status') }}">
                            <option value="">Select Status</option>
                            <option value="New" {{ $academic_year->status == 'New' ? 'selected' : '' }}>New </option>
                            <option value="Old" {{ $academic_year->status == 'Old' ? 'selected' : '' }}>Old</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-4 text-end">
                    <a href="{{ route('backend.years.index') }}" class="btn btn-outline-danger me-2">မလုပ်တော့ပါ</a>
                    <button type="submit" class="btn btn-primary px-4">
                        ပြင်ဆင်ချက်များ သိမ်းမည်
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection