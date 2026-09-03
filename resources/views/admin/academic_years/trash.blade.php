@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-3">

    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Academic Years Trash</h3>
            <p class="text-muted small mb-0">ဖျက်ထားသော ပညာသင်နှစ် အချက်အလက်များ</p>
        </div>
        <a href="{{ route('backend.academic_years.index') }}" class="btn btn-outline-secondary px-3 py-2 rounded-pill fw-semibold shadow-sm">
            <i class="fa-solid fa-arrow-left me-1"></i> Back to List
        </a>
    </div>

    <!-- Table Card Container -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-white py-3 px-4 border-0 d-flex align-items-center justify-content-between">
            <h5 class="fw-bold mb-0 text-dark">
                <i class="fa-solid fa-trash-can me-2 text-danger"></i>Trashed List
            </h5>
            <span class="badge bg-light text-muted fw-normal border">Total Trashed: {{ $academic_years->total() }}</span>
        </div>

        <div class="table-responsive">
            <table class="table table-borderless table-hover align-middle mb-0">
                <thead class="bg-light border-bottom text-muted small text-uppercase">
                    <tr>
                        <th class="ps-4 py-3" style="width: 80px;">No</th>
                        <th class="py-3">Academic Year</th>
                        <th class="py-3">Deleted At</th>
                        <th class="pe-4 py-3 text-end" style="width: 180px;">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($academic_years as $index => $academic_year)
                        <tr class="border-bottom-faint">
                            <td class="ps-4 py-3 text-muted fw-semibold">
                                {{ $academic_years->firstItem() ? $academic_years->firstItem() + $index : $index + 1 }}
                            </td>
                            <td class="py-3">
                                <span class="fw-bold text-dark fs-6">{{ $academic_year->academic_year }}</span>
                            </td>
                            <td class="py-3 text-muted small">
                                {{ $academic_year->deleted_at->format('Y-m-d H:i A') }}
                            </td>
                            <td class="pe-4 py-3 text-end">
                                <div class="btn-group gap-1">
                                    <!-- Restore Button -->
                                    <form action="{{ route('backend.academic_years.restore', $academic_year->academic_year_id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-light border text-success rounded-2 px-2 py-1 shadow-sm" title="Restore">
                                            <i class="fa-solid fa-rotate-left me-1"></i> ပြန်ဖော်မည်
                                        </button>
                                    </form>

                                    <!-- Force Delete Button -->
                                    <button class="btn btn-sm btn-light border text-danger rounded-2 px-2 py-1 shadow-sm force-delete" 
                                            data-id="{{ $academic_year->academic_year_id }}" 
                                            title="Permanently Delete">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                <i class="fa-regular fa-folder-open fs-2 d-block mb-2 opacity-50"></i>
                                အမှိုက်ပုံးထဲတွင် မည်သည့် အချက်အလက်မျှ မရှိပါ။
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($academic_years->hasPages())
            <div class="card-footer bg-white border-0 py-3 px-4">
                {{ $academic_years->links() }}
            </div>
        @endif
    </div>

    <!-- Hidden Force Delete Form -->
    <form id="forceDeleteForm" action="" method="POST" class="d-none">
        @csrf
        @method('DELETE')
    </form>
</div>
@endsection

@section('script')
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'အောင်မြင်ပါသည်။',
        text: "{{ session('success') }}",
        confirmButtonText: 'လက်ခံသည်',
        confirmButtonColor: '#0d6efd',
        customClass: { popup: 'rounded-4' }
    });
</script>
@endif

<script>
    $(document).ready(function() {
        // Force Delete Confirmation Modal
        $('tbody').on('click', '.force-delete', function(e) {
            e.preventDefault();
            
            let id = $(this).data('id');
            let url = '{{ route("backend.academic_years.forceDelete", ":id") }}'.replace(':id', id);

            Swal.fire({
                title: 'အပြီးတိုင် ဖျက်မှာ သေချာပါသလား?',
                text: 'ဤအချက်အလက်ကို ဖျက်လိုက်ပါက ပြန်လည်ရယူနိုင်တော့မည် မဟုတ်ပါ။',
                icon: 'warning',
                showCancelButton: true,
                reverseButtons: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'အပြီးဖျက်မည်',
                cancelButtonText: 'မဖျက်တော့ပါ',
                customClass: { popup: 'rounded-4' }
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#forceDeleteForm').attr('action', url).submit();
                }
            });
        });
    });
</script>
@endsection