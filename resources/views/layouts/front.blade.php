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
                        <button class="btn btn-light position-relative rounded-circle p-2 ms-md-1" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-bell fs-5"></i>
                            <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                                <span class="visually-hidden">New alerts</span>
                            </span>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end p-2 shadow-sm" style="width: 280px;">
                            <li class="dropdown-header fw-bold">အကြောင်းကြားစာများ</li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item small text-wrap rounded py-2" href="#applicationModal">
                                    <span class="fw-bold d-block text-primary">Admin Response</span>
                                    သင်လျှောက်ထားသော Hostel Form ကို Admin မှ လက်ခံအတည်ပြုလိုက်ပါသည်။
                                </a>
                            </li>
                        </ul>
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