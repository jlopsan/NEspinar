@extends('layouts.front')
@section('content')
<div id="page-top">
        <section class="page-section mt-3" id="portfolio"
            style="--paginacion: {{ $opciones['paginacion_color'] }}; ">

            <div class="content-wrapper" style="font-family: {{$opciones['tipografia3']}}">
                <div class="grid">
                    
                    @if (isset($msg) && !blank($msg))
                    <div class="text-center">
                        {{$msg}}
                    </div>
                    @endif
                    <!-- Pintando las cajas de los productos -->
                    @if ($todosProductos!=null)
                        @foreach($todosProductos as $key => $producto)
                            <div class="gridItem">

                                <div class="portfolio-item">
                                    <a class="portfolio-link" data-bs-toggle="modal" href="#producto{{$producto->id}}">
                                        <div class="portfolio-hover">
                                            <div class="portfolio-hover-content"><i class="fas fa-circle-info fa-3x"></i></div>
                                        </div>
                                        @if ($producto->image!=null)
                                        <img class="img-fluid" src='{{asset("storage/$producto->id/mini_$producto->image")}}'
                                        loading="lazy">
                                        @else
                                        <i class="fa-solid fa-question" style="width: 350px; height: 275px;"></i>
                                        @endif
                                        <div class="portfolio-caption">
                                            <div class="portfolio-caption-heading">{{$producto->name}}</div>
                                        </div>
                                    </a>
                                    
                                </div>
                            </div>
                            <!-- Creando los cuadros modales de cada prodcto -->
                            <div class="portfolio-modal modal fade" id="producto{{$producto->id}}" tabindex="-1" role="dialog"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="close-modal" data-bs-dismiss="modal"><svg id="Layer_1" data-name="Layer 1"
                                                viewBox="0 0 579.74 579.74">
                                                <defs>
                                                    <style>
                                                    .cls-1 {
                                                        fill: none;
                                                        stroke: #000;
                                                        stroke-miterlimit: 10;
                                                        stroke-width: 6px;
                                                    }
                                                    </style>
                                                </defs>
                                                <line class="cls-1" x1="2.12" y1="2.12" x2="577.62" y2="577.62" />
                                                <line class="cls-1" x1="2.12" y1="577.62" x2="577.62" y2="2.12" />
                                            </svg></div>
                                        <div class="container">
                                            <div class="row justify-content-center">
                                                <div class="col-lg-12">
                                                    <div class="modal-body">
                                                        <!-- Project details-->
                                                        <h2 class="title text-uppercase pb-4">{{$producto->name}}</h2>
                                                        <div id="carouselExampleIndicators{{$key}}"
                                                            class="carousel carousel-dark slide" data-bs-ride="true">
                                                            <!-- Indicadores de las imagenes (flechas) -->
                                                            <div class="carousel-indicators">
                                                                <button type="button"
                                                                    data-bs-target="#carouselExampleIndicators{{$key}}"
                                                                    data-bs-slide-to="0" class="active"
                                                                    aria-label="Slide 0"></button>
                                                                @foreach($producto->imagenes as $index => $image)
                                                                <button type="button"
                                                                    data-bs-target="#carouselExampleIndicators{{$key}}"
                                                                    data-bs-slide-to="{{$index + 1}}"
                                                                    aria-label="Slide {{$index + 1}}"></button>
                                                                @endforeach
                                                            </div>
                                                            
                                                            <div class="carousel-inner">
                                                                <!-- Imagen principal -->
                                                                <div class="carousel-item active w-100">
                                                                    <!-- Botones de descarga e impresión de la imagen principal -->
                                                                    <div class="d-flex justify-content-center" style="padding-bottom: 5px">
                                                                        <button class="btn btn-outline-secondary fa-solid fa-print mt-3" onclick="imprimir('{{addslashes(json_encode($producto,JSON_UNESCAPED_UNICODE))}}', 'mi_imagen{{$key}}', '{{addslashes(json_encode($producto->items,JSON_UNESCAPED_UNICODE))}}', '{{$producto->categoriaName}}')">
                                                                        <button class="btn btn-outline-secondary fa-solid fa-download mt-3" onclick="download('{{asset("storage/$producto->id/$producto->image")}}','{{$producto->image}}', '{{$producto->name}}', 0)">
                                                                    </div>   
                                                                    <!-- Imagen -->   
                                                                    
                                                                    @if($producto->image!=null)
                                                                                                
                                                                    <img id="mi_imagen{{$key}}" class="center-block w-40"
                                                                        src='{{asset("storage/$producto->id/mini_$producto->image")}}'
                                                                        alt="{{$producto->image}}" height="500" 
                                                                        loading="lazy"/>
                                                                        @else
                                                                            <i class="fa-solid fa-question" style="height: 500px; margin-bottom: 32px"></i>
                                                                        @endif
                                                                </div>

                                                                <!-- Imagenes secundarias -->
                                                                @php 
                                                                    $contador = 0;
                                                                @endphp
                                                                @foreach($producto->imagenes as $image)
                                                                    @php
                                                                        $contador++;
                                                                    @endphp
                                                                    <div class="carousel-item">
                                                                        <!-- Botones de descarga e impresión de la imagen secundaria -->
                                                                        <div class="d-flex justify-content-center"  style="padding-bottom: 5px">
                                                                            <button class="btn btn-outline-secondary fa-solid fa-print mt-3" onclick="imprimir('{{addslashes(json_encode($producto,JSON_UNESCAPED_UNICODE))}}', 'img_secundaria_{{$producto->id}}_{{$contador}}', '{{addslashes(json_encode($producto->items,JSON_UNESCAPED_UNICODE))}}', '{{$producto->categoriaName}}')">
                                                                            <button class="btn btn-outline-secondary fa-solid fa-download mt-3" onclick="download('{{ asset("storage/$producto->id/$image->image")}}' , '{{$image->image}}', '{{$producto->name}}', {{$contador}})">
                                                                        </div>
                                                                        <!-- Imagen -->
                                                                       
                                                                        <img id="img_secundaria_{{$producto->id}}_{{$contador}}"
                                                                            src='{{asset("storage/$producto->id/mini_$image->image")}}'
                                                                            class="center-block" height="500"
                                                                            alt="{{$image->image}}"
                                                                            loading="lazy">
                                                                        
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            
                                                            <button class="carousel-control-prev" type="button"
                                                                data-bs-target="#carouselExampleIndicators{{$key}}"
                                                                data-bs-slide="prev">
                                                                <span class="carousel-control-prev-icon"
                                                                    aria-hidden="true"></span>
                                                                <span class="visually-hidden">Previous</span>
                                                            </button>
                                                            <button class="carousel-control-next" type="button"
                                                                data-bs-target="#carouselExampleIndicators{{$key}}"
                                                                data-bs-slide="next">
                                                                <span class="carousel-control-next-icon"
                                                                    aria-hidden="true"></span>
                                                                <span class="visually-hidden">Next</span>
                                                            </button>
                                                        </div>
                                                        <div class='items' style="padding-left: 25%; padding-right: 20%; text-align: left">
                                                            @foreach ($producto->items as $item)
                                                                <strong>{!! $item->name !!}:</strong>
                                                                <div class="truncar">{!! $item->pivot->value !!}

                                                                </div>
                                                                <br>
                                                            @endforeach

                                                            <!--
                                                            <button class="btn btn-outline-secondary fa-solid fa-print mt-3" onclick="javascript:window.print()">
                                                            <button class="btn btn-outline-secondary fa-solid fa-download mt-3" onclick="download('{{asset("storage/$producto->id/$producto->image")}}','{{$producto->image}}')">
                                                            -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        @endforeach
                        
                    @else
                        
                        
                    @endif
                    
                    <!--FIN Pintando los productos con su modal -->
                </div>

                <div class="d-flex justify-content-center">
                    @if(isset($pages))
                    <form action="{{route('buscadorPorCampos')}}" method="POST">
                        @csrf
                        <input type="hidden" name="categoria_id" value="{{$categoria_id}}">
                        @foreach($items as $key => $item)
                        <input type="hidden" name="items[{{$key}}]" value="{{$item}}">
                        @endforeach
                        <nav>
                            <ul class="pagination">
                                <li class="page-item {{$currentPage == 1 ? 'disabled' : ''}}">
                                    <button class="page-link" rel="next" aria-label="« Previous" name="page"
                                        value="{{$currentPage-1}}">‹</a>
                                </li>
                                @for($i = 1; $i <= $pages; $i++) <li>
                                    <class="page-item {{$currentPage == $i ? 'active' : ''}}">
                                    <button class="page-link" name="page" {{$currentPage == $i ? 'active' : ''}}
                                        value="{{$i}}">{{$i}}</button>
                                    </li>
                                @endfor
                                <li class="page-item {{$currentPage == $pages ? 'disabled' : ''}}">
                                    <button class="page-link" rel="next" aria-label="Next »" name="page"
                                            value="{{$currentPage+1}}">›</a>
                                </li>
                            </ul>
                        </nav>
                    </form>
                    @else
                        @if ($todosProductos!=null)
                        <div class="paginacion">
                            {{$todosProductos->links()}}
                        </div>
                        @endif
                    @endif
                </div>
            </div>
            
</div>
</section>
<!-- FOOTER -->
@endsection

<!-- Librerías para crear PDFs -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/3.0.1/purify.min.js"></script>

<script>
    // QUe se puedan elegir diferentes tamaños de las fotos (Con un modal)
    // Que se pueda escoger el titulo por campo;
    // https://rawgit.com/MrRio/jsPDF/master/docs/index.html
    
        window.jsPDF = window.jspdf.jsPDF;      // Debe ser una variable global para que funcione html2canvas
    
    
        // Genera un PDF con los datos del producto y la imagen del carrusel.
        // Recibe como parámetros el JSON del producto, el ID de la imagen en el árbol DOM, un JSON con los items del producto y el nombre de la categoría.
        function imprimir(json_product, image_id, json_items, category) {
    
        
        
            // Convertimos los JSON a objetos
            var product = JSON.parse(json_product);
               /* 
                {
                    "id": 487,
                    "name": "Silo",
                    "image": "Wet 3.jpg",
                    "categoriaName": "Piezas Arqueológicas",
                    "imagenes": [
                        {
                            "id": 1377,
                            "image": "Wet 2.jpg",
                            "producto_id": 487,
                            "created_at": "2024-01-11T12:24:46.000000Z",
                            "updated_at": "2024-01-11T12:24:46.000000Z"
                        },
                        {
                            "id": 1376,
                            "image": "Wet 1.jpg",
                            "producto_id": 487,
                            "created_at": "2024-01-11T12:24:46.000000Z",
                            "updated_at": "2024-01-11T12:24:46.000000Z"
                        }
                    ]
                }
            */
         
    
            var items = JSON.parse(json_items);
            
                /*
    
                    [
                        {
                            "id": 47,
                            "name": "Función",
                            "categoria_id": 1,
                            "created_at": "2023-08-31T05:00:33.000000Z",
                            "updated_at": "2024-01-23T11:46:27.000000Z",
                            "order": 1,
                            "destacado": 1,
                            "pivot": {
                                "productos_id": 487,
                                "items_id": 47,
                                "value": "Contención."
                            }
                        },
                        {
                            "id": 29,
                            "name": "Tipología",
                            "categoria_id": 1,
                            "created_at": "2023-04-21T08:40:23.000000Z",
                            "updated_at": "2024-01-23T11:46:27.000000Z",
                            "order": 4,
                            "destacado": 0,
                            "pivot": {
                                "productos_id": 487,
                                "items_id": 29,
                                "value": "Silo."
                            }
                        },
                        {
                            "id": 1,
                            "name": "Número Inventario",
                            "categoria_id": 1,
                            "created_at": null,
                            "updated_at": "2024-01-23T11:46:27.000000Z",
                            "order": 5,
                            "destacado": 0,
                            "pivot": {
                                "productos_id": 487,
                                "items_id": 1,
                                "value": "<p>E-</p>"
                            }
                        },
                        {
                            "id": 3,
                            "name": "Dimensiones",
                            "categoria_id": 1,
                            "created_at": null,
                            "updated_at": "2024-01-23T11:46:27.000000Z",
                            "order": 7,
                            "destacado": 0,
                            "pivot": {
                                "productos_id": 487,
                                "items_id": 3,
                                "value": "<p>Altura: 24,3 cm; Diámetro: 98,6 cm; Grueso: 2,6 cm.</p>"
                            }
                        },
                        {
                            "id": 46,
                            "name": "Descripción / Análisis",
                            "categoria_id": 1,
                            "created_at": "2023-08-31T04:56:47.000000Z",
                            "updated_at": "2024-01-23T11:46:27.000000Z",
                            "order": 12,
                            "destacado": 0,
                            "pivot": {
                                "productos_id": 487,
                                "items_id": 46,
                                "value": "<p>Fondo de silo, las paredes estaban formadas por ladrillos sin argamasa de unión.</p>"
                            }
                        },
                        {
                            "id": 39,
                            "name": "Material/Técnica",
                            "categoria_id": 1,
                            "created_at": "2023-06-25T06:52:03.000000Z",
                            "updated_at": "2024-01-23T11:46:27.000000Z",
                            "order": 13,
                            "destacado": 0,
                            "pivot": {
                                "productos_id": 487,
                                "items_id": 39,
                                "value": "<p>Pasta anaranjada.</p>"
                            }
                        },
                        {
                            "id": 40,
                            "name": "Acabado/Decoración",
                            "categoria_id": 1,
                            "created_at": "2023-06-25T06:52:34.000000Z",
                            "updated_at": "2024-01-23T11:46:27.000000Z",
                            "order": 14,
                            "destacado": 0,
                            "pivot": {
                                "productos_id": 487,
                                "items_id": 40,
                                "value": "<p>Sin decoración.</p>"
                            }
                        },
                        {
                            "id": 7,
                            "name": "Cronología",
                            "categoria_id": 1,
                            "created_at": null,
                            "updated_at": "2024-01-23T11:46:27.000000Z",
                            "order": 15,
                            "destacado": 0,
                            "pivot": {
                                "productos_id": 487,
                                "items_id": 7,
                                "value": "<p>En estudio.</p>"
                            }
                        },
                        {
                            "id": 48,
                            "name": "Paralelos",
                            "categoria_id": 1,
                            "created_at": "2023-09-05T17:38:56.000000Z",
                            "updated_at": "2024-01-23T11:46:27.000000Z",
                            "order": 16,
                            "destacado": 0,
                            "pivot": {
                                "productos_id": 487,
                                "items_id": 48,
                                "value": "<p>En estudio.</p>"
                            }
                        },
                        {
                            "id": 6,
                            "name": "Procedencia",
                            "categoria_id": 1,
                            "created_at": null,
                            "updated_at": "2024-01-23T11:46:27.000000Z",
                            "order": 17,
                            "destacado": 0,
                            "pivot": {
                                "productos_id": 487,
                                "items_id": 6,
                                "value": "<p>Calle Arapiles, Almería, España.</p>"
                            }
                        },
                        {
                            "id": 9,
                            "name": "Bibliografía",
                            "categoria_id": 1,
                            "created_at": null,
                            "updated_at": "2024-01-23T11:46:27.000000Z",
                            "order": 18,
                            "destacado": 0,
                            "pivot": {
                                "productos_id": 487,
                                "items_id": 9,
                                "value": "<p>Inédito.</p>"
                            }
                        }
                    ]
    
                */
    
            // GESTIONAMOS LAS VARAIBLES QUE NECESITAMOS PARA EL PDF -----------------------------------------------
            var doc = new jsPDF('portrait', 'pt', 'a4');
            var fontName = "Prata-Regular";
            var fontNameTitulos= "Cinzel-VariableFont_wght";
            doc.addFont('/fonts/'+fontName+'.ttf', fontName, 'normal'); // Es necesario usar una fuente con soporte unicode y poner el archivo ttf en /public/fonts
            doc.addFont('/fonts/'+fontNameTitulos+'.ttf', fontNameTitulos, 'normal');
            var margenDerecho= 30;
            var margenIzquierdo= 30; 
            var margenTop= 30;
            var margenBot=30;
            var interlineado=30; 
            const anchuraDoc = doc.internal.pageSize.getWidth();
            const alturaDoc = doc.internal.pageSize.getHeight();
          
         
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
            doc.text("{{$opciones['home_titulo']}}",35,33);
            var longitudST= doc.getStringUnitWidth("{{$opciones['home_subtitulo']}}") * doc.internal.getFontSize();
            let margenBanner = 25; 
            var posicionXSubtitulo = anchuraDoc - longitudST-margenBanner;
            doc.text("{{$opciones['home_subtitulo']}}",posicionXSubtitulo,33);
            doc.line(0, 42.51, 595.14, 42.51);
    
    
             // TITULO DEL PRODUCTO---------------------------------------------------------------------------------
            doc.setFont(fontNameTitulos);
            doc.setFontSize(30);
            var longitudProductName= doc.getStringUnitWidth(`${product.name}`) * doc.internal.getFontSize(); //Calcula el tamaño del titulo
            var xProdName= ((anchuraDoc/2)-(longitudProductName/2)) //Calcula la coordenada de inicio del titulo para que este siempre centrado
      
    
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
                xSMitad = ((anchuraDoc/2)-(longMitad2/2));
                doc.text(`${SMitad}`,xSMitad,82+interlineado);
            };
            //SUBTITULO--------------------------------------------------------------------------------------------------------------------------------
            doc.setFontSize(18);
            var longItem = doc.getStringUnitWidth(`${items[0].pivot.value}`)* doc.internal.getFontSize(); //Calcula el tamaño del subtitulo
            var xitem = ((anchuraDoc/2)-(longItem/2));
    
            if(doc.getTextDimensions(`${items[0].pivot.value}`).w < anchuraDoc){
                doc.text(`${items[0].pivot.value.replace(/\./g, '')}`,xitem,135);
            }
            else{
                var subtitulo = items[0].pivot.value.replace(/\./g, '');
                var tamañoSub = subtitulo.length;
                let pmitadSub = subtitulo.substring(0,tamañoSub/2);
                let smitadSub = subtitulo.substring(tamañoSub/2);
    
                let longMitadSub = doc.getStringUnitWidth(pmitadSub) * doc.internal.getFontSize();
                let xPMitadSub = ((anchuraDoc/2)-(longMitadSub/2));
                doc.text(`${pmitadSub} - `, xPMitadSub, 140);
    
                let longMitadSub2 = doc.getStringUnitWidth(smitadSub) * doc.internal.getFontSize();
                let xSMitadsub = ((anchuraDoc/2)-(longMitadSub2/2));
                doc.text(`${smitadSub}`, xSMitadsub, 140+20);
            }
           
    
             // FOTOGRAFIAS-----------------------------------------------------------------------------------------
    
             var imagen = new Image();
             imagen.src = document.getElementById(image_id).src;
             var anchoOriginal= imagen.naturalWidth;
             var anchoOriginalPT= anchoOriginal/1.3;
             var alturaOriginal = imagen.naturalHeight;
             var alturaOriginalPT = alturaOriginal/1.3
             var anchuraDeseada = 320;
             var ratio = anchoOriginalPT/alturaOriginalPT;
             var alturaDeseada = anchuraDeseada/ratio;
            
             xImagen = ((anchuraDoc/2)-(anchuraDeseada/2))
             /*
             console.log("ancho Original Foto: ");
             console.log(anchoOriginal);
             console.log("Ancho original Puntos: ");
             console.log(anchoOriginalPT);
             console.log("---------------------------");
             console.log("Altura Original");
             console.log(alturaOriginal);
             console.log("Altura original PT");
             console.log(alturaOriginalPT);
             console.log("-----------------------");
             console.log("anchura deseada");
             console.log(anchuraDeseada);
             console.log("Ratio");
             console.log(ratio);
             console.log("----------------");
             console.log("Altura deseada");
             console.log( alturaDeseada);
            */
             doc.addImage(imagen,"JPG",xImagen,180,anchuraDeseada,alturaDeseada);
    
             // CAMPOS----------------------------------------------------------------------------------------------
            doc.setFontSize(12)
            doc.setFont(fontName);
            for (var i = 0; i < items.length; i++){
            
                let cordenada = 270+i*28
                doc.text(`${items[i].name} :`, 56.68,cordenada)
    
            }
          
    
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
    
    
    </script>