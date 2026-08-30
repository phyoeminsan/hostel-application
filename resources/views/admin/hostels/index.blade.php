@extends('layouts.admin')

@section('content')
<!-- Top Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-dark mb-0">Hostels</h2>
    <a href="{{ route('backend.hostels.create') }}" class="btn btn-primary rounded-pill px-4 py-2 shadow-sm fw-medium">
        <i class="fa-solid fa-plus me-1"></i> Add New Hostel
    </a>
</div>

<!-- Main List Card -->
<div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
    <!-- Card Inner Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
            <i class="fa-solid fa-hotel text-primary fs-4 me-2"></i>
            <h5 class="fw-bold mb-0 text-dark">Hostel Lists</h5>
        </div>
        <span class="badge bg-light text-secondary border px-3 py-2 rounded-3 fw-normal">
            Total Records: {{ $hostels->total() ?? count($hostels) }}
        </span>
    </div>

    <!-- Data Table -->
    <div class="table-responsive">
        <table class="table table-borderless table-hover align-middle mb-0">
            <thead class="text-muted border-bottom text-uppercase fs-7">
                <tr>
                    <th class="pb-3" style="width: 60px;">NO</th>
                    <th class="pb-3">HOSTEL NAME</th>
                    <th class="pb-3">PHOTO</th>
                    <th class="pb-3">CAPACITY</th>
                    <th class="pb-3 text-center" style="width: 140px;">GENDER</th>
                    <th class="pb-3 text-end" style="width: 120px;">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @forelse ($hostels as $hostel)
                    <tr class="border-bottom-soft">
                        <td class="py-3 text-secondary">{{ $i++ }}</td>
                        <td class="py-3 fw-bold text-dark">
                            {{ $hostel->hostel_name }}
                        </td>
                        <td class="py-3">
                            <img src="{{ $hostel->image }}" alt="{{ $hostel->hostel_name }}" 
                                 class="rounded-3 border shadow-sm object-fit-cover" 
                                 width="45" height="45">
                        </td>
                        <td class="py-3 text-secondary fw-semibold">
                            <i class="fa-solid fa-users me-1 text-muted small"></i> {{ $hostel->capacity }}
                        </td>
                        <td class="py-3 text-center">
                            @if (strtolower($hostel->gender) == 'male' || $hostel->gender == 'ကျား')
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3 py-1 fw-medium">
                                    <i class="fa-solid fa-mars me-1"></i> Male
                                </span>
                            @elseif(strtolower($hostel->gender) == 'female' || $hostel->gender == 'မ')
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-3 py-1 fw-medium">
                                    <i class="fa-solid fa-venus me-1"></i> Female
                                </span>
                            @else
                                <span class="badge bg-light text-secondary border rounded-pill px-3 py-1 fw-medium">
                                    {{ $hostel->gender }}
                                </span>
                            @endif
                        </td>
                        <td class="py-3 text-end">
                            <a href="{{ route('backend.hostels.edit', $hostel->hostel_id) }}" 
                               class="btn btn-sm btn-light text-secondary border me-1 rounded-2">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <button class="btn btn-sm btn-light text-danger border delete rounded-2" 
                                    data-id="{{ $hostel->hostel_id }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="fa-solid fa-folder-open fs-3 d-block mb-2"></i>
                            No Hostels Found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4 d-flex justify-content-end">
        {{ $hostels->links() }}
    </div>
</div>

<!-- Hidden Delete Form -->
<form id="deleteForm" action="" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>

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
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {

        // Delete Logic
        $('tbody').on('click', '.delete', function(e) {
            e.preventDefault();
            
            let id = $(this).data('id');
            let url = '/backend/hostels/' + id;

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