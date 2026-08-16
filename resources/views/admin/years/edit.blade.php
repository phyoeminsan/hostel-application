@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <h2 class="fw-bold text-dark mb-0">Detail</h2>
    </div>

    <div id="step-student-info" class="step-section active">
        <div class="card shadow-sm p-4 bg-white rounded">
            <div class="d-flex align-items-center p-3 mb-4 bg-warning-subtle rounded-3 border-start border-4 border-warning shadow-sm">
                <div class="bg-warning text-white rounded-3 p-3 d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 48px; height: 48px;">
                    <i class="fa-solid fa-calendar-check fs-5"></i>
                </div>
                <div>
                    <h5 class="fw-bold text-dark mb-1">Edit Year</h5>
                    <small class="text-secondary">Update the required session details below to save changes to this record.</small>
                </div>
            </div>
            @if ($errors->any())
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    Swal.fire({
                        icon: 'warning',
                        title: 'အချက်အလက် မပြည့်စုံပါ!',
                        text: 'ကျေးဇူးပြု၍ လိုအပ်သော အချက်အလက်များကို ပြည့်စုံစွာ ဖြည့်သွင်းပေးပါ။',
                        confirmButtonText: 'လက်ခံသည်',
                        confirmButtonColor: '#0d6efd'
                    });
                </script>
            @endif
            <form action="{{ route('backend.years.update', $year->year_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="col-12">
                    <label class="form-label fw-bold">Year Name</label>
                    <input type="text" name="year_name" id="year_name" class="form-control @error('year_name') is-invalid @elseif(old('academic_year')) is-valid @enderror" value="{{ $year->year_name}}">
                    @error('year_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-4 text-end">
                    <a href="{{ route('backend.years.index') }}" class="btn btn-outline-danger me-2">မလုပ်တော့ပါ</a>
                    <button type="submit" class="btn btn-primary px-4">
                        ပြင်ဆင်ချက်များ သိမ်းမည်
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection