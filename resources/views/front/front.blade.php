@extends('layouts.front')
@section('content')
    <div id="page-top">
        <!-- Masthead-->
        <header class="masthead"
            style="background-image: url(/storage/images/{{ $opciones['home_imagen_principal'] }}); 
                   --tipografia1: {{ $opciones['tipografia1'] }};
                   --tipografia2: {{ $opciones['tipografia2'] }}">
            <div class="container">
                <div class="tituloPrincipal">
                    <div class="masthead-subheading"
                        style="--color_titulo_subtitulo: {{ $opciones['color_titulo_subtitulo'] }};
                            --color_sombra_titulo_subtitulo: {{ $opciones['color_sombra_titulo_subtitulo'] }};">
                        {{ $opciones['home_titulo'] }}
                    </div>
                    <div class="masthead-heading text-uppercase"
                        style="--color_titulo_subtitulo: {{ $opciones['color_titulo_subtitulo'] }};
                            --color_sombra_titulo_subtitulo: {{ $opciones['color_sombra_titulo_subtitulo'] }};">
                        {{ $opciones['home_subtitulo'] }}
                    </div>
                </div>
            </div>
        </header>

        <section class="page-section bg-light" id="portfolio"
            style="background-color: {{ $opciones['color_fondo'] }} !IMPORTANT; --tipografia1: {{ $opciones['tipografia1'] }}; --tipografia3: {{ $opciones['tipografia3'] }}">
            <div class="container">
                <div class="Ticatego" style="margin-bottom: 2em">COLECCIONES</div>
                <div class="grid">
                    @foreach ($productosList as $producto)
                        <div class="gridItem">
                            <div class="portfolio-item">
                                <a class="portfolio-link" href="/categoria/{{ $producto->categoria->id }}">
                                    <div class="portfolio-hover">
                                        <div class="portfolio-hover-content"><i class="fa-solid fa-arrow-up-right-from-square fa-3x"></i></div>
                                    </div>
                                    <img class="img-fluid" src="/storage/{{ $producto->id }}/mini_{{ $producto->image }}"
                                        alt="..." />
                                        <div class="portfolio-caption">
                                            <div class="portfolio-caption-heading">{{ $producto->categoria->name }}</div>
                                        </div>
                                    </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
    </div>
    </section>

    <section class="page-section bg-light info-adicional" id="team"
        style="background-color: {{ $opciones['color_fondo'] }} !IMPORTANT; --tipografia1: {{ $opciones['tipografia1'] }}">
        <div class="container info-adicional">
            @if ($opciones['home_info_adicional'])
                <div class="Ticatego">{!! $opciones['home_info_adicional_titulo'] !!}</div>
                <div class="d-flex justify-content-center align-items-center">
                    <img class="rounded-circle" style="border: 8px solid {{ $opciones['color_nav'] }}"
                        src="storage/images/{!! $opciones['home_info_adicional_image'] !!}" alt="">
                </div>
                <div class="Ticatego fs-5 mt-5">{!! $opciones['home_info_adicional_subtitulo'] !!}</div>
            @endif
        </div>
    </section>
    </div>
@endsection
