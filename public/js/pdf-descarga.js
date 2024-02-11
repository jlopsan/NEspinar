


    // QUe se puedan elegir diferentes tamaños de las fotos (Con un modal)
    // Que se pueda escoger el titulo por campo;
    // https://rawgit.com/MrRio/jsPDF/master/docs/index.html
      
    
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
            let fontName = "Prata-Regular";
            let fontNameTitulos= "Cinzel-VariableFont_wght";
            doc.addFont('/fonts/'+fontName+'.ttf', fontName, 'normal'); // Es necesario usar una fuente con soporte unicode y poner el archivo ttf en /public/fonts
            doc.addFont('/fonts/'+fontNameTitulos+'.ttf', fontNameTitulos, 'normal');
            let interlineado=30; 
            const anchuraDoc = doc.internal.pageSize.getWidth();
            const alturaDoc = doc.internal.pageSize.getHeight();
            const anchuraDocWM = anchuraDoc-60
          
            /*
            Coordenadas Paginacion. 
            Esquina superior izquierda: (0, 0)
            Esquina superior derecha: (210 mm, 0)
            Esquina inferior izquierda: (0, 297 mm)
            Esquina inferior derecha: (210 mm, 297 mm)
            72  puntos pulgada. 25.4 mm /1 pulgada.
            72/25.4 = 2.834
            */
              
            // BANNER ARRIBA---------------------------------------------------------------------------------------
            doc.setFont(fontName);
            doc.setFontSize(9);
            doc.text(opcionesJS.home_titulo,35,33);
            let longitudST= doc.getStringUnitWidth(opcionesJS.home_subtitulo) * doc.internal.getFontSize();
            let margenBanner = 25; 
            let posicionXSubtitulo = anchuraDoc - longitudST-margenBanner;
            doc.text(opcionesJS.home_subtitulo,posicionXSubtitulo,33);
            doc.line(0, 42.51, 595.14, 42.51);
    
    
             // TITULO DEL PRODUCTO---------------------------------------------------------------------------------
            doc.setFont(fontNameTitulos);
            doc.setFontSize(30);
            let longitudProductName= doc.getStringUnitWidth(`${product.name}`) * doc.internal.getFontSize(); //Calcula el tamaño del titulo
            let xProdName= ((anchuraDoc/2)-(longitudProductName/2)) //Calcula la coordenada de inicio del titulo para que este siempre centrado
      
    
            if(doc.getTextDimensions(`${product.name}`).w < anchuraDoc){

                doc.text(`${product.name}`,xProdName,82);
            }else{
                let nombreEntero= product.name;
                let tamañoCadena = nombreEntero.length;
                let PMitad = nombreEntero.substring(0,tamañoCadena/2);
                let SMitad = nombreEntero.substring(tamañoCadena/2);
    
                let longMitad = doc.getStringUnitWidth(PMitad) * doc.internal.getFontSize();
                let xPMitad = ((anchuraDoc/2)-(longMitad/2));
                doc.text(`${PMitad} -`,xPMitad,82);
    
                let longMitad2 = doc.getStringUnitWidth(SMitad) * doc.internal.getFontSize();
                let xSMitad = ((anchuraDoc/2)-(longMitad2/2));
                doc.text(`${SMitad}`,xSMitad,82+interlineado);
            };
            //SUBTITULO--------------------------------------------------------------------------------------------------------------------------------
            doc.setFontSize(18);
            let longItem = doc.getStringUnitWidth(`${items[0].pivot.value.replace(/<p>/gi, '').replace(/<\/p>/gi, '').replace(/\./g, '')}`)* doc.internal.getFontSize(); //Calcula el tamaño del subtitulo
            let xitem = ((anchuraDoc/2)-(longItem/2));
          
    
            if(doc.getTextDimensions(`${items[0].pivot.value}`).w < anchuraDoc){
                doc.text(`${items[0].pivot.value.replace(/<p>/gi, '').replace(/<\/p>/gi, '').replace(/\./g, '')}`,xitem,135);
            }
            else{
                let subtitulo = items[0].pivot.value.replace(/<p>/gi, '').replace(/<\/p>/gi, '').replace(/\./g, '');
                let tamañoSub = subtitulo.length;
                let pmitadSub = subtitulo.substring(0,tamañoSub/2);
                let smitadSub = subtitulo.substring(tamañoSub/2);
    
                let longMitadSub = doc.getStringUnitWidth(pmitadSub) * doc.internal.getFontSize();
                let xPMitadSub = ((anchuraDoc/2)-(longMitadSub/2));
                doc.text(`${pmitadSub} - `, xPMitadSub, 140);
    
                let longMitadSub2 = doc.getStringUnitWidth(smitadSub) * doc.internal.getFontSize();
                let xSMitadsub = ((anchuraDoc/2)-(longMitadSub2/2));
                doc.text(`${smitadSub}`, xSMitadsub, 140+20);
            }
           
    
             // FOTOGRAFIAS----------------------------------------------------------------------------------------
             let imagen = document.getElementById(image_id);

             let anchoOriginalPT= imagen.naturalWidth/1.3;
             let alturaOriginalPT = imagen.naturalHeight/1.3;
             let ratio = anchoOriginalPT/alturaOriginalPT;

            if (anchoOriginalPT>alturaOriginalPT){
             let anchuraDeseada = 320;
             let alturaDeseada = anchuraDeseada/ratio;
             let xImagen = ((anchuraDoc/2)-(anchuraDeseada/2));
             doc.addImage(imagen,"JPG",xImagen,180,anchuraDeseada,alturaDeseada);
                
             doc.setFontSize(12)
             doc.setFont(fontName);

             let cordenada = alturaDeseada+180+interlineado;

             for (var i = 0; i < items.length; i++){

                if (cordenada+interlineado< alturaDoc){
                
                    let ysiguiente = cordenada;
                    
                    doc.text(`${items[i].name} :`, 56.68,ysiguiente);
                    ysiguiente += interlineado;
                   
                    let longitudC = doc.getTextDimensions(`${items[i].pivot.value.replace(/<p>/gi, '').replace(/<\/p>/gi, '').replace(/\./g, '')}`).w 
                    

                    if(longitudC> anchuraDocWM){
                    
                    arrayLineas = doc.splitTextToSize(items[i].pivot.value.replace(/<p>/gi, '').replace(/<\/p>/gi, '').replace(/\./g, ''),anchuraDocWM);
                        
                        for (let j = 0; j< arrayLineas.length; j++) {
                            
                            doc.text(`${arrayLineas[j]}`,70,ysiguiente);
                            ysiguiente += interlineado;
                        }
                    }else {
                        doc.text(`${items[i].pivot.value.replace(/<p>/gi, '').replace(/<\/p>/gi, '').replace(/\./g, '')}`,70,ysiguiente);
                    }
                    cordenada = ysiguiente+interlineado
                }else{
               
                    doc.addPage();
                    doc.setFont(fontName);
                    doc.setFontSize(9);
                    doc.text(opcionesJS.home_titulo,35,33);
                    let longitudST= doc.getStringUnitWidth(opcionesJS.home_subtitulo) * doc.internal.getFontSize();
                    let margenBanner = 25; 
                    let posicionXSubtitulo = anchuraDoc - longitudST-margenBanner;
                    doc.text(opcionesJS.home_subtitulo,posicionXSubtitulo,33);
                    doc.line(0, 42.51, 595.14, 42.51);

                    doc.setFontSize(12)
                    doc.setFont(fontName);

                    let ysiguiente = 90;
                    
                    doc.text(`${items[i].name} :`, 56.68,ysiguiente);

                    ysiguiente += interlineado;

                     let longitudC = doc.getTextDimensions(`${items[i].pivot.value.replace(/<p>/gi, '').replace(/<\/p>/gi, '').replace(/\./g, '')}`).w +72
                    console.log(longitudC);
                    console.log(anchuraDocWM);

                    if(longitudC> anchuraDocWM){
                    
                    arrayLineas = doc.splitTextToSize(items[i].pivot.value.replace(/<p>/gi, '').replace(/<\/p>/gi, '').replace(/\./g, ''),anchuraDocWM);
                    console.log(arrayLineas);
    
                        for (let j = 0; j< arrayLineas.length; j++) {
                            doc.text(arrayLineas[j],70,ysiguiente);
                            ysiguiente += interlineado;
                        }
                    }else {
                        doc.text(`${items[i].pivot.value.replace(/<p>/gi, '').replace(/<\/p>/gi, '').replace(/\./g, '')}`,70,ysiguiente);
                    }

                    cordenada = ysiguiente+interlineado
                }

            }

            }
            if (anchoOriginalPT<alturaOriginalPT){
                let alturaDeseada = 400;
                let anchuraDeseada= alturaDeseada*ratio;
                let xImagen = ((anchuraDoc/2)-(anchuraDeseada/2));
                doc.addImage(imagen,"JPG",xImagen,180,anchuraDeseada,alturaDeseada);

                doc.setFontSize(12)
                doc.setFont(fontName);

                let cordenada = alturaDeseada+180+interlineado*2;

                for (var i = 0; i < items.length; i++){

                    if (cordenada+interlineado< alturaDoc){
                    
                        let ysiguiente = cordenada;
                        
                        doc.text(`${items[i].name} :`, 56.68,ysiguiente);
                        ysiguiente += interlineado;
                       
                        let longitudC = doc.getTextDimensions(`${items[i].pivot.value.replace(/<p>/gi, '').replace(/<\/p>/gi, '').replace(/\./g, '')}`).w 

                        if(longitudC> anchuraDocWM){
                        
                        arrayLineas = doc.splitTextToSize(items[i].pivot.value.replace(/<p>/gi, '').replace(/<\/p>/gi, '').replace(/\./g, ''),anchuraDocWM);
                            
                            for (let i = 0; i< arrayLineas.length; i++) {
                                
                                doc.text(`${arrayLineas[i]}`,70,ysiguiente);
                                ysiguiente += interlineado;
                            }
                        }else {
                            doc.text(`${items[i].pivot.value.replace(/<p>/gi, '').replace(/<\/p>/gi, '').replace(/\./g, '')}`,70,ysiguiente);
                        }
                        cordenada = ysiguiente+interlineado
                    }else{
                   
                        doc.addPage();
                        doc.setFont(fontName);
                        doc.setFontSize(9);
                        doc.text(opcionesJS.home_titulo,35,33);
                        let longitudST= doc.getStringUnitWidth(opcionesJS.home_subtitulo) * doc.internal.getFontSize();
                        let margenBanner = 25; 
                        let posicionXSubtitulo = anchuraDoc - longitudST-margenBanner;
                        doc.text(opcionesJS.home_subtitulo,posicionXSubtitulo,33);
                        doc.line(0, 42.51, 595.14, 42.51);

                        doc.setFontSize(12)
                        doc.setFont(fontName);

                        let ysiguiente = 90;
                        
                        doc.text(`${items[i].name} :`, 56.68,ysiguiente);

                        ysiguiente += interlineado;

                         let longitudC = doc.getTextDimensions(`${items[i].pivot.value.replace(/<p>/gi, '').replace(/<\/p>/gi, '').replace(/\./g, '')}`).w +72
                        console.log(longitudC);
                        console.log(anchuraDocWM);

                        if(longitudC> anchuraDocWM){
                        
                        arrayLineas = doc.splitTextToSize(items[i].pivot.value.replace(/<p>/gi, '').replace(/<\/p>/gi, '').replace(/\./g, ''),anchuraDocWM);
                        console.log(arrayLineas);
        
                            for (let i = 0; i< arrayLineas.length; i++) {
                                doc.text(arrayLineas[i],70,ysiguiente);
                                ysiguiente += interlineado;
                            }
                        }else {
                            doc.text(`${items[i].pivot.value.replace(/<p>/gi, '').replace(/<\/p>/gi, '').replace(/\./g, '')}`,70,ysiguiente);
                        }

                        cordenada = ysiguiente+interlineado
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
        document.addEventListener('DOMContentLoaded', function() {
        var truncarElems = document.querySelectorAll('.truncar');
        truncarElems.forEach(function(elem) {
            var contenidoCompleto = elem.innerHTML.trim();
            var contenidoTruncado = contenidoCompleto.slice(0, 200);
            var contenidoRestante = contenidoCompleto.slice(200);
    
            if (contenidoCompleto.length > 200) {
                var botonVerMas = document.createElement('button');
                botonVerMas.textContent = 'Ver más...';
                botonVerMas.classList.add('btn', 'btn-dark'); 
    
                elem.innerHTML = contenidoTruncado;
                elem.insertAdjacentElement('afterend', botonVerMas);
    
                botonVerMas.addEventListener('click', function() {
                    elem.innerHTML = contenidoCompleto;
                    botonVerMas.parentNode.removeChild(botonVerMas);
    
                    var botonVerMenos = document.createElement('button');
                    botonVerMenos.textContent = 'Ver menos...';
                    botonVerMenos.classList.add('btn', 'btn-dark');
    
                    elem.insertAdjacentElement('afterend', botonVerMenos);
    
                    botonVerMenos.addEventListener('click', function() {
                        elem.innerHTML = contenidoTruncado;
                        botonVerMenos.parentNode.removeChild(botonVerMenos);
                        elem.insertAdjacentElement('afterend', botonVerMas);
                    });
                });
    
                botonVerMas.insertAdjacentHTML('afterend', '<br>'); 
            }
        });
    });
    
    
