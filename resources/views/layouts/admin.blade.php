<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('admin-asset/css/style.css')}}">
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar d-flex flex-column justify-content-between p-3" style="min-height: 100vh;">
        <div>
            <!-- ⬆️ Admin Header & Profile Dropdown (ထိပ်ဆုံးသို့ ရွှေ့ထားသည်) ⬆️ -->
            <div class="sidebar-heading mb-3 pb-2 border-bottom border-secondary">
                @if(Auth::guard('admin')->check())
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle text-white d-flex align-items-center gap-2 p-1 rounded hover-overlay" href="#" id="sidebarAdminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-circle-user fs-4 text-info"></i>
                            <span class="fw-bold fs-5 text-truncate">{{ Auth::guard('admin')->user()->name }} Admin</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-light shadow border-0 mt-2" aria-labelledby="sidebarAdminDropdown">
                            <li>
                                <a class="dropdown-item py-2" href="#">
                                    <i class="fa-solid fa-user me-2 text-info"></i> Profile
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item py-2 text-danger fw-semibold" href="#"
                                   onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();">
                                    <i class="fa-solid fa-right-from-bracket me-2"></i> Logout
                                </a>
                                <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="fs-5 fw-bold text-white"><i class="fa-solid fa-school me-2"></i> Admin</span>
                        <a href="{{ route('admin.login') }}" class="btn btn-outline-light btn-sm">Login</a>
                    </div>
                @endif
            </div>
            
            <!-- Navigation Links -->
            <div class="nav flex-column gap-1">
                <a class="nav-link text-white" href="{{route('backend.dashboard')}}">
                    <i class="fa-solid fa-gauge-high me-2"></i> 
                    <span>Dashboard</span>
                </a>
                <a class="nav-link text-white" href="{{route('backend.academic_years.index')}}">
                    <i class="fa-solid fa-book-open-reader me-2"></i> 
                    <span>Academic Year</span>
                </a>
                <a href="{{ route('backend.years.index') }}" class="nav-link text-white">
                    <i class="fa-solid fa-calendar-check me-2"></i>
                    <span>Years</span>
                </a>
                <a href="{{ route('backend.majors.index') }}" class="nav-link text-white">
                    <i class="fa-solid fa-graduation-cap me-2"></i>
                    <span>Majors</span>
                </a>
                <a class="nav-link text-white" href="{{route('backend.students.index')}}">
                    <i class="fa-solid fa-users me-2"></i> 
                    <span>Students</span>
                </a>
                
                <!-- Student Records Dropdown -->
                <a class="nav-link text-white dropdown-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#studentRecordMenu" aria-expanded="false">
                    <i class="fa-solid fa-file-signature me-2"></i> 
                    <span>Student Records</span>
                </a>
                <div class="collapse ms-3 mt-1" id="studentRecordMenu" style="max-height: 200px; overflow-y: auto;">
                    <a class="nav-link py-1 fs-6 text-white-50" href="{{ route('backend.student_records.index') }}">
                        <i class="fa-solid fa-list me-2"></i> All Student Records
                    </a>
                    @foreach(\App\Models\Year::select('year_id', 'year_name')->get() as $year)
                        <a class="nav-link py-1 fs-6 text-white-50" href="{{ route('backend.student_records.index', ['year_id' => $year->year_id]) }}">
                            <i class="fa-solid fa-calendar-check me-2"></i> {{ $year->year_name }}
                        </a>
                    @endforeach
                </div>

                <a class="nav-link text-white" href="{{route('backend.hostels.index')}}">
                    <i class="fa-solid fa-hotel me-2"></i>
                    <span>Hostels</span>
                </a>

                <!-- Rooms Dropdown -->
                <a class="nav-link text-white dropdown-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#roomsHostelMenu" aria-expanded="false">
                    <i class="fa-solid fa-bed me-2"></i> Rooms
                </a>
                <div class="collapse ms-3 mt-1" id="roomsHostelMenu" style="max-height: 200px; overflow-y: auto;">
                    <a class="nav-link py-1 fs-6 text-white-50" href="{{ route('backend.rooms.index') }}">
                        <i class="fa-solid fa-list me-2"></i> All Rooms
                    </a>
                    @foreach(\App\Models\Hostel::select('hostel_id', 'hostel_name')->get() as $hostel)
                        <a class="nav-link py-1 fs-6 text-white-50" href="{{ route('backend.rooms.index', ['hostel_id' => $hostel->hostel_id]) }}">
                            <i class="fa-solid fa-hotel me-2"></i> {{ $hostel->hostel_name }}
                        </a>
                    @endforeach
                </div>

                <a class="nav-link text-white" href="{{ route('backend.hostel_applications') }}">
                    <i class="fa-solid fa-credit-card me-2"></i> Hostel Applications
                </a>

                <a class="nav-link text-white" href="{{ route('backend.payments') }}">
                    <i class="fa-solid fa-credit-card me-2"></i> Payments
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content p-4">
        @yield('content')
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('admin-asset/js/main.js')}}"></script>
    @yield('script')
</body>
</html>