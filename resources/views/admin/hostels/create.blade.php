@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <h2 class="fw-bold text-dark mb-0">Add New Hostel</h2>
    </div>

    <div id="step-student-info" class="step-section active">
        <div class="card shadow-sm p-4 bg-white rounded">
           <div class="d-flex align-items-center p-3 mb-4 bg-primary-subtle rounded-3 border-start border-4 border-primary shadow-sm">
                <div class="bg-primary text-white rounded-3 p-3 d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 48px; height: 48px;">
                    <i class="fa-solid fa-building fs-5"></i>
                </div>
                <div>
                    <h5 class="fw-bold text-dark mb-1">Hostel Setup</h5>
                    <small class="text-secondary">Provide the required details below to register a new hostel branch or building.</small>
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
            <form action="{{ route('backend.hostels.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Hostel Name</label>
                        <input type="text" name="hostel_name" class="form-control @error('hostel_name') is-invalid @elseif(old('hostel_name')) is-valid
                        @enderror" id="hostel_name" value="{{ old('hostel_name') }}">
                        @error('hostel_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Capcity</label>
                        <input type="number" name="capacity" class="form-control @error('capacity') is-invalid @elseif(old('capacity')) is-valid
                        @enderror" id="capacity" value="{{ old('capacity') }}">
                        @error('capacity')
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
                        <label class="form-label fw-bold">Photo</label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @elseif(old('image')) is-valid
                        @enderror" id="image" value="{{ old('image') }}">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mt-4 text-end">
                        <a href="{{ route('backend.hostels.index') }}" class="btn btn-outline-danger me-2">မလုပ်တော့ပါ</a>
                        <button type="submit" class="btn btn-primary px-4">
                            သိမ်းဆည်းမည်
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection