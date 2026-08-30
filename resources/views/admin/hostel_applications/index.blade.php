@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">

    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div>
            <h4 class="fw-bold text-dark mb-1">Hostel Applications</h4>
            <p class="text-muted small mb-0">Manage student hostel allocation requests and approval statuses.</p>
        </div>
    </div>

    <!-- Main Card & Table -->
    <div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-borderless table-hover align-middle mb-0">
                    <thead class="bg-light border-bottom">
                        <tr>
                            <th class="ps-4 text-dark small fw-bold text-uppercase" style="width: 60px;">#</th>
                            <th class="text-dark small fw-bold text-uppercase">Student Name</th>
                            <th class="text-dark small fw-bold text-uppercase">Address</th>
                            <th class="text-dark small fw-bold text-uppercase">Hostel</th>
                            <th class="text-dark small fw-bold text-uppercase">Apply Date</th>
                            <th class="text-dark small fw-bold text-uppercase">Status</th>
                            <th class="text-dark small fw-bold text-uppercase">Reason</th>
                            <th class="pe-4 py-3 text-center" style="width: 180px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse ($hostel_applications as $index => $hostel_application)
                            <tr>
                                <!-- Index -->
                                <td class="ps-4 fw-semibold text-secondary small">
                                    {{ $loop->iteration }}
                                </td>

                                <!-- Student Name -->
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center me-2 fw-bold" style="width: 32px; height: 32px; font-size: 13px;">
                                            {{ strtoupper(substr($hostel_application->student_record->student->name ?? 'S', 0, 1)) }}
                                        </div>
                                        <span class="fw-bold text-dark small">{{ $hostel_application->student_record->student->name }}</span>
                                    </div>
                                </td>

                                <!-- Address -->
                                <td class="text-muted small">
                                    <i class="fa-solid fa-location-dot me-1 text-danger opacity-75"></i>
                                    {{ $hostel_application->student_record->student->address }}
                                </td>

                                <!-- Hostel -->
                                <td>
                                    <span class="fw-semibold text-dark small">
                                        <i class="fa-solid fa-hotel me-1 text-secondary"></i>
                                        {{ $hostel_application->hostel->hostel_name }}
                                    </span>
                                </td>

                                <!-- Apply Date -->
                                <td class="text-muted small">
                                    {{ \Carbon\Carbon::parse($hostel_application->apply_date)->format('d M, Y') }}
                                </td>

                                <!-- Status Badge -->
                                <td>
                                    @if ($hostel_application->status == 'approved')
                                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1">
                                            <i class="fa-solid fa-circle-check me-1 small"></i> Approved
                                        </span>
                                    @elseif($hostel_application->status == 'pending')
                                        <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle rounded-pill px-3 py-1">
                                            <i class="fa-solid fa-clock me-1 small"></i> Pending
                                        </span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-3 py-1">
                                            <i class="fa-solid fa-circle-xmark me-1 small"></i> Rejected
                                        </span>
                                    @endif
                                </td>

                                <!-- Reason -->
                                <td>
                                    <span class="d-inline-block text-truncate text-muted small" style="max-width: 180px;" title="{{ $hostel_application->reason }}">
                                        {{ $hostel_application->reason ?? '-' }}
                                    </span>
                                </td>

                                <!-- Action Buttons -->
                                <td class="pe-4 text-end">
                                    <div class="d-inline-flex gap-2">
                                        <!-- Approve Button -->
                                        <button type="button" 
                                                class="btn btn-sm btn-outline-success rounded-pill px-3 py-1 approve-btn d-inline-flex align-items-center gap-1 shadow-sm" 
                                                data-id="{{ $hostel_application->application_id }}">
                                            <i class="fa-solid fa-check"></i> Approve
                                        </button>

                                        <form id="approve-form-{{ $hostel_application->application_id }}" 
                                              action="{{ route('backend.hostel_applications.approved', $hostel_application->application_id) }}" 
                                              method="POST" class="d-none">
                                            @csrf
                                        </form>

                                        <!-- Reject Button -->
                                        <button type="button" 
                                                class="btn btn-sm btn-outline-danger rounded-pill px-3 py-1 reject-btn d-inline-flex align-items-center gap-1 shadow-sm" 
                                                data-id="{{ $hostel_application->application_id }}">
                                            <i class="fa-solid fa-xmark"></i> Reject
                                        </button>

                                        <form id="reject-form-{{ $hostel_application->application_id }}" 
                                              action="{{ route('backend.hostel_applications.rejected', $hostel_application->application_id) }}" 
                                              method="POST" class="d-none">
                                            @csrf
                                            <input type="hidden" name="reason" id="reject-reason-{{ $hostel_application->application_id }}">
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted small">
                                    <i class="fa-solid fa-inbox fs-4 d-block mb-2"></i>
                                    လျှောက်လွှာများ မရှိသေးပါ။
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <!-- Pagination Section -->
                @if(method_exists($hostel_applications, 'hasPages') && $hostel_applications->hasPages())
                    <div class="card-footer bg-white border-0 py-3 px-4">
                        {{ $hostel_applications->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert2 Scripts -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        
        // Approve Confirmation Alert
        document.querySelectorAll('.approve-btn').forEach(button => {
            button.addEventListener('click', function () {
                let id = this.getAttribute('data-id');
                
                Swal.fire({
                    title: 'သေချာပါသလား?',
                    text: "ဒီလျှောက်လွှာကို အတည်ပြုရန် သေချာပါသလား?",
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
                        document.getElementById('approve-form-' + id).submit();
                    }
                });
            });
        });

        // Reject Input Reason Alert
        document.querySelectorAll('.reject-btn').forEach(button => {
            button.addEventListener('click', function () {
                let id = this.getAttribute('data-id');

                Swal.fire({
                    title: 'ငြင်းပယ်ရသည့် အကြောင်းရင်း',
                    input: 'textarea',
                    inputPlaceholder: 'အကြောင်းရင်းကို ဒီနေရာတွင် ရိုက်ထည့်ပါ...',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'ငြင်းပယ်မည်',
                    cancelButtonText: 'မလုပ်တော့ပါ',
                    customClass: {
                        popup: 'rounded-4 shadow'
                    },
                    inputValidator: (value) => {
                        if (!value) {
                            return 'ကျေးဇူးပြု၍ အကြောင်းရင်း ရိုက်ထည့်ပေးပါ!';
                        }
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('reject-reason-' + id).value = result.value;
                        document.getElementById('reject-form-' + id).submit();
                    }
                });
            });
        });

    });
</script>
@endsection