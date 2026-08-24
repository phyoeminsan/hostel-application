@extends('layouts.admin')
@section('content')
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
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <h2>Student Management</h2>
        <a href="{{ route('backend.students.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus me-1"></i> Add New
        </a>
    </div>

    <div class="card shadow-sm p-4 bg-white rounded">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Roll No</th>
                    <th>Name</th>
                    <th>Major</th>
                    <th>Gender</th>
                    <th>NRC</th>
                    <th>Phone</th>
                    <th style="white-space: nowrap; width: 130px">Date Of Brith</th>
                    <th>Phone No</th>
                    <th>Address</th>
                    <th>Profile</th>
                    <th style="width: 180px;">Email</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $student->roll_no }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->major->major_name }}</td>
                        <td>{{ $student->gender }}</td>
                        <td>{{ $student->nrc }}</td>
                        <td>{{ $student->phone_no }}</td>
                        <td style="white-space: nowrap;">{{ $student->date_of_birth }}</td>
                        <td>{{ $student->phone_no }}</td>
                        <td>{{ $student->address }}</td>
                        <td><img src="{{ $student->profile }}" alt="" width="40" height="40"></td>
                        <td>{{ $student->email }}</td>
                        <td class="text-end">
                            <a href="{{ route('backend.students.edit', $student->student_id) }}" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-edit"></i></a>
                            <button class="btn btn-sm btn-outline-danger delete" data-id="{{ $student->student_id }}"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $students->links() }}
    </div>

    <!-- Hidden Delete Form -->
    <form id="deleteForm" action="" method="POST" class="d-none">
        @csrf
        @method('DELETE')
    </form>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
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
                cancelButtonText: 'မဖျက်တော့ပါ'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#deleteForm').attr('action', url).submit();
                }
            });
        });
    });
</script>
@endsection

  