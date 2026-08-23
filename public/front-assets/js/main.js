document.addEventListener('DOMContentLoaded', () => {
    const appModalElement = document.getElementById('applicationModal');
    if (!appModalElement) return; // Modal မရှိပါက Script ဆက်မလုပ်ဆောင်စေရန်

    const appModal = new bootstrap.Modal(appModalElement);
    const applyButtons = document.querySelectorAll('.btn-apply');
    const modalTitle = document.getElementById('modalHostelTitle');
    const selectedHostelInput = document.getElementById('selectedHostelID');

    applyButtons.forEach(btn => {
        btn.addEventListener('click', (e) => {
            const hostelID = e.currentTarget.getAttribute('data-hostel-id');
            const hostelName = e.currentTarget.getAttribute('data-hostel-name');

            if (selectedHostelInput) selectedHostelInput.value = hostelID;
            if (modalTitle) modalTitle.innerText = `Apply for ${hostelName}`;
            
            appModal.show();
        });
    });

    // Form submit ပြုလုပ်ချိန်တွင် e.preventDefault() ကို ဖယ်ရှားပြီး Controller သို့ ပို့ဆောင်မည်
    const appForm = document.getElementById('hostelAppForm');
    if (appForm) {
        appForm.addEventListener('submit', function () {
            // Submit ခလုတ်ကို နှစ်ခါ မနှိပ်နိုင်စေရန် Disable လုပ်ခြင်း
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerText = 'Submitting...';
            }
        });
    }
});