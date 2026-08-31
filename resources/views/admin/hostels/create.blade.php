@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-3">

    <!-- Top Header Navigation -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Add New Hostel</h3>
        </div>
    </div>

    <!-- SweetAlert Validation Error Popup -->
    @if ($errors->any())
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'အချက်အလက် မပြည့်စုံပါ!',
                text: 'ကျေးဇူးပြု၍ လိုအပ်သော အချက်အလက်များကို ပြည့်စုံစွာ ဖြည့်သွင်းပေးပါ။',
                confirmButtonText: 'လက်ခံသည်',
                confirmButtonColor: '#0d6efd',
                customClass: {
                    popup: 'rounded-4'
                }
            });
        </script>
    @endif

    <!-- Main Add Form Card -->
    <div id="step-student-info" class="step-section active">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-xl-8">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5">

                    <!-- Banner Header -->
                    <div class="card-header bg-primary bg-opacity-10 border-0 p-4">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-primary text-white p-3 d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 50px; height: 50px;">
                                <i class="fa-solid fa-hotel fs-4"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold text-dark mb-1">Hostel Setup</h5>
                                <small class="text-secondary">Provide the required details below to register a new hostel branch or building.</small>
                            </div>
                        </div>
                    </div>

                    <!-- Card Body / Form -->
                    <div class="card-body p-4">
                        <form action="{{ route('backend.hostels.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row g-4">
                                <!-- Hostel Name -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-dark" for="hostel_name">Hostel Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted">
                                            <i class="fa-solid fa-hospital-user"></i>
                                        </span>
                                        <input type="text" name="hostel_name" id="hostel_name" 
                                               class="form-control border-start-0 ps-0 @error('hostel_name') is-invalid @elseif(old('hostel_name')) is-valid @enderror" 
                                               value="{{ old('hostel_name') }}" placeholder="e.g. Building A">
                                        @error('hostel_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Capacity -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-dark" for="capacity">Capacity</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted">
                                            <i class="fa-solid fa-users"></i>
                                        </span>
                                        <input type="number" name="capacity" id="capacity" 
                                               class="form-control border-start-0 ps-0 @error('capacity') is-invalid @elseif(old('capacity')) is-valid @enderror" 
                                               value="{{ old('capacity') }}" placeholder="e.g. 50">
                                        @error('capacity')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Gender Selection -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-dark" for="gender">Gender</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted">
                                            <i class="fa-solid fa-venus-mars"></i>
                                        </span>
                                        <select name="gender" id="gender" class="form-select border-start-0 ps-0 @error('gender') is-invalid @elseif(old('gender')) is-valid @enderror">
                                            <option value="">Select Gender</option>
                                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                        </select>
                                        @error('gender')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Image Upload -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-dark" for="image">Hostel Photo</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted">
                                            <i class="fa-solid fa-image"></i>
                                        </span>
                                        <input type="file" name="image" id="image" accept="image/*"
                                               class="form-control border-start-0 ps-0 @error('image') is-invalid @elseif(old('image')) is-valid @enderror"
                                               onchange="previewImage(event)">
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Image Preview Box -->
                                <div class="col-12 text-center d-none" id="preview-container">
                                    <p class="form-label fw-semibold text-muted small mb-2">Image Preview</p>
                                    <img id="image-preview" src="#" alt="Preview" class="rounded-3 border p-1 shadow-sm object-fit-cover" style="max-height: 140px; width: auto;">
                                </div>
                            </div>

                            <hr class="my-4 text-muted opacity-25">

                            <!-- Action Buttons -->
                            <div class="d-flex align-items-center justify-content-end gap-2">
                                <a href="{{ route('backend.hostels.index') }}" class="btn btn-outline-danger border px-4 py-2 rounded-pill fw-semibold">
                                    <i class="fa-solid fa-xmark fs-8 me-1"></i> မလုပ်တော့ပါ
                                </a>
                                <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill fw-semibold shadow-sm">
                                    <i class="fa-solid fa-check fs-8 me-1 text-light"></i> သိမ်းဆည်းမည်
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    // Live Image Preview Handler
    function previewImage(event) {
        let input = event.target;
        let previewContainer = document.getElementById('preview-container');
        let preview = document.getElementById('image-preview');

        if (input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                previewContainer.classList.remove('d-none');
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            previewContainer.classList.add('d-none');
        }
    }
</script>
@endsection