<!DOCTYPE html>
<html lang="my">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Polytechnique University (Pang Long)</title>
    <link rel="icon" type="image/png" href="{{ asset('front-assets/images/circle.png') }}">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Font Awesome Icons (Icon များ ပေါ်ရန်အတွက်) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Google Fonts for Myanmar Text (Padauk Font ပေါ်ရန်အတွက်) -->
    <link href="https://fonts.googleapis.com/css2?family=Padauk:wght@400;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('front-assets/css/style.css') }}">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-md navbar-light bg-white border-bottom sticky-top custom-navbar">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary fs-4 d-flex align-items-center gap-2" href="#">
                <img src="{{ asset('front-assets/images/logo.jpg') }}" alt="HMS Portal Logo" height="40" class="d-inline-block align-text-top">
                <span class="text-dark fw-bold">Faculty Of Computing</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center gap-2 mt-3 mt-md-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('index') }}"> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features"> Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#hostels"> Hostels</a>
                    </li>
                    <!-- Bell Notification Dropdown -->
                    <li class="nav-item dropdown me-3 list-unstyled">
                        <!-- 1. ခေါင်းလောင်း Icon Button -->
                        <a class="nav-link position-relative p-2" href="#" id="notifDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-bell fs-5"></i>
                            {{-- Status ရှိရင် အနီရောင်/အဝါရောင် Dot လေး ခေါင်းလောင်းပေါ်မှာ ပြမည် --}}
                            @if(isset($userNotification))
                                @php
                                    $paymentStatus = $userNotification->payment->status ?? null;
                                    $appStatus = $userNotification->status ?? null;
                                    if (in_array(strtolower(trim($paymentStatus)), ['failed', 'rejected']) || 
                                        in_array(strtolower(trim($appStatus)), ['rejected', 'failed'])) {
                                        $dotColor = 'bg-danger';
                                    }
                                    elseif (in_array($paymentStatus, ['pending', 'verifying', 'processing']) || in_array($appStatus, ['pending', 'verifying', 'processing'])) {
                                        $dotColor = 'bg-warning';
                                    }
                                    elseif (in_array(strtolower(trim($paymentStatus)), ['paid', 'verified']) || 
                                            in_array(strtolower(trim($appStatus)), ['approved'])) {
                                        $dotColor = 'bg-success';
                                    } 
                                    else {
                                        $dotColor = 'bg-warning';
                                    }
                                @endphp

                                <span class="position-absolute top-0 start-100 translate-middle p-1 
                                    {{ $dotColor }} 
                                    border border-light rounded-circle">
                                </span>
                            @endif
                        </a>

                        <!-- 2. ခေါင်းလောင်း နှိပ်မှ ပေါ်လာမည့် Dropdown Menu (Right Aligned) -->
                        <div class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3 mt-2 p-0" aria-labelledby="notifDropdown" style="width: 320px; right: 0; left: auto;">
                            
                            <!-- Dropdown Header -->
                            <div class="px-3 py-2 bg-light border-bottom d-flex justify-content-between align-items-center rounded-top">
                                <span class="fw-bold text-dark style-0-9">အကြောင်းကြားစာများ</span>
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill">Notification</span>
                            </div>

                            <!-- Dropdown Body -->
                            @if(isset($userNotification))
                                <div class="p-3">
                                    <!-- Title & Badge -->
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="fw-bold text-primary small">Hostel Application</span>
                                        
                                        @if($userNotification->status == 'pending')
                                            <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill">Pending</span>
                                        @elseif($userNotification->status == 'approved')
                                            @if(optional($userNotification->payment)->status == 'pending')
                                                <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill">Payment Verifying</span>
                                            @elseif(optional($userNotification->payment)->status == 'paid' || optional($userNotification->payment)->status == 'verified')
                                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">Completed</span>
                                            @elseif(optional($userNotification->payment)->status == 'failed')
                                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill">Payment failed</span>
                                            @else
                                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">Approved</span>
                                            @endif
                                        @elseif($userNotification->status == 'rejected')
                                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill">Rejected</span>
                                        @endif
                                    </div>
                                    
                                    <!-- Messages -->
                                    @if($userNotification->status == 'pending')
                                        <p class="text-muted small mb-0" style="line-height: 1.5;">
                                            သင်လျှောက်ထားသော <strong>{{ $userNotification->hostel->hostel_name }}</strong> လျှောက်လွှာကို ကျောင်းဘက်မှ စစ်ဆေးနေဆဲ ဖြစ်ပါသည်။
                                        </p>

                                    @elseif($userNotification->status == 'approved')
                                        @php
                                            $paymentStatus = optional($userNotification->payment)->status;
                                        @endphp

                                        {{-- 1. Payment မလုပ်ရသေးပါက --}}
                                        @if(!$userNotification->payment)
                                            <p class="text-muted small mb-2" style="line-height: 1.5;">
                                                သင်လျှောက်ထားသော <strong>{{ $userNotification->hostel->hostel_name }}</strong> လျှောက်လွှာကို <span class="text-success fw-medium">လက်ခံအတည်ပြု</span> လိုက်ပါသည်။
                                            </p>
                                            <a href="{{ route('hostels.payment', $userNotification->application_id ?? $userNotification->id) }}" class="btn btn-sm btn-outline-success w-100 fw-bold">
                                                <i class="bi bi-credit-card me-1"></i> Payment ပြုလုပ်ရန်
                                            </a>

                                        {{-- 2. Payment လုပ်ပြီး Admin စစ်ဆေးနေချိန် (Button ဖျောက်မည်) --}}
                                        @elseif($paymentStatus == 'pending')
                                            <div class="p-2 bg-light border rounded border-warning">
                                                @if(optional($userNotification->payment)->reason)
                                                    {{-- ယခင်က Failed ဖြစ်ခဲ့ဖူးပြီး ပြန်လည်တင်ပြထားပါက ပြသမည့် Noti --}}
                                                    <div class="d-flex align-items-start">
                                                        <i class="bi bi-clock-history fs-5 me-2 text-warning"></i>
                                                        <div>
                                                            <h6 class="fw-bold mb-1 style-0-8 text-warning">ငွေပေးချေမှုကို ပြန်လည်စိစစ်နေပါသည်။</h6>
                                                            <p class="mb-0 text-muted style-0-7" style="line-height: 1.4;">
                                                                ယခင်က ပယ်ဖျက်ခံထားရသော ငွေပေးချေမှုကို ပြန်လည်ပေးပို့ထားပြီး ဖြစ်ပါသဖြင့် ကျောင်းဘက် မှ ပြန်လည်စစ်ဆေးနေပါသည်။ ခေတ္တစောင့်ဆိုင်းပေးပါ။
                                                            </p>
                                                        </div>
                                                    </div>
                                                @else
                                                    {{-- ပထမအကြိမ် ပေးချေထားပြီး စစ်ဆေးနေဆဲ Noti --}}
                                                    <div class="d-flex align-items-start">
                                                        <i class="bi bi-hourglass-split fs-5 me-2 text-info"></i>
                                                        <div>
                                                            <h6 class="fw-bold mb-1 style-0-8 text-info">ငွေပေးချေမှုကို စိစစ်နေပါသည်။</h6>
                                                            <p class="mb-0 text-muted style-0-7" style="line-height: 1.4;">
                                                                သင်၏ ငွေပေးချေမှု အချက်အလက်များကို ကျောင်းဘက် မှ စစ်ဆေးနေပါသည်။
                                                            </p>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>          

                                        {{-- 3. Payment Rejected ဖြစ်ပါက (Button ပြန်ဖော်မည်) --}}
                                        @elseif($paymentStatus == 'failed')
                                            <p class="text-muted small mb-1" style="line-height: 1.5;">
                                                သင်ပေးပို့ထားသော ငွေပေးချေမှုမှာ <span class="text-danger fw-medium">ငြင်းပယ်ခံရပါသည်</span>။ ကျေးဇူးပြု၍ ငွေပြန်လည် ပေးချေပေးပါရန်။
                                            </p>
                                            @if(optional($userNotification->payment)->reason)
                                                <p class="text-dark small bg-light p-2 rounded border mb-2">
                                                    <strong>Reason: </strong> {{ $userNotification->payment->reason }}
                                                </p>
                                            @endif
                                            <div class="d-flex gap-2 mt-2 align-items-stretch">
                                                @if(optional($userNotification->payment)->payment_slip)
                                                    <button type="button" class="btn btn-sm btn-outline-secondary flex-fill fw-semibold d-inline-flex align-items-center justify-content-center py-2 style-0-8" data-bs-toggle="modal" data-bs-target="#viewSlipModal">
                                                        <i class="bi bi-file-earmark-image me-1" style="font-size: 1.1rem; line-height: 0;"></i> ပုံပြန်ကြည့်ရန်
                                                    </button>
                                                @endif
                                                <a href="{{ route('hostels.payment', $userNotification->application_id ?? $userNotification->id) }}" class="btn btn-sm btn-danger flex-fill fw-semibold d-inline-flex align-items-center justify-content-center py-2 style-0-8">
                                                    <i class="bi bi-arrow-repeat me-1" style="font-size: 1.1rem; line-height: 0;"></i>ငွေပြန်လည်ပေးချေရန်
                                                </a>
                                            </div>

                                        {{-- 4. Payment Completed --}}
                                        @elseif($paymentStatus == 'paid' || $paymentStatus == 'verified')
                                            <div class="p-3 border-bottom bg-light-subtle">
                                                <!-- ငွေပေးချေမှု အတည်ပြုပြီးကြောင်း စာသား -->
                                                <p class="text-success small mb-2 fw-semibold">
                                                    <i class="bi bi-check-circle-fill me-1"></i> ငွေပေးချေမှု အတည်ပြုပြီးပါပြီ။ အဆောင်အခန်း နေရာအတွက်ပါ ချထားပေးပြီးပါပြီ။
                                                </p>

                                                <!-- သီးသန့် ခလုတ် (Button) -->
                                                <a href="{{ route('student.myAllocation') }}" class="btn btn-sm btn-outline-primary w-100 rounded-pill d-flex align-items-center justify-content-center gap-1 shadow-sm">
                                                    <i class="bi bi-house-door me-1"></i> အဆောင်အခန်းနေရာ ကြည့်ရန်
                                                    <i class="bi bi-chevron-right small"></i>
                                                </a>
                                            </div>
                                        @endif

                                    @elseif($userNotification->status == 'rejected')
                                        <p class="text-muted small mb-1" style="line-height: 1.5;">
                                            သင်လျှောက်ထားသော <strong>{{ $userNotification->hostel->hostel_name }}</strong> လျှောက်လွှာကို <span class="text-danger fw-medium">ငြင်းပယ်</span> လိုက်ပါသည်။
                                        </p>
                                        @if($userNotification->reason)
                                            <p class="text-dark small bg-light p-2 rounded border mb-0">
                                                <strong>Reason: </strong> {{ $userNotification->reason }}
                                            </p>
                                        @endif
                                    @endif
                                    
                                    <!-- Time -->
                                    <small class="text-black-50 mt-2 d-block style-0-7">
                                        <i class="bi bi-clock me-1"></i> {{ $userNotification->created_at->diffForHumans() ?? 'Just now' }}
                                    </small>
                                </div>
                            @else
                                <!-- Empty State -->
                                <div class="px-3 py-4 text-center">
                                    <i class="bi bi-bell-slash text-muted fs-3 mb-2 d-block"></i>
                                    <p class="text-muted small mb-0">အကြောင်းကြားစာ မရှိသေးပါ။</p>
                                </div>
                            @endif
                        </div>
                    </li>
                    <li class="nav-item me-md-1">
                       @if(Auth::guard('student')->check())
                            <div class="dropdown">
                                <button class="btn btn-link text-dark text-decoration-none dropdown-toggle d-flex align-items-center gap-2 p-1" type="button" data-bs-toggle="dropdown">
                                    <!-- Profile ဓာတ်ပုံပြသရန် -->
                                    <img src="{{ Auth::guard('student')->user()->profile ? asset(Auth::guard('student')->user()->profile) : 'https://via.placeholder.com/150' }}" 
                                        alt="Profile" 
                                        class="rounded-circle" 
                                        style="width: 30px; height: 30px; object-fit: cover;">
                                    
                                    <!-- Student Name -->
                                    <span>{{ Auth::guard('student')->user()->name }}</span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="btn btn-outline-secondary dropdown-item" href="{{ route('student.profile') }}">Profile</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('student.logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-secondary text-danger  dropdown-item">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <!-- Login မဝင်ရသေးသည့်အခါ ပြမည့် UI -->
                            <a href="/login" class="btn btn-outline-primary px-4 rounded-pill">Student Login</a>
                        @endif
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary px-4 rounded-pill" href="/admin/login"> Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @if(isset($userNotification->payment) && $userNotification->payment->payment_slip)
    <div class="modal fade" id="viewSlipModal" tabindex="-1" aria-labelledby="viewSlipModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered"> 
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-light py-3">
                    <h6 class="modal-title fw-bold text-dark" id="viewSlipModalLabel">
                        <i class="bi bi-receipt me-2 text-primary"></i>တင်သွင်းထားသော Payment Slip
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-3 bg-dark-subtle">
                    <img src="{{ asset($userNotification->payment->payment_slip) }}" 
                        alt="Payment Slip" 
                        class="img-fluid rounded shadow-sm" 
                        style="max-height: 80vh; width: auto; object-fit: contain;">
                </div>
                <div class="modal-footer py-2 bg-light">
                    <button type="button" class="btn btn-secondary px-4 fw-bold" data-bs-dismiss="modal">ပိတ်မည်</button>
                </div>
                
            </div>
        </div>
    </div>
    @endif
    <main>
        @yield('content')
    </main>

    <!-- Footer (Updated to Light Theme) -->
    <footer class="bg-light text-dark py-4 border-top">
        <div class="container text-center text-muted">
            <small>&copy; 2026 UniLodge Management System. All rights reserved.</small>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('front-assets/js/main.js')}}"></script>
</body>
</html>