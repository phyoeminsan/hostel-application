@extends('layouts.admin')

@section('content')
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if ($errors->any())
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'အချက်အလက် မပြည့်စုံပါ!',
            text: 'ကျေးဇူးပြု၍ လိုအပ်သော အချက်အလက်များကို ပြည့်စုံစွာ ဖြည့်သွင်းပေးပါ။',
            confirmButtonText: 'လက်ခံသည်',
            confirmButtonColor: '#0d6efd',
            customClass: {
                popup: 'rounded-4 shadow'
            }
        });
    </script>
@endif

<div class="container-fluid py-4">
    <!-- Page Header with Back Button -->
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('backend.hostel_allocations') }}" class="btn btn-outline-secondary btn-sm rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div>
                <h4 class="fw-bold text-dark mb-0">Create Hostel Allocation</h4>
                <p class="text-muted small mb-0">Assign room allocations to approved student payments.</p>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
                <div class="card-header bg-light border-bottom py-3 px-4">
                    <h6 class="mb-0 fw-bold text-dark d-flex align-items-center">
                        <i class="fa-solid fa-bed text-primary me-2"></i> Allocation Form
                    </h6>
                </div>

                <div class="card-body p-4">
                    <!-- Step 1: Filter Student Form -->
                    <form action="{{ route('backend.hostel_allocations.create') }}" method="GET" id="studentFilterForm" class="mb-4">
                        <div class="mb-2">
                            <label class="form-label fw-semibold text-dark small">
                                Select Student (Payment Approved) <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted border-end-0">
                                    <i class="fa-solid fa-user-graduate"></i>
                                </span>
                                <select name="payment_id" class="form-select border-start-0 ps-0" onchange="document.getElementById('studentFilterForm').submit();">
                                    <option value="" selected> Choose Student </option>
                                    @foreach($payments as $payment)
                                        <option value="{{ $payment->payment_id }}" {{ $selectedPaymentId == $payment->payment_id ? 'selected' : '' }}>
                                            {{ $payment->hostel_application->student_record->student->name ?? 'N/A' }} 
                                            ({{ $payment->hostel_application->hostel->hostel_name ?? 'Hostel' }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <small class="text-muted fs-7">ကျောင်းသားကို စတင် ရွေးချယ်ပြီးပါက သက်ဆိုင်ရာ Hostel အခန်းများ ပေါ်လာမည်ဖြစ်ပါသည်။</small>
                        </div>
                    </form>

                    <hr class="my-4 text-muted opacity-25">

                    <!-- Step 2: Save Allocation Form -->
                    <form action="{{ route('backend.hostel_allocations.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="payment_id" value="{{ $selectedPaymentId }}">

                        <!-- Room Select -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-dark small">
                                Select Room <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted border-end-0">
                                    <i class="fa-solid fa-door-open"></i>
                                </span>
                                <select name="room_id" class="form-select border-start-0 ps-0 @error('room_id') is-invalid @elseif(old('room_id')) is-valid @enderror" {{ $rooms->isEmpty() ? 'disabled' : '' }}>
                                    @if($rooms->isEmpty())
                                        <option value="" {{ old('room_id') ? '' : 'selected' }}> Please Select Student First </option>
                                    @else
                                        <option value="" selected> Choose Room </option>
                                        @foreach($rooms as $room)
                                            @php
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
                        </div>

                        <div class="row g-3">
                            <!-- Start Date -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold text-dark small">
                                    Allocation Start Date <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted border-end-0">
                                        <i class="fa-regular fa-calendar-days"></i>
                                    </span>
                                    <input type="date" name="allocation_date" class="form-control border-start-0 ps-0 @error('allocation_date') is-invalid @elseif(old('allocation_date')) is-valid @enderror" value="{{ old('allocation_date', date('Y-m-d')) }}">
                                    @error('allocation_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold text-dark small">
                                    Status <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted border-end-0">
                                        <i class="fa-solid fa-toggle-on"></i>
                                    </span>
                                    <select name="status" id="status" class="form-select border-start-0 ps-0 @error('status') is-invalid @elseif(old('status')) is-valid @enderror">
                                        <option value="">Choose Status</option>
                                        <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : ''}}>active</option>
                                        <option value="unactive" {{ old('status') == 'unactive' ? 'selected' : ''}}>unactive</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="col-12 mb-3">
                                <label class="form-label fw-semibold text-dark small">Description / Remark</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @elseif(old('description')) is-valid @enderror" rows="3" placeholder="စည်းကမ်းချက်များ ...">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                            <a href="{{ route('backend.hostel_allocations') }}" class="btn btn-outline-danger px-4 fw-semibold rounded-3">
                                မလုပ်တော့ပါ
                            </a>
                            <button type="submit" class="btn btn-primary px-4 fw-semibold rounded-3 shadow-sm" {{ !$selectedPaymentId ? 'disabled' : '' }}>
                                <i class="fa-solid fa-check fs-8 me-1 text-light"></i> နေရာချထားမှု သိမ်းဆည်းမည်
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection