// Jacobo
document.addEventListener('DOMContentLoaded', function () {
    const spinButton = document.getElementById('spinButton');
    const wheel = document.getElementById('wheel');
    const resultText = document.getElementById('discountResult');
    const discountValue = document.getElementById('discountValue');
    const totalAfterDiscount = document.getElementById('totalAfterDiscount');
    const totalBeforeDiscount = document.getElementById('total');
    const totalSection = document.getElementById('totalSection'); // Sección de "Total"
    const discountInfo = document.getElementById('discount-info');
    const confirmBtn = document.getElementById('confirmBtn');
 
    let angles = [0, 90, 180, 270];
    let discounts = [10, 20, 50, 0]; // 0 significa "No ganaste"
 
    spinButton.addEventListener('click', function () {
        let randomIndex = Math.floor(Math.random() * angles.length);
        let selectedAngle = angles[randomIndex];
        let selectedDiscount = discounts[randomIndex];
 
        wheel.style.transform = `rotate(${360 * 5 + selectedAngle}deg)`;
 
        setTimeout(() => {
            if (selectedDiscount === 0) {
                resultText.textContent = "No discount this time 😢";
            } else {
                resultText.textContent = `You won ${selectedDiscount}% off! 🎉`;
            }
 
            discountValue.textContent = selectedDiscount;
 
            let totalBefore = parseFloat(totalBeforeDiscount.textContent.replace(',', ''));
            let newTotal = totalBefore - (totalBefore * selectedDiscount / 100);
            totalAfterDiscount.textContent = newTotal.toFixed(2);
 
            // Ocultar "Total" y mostrar información de descuento
            totalSection.classList.add('d-none');
            discountInfo.classList.remove('d-none');
 
            // Ocultar el botón "Spin the Wheel" y mostrar "Confirm Order"
            document.getElementById('spinWheelBtn').classList.add('d-none');
            confirmBtn.classList.remove('d-none');
        }, 3000);
    });
});