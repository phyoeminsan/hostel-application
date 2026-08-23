@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <h2 class="fw-bold text-dark mb-0">Details</h2>
    </div>

    <div id="step-hostel-info" class="step-section active">
        <div class="card shadow-sm p-4 bg-white rounded">
            <div class="d-flex align-items-center p-3 mb-4 bg-warning-subtle rounded-3 border-start border-4 border-warning shadow-sm">
                <div class="bg-warning text-white rounded-3 p-3 d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 48px; height: 48px;">
                    <i class="fa-solid fa-pen-to-square fs-5"></i>
                </div>
                <div>
                    <h5 class="fw-bold text-dark mb-1">Edit Hostel Info</h5>
                    <small class="text-secondary">Update the required building, room capacity, and address details below.</small>
                </div>
            </div>
            <form action="{{ route('backend.hostels.update', $hostel->hostel_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Hostel Name</label>
                        <input type="text" name="hostel_name" class="form-control @error('hostel_name') is-invalid @elseif(old('hostel_name')) is-valid
                        @enderror" id="hostel_name" value="{{ $hostel->hostel_name }}">
                        @error('hostel_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Capcity</label>
                        <input type="text" name="capacity" class="form-control @error('capacity') is-invalid @elseif(old('capacity')) is-valid
                        @enderror" id="capacity" value="{{ $hostel->capacity }}">
                        @error('capacity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold">Gender</label>
                        <select name="gender" id="gender" class="form-select bg-light @error('gender') is-invalid @elseif(old('gender')) is-valid @enderror" value="{{ $hostel->gender }}">
                                <option value="">Select Gender</option>
                                <option value="Male" {{ $hostel->gender == 'Male' ? 'selected' : '' }}>Male </option>
                                <option value="Female" {{ $hostel->gender == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="image-tab" data-bs-toggle="tab" data-bs-target="#image-tab-pane" type="button" role="tab" aria-controls="image-tab-pane" aria-selected="true">Image</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="new_image-tab" data-bs-toggle="tab" data-bs-target="#new_image-tab-pane" type="button" role="tab" aria-controls="new_image-tab-pane" aria-selected="false">New Image</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="image-tab-pane" role="tabpanel" aria-labelledby="image-tab" tabindex="0">
                                <img src="{{ $hostel->image }}" class="w-25 h-25 my-3" alt="">
                                <input type="hidden" name="image" id="" value="{{ $hostel->image }}">
                            </div>
                            <div class="tab-pane fade" id="new_image-tab-pane" role="tabpanel" aria-labelledby="new_image-tab" tabindex="0">
                                <input type="file" name="image" class="form-control my-3 @error('image') is-invalid @elseif(old('image')) is-valid
                                @enderror" id="image" accept="jpg,jpeg,png,webp"value="{{ old('image') }}">
                            </div>
                        </div>    
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