@extends('layouts.admin')

@section('content')
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Flash Success Message Alert -->
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
                popup: 'rounded-4 shadow-lg border-0',
                title: 'fw-bold text-dark'
            }
        });
    </script>
@endif

<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
        <div>
            <h4 class="fw-bold text-dark mb-1">Hostel Allocations</h4>
            <p class="text-muted small mb-0">Manage student hostel room allocations and active statuses.</p>
        </div>
        <a href="{{ route('backend.hostel_allocations.create') }}" class="btn btn-primary fw-semibold px-3 py-2 rounded-3 shadow-sm d-flex align-items-center gap-2">
            <i class="fa-solid fa-plus"></i> Add New Allocation
        </a>
    </div>

    <!-- Main Data Table Card -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-borderless table-hover align-middle mb-0">
                    <thead class="table-light border-bottom">
                        <tr class="text-secondary small text-uppercase fw-semibold">
                            <th class="ps-4 py-3" style="width: 60px;">No</th>
                            <th class="py-3">Student Name</th>
                            <th class="py-3">Year</th>
                            <th class="py-3">Major</th>
                            <th class="py-3">Room No</th>
                            <th class="py-3">Hostel</th>
                            <th class="py-3">Allocation Date</th>
                            <th class="py-3 text-center">Status</th>
                            <th class="pe-4 py-3 text-center" style="width: 180px;">Action</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse ($hostel_allocations as $index => $hostel_allocation)
                            <tr>
                                <td class="ps-4 fw-semibold text-secondary small">{{ $index + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center me-2 fw-bold" style="width: 32px; height: 32px; font-size: 13px;">
                                            {{ strtoupper(substr($hostel_allocation->payment->hostel_application->student_record->student->name ?? 'S', 0, 1)) }}
                                        </div>
                                        <span class="fw-bold text-dark small">{{ $hostel_allocation->payment->hostel_application->student_record->student->name }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2.5 py-1 fw-semibold">
                                        {{ $hostel_allocation->payment->hostel_application->student_record->year->year_name ?? 'N/A'  }}
                                    </span>
                                </td>
                                <td class="py-3 text-secondary small">
                                    <i class="fa-solid fa-graduation-cap me-1 text-muted opacity-50"></i>{{ $hostel_allocation->payment->hostel_application->student_record->student->major->major_name ?? 'N/A'}}
                                </td>
                                <td>
                                    <span class="fw-bold text-primary">
                                        <i class="fa-solid fa-bed me-1"></i>{{ $hostel_allocation->room->room_no ?? 'N/A' }}
                                    </span>
                                </td>
                                <td class="text-secondary small fw-semibold">
                                    <i class="fa-solid fa-hotel me-1"></i>{{ $hostel_allocation->room->hostel->hostel_name ?? 'N/A'}}
                                </td>
                                <td class="text-secondary small">
                                    {{ \Carbon\Carbon::parse($hostel_allocation->allocation_date)->format('d M, Y') }}
                                </td>
                                <td class="text-center">
                                    @if ($hostel_allocation->status == 'active')
                                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1 fw-semibold">
                                            <i class="fa-solid fa-circle-check me-1"></i> Active
                                        </span>
                                    @else
                                        <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle rounded-pill px-3 py-1 fw-semibold">
                                            <i class="fa-solid fa-clock me-1"></i> {{ ucfirst($hostel_allocation->status) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="pe-4 text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <!-- Active Button -->
                                        <button type="button" 
                                                class="btn btn-sm btn-outline-success rounded-3 active-btn d-flex align-items-center gap-1" 
                                                data-id="{{ $hostel_allocation->allocation_id }}"
                                                {{ $hostel_allocation->status == 'active' ? 'disabled' : '' }}
                                                title="Mark as Active">
                                            <i class="fa-solid fa-check"></i> Active
                                        </button>

                                        <form id="active-form-{{ $hostel_allocation->allocation_id }}" 
                                              action="{{ route('backend.hostel_allocations.active', $hostel_allocation->allocation_id) }}" 
                                              method="POST" class="d-none">
                                            @csrf
                                        </form>

                                        <!-- Unactive Button -->
                                        <button type="button" 
                                                class="btn btn-sm btn-outline-warning rounded-3 unactive-btn d-flex align-items-center gap-1" 
                                                data-id="{{ $hostel_allocation->allocation_id }}"
                                                {{ $hostel_allocation->status != 'active' ? 'disabled' : '' }}
                                                title="Mark as Inactive">
                                            <i class="fa-solid fa-ban"></i> Unactive
                                        </button>

                                        <form id="unactive-form-{{ $hostel_allocation->allocation_id }}" 
                                              action="{{ route('backend.hostel_allocations.unactive', $hostel_allocation->allocation_id) }}" 
                                              method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-5 text-muted">
                                    <i class="fa-solid fa-folder-open fs-2 d-block mb-2 opacity-50"></i>
                                    <span>No hostel allocations found.</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <!-- Pagination Section -->
                @if(method_exists($hostel_allocations, 'hasPages') && $hostel_allocations->hasPages())
                    <div class="card-footer bg-white border-0 py-3 px-4">
                        {{ $hostel_allocations->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Active Confirmation Alert
        document.querySelectorAll('.active-btn').forEach(button => {
            button.addEventListener('click', function () {
                let id = this.getAttribute('data-id');
                
                Swal.fire({
                    title: 'သေချာပါသလား?',
                    text: "အခြေအနေအား Active သို့ ပြောင်းလဲရန် သေချာပါသလား?",
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
                        document.getElementById('active-form-' + id).submit();
                    }
                });
            });
        });

        // Unactive Confirmation Alert
        document.querySelectorAll('.unactive-btn').forEach(button => {
            button.addEventListener('click', function () {
                let id = this.getAttribute('data-id');

                Swal.fire({
                    title: 'သေချာပါသလား?',
                    text: "အခြေအနေအား Unactive သို့ ပြောင်းလဲရန် သေချာပါသလား?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ffc107',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'ပြောင်းလဲမည်',
                    cancelButtonText: 'မလုပ်တော့ပါ',
                    customClass: {
                        popup: 'rounded-4 shadow'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('unactive-form-' + id).submit();
                    }
                });
            });
        });
    });
</script>
@endsection