document.addEventListener('DOMContentLoaded', () => {
    const appModal = new bootstrap.Modal(document.getElementById('applicationModal'));
    const applyButtons = document.querySelectorAll('.btn-apply');
    const modalTitle = document.getElementById('modalHostelTitle');
    const selectedHostelInput = document.getElementById('selectedHostelID');

    applyButtons.forEach(btn => {
        btn.addEventListener('click', (e) => {
            const hostelID = e.target.getAttribute('data-hostel-id');
            const hostelName = e.target.getAttribute('data-hostel-name');

            selectedHostelInput.value = hostelID;
            modalTitle.innerText = `Apply for ${hostelName}`;
            appModal.show();
        });
    });

    const appForm = document.getElementById('hostelAppForm');
    appForm.addEventListener('submit', (e) => {
        e.preventDefault();

        alert('အဆောင်လျှောက်လွှာ အောင်မြင်စွာ တင်သွင်းပြီးပါပြီ။ Admin မှ Approved လုပ်သည်အထိ စောင့်ဆိုင်းပေးပါ။ (Status: Pending)');
        
        appModal.hide();
        appForm.reset();
    });

});