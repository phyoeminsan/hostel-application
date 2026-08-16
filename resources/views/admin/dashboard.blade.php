@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
            <h2>Dashboard Overview</h2>
            <span class="text-muted"><i class="fa-regular fa-calendar me-1"></i> System Status: Active</span>
        </div>

        <!-- Metric Cards -->
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card shadow-sm border-0 bg-white p-3 border-start border-primary border-4 rounded">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-muted small">Total Students</div>
                            <h3 class="fw-bold mb-0">124</h3>
                        </div>
                        <i class="fa-solid fa-users fa-2x text-primary opacity-50"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 bg-white p-3 border-start border-success border-4 rounded">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-muted small">Active Bookings</div>
                            <h3 class="fw-bold mb-0">86</h3>
                        </div>
                        <i class="fa-solid fa-bed fa-2x text-success opacity-50"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 bg-white p-3 border-start border-warning border-4 rounded">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-muted small">Pending Payments</div>
                            <h3 class="fw-bold mb-0">12</h3>
                        </div>
                        <i class="fa-solid fa-clock fa-2x text-warning opacity-50"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 bg-white p-3 border-start border-info border-4 rounded">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-muted small">Total Revenue</div>
                            <h3 class="fw-bold mb-0">4.3M <small class="fs-6">MMK</small></h3>
                        </div>
                        <i class="fa-solid fa-money-bill-wave fa-2x text-info opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activities Table -->
        <div class="card shadow-sm p-4 bg-white rounded">
            <h5 class="fw-bold mb-3"><i class="fa-solid fa-clock-rotate-left me-2 text-primary"></i>Recent Registration & Booking Activities</h5>
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Student Name</th>
                        <th>Room / Hostel</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Aung Aung</td>
                        <td>Room 101 (Hostel A)</td>
                        <td>2026-07-24</td>
                        <td><span class="badge bg-success">Confirmed</span></td>
                        <td class="text-end"><a href="booking.html" class="btn btn-sm btn-outline-primary">View</a></td>
                    </tr>
                    <tr>
                        <td>Kyaw Kyaw</td>
                        <td>Room 202 (Hostel B)</td>
                        <td>2026-07-23</td>
                        <td><span class="badge bg-warning text-dark">Pending Payment</span></td>
                        <td class="text-end"><a href="payments.html" class="btn btn-sm btn-outline-primary">View</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
@endsection
