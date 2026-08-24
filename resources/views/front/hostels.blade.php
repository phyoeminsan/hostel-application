@extends('layouts.front')
@section('content')
    <div class="container mt-3">
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
     <!-- Hostels List Section (Hostel Table Basis) -->
    <section id="hostels" class="py-5 bg-light">
        <div class="container py-4">
            <div class="text-center mb-5">
                <h6 class="text-primary fw-bold text-uppercase">Hostel Selection</h6>
                <h2 class="fw-bold">Available Student Hostels</h2>
                <p class="text-muted">ကျောင်းသား/သူများ လျှောက်ထားနိုင်သည့် အဆောင်များ</p>
            </div>
            <div class="row g-4">
                @foreach ($hostels as $hostel)
                    <div class="col-md-4">
                        @php
                            // 1. Auth မှ Student ၏ gender (စာလုံးသေး) ကို ယူပါ
                            $studentGender = Auth::guard('student')->user()->gender ?? Auth::user()->gender ?? null;
                            
                            // 2. Hostel ၏ gender (စာလုံးသေး) ကို ယူပါ
                            $hostelGender = $hostel->gender ?? null;

                            // 3. Gender Mismatch ဖြစ်မဖြစ် စစ်ဆေးခြင်း
                            $isGenderMismatch = false;
                            
                            if ($studentGender && $hostelGender && strtolower($hostelGender) !== 'all') {
                                if (strtolower(trim($studentGender)) !== strtolower(trim($hostelGender))) {
                                    $isGenderMismatch = true;
                                }
                            }
                        @endphp
                        <div class="card border-0 shadow-sm h-100 hostel-card">
                            <img src="{{ $hostel->image }}" class="card-img-top" alt="Hostel A">
                            <div class="card-body p-4 d-flex flex-column">
                                <h5 class="fw-bold">{{ $hostel->hostel_name }}</h5>
                                <p class="text-muted small">Gender: {{ $hostel->gender }} </p>
                                <p class="text-muted small">Capacity: {{ $hostel->capacity }} Students</p>
                                <div class="mt-auto">
                                    @if(!Auth::guard('student')->check())
                                    <a href="/login" class="btn btn-primary w-100 rounded-pill btn-apply" onclick="return confirm('အဆောင်လျှောက်ထားရန် ဦးစွာ Login ဝင်ပေးပါ။');">
                                        Apply Hostel
                                    </a>
                                    @elseif ($isGenderMismatch)
                                        <a href="{{ route('hostel.apply', $hostel->hostel_id) }}" class="btn btn-secondary w-100 rounded-pill">
                                            Not Allowed ({{ $hostel->gender }} Only)
                                        </a>
                                    @else
                                        <a href="{{ route('hostel.apply', $hostel->hostel_id) }}" class="btn btn-primary w-100 rounded-pill btn-apply">
                                            Apply Hostel
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection