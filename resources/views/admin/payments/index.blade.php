@extends('layouts.admin')

@section('content')
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Success Session Notification -->
@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'အောင်မြင်ပါသည်!',
            text: '{{ session("success") }}',
            showConfirmButton: false,
            timer: 2500,
            timerProgressBar: true,
            background: '#ffffff',
            iconColor: '#198754',
            customClass: {
                popup: 'rounded-4 shadow-lg',
                title: 'fw-bold text-dark'
            }
        });
    </script>
@endif

<div class="container-fluid py-4">

    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div>
            <h4 class="fw-bold text-dark mb-1">Payment Records</h4>
            <p class="text-muted small mb-0">Track and review student hostel fee payment transactions.</p>
        </div>
    </div>

    <!-- Main Card & Table -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-borderless table-hover align-middle mb-0">
                    <thead class="bg-light border-bottom">
                        <tr>
                            <th class="ps-4 text-dark small fw-bold text-uppercase" style="width: 60px;">#</th>
                            <th class="text-dark small fw-bold text-uppercase">Student Name</th>
                            <th class="text-dark small fw-bold text-uppercase">Method</th>
                            <th class="text-dark small fw-bold text-uppercase">Amount</th>
                            <th class="text-dark small fw-bold text-uppercase">Slip</th>
                            <th class="text-dark small fw-bold text-uppercase">Transaction No</th>
                            <th class="text-dark small fw-bold text-uppercase">Date</th>
                            <th class="text-dark small fw-bold text-uppercase">Status</th>
                            <th class="text-dark small fw-bold text-uppercase">Reason</th>
                            <th class="pe-4 text-center text-dark small fw-bold text-uppercase" style="width: 100px;">Action</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse ($payments as $payment)
                            <tr>
                                <!-- Index -->
                                <td class="ps-4 fw-semibold text-secondary small">
                                    {{ $loop->iteration }}
                                </td>

                                <!-- Student Name -->
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center me-2 fw-bold" style="width: 32px; height: 32px; font-size: 13px;">
                                            {{ strtoupper(substr($payment->hostel_application->student_record->student->name ?? 'S', 0, 1)) }}
                                        </div>
                                        <span class="fw-bold text-dark small">
                                            {{ $payment->hostel_application->student_record->student->name ?? 'N/A' }}
                                        </span>
                                    </div>
                                </td>

                                <!-- Payment Method -->
                                <td>
                                    <span class="text-secondary px-2 py-1 small">
                                        <i class="fa-solid fa-wallet me-1 text-muted"></i>
                                        {{ $payment->payment_method }}
                                    </span>
                                </td>

                                <!-- Amount -->
                                <td>
                                    <span class="fw-bold text-dark small">
                                        {{ number_format($payment->amount) }} KS
                                    </span>
                                </td>

                                <!-- Payment Slip -->
                                <td>
                                    @if($payment->payment_slip)
                                        <div class="rounded-3 border overflow-hidden d-inline-block shadow-sm" style="width: 42px; height: 42px;">
                                            <img src="{{ asset($payment->payment_slip) }}" alt="Slip" class="w-100 h-100 object-fit-cover" style="cursor: pointer;" onclick="previewImage('{{ asset($payment->payment_slip) }}')">
                                        </div>
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                </td>

                                <!-- Transaction No -->
                                <td>
                                    <code class="bg-light text-primary px-2 py-1 rounded small fw-semibold">
                                        {{ $payment->transaction_no ?? 'N/A' }}
                                    </code>
                                </td>

                                <!-- Payment Date -->
                                <td class="text-muted small">
                                    {{ \Carbon\Carbon::parse($payment->payment_date)->format('d M, Y') }}
                                </td>

                                <!-- Status Badge -->
                                <td>
                                    @if ($payment->status == 'paid')
                                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1">
                                            <i class="fa-solid fa-circle-check me-1 small"></i> Paid
                                        </span>
                                    @elseif($payment->status == 'pending')
                                        <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle rounded-pill px-3 py-1">
                                            <i class="fa-solid fa-clock me-1 small"></i> Pending
                                        </span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-3 py-1">
                                            <i class="fa-solid fa-circle-xmark me-1 small"></i> {{ ucfirst($payment->status) }}
                                        </span>
                                    @endif
                                </td>

                                <!-- Reason -->
                                <td>
                                    <span class="d-inline-block text-truncate text-muted small" style="max-width: 120px;" title="{{ $payment->reason }}">
                                        {{ $payment->reason ?? '-' }}
                                    </span>
                                </td>

                               <!-- Action Button (ပုံထဲကအတိုင်း ပြင်ဆင်ထားသော Button) -->
                                <td class="pe-4 text-end">
                                    <a href="{{ route('backend.payment.details', $payment->payment_id) }}" class="btn btn-sm btn-light border border-secondary-subtle text-dark rounded-pill px-3 py-1 fw-medium text-nowrap shadow-sm">
                                        View Detail <i class="fa-solid fa-chevron-right ms-1 fs-xs"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center py-4 text-muted small">
                                    <i class="fa-solid fa-inbox fs-4 d-block mb-2"></i>
                                    ငွေပေးချေမှုမှတ်တမ်းများ မရှိသေးပါ။
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                @if(method_exists($payments, 'hasPages') && $payments->hasPages())
                    <div class="card-footer bg-white border-0 py-3 px-4">
                        {{ $payments->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    // Payment Slip image zoom preview logic
    function previewImage(src) {
        Swal.fire({
            imageUrl: src,
            imageAlt: 'Payment Slip',
            showCloseButton: true,
            showConfirmButton: false,
            customClass: {
                popup: 'rounded-4 shadow-lg p-2'
            }
        });
    }
</script>
@endsection