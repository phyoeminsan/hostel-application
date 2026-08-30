@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-3">

    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Years</h3>
        </div>
        <a href="{{ route('backend.years.create') }}" class="btn btn-primary px-3 py-2 rounded-pill fw-semibold shadow-sm">
            <i class="fa-solid fa-plus me-1"></i> Add New Year
        </a>
    </div>

    <!-- Table Card Container -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-white py-3 px-4 border-0 d-flex align-items-center justify-content-between">
            <h5 class="fw-bold mb-0 text-dark">
                <i class="fa-solid fa-calendar-check me-2 text-primary"></i>Years List
            </h5>
            <span class="badge bg-light text-muted fw-normal border">
                Total Records: {{ method_exists($years, 'total') ? $years->total() : count($years) }}
            </span>
        </div>

        <div class="table-responsive">
            <table class="table table-borderless table-hover align-middle mb-0">
                <thead class="bg-light border-bottom text-muted small text-uppercase">
                    <tr>
                        <th class="ps-4 py-3" style="width: 80px;">No</th>
                        <th class="py-3">Year Name</th>
                        <th class="pe-4 py-3 text-end" style="width: 150px;">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($years as $index => $year)
                        <tr class="border-bottom-faint">
                            <td class="ps-4 py-3 text-muted fw-semibold">
                                {{ method_exists($years, 'firstItem') && $years->firstItem() ? $years->firstItem() + $index : $index + 1 }}
                            </td>
                            <td class="py-3">
                                <span class="fw-bold text-dark fs-6">{{ $year->year_name }}</span>
                            </td>
                            <td class="pe-4 py-3 text-end">
                                <div class="btn-group gap-1">
                                    <a href="{{ route('backend.years.edit', $year->year_id) }}" 
                                       class="btn btn-sm btn-light border text-secondary rounded-2 px-2 py-1 shadow-sm" 
                                       title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <button class="btn btn-sm btn-light border text-danger rounded-2 px-2 py-1 shadow-sm delete" 
                                            data-id="{{ $year->year_id }}" 
                                            title="Delete">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-5 text-muted">
                                <i class="fa-regular fa-folder-open fs-2 d-block mb-2 opacity-50"></i>
                                No year records found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(method_exists($years, 'hasPages') && $years->hasPages())
            <div class="card-footer bg-white border-0 py-3 px-4">
                {{ $years->links() }}
            </div>
        @endif
    </div>

    <!-- Hidden Delete Form -->
    <form id="deleteForm" action="" method="POST" class="d-none">
        @csrf
        @method('DELETE')
    </form>

    @if (session('success'))
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
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {

        // Delete Confirmation Modal
        $('tbody').on('click', '.delete', function(e) {
            e.preventDefault();
            
            let id = $(this).data('id');
            let url = '{{ route("backend.years.destroy", ":id") }}'.replace(':id', id);

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
@endsection