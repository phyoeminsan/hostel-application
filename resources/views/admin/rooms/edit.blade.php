@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <h2 class="fw-bold text-dark mb-0">Edit Room</h2>
    </div>

    <div id="step-room-info" class="step-section active">
        <div class="card shadow-sm p-4 bg-white rounded">
            <div class="d-flex align-items-center p-3 mb-4 bg-warning-subtle rounded-3 border-start border-4 border-warning shadow-sm">
                <div class="bg-warning text-white rounded-3 p-3 d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 48px; height: 48px;">
                    <i class="fa-solid fa-bed fs-5"></i>
                </div>
                <div>
                    <h5 class="fw-bold text-dark mb-1">Edit Room Info</h5>
                    <small class="text-secondary">Update the room number, capacity, price, or hostel allocation details below.</small>
                </div>
            </div>
            <form action="{{ route('backend.rooms.update', $room->room_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Room No</label>
                        <input type="text" name="room_no" class="form-control @error('room_no') is-invalid @elseif(old('room_no')) is-valid
                        @enderror" id="room_no" value="{{ $room->room_no }}">
                        @error('room_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Floor No</label>
                        <input type="text" name="floor_no" class="form-control @error('floor_no') is-invalid @elseif(old('floor_no')) is-valid
                        @enderror" id="floor_no" value="{{ $room->floor_no }}">
                        @error('floor_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">No Of Person</label>
                        <input type="number" name="no_of_person" class="form-control @error('no_of_person') is-invalid @elseif(old('no_of_person')) is-valid
                        @enderror" id="no_of_person" value="{{ $room->no_of_person }}">
                        @error('no_of_person')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Status</label>
                        <select name="status" id="status" class="form-select bg-light @error('status') is-invalid @elseif(old('status')) is-valid @enderror">
                                <option value="">Select Gender</option>
                                <option value="Available" {{ $room->status == 'Available' ? 'selected' : '' }}>Available </option>
                                <option value="Full" {{ $room->status == 'Full' ? 'selected' : '' }}>Full</option>
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
                                <option value="{{ $hostel->hostel_id }}" {{ $room->hostel_id == $hostel->hostel_id? 'selected' : '' }}>{{ $hostel->hostel_name }}</option>
                            @endforeach
                        </select>
                        @error('hostel_id')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mt-4 text-end">
                        <a href="{{ route('backend.rooms.index') }}" class="btn btn-outline-danger me-2">မလုပ်တော့ပါ</a>
                        <button type="submit" class="btn btn-primary px-4">
                            ပြင်ဆင်ချက်များ သိမ်းမည်
                        </button>
                    </div>
                </div>
            </form>
@endsection