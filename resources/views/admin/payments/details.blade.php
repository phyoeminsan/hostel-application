@extends('layouts.admin')

@section('content')
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container-fluid py-4">
    <!-- Header with Back Button -->
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div class="d-flex align-items-center gap-3">
            <a href="javascript:history.back()" class="btn btn-outline-secondary btn-sm rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div>
                <h4 class="fw-bold text-dark mb-0">Payment Verification</h4>
                <p class="text-muted small mb-0">Review payment details and verify transaction slip.</p>
            </div>
        </div>
        <div>
            @if ($payment->status == 'paid')
                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill fs-6 px-3 py-2 fw-semibold">
                    <i class="fa-solid fa-circle-check me-1"></i> Paid
                </span>
            @elseif($payment->status == 'pending')
                <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle rounded-pill fs-6 px-3 py-2 fw-semibold">
                    <i class="fa-solid fa-clock me-1"></i> Pending Verification
                </span>
            @else
                <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill fs-6 px-3 py-2 fw-semibold">
                    <i class="fa-solid fa-circle-xmark me-1"></i> {{ ucfirst($payment->status) }}
                </span>
            @endif
        </div>
    </div>

    <div class="row g-4 align-items-stretch">
        <!-- Left Column: Student & Payment Info (col-lg-6) -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-white overflow-hidden">
                <div class="card-header bg-light border-bottom py-3 px-4">
                    <h6 class="mb-0 fw-bold text-dark d-flex align-items-center">
                        <i class="fa-solid fa-user-graduate text-primary me-2"></i> Student Information
                    </h6>
                </div>
                
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div>
                        <!-- Student Profile Snapshot -->
                        <div class="d-flex align-items-center p-3 rounded-3 bg-light mb-4 border">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold fs-4 me-3 shadow-sm" style="width: 52px; height: 52px;">
                                {{ strtoupper(substr($payment->hostel_application->student_record->student->name ?? 'S', 0, 1)) }}
                            </div>
                            <div>
                                <h6 class="fw-bold text-dark mb-1 fs-6">
                                    {{ $payment->hostel_application->student_record->student->name ?? 'N/A' }}
                                </h6>
                                <span class="badge bg-white text-secondary border px-2 py-1 small">
                                    Roll No: {{ $payment->hostel_application->student_record->student->roll_no ?? 'N/A' }}
                                </span>
                            </div>
                        </div>

                        <!-- Info Grid -->
                        <div class="row g-3 mb-3">
                            <div class="col-6">
                                <div class="p-2 border-start border-3 border-primary bg-light rounded-end">
                                    <small class="text-muted d-block uppercase-text fs-7">Academic Year</small>
                                    <span class="fw-bold text-dark small">{{ $payment->hostel_application->student_record->academic_year->academic_year ?? 'N/A' }}</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-2 border-start border-3 border-primary bg-light rounded-end">
                                    <small class="text-muted d-block uppercase-text fs-7">Year Level</small>
                                    <span class="fw-bold text-dark small">{{ $payment->hostel_application->student_record->year->year_name ?? 'N/A' }}</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-2 border-start border-3 border-primary bg-light rounded-end">
                                    <small class="text-muted d-block uppercase-text fs-7">Major</small>
                                    <span class="fw-bold text-dark small">{{ $payment->hostel_application->student_record->student->major->major_name ?? 'N/A' }}</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-2 border-start border-3 border-primary bg-light rounded-end">
                                    <small class="text-muted d-block uppercase-text fs-7">Gender</small>
                                    <span class="fw-bold text-dark small">{{ ucfirst($payment->hostel_application->hostel->gender ?? 'N/A') }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <small class="text-muted d-block uppercase-text fs-7 mb-1">Selected Hostel</small>
                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3 py-2 fw-semibold">
                                <i class="fa-solid fa-hotel me-1"></i> {{ $payment->hostel_application->hostel->hostel_name ?? 'N/A' }}
                            </span>
                        </div>

                        <!-- Payment Summary Header -->
                        <div class="border-top pt-3 mb-3">
                            <h6 class="fw-bold text-dark d-flex align-items-center mb-3">
                                <i class="fa-solid fa-receipt text-success me-2"></i> Payment Details
                            </h6>
                            <div class="row g-3">
                                <div class="col-6">
                                    <small class="text-muted d-block">Payment Method</small>
                                    <span class="fw-bold text-dark text-uppercase small">
                                        <i class="fa-solid fa-wallet text-muted me-1"></i> {{ $payment->payment_method }}
                                    </span>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">Transaction ID / Slip No.</small>
                                    <code class="bg-light text-primary px-2 py-1 rounded small fw-bold">
                                        {{ $payment->transaction_no ?? '-' }}
                                    </code>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">Amount Paid</small>
                                    <span class="fw-bold text-success fs-5">{{ number_format($payment->amount) }} <small class="fs-6">KS</small></span>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">Payment Date</small>
                                    <span class="fw-semibold text-dark small">
                                        {{ \Carbon\Carbon::parse($payment->payment_date)->format('d M, Y') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        @if($payment->reason)
                            <div class="alert alert-danger bg-danger-subtle border-danger-subtle text-danger rounded-3 small mb-0">
                                <strong><i class="fa-solid fa-circle-exclamation me-1"></i> Rejection Reason:</strong> {{ $payment->reason }}
                            </div>
                        @endif
                    </div>

                    <!-- Action Buttons Section -->
                    <div class="pt-3 border-top mt-4">
                        <div class="d-flex gap-2">
                            <!-- Approve Button -->
                            <form id="approve-form" action="{{ route('backend.payment.updateStatus', $payment->payment_id) }}" method="POST" class="w-100">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="paid">
                                <button type="button" onclick="confirmApprove()" class="btn btn-success fw-bold w-100 py-2 rounded-3 shadow-sm d-flex align-items-center justify-content-center gap-2" {{ $payment->status == 'paid' ? 'disabled' : '' }}>
                                    <i class="fa-solid fa-circle-check"></i> Mark as Paid
                                </button>
                            </form>

                            <!-- Reject Toggle Button -->
                            <button type="button" class="btn btn-outline-danger fw-bold w-100 py-2 rounded-3 shadow-sm d-flex align-items-center justify-content-center gap-2" data-bs-toggle="collapse" data-bs-target="#rejectReasonBox" aria-expanded="false" {{ $payment->status == 'failed' ? 'disabled' : '' }}>
                                <i class="fa-solid fa-circle-xmark"></i> Reject Payment
                            </button>
                        </div>

                        <!-- Reject Reason Box (Collapse) -->
                        <div class="collapse mt-3" id="rejectReasonBox">
                            <div class="card card-body bg-light border-danger border-opacity-25 rounded-3">
                                <form action="{{ route('backend.payment.updateStatus', $payment->payment_id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="failed">

                                    <label for="reason" class="form-label small fw-bold text-danger mb-1">
                                        Rejection Reason (ငြင်းပယ်ရသည့် အကြောင်းအရင်း) <span class="text-danger">*</span>
                                    </label>
                                    <textarea name="reason" id="reason" class="form-control form-control-sm mb-2" rows="2" placeholder="ဥပမာ - Transaction ID မမှန်ပါ။ Payment slip ဓာတ်ပုံ မရှင်းလင်းပါ။" required></textarea>

                                    <button type="submit" class="btn btn-danger btn-sm w-100 fw-bold py-2 rounded-2">
                                        <i class="fa-solid fa-paper-plane me-1"></i> Confirm Rejection
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Slip Image Preview (col-lg-6) -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-white overflow-hidden">
                <div class="card-header bg-light border-bottom py-3 px-4 d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-bold text-dark d-flex align-items-center">
                        <i class="fa-solid fa-image text-primary me-2"></i> Payment Slip Screenshot
                    </h6>
                    @if($payment->payment_slip)
                        <a href="{{ asset($payment->payment_slip) }}" target="_blank" class="btn btn-sm btn-light border rounded-pill px-3">
                            <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Open Original
                        </a>
                    @endif
                </div>
                <div class="card-body p-4 d-flex flex-column align-items-center justify-content-center bg-light-subtle rounded-bottom-4">
                    @if($payment->payment_slip)
                        <div class="position-relative overflow-hidden rounded-3 border shadow-sm w-100 text-center bg-white p-2">
                            <img src="{{ asset($payment->payment_slip) }}" 
                                 class="img-fluid rounded-2" 
                                 style="max-height: 520px; width: 100%; object-fit: contain; cursor: pointer;" 
                                 alt="Payment Slip Preview"
                                 onclick="previewImage('{{ asset($payment->payment_slip) }}')">
                        </div>
                        <small class="text-muted d-block mt-3">
                            <i class="fa-solid fa-magnifying-glass-plus me-1"></i> ပုံကို နှိပ်၍ Full Screen ကြည့်ရှုနိုင်ပါသည်။
                        </small>
                    @else
                        <div class="text-center text-muted py-5">
                            <i class="fa-regular fa-image fs-1 d-block mb-2 opacity-50"></i>
                            <span class="small">Slip ဓာတ်ပုံ တင်ထားခြင်းမရှိပါ။</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // SweetAlert2 Confirmation for Mark as Paid
    function confirmApprove() {
        Swal.fire({
            title: 'သေချာပါသလား?',
            text: "ငွေပေးချေမှုကို အတည်ပြု (Paid) အဖြစ် သတ်မှတ်မည်။",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#198754',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'အတည်ပြုမည်',
            cancelButtonText: 'မလုပ်တော့ပါ',
            customClass: {
                popup: 'rounded-4 shadow'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('approve-form').submit();
            }
        });
    }

    // Modal Image Preview
    function previewImage(src) {
        Swal.fire({
            imageUrl: src,
            imageAlt: 'Payment Slip Preview',
            showCloseButton: true,
            showConfirmButton: false,
            customClass: {
                popup: 'rounded-4 shadow-lg p-2'
            }
        });
    }
</script>
@endsection