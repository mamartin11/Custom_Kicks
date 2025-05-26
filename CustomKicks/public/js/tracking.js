document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('trackingForm');
    const trackingResult = document.getElementById('trackingResult');
    const trackingError = document.getElementById('trackingError');

    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        const orderId = document.getElementById('orderId').value;

        try {
            const response = await fetch(`/api/orders/${orderId}/tracking`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            if (!response.ok) {
                throw new Error('Pedido no encontrado');
            }

            const data = await response.json();
            updateOrderInfo(data);
            updateTrackingSteps(data.status_dates);

            trackingResult.classList.remove('d-none');
            trackingError.classList.add('d-none');
        } catch (error) {
            console.error('Error:', error);
            trackingResult.classList.add('d-none');
            trackingError.classList.remove('d-none');
        }
    });

    function updateOrderInfo(data) {
        document.getElementById('trackingOrderId').textContent = data.order_id;
        
        const orderDate = new Date(data.order_date);
        document.getElementById('trackingOrderDate').textContent = orderDate.toLocaleString('es-ES', {
            year: 'numeric',
            month: '2-digit',
            day: '2-digit',
            hour: '2-digit',
            minute: '2-digit'
        });

        document.getElementById('trackingOrderTotal').textContent = `$${data.total.toFixed(2)}`;
        document.getElementById('trackingOrderDiscount').textContent = `${data.discount}%`;
        document.getElementById('trackingShippingType').textContent = 
            data.shipping_type === 'express' ? 'Envío Express' : 'Envío Estándar';
    }

    function updateTrackingSteps(statusDates) {
        const steps = document.querySelectorAll('.tracking-step');
        const statusKeys = ['confirmed', 'preparation', 'transit', 'delivery'];

        steps.forEach((step, index) => {
            const dateElement = step.querySelector('small');
            const date = statusDates[statusKeys[index]];

            if (date) {
                const statusDate = new Date(date);
                dateElement.textContent = statusDate.toLocaleString('es-ES', {
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit',
                    hour: '2-digit',
                    minute: '2-digit'
                });
                step.classList.add('completed');
            } else {
                dateElement.textContent = 'Pendiente';
                step.classList.remove('completed');
            }
        });
    }
}); 