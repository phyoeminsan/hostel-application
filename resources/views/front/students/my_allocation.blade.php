@extends('layouts.front')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                
                {{-- Header / Hero Banner --}}
                <div class="card-header bg-dark text-white p-4 border-0 position-relative" style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="badge bg-primary-subtle text-primary fw-bold text-uppercase px-3 py-2 rounded-pill mb-2">Hostel Allocation Pass</span>
                            <h3 class="mb-0 fw-bold"><i class="bi bi-house-door-fill me-2 text-primary"></i>ကျောင်းသား အဆောင်နေရာချထားမှု</h3>
                        </div>
                        <div class="text-end d-none d-sm-block">
                            <i class="bi bi-building-check text-white-50 display-6"></i>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5">
                    @if($hostel_allocation)
                        {{-- Status Alert --}}
                        <div class="alert alert-success border-0 bg-success-subtle text-success p-3 rounded-3 mb-4 d-flex align-items-center">
                            <i class="bi bi-check-circle-fill fs-4 me-3"></i>
                            <div>
                                <strong>နေရာချထားမှု အတည်ပြုပြီးပါပြီ။</strong> သင်၏ အဆောင်နေရာချထားပေးမှု ကိစ္စ ပြီးမြောက်ပါပြီ။
                            </div>
                        </div>

                        {{-- Main Highlight Card (3 Columns: Hostel, Room, Floor) --}}
                        <div class="card bg-light border-0 rounded-4 p-4 mb-4 position-relative overflow-hidden">
                            <div class="position-absolute top-0 end-0 bg-primary opacity-10 rounded-circle" style="width: 150px; height: 150px; margin-right: -50px; margin-top: -50px;"></div>
                            <div class="row align-items-center text-center text-md-start">
                                {{-- 1. အဆောင်နာမည် --}}
                                <div class="col-md-4 mb-3 mb-md-0 border-end-md">
                                    <small class="text-muted fw-bold text-uppercase tracking-wider">အဆောင်နာမည်</small>
                                    <h3 class="fw-bold text-primary mb-0 mt-1">
                                        {{ $hostel_allocation->room->hostel->hostel_name ?? 'N/A' }}
                                    </h3>
                                </div>
                                
                                {{-- 2. အခန်းနံပါတ် --}}
                                <div class="col-md-4 mb-3 mb-md-0 border-end-md px-md-3">
                                    <small class="text-muted fw-bold text-uppercase tracking-wider">အခန်းနံပါတ်</small>
                                    <h3 class="fw-bold text-dark mb-0 mt-1">
                                        Room {{ $hostel_allocation->room->room_no ?? 'N/A' }}
                                    </h3>
                                </div>

                                {{-- 3. အထပ် (Floor) --}}
                                <div class="col-md-4 ps-md-3">
                                    <small class="text-muted fw-bold text-uppercase tracking-wider">အထပ်</small>
                                    <h3 class="fw-bold text-dark mb-0 mt-1">
                                        {{ $hostel_allocation->room->floor_no ?? '1st Floor' }} Floor
                                    </h3>
                                </div>
                            </div>
                        </div>

                        {{-- Aligned List Content --}}
                        <div class="mx-auto my-4" style="max-width: 500px;">
                            <div class="row align-items-center py-3 border-bottom">
                                <div class="col-6 text-muted fw-medium">
                                    <i class="bi bi-card-heading me-2"></i>ကျောင်းသား/သူ နံပါတ်
                                </div>
                                <div class="col-6 fw-bold text-dark">
                                    {{ $hostel_allocation->payment->hostel_application->student_record->student->roll_no ?? 'N/A' }}
                                </div>
                            </div>
                            
                            <div class="row align-items-center py-3 border-bottom">
                                <div class="col-6 text-muted fw-medium">
                                    <i class="bi bi-person me-2"></i>ကျောင်းသား/သူ နာမည်
                                </div>
                                <div class="col-6 fw-bold text-dark">
                                    {{ $hostel_allocation->payment->hostel_application->student_record->student->name ?? 'N/A' }}
                                </div>
                            </div>

                            <div class="row align-items-center py-3 border-bottom">
                                <div class="col-6 text-muted fw-medium">
                                    <i class="bi bi-mortarboard me-2"></i>သင်တန်းနှစ် / မေဂျာ
                                </div>
                                <div class="col-6 fw-bold text-dark">
                                    {{ $hostel_allocation->payment->hostel_application->student_record->year->year_name ?? 'N/A' }} 
                                    <span class="text-muted font-normal">({{ $hostel_allocation->payment->hostel_application->student_record->student->major->major_name ?? 'N/A' }})</span>
                                </div>
                            </div>

                            <div class="row align-items-center py-3 border-bottom">
                                <div class="col-6 text-muted fw-medium">
                                    <i class="bi bi-calendar-event me-2"></i>စတင်နေထိုင်နိုင်မည့်ရက်
                                </div>
                                <div class="col-6 fw-bold text-dark">
                                    {{ $hostel_allocation->allocation_date }}
                                </div>
                            </div>

                            <div class="row align-items-center py-3">
                                <div class="col-6 text-muted fw-medium">
                                    <i class="bi bi-info-circle me-2"></i>အခြေအနေ
                                </div>
                                <div class="col-6">
                                    @if(strtolower($hostel_allocation->status) === 'active')
                                        <span class="badge bg-success text-white rounded-pill px-3 py-2">
                                            <i class="bi bi-check-circle-fill me-1"></i> ACTIVE
                                        </span>
                                    @else
                                        <span class="badge bg-warning text-dark rounded-pill px-3 py-2">
                                            <i class="bi bi-exclamation-triangle-fill me-1"></i> INACTIVE
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if($hostel_allocation->description)
                            <div class="p-3 rounded-3 bg-body-tertiary border-start border-4 border-primary mt-4">
                                <h6 class="fw-bold text-dark mb-1"><i class="bi bi-shield-exclamation me-2 text-primary"></i>စည်းကမ်းချက် / ဖော်ပြချက်</h6>
                                <p class="mb-0 text-secondary small leading-relaxed">{{ $hostel_allocation->description }}</p>
                            </div>
                        @endif

                    @else
                        <div class="text-center py-5">
<<<<<<< HEAD
                            <i class="bi bi-building-dash text-muted opacity-50 display-1"></i>
=======
                            <i class="bi bi-hotel text-muted opacity-50 display-1"></i>
>>>>>>> 62d1948 (feat: initial commit of local hostel application project)
                            <h4 class="mt-3 text-dark fw-bold">လက်တလော အဆောင်နေရာချထားပေးခြင်း မရှိသေးပါ။</h4>
                            <p class="text-muted">ကျောင်းဘက် မှ စီစဉ်ပေးပြီးပါက ဤနေရာတွင် ကြည့်ရှုနိုင်မည်ဖြစ်ပါသည်။</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection