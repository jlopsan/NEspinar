document.addEventListener("DOMContentLoaded", () => {
    var modals = document.querySelectorAll('.modal');

    function applyScrollLogic(modal) {
        var imgs = modal.querySelectorAll('.img-wrapper img');
        var title = modal.querySelector('h2');
        var isScrolling = false;

        function scrollHandler() {
            if (!isScrolling) {
                isScrolling = true;
                requestAnimationFrame(() => {
                    for(let i = 0; i < imgs.length; i++) {
                        if (modal.scrollTop >= 10) {
                            imgs[i].classList.add('scrolled');
                            title.classList.add('title-scrolled');
                        } else {
                            imgs[i].classList.remove('scrolled');
                            title.classList.remove('title-scrolled');
                        }
                }
                    isScrolling = false;
                });
            }
        }

        modal.addEventListener('scroll', scrollHandler);
    }

    modals.forEach((modal) => {
        modal.addEventListener('shown.bs.modal', () => {
            applyScrollLogic(modal);
        });
    });
});
