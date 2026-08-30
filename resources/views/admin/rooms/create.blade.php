@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-start mb-4">
    <h3 class="fw-bold text-dark mb-0">Room Management</h3>
</div>
<div class="container-fluid py-4" style="max-width: 700px;">
    <!-- Main Card -->
    <div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
        <div class="card-body p-4 p-md-4">

            <!-- Primary Blue Banner Header -->
            <div class="d-flex align-items-center p-3 mb-4 rounded-4" style="background-color: #EBF3FE;">
                <div class="rounded-circle p-2 d-flex align-items-center justify-content-center me-3 shadow-sm flex-shrink-0" style="width: 44px; height: 44px; background-color: #0D6EFD; color: white;">
                    <i class="fa-solid fa-bed fs-6"></i>
                </div>
                <div>
                    <h6 class="fw-bold text-dark mb-0">Room Setup</h6>
                    <small class="text-muted" style="font-size: 13px;">Provide the required room details and bed capacity below to register a new room.</small>
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
                        confirmButtonColor: '#0d6efd'
                    });
                </script>
            @endif

            <form action="{{ route('backend.rooms.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- Section: Room Details -->
                <div class="mb-4">
                    <h6 class="fw-bold text-primary mb-3 d-flex align-items-center" style="font-size: 15px;">
                        <i class="fa-solid fa-house-user me-2"></i> Room Information
                    </h6>

                    <div class="row g-3">
                        <!-- Room No -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-secondary small">Room No</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 rounded-start-3 text-muted">
                                    <i class="fa-solid fa-hashtag"></i>
                                </span>
                                <input type="text" 
                                       name="room_no" 
                                       class="form-control bg-light border-start-0 rounded-end-3 @error('room_no') is-invalid @enderror" 
                                       id="room_no" 
                                       value="{{ old('room_no') }}" 
                                       placeholder="e.g. R-###">
                            </div>
                            @error('room_no')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Floor No -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-secondary small">Floor No</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 rounded-start-3 text-muted">
                                    <i class="fa-solid fa-layer-group"></i>
                                </span>
                                <input type="text" 
                                       name="floor_no" 
                                       class="form-control bg-light border-start-0 rounded-end-3 @error('floor_no') is-invalid @enderror" 
                                       id="floor_no" 
                                       value="{{ old('floor_no') }}" 
                                       placeholder="e.g. ### Floor">
                            </div>
                            @error('floor_no')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- No Of Person -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-secondary small">No Of Person</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 rounded-start-3 text-muted">
                                    <i class="fa-solid fa-users"></i>
                                </span>
                                <input type="number" 
                                       name="no_of_person" 
                                       class="form-control bg-light border-start-0 rounded-end-3 @error('no_of_person') is-invalid @enderror" 
                                       id="no_of_person" 
                                       value="{{ old('no_of_person') }}" 
                                       placeholder="Capacity count">
                            </div>
                            @error('no_of_person')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-secondary small">Status</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 rounded-start-3 text-muted">
                                    <i class="fa-solid fa-toggle-on"></i>
                                </span>
                                <select name="status" id="status" class="form-select bg-light border-start-0 rounded-end-3 @error('status') is-invalid @enderror">
                                    <option value="">Select Status</option>
                                    <option value="Available" {{ old('status') == 'Available' ? 'selected' : '' }}>Available</option>
                                    <option value="Full" {{ old('status') == 'Full' ? 'selected' : '' }}>Full</option>
                                </select>
                            </div>
                            @error('status')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Hostel Selection -->
                        <div class="col-12">
                            <label class="form-label fw-semibold text-secondary small">Hostel</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 rounded-start-3 text-muted">
                                    <i class="fa-solid fa-hotel"></i>
                                </span>
                                <select name="hostel_id" id="hostel_id" class="form-select bg-light border-start-0 rounded-end-3 @error('hostel_id') is-invalid @enderror">
                                    <option value="">Select Hostel</option>
                                    @foreach($hostels as $hostel)
                                        <option value="{{ $hostel->hostel_id }}" {{ old('hostel_id') == $hostel->hostel_id ? 'selected' : '' }}>
                                            {{ $hostel->hostel_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('hostel_id')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Footer Action Buttons -->
                <div class="mt-4 pt-3 d-flex justify-content-end gap-2 border-top">
                    <a href="{{ route('backend.rooms.index') }}" class="btn btn-outline-danger rounded-pill px-4 fw-medium">
                        မလုပ်တော့ပါ
                    </a>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">
                        <i class="fa-solid fa-check me-1"></i> သိမ်းဆည်းမည်
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection