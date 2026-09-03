<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PUPL - Faculty Of Computing</title>
    <link rel="icon" type="image/png" href="{{ asset('front-assets/images/circle.png') }}">
    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome 6.4 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('admin-asset/css/style.css')}}">
</head>
<body>
    <div class="main-wrapper">
        <!-- Sidebar Navigation -->
        <nav class="sidebar d-flex flex-column justify-content-between p-3" style="min-height: 100vh;">
            <div>
                <!-- Admin Header & Profile Dropdown -->
                <div class="sidebar-heading mb-4 p-2 rounded-3 border border-secondary border-opacity-25">
                    @if(Auth::guard('admin')->check())
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle text-white d-flex align-items-center gap-2 p-1 rounded-2 profile-dropdown-btn" href="#" id="sidebarAdminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-circle-user fs-4 text-info"></i>
                                <div class="d-flex flex-column overflow-hidden me-auto">
                                    <span class="fw-bold fs-6 text-white text-truncate">{{ Auth::guard('admin')->user()->name }}</span>
                                    <span class="text-white-50 fs-7" style="font-size: 0.75rem;">Administrator</span>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark shadow-lg border border-secondary border-opacity-25 rounded-3 mt-2 w-100" aria-labelledby="sidebarAdminDropdown">
                                <li>
                                    <a class="dropdown-item py-2 d-flex align-items-center gap-2" href="{{ route('backend.profile.edit') }}">
                                        <i class="fa-solid fa-user text-info"></i> <span>Profile</span>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider border-secondary border-opacity-25"></li>
                                <li>
                                    <a class="dropdown-item py-2 text-danger fw-semibold d-flex align-items-center gap-2" href="#"
                                       onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();">
                                        <i class="fa-solid fa-right-from-bracket"></i> <span>Logout</span>
                                    </a>
                                    <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <div class="d-flex align-items-center justify-content-between p-1">
                            <span class="fs-6 fw-bold text-white d-flex align-items-center gap-2">
                                <i class="fa-solid fa-school text-info"></i> Admin
                            </span>
                            <a href="{{ route('admin.login') }}" class="btn btn-outline-light btn-sm rounded-2 px-3">Login</a>
                        </div>
                    @endif
                </div>
                
                <!-- Main Navigation Links -->
                <div class="nav flex-column gap-1">
                    <a class="nav-link {{ request()->routeIs('backend.dashboard') ? 'active' : '' }}" href="{{route('backend.dashboard')}}">
                        <i class="fa-solid fa-gauge-high me-2"></i> 
                        <span>Dashboard</span>
                    </a>
                    
                    <a class="nav-link {{ request()->routeIs('backend.academic_years.*') ? 'active' : '' }}" href="{{route('backend.academic_years.index')}}">
                        <i class="fa-solid fa-book-open-reader me-2"></i> 
                        <span>Academic Year</span>
                    </a>
                    
                    <a href="{{ route('backend.years.index') }}" class="nav-link {{ request()->routeIs('backend.years.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-calendar-check me-2"></i>
                        <span>Years</span>
                    </a>
                    
                    <a href="{{ route('backend.majors.index') }}" class="nav-link {{ request()->routeIs('backend.majors.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-graduation-cap me-2"></i>
                        <span>Majors</span>
                    </a>
                    
                    <a class="nav-link {{ request()->routeIs('backend.students.*') ? 'active' : '' }}" href="{{route('backend.students.index')}}">
                        <i class="fa-solid fa-users me-2"></i> 
                        <span>Students</span>
                    </a>
                    
                    <!-- Student Records Dropdown -->
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('backend.student_records.*') ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#studentRecordMenu" aria-expanded="{{ request()->routeIs('backend.student_records.*') ? 'true' : 'false' }}">
                        <i class="fa-solid fa-file-signature me-2"></i> 
                        <span>Student Records</span>
                    </a>
                    <div class="collapse submenu-container custom-scrollbar mt-1 {{ request()->routeIs('backend.student_records.*') ? 'show' : '' }}" id="studentRecordMenu" style="max-height: 200px; overflow-y: auto;">
                        <a class="nav-link" href="{{ route('backend.student_records.index') }}">
                            <i class="fa-solid fa-list me-2"></i> All Student Records
                        </a>
                        @foreach(\App\Models\Year::select('year_id', 'year_name')->get() as $year)
                            <a class="nav-link" href="{{ route('backend.student_records.index', ['year_id' => $year->year_id]) }}">
                                <i class="fa-solid fa-calendar-check me-2"></i> {{ $year->year_name }}
                            </a>
                        @endforeach
                    </div>

                    <a class="nav-link {{ request()->routeIs('backend.hostels.*') ? 'active' : '' }}" href="{{route('backend.hostels.index')}}">
                        <i class="fa-solid fa-hotel me-2"></i>
                        <span>Hostels</span>
                    </a>

                    <!-- Rooms Dropdown -->
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('backend.rooms.*') ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#roomsHostelMenu" aria-expanded="{{ request()->routeIs('backend.rooms.*') ? 'true' : 'false' }}">
                        <i class="fa-solid fa-bed me-2"></i> Rooms
                    </a>
                    <div class="collapse submenu-container custom-scrollbar mt-1 {{ request()->routeIs('backend.rooms.*') ? 'show' : '' }}" id="roomsHostelMenu" style="max-height: 200px; overflow-y: auto;">
                        <a class="nav-link" href="{{ route('backend.rooms.index') }}">
                            <i class="fa-solid fa-list me-2"></i> All Rooms
                        </a>
                        @foreach(\App\Models\Hostel::select('hostel_id', 'hostel_name')->get() as $hostel)
                            <a class="nav-link" href="{{ route('backend.rooms.index', ['hostel_id' => $hostel->hostel_id]) }}">
                                <i class="fa-solid fa-hotel me-2"></i> {{ $hostel->hostel_name }}
                            </a>
                        @endforeach
                    </div>

                    <a class="nav-link {{ request()->routeIs('backend.hostel_applications.*') ? 'active' : '' }}" href="{{ route('backend.hostel_applications') }}">
                        <i class="fa-solid fa-clipboard-list me-2"></i> Hostel Applications
                    </a>

                    <a class="nav-link {{ request()->routeIs('backend.payments.*') ? 'active' : '' }}" href="{{ route('backend.payments') }}">
                        <i class="fa-solid fa-credit-card me-2"></i> Payments
                    </a>

                    <a class="nav-link {{ request()->routeIs('backend.hostel_allocations.*') ? 'active' : '' }}" href="{{ route('backend.hostel_allocations') }}">
                        <i class="fa-solid fa-building-user me-2"></i> Hostel Allocations
                    </a>
                </div>
            </div>
        </nav>

        <!-- Main Content Area -->
        <main class="main-content p-4">
            @yield('content')
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('admin-asset/js/main.js')}}"></script>
    @yield('script')
</body>
</html>