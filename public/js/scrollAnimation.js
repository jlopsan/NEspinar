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
        var title = modal.querySelector('h2');
        var scrollThreshold = 50;
        var isScrolled = false;

        function scrollHandler() {
            if (!isScrolled && modal.scrollTop >= scrollThreshold) {
                isScrolled = true;
                addScrolled(imgs, title);
                carousel.addEventListener('mouseover', mouseOverHandler);
                carousel.addEventListener('mouseout', mouseOutHandler);
            } else if (modal.scrollTop < scrollThreshold) {
                isScrolled = false;
                removeScrolled(imgs, title); 
                carousel.removeEventListener('mouseover', mouseOverHandler);
                carousel.removeEventListener('mouseout', mouseOutHandler);
            }
        }

        function mouseOverHandler() {
            removeScrolled(imgs, title);
        }

        function mouseOutHandler() {
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
