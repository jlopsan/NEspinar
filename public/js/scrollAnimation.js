document.addEventListener("DOMContentLoaded", () => {
    var modals = document.querySelectorAll('.modal');

    // Definir funciones de flecha para addScrolled y removeScrolled
    const addScrolled = (imgs, title) => {
        imgs.forEach(img => img.classList.add('scrolled'));
        title.classList.add('title-scrolled');
    };

    const removeScrolled = (imgs, title) => {
        imgs.forEach(img => img.classList.remove('scrolled'));
        title.classList.remove('title-scrolled');
    };

    function applyScrollLogic(modal) {
        var imgs = modal.querySelectorAll('.img-wrapper img');
        var carousel = modal.querySelector('.carousel');
        var campos = modal.querySelector('.items');
        var title = modal.querySelector('h2');
        var scrollThreshold = 50;
        var isScrolled = false;

        function scrollHandler() {
            campos.addEventListener('click', mouseOutHandler);
            if (!isScrolled && modal.scrollTop >= scrollThreshold) {
                isScrolled = true;
                addScrolled(imgs, title);
                carousel.addEventListener('click', mouseOverHandler);
            } else if (modal.scrollTop < scrollThreshold) {
                isScrolled = false;
                removeScrolled(imgs, title); 
                carousel.removeEventListener('click', mouseOverHandler);
            }
        }

        function mouseOverHandler() {
            removeScrolled(imgs, title);
        }

        function mouseOutHandler() {
            if(modal.scrollTop < scrollThreshold) {
                modal.scrollTop = scrollThreshold + 1;
            }
            addScrolled(imgs, title);
        }

        modal.addEventListener('scroll', scrollHandler);

        // Eliminar los event listeners cuando se cierra el modal
        modal.addEventListener('hidden.bs.modal', () => {
            modal.removeEventListener('scroll', scrollHandler);
            carousel.removeEventListener('mouseover', mouseOverHandler);
            carousel.removeEventListener('mouseout', mouseOutHandler);
        });

        scrollHandler(); 
    }

    modals.forEach((modal) => {
        modal.addEventListener('shown.bs.modal', () => {
            applyScrollLogic(modal);
        });
    });
});
