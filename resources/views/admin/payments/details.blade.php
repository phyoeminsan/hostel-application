@extends('layouts.admin')
@section('content')
<div class="container-fluid py-4">
    <h4 class="fw-bold mb-4 text-dark">Payment Verification & Details</h4>

    <div class="row g-4 align-items-stretch">
        <!-- Left Column: All Info in Single Card (col-lg-5) -->
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-primary text-white py-3 rounded-top-4 d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-bold"><i class="bi bi-person-badge me-2"></i>Student & Payment Details</h6>
                    <span class="badge {{ $payment->status == 'paid' ? 'bg-success' : ($payment->status == 'failed' ? 'bg-danger' : 'bg-warning text-dark') }} fs-6 px-3 py-1 rounded-pill">
                        {{ ucfirst($payment->status) }}
                    </span>
                </div>
                
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div>
                        <div class="row mb-3 border-bottom pb-2">
                            <div class="col-6">
                                <small class="text-muted d-block">Academic Year</small>
                                <span class="fw-bold text-dark">{{ $payment->hostel_application->student_record->academic_year->academic_year ?? 'N/A' }}</span>
                            </div>
                            <div class="col-6">
                                <small class="text-muted d-block">Student ID</small>
                                <span class="fw-bold fs-6 text-dark">{{ $payment->hostel_application->student_record->student->roll_no ?? 'N/A' }}</span>
                            </div>
                        </div>
                        <div class="row mb-3 border-bottom pb-2">
                            <div class="col-6">
                                <small class="text-muted d-block">Year</small>
                                <span class="fw-bold text-dark">{{ $payment->hostel_application->student_record->year->year_name ?? 'N/A' }}</span>
                            </div>
                            <div class="col-6">
                                <small class="text-muted d-block">Student Name</small>
                                <span class="fw-bold fs-6 text-dark">{{ $payment->hostel_application->student_record->student->name ?? 'N/A' }}</span>
                            </div>
                        </div>
                        <div class="row mb-3 border-bottom pb-2">
                            <div class="col-6">
                                <small class="text-muted d-block">Major</small>
                                <span class="fw-semibold text-dark">{{ $payment->hostel_application->student_record->student->major->major_name ?? 'N/A' }}</span>
                            </div>
                            <div class="col-6">
                                <small class="text-muted d-block">Address</small>
                                <span class="fw-bold fs-6 text-dark">{{ $payment->hostel_application->student_record->student->address ?? 'N/A' }}</span>
                            </div>
                        </div>

                        <div class="mb-4 border-bottom pb-3">
                            <small class="text-muted d-block">Selected Hostel</small>
                            <span class="badge bg-info text-dark fs-6 mt-1">
                                <i class="bi bi-house-door me-1"></i>{{ $payment->hostel_application->hostel->hostel_name ?? 'N/A' }}
                            </span>
                        </div>

                        <!-- Transaction Section -->
                        <div class="row mb-3">
                            <div class="col-6">
                                <small class="text-muted d-block">Payment Method</small>
                                <span class="fw-bold text-uppercase text-primary">{{ $payment->payment_method }}</span>
                            </div>
                            <div class="col-6">
                                <small class="text-muted d-block">Transaction ID / Slip No.</small>
                                <span class="fw-bold text-dark">{{ $payment->transaction_no ?? '-' }}</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <small class="text-muted d-block">Amount</small>
                                <span class="fw-bold text-success fs-5">{{ number_format($payment->amount) }} MMK</span>
                            </div>
                            <div class="col-6">
                                <small class="text-muted d-block">Payment Date</small>
                                <span class="fw-semibold text-dark">{{ $payment->payment_date }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons Section -->
                    <div class="pt-3 border-top mt-auto">
                        <div class="d-flex gap-2">
                            {{-- Approve Form --}}
                            <form action="{{ route('backend.payment.updateStatus', $payment->payment_id) }}" method="POST" class="w-100">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="paid">
                                <button type="submit" class="btn btn-success fw-bold w-100 py-2 shadow-sm">
                                    <i class="bi bi-check-circle me-1"></i> Approve / Mark as Paid
                                </button>
                            </form>

                            {{-- Reject Button (Collapse Toggle) --}}
                            <button type="button" class="btn btn-danger fw-bold w-100 py-2 shadow-sm" data-bs-toggle="collapse" data-bs-target="#rejectReasonBox" aria-expanded="false">
                                <i class="bi bi-x-circle me-1"></i> Reject / Paid Failed
                            </button>
                        </div>

                        {{-- Reject Reason Input Box (Collapse) --}}
                        <div class="collapse mt-3" id="rejectReasonBox">
                            <div class="card card-body bg-light border-danger border-opacity-25 rounded-3">
                                <form action="{{ route('backend.payment.updateStatus', $payment->payment_id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="failed">

                                    <label for="reason" class="form-label small fw-bold text-danger mb-1">
                                        Reason for Rejection (ငြင်းပယ်ရသည့် အကြောင်းအရင်း) <span class="text-danger">*</span>
                                    </label>
                                    <textarea name="reason" id="reason" class="form-control mb-2" rows="2" placeholder="ဥပမာ - Transaction ID မမှန်ပါ။ Payment slip ဓာတ်ပုံ မရှင်းလင်းပါ။" required></textarea>

                                    <button type="submit" class="btn btn-danger btn-sm w-100 fw-bold">
                                        <i class="bi bi-send me-1"></i> Confirm Reject
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Full Slip Preview with Click Link (col-lg-7) -->
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-light py-3 rounded-top-4">
                    <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-receipt me-2"></i>Payment Slip Screenshot</h6>
                </div>
                <div class="card-body p-3 d-flex flex-column align-items-center justify-content-center bg-light rounded-bottom-4">
                    @if($payment->payment_slip)
                        <a href="{{ asset($payment->payment_slip) }}" target="_blank" class="w-100 text-center text-decoration-none">
                            <img src="{{ asset($payment->payment_slip) }}" 
                                 class="img-fluid rounded-3 shadow" 
                                 style="max-height: 520px; width: 100%; object-fit: contain;" 
                                 alt="Payment Slip Preview">
                            <small class="text-dark d-block mt-2">
                                <i class="bi bi-search me-1"></i> ပုံကို နှိပ်၍ အကြီးကြည့်နိုင်ပါသည်
                            </small>
                        </a>
                    @else
                        <div class="text-center text-white-50 py-5">
                            <i class="bi bi-image fs-1 d-block mb-2"></i>
                            <span>Slip ပုံ တင်ထားခြင်းမရှိပါ။</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
