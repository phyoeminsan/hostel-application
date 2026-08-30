@extends('layouts.admin')

@section('content')
<!-- Top Header -->
<div class="d-flex justify-content-between align-items-start mb-3">
    <h4 class="fw-bold text-dark mb-0">Edit Room Details</h4>
</div>
<div class="container-fluid py-4" style="max-width: 550px;">
    <!-- Main Card -->
    <div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
        <div class="card-body p-4">

            <!-- Yellow Banner Header (Edit Mode) -->
            <div class="d-flex align-items-center p-3 mb-4 rounded-3" style="background-color: #FFF8E7;">
                <div class="rounded-circle p-2 d-flex align-items-center justify-content-center me-3 shadow-sm flex-shrink-0" style="width: 38px; height: 38px; background-color: #FFC107; color: white;">
                    <i class="fa-solid fa-bed fs-6"></i>
                </div>
                <div>
                    <h6 class="fw-bold text-dark mb-0">Edit Room Info</h6>
                    <small class="text-muted" style="font-size: 12px;">Update room details, capacity, and hostel allocation below.</small>
                </div>
            </div>

            <!-- SweetAlert Validation Handler -->
            @if ($errors->any())
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    Swal.fire({
                        icon: 'warning',
                        title: 'အချက်အလက် မပြည့်စုံပါ!',
                        text: 'ကျေးဇူးပြု၍ လိုအပ်သော အချက်အလက်များကို ပြည့်စုံစွာ ဖြည့်သွင်းပေးပါ။',
                        confirmButtonText: 'လက်ခံသည်',
                        confirmButtonColor: '#ffc107'
                    });
                </script>
            @endif

            <form action="{{ route('backend.rooms.update', $room->room_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row g-3">
                    <!-- Room No -->
                    <div class="col-12">
                        <label class="form-label fw-semibold text-secondary small mb-1">Room No</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-light border-end-0 rounded-start-3 text-muted">
                                <i class="fa-solid fa-hashtag"></i>
                            </span>
                            <input type="text" 
                                   name="room_no" 
                                   class="form-control bg-light border-start-0 rounded-end-3 @error('room_no') is-invalid @enderror" 
                                   value="{{ old('room_no', $room->room_no) }}" 
                                   placeholder="e.g. 101">
                        </div>
                        @error('room_no')
                            <div class="text-danger small mt-1" style="font-size: 11px;">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Floor No -->
                    <div class="col-12">
                        <label class="form-label fw-semibold text-secondary small mb-1">Floor No</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-light border-end-0 rounded-start-3 text-muted">
                                <i class="fa-solid fa-layer-group"></i>
                            </span>
                            <input type="text" 
                                   name="floor_no" 
                                   class="form-control bg-light border-start-0 rounded-end-3 @error('floor_no') is-invalid @enderror" 
                                   value="{{ old('floor_no', $room->floor_no) }}" 
                                   placeholder="e.g. 1st Floor">
                        </div>
                        @error('floor_no')
                            <div class="text-danger small mt-1" style="font-size: 11px;">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- No Of Person -->
                    <div class="col-12">
                        <label class="form-label fw-semibold text-secondary small mb-1">No Of Person</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-light border-end-0 rounded-start-3 text-muted">
                                <i class="fa-solid fa-users"></i>
                            </span>
                            <input type="number" 
                                   name="no_of_person" 
                                   class="form-control bg-light border-start-0 rounded-end-3 @error('no_of_person') is-invalid @enderror" 
                                   value="{{ old('no_of_person', $room->no_of_person) }}" 
                                   placeholder="Capacity count">
                        </div>
                        @error('no_of_person')
                            <div class="text-danger small mt-1" style="font-size: 11px;">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="col-12">
                        <label class="form-label fw-semibold text-secondary small mb-1">Status</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-light border-end-0 rounded-start-3 text-muted">
                                <i class="fa-solid fa-toggle-on"></i>
                            </span>
                            <select name="status" id="status" class="form-select bg-light border-start-0 rounded-end-3 @error('status') is-invalid @enderror">
                                <option value="">Select Status</option>
                                <option value="Available" {{ old('status', $room->status) == 'Available' ? 'selected' : '' }}>Available</option>
                                <option value="Full" {{ old('status', $room->status) == 'Full' ? 'selected' : '' }}>Full</option>
                            </select>
                        </div>
                        @error('status')
                            <div class="text-danger small mt-1" style="font-size: 11px;">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Hostel Selection -->
                    <div class="col-12">
                        <label class="form-label fw-semibold text-secondary small mb-1">Hostel</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-light border-end-0 rounded-start-3 text-muted">
                                <i class="fa-solid fa-building"></i>
                            </span>
                            <select name="hostel_id" id="hostel_id" class="form-select bg-light border-start-0 rounded-end-3 @error('hostel_id') is-invalid @enderror">
                                <option value="">Select Hostel</option>
                                @foreach($hostels as $hostel)
                                    <option value="{{ $hostel->hostel_id }}" {{ old('hostel_id', $room->hostel_id) == $hostel->hostel_id ? 'selected' : '' }}>
                                        {{ $hostel->hostel_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('hostel_id')
                            <div class="text-danger small mt-1" style="font-size: 11px;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Footer Action Buttons -->
                <div class="mt-4 pt-3 d-flex justify-content-end gap-2 border-top">
                    <a href="{{ route('backend.rooms.index') }}" class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-medium">
                        မလုပ်တော့ပါ
                    </a>
                    <button type="submit" class="btn btn-sm btn-warning rounded-pill px-4 fw-bold text-dark shadow-sm" style="background-color: #FFC107; border: none;">
                        <i class="fa-solid fa-rotate me-1"></i> ပြင်ဆင်ချက်များ သိမ်းမည်
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection