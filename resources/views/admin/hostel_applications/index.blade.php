@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <h2>Hostel Applications</h2>
        <a href="#" class="btn btn-primary">
            <i class="fa-solid fa-plus me-1"></i> Add New
        </a>
    </div>

    <div class="card shadow-sm p-4 bg-white rounded">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>RecordId</th>
                    <th>HosteID</th>
                    <th>Apply Date</th>
                    <th>Status</th>
                    <th>Reason</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($hostel_applications as $hostel_application)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $hostel_application->student_record->student->name }}</td>
                        <td>{{ $hostel_application->hostel->hostel_name }}</td>
                        <td>{{ $hostel_application->apply_date }}</td>
                        <td>
                            @if ($hostel_application->status == 'approved')
                                <span class="badge bg-success">{{ $hostel_application->status }}</span>
                            @elseif($hostel_application->status == 'pending')
                                <span class="badge bg-warning">{{ $hostel_application->status }}</span>
                            @else
                                <span class="badge bg-danger">{{ $hostel_application->status }}</span>
                            @endif
                        </td>
                        <td>{{ $hostel_application->reason }}</td>
                        <td class="text-end">
                            <a href="#" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-edit"></i></a>
                            <button class="btn btn-sm btn-outline-danger delete" data-id="#"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
