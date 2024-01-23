@extends('layouts.front')
@section('content')
<div id="page-top">
        <section class="page-section mt-5" id="portfolio"
            style="--paginacion: {{ $opciones['paginacion_color'] }}; ">

            <div class="" style="font-family: {{$opciones['tipografia3']}}">
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
                                            <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                        </div>
                                        <img class="img-fluid" src='{{asset("storage/$producto->id/mini_$producto->image")}}'
                                            width="auto">
                                    </a>
                                    <div class="portfolio-caption">
                                        <div class="portfolio-caption-heading">{{$producto->name}}</div>
                                    </div>
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
                                                                    <img id="mi_imagen{{$key}}" class="center-block w-40"
                                                                        src='{{asset("storage/$producto->id/mini_$producto->image")}}'
                                                                        alt="{{$producto->image}}" height="500" />
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
                                                                            <button class="btn btn-outline-secondary fa-solid fa-print mt-3" onclick="imprimir('{{json_encode($producto)}}', 'img_secundaria_{{$producto->id}}_{{$contador}}', '{{json_encode($producto->items)}}', '{{$producto->categoriaName}}')">
                                                                            <button class="btn btn-outline-secondary fa-solid fa-download mt-3" onclick="download('{{ asset("storage/$producto->id/$image->image")}}' , '{{$image->image}}', '{{$producto->name}}', {{$contador}})">
                                                                        </div>
                                                                        <!-- Imagen -->
                                                                        <img id="img_secundaria_{{$producto->id}}_{{$contador}}"
                                                                            src='{{asset("storage/$producto->id/mini_$image->image")}}'
                                                                            class="center-block" height="500"
                                                                            alt="{{$image->image}}">
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
                            {{$todosProductos->links()}}
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

<!-- Mis scripts -->
<script>

    window.jsPDF = window.jspdf.jsPDF;      // Debe ser una variable global para que funcione html2canvas

    // Genera un PDF con los datos del producto y la imagen del carrusel.
    // Recibe como parámetros el JSON del producto, el ID de la imagen en el árbol DOM, un JSON con los items del producto y el nombre de la categoría.
    function imprimir(json_product, image_id, json_items, category) {

        // Convertimos los JSON a objetos
        var product = JSON.parse(json_product);
        var items = JSON.parse(json_items);
        
        // Creamos un documento PDF en blanco
        var doc = new jsPDF('portrait', 'mm', 'a4');   // Creamos el PDF en tamaño A4 y con unidades en mm
        var fontName = "Roboto-Regular";
        doc.addFont('/fonts/'+fontName+'.ttf', fontName, 'normal'); // Es necesario usar una fuente con soporte unicode y poner el archivo ttf en /public/fonts
        doc.setFont(fontName);
        window.html2canvas = html2canvas; 

        // Creamos un HTML con el contenido que queremos que tenga el PDF
        var html = "";
        html += '<p style="font-family: '+fontName+'; font-size: 120%; letter-spacing: 0.1em">' + "{{$opciones['home_titulo']}}" + ' [' + "{{$opciones['home_subtitulo']}}" + ']</p><hr>';
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
        });
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
