document.addEventListener('DOMContentLoaded', function() {
    // Elementos DOM
    const container = document.querySelector('.coverflow-container');
    const items = document.querySelectorAll('.coverflow-item');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const idInput = document.getElementById('customization-id');
    const submitBtn = document.getElementById('submit-btn');
    
    // Variables
    const totalItems = items.length;
    let activeIndex = 0;
    const itemWidth = 220;
    const zDistance = 180;
    const rotationAngle = 45;
    
    // Función para posicionar los elementos inicialmente
    function positionItems() {
        items.forEach((item, index) => {
            const zIndex = index === activeIndex ? 10 : 1;
            item.style.zIndex = zIndex;
            
            // Calcular desplazamiento (considerando centro, izquierda, o derecha)
            let xPos = 0;
            let zPos = 0;
            let rotateY = 0;
            let opacity = 1;
            
            if (index < activeIndex) {
                // Elementos a la izquierda
                xPos = -((activeIndex - index) * itemWidth);
                zPos = -zDistance;
                rotateY = rotationAngle;
                opacity = 1 - ((activeIndex - index) * 0.15);
                item.classList.add('left');
                item.classList.remove('right', 'active');
            } else if (index > activeIndex) {
                // Elementos a la derecha
                xPos = ((index - activeIndex) * itemWidth);
                zPos = -zDistance;
                rotateY = -rotationAngle;
                opacity = 1 - ((index - activeIndex) * 0.15);
                item.classList.add('right');
                item.classList.remove('left', 'active');
            } else {
                // Elemento activo (centro)
                item.classList.add('active');
                item.classList.remove('left', 'right');
                // Establecer ID para el formulario
                idInput.value = item.dataset.id;
                submitBtn.disabled = false;
            }
            
            // Aplicar transformaciones
            item.style.transform = `translateX(${xPos}px) translateZ(${zPos}px) rotateY(${rotateY}deg)`;
            item.style.opacity = Math.max(opacity, 0.4);
        });
    }
    
    // Función para navegar al siguiente elemento
    function goToNext() {
        if (activeIndex < totalItems - 1) {
            activeIndex++;
            positionItems();
        }
    }
    
    // Función para navegar al elemento anterior
    function goToPrev() {
        if (activeIndex > 0) {
            activeIndex--;
            positionItems();
        }
    }
    
    // Event listeners
    prevBtn.addEventListener('click', goToPrev);
    nextBtn.addEventListener('click', goToNext);
    
    // Click en los elementos para seleccionarlos
    items.forEach((item, index) => {
        item.addEventListener('click', () => {
            if (index !== activeIndex) {
                activeIndex = index;
                positionItems();
            }
        });
    });
    
    // Inicializar posiciones
    positionItems();
    
    // Opcional: Navegación con teclado
    document.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowLeft') {
            goToPrev();
        } else if (e.key === 'ArrowRight') {
            goToNext();
        }
    });
});