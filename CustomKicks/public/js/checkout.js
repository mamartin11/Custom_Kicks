// Jacobo
function animateCount({ from, to, duration = 2, separator = ',', direction = 'down', onEnd }) {
    const element = document.getElementById('counter');
    const start = performance.now();
    const range = Math.abs(to - from);
    const isCountingDown = direction === 'down';

    function formatNumber(value) {
        return value.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    function update(timestamp) {
        const progress = Math.min((timestamp - start) / (duration * 1000), 1);
        const current = isCountingDown
            ? from - (range * progress)
            : from + (range * progress);

        const formatted = separator ? formatNumber(current) : Math.round(current);
        element.textContent = formatted;

        if (progress < 1) {
            requestAnimationFrame(update);
        } else {
            element.textContent = separator ? formatNumber(to) : to;
            if (typeof onEnd === 'function') onEnd();
        }
    }

    requestAnimationFrame(update);
}

document.addEventListener('DOMContentLoaded', function () {
    const confirmYesBtn = document.getElementById('confirmYesBtn');
    const confirmBtn = document.getElementById('confirmBtn');
    const message = document.getElementById('confirmationMessage');

    confirmYesBtn.addEventListener('click', function () {
        // Obtener el descuento aplicado
        const discountValue = document.getElementById('discountValue').textContent || '0';
        
        // Enviar el descuento al backend para actualizar la orden y el budget
        fetch('/order/update-discount', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                discount: parseInt(discountValue)
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Descuento y budget actualizados correctamente');
                
                // Actualizar el mensaje de confirmación con información del budget
                const confirmationDiv = document.getElementById('confirmationMessage');
                confirmationDiv.innerHTML = `
                    <strong>¡Tu orden ha sido confirmada!</strong><br>
                    <small>
                        Total original: $${data.original_total ? data.original_total.toFixed(2) : '0.00'}<br>
                        Descuento aplicado: ${discountValue}% (-$${data.discount_amount ? data.discount_amount.toFixed(2) : '0.00'})<br>
                        Total final: $${data.final_total ? data.final_total.toFixed(2) : '0.00'}<br>
                        <strong>Tu nuevo budget: $${data.new_budget ? data.new_budget.toFixed(2) : '0.00'}</strong>
                    </small>
                `;

                // Actualizar el contador de 'Remaining money'
                const counterElement = document.getElementById('counter');
                if (counterElement && data.new_budget !== undefined) {
                    // Obtener el valor actual del contador, que es el budget ANTES del descuento y de este pedido
                    const budgetBeforeThisOrderAndDiscount = parseFloat(counterElement.dataset.budget);
                    // El valor 'from' para la animación debe ser el budget que se estaba mostrando como 'remaining', 
                    // que era el budget del usuario MENOS el total SIN descuento.
                    // El 'total' original sin descuento está en data.original_total
                    const remainingBeforeDiscount = budgetBeforeThisOrderAndDiscount - data.original_total;

                    animateCount({
                        from: remainingBeforeDiscount, // Start from remaining budget before discount
                        to: data.new_budget,      // Animate to the final new budget
                        duration: 1,              // Shorter animation as it's a secondary update
                        onEnd: () => {
                            // Adicionalmente, asegurarse que el texto final es el correcto
                            counterElement.textContent = (data.new_budget).toFixed(2);
                        }
                    });
                }
            } else {
                console.error('Error al actualizar:', data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });

        const modalEl = document.getElementById('confirmModal');
        const modalInstance = bootstrap.Modal.getInstance(modalEl);
        modalInstance.hide();

        message.classList.remove('d-none');

        confirmBtn.classList.remove('btn-primary');
        confirmBtn.classList.add('btn-dark');
        confirmBtn.textContent = 'Imprimir PDF';
        confirmBtn.removeAttribute('data-bs-toggle');
        confirmBtn.removeAttribute('data-bs-target');
        confirmBtn.setAttribute('onclick', "window.print()");
    });
});
