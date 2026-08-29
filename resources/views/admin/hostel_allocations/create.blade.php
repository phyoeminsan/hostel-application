@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-3">
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <h2>Create Hostel Allocation</h2>
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
    <div class="card shadow-sm p-4 bg-white rounded">
        <!-- Student ရွေးလိုက်လျှင် Page Refresh ဖြင့် Room ခေါ်ရန် GET Form သုံးထားပါသည် -->
        <form action="{{ route('backend.hostel_allocations.create') }}" method="GET" id="studentFilterForm" class="mb-3">
            <label class="form-label fw-bold">Select Student (Payment Approved)</label>
            <select name="payment_id" class="form-select" onchange="document.getElementById('studentFilterForm').submit();" required>
                <option value="" selected>-- Choose Student --</option>
                @foreach($payments as $payment)
                    <option value="{{ $payment->payment_id }}" {{ $selectedPaymentId == $payment->payment_id ? 'selected' : '' }}>
                        {{ $payment->hostel_application->student_record->student->name ?? 'N/A' }} 
                        ({{ $payment->hostel_application->hostel->hostel_name ?? 'Hostel' }})
                    </option>
                @endforeach
            </select>
        </form>

        <!-- Save Allocation Form -->
        <form action="{{ route('backend.hostel_allocations.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="payment_id" value="{{ $selectedPaymentId }}">

            <!-- Room Select (ရွေးထားသော Student ၏ Hostel Room များသာ ထွက်လာပါမည်) -->
           <div class="mb-3">
                <label class="form-label fw-bold">Select Room</label>
                <select name="room_id" class="form-select @error('room_id') is-invalid @elseif(old('room_id')) is-valid @enderror" {{ $rooms->isEmpty() ? 'disabled' : '' }}>
                    @if($rooms->isEmpty())
                        <option value="" {{ old('room_id') ? '' : 'selected' }}>-- Please Select Student First --</option>
                    @else
                        <option value="" selected>-- Choose Room --</option>
                        @foreach($rooms as $room)
                            @php
                                // status == 'Full' ဖြစ်နေလျှင် သို့မဟုတ် အခန်းလူပြည့်နေလျှင် Full ဟု သတ်မှတ်မည်
                                $isFull = ($room->status === 'Full') || ($room->hostel_allocations_count >= $room->no_of_person);
                            @endphp

                            <option value="{{ $room->room_id }}"
                                {{ old('room_id') == $room->room_id ? 'selected' : '' }}
                                {{ $isFull ? 'disabled' : '' }}>
                                Room {{ $room->room_no }} {{ $isFull ? '(Full)' : '(Available)' }}
                            </option>
                        @endforeach
                    @endif
                </select>
                @error('room_id') 
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Start Date</label>
                    <input type="date" name="allocation_date" class="form-control @error('allocation_date') is-invalid @elseif(old('allocation_date')) is-valid @enderror" value="{{ old('allocation_date') }}">
                    @error('allocation_date')
                        <div class="invalid-feedback text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Status</label>
                    <select name="status" id="status" class="form-select bg-light @error('status') is-invalid @elseif(old('status')) is-valid @enderror">
                        <option value="">Choose Status</option>
                        <option value="active" {{ old('status') == 'active' ? 'selected' : ''}}>active</option>
                        <option value="unactive" {{ old('status') == 'unactive' ? 'selected' : ''}}>unactive</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label fw-bold">Description</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @elseif(old('description')) is-valid
                    @enderror" id="description">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback text-danger small">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mt-4 text-end">
                <a href="{{ route('backend.hostel_allocations') }}" class="btn btn-outline-danger">
                    မလုပ်တော့ပါ
                </a>
                <button type="submit" class="btn btn-primary" {{ !$selectedPaymentId ? 'disabled' : '' }}>
                    နေရာချထားမှု သိမ်းဆည်းမည်
                </button>
            </div>
        </form>
    </div>
</div>
@endsection