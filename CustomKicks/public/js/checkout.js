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
