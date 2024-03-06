document.addEventListener("DOMContentLoaded", () => {
    var modals = document.querySelectorAll('.modal');

    // Define las funciones de addScrolled y removeScrolled
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
        var flecha = modal.querySelector('.flecha');
        var title = modal.querySelector('h2');
        var scrollThreshold = 50;
        var isScrolled = false;
        var isImageLarge = false;

        function toggleScrollState() {
            isImageLarge = !isImageLarge;

            if (isImageLarge) {
                flecha.innerHTML = '<i class="fa-solid fa-angles-up"></i>';
                addScrolled(imgs, title);
                if (modal.scrollTop < scrollThreshold) {
                    modal.scrollTop = scrollThreshold + 10;
                }
            } else {
                flecha.innerHTML = '<i class="fa-solid fa-angles-down"></i>';
                removeScrolled(imgs, title);
            }
        }

        function scrollHandler() {
            if (!isScrolled && modal.scrollTop >= scrollThreshold) {
                isScrolled = true;
                isImageLarge = true;
                addScrolled(imgs, title);
                flecha.innerHTML = '<i class="fa-solid fa-angles-up"></i>';
            } else if (modal.scrollTop < scrollThreshold) {
                isScrolled = false;
                isImageLarge = false;
                removeScrolled(imgs, title);
                flecha.innerHTML = '<i class="fa-solid fa-angles-down"></i>';
            }
        }

        // Agregar el event listener al botón de flecha
        flecha.addEventListener('click', toggleScrollState);

        // Agregar el event listener al modal cuando se muestra
        modal.addEventListener('shown.bs.modal', () => {
            modal.addEventListener('scroll', scrollHandler);
        });

        // Eliminar el event listener del modal cuando se oculta
        modal.addEventListener('hidden.bs.modal', () => {
            modal.removeEventListener('scroll', scrollHandler);
        });

        // Inicializar el estado del scroll
        scrollHandler();
    }

    // Aplicar la lógica de scroll a cada modal
    modals.forEach((modal) => {
        applyScrollLogic(modal);
    });
});
