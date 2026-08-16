// js/main.js
document.addEventListener("DOMContentLoaded", function() {
    const roomCards = document.querySelectorAll(".room-card");
    const selectedRoomInput = document.getElementById("selected_room");

    roomCards.forEach(card => {
        card.addEventListener("click", function() {
            // အရင်ရွေးထားတဲ့ ကတ်တွေရဲ့ selected class ကို ဖြုတ်
            roomCards.forEach(c => c.classList.remove("selected"));
            
            // အခုနှိပ်တဲ့ကတ်ကို class ထည့်
            this.classList.add("selected");
            
            // Room No ကို ယူပြီး Form ထဲ ထည့်ပေးခြင်း
            const roomNo = this.getAttribute("data-room-no");
            if (selectedRoomInput) {
                selectedRoomInput.value = roomNo;
                // Form ဆီကို scroll ဆွဲပေးခြင်း
                document.getElementById("booking-form-section").scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
});