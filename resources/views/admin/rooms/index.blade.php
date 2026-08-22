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
        <h2>Room Management</h2>
        <a href="{{ route('backend.rooms.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus me-1"></i> Add New
        </a>
    </div>

    <div class="card shadow-sm p-4 bg-white rounded">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Room No</th>
                    <th>Floor No</th>
                    <th>No Of Person</th>
                    <th>Status</th>
                    <th>Hostel</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($rooms as $room)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $room->room_no }}</td>
                        <td>{{ $room->floor_no }}</td>
                        <td>{{ $room->no_of_person }}</td>
                        <td>{{ $room->status }}</td>
                        <td>{{ $room->hostel->hostel_name }}</td>
                        <td class="text-end">
                            <a href="{{ route('backend.rooms.edit', $room->room_id) }}" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-edit"></i></a>
                            <button class="btn btn-sm btn-outline-danger delete" data-id="{{ $room->room_id }}"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $rooms->links() }}
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
            let url = '/backend/rooms/' + id;

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