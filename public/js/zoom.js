document.addEventListener("DOMContentLoaded", function() {
    let modals = document.querySelectorAll('.portfolio-modal');

    modals.forEach(function(modal) {
        modal.addEventListener('show.bs.modal', function() {
            let imgWrapper = modal.querySelector('.modal-content .img-wrapper');
            let img = imgWrapper.querySelector('img');

            
        });
    });
});