@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <h2>Payments </h2>
    </div>

       <!-- Recent Activities Table -->
        <div class="card shadow-sm p-4 bg-white rounded">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Payment Method</th>
                        <th>Amount</th>
                        <th>Payment Slip</th>
                        <th>Transaction No</th>
                        <th>Payment Date</th>
                        <th>Status</th>
                        <th>Reason</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($payments as $payment)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $payment->hostel_application->student_record->student->name ?? 'N/A' }}</td>
                            <td>{{ $payment->payment_method }}</td>
                            <td>{{ $payment->amount }}</td>
                            <td><img src="{{ $payment->payment_slip }}" alt="" width="50" height="50"></td>
                            <td>{{ $payment->transaction_no }}</td>
                            <td>{{ $payment->payment_date }}</td>
                            <td>
                                @if ($payment->status == 'paid')
                                    <span class="badge bg-success">{{ $payment->status ?? '-' }}</span>
                                @elseif($payment->status == 'pending')
                                    <span class="badge bg-warning text-dark">{{ $payment->status ?? '-' }}</span>
                                @else
                                    <span class="badge bg-danger">{{ $payment->status }}</span>
                                @endif
                            </td>
                            <td style="max-width: 100px;" class="text-truncate" title="{{ $payment->reason }}">
                                {{ $payment->reason ?? '-' }}
                            </td>
                            <td class="text-center">
                                <a href="{{ route('backend.payment.details', $payment->payment_id) }}" class="btn btn-sm btn-outline-primary">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- SweetAlert2 CDN CDN ထည့်သွင်းရန် -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Success Message ပြသပေးမည့် Logic -->
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
                    iconColor: '#28a745',
                    customClass: {
                        popup: 'rounded-4 shadow-lg',
                        title: 'fw-bold text-dark'
                    }
                });
            </script>
        @endif
@endsection