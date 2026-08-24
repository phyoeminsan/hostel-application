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
                    <th>Address</th>
                    <th>HosteID</th>
                    <th>Apply Date</th>
                    <th>Status</th>
                    <th>Reason</th>
                    <th>Actions</th>
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
                        <td>{{ $hostel_application->student_record->student->address }}</td>
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
                        <td style="max-width: 150px;" class="text-truncate" title="{{ $hostel_application->reason }}">
    {{ $hostel_application->reason ?? '-' }}
</td>
                        <td>
                            <!-- Approve Button Form -->
                            <form action="{{ route('backend.hostel_applications.approved', $hostel_application->application_id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('ဒီလျှောက်လွှာကို အတည်ပြုမှာ သေချာပါသလား?')">
                                    <i class="bi bi-check-lg"></i> Approved
                                </button>
                            </form>

                            <!-- Reject Button (Modal ခေါ်မည်) -->
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $hostel_application->application_id }}">
                                <i class="bi bi-x-lg"></i> Rejected
                            </button>

                            <!-- Reject Reason မေးမည့် Modal -->
                            <div class="modal fade" id="rejectModal{{ $hostel_application->application_id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('backend.hostel_applications.rejected', $hostel_application->application_id) }}" method="POST">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title">Reject ပြုလုပ်ရသည့် အကြောင်းရင်း</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-start">
                                                <label class="form-label">အကြောင်းရင်း ထည့်သွင်းပါ -</label>
                                                <textarea name="reason" class="form-control" rows="3" required placeholder="ဥပမာ - အဆောင်နေရာ လွတ်မရှိသေးသောကြောင့်..."></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-danger">Confirm Reject</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
