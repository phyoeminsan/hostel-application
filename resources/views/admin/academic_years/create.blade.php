@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-3">

    <!-- Header Section with Back Button -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Add New Academic Year</h3>
        </div>
    </div>

    <!-- Form Card Container -->
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                
                <!-- Card Header Banner -->
                <div class="card-header bg-primary bg-opacity-10 border-0 p-4">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-primary text-white p-3 d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 52px; height: 52px;">
                            <i class="fa-solid fa-book-open-reader fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-1">Academic Year Details</h5>
                            <p class="text-muted small mb-0">Fill in the details below to register the new academic year.</p>
                        </div>
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
                <!-- Form Body -->
                <div class="card-body p-4">
                    <form action="{{ route('backend.academic_years.store') }}" method="POST">
                        @csrf

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
                                           class="form-control border-start-0 ps-0 @error('academic_year') is-invalid @elseif(old('academic_year')) is-valid  @enderror" 
                                           placeholder="e.g. 2025-2026" 
                                           value="{{ old('academic_year') }}">
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
                                            class="form-select border-start-0 ps-0 @error('status') is-invalid @elseif(old('status')) is-valid @enderror">
                                        <option value="" disabled {{ old('status') ? '' : 'selected' }}>Select status</option>
                                        <option value="Current" {{ old('status') == 'Current' ? 'selected' : '' }}>Current</option>
                                        <option value="Old" {{ old('status') == 'Old' ? 'selected' : '' }}>Old</option>
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
                            <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill fw-semibold shadow-sm">
                                <i class="fa-solid fa-check fs-8 me-1 text-light"></i>သိမ်းမည်
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection