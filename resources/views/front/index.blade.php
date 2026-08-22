@extends('layouts.front')
@section('content')
   <section id="home" class="hero-section text-dark d-flex align-items-center py-5">
        <div class="container-fluid px-4 px-lg-5">
            <div class="row align-items-center">
                <div class="col-lg-6"> 
                    <span class="badge bg-primary px-3 py-2 rounded-pill fw-semibold mb-3">
                        <i class="bi bi-calendar-check me-1"></i> Academic Year 2026 Open
                    </span>
                    <h1 class="display-4 fw-bold mb-3">Apply for University Hostel Accommodation</h1>
                    <p class="lead text-dark mb-4">
                        ကျောင်းသား/ကျောင်းသူများအတွက် လုံခြုံစိတ်ချရပြီး အဆင်ပြေချောမွေ့သော အဆောင်အခန်းများကို လွယ်ကူစွာ စုံစမ်းကြည့်ရှုပြီး Online မှတစ်ဆင့် တိုက်ရိုက် လျှောက်ထားနိုင်ပါသည်။
                    </p>
                    <a href="#hostels" class="btn btn-primary btn-lg rounded-pill px-4">အဆောင်များ ကြည့်မည်</a>
                </div>
            </div>
        </div>
    </section>

    <section id="features" class="features-section">
        <div class="container text-center">
            <!-- Section Title & Subtitle -->
            <h2 class="fw-bold mb-2" style="font-size: 2.2rem;">Why Choose Our Hostels?</h2>
            <p class="text-secondary mb-5 fs-5">
                ကျောင်းသား/သူများ စိတ်အေးချမ်းသာစွာ ပညာသင်ကြားနိုင်ရန် အပြည့်အဝ ဖန်တီးပေးထားပါသည်။
            </p>
            <!-- Cards Grid -->
            <div class="row g-4 justify-content-center">
                
                <!-- High-Speed Wi-Fi -->
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="icon-box icon-wifi">
                            <i class="fa-solid fa-wifi"></i>
                        </div>
                        <h3 class="feature-title">High-Speed Wi-Fi</h3>
                        <p class="feature-text">
                        စာလေ့လာရန်နှင့် အင်တာနက်အသုံးပြုရန်အတွက် မြန်နှုန်းမြင့် Wi-Fi စနစ် တပ်ဆင်ပေးထားပါသည်။
                        </p>
                    </div>
                </div>

                <!-- 24/7 Security -->
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="icon-box icon-security">
                            <i class="fa-solid fa-user-shield"></i>
                        </div>
                        <h3 class="feature-title">24/7 Security</h3>
                        <p class="feature-text">
                        CCTV ကင်မရာများနှင့် လုံခြုံရေးဝန်ထမ်းများဖြင့် ၂၄ နာရီပတ်လုံး လုံခြုံရေးရယူပေးထားပါသည်။
                        </p>
                    </div>
                </div>

                <!-- Power Backup -->
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="icon-box icon-power">
                            <i class="fa-solid fa-bolt"></i>
                        </div>
                        <h3 class="feature-title">Power Backup</h3>
                        <p class="feature-text">
                        မီးပျက်ချိန်များတွင်လည်း စာကျက်မပျက်စေရန် မီးစက်/Generator စနစ်များ ထောက်ပံ့ထားပါသည်။
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
        <!-- Hostels List Section (Hostel Table Basis) -->
        <section id="hostels" class="py-5 bg-light">
            <div class="container py-4">
                <div class="text-center mb-5">
                    <h6 class="text-primary fw-bold text-uppercase">Hostel Selection</h6>
                    <h2 class="fw-bold">Available Student Hostels</h2>
                    <p class="text-muted">ကျောင်းသား/သူများ လျှောက်ထားနိုင်သည့် အဆောင်များ</p>
                </div>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100 hostel-card">
                            <img src="https://images.unsplash.com/photo-1555854877-bab0e564b8d5?auto=format&fit=crop&q=80&w=600" class="card-img-top" alt="Hostel A">
                            <div class="card-body p-4 d-flex flex-column">
                                <h5 class="fw-bold">Aung San Hostel (Male)</h5>
                                <p class="text-muted small">Capacity: 300 Students</p>
                                <div class="mt-auto">
                                    <button class="btn btn-primary w-100 rounded-pill btn-apply" data-hostel-id="1" data-hostel-name="Aung San Hostel (Male)">Apply Hostel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100 hostel-card">
                            <img src="https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?auto=format&fit=crop&q=80&w=600" class="card-img-top" alt="Hostel B">
                            <div class="card-body p-4 d-flex flex-column">
                                <h5 class="fw-bold">Inya Hostel (Female)</h5>
                                <p class="text-muted small">Capacity: 250 Students</p>
                                <div class="mt-auto">
                                    <button class="btn btn-primary w-100 rounded-pill btn-apply" data-hostel-id="2" data-hostel-name="Inya Hostel (Female)">Apply Hostel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100 hostel-card">
                            <img src="https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?auto=format&fit=crop&q=80&w=600" class="card-img-top" alt="Hostel C">
                            <div class="card-body p-4 d-flex flex-column">
                                <h5 class="fw-bold">Thiri Hostel (Female)</h5>
                                <p class="text-muted small">Capacity: 200 Students</p>
                                <div class="mt-auto">
                                    <button class="btn btn-primary w-100 rounded-pill btn-apply" data-hostel-id="3" data-hostel-name="Thiri Hostel (Female)">Apply Hostel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Application Modal (Hostel Application Form) -->
        <div class="modal fade" id="applicationModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title fw-bold" id="modalHostelTitle">Hostel Application Form</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4">
                        <form id="hostelAppForm">
                            <input type="hidden" id="selectedHostelID" name="hostelID">
                            
                            <div class="row g-3">
                                <!-- Student Academic Info -->
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Academic Year</label>
                                    <select class="form-select" required>
                                        <option value="1">2025-2026 (Current)</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Year</label>
                                    <select class="form-select" required>
                                        <option value="">Select Year...</option>
                                        <option value="1">First Year</option>
                                        <option value="2">Second Year</option>
                                        <option value="3">Third Year</option>
                                        <option value="4">Final Year</option>
                                    </select>
                                </div>

                                <!-- Student Personal Info -->
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Roll No</label>
                                    <input type="text" class="form-control" placeholder="e.g., 5CS-10" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Student Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Full Name" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">NRC</label>
                                    <input type="text" class="form-control" placeholder="12/XXX(N)000000" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Phone</label>
                                    <input type="tel" class="form-control" placeholder="09xxxxxxxxx" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-bold">Reason for Application</label>
                                    <textarea class="form-control" rows="2" placeholder="Why do you need hostel accommodation?"></textarea>
                                </div>
                            </div>

                            <div class="alert alert-info mt-3 mb-0 fs-7">
                                <i class="bi bi-info-circle me-1"></i> လျှောက်လွှာ တင်သွင်းပြီးပါက Status မှာ <strong>Pending</strong> ဖြစ်မည်ဖြစ်ပြီး Admin မှ အတည်ပြုပြီးမှသာ Room & Payment ဆက်လက်လုပ်ဆောင်ရပါမည်။
                            </div>

                            <div class="mt-4 text-end">
                                <button type="button" class="btn btn-light rounded-pill px-4 me-2" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary rounded-pill px-4">Submit Application</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection