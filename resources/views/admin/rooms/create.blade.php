@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <h2 class="fw-bold text-dark mb-0">Add New Room</h2>
    </div>

    <div id="step-room-info" class="step-section active">
        <div class="card shadow-sm p-4 bg-white rounded">
            <div class="d-flex align-items-center p-3 mb-4 bg-primary-subtle rounded-3 border-start border-4 border-primary shadow-sm">
                <div class="bg-primary text-white rounded-3 p-3 d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 48px; height: 48px;">
                    <i class="fa-solid fa-bed fs-5"></i>
                </div>
                <div>
                    <h5 class="fw-bold text-dark mb-1">Room Setup</h5>
                    <small class="text-secondary">Provide the required room details and bed capacity below to register a new room.</small>
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
            <form action="{{ route('backend.rooms.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Room No</label>
                        <input type="text" name="room_no" class="form-control @error('room_no') is-invalid @elseif(old('room_no')) is-valid
                        @enderror" id="room_no" value="{{ old('room_no') }}">
                        @error('room_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Floor No</label>
                        <input type="text" name="floor_no" class="form-control @error('floor_no') is-invalid @elseif(old('floor_no')) is-valid
                        @enderror" id="floor_no" value="{{ old('floor_no') }}">
                        @error('floor_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">No Of Person</label>
                        <input type="number" name="no_of_person" class="form-control @error('no_of_person') is-invalid @elseif(old('no_of_person')) is-valid
                        @enderror" id="no_of_person" value="{{ old('no_of_person') }}">
                        @error('no_of_person')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Status</label>
                        <select name="status" id="status" class="form-select bg-light @error('status') is-invalid @elseif(old('status')) is-valid @enderror" value="{{ old('status') }}">
                                <option value="">Select Gender</option>
                                <option value="Available" {{ old('status') == 'Available' ? 'selected' : '' }}>Available </option>
                                <option value="Full" {{ old('status') == 'Full' ? 'selected' : '' }}>Full</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold">Hostel</label>
                        <select name="hostel_id" id="hostel_id" class="form-select bg-light @error('hostel_id') is-invalid @elseif(old('hostel_id')) is-valid @enderror">
                            <option value="">Select Hostel</option>
                            @foreach($hostels as $hostel)
                                <option value="{{ $hostel->hostel_id }}" {{ old('hostel_id') == $hostel->hostel_id? 'selected' : '' }}>{{ $hostel->hostel_name }}</option>
                            @endforeach
                        </select>
                        @error('hostel_id')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mt-4 text-end">
                        <a href="{{ route('backend.rooms.index') }}" class="btn btn-outline-danger me-2">မလုပ်တော့ပါ</a>
                        <button type="submit" class="btn btn-primary px-4">
                            သိမ်းဆည်းမည်
                        </button>
                    </div>
                </div>
            </form>
@endsection