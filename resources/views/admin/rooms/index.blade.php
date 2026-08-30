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

    <div class="container-fluid px-4 py-4">
        <!-- Top Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-dark mb-0">Room Management</h3>
            <a href="{{ route('backend.rooms.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm fw-semibold">
                <i class="fa-solid fa-plus me-1"></i> Add New Room
            </a>
        </div>

        <!-- Main Card Section -->
        <div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
            <div class="card-body p-4">
                
                <!-- Inner Card Title & Total Count -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="d-flex align-items-center">
                        <i class="fa-solid fa-bed text-primary fs-5 me-2"></i>
                        <h5 class="fw-bold text-dark mb-0">Room List</h5>
                    </div>
                    <span class="badge bg-light text-secondary border px-3 py-2 rounded-3 fw-normal">
                        Total Rooms: {{ count($rooms) }}
                    </span>
                </div>

                <!-- Table View -->
                <div class="table-responsive">
                    <table class="table table-borderless table-hover align-middle mb-0">
                        <thead>
                            <tr class="text-secondary text-uppercase fs-7 border-bottom fw-bold" style="letter-spacing: 0.5px;">
                                <th class="py-3 ps-3 border-0">NO</th>
                                <th class="py-3 border-0">ROOM NO</th>
                                <th class="py-3 border-0">FLOOR NO</th>
                                <th class="py-3 border-0">CAPACITY</th>
                                <th class="py-3 border-0">STATUS</th>
                                <th class="py-3 border-0">HOSTEL</th>
                                <th class="py-3 pe-3 text-end border-0">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody class="border-top-0">
                            @foreach ($rooms as $index => $room)
                                <tr class="border-bottom-0">
                                    <td class="ps-3 text-secondary fw-medium">{{ $loop->iteration }}</td>
                                    
                                    <!-- Room No Badge -->
                                    <td>
                                        <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2 fw-semibold fs-7">
                                            ROOM-{{ $room->room_no }}
                                        </span>
                                    </td>
                                    
                                    <td class="fw-bold text-dark">{{ $room->floor_no }}</td>
                                    
                                    <!-- Capacity with Icon -->
                                    <td class="text-secondary">
                                        <i class="fa-solid fa-users me-1 opacity-50"></i> {{ $room->no_of_person }} Persons
                                    </td>
                                    
                                    <!-- Status Pill -->
                                    <td>
                                        @if(strtolower($room->status) == 'available' || strtolower($room->status) == 'active')
                                            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2 fw-medium">
                                                <i class="fa-solid fa-circle-check fs-8 me-1 text-success"></i> {{ $room->status }}
                                            </span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger rounded-pill px-3 py-2 fw-medium">
                                                <i class="fa-solid fa-circle-xmark fs-8 me-1 text-danger"></i> {{ $room->status }}
                                            </span>
                                        @endif
                                    </td>
                                    
                                    <!-- Hostel Name -->
                                    <td class="text-secondary fw-medium">
                                        <i class="fa-solid fa-hotel me-1 opacity-50"></i> {{ $room->hostel->hostel_name }}
                                    </td>
                                    
                                    <!-- Action Buttons -->
                                    <td class="pe-3 text-end">
                                        <a href="{{ route('backend.rooms.edit', $room->room_id) }}" class="btn btn-light text-secondary btn-sm rounded-3 me-1 shadow-sm px-2">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <button class="btn btn-light text-danger btn-sm rounded-3 shadow-sm delete px-2" data-id="{{ $room->room_id }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Section -->
                <div class="mt-4 d-flex justify-content-left">
                    {{ $rooms->links() }}
                </div>

            </div>
        </div>
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