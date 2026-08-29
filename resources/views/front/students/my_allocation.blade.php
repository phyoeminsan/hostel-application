@extends('layouts.front')

@section('content')
<div class="container py-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-primary text-white p-3 rounded-top-4">
                    <h4 class="mb-0 fw-bold"><i class="bi bi-house-door-fill me-2"></i>ကျောင်းသား အဆောင်နေရာချထားမှု အချက်အလက်</h4>
                </div>
                <div class="card-body p-4">
                    @if($hostel_allocation)
                        <div class="alert alert-success d-flex align-items-center mb-4" role="alert">
                            <i class="bi bi-check-circle-fill fs-4 me-3"></i>
                            <div>
                                <strong>ဝမ်းမြောက်စွာဖြင့် အသိပေးအပ်ပါသည်။</strong> သင်၏ အဆောင်နေရာချထားမှု အတည်ပြုပြီးပါပြီ။
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded-3 border">
                                    <small class="text-muted d-block fw-bold">ကျောင်းသား/သူ နံပါတ်</small>
                                    <span class="fs-5 fw-bold text-dark">
                                        {{ $hostel_allocation->payment->hostel_application->student_record->student->roll_no ?? 'N/A' }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded-3 border">
                                    <small class="text-muted d-block fw-bold">အဆောင်နာမည်</small>
                                    <span class="fs-5 fw-bold text-dark">
                                        {{ $hostel_allocation->room->hostel->hostel_name ?? 'N/A' }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded-3 border">
                                    <small class="text-muted d-block fw-bold">ကျောင်းသား/သူ နာမည်</small>
                                    <span class="fs-5 fw-bold text-dark">
                                        {{ $hostel_allocation->payment->hostel_application->student_record->student->name ?? 'N/A' }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded-3 border">
                                    <small class="text-muted d-block fw-bold">အခန်းနံပါတ်</small>
                                    <span class="fs-5 fw-bold text-primary">
                                        Room {{ $hostel_allocation->room->room_no ?? 'N/A' }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded-3 border">
                                    <small class="text-muted d-block fw-bold">သင်တန်းနှစ်</small>
                                    <span class="fs-5 fw-bold text-dark">
                                        {{ $hostel_allocation->payment->hostel_application->student_record->year->year_name ?? 'N/A' }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded-3 border">
                                    <small class="text-muted d-block fw-bold">မေဂျာ</small>
                                    <span class="fs-5 fw-bold text-dark">
                                        {{ $hostel_allocation->payment->hostel_application->student_record->student->major->major_name ?? 'N/A' }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded-3 border">
                                    <small class="text-muted d-block fw-bold">စတင်နေထိုင်နိုင်မည့်ရက်</small>
                                    <span class="fw-semibold text-dark">{{ $hostel_allocation->allocation_date }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded-3 border">
                                    <small class="text-muted d-block fw-bold mb-1">အခြေအနေ</small>
                                    
                                    @if(strtolower($hostel_allocation->status) === 'active')
                                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill text-uppercase px-3 py-2">
                                            <i class="bi bi-check-circle-fill me-1"></i> Active
                                        </span>
                                    @else
                                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill text-uppercase px-3 py-2">
                                            <i class="bi bi-x-circle-fill me-1"></i> Inactive
                                        </span>
                                    @endif
                                </div>
                            </div>
                            @if($hostel_allocation->description)
                            <div class="col-12">
                                <div class="p-3 bg-light rounded-3 border">
                                    <small class="text-muted d-block fw-bold mb-1">စည်းကမ်းချက် / ဖော်ပြချက်</small>
                                    <p class="mb-0 text-secondary">{{ $hostel_allocation->description }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-exclamation-circle text-warning fs-1"></i>
                            <h5 class="mt-3 text-muted">အဆောင်နေရာချထားပေးခြင်း မရှိသေးပါ။</h5>
                            <p class="text-secondary small">Admin မှ စီစဉ်ပေးပြီးပါက ဤနေရာတွင် ကြည့်ရှုနိုင်မည်ဖြစ်ပါသည်။</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection