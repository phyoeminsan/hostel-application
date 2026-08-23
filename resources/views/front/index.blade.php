@extends('layouts.front')
@section('content')
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <section id="home" class="hero-section text-dark d-flex align-items-center py-5">
        <div class="container-fluid px-4 px-lg-5">
            <div class="row align-items-center">
                <div class="col-lg-6"> 
                    <span class="badge bg-primary px-3 py-2 rounded-pill fw-semibold mb-3">
                        <i class="bi bi-calendar-check me-1"></i> Academic Year 2026 Open
                    </span>
                    <h1 class="display-4 fw-bold mb-3">Apply for University Hostel Accommodation</h1>
                    <p class="lead text-dark mb-4">
                        ကျောင်းသား/ကျောင်းသူများအတွက် လုံခြုံစိတ်ချရပြီး အဆင်ပြေချောမွေ့သော အဆောင်အခန်းများကို လွယ်ကူစွာ စုံစမ်းကြည့်ရှုပြီး Online မှတစ်ဆင့် တိုက်ရိုက် လျှောက်ထားနိုင်ပါသည်။
                    </p>
                    <a href="#hostels" class="btn btn-primary btn-lg rounded-pill px-4">အဆောင်များ ကြည့်မည်</a>
                </div>
            </div>
        </div>
    </section>

    <section id="features" class="features-section">
        <div class="container text-center">
            <!-- Section Title & Subtitle -->
            <h2 class="fw-bold mb-2" style="font-size: 2.2rem;">Why Choose Our Hostels?</h2>
            <p class="text-secondary mb-5 fs-5">
                ကျောင်းသား/သူများ စိတ်အေးချမ်းသာစွာ ပညာသင်ကြားနိုင်ရန် အပြည့်အဝ ဖန်တီးပေးထားပါသည်။
            </p>
            <!-- Cards Grid -->
            <div class="row g-4 justify-content-center">
                
                <!-- High-Speed Wi-Fi -->
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="icon-box icon-wifi">
                            <i class="fa-solid fa-wifi"></i>
                        </div>
                        <h3 class="feature-title">High-Speed Wi-Fi</h3>
                        <p class="feature-text">
                        စာလေ့လာရန်နှင့် အင်တာနက်အသုံးပြုရန်အတွက် မြန်နှုန်းမြင့် Wi-Fi စနစ် တပ်ဆင်ပေးထားပါသည်။
                        </p>
                    </div>
                </div>

                <!-- 24/7 Security -->
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="icon-box icon-security">
                            <i class="fa-solid fa-user-shield"></i>
                        </div>
                        <h3 class="feature-title">24/7 Security</h3>
                        <p class="feature-text">
                        CCTV ကင်မရာများနှင့် လုံခြုံရေးဝန်ထမ်းများဖြင့် ၂၄ နာရီပတ်လုံး လုံခြုံရေးရယူပေးထားပါသည်။
                        </p>
                    </div>
                </div>

                <!-- Power Backup -->
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="icon-box icon-power">
                            <i class="fa-solid fa-bolt"></i>
                        </div>
                        <h3 class="feature-title">Power Backup</h3>
                        <p class="feature-text">
                        မီးပျက်ချိန်များတွင်လည်း စာကျက်မပျက်စေရန် မီးစက်/Generator စနစ်များ ထောက်ပံ့ထားပါသည်။
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
                                    @if (!Auth::guard('student')->check())
                                        <!-- Login မဝင်ထားလျှင် Login Page သို့ ခေါ်သွားမည် သို့မဟုတ် Warning Alert ပြမည် -->
                                        <a href="/login" class="btn btn-secondary w-100 rounded-pill" onclick="return confirm('အဆောင်လျှောက်ထားရန် ဦးစွာ Login ဝင်ပေးပါ၊');">
                                            Apply Hostel
                                        </a>
                                    @elseif ($isGenderMismatch)
                                        <!-- Gender မတူလျှင် -->
                                        <a href="{{ route('hostel.apply', $hostel->hostel_id) }}" class="btn btn-danger w-100 rounded-pill">
                                            Not Allowed ({{ $hostel->gender }} Only)
                                        </a>
                                    @else
                                        <!-- Login ဝင်ထားပြီး Gender ပါ တူလျှင် -->
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
        @if(session('error'))
            <script>
                Swal.fire({
                        icon: 'error',
                        title: 'ရွှေးချယ်၍ မရနိုင်ပါ!',
                        text: "{{ session('error') }}",
                        confirmButtonColor: '#dc3545',
                        confirmButtonText: 'နားလည်ပါပြီ'
                    });
            </script>
        @endif
        @if(session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'အောင်မြင်ပါသည်',
                    text: "{{ session('success') }}",
                    confirmButtonColor: '#0d6efd',
                    confirmButtonText: 'နားလည်ပါပြီ' 
                });
            </script>
        @endif
@endsection