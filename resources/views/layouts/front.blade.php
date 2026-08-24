<!DOCTYPE html>
<html lang="my">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniLodge - Hostel Management System</title>
    
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
                <i class="bi bi-building-check fs-3"></i>
                <span>HMS Portal</span>
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
                    <li class="nav-item dropdown">
                        <a class="btn btn-light position-relative rounded-circle p-2 ms-md-1" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-bell fs-5 text-secondary"></i>
                            @if(isset($userNotification))
                                <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
                            @endif
                        </a>
                        <!-- Notification Dropdown Menu -->
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3 mt-2" style="width: 320px;">
                            <!-- Header -->
                            <li class="px-3 py-2 border-bottom">
                                <h6 class="fw-bold mb-2 text-dark">အကြောင်းကြားစာများ</h6>
                            </li>

                            <!-- Body -->
                            <li>
                                @if(isset($userNotification))
                                    <div class="px-3 py-3 dropdown-item-text transition-all">
                                        <!-- Title & Badge -->
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="fw-bold text-primary" style="font-size: 0.9rem;">Hostel Application Status</span>
                                            
                                            @if($userNotification->status == 'pending')
                                                <span class="badge rounded-pill bg-warning text-dark px-2 py-1" style="font-size: 0.7rem;">Pending</span>
                                            @elseif($userNotification->status == 'approved')
                                                <span class="badge rounded-pill bg-success px-2 py-1" style="font-size: 0.7rem;">Approved</span>
                                            @elseif($userNotification->status == 'rejected')
                                                <span class="badge rounded-pill bg-danger px-2 py-1" style="font-size: 0.7rem;">Rejected</span>
                                            @endif
                                        </div>
                                        
                                        <!-- Message -->
                                        @if($userNotification->status == 'pending')
                                            <p class="text-muted mb-0 mt-1" style="font-size: 0.85rem; line-height: 1.6;">
                                                သင်လျှောက်ထားသော <strong>{{ $userNotification->hostel->hostel_name }}</strong> Form ကို Admin မှ စစ်ဆေးနေဆဲ ဖြစ်ပါသည်။
                                            </p>
                                        @elseif($userNotification->status == 'approved')
                                            <p class="text-muted mb-1 mt-1" style="font-size: 0.85rem; line-height: 1.6;">
                                                သင်လျှောက်ထားသော <strong>{{ $userNotification->hostel->hostel_name }}</strong> Form ကို Admin မှ <span class="text-success fw-medium">လက်ခံအတည်ပြု</span> လိုက်ပါသည်။
                                            </p>
                                            <div class="mt-2">
                                                <a href="#" class="btn btn-sm btn-outline-success w-100 fw-bold">
                                                    <i class="bi bi-credit-card"></i> Payment ပြုလုပ်ရန် ဤနေရာကို နှိပ်ပါ
                                                </a>
                                            </div>
                                        @elseif($userNotification->status == 'rejected')
                                            <p class="text-muted mb-1 mt-1" style="font-size: 0.85rem; line-height: 1.6;">
                                                သင်လျှောက်ထားသော <strong>{{ $userNotification->hostel->hostel_name }}</strong> Form ကို <span class="text-danger fw-medium">ငြင်းပယ်</span> လိုက်ပါသည်။
                                            </p>
                                            @if($userNotification->reason)
                                                <p class="text-dark small bg-light p-2 rounded border mb-0">
                                                    <strong>Reason:</strong> {{ $userNotification->reason }}
                                                </p>
                                            @endif
                                        @endif
                                        
                                        <!-- Timestamp (Optional) -->
                                        <small class="text-black-50 mt-2 d-block" style="font-size: 0.7rem;">
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
                            </li>
                        </ul>
                    </li>
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
                                    <li><a class="dropdown-item" href="{{ route('student.profile') }}">Profile</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('student.logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-secondary   text-danger  dropdown-item">Logout</button>
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