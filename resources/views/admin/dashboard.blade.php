@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-3">

    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Dashboard Overview</h3>
            <p class="text-muted small mb-0">Welcome back! Here is what's happening today.</p>
        </div>
        <div class="badge bg-white text-dark shadow-sm px-3 py-2 border rounded-pill fw-normal">
            <span class="spinner-grow spinner-grow-sm text-success me-1" role="status" style="width: 8px; height: 8px;"></span>
            System Status: <strong class="text-success">Active</strong>
        </div>
    </div>

    <!-- Metric Cards Row -->
    <div class="row g-3 mb-4">
        <!-- Total Students -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 p-3">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="text-muted small fw-semibold text-uppercase tracking-wider">Total Students</span>
                    <div class="rounded-circle bg-primary bg-opacity-10 p-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <i class="fa-solid fa-user-graduate fs-5 text-primary"></i>
                    </div>
                </div>
                <h2 class="fw-extrabold text-dark mb-1">{{ number_format($totalStudents) }}</h2>
                <div class="text-muted small"><i class="fa-solid fa-chart-line text-success me-1"></i> Registered users</div>
            </div>
        </div>

        <!-- Active Bookings -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 p-3">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="text-muted small fw-semibold text-uppercase tracking-wider">Active Bookings</span>
                    <div class="rounded-circle bg-success bg-opacity-10 p-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <i class="fa-solid fa-bed fs-5 text-success"></i>
                    </div>
                </div>
                <h2 class="fw-extrabold text-dark mb-1">{{ number_format($activeBookings) }}</h2>
                <div class="text-muted small"><i class="fa-solid fa-circle-check text-success me-1"></i> Allocated rooms</div>
            </div>
        </div>

        <!-- Pending Payments -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 p-3">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="text-muted small fw-semibold text-uppercase tracking-wider">Pending Payments</span>
                    <div class="rounded-circle bg-warning bg-opacity-10 p-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <i class="fa-solid fa-clock-rotate-left fs-5 text-warning"></i>
                    </div>
                </div>
                <h2 class="fw-extrabold text-dark mb-1">{{ number_format($pendingPayments) }}</h2>
                <div class="text-muted small"><i class="fa-solid fa-triangle-exclamation text-warning me-1"></i> Awaiting review</div>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 p-3">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="text-muted small fw-semibold text-uppercase tracking-wider">Total Revenue</span>
                    <div class="rounded-circle bg-info bg-opacity-10 p-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <i class="fa-solid fa-wallet fs-5 text-info"></i>
                    </div>
                </div>
                <h2 class="fw-extrabold text-dark mb-1">
                    @if($totalRevenue >= 1000000)
                        {{ number_format($totalRevenue / 1000000, 1) }}M
                    @else
                        {{ number_format($totalRevenue) }}
                    @endif
                    <span class="fs-6 text-muted fw-normal">MMK</span>
                </h2>
                <div class="text-muted small"><i class="fa-solid fa-arrow-trend-up text-info me-1"></i> Total received</div>
            </div>
        </div>
    </div>

    <!-- Recent Activities Table -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-white py-3 px-4 border-0 d-flex align-items-center justify-content-between">
            <h5 class="fw-bold mb-0 text-dark">
                <i class="fa-solid fa-list-check me-2 text-primary"></i>Recent Registration & Booking Activities
            </h5>
            <span class="badge bg-light text-muted fw-normal border">Latest Entries</span>
        </div>
        <div class="table-responsive">
            <table class="table table-borderless table-hover align-middle mb-0">
                <thead class="bg-light border-bottom text-muted small text-uppercase">
                    <tr>
                        <th class="ps-4 py-3">Student Name</th>
                        <th class="py-3">Room / Hostel</th>
                        <th class="py-3">Date</th>
                        <th class="py-3">Status</th>
                        <th class="pe-4 py-3 text-end">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($recentActivities as $activity)
                        <tr class="border-bottom-faint">
                            <td class="ps-4 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm rounded-circle bg-primary bg-opacity-10 text-primary fw-bold d-flex align-items-center justify-content-center me-3" style="width: 36px; height: 36px;">
                                        {{ strtoupper(substr($activity->student_record->student->name ?? 'N', 0, 1)) }}
                                    </div>
                                    <span class="fw-semibold text-dark">{{ $activity->student_record->student->name ?? 'N/A' }}</span>
                                </div>
                            </td>
                            <td class="py-3">
                                @php
                                    $roomNo = $activity->room->room_no 
                                        ?? $activity->payment->hostel_allocation->room->room_no 
                                        ?? null;
                                @endphp

                                @if($roomNo)
                                    <span class="fw-semibold text-dark">Room {{ $roomNo }}</span>
                                    <span class="text-muted small">({{ $activity->hostel->hostel_name ?? 'N/A' }})</span>
                                @else
                                    <span class="badge bg-light text-muted border fw-normal">Unassigned</span>
                                    <span class="text-muted small">({{ $activity->hostel->hostel_name ?? 'N/A' }})</span>
                                @endif
                            </td>
                            <td class="py-3 text-muted small">
                                <i class="fa-regular fa-calendar-days me-1 opacity-50"></i>{{ $activity->created_at->format('Y-m-d') }}
                            </td>
                            <td class="py-3">
                                @if($activity->status === 'approved')
                                    <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-semibold">
                                        <i class="fa-solid fa-circle-check me-1 small"></i>Approved
                                    </span>
                                @elseif($activity->status === 'pending')
                                    <span class="badge bg-warning-subtle text-warning-emphasis px-3 py-2 rounded-pill fw-semibold">
                                        <i class="fa-solid fa-clock me-1 small"></i>Pending
                                    </span>
                                @elseif($activity->status === 'rejected')
                                    <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill fw-semibold">
                                        <i class="fa-solid fa-circle-xmark me-1 small"></i>Rejected
                                    </span>
                                @else
                                    <span class="badge bg-secondary-subtle text-secondary px-3 py-2 rounded-pill fw-semibold">
                                        {{ ucfirst($activity->status) }}
                                    </span>
                                @endif
                            </td>
                            <td class="pe-4 py-3 text-end">
                                <a href="{{ route('backend.hostel_applications', $activity->id) }}" class="btn btn-sm btn-light border shadow-sm px-3 rounded-pill fw-semibold text-dark">
                                    View Detail <i class="fa-solid fa-chevron-right ms-1 fs-xs"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">No recent activities found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection