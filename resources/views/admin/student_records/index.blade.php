@extends('layouts.admin')

@section('content')
<!-- Top Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-dark mb-0">Student Records</h2>
    <a href="{{ route('backend.student_records.create') }}" class="btn btn-primary rounded-pill px-3 py-2 shadow-sm">
        <i class="fa-solid fa-plus me-1"></i> Add New Record
    </a>
</div>
<!-- Table အပေါ်၊ Arrow ထိုးထားသော နေရာတွင် Search Input ထည့်ရန် -->
<div class="d-flex justify-content-end mb-3">
    <input type="text" id="searchInput" class="form-control w-25" placeholder="Search by name or major..." onkeyup="filterTable()">
</div>

<!-- Main List Card -->
<div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
    <!-- Card Inner Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
            <i class="fa-solid fa-file-signature text-primary fs-4 me-2"></i>
            <h5 class="fw-bold mb-0 text-dark">Student Record List</h5>
        </div>
        <span class="badge bg-light text-secondary border px-3 py-2 rounded-3 fw-normal">
            Total Records: {{ $student_records->total() ?? count($student_records) }}
        </span>
    </div>

    <!-- Data Table -->
    <div class="table-responsive">
        <table class="table table-borderless align-middle mb-0">
            <thead class="text-muted border-bottom text-uppercase fs-7">
                <tr>
                    <th class="pb-3" style="width: 60px;">NO</th>
                    <th class="pb-3">ACADEMIC YEAR</th>
                    <th class="pb-3">YEAR</th>
                    <th class="pb-3">STUDENT</th>
                    <th class="pb-3">MAJOR</th>
                    <th class="pb-3 text-end" style="width: 100px;">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @forelse ($student_records as $student_record)
                    <tr class="border-bottom-soft">
                        <td class="py-3 text-secondary">{{ $i++ }}</td>
                        <td class="py-3 fw-semibold text-dark">
                            {{ $student_record->academic_year->academic_year }}
                             @if ($student_record->academic_year->status == 'Current')
                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1fw-medium">
                                    <i class="fa-solid fa-check me-1"></i> Current
                                </span>
                            @else
                                <span class="badge bg-light text-secondary border rounded-pill px-3 py-1 fw-medium">
                                    <i class="fa-solid fa-rotate-left me-1"></i> Old
                                </span>
                            @endif
                        </td>
                        <td class="py-3">
                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2.5 py-1 fw-semibold">
                                {{ $student_record->year->year_name }}
                            </span>
                        </td>
                        <td class="py-3 fw-semibold text-dark">
                            <i class="fa-solid fa-user me-1 text-primary"></i>
                            {{ $student_record->student->name }}
                        </td>
                        <td class="py-3 text-secondary small">
                            <i class="fa-solid fa-graduation-cap me-1 text-muted opacity-50"></i>{{ $student_record->student->major->major_name ?? 'N/A' }}
                        </td>
                        <td class="py-3 text-end">
                            <a href="{{ route('backend.student_records.edit', $student_record->record_id) }}" 
                               class="btn btn-sm btn-light text-secondary border me-1 rounded-2">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <button class="btn btn-sm btn-light text-danger border delete rounded-2" 
                                    data-id="{{ $student_record->record_id }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="fa-solid fa-folder-open fs-3 d-block mb-2"></i>
                            No Student Records Found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="card-footer bg-white border-0 py-3 px-4">
        {{ $student_records->links() }}
    </div>
</div>

<!-- Hidden Delete Form -->
<form id="deleteForm" action="" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('success'))
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
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {

        // Delete Logic
        $('tbody').on('click', '.delete', function(e) {
            e.preventDefault();
            
            let id = $(this).data('id');
            let url = '/backend/student_records/' + id;

            Swal.fire({
                title: 'သေချာပါသလား?',
                text: 'ဤအချက်အလက်ကို ဖျက်လိုက်ပါက ပြန်လည်ရယူနိုင်တော့မည် မဟုတ်ပါ။',
                icon: 'warning',
                showCancelButton: true,
                reverseButtons: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'ဖျက်မည်',
                cancelButtonText: 'မဖျက်တော့ပါ'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#deleteForm').attr('action', url).submit();
                }
            });
        });
    });

    function filterTable() {
        let input = document.getElementById("searchInput").value.toLowerCase();
        let table = document.querySelector("table"); // သင့် table ရဲ့ tag သို့မဟုတ် class/id
        let rows = table.getElementsByTagName("tr");

        // Table Header ကို ချန်ပြီး Data Rows များကို စစ်ဆေးမည်
        for (let i = 1; i < rows.length; i++) {
            let studentName = rows[i].getElementsByTagName("td")[3]?.textContent || ""; // 4 ခုမြောက် Column (STUDENT)
            let major = rows[i].getElementsByTagName("td")[4]?.textContent || "";       // 5 ခုမြောက် Column (MAJOR)

            if (studentName.toLowerCase().includes(input) || major.toLowerCase().includes(input)) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    }
</script>
@endsection