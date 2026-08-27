@extends('layouts.front')
@section('content')
<style>

    .payment-card {
      border: 1px solid #e2e8f0;
      border-radius: 16px; /* Smooth professional white rounded radius */
      background: #ffffff;
      box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.05), 0 8px 10px -6px rgba(15, 23, 42, 0.05);
    }

    .card-header-custom {
      background-color: #10368e; /* Corporate Deep Navy */
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

    /* Soft modern input controls with smooth border radius */
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

    /* Primary Navy Action Button */
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
  <!-- SweetAlert2 CDN ကို Head ထဲတွင် ထည့်ပါ (မထည့်ရသေးပါက) -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Success Session ရှိပါက Popup Box ပြပေးပြီး OK နှိပ်ပါက Index သို့ ပြန်သွားရန် -->
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
              // OK နှိပ်လိုက်ရင် index route ဆီ ပြန်သွားမည်
              window.location.href = "{{ route('index') }}";
          }
      });
  </script>
  @endif
  <!-- Error & Success Alert Display -->
@if ($errors->any())
    <div class="alert alert-danger rounded-3 mb-4">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-7 col-md-9">
      
      <div class="payment-card">
        <!-- Professional Navy Header -->
        <div class="card-header-custom text-white d-flex justify-content-between align-items-center">
          <div>
            <h5 class="mb-1 fw-bold text-white"><i class="bi bi-shield-check me-2 text-primary"></i>Hostel Payment Verification</h5>
            <p class="mb-0 text-white-50 small">Official Portal for Room Rent & Utility Receipts</p>
          </div>
          <span class="badge bg-primary bg-opacity-20 text-white border border-primary-subtle px-3 py-2 rounded-pill">Resident Desk</span>
        </div>
        
        <div class="card-body p-4 p-md-5">
          <form action="{{ route('hostels.payment.store', $hostel_application->application_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="info-box mb-4">
              <span class="section-label"><i class="bi bi-person-badge me-1"></i> Resident Information</span>
              <div class="row g-3">
                <div class="col-md-6">
                  <label for="applicationID" class="form-label small fw-semibold text-secondary">Student ID</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-book-open-reader"></i> </span>
                    <input type="text" class="form-control" id="applicationID" name="applicationID" value="{{ $student_record->student->roll_no}}" placeholder="UCSPL-####" readonly>
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="roomNo" class="form-label small fw-semibold text-secondary">Name</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                    <input type="text" class="form-control" id="roomNo" name="roomNo" value="{{ $student_record->student->name }}" placeholder="Enter your name" readonly>
                  </div>
                </div>
              </div>
            </div>

            <!-- Receiver Details Section -->
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
                <label for="paymentMethod" class="form-label fw-semibold">Payment Method</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bi bi-wallet2"></i></span>
                  <select class="form-select" id="payment_method" name="payment_method" required>
                    <option value="" selected disabled>Select Payment Method</option>
                    <option value="KPay">KBZPay</option>
                    <option value="WavePay">WavePay</option>
                    <option value="bank_transfer">Bank Transfer (KBZ, AYA, CB)</option>
                    <option value="cash">Direct Cash</option>
                  </select>
                </div>
              </div>

              <div class="col-md-6">
                <label for="amount" class="form-label fw-semibold">Amount</label>
                <div class="input-group">
                  <span class="input-group-text fw-bold">MMK</span>
                  <input type="number" step="0.01" class="form-control" id="amount" name="amount" placeholder="0.00" required>
                </div>
              </div>
            </div>

            <!-- Transaction Details -->
            <div class="row g-3 mb-4">
              <div class="col-md-6">
                <label for="transactionNo" class="form-label fw-semibold">Transaction NO.</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bi bi-receipt-cutoff"></i></span>
                  <input type="text" class="form-control" id="transaction_no" name="transaction_no" placeholder="TXN-90218301" required>
                </div>
              </div>

              <div class="col-md-6">
                <label for="paymentDate" class="form-label fw-semibold">Payment Date</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bi bi-calendar-event"></i></span>
                  <input type="date" class="form-control" id="payment_date" name="payment_date" required>
                </div>
              </div>
            </div>

            <!-- Payment Slip Upload Area -->
            <div class="mb-4">
              <label class="form-label fw-semibold">Payment Slip Upload</label>
      
              <!-- Upload Wrapper -->
              <div class="file-upload-wrapper text-center p-4 border border-2 dashed rounded-3" 
                  style="cursor: pointer; background-color: #f8fafc;" 
                  onclick="document.getElementById('payment_slip').click();">
                
                  <!-- Default Upload State -->
                  <div id="uploadDefaultState">
                    <i class="bi bi-cloud-arrow-up text-primary fs-2"></i>
                    <p class="mb-1 mt-2 fw-medium text-dark">Click to upload slip or drag and drop</p>
                  </div>

                  <!-- Preview State (File ရွေးပြီးရင် ပေါ်လာမည့်နေရာ) -->
                  <div id="uploadPreviewState" class="d-none">
                    <img id="imagePreview" src="#" alt="Slip Preview" class="img-fluid rounded mb-2 d-none" style="max-height: 180px;">
                    <div class="d-flex align-items-center justify-content-center gap-2">
                      <i class="bi bi-file-earmark-check text-success fs-4"></i>
                      <span id="fileNameDisplay" class="fw-semibold text-dark"></span>
                    </div>
                    <small class="text-primary d-block mt-1">Click to change file</small>
                  </div>

                  <!-- Input File -->
                  <input class="d-none" type="file" id="payment_slip" name="payment_slip" accept="image/*,.pdf" required onchange="handleFileSelect(this)">
              </div>
          </div>

            <!-- Submit Button -->
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
@endsection
<script>
function handleFileSelect(input) {
  const file = input.files[0];
  const defaultState = document.getElementById('uploadDefaultState');
  const previewState = document.getElementById('uploadPreviewState');
  const fileNameDisplay = document.getElementById('fileNameDisplay');
  const imagePreview = document.getElementById('imagePreview');

  if (file) {
    // ဖိုင်နာမည် ပြပေးခြင်း
    fileNameDisplay.textContent = file.name;
    
    // ပုံဖြစ်ပါက Image Preview ပြပေးခြင်း
    if (file.type.startsWith('image/')) {
      const reader = new FileReader();
      reader.onload = function(e) {
        imagePreview.src = e.target.result;
        imagePreview.classList.remove('d-none');
      }
      reader.readAsDataURL(file);
    } else {
      // PDF ဖြစ်ပါက ပုံကို ဖျောက်ထားခြင်း
      imagePreview.classList.add('d-none');
    }

    // UI အခြေအနေ ပြောင်းလဲခြင်း
    defaultState.classList.add('d-none');
    previewState.classList.remove('d-none');
  }
}
</script>
