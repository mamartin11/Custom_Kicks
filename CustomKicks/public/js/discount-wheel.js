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
    const counterElement = document.getElementById('counter');
    const userBudget = parseFloat(document.getElementById('counter').getAttribute('data-budget') || '0');
 
    let angles = [0, 90, 180, 270];
    let discounts = [10, 20, 50, 0]; // 0 significa "No ganaste"
    let hasSpun = false; // Variable de control para evitar múltiples giros
 
    spinButton.addEventListener('click', function () {
        // Verificar si ya se ha girado la ruleta
        if (hasSpun) {
            return; // No hacer nada si ya se giró
        }
        
        // Deshabilitar el botón inmediatamente al hacer clic
        spinButton.disabled = true;
        spinButton.textContent = 'Girando...';
        spinButton.classList.add('disabled');
        hasSpun = true;
        
        let randomIndex = Math.floor(Math.random() * angles.length);
        let selectedAngle = angles[randomIndex];
        let selectedDiscount = discounts[randomIndex];
 
        wheel.style.transform = `rotate(${360 * 5 + selectedAngle}deg)`;
 
        setTimeout(() => {
            if (selectedDiscount === 0) {
                resultText.textContent = "Sin descuento esta vez 😢";
            } else {
                resultText.textContent = `¡Ganaste ${selectedDiscount}% de descuento! 🎉`;
            }
 
            discountValue.textContent = selectedDiscount;
 
            let totalBefore = parseFloat(totalBeforeDiscount.textContent.replace(',', ''));
            let newTotal = totalBefore - (totalBefore * selectedDiscount / 100);
            totalAfterDiscount.textContent = newTotal.toFixed(2);
            
            // Update remaining budget based on discounted price
            const userBudgetValue = parseFloat(document.querySelector('[data-budget]').getAttribute('data-budget'));
            const newRemainingBudget = userBudgetValue - newTotal;
            counterElement.textContent = newRemainingBudget.toFixed(2);
 
            // Ocultar "Total" y mostrar información de descuento
            totalSection.classList.add('d-none');
            discountInfo.classList.remove('d-none');
 
            // Ocultar el botón "Spin the Wheel" y mostrar "Confirm Order"
            document.getElementById('spinWheelBtn').classList.add('d-none');
            confirmBtn.classList.remove('d-none');
            
            // Cambiar el texto del botón para indicar que ya se usó
            spinButton.textContent = '¡Ya giraste la ruleta!';
        }, 3000);
    });
});