@extends('layouts.admin')
@section('content')
<style>
    /* Cursor မောက်စ်တင်လျှင် လက်ညှိုးပုံစံ ပေါ်စေရန် */
    .custom-hover-btn-success, 
    .custom-hover-btn-warning {
        cursor: pointer;
        transition: all 0.2s ease-in-out;
    }

    /* Active (အစိမ်းရောင်) Hover Effect */
    .custom-hover-btn-success:hover {
        background-color: #198754 !important;
        color: #ffffff !important;
        box-shadow: 0 4px 8px rgba(25, 135, 84, 0.25);
        transform: translateY(-1px);
    }

    /* Pending / Unactive (အဝါရောင်) Hover Effect */
    .custom-hover-btn-warning:hover {
        background-color: #ffc107 !important;
        color: #000000 !important;
        box-shadow: 0 4px 8px rgba(255, 193, 7, 0.35);
        transform: translateY(-1px);
    }
</style>
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <h2>Hostel Allocations </h2>
         <a href="{{ route('backend.hostel_allocations.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus me-1"></i> Add New
        </a>
    </div>
       <!-- Recent Activities Table -->
        <div class="card shadow-sm p-4 bg-white rounded">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Student</th>
                        <th>Year</th>
                        <th>Major</th>
                        <th>Room No</th>
                        <th>Hostel</th>
                        <th>Allocation Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($hostel_allocations as $hostel_allocation)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $hostel_allocation->payment->hostel_application->student_record->student->name ?? 'N/A' }}</td>
                            <td>{{ $hostel_allocation->payment->hostel_application->student_record->year->year_name ?? 'N/A' }}</td>
                            <td>{{ $hostel_allocation->payment->hostel_application->student_record->student->major->major_name ?? 'N/A' }}</td>
                            <td>{{ $hostel_allocation->room->room_no }}</td>
                            <td>{{ $hostel_allocation->room->hostel->hostel_name }}</td>
                            <td>{{ $hostel_allocation->allocation_date }}</td>
                            <td>
                                @if ($hostel_allocation->status == 'active')
                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">{{ $hostel_allocation->status ?? '-' }}</span>
                                @else
                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill">{{ $hostel_allocation->status }}</span>
                                @endif
                            </td>
                            <td>
                                <!-- Active Button Form -->
                                <button type="button" 
                                        class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-2 active-btn custom-hover-btn-success" 
                                        data-id="{{ $hostel_allocation->allocation_id }}">
                                    <i class="bi bi-check-lg me-1"></i> Active
                                </button>

                                <form id="active-form-{{ $hostel_allocation->allocation_id }}" 
                                    action="{{ route('backend.hostel_allocations.active', $hostel_allocation->allocation_id) }}" 
                                    method="POST" class="d-none">
                                    @csrf
                                </form>

                                <!-- Unactive Button Form -->
                                <button type="button" 
                                        class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle rounded-pill px-3 py-2 unactive-btn custom-hover-btn-warning" 
                                        data-id="{{ $hostel_allocation->allocation_id }}">
                                    <i class="bi bi-exclamation-circle me-1"></i> Unactive
                                </button>

                                <form id="unactive-form-{{ $hostel_allocation->allocation_id }}" 
                                    action="{{ route('backend.hostel_allocations.unactive', $hostel_allocation->allocation_id) }}" 
                                    method="POST" class="d-none">
                                    @csrf
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                    cancelButtonText: 'မလုပ်တော့ပါ'
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
                    cancelButtonText: 'မလုပ်တော့ပါ'
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