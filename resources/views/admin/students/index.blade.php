@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <h2>Student Management</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudentModal">
            <i class="fa-solid fa-plus me-1"></i> Add New Student
        </button>
    </div>

    <div class="card shadow-sm p-4 bg-white rounded">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Student No</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Faculty</th>
                    <th>Major</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>STU-001</td>
                    <td>Aung Aung</td>
                    <td>Male</td>
                    <td>ICT</td>
                    <td>Software</td>
                    <td>09123456789</td>
                    <td><span class="badge bg-success">Active</span></td>
                    <td class="text-end">
                        <button class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-edit"></i></button>
                        <button class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

     <!-- Add Student Modal -->
    <div class="modal fade" id="addStudentModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Student Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3">
                        <div class="col-md-6"><label class="form-label">Student No</label><input type="text" class="form-control" required></div>
                        <div class="col-md-6"><label class="form-label">Full Name</label><input type="text" class="form-control" required></div>
                        <div class="col-md-6">
                            <label class="form-label">Gender</label>
                            <select class="form-select"><option>Male</option><option>Female</option></select>
                        </div>
                        <div class="col-md-6"><label class="form-label">Faculty</label><input type="text" class="form-control"></div>
                        <div class="col-md-6"><label class="form-label">Major</label><input type="text" class="form-control"></div>
                        <div class="col-md-6"><label class="form-label">Phone No</label><input type="text" class="form-control"></div>
                        <div class="col-12"><label class="form-label">Address</label><textarea class="form-control" rows="2"></textarea></div>
                        <div class="col-12"><label class="form-label">Student Photo</label><input type="file" class="form-control"></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save Student</button>
                </div>
            </div>
        </div>
    </div>
@endsection

  