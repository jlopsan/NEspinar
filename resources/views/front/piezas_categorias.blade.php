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
                                                                        <button class="btn btn-outline-secondary fa-solid fa-print mt-3" onclick="imprimir('{{addslashes(json_encode($producto,JSON_UNESCAPED_UNICODE))}}', 'mi_imagen{{$key}}', '{{addslashes(json_encode($producto->items,JSON_UNESCAPED_UNICODE))}}', '{{$producto->categoriaName}}','{{addslashes(json_encode($opciones))}}')">
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
                                                                            <button class="btn btn-outline-secondary fa-solid fa-print mt-3" onclick="imprimir('{{addslashes(json_encode($producto,JSON_UNESCAPED_UNICODE))}}', 'img_secundaria_{{$producto->id}}_{{$contador}}', '{{addslashes(json_encode($producto->items,JSON_UNESCAPED_UNICODE))}}', '{{$producto->categoriaName}}','{{addslashes(json_encode($opciones))}}')">
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
                            {{$todosProductos->links()}}
                        @endif
                    @endif
                </div>
            </div>
            
</div>
</section>
<!-- FOOTER -->
@endsection


<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/3.0.1/purify.min.js"></script>

<script src="/js/pdf-descarga.js"></script>