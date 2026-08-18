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
    <nav class="sidebar">
        <div class="sidebar-heading"><i class="fa-solid fa-school"></i> Admin</div>
        <div class="pt-3">
            <a class="nav-link" href="{{route('backend.dashboard')}}">
                <i class="fa-solid fa-gauge-high me-2"></i> 
                <span>Dashboard</span>
            </a>
            <a class="nav-link" href="{{route('backend.academic_years.index')}}">
                <i class="fa-solid fa-book-open-reader me-2"></i> 
                <span>Academic Year</span>
            </a>
            <a href="{{ route('backend.years.index') }}" class="nav-link text-white">
                <i class="fa-solid fa-calendar-check me-2"></i>
                <span>Years</span>
            </a>
            <a class="nav-link" href="{{route('backend.students.index')}}">
                <i class="fa-solid fa-users me-2"></i> 
                <span>Students</span>
            </a>
            <a class="nav-link" href="{{route('backend.student_records.index')}}">
                <i class="fa-solid fa-users me-2"></i> 
                <span>Student Record</span>
            </a>
            <a class="nav-link" href="{{route('backend.hostels.index')}}">
                <i class="fa-solid fa-hotel"></i>
                <span>Hostels</span>
            </a>
            <a class="nav-link" href="{{route('backend.rooms.index')}}">
                <i class="fa-solid fa-bed"></i>
                <span>Rooms</span>
            </a>
            <a class="nav-link" href="#"><i class="fa-solid fa-credit-card me-2"></i> Payments</a>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
       @yield('content')
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('admin-asset/js/main.js')}}"></script>
    @yield('script')
</body>
</html>