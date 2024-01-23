<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>{{$opciones['home_titulo']}} | {{$opciones['home_subtitulo']}}</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="/storage/images/{{ $opciones['favicon'] }}" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family={{$opciones['tipografia1']}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family={{$opciones['tipografia2']}}" rel="stylesheet">
    <!-- Mi fuente-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="/css/frontStyles.css" rel="stylesheet" type="text/css" />

    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    @yield('css')
</head>

<body style="background-color: {{ $opciones['color_fondo'] }}!IMPORTANT;">
    <div class="wrapper">

    <div id="container" >

    <!-- Menu-->
    @yield('content')


    @if (isset($home))
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav"
        style="--color_nav: {{ $opciones['color_nav'] }}; --tipografia1: {{$opciones['tipografia1']}}">
        @else
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="buscador_nav"
            style="--color_nav: {{ $opciones['color_nav'] }}; font-family: {{$opciones['tipografia1']}}">
            @endif


            <div class="container" id="piezas_categorias">
                <!-- Logo -->
                <div class="d-flex align-items-center justify-content-between">
                    <a href="/" class="logo d-flex align-items-center">
                        <!-- añadir ruta -->
                        <img src="/storage/images/{{ $opciones['logo'] }}" alt="logotipo"
                            width="{{$opciones['logo_ancho']}}" height="{{$opciones['logo_alto']}}">
                        <span class="d-none d-lg-block"> </span>
                    </a>
                    <i class="bi bi-list toggle-sidebar-btn d-flex justify-content-start"></i>
                </div>
                <!-- End Logo -->

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                    aria-label="Toggle navigation">

                    <i class="fas fa-bars ms-1"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarResponsive"
                    style="--color_raton_encima_elementos_menu: {{$opciones['color_raton_encima_elementos_menu']}};    
                        --color_elementos_menu: {{$opciones['color_elementos_menu']}}; --color_cat_activa: {{$opciones['color_cat_activa']}}">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                       


                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: {{ $opciones['color_elementos_menu'] }} !IMPORTANT; font-family: {{ $opciones['tipografia1'] }} !IMPORTANT; margin-bottom: 1em; margin-right: 2em">
                                COLECCIONES
                            </button>

                            <ul class="dropdown-menu" style="background-color: {{ $opciones['color_nav'] }}; font-family: {{ $opciones['tipografia1'] }} !IMPORTANT">
                                
                                @foreach($categoriasList as $cat)
                                @if(isset($categoria))
                                
                                @if(Request::segment(2) == $cat->id)
                                <li class="nav-item"  style="color:black; width:auto">
                                    <a class="nav-link {{optional($categoria)->id == $cat->id ? 'active' : ''}}"
                                    href="/categoria/{{$cat->id}}"  style="color:black">
                                {{$cat->name}}
                            </a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="/categoria/{{$cat->id}}">{{$cat->name}}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="/categoria/{{$cat->id}}">
                                {{$cat->name}}
                            </a>
                        </li>
                        @endif
                        @endforeach

                        </ul>
                        
                    </div>
                    @if ($opciones['acerca_de_visibilidad'] != 0)
                        @if (Route::current()->getName() == 'acerca_de')
                        <li class="nav-item">
                            <a class="nav-link active"
                            href="{{route('acerca_de')}}">{{$opciones['acerca_de_texto_menu']}}</a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('acerca_de')}}">{{$opciones['acerca_de_texto_menu']}}</a>
                        </li>
                        @endif
                        @endif
                        @if (Route::current()->getName() == 'vistaBuscador')
                        <li class="nav-item">
                            <a class="nav-link active" href="{{route('vistaBuscador')}}">Buscador</a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('vistaBuscador')}}">Buscador</a>
                        </li>
                        @endif
                </ul>
            </div>
            @if((Route::current()->getName() != 'home') && (Route::current()->getName() != 'vistaBuscador'))
            <!-- Buscador -->
            @if(isset($categoria))
                <div class="p-1 searchParent" style="font-family: {{$opciones['tipografia1']}}">
                    <form action="{{route('productoPorCategoria', [$categoria->id ?? ''])}}" action="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" id="texto" name="textoBusqueda"
                                placeholder="Buscar en {{$categoria->name ?? ''}}"
                                value="{{isset($textoBusqueda) ? $textoBusqueda : ''}}">
                            <button class="btn btn-light" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                            <button class="btn btn-light" type="button" onclick="showInfoMessage()" style="font-size: 22px; border-left: 2px solid #000;">
                                ⓘ
                            </button>                            
                        </div>
                    </form>
                </div>
            @endif
            <!-- Fin Buscador -->
            @endif
        </div>
        </nav>
        <!-- Fin menu -->
        <script src="/js/main.js"></script>
        <!-- Nuestro js-->
        <script src="/js/frontScripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>

        <style>
            /* Estilos para el mensaje emergente */
            #info-message {
                position: fixed;
                top: 80px;
                right: 10px;
                padding: 5px 10px;
                background-color: #ffffff;
                color: #000000;
                font-size: 12px;
                z-index: 9999;
                display: none;
            }
        </style>

        <script>
            // Función para mostrar el mensaje de información durante unos segundos
            function showInfoMessage() {
                var message = 'Para buscar coincidencias exactas, puedes utilizar comillas "". Por ejemplo, si buscas "hola pepe 33" entre comillas, el buscador mostrará los objetos que contengan esa combinación de palabras.';
                var duration = 5000; // Duración en milisegundos (5 segundos)

                // Crear y mostrar el elemento del mensaje
                var infoMessage = document.createElement('div');
                infoMessage.id = 'info-message';
                infoMessage.textContent = message;
                document.body.appendChild(infoMessage);

                // Mostrar el mensaje
                infoMessage.style.display = 'block';

                // Ocultar el mensaje después de la duración especificada
                setTimeout(function () {
                    infoMessage.style.display = 'none';
                }, duration);
            }
        </script>
    
</div>
    <!-- Footer-->
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
    
        .wrapper {
            min-height: 100%;
            position: relative;
        }
    
        .content {
            padding-bottom: 60px; /* Altura del footer */
        }
    
        footer {
            padding: 20px;
            text-align: center;
            width: 100%;
            position: sticky;
            bottom: 0;
            background-color: {{ $opciones['color_nav'] }};
        }
    </style>
    
    
        <footer class="footer">
            <div class="row align-items-center" style="font-family: {{$opciones['tipografia1']}}">
                <div class="col-lg-4 text-lg-start"><b>Si estás interesado en exponer tu arte online contáctanos: <br>  <div class="colores" style="color: blue">juan.baronviciana@gmail.com - josemanuelgallurt24@gmail.com</b></div></div>
                <div class="col-lg-4 my-3 my-lg-0">
                    <a rel="license" href="http://creativecommons.org/licenses/by-nc/4.0/"><img alt="Licencia de Creative Commons" style="border-width:0" src="https://i.creativecommons.org/l/by-nc/4.0/88x31.png" /></a>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a class="link-dark text-decoration-none me-3" href="{{route('politica_privacidad')}}">Politíca de Privacidad</a>
                    <a class="link-dark text-decoration-none me-3" href="{{route('politica_cookies')}}">Política de cookies</a>
                    <a class="link-dark text-decoration-none me-3" href="{{route('terminos_uso')}}">Términos de uso</a>
                </div>
            </div>
        </footer>
    </div>
    
   
</body>

</html>