<!-- Esta vista muestra los valores del ítem destacado de una categoría. Es la forma que tenemos de implementar
     unas pseudo-subcategorías sin necesidad de hacer verdaderas subcategorías. -->
@extends('layouts.front')
@section('content')


    <div id="page-top" class="content-wrapper">
        <section class="page-section" id="portfolio"
            >
            <div class="" style="font-family: {{$opciones['tipografia3']}}">
                <div class="grid">
                    @if (isset($msg) && !blank($msg))
                    <div class="text-center">
                        {{$msg}}
                    </div>
                    @endif
                    
                    <!-- Muestra una "tarjeta" por cada valor del ítem destacado de la categoría actual -->
                    <!-- html_entity_decode hace que values como &nbsp; se muestre como tabulación y no se imprima -->
                    @foreach($valores as $key => $valor)
                    @php
                        $valorDecoded = html_entity_decode(strip_tags($valor->value));
                        $valorItem = $valorDecoded == "" ? "Sin Categorizar" : $valorDecoded;
                    @endphp
                    <div class="gridItem">
                        <div class="portfolio-item">
                            <a class="portfolio-link"
                               href="{{route('front.porItemDestacado', ['idCategoria' => $categoria->id, 'idItem' => $idItem, 'valorItem' => $valorItem])}}">

                                <div class="portfolio-caption">
                                    <div class="portfolio-caption-heading">{{$valorItem}}</div>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach

                    <!-- Muestra una "tarjeta" adicional con el rótulo "Ver todo" para poder ver todos los productos de la categoría -->
                    <div class="gridItem">
                        <div class="portfolio-item">
                            <a class="portfolio-link" 
                               href="{{ route('front.porItemDestacado', ['idCategoria' => $categoria->id, 'idItem' => '-1', 'valorItem' => 'null'] ) }}">
                                <div class="portfolio-caption">
                                    <div class="portfolio-caption-heading">Ver todo</div>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection
