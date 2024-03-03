


// QUe se puedan elegir diferentes tamaños de las fotos (Con un modal)
// Que se pueda escoger el titulo por campo;
// https://rawgit.com/MrRio/jsPDF/master/docs/index.html


function agregarBanner(doc, opcionesJS) {
    doc.setFont('NotoSerif-VariableFont_wdth,wght', 'normal');
    doc.setFontSize(8);
    let margenBanner = 25;

    doc.text(opcionesJS.home_titulo, 30, 20);

    let longitudST = doc.getStringUnitWidth(opcionesJS.home_subtitulo) * doc.internal.getFontSize();
    let posicionXSubtitulo = doc.internal.pageSize.getWidth() - longitudST - margenBanner;

    doc.text(opcionesJS.home_subtitulo, posicionXSubtitulo, 20);
    doc.line(0, 30, doc.internal.pageSize.getWidth(), 30);
}


function ponerSubtitulo(doc, items, cordenaday){
    let anchuraDoc = doc.internal.pageSize.getWidth();
    doc.setFontSize(15);
    let longItem = doc.getStringUnitWidth(`${items[0].pivot.value.replace(/<p>/gi, '').replace(/<\/p>/gi, '').replace(/\./g, '')}`) * doc.internal.getFontSize(); //Calcula el tamaño del subtitulo
    let xitem = ((anchuraDoc / 2) - (longItem / 2));

    if (doc.getTextDimensions(`${items[0].pivot.value}`).w < anchuraDoc) {
        doc.text(`${items[0].pivot.value.replace(/<p>/gi, '').replace(/<\/p>/gi, '').replace(/\./g, '')}`, xitem, cordenaday);
    }
    else {
        let arrayItem = doc.splitTextToSize(items[0].pivot.value.replace(/<p>/gi, '').replace(/<\/p>/gi, '').replace(/\./g, ''),anchuraDoc - 100)
        
        for (let i = 0; i < arrayItem.length; i++) {
            let longitudMitad = doc.getStringUnitWidth(arrayItem[i])* doc.internal.getFontSize();
            let xitem = ((anchuraDoc/2)-(longitudMitad/2))
            doc.text(`${arrayItem[i]}`,xitem,cordenaday);
            cordenaday+= 20;
        }
    }
}
window.jsPDF = window.jspdf.jsPDF;      // Debe ser una variable global para que funcione html2canvas

// Genera un PDF con los datos del producto y la imagen del carrusel.
// Recibe como parámetros el JSON del producto, el ID de la imagen en el árbol DOM, un JSON con los items del producto y el nombre de la categoría.
function imprimir(json_product, image_id, json_items, category, opciones) {

    // Convertimos los JSON a objetos
    let product = JSON.parse(json_product);
    let items = JSON.parse(json_items);
    let opcionesJS = JSON.parse(opciones);


    // GESTIONAMOS LAS VARAIBLES QUE NECESITAMOS PARA EL PDF -----------------------------------------------
    let doc = new jsPDF('portrait', 'pt', 'a4');
    let fontName = "NotoSerif-VariableFont_wdth,wght";
    let fontNameTitulos = "Cinzel-VariableFont_wght";
    doc.addFont('/fonts/' + fontName + '.ttf', fontName, 'normal'); // Es necesario usar una fuente con soporte unicode y poner el archivo ttf en /public/fonts
    doc.addFont('/fonts/' + fontName + '.ttf', fontName, 'medium');
    doc.addFont('/fonts/' + fontNameTitulos + '.ttf', fontNameTitulos, 'normal');
    let interlineado = 30;
    const anchuraDoc = doc.internal.pageSize.getWidth();
    const alturaDoc = doc.internal.pageSize.getHeight();
    const anchuraDocWM = anchuraDoc - 60
    const margenEntreItem = 10;


    // BANNER ARRIBA---------------------------------------------------------------------------------------
    agregarBanner(doc,opcionesJS);


    // TITULO DEL PRODUCTO---------------------------------------------------------------------------------
    doc.setFont(fontNameTitulos);
    doc.setFontSize(25);

    let longitudProductName = doc.getStringUnitWidth(`${product.name}`) * doc.internal.getFontSize(); //Calcula el tamaño del titulo
    let xProdName = ((anchuraDoc / 2) - (longitudProductName / 2)) //Calcula la coordenada de inicio del titulo para que este siempre centrado

    if (doc.getTextDimensions(`${product.name}`).w < anchuraDoc - 50) {
        doc.text(`${product.name}`, xProdName, 60);
        //SUBTITULO
        ponerSubtitulo(doc,items,90)


    } else {
        let arrayTitulo = doc.splitTextToSize(product.name,anchuraDoc - 100)
        let ytitulo = 60;
        for (let i = 0; i < arrayTitulo.length; i++) {
            let longitudMitad = doc.getStringUnitWidth(arrayTitulo[i])* doc.internal.getFontSize();
            let xtitulo = ((anchuraDoc/2)-(longitudMitad/2))
            doc.text(`${arrayTitulo[i]}`,xtitulo,ytitulo);
            ytitulo+= interlineado;
        }
        //SUBTITULO
        ponerSubtitulo(doc,items,120)
        
    };

    // ---------------------------------------------------------------------------------------------------FOTOGRAFIAS-------------------------------------------------------------------------
    let imagen = document.getElementById(image_id);
    let anchoOriginalPT = imagen.naturalWidth / 1.3;
    let alturaOriginalPT = imagen.naturalHeight / 1.3;
    let ratio = anchoOriginalPT / alturaOriginalPT;

    if (anchoOriginalPT > alturaOriginalPT) { //-------------------------------------------------------------LOGICA FOTOGRAFIA MAS ANCHA QUE ALTA------------------------------------------
        let anchuraDeseada = 320;
        let alturaDeseada = anchuraDeseada / ratio;
        let xImagen = ((anchuraDoc / 2) - (anchuraDeseada / 2));
        doc.addImage(imagen, "JPG", xImagen, 180, anchuraDeseada, alturaDeseada);

        doc.setFontSize(12)
        doc.setFont(fontName);

        let cordenada = alturaDeseada + 190 + interlineado;

        for (var i = 0; i < items.length; i++) {            //--------------------------BUCLE DE TODOS LOS ITEMS-----------------------------------------
            
            let x = 70;

            if (cordenada + interlineado < alturaDoc - 50) {  

                let ysiguiente = cordenada;
                doc.setFont(fontName, "bold");
                doc.setFontSize(14);
                doc.text(`${items[i].name} :`, 56.68, ysiguiente);
                doc.setFontSize(12);
                doc.setFont(fontName, "normal");
                ysiguiente += interlineado;
                

                // let longitudC = doc.getTextDimensions(`${items[i].pivot.value.replace(/<p>/gi, '').replace(/<\/p>/gi, '')}`).w

                arrayP = items[i].pivot.value.split("</p>");
                arrayP.pop();

                for (let k = 0; k < arrayP.length; k++) {

                    let longitudC = doc.getTextDimensions(`${arrayP[k].replace(/<p>/gi, '').replace(/<\/p>/gi, '')}`).w

                    if (longitudC > anchuraDocWM - 50) {

                        arrayLineas = doc.splitTextToSize(arrayP[k].replace(/<p>/gi, '').replace(/<\/p>/gi, ''), anchuraDocWM - 50);

                        for (let z = 0; z < arrayLineas.length; z++) {

                            if (ysiguiente+interlineado < alturaDoc - 50){
                                doc.text(`${arrayLineas[z]}`, x, ysiguiente);
                                ysiguiente += interlineado;
                                x = 56;
                            }
                            else{
                                doc.addPage();
                                agregarBanner(doc,opcionesJS);

                                doc.setFontSize(12)
                                doc.setFont(fontName);

                                let ysiguiente = 90;
                                doc.setFont(fontName, "bold");
                                doc.text(`${items[i].name} :`, 56.68, ysiguiente);
                                doc.setFont(fontName, "normal");
                                ysiguiente += interlineado;

                                arrayP = items[i].pivot.value.split("</p>");
                                arrayP.pop();

                                for (let k = 0; k < arrayP.length; k++) {

                                    let longitudC = doc.getTextDimensions(`${arrayP[k].replace(/<p>/gi, '').replace(/<\/p>/gi, '')}`).w

                                    if (longitudC > anchuraDocWM - 50) {
                                        arrayLineas = doc.splitTextToSize(arrayP[k].replace(/<p>/gi, '').replace(/<\/p>/gi, ''), anchuraDocWM - 50);
                                        for (let z = 0; z < arrayLineas.length; z++) {
                                            doc.text(`${arrayLineas[z]}`, x, ysiguiente);
                                            ysiguiente += interlineado;
                                            x = 56;
                                        }
                                    
                                    }
                                    else {
                                        doc.text(`${arrayP[k].replace(/<p>/gi, '').replace(/<\/p>/gi, '')}`, 70, ysiguiente);
                                        ysiguiente += interlineado;
                                    }

                                } 
                                cordenada = ysiguiente +margenEntreItem

                            }
                          

                        }
                       
                    }
                    else {

                        doc.text(`${arrayP[k].replace(/<p>/gi, '').replace(/<\/p>/gi, '')}`, 70, ysiguiente);
                        
                        ysiguiente += interlineado;

                    }

                } 
                cordenada = ysiguiente +margenEntreItem
            } else {

                doc.addPage();
                agregarBanner(doc,opcionesJS);

                doc.setFontSize(12)
                doc.setFont(fontName);

                let ysiguiente = 90;
                doc.setFont(fontName, "bold");
                doc.text(`${items[i].name} :`, 56.68, ysiguiente);
                doc.setFont(fontName, "normal");
                ysiguiente += interlineado;

                arrayP = items[i].pivot.value.split("</p>");
                arrayP.pop();

                for (let k = 0; k < arrayP.length; k++) {

                    let longitudC = doc.getTextDimensions(`${arrayP[k].replace(/<p>/gi, '').replace(/<\/p>/gi, '')}`).w

                    if (longitudC > anchuraDocWM - 50) {
                        arrayLineas = doc.splitTextToSize(arrayP[k].replace(/<p>/gi, '').replace(/<\/p>/gi, ''), anchuraDocWM - 50);
                        for (let z = 0; z < arrayLineas.length; z++) {
                            if (ysiguiente+interlineado < alturaDoc - 50){
                                doc.text(`${arrayLineas[z]}`, x, ysiguiente);
                                ysiguiente += interlineado;
                                x = 56;
                            }
                            else{
                                doc.addPage();
                                agregarBanner(doc,opcionesJS);

                                doc.setFontSize(12)
                                doc.setFont(fontName);

                                let ysiguiente = 90;
                                doc.setFont(fontName, "bold");
                                doc.text(`${items[i].name} :`, 56.68, ysiguiente);
                                doc.setFont(fontName, "normal");
                                ysiguiente += interlineado;

                                arrayP = items[i].pivot.value.split("</p>");
                                arrayP.pop();

                                for (let k = 0; k < arrayP.length; k++) {

                                    let longitudC = doc.getTextDimensions(`${arrayP[k].replace(/<p>/gi, '').replace(/<\/p>/gi, '')}`).w

                                    if (longitudC > anchuraDocWM - 50) {
                                        arrayLineas = doc.splitTextToSize(arrayP[k].replace(/<p>/gi, '').replace(/<\/p>/gi, ''), anchuraDocWM - 50);
                                        for (let z = 0; z < arrayLineas.length; z++) {
                                            doc.text(`${arrayLineas[z]}`, x, ysiguiente);
                                            ysiguiente += interlineado;
                                            x = 56;
                                        }
                                    
                                    }
                                    else {
                                        doc.text(`${arrayP[k].replace(/<p>/gi, '').replace(/<\/p>/gi, '')}`, 70, ysiguiente);
                                        ysiguiente += interlineado;
                                    }

                                } 
                                cordenada = ysiguiente +margenEntreItem

                            }
                        }
                       
                    }
                    else {
                        doc.text(`${arrayP[k].replace(/<p>/gi, '').replace(/<\/p>/gi, '')}`, 70, ysiguiente);
                        ysiguiente += interlineado;
                    }

                } 
                cordenada = ysiguiente +margenEntreItem
            }

        }

    }
    if (anchoOriginalPT < alturaOriginalPT) { //-----------------------------------------------------LOGICA FOTOGRAFIA MAS ALTA QUE ANCHA---------------------------------------------
        let alturaDeseada = 400;
        let anchuraDeseada = alturaDeseada * ratio;
        let xImagen = ((anchuraDoc / 2) - (anchuraDeseada / 2));
        doc.addImage(imagen, "JPG", xImagen, 180, anchuraDeseada, alturaDeseada);

        doc.setFontSize(12)
        doc.setFont(fontName);

        let cordenada = alturaDeseada + 190 + interlineado ;

        for (var i = 0; i < items.length; i++) {
            let x = 70;
            if (cordenada + interlineado + 30 < alturaDoc) {

                let ysiguiente = cordenada;
                doc.setFont(fontName, "bold");

                doc.text(`${items[i].name} :`, 56.68, ysiguiente);
                doc.setFont(fontName, "normal");
                ysiguiente += interlineado;

                arrayP = items[i].pivot.value.split("</p>");
                arrayP.pop();

                for (let k = 0; k < arrayP.length; k++) {

                    let longitudC = doc.getTextDimensions(`${arrayP[k].replace(/<p>/gi, '').replace(/<\/p>/gi, '')}`).w

                    if (longitudC > anchuraDocWM - 50) {
                        arrayLineas = doc.splitTextToSize(arrayP[k].replace(/<p>/gi, '').replace(/<\/p>/gi, ''), anchuraDocWM - 50);
                        for (let z = 0; z < arrayLineas.length; z++) {
                            if (ysiguiente+interlineado < alturaDoc - 50){
                                doc.text(`${arrayLineas[z]}`, x, ysiguiente);
                                ysiguiente += interlineado;
                                x = 56;
                            }
                            else{
                                doc.addPage();
                                agregarBanner(doc,opcionesJS);
                                doc.setFontSize(12)
                                doc.setFont(fontName);

                                let ysiguiente = 90;
                                doc.setFont(fontName, "bold");
                                doc.text(`${items[i].name} :`, 56.68, ysiguiente);
                                doc.setFont(fontName, "normal");
                                ysiguiente += interlineado;

                                arrayP = items[i].pivot.value.split("</p>");
                                arrayP.pop();

                                for (let k = 0; k < arrayP.length; k++) {

                                    let longitudC = doc.getTextDimensions(`${arrayP[k].replace(/<p>/gi, '').replace(/<\/p>/gi, '')}`).w

                                    if (longitudC > anchuraDocWM - 50) {
                                        arrayLineas = doc.splitTextToSize(arrayP[k].replace(/<p>/gi, '').replace(/<\/p>/gi, ''), anchuraDocWM - 50);
                                        for (let z = 0; z < arrayLineas.length; z++) {
                                            doc.text(`${arrayLineas[z]}`, x, ysiguiente);
                                            ysiguiente += interlineado;
                                            x = 56;
                                        }
                                    
                                    }
                                    else {
                                        doc.text(`${arrayP[k].replace(/<p>/gi, '').replace(/<\/p>/gi, '')}`, 70, ysiguiente);
                                        ysiguiente += interlineado;
                                    }

                                } 
                                cordenada = ysiguiente +margenEntreItem

                            }
                        }
                       
                    }
                    else {
                        doc.text(`${arrayP[k].replace(/<p>/gi, '').replace(/<\/p>/gi, '')}`, 70, ysiguiente);
                        ysiguiente += interlineado;
                    }

                } 
                cordenada = ysiguiente+margenEntreItem
            } else {

                doc.addPage();
                agregarBanner(doc,opcionesJS);

                doc.setFontSize(12)
                doc.setFont(fontName);

                let ysiguiente = 90;
                doc.setFont(fontName, "bold");
                doc.text(`${items[i].name} :`, 56.68, ysiguiente);
                doc.setFont(fontName, "normal");
                ysiguiente += interlineado;

                arrayP = items[i].pivot.value.split("</p>");
                arrayP.pop();

                for (let k = 0; k < arrayP.length; k++) {

                    let longitudC = doc.getTextDimensions(`${arrayP[k].replace(/<p>/gi, '').replace(/<\/p>/gi, '')}`).w

                    if (longitudC > anchuraDocWM - 50) {
                        arrayLineas = doc.splitTextToSize(arrayP[k].replace(/<p>/gi, '').replace(/<\/p>/gi, ''), anchuraDocWM - 50);
                        for (let z = 0; z < arrayLineas.length; z++) {
                            if (ysiguiente+interlineado < alturaDoc - 50){
                                doc.text(`${arrayLineas[z]}`, x, ysiguiente);
                                ysiguiente += interlineado;
                                x = 56;
                            }
                            else{
                                doc.addPage();
                                agregarBanner(doc,opcionesJS);

                                doc.setFontSize(12)
                                doc.setFont(fontName);

                                let ysiguiente = 90;
                                doc.setFont(fontName, "bold");
                                doc.text(`${items[i].name} :`, 56.68, ysiguiente);
                                doc.setFont(fontName, "normal");
                                ysiguiente += interlineado;

                                arrayP = items[i].pivot.value.split("</p>");
                                arrayP.pop();

                                for (let k = 0; k < arrayP.length; k++) {

                                    let longitudC = doc.getTextDimensions(`${arrayP[k].replace(/<p>/gi, '').replace(/<\/p>/gi, '')}`).w

                                    if (longitudC > anchuraDocWM - 50) {
                                        arrayLineas = doc.splitTextToSize(arrayP[k].replace(/<p>/gi, '').replace(/<\/p>/gi, ''), anchuraDocWM - 50);
                                        for (let z = 0; z < arrayLineas.length; z++) {
                                            doc.text(`${arrayLineas[z]}`, x, ysiguiente);
                                            ysiguiente += interlineado;
                                            x = 56;
                                        }
                                    
                                    }
                                    else {
                                        doc.text(`${arrayP[k].replace(/<p>/gi, '').replace(/<\/p>/gi, '')}`, 70, ysiguiente);
                                        ysiguiente += interlineado;
                                    }

                                } 
                                cordenada = ysiguiente +margenEntreItem

                            }
                        }
                       
                    }
                    else {
                        doc.text(`${arrayP[k].replace(/<p>/gi, '').replace(/<\/p>/gi, '')}`, 70, ysiguiente);
                        ysiguiente += interlineado;
                    }
                } 
                cordenada = ysiguiente+margenEntreItem
            }

        }
    }

    // CAMPOS----------------------------------------------------------------------------------------------


    doc.save("pdf.pdf")

    window.html2canvas = html2canvas;

    /* Creamos un HTML con el contenido que queremos que tenga el PDF
    var html = "";
    html += '<p style="font-family: '+fontName+'; font-size: 120%; letter-spacing: 0.1em">' + "{{$opciones['home_titulo']}}" + ' ' + "{{$opciones['home_subtitulo']}}" + '</p><hr>';
    html += '<p style="font-family: '+fontName+'; font-size: 120%; letter-spacing: 0.1em">' + "{{$opciones['home_titulo']}}" + ' ' + "{{$opciones['home_subtitulo']}}" + '</p><hr>';
    html += '<p style="font-family: '+fontName+'; font-size: 140%; letter-spacing: 0.1em">' + product.name + '</p>';
    html += '<img src="' + document.getElementById(image_id).src + '" width="100%">';
    for (var i = 0; i < items.length; i++) {
        html += '<p style="font-family: '+fontName+'; font-size: 120%; letter-spacing: 0.1em;">' + items[i].name + ':';
        html += items[i].pivot.value.replace(/<p>/g, "<p style='font-family: "+fontName+"; font-size: 100%; letter-spacing: 0.1em;'>");
        html += '</p>';
    }
 
    // Enviamos el HTML al PDF y forzamos la descarga
    doc.html(html, {
        callback: function(doc) {
            // Save the PDF
            doc.save(product.name + '.pdf');
        },
        x: 15,
        y: 15,
        margin: [10, 10, 10, 10],
        autoPaging: 'text',
        width: 170, //target width in the PDF document
        windowWidth: 650 //window width in CSS pixels
    });*/

}


// Descarga la imagen del producto como un archivo. 
// Forzamos la descarga mediante Javascript para evitar que el navegador la abra en una nueva pestaña.
function download(url_file, filename, product_name, contador) {
    const link = document.createElement('a');
    link.href = url_file;
    // Extraemos la extensión del url_file original
    var extension = url_file.split('.').pop();
    link.setAttribute('download', product_name + ' - ' + contador + '.' + extension);
    link.click();
}

// Script para truncar el valor de los items de más de 200 caracteres y añadir el botón "ver más"
document.addEventListener('DOMContentLoaded', function () {
    var truncarElems = document.querySelectorAll('.truncar');
    truncarElems.forEach(function (elem) {
        var contenidoCompleto = elem.innerHTML.trim();
        var contenidoTruncado = contenidoCompleto.slice(0, 200);
        var contenidoRestante = contenidoCompleto.slice(200);

        if (contenidoCompleto.length > 200) {
            var botonVerMas = document.createElement('button');
            botonVerMas.textContent = 'Ver más...';
            botonVerMas.classList.add('btn', 'btn-dark');

            elem.innerHTML = contenidoTruncado;
            elem.insertAdjacentElement('afterend', botonVerMas);

            botonVerMas.addEventListener('click', function () {
                elem.innerHTML = contenidoCompleto;
                botonVerMas.parentNode.removeChild(botonVerMas);

                var botonVerMenos = document.createElement('button');
                botonVerMenos.textContent = 'Ver menos...';
                botonVerMenos.classList.add('btn', 'btn-dark');

                elem.insertAdjacentElement('afterend', botonVerMenos);

                botonVerMenos.addEventListener('click', function () {
                    elem.innerHTML = contenidoTruncado;
                    botonVerMenos.parentNode.removeChild(botonVerMenos);
                    elem.insertAdjacentElement('afterend', botonVerMas);
                });
            });

            botonVerMas.insertAdjacentHTML('afterend', '<br>');
        }
    });
});


