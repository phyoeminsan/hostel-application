@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <h2>Hostel Allocations </h2>
    </div>

       <!-- Recent Activities Table -->
        <div class="card shadow-sm p-4 bg-white rounded">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Payment ID</th>
                        <th>Room ID</th>
                        <th>Allocation Date</th>
                        <th>Status</th>
                        <th>Description</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($hostel_allocations as $hostel_allocation)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $hostel_allocation->payment_id }}</td>
                            <td>{{ $hostel_allocation->room_id }}</td>
                            <td>{{ $hostel_allocation->allocation_date }}</td>
                            <td>
                                @if ($hostel_allocation->status == 'active')
                                    <span class="badge bg-success">{{ $hostel_allocation->status ?? '-' }}</span>
                                @else
                                    <span class="badge text-dark bg-warning">{{ $hostel_allocation->status }}</span>
                                @endif
                            </td>
                            <td style="max-width: 100px;" class="text-truncate" title="{{ $hostel_allocation->description }}">
                                {{ $hostel_allocation->description }}
                            </td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
@endsection