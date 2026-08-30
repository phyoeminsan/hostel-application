@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-3">

    <!-- Header Section with Back Button -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Edit Academic Year</h3>
        </div>
    </div>

    <!-- Form Card Container -->
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                
                <!-- Card Header Banner (Edit Accent) -->
                <div class="card-header bg-warning bg-opacity-10 border-0 p-4">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-warning text-white p-3 d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 52px; height: 52px;">
                            <i class="fa-solid fa-book-open-reader fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-1">Update Academic Year</h5>
                            <p class="text-muted small mb-0">Make changes to the selected academic year record below.</p>
                        </div>
                    </div>
                </div>

                <!-- Form Body -->
                <div class="card-body p-4">
                    <form action="{{ route('backend.academic_years.update', $academic_year->academic_year_id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-4">
                            <!-- Academic Year Input -->
                            <div class="col-12">
                                <label for="academic_year" class="form-label fw-semibold text-dark">
                                    Academic Year <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted">
                                        <i class="fa-solid fa-calendar-days"></i>
                                    </span>
                                    <input type="text" 
                                           name="academic_year" 
                                           id="academic_year" 
                                           class="form-control border-start-0 ps-0 @error('academic_year') is-invalid @enderror" 
                                           placeholder="e.g. 2025-2026" 
                                           value="{{ old('academic_year', $academic_year->academic_year) }}">
                                    @error('academic_year')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Status Select -->
                            <div class="col-12">
                                <label for="status" class="form-label fw-semibold text-dark">
                                    Status <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted">
                                        <i class="fa-solid fa-toggle-on"></i>
                                    </span>
                                    <select name="status" 
                                            id="status" 
                                            class="form-select border-start-0 ps-0 @error('status') is-invalid @enderror">
                                        <option value="" disabled>Select status</option>
                                        <option value="Current" {{ old('status', $academic_year->status) == 'Current' ? 'selected' : '' }}>Current</option>
                                        <option value="Old" {{ old('status', $academic_year->status) == 'Old' ? 'selected' : '' }}>Old </option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr class="my-4 text-muted opacity-25">

                        <!-- Action Buttons -->
                        <div class="d-flex align-items-center justify-content-end gap-2">
                            <a href="{{ route('backend.academic_years.index') }}" class="btn btn-outline-danger border px-4 py-2 rounded-pill fw-semibold">
                                <i class="fa-solid fa-xmark fs-8 me-1"></i>မလုပ်တော့ပါ
                            </a>
                            <button type="submit" class="btn btn-warning text-dark px-4 py-2 rounded-pill fw-semibold shadow-sm">
                                <i class="fa-solid fa-arrows-rotate me-1"></i> ပြင်ဆင်ချက်များ သိမ်းမည်
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection