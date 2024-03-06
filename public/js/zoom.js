function zoom(e) {
    e.preventDefault();
    let zoomer = e.currentTarget;
    let offsetX, offsetY;
    
    if (e.type === 'touchmove') {
        let touch = e.touches[0];
        let rect = zoomer.getBoundingClientRect();
        offsetX = touch.clientX - rect.left;
        offsetY = touch.clientY - rect.top;
    } else {
        offsetX = e.offsetX || e.clientX - zoomer.getBoundingClientRect().left;
        offsetY = e.offsetY || e.clientY - zoomer.getBoundingClientRect().top;
    }
    
    let x = offsetX / zoomer.offsetWidth * 100;
    let y = offsetY / zoomer.offsetHeight * 100;

    // Limita el zoom para que no se salga de los límites de la imagen
    x = Math.min(100, Math.max(0, x));
    y = Math.min(100, Math.max(0, y));

    zoomer.style.backgroundPosition = x + '% ' + y + '%';
}