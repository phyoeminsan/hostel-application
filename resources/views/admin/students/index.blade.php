@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-3">
    @if(session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                title: "အောင်မြင်ပါသည်။",
                text: "{{ session('success') }}",
                icon: "success",
                confirmButtonText: "လက်ခံသည်",
                confirmButtonColor: "#0d6efd"
            });
        </script>
    @endif
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Student Management</h3>
        </div>
        <a href="{{ route('backend.students.create') }}" class="btn btn-primary px-3 py-2 rounded-pill fw-semibold shadow-sm">
            <i class="fa-solid fa-plus me-1"></i> Add New Student
        </a>
    </div>

    <!-- Main Table Card Container -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        
        <!-- Table Header Banner -->
        <div class="card-header bg-white py-3 px-4 border-0 d-flex align-items-center justify-content-between">
            <h5 class="fw-bold mb-0 text-dark">
                <i class="fa-solid fa-users me-2 text-primary"></i>Student List
            </h5>
            <span class="badge bg-light text-muted fw-normal border">
                Total Students: {{ method_exists($students, 'total') ? $students->total() : count($students) }}
            </span>
        </div>

        <!-- Table Responsive Container -->
        <div class="table-responsive">
            <table class="table table-borderless table-hover align-middle mb-0">
                <thead class="bg-light border-bottom text-muted small text-uppercase">
                    <tr>
                        <th class="ps-4 py-3 text-center" style="width: 60px;">No</th>
                        <th class="py-3 text-center" style="width: 80px;">Profile</th>
                        <th class="py-3">Roll No</th>
                        <th class="py-3">Name</th>
                        <th class="py-3">Major</th>
                        <th class="py-3 text-center">Gender</th>
                        <th class="py-3">NRC</th>
                        <th class="py-3">Phone</th>
                        <th class="py-3 text-center" style="white-space: nowrap;">DATE OF BIRTH</th>
                        <th class="py-3">Email</th>
                        <th class="py-3">Address</th>
                        <th class="pe-4 py-3 text-end" style="width: 120px;">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($students as $index => $student)
                        <tr class="border-bottom-faint">
                            <!-- Serial No -->
                            <td class="ps-4 py-3 text-center text-muted fw-semibold">
                                {{ method_exists($students, 'firstItem') && $students->firstItem() ? $students->firstItem() + $index : $index + 1 }}
                            </td>
                            
                            <!-- Profile Thumbnail -->
                            <td class="py-3 text-center">
                                @if($student->profile)
                                    <img src="{{ asset($student->profile) }}" alt="{{ $student->name }}" class="rounded-circle border shadow-sm object-fit-cover" width="40" height="40">
                                @else
                                    <div class="rounded-circle bg-light border d-inline-flex align-items-center justify-content-center text-secondary shadow-sm" style="width: 40px; height: 40px;">
                                        <i class="fa-solid fa-user"></i>
                                    </div>
                                @endif
                            </td>

                            <!-- Roll No -->
                            <td class="py-3">
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2.5 py-1 fw-semibold">
                                    {{ $student->roll_no }}
                                </span>
                            </td>

                            <!-- Name -->
                            <td class="py-3">
                                <span class="fw-bold text-dark fs-6">{{ $student->name }}</span>
                            </td>

                            <!-- Major -->
                            <td class="py-3 text-secondary small">
                                <i class="fa-solid fa-graduation-cap me-1 text-muted opacity-50"></i>{{ $student->major->major_name ?? 'N/A' }}
                            </td>

                            <!-- Gender -->
                            <td class="py-3 text-center">
                                @if(strtolower($student->gender) == 'male')
                                    <span class="badge bg-info-subtle text-info border border-info-subtle rounded-pill px-2 py-1">
                                        <i class="fa-solid fa-mars me-1"></i>Male
                                    </span>
                                @elseif(strtolower($student->gender) == 'female')
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-2 py-1">
                                        <i class="fa-solid fa-venus me-1"></i>Female
                                    </span>
                                @else
                                    <span class="text-muted small">{{ $student->gender }}</span>
                                @endif
                            </td>

                            <!-- NRC -->
                            <td class="py-3 text-secondary small">{{ $student->nrc }}</td>

                            <!-- Phone -->
                            <td class="py-3 text-secondary small" style="white-space: nowrap;">
                                <i class="fa-solid fa-phone me-1 text-muted opacity-50"></i>{{ $student->phone_no }}
                            </td>

                            <!-- DOB -->
                            <td class="py-3 text-center text-secondary small" style="white-space: nowrap;">
                                {{ $student->date_of_birth }}
                            </td>

                            <!-- Email -->
                            <td class="py-3 text-secondary small">
                                <i class="fa-regular fa-envelope me-1 text-muted opacity-50"></i>{{ $student->email }}
                            </td>

                            <!-- Address -->
                            <td class="py-3 text-secondary small text-truncate" style="max-width: 150px;" title="{{ $student->address }}">
                                <i class="fa-solid fa-location-dot me-1 text-danger opacity-75"></i>
                                {{ $student->address }}
                            </td>

                            <!-- Actions -->
                            <td class="pe-4 py-3 text-end">
                                <div class="btn-group gap-1">
                                    <a href="{{ route('backend.students.edit', $student->student_id) }}" 
                                       class="btn btn-sm btn-light border text-secondary rounded-2 px-2 py-1 shadow-sm" 
                                       title="Edit Student">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <button class="btn btn-sm btn-light border text-danger rounded-2 px-2 py-1 shadow-sm delete" 
                                            data-id="{{ $student->student_id }}" 
                                            title="Delete Student">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" class="text-center py-5 text-muted">
                                <i class="fa-regular fa-folder-open fs-2 d-block mb-2 opacity-50"></i>
                                No student records found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Section -->
        @if(method_exists($students, 'hasPages') && $students->hasPages())
            <div class="card-footer bg-white border-0 py-3 px-4">
                {{ $students->links() }}
            </div>
        @endif
    </div>

    <!-- Hidden Delete Form -->
    <form id="deleteForm" action="" method="POST" class="d-none">
        @csrf
        @method('DELETE')
    </form>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {

        // SweetAlert Delete Modal Handler
        $('tbody').on('click', '.delete', function(e) {
            e.preventDefault();
            
            let id = $(this).data('id');
            let url = '/backend/students/' + id;

            Swal.fire({
                title: 'သေချာပါသလား?',
                text: 'ဤအချက်အလက်ကို ဖျက်လိုက်ပါက ပြန်လည်ရယူနိုင်တော့မည် မဟုတ်ပါ။',
                icon: 'warning',
                showCancelButton: true,
                reverseButtons: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'ဖျက်မည်',
                cancelButtonText: 'မဖျက်တော့ပါ',
                customClass: {
                    popup: 'rounded-4'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#deleteForm').attr('action', url).submit();
                }
            });
        });
    });
</script>
@endsectionဖ