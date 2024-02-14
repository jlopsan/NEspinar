function zoom(e) {
    var zoomer = e.currentTarget;
    var offsetX, offsetY;
    if (e.offsetX) {
        offsetX = e.offsetX;
        offsetY = e.offsetY;
    } else {
        offsetX = e.touches[0].pageX;
        offsetY = e.touches[0].pageY; // Corregir aquí
    }
    var x = offsetX / zoomer.offsetWidth * 100;
    var y = offsetY / zoomer.offsetHeight * 100; // Corregir aquí
    zoomer.style.backgroundPosition = x + '% ' + y + '%';
}
