@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-3">

    <!-- Header Section with Back Button -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Edit Year</h3>
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
                            <i class="fa-solid fa-calendar-check fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-1">Update Year Record</h5>
                            <p class="text-muted small mb-0">Make changes to the selected year level details below.</p>
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
                    <form action="{{ route('backend.years.update', $year->year_id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-4">
                            <!-- Year Name Input -->
                            <div class="col-12">
                                <label for="year_name" class="form-label fw-semibold text-dark">
                                    Year Name <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted">
                                        <i class="fa-solid fa-font"></i>
                                    </span>
                                    <input type="text" 
                                           name="year_name" 
                                           id="year_name" 
                                           class="form-control border-start-0 ps-0 @error('year_name') is-invalid @enderror" 
                                           placeholder="e.g. First Year, Second Year" 
                                           value="{{ old('year_name', $year->year_name) }}">
                                    @error('year_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr class="my-4 text-muted opacity-25">

                        <!-- Action Buttons -->
                        <div class="d-flex align-items-center justify-content-end gap-2">
                            <a href="{{ route('backend.years.index') }}" class="btn btn-outline-danger border px-4 py-2 rounded-pill fw-semibold">
                                <i class="fa-solid fa-xmark fs-8 me-1"></i> မလုပ်တော့ပါ
                            </a>
                            <button type="submit" class="btn btn-warning text-dark px-4 py-2 rounded-pill fw-semibold shadow-sm">
                                <i class="fa-solid fa-check fs-8 me-1 text-dark"></i> ပြင်ဆင်ချက်များ သိမ်းမည်
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
