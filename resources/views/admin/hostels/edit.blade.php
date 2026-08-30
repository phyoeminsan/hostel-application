@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold text-dark mb-1">Edit Major Details</h3>
    </div>
</div>
<div class="container-fluid py-4" style="max-width: 850px;"> <!-- Width ကို အချိုးကျအောင် ထိန်းထားပါသည် -->
    <!-- Top Card -->
    <div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
        <div class="card-body p-4 p-md-5">

            <!-- Yellow Banner -->
            <div class="d-flex align-items-center p-3 mb-4 rounded-4" style="background-color: #FFF8E7;">
                <div class="rounded-circle p-2 d-flex align-items-center justify-content-center me-3 shadow-sm flex-shrink-0" style="width: 42px; height: 42px; background-color: #FFC107; color: white;">
                    <i class="fa-solid fa-pen-to-square fs-6"></i>
                </div>
                <div>
                    <h6 class="fw-bold text-dark mb-0">Edit Hostel Info</h6>
                    <small class="text-muted" style="font-size: 13px;">Update the required building, room capacity, and address details below.</small>
                </div>
            </div>

            <form action="{{ route('backend.hostels.update', $hostel->hostel_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Section: Info -->
                <div class="mb-4">
                    <h6 class="fw-bold text-primary mb-3 d-flex align-items-center" style="font-size: 15px;">
                        <i class="fa-solid fa-graduation-cap me-2"></i> Hostel Information
                    </h6>
                    
                    <div class="row g-3">
                        <!-- Hostel Name -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-secondary small">Hostel Name</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 rounded-start-3 text-muted">
                                    <i class="fa-solid fa-building"></i>
                                </span>
                                <input type="text" 
                                       name="hostel_name" 
                                       class="form-control bg-light border-start-0 rounded-end-3 @error('hostel_name') is-invalid @enderror" 
                                       value="{{ old('hostel_name', $hostel->hostel_name) }}"
                                       placeholder="Hostel Name">
                            </div>
                            @error('hostel_name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Capacity -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-secondary small">Capacity</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 rounded-start-3 text-muted">
                                    <i class="fa-solid fa-users"></i>
                                </span>
                                <input type="number" 
                                       name="capacity" 
                                       class="form-control bg-light border-start-0 rounded-end-3 @error('capacity') is-invalid @enderror" 
                                       value="{{ old('capacity', $hostel->capacity) }}"
                                       placeholder="Capacity">
                            </div>
                            @error('capacity')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Gender -->
                        <div class="col-12-md-6">
                            <label class="form-label fw-semibold text-secondary small">Gender</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 rounded-start-3 text-muted">
                                    <i class="fa-solid fa-venus-mars"></i>
                                </span>
                                <select name="gender" class="form-select bg-light border-start-0 rounded-end-3 @error('gender') is-invalid @enderror">
                                    <option value="">Select Gender</option>
                                    <option value="Male" {{ old('gender', $hostel->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender', $hostel->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                            @error('gender')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr class="my-4 text-muted opacity-25">

                <!-- Section: Media -->
                <div class="mb-4">
                    <h6 class="fw-bold text-primary mb-3 d-flex align-items-center" style="font-size: 15px;">
                        <i class="fa-solid fa-lock me-2"></i> Media Setup
                    </h6>

                    <div class="p-3 bg-light rounded-4 border">
                        <ul class="nav nav-pills mb-3" id="imageTab" role="tablist">
                            <li class="nav-item">
                                <button class="nav-link active rounded-pill px-3 py-1 btn-sm" id="image-tab" data-bs-toggle="tab" data-bs-target="#image-tab-pane" type="button">
                                    Current Image
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link rounded-pill px-3 py-1 btn-sm" id="new_image-tab" data-bs-toggle="tab" data-bs-target="#new_image-tab-pane" type="button">
                                    Upload New Image
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="image-tab-pane">
                                <div class="bg-white p-2 rounded-3 border d-inline-block">
                                    <img src="{{ asset($hostel->image) }}" class="rounded-2" width="100" height="100" style="object-fit: cover;">
                                </div>
                                <input type="hidden" name="old_image" value="{{ $hostel->image }}">
                            </div>

                            <div class="tab-pane fade" id="new_image-tab-pane">
                                <input type="file" name="image" class="form-control bg-white @error('image') is-invalid @enderror" accept="image/*">
                            </div>
                        </div>
                    </div>
                    @error('image')
                        <div class="text-danger small mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Footer Buttons -->
                <div class="mt-4 pt-2 d-flex justify-content-end gap-2">
                    <a href="{{ route('backend.hostels.index') }}" class="btn btn-light rounded-pill px-4 text-secondary fw-medium">
                        မလုပ်တော့ပါ
                    </a>
                    <button type="submit" class="btn btn-warning rounded-pill px-4 text-dark fw-bold shadow-sm" style="background-color: #FFC107; border: none;">
                        <i class="fa-solid fa-rotate me-1"></i> ပြင်ဆင်ချက်များ သိမ်းဆည်းမည်
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection