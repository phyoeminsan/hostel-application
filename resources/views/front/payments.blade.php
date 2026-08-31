@extends('layouts.front')
@section('content')
<style>
    .payment-card {
      border: 1px solid #e2e8f0;
      border-radius: 16px;
      background: #ffffff;
      box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.05), 0 8px 10px -6px rgba(15, 23, 42, 0.05);
    }
    .card-header-custom {
      background-color: #10368e;
      border-top-left-radius: 16px;
      border-top-right-radius: 16px;
      padding: 1.5rem 2rem;
    }
    .section-label {
      font-size: 0.75rem;
      font-weight: 700;
      letter-spacing: 0.05em;
      text-transform: uppercase;
      color: #64748b;
      margin-bottom: 0.75rem;
      display: block;
    }
    .info-box {
      background-color: #f1f5f9;
      border-radius: 12px;
      padding: 1.25rem;
      border: 1px solid #e2e8f0;
    }
    .form-control, .form-select {
      border: 1px solid #cbd5e1;
      border-radius: 8px;
      padding: 0.6rem 0.85rem;
      font-size: 0.95rem;
      color: #0f172a;
    }
    .form-control:focus, .form-select:focus {
      border-color: #2563eb;
      box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
    }
    .input-group-text {
      background-color: #f8fafc;
      border: 1px solid #cbd5e1;
      border-radius: 8px 0 0 8px;
      color: #64748b;
    }
    .input-group .form-control, .input-group .form-select {
      border-top-left-radius: 0;
      border-bottom-left-radius: 0;
    }
    .btn-primary-custom {
      background-color: #1e40af;
      border: none;
      border-radius: 8px;
      padding: 0.8rem 1.5rem;
      font-weight: 600;
      color: #ffffff;
      transition: all 0.2s ease;
    }
    .btn-primary-custom:hover {
      background-color: #1e3a8a;
      transform: translateY(-1px);
    }
    .file-upload-wrapper {
      border: 2px dashed #cbd5e1;
      border-radius: 12px;
      padding: 1.5rem;
      text-align: center;
      background-color: #f8fafc;
      cursor: pointer;
      transition: border-color 0.2s ease;
    }
    .file-upload-wrapper:hover {
      border-color: #2563eb;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Error အားလုံးကို SweetAlert2 ဖြင့် ပြသရန် -->
@if ($errors->any())
<script>
    Swal.fire({
      icon: 'error',
      title: 'ဖြည့်သွင်းချက်များ လိုအပ်နေပါသည်',
      text: 'ကျေးဇူးပြုပြီး အချက်အလက်များကို ပြည့်စုံစွာဖြည့်သွင်းပေးပါ',
      confirmButtonText: 'ပြန်လည်စစ်ဆေးမည်',
      confirmButtonColor: '#d33'
  });
</script>
@endif

@if(session('success'))
<script>
    Swal.fire({
        title: 'အောင်မြင်ပါသည်။',
        text: "{{ session('success') }}",
        icon: 'success',
        confirmButtonText: 'OK',
        confirmButtonColor: '#0d6efd'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "{{ route('index') }}";
        }
    });
</script>
@endif

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-7 col-md-9">
      
      <div class="payment-card">
        <div class="card-header-custom text-white d-flex justify-content-between align-items-center">
          <div>
            <h5 class="mb-1 fw-bold text-white"><i class="bi bi-shield-check me-2 text-primary"></i>Hostel Payment Verification</h5>
            <p class="mb-0 text-white-50 small">Official Portal for Room Rent & Utility Receipts</p>
          </div>
          <span class="badge bg-primary bg-opacity-20 text-white border border-primary-subtle px-3 py-2 rounded-pill">Resident Desk</span>
        </div>
        
        <div class="card-body p-4 p-md-5">
          <form action="{{ route('hostels.payment.store', $hostel_application->application_id) }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf

            <!-- Resident Info -->
            <div class="info-box mb-4">
              <span class="section-label"><i class="bi bi-person-badge me-1"></i> Resident Information</span>
              <div class="row g-3">
                <div class="col-md-6">
                  <label for="applicationID" class="form-label small fw-semibold text-secondary">Student ID</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-book-open-reader"></i></span>
                    <input type="text" class="form-control" id="applicationID" name="applicationID" value="{{ $student_record->student->roll_no }}" readonly>
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="roomNo" class="form-label small fw-semibold text-secondary">Name</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                    <input type="text" class="form-control" id="roomNo" name="roomNo" value="{{ $student_record->student->name }}" readonly>
                  </div>
                </div>
              </div>
            </div>

            <!-- Receiver Details -->
            <div class="info-box mb-4">
              <span class="section-label"><i class="bi bi-building me-1"></i> Receiver Details</span>
              <div class="row g-3">
                <div class="col-md-6">
                  <label for="receiverName" class="form-label small fw-semibold text-secondary">Receiver Name</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                    <input type="text" class="form-control" id="receiverName" name="receiverName" placeholder="Ma Din Shwe" readonly>
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="receiverPhone" class="form-label small fw-semibold text-secondary">Receiver Phone Number</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                    <input type="tel" class="form-control" id="receiverPhone" name="receiverPhone" placeholder="+95 9 123 456 789" readonly>
                  </div>
                </div>
              </div>
            </div>

            <!-- Payment Method & Amount -->
            <div class="row g-3 mb-3">
              <div class="col-md-6">
                <label for="payment_method" class="form-label fw-semibold">Payment Method</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bi bi-wallet2"></i></span>
                  <select class="form-select @error('payment_method') is-invalid @enderror" id="payment_method" name="payment_method">
                    <option value="" disabled {{ old('payment_method') ? '' : 'selected' }}>Select Payment Method</option>
                    <option value="KPay" {{ old('payment_method') == 'KPay' ? 'selected' : '' }}>KBZPay</option>
                    <option value="WavePay" {{ old('payment_method') == 'WavePay' ? 'selected' : '' }}>WavePay</option>
                    <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer (KBZ, AYA, CB)</option>
                    <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Direct Cash</option>
                  </select>
                </div>
                @error('payment_method')
                  <small class="text-danger mt-1 d-block"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</small>
                @enderror
              </div>

              <div class="col-md-6">
                <label for="amount" class="form-label fw-semibold">Amount</label>
                <div class="input-group">
                  <span class="input-group-text fw-bold">MMK</span>
                  <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount') }}" placeholder="0.00">
                </div>
                @error('amount')
                  <small class="text-danger mt-1 d-block"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</small>
                @enderror
              </div>
            </div>

            <!-- Transaction NO & Date -->
            <div class="row g-3 mb-4">
              <div class="col-md-6">
                <label for="transaction_no" class="form-label fw-semibold">Transaction NO.</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bi bi-receipt-cutoff"></i></span>
                  <input type="text" class="form-control @error('transaction_no') is-invalid @enderror" id="transaction_no" name="transaction_no" value="{{ old('transaction_no') }}" placeholder="TXN-90218301">
                </div>
                @error('transaction_no')
                  <small class="text-danger mt-1 d-block"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</small>
                @enderror
              </div>

              <div class="col-md-6">
                <label for="payment_date" class="form-label fw-semibold">Payment Date</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bi bi-calendar-event"></i></span>
                  <input type="date" class="form-control @error('payment_date') is-invalid @enderror" id="payment_date" name="payment_date" value="{{ old('payment_date') }}">
                </div>
                @error('payment_date')
                  <small class="text-danger mt-1 d-block"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</small>
                @enderror
              </div>
            </div>

            <!-- Slip Upload -->
            <div class="mb-4">
              <label class="form-label fw-semibold">Payment Slip Upload</label>
              
              <div class="file-upload-wrapper text-center p-4 border border-2 dashed rounded-3 @error('payment_slip') border-danger @enderror" 
                   style="cursor: pointer; background-color: #f8fafc;" 
                   onclick="document.getElementById('payment_slip').click();">
                
                <div id="uploadDefaultState">
                  <i class="bi bi-cloud-arrow-up text-primary fs-2"></i>
                  <p class="mb-1 mt-2 fw-medium text-dark">Click to upload slip or drag and drop</p>
                </div>

                <div id="uploadPreviewState" class="d-none">
                  <img id="imagePreview" src="#" alt="Slip Preview" class="img-fluid rounded mb-2 d-none" style="max-height: 180px;">
                  <div class="d-flex align-items-center justify-content-center gap-2">
                    <i class="bi bi-file-earmark-check text-success fs-4"></i>
                    <span id="fileNameDisplay" class="fw-semibold text-dark"></span>
                  </div>
                  <small class="text-primary d-block mt-1">Click to change file</small>
                </div>

                <!-- Native required Attribute ကို ဖြုတ်ထားပါသည် -->
                <input class="d-none" type="file" id="payment_slip" name="payment_slip" accept="image/*,.pdf" onchange="handleFileSelect(this)">
              </div>
              @error('payment_slip')
                <small class="text-danger mt-1 d-block"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</small>
              @enderror
            </div>

            <div class="d-grid mt-4">
              <button type="submit" class="btn btn-primary-custom shadow-sm fs-6">
                <i class="bi bi-check-circle me-2"></i>Submit Payment Verification
              </button>
            </div>

          </form>
        </div>
      </div>

    </div>
  </div>
</div>

<script>
function handleFileSelect(input) {
  const file = input.files[0];
  const defaultState = document.getElementById('uploadDefaultState');
  const previewState = document.getElementById('uploadPreviewState');
  const fileNameDisplay = document.getElementById('fileNameDisplay');
  const imagePreview = document.getElementById('imagePreview');

  if (file) {
    fileNameDisplay.textContent = file.name;
    
    if (file.type.startsWith('image/')) {
      const reader = new FileReader();
      reader.onload = function(e) {
        imagePreview.src = e.target.result;
        imagePreview.classList.remove('d-none');
      }
      reader.readAsDataURL(file);
    } else {
      imagePreview.classList.add('d-none');
    }

    defaultState.classList.add('d-none');
    previewState.classList.remove('d-none');
  }
}
</script>
@endsection