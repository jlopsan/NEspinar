<html>

<head>
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{url('css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="" class="logo d-flex align-items-center">
                <!-- añadir ruta -->
                <img src="/logo.png" alt="Celia Viñas" width="40" height="50">
                <span class="d-none d-lg-block">Museo Virtual</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn d-flex justify-content-start"></i>
        </div><!-- End Logo -->
        <!-- Buscador-->
        @yield('buscador')
        <!-- fin buscador -->

    </header>
    <!-- fin Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('/productos/') }}">
                    <i class="bi bi-folder"></i>
                    <span>Objetos</span>
                </a>
            </li>
            @if (auth()->user()->type == 'Admin' || auth()->user()->type ==  'SuperAdmin')
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('/categorias/') }}">
                    <i class="bi bi-folder"></i>
                    <span>Colecciones</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('/items/') }}">
                    <i class="bi bi-folder"></i>
                    <span>Campos</span>
                </a>
            </li>

            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('/imagenes/') }}">
                    <i class="bi bi-folder"></i>
                    <span>Imágenes</span>
                </a>
            </li> -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('/usuarios/') }}">
                    <i class="bi bi-person"></i>
                    <span>Usuarios</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('/opciones/') }}">
                    <i class="bi bi-grid"></i>
                    <span>Opciones</span>
                </a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link collapsed">
                <i class="bi-person-fill"></i>
                Hola, {{ auth()->user()->name}}
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('logout') }}">
                    <!--meter ruta -->
                    <i class="bi bi-box-arrow-in-right"></i>
                    {{ __('Cerrar Sesión') }}
                </a>
            </li>

        </ul>

    </aside><!-- End Sidebar-->
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-xxl col-md-12">
                            <div class="card info-card sales-card">
                                @section('sidebar')
                                @show
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{url('js/main.js')}}"></script>
</body>

</html>