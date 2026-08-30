@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-3">

    <!-- Header Section with Back Button -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Add New Major</h3>
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
                            <i class="fa-solid fa-graduation-cap fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-1">Major Setup</h5>
                            <p class="text-muted small mb-0">Provide the required information below to register a new academic major.</p>
                        </div>
                    </div>
                </div>
                @if ($errors->any())
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                        Swal.fire({
                            icon: 'warning',
                            title: 'အချက်အလက် မပြည့်စုံပါ!',
                            text: 'ကျေးဇူးပြု၍ လိုအပ်သော အချက်အလက်ကို ဖြည့်သွင်းပေးပါ။',
                            confirmButtonText: 'လက်ခံသည်',
                            confirmButtonColor: '#0d6efd'
                        });
                    </script>
                @endif
                <!-- Form Body -->
                <div class="card-body p-4">
                    <form action="{{ route('backend.majors.store') }}" method="POST">
                        @csrf

                        <div class="row g-4">
                            <!-- Major Name Input -->
                            <div class="col-12">
                                <label for="major_name" class="form-label fw-semibold text-dark">
                                    Major Name <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted">
                                        <i class="fa-solid fa-graduation-cap"></i>
                                    </span>
                                    <input type="text" 
                                           name="major_name" 
                                           id="major_name" 
                                           class="form-control border-start-0 ps-0 @error('major_name') is-invalid @elseif(old('major_name')) is-valid @enderror" 
                                           placeholder="e.g. CST,CS,CT" 
                                           value="{{ old('major_name') }}">
                                    @error('major_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-text text-muted small ms-1">Enter the official title for this major.</div>
                            </div>
                        </div>

                        <hr class="my-4 text-muted opacity-25">

                        <!-- Action Buttons -->
                        <div class="d-flex align-items-center justify-content-end gap-2">
                            <a href="{{ route('backend.majors.index') }}" class="btn btn-outline-danger border px-4 py-2 rounded-pill fw-semibold">
                                မလုပ်တော့ပါ
                            </a>
                            <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill fw-semibold shadow-sm">
                                သိမ်းဆည်းမည်
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection