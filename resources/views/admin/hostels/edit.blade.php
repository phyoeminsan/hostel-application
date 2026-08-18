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