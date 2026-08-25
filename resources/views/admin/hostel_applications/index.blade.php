@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <h2>Hostel Applications</h2>
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
                                <span class="badge bg-warning text-dark">{{ $hostel_application->status }}</span>
                            @else
                                <span class="badge bg-danger">{{ $hostel_application->status }}</span>
                            @endif
                        </td>
                        <td style="max-width: 150px;" class="text-truncate" title="{{ $hostel_application->reason }}">
                            {{ $hostel_application->reason ?? '-' }}
                        </td>
                        <td>
                            <button type="button" 
                                    class="btn btn-success btn-sm approve-btn" 
                                    data-id="{{ $hostel_application->application_id }}">
                                <i class="bi bi-check-lg"></i> Approved
                            </button>

                            <form id="approve-form-{{ $hostel_application->application_id }}" action="{{ route('backend.hostel_applications.approved', $hostel_application->application_id) }}" method="POST" class="d-none">
                                @csrf
                            </form>

                            <button type="button" 
                                    class="btn btn-danger btn-sm reject-btn" 
                                    data-id="{{ $hostel_application->application_id }}">
                                <i class="bi bi-x-lg"></i> Rejected
                            </button>

                            <!-- Hidden Form for Reject Submit -->
                            <form id="reject-form-{{ $hostel_application->application_id }}" 
                                action="{{ route('backend.hostel_applications.rejected', $hostel_application->application_id) }}" 
                                method="POST" class="d-none">
                                @csrf
                                <input type="hidden" name="reason" id="reject-reason-{{ $hostel_application->application_id }}">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        
        // Approve Confirmation Alert
        document.querySelectorAll('.approve-btn').forEach(button => {
            button.addEventListener('click', function () {
                let id = this.getAttribute('data-id');
                
                Swal.fire({
                    title: 'သေချာပါသလား?',
                    text: "ဒီလျှောက်လွှာကို အတည်ပြုရန် သေချာပါသလား?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#198754',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'အတည်ပြုမည်',
                    cancelButtonText: 'မလုပ်တော့ပါ'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('approve-form-' + id).submit();
                    }
                });
            });
        });

        // Reject Input Reason Alert
        document.querySelectorAll('.reject-btn').forEach(button => {
            button.addEventListener('click', function () {
                let id = this.getAttribute('data-id');

                Swal.fire({
                    title: 'ငြင်းပယ်ရသည့် အကြောင်းရင်း',
                    input: 'textarea',
                    inputAttributes: {
                        'aria-label': 'ငြင်းပယ်ရသည့် အကြောင်းရင်း'
                    },
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'ငြင်းပယ်မည်',
                    cancelButtonText: 'မလုပ်တော့ပါ',
                    inputValidator: (value) => {
                        if (!value) {
                            return 'ကျေးဇူးပြု၍ အကြောင်းရင်း ရိုက်ထည့်ပေးပါ!';
                        }
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Value ကို Hidden Input ထဲထည့်ပြီး Form Submit လုပ်မည်
                        document.getElementById('reject-reason-' + id).value = result.value;
                        document.getElementById('reject-form-' + id).submit();
                    }
                });
            });
        });

    });
</script>
@endsection