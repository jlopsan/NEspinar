document.addEventListener("DOMContentLoaded", () => {
    var modals = document.querySelectorAll('.modal');

    function applyScrollLogic(modal) {
        var imgs = modal.querySelectorAll('.img-wrapper img');
        var title = modal.querySelector('h2');
        var scrollThreshold = 10;
        var isScrolled = false;

        function scrollHandler() {
            if (!isScrolled && modal.scrollTop >= scrollThreshold) {
                isScrolled = true;
                imgs.forEach(img => img.classList.add('scrolled'));
                title.classList.add('title-scrolled');
            } else if (isScrolled && modal.scrollTop < scrollThreshold) {
                isScrolled = false;
                imgs.forEach(img => img.classList.remove('scrolled'));
                title.classList.remove('title-scrolled');
            }
        }

        modal.addEventListener('scroll', scrollHandler);

        modal.scrollTop = 1;
        scrollHandler(); 
    }

    modals.forEach((modal) => {
        modal.addEventListener('shown.bs.modal', () => {
            applyScrollLogic(modal);
        });
    });



});
