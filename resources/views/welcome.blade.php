<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Hostel Application</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-white bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="#">
                <i class="bi bi-building me-2"></i>Hostel Portal
            </a>
            <div class="d-flex gap-2">
                <a href="/login" class="btn btn-outline-primary btn-sm px-3">Log in</a>
                <a href="/register" class="btn btn-primary btn-sm px-3">Register</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="container my-5">
        <div class="p-5 text-center bg-white rounded-4 shadow-sm border">
            <h1 class="text-dark display-5 fw-bold mb-3">Student Hostel Application</h1>
            <p class="col-lg-8 mx-auto fs-5 text-secondary mb-4">
                Welcome to your hostel management system. Easily manage room allocations, student records, and hostel operations all in one place.
            </p>
            <div class="d-inline-flex gap-3">
                <a href="/register" class="btn btn-primary btn-lg px-4 rounded-pill">Get Started</a>
                <a href="/login" class="btn btn-outline-secondary btn-lg px-4 rounded-pill">Login Account</a>
            </div>
        </div>
    </div>

</body>
</html>