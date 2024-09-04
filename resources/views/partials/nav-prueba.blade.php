<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
 
    <style>
        /* Reset de estilos */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Estilos generales */
        body,
        html {
            margin: 0;
            padding: 0;
            width: 100%;

            background: #ebebeb;
            font-family: Arial, sans-serif;
        }


        a {
            text-decoration: none;
        }

        .contenedor {
            margin: auto;
            width: 90%;
            max-width: 1200px;
        }

        main article {
            background: #fff;
            margin: 20px 0;
            padding: 20px;

        }

        /* Estilos del menú de navegación */
        .menu {
            background: #232F3E;
            padding: px 0;
            /* Ajuste del padding */

            width: 100%;
        }

        .menu .contenedor-botones-menu {
            display: none;
            justify-content: space-between;
        }

        .menu .contenedor-botones-menu button {
            font-size: 20px;
            color: #fff;
            padding: 5px 10px;
            /* Ajuste del padding */
            border: 1px solid transparent;
            display: inline-block;
            cursor: pointer;
            background: none;
        }

        .menu .contenedor-botones-menu button:hover {
            border: 1px solid rgba(255, 255, 255, .4);
        }

        .menu .contenedor-botones-menu .btn-menu-cerrar {
            display: none;
        }

        .menu .contenedor-botones-menu .btn-menu-cerrar.activo {
            display: inline-block;
        }

        .menu .contenedor-enlaces-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .menu .btn-departamentos {
            color: #fff;
            padding: 5px;
            /* Ajuste del padding */
            border-radius: 3px;
            display: flex;
            align-items: flex-end;
            border: 1px solid transparent;
            font-size: 12px;
            cursor: pointer;
        }

        .menu .btn-departamentos i {
            margin-left: 2px;
            /* Ajuste del margen */
            position: relative;
            bottom: 3px;
        }

        .menu .btn-departamentos:hover {
            border: 1px solid rgba(255, 255, 255, .4);
        }

        .menu .btn-departamentos span {
            display: block;
            font-size: 14px;
            font-weight: bold;
        }

        .menu .contenedor-enlaces-nav .enlaces a {
            color: #ccc;
            border: 1px solid transparent;
            padding: 5px 10px;
            /* Ajuste del padding */
            border-radius: 3px;
            font-size: 14px;
        }

        .menu .contenedor-enlaces-nav .enlaces a:hover {
            border: 1px solid rgba(255, 255, 255, .4);
        }

        /* Estilos de la grid */
        .contenedor-grid {
            position: relative;
        }

        .grid {
            width: 100%;
            display: none;
            position: absolute;
            top: 5px;
            z-index: 1000;
            grid-template-columns: auto 1fr;
            grid-template-rows: 1fr;
            grid-template-areas: "categorias subcategorias";
        }

        .grid.activo {
            display: grid;
        }

        .grid::before {
            content: "";
            display: block;
            background: transparent;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-bottom: 5px solid #fff;
            position: absolute;
            top: -5px;
            left: 65px;
        }

        .grid>div {
            background: #fff;
            box-shadow: 0px 3px 6px rgba(0, 0, 0, .10);
        }

        /* Estilos de las categorías */
        .grid .btn-regresar {
            background: #232F3E;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 3px;
            margin: 20px;
            font-size: 16px;
            cursor: pointer;
            display: none;
        }

        .grid .btn-regresar i {
            margin-right: 10px;
        }

        .grid .categorias {
            grid-area: categorias;
            padding-top: 10px;
            min-height: 300px;
            overflow: auto;
        }

        .grid .categorias .subtitulo {
            display: none;
        }

        .grid .categorias a {
            color: #000;
            font-size: 14px;
            display: flex;
            justify-content: space-between;
            padding: 10px 20px;
        }

        .grid .categorias a i {
            display: none;
        }

        .grid .categorias a:hover {
            color: #E47911;
            font-weight: bold;
        }

        .grid .categorias a:hover i {
            display: inline-block;
        }

        /* Estilos de las subcategorías */
        .grid .contenedor-subcategorias {
            grid-area: subcategorias;
        }

        .grid .subcategoria {
            display: none;
    grid-template-columns: repeat(5, 1fr); /* 5 columnas */
    gap: 10px; /* Espacio entre columnas */
    padding: 20px; /* Espaciado interior */
}

        .grid .subcategoria.activo {
    display: grid;
    grid-template-rows: 1fr; /* Divide el espacio verticalmente en una fracción igual */
    grid-template-columns: 1fr; /* Divide el espacio horizontalmente en una fracción igual */
    height: 100%; /* Ocupa toda la altura del contenedor padre */
}

.grid .subcategoria img {
    width: 100%; /* Ocupa todo el ancho disponible */
    vertical-align: top; /* Alineación vertical superior para la imagen */
    height: 100%; /* Ocupa todo el espacio vertical disponible */
    object-fit: cover; /* Ajusta la imagen para cubrir el contenedor sin distorsión */
}

.grid .enlaces-subcategoria {
    padding-top: 20px; /* Espaciado superior ajustable */
    height: 100%; /* Ocupa toda la altura disponible */
    max-height: 600px; /* Altura máxima ajustable antes de usar el desplazamiento */
    overflow: auto; /* Permitir desplazamiento vertical si el contenido excede la altura máxima */
    display: flex; /* Utiliza flexbox para distribuir los enlaces */
    flex-direction: column; /* Organiza los enlaces en una columna */
}

.grid .enlaces-subcategoria a {
    color: #000; /* Color del texto de los enlaces */
    display: block; /* Hace que los enlaces se comporten como bloques para ocupar todo el ancho disponible */
    font-size: 16px; /* Tamaño del texto ajustable */
    padding: 10px 25px; /* Relleno interior ajustable (reducido el padding vertical) */
    flex-grow: 1; /* Hace que los enlaces ocupen todo el espacio vertical disponible */
    text-decoration: none; /* Elimina el subrayado predeterminado de los enlaces */
    line-height: 1.5; /* Ajusta el espaciado entre líneas para reducir la necesidad de desplazamiento */
}

.grid .enlaces-subcategoria ul {
    display: grid;
    grid-template-columns: repeat(5, 1fr); /* 5 columnas */
    gap: 2px; /* Espacio entre columnas */
    list-style-type: none; /* Eliminar viñetas de la lista */
    padding: 0; /* Eliminar padding por defecto */
    margin: 0; /* Eliminar margen por defecto */
}





        .grid .enlaces-subcategoria a:hover {
            color: #E47911;
        }

        .grid .subtitulo {
            font-size: 18px;
            font-weight: normal;
            color: #E47911;
            padding: 10px 20px;
        }

        .grid .banner-subcategoria a {
            display: block;
            height: 100%;
        }

        .grid .galeria-subcategoria {
            display: flex;
            flex-wrap: wrap;
            align-content: start;
        }

        .grid .galeria-subcategoria a {
            width: 50%;
            height: 50%;
        }

        /* Mediaqueries */
        @media screen and (max-width: 1000px) {
            .menu .contenedor-enlaces-nav {
                padding: 0 10px;
            }

            .menu .contenedor {
                width: 100%;
            }
        }

        @media screen and (max-width: 800px) {
            .menu .contenedor {
                width: 90%;
            }

            .menu .contenedor-botones-menu {
                display: flex;
            }

            .menu .contenedor-enlaces-nav {
                padding: 10px;
                /* Ajuste del padding */
                flex-direction: column;
                align-items: flex-start;
                justify-content: flex-start;
                position: fixed;
                left: 0;
                background: #232F3F;
                height: auto;
                /* Cambio de altura fija a altura automática */
                width: 80%;
                z-index: 2000;
                transition: .3s ease all;
                transform: translate(-100%);
            }

            .menu .contenedor-enlaces-nav.activo {
                transform: translate(0%);
            }

            .menu .btn-departamentos {
                width: 100%;
                align-items: left;
                justify-content: space-between;
                cursor: pointer;
            }

            .menu .btn-departamentos i {
                position: static;
                margin-left: 10px;
                /* Ajuste del margen */
                transform: rotate(-90deg);
            }

            .menu .enlaces {
                width: 100%;
            }

            .menu .enlaces a {
                display: block;
                margin: 10px 0;
                padding: 5px 10px;
                /* Ajuste del padding */
            }


            .grid.activo {
                transform: translateX(0%);
            }

            .grid::before {
                display: none;
            }

            .grid .btn-regresar {
                display: inline-block;
            }

            .grid .categorias .subtitulo {
                display: block;
            }

            .grid .contenedor-subcategorias {
                position: absolute;
                top: 0;
                width: 100%;
                height: 100%;
                transition: .3s ease all;
                transform: translateX(-100%);
                overflow: auto;
            }

            .grid .contenedor-subcategorias.activo {
                transform: translateX(0%);
            }

            .grid .contenedor-subcategorias .subcategoria {
                grid-template-columns: 1fr;
            }

            .grid .contenedor-subcategorias .banner-subcategoria {
                width: 100%;
                min-height: 250px;
                max-height: 350px;
            }

            .grid .enlaces-subcategoria {
                min-height: 50vh;
                overflow: auto;
            }

            .grid .contenedor-subcategorias .galeria-subcategoria a {
                width: 25%;
                height: 100%;
            }
        }

        .overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.8); /* Opacidad aumentada para un fondo más oscuro */
    z-index: 999;
    display: none;
}

        .overlay.activo {
            display: block;
        }

        .cart-icon {
            background: none;
            color: inherit;

        }

        <style><style>
        /* Estilos para dispositivos móviles */
        @media (max-width: 767px) {
            .contenedor-botones-menu {
                display: flex;
                align-items: center;
            }

            .barra-busqueda {
                display: block;
                /* Mostrar la barra de búsqueda en dispositivos móviles */
                margin-left: auto;
                margin-right: 10px;
            }

            .barra-busqueda.desktop {
                display: none;
                /* Ocultar la barra de búsqueda de escritorio en dispositivos móviles */
            }
        }

        /* Estilos para dispositivos de escritorio */
        @media (min-width: 768px) {
            .contenedor-botones-menu {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .barra-busqueda2 {
                display: none;
                /* Ocultar la barra de búsqueda en dispositivos de escritorio */
            }

            .barra-busqueda.desktop {
                display: block;
                /* Mostrar la barra de búsqueda de escritorio en dispositivos de escritorio */

            }
        }






        <style>

        /* Estilos para el contenedor principal */
        /* Estilos para el contenedor principal */
        .container {
            background-color: #131921;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 5px;
            justify-content: flex-end;
        }

        /* Estilos para el interruptor */
        .switch {
            position: relative;
            display: inline-block;
            width: 40px;
            /* Ancho del interruptor */
            height: 25px;
            /* Alto del interruptor */
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: -5px;
            /* Ajusta la posición vertical hacia arriba */
            left: 0;
            right: 0;
            bottom: 3px;
            background-color: red;
            /* Color inicial del slider (rojo) */
            transition: background-color 0.4s;
            border-radius: 16px;
            /* Para hacer el slider redondeado */
            margin-top: 11px;
            /* Ajusta el margen superior para bajar el span */
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 12px;
            /* Alto del círculo dentro del slider */
            width: 12px;
            /* Ancho del círculo dentro del slider */
            left: -2px;
            /* Espaciado izquierdo del círculo */
            right: -2px;
            bottom: 2px;
            /* Espaciado inferior del círculo */
            background-color: white;
            /* Color del círculo (blanco) */
            transition: transform 0.4s;
            border-radius: 50%;
            /* Para hacer el círculo redondeado */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            /* Sombra suave */
        }

        input:checked+.slider {
            background-color: #4CAF50;
            /* Color del slider cuando está activado (verde) */
        }

        input:checked+.slider:before {
            transform: translateX(30px);
            /* Mover el círculo a la posición de activado */
        }

        /* Estilos para las banderas */
        .flag {
            height: 16px;
            /* Altura de las banderas */
            width: auto;
            /* Ancho automático de las banderas */
        }

        .flag-mexico {
            margin-right: 1px;
            /* Espaciado derecho de la bandera de México */
        }

        .flag-usa {
            margin-left: 1px;
            /* Espaciado izquierdo de la bandera de EE. UU. */
        }

        /* Media query para dispositivos móviles */
        @media (max-width: 600px) {
            .container {
                flex-direction: column;
                /* Cambia la dirección del flexbox a columna en dispositivos móviles */
                align-items: flex-end;
                /* Alinea los elementos a la derecha en dispositivos móviles */
            }



        }




        /* Estilo para el contenedor principal */
        #contenedorPrincipal {
            position: relative;
            background-color: #262c3f;

            display: flex;
            justify-content: space-between;
            /* Para alinear los elementos a los extremos */
            align-items: center;
            /* Para centrar verticalmente los elementos */
        }

        /* Estilo para el logo */
        #logo {
            width: 100px;
            /* Ancho del logo */
            height: auto;
        }

        /* Estilo para el GIF */
        #gif {
            width: 140px;
            /* Ancho del GIF */
            height: auto;
        }

        /* Estilo para la barra de búsqueda */
        .barra-busqueda {
            display: none;
            /* Oculta la barra de búsqueda por defecto */
        }

        /* Media query para dispositivos de escritorio */
        @media only screen and (min-width: 768px) {
            .barra-busqueda {
                display: block;
                /* Muestra la barra de búsqueda en dispositivos de escritorio */
                text-align: center;
                /* Centra el contenido de la barra de búsqueda */
            }
        }
    </style>
</head>

<body>


    <div id="contenedorPrincipal" style="padding-left: 70px; padding-right: 70px;  margin-bottom: 5px;">
        <div id="logo">
            <img src="/assets/img/Logo leygon DHL.png" alt="Logo">
        </div>
        @if (Auth::check())
            <a href="{{ route('perfil.formulario') }}" style="text-decoration: none;">
                @if (!empty(Auth::user()->image_url))
                    <img src="{{ Auth::user()->image_url }}" alt="Imagen de perfil de {{ Auth::user()->name }}"
                        style="width: 2.5em; height: 2.5em; border-radius: 50%; margin-right: 0.25em;">
                @endif
                <span class="text-item"
                    style="font-size: 0.9em; color: white; margin-right: 0.25em;">{{ Auth::user()->name }}</span>
                <span class="text-item" style="font-size: 0.9em; color: white;">{{ Auth::user()->apellido }}</span>
            </a>
        @endif


        <div class="barra-busqueda desktop">
            <!-- Barra de búsqueda -->
            <form class="form-inline" action="{{ route('buscar.productos') }}" method="GET">
                <input class="form-control mr-2 mr-sm-3" type="search" placeholder="Buscar" aria-label="Search"
                    name="query" style="width: 300px;">
                <button class="btn btn-outline-primary" type="submit">Buscar</button>
            </form>
        </div>
        <div id="gif">
            <img src="/assets/img/perri1.gif" alt="GIF">
        </div>
    </div>

    <nav class="menu" id="menu">
        <div class="contenedor contenedor-botones-menu">
            <!-- Botones del menú -->
            <button id="btn-menu-barras" class="btn-menu-barras"><i class="fas fa-bars"></i></button>
            <button id="btn-menu-cerrar" class="btn-menu-cerrar"><i class="fas fa-times"></i></button>
            <!-- Barra de búsqueda para dispositivos móviles -->
            <div class="barra-busqueda2">
                <form class="form-inline" action="{{ route('buscar.productos') }}" method="GET">
                    <input class="form-control mr-2 mr-sm-3" type="search" placeholder="Buscar" aria-label="Search"
                        name="query" style="width: 200px;">
                    <button class="btn btn-outline-primary" type="submit">Buscar</button>
                </form>
            </div>
        </div>

        <div class="contenedor contenedor-enlaces-nav"
            style="background-color: #131921; display: flex; justify-content: space-between; align-items: center; padding: 5px; width: 100%;">
            <!-- Botón de Departamentos -->
            <div class="btn-departamentos" id="btn-departamentos">
                <span>Departamentos</span>
                <i class="fas fa-caret-down"></i>
            </div>



            <!-- Enlaces -->
            <div class="enlaces">
                <a href="{{ url('/') }}">Inicio</a>
                <a href="{{ url('informacion') }}">Quienes somos</a>
                @guest
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}">Login</a>
                    @endif
                    <a href="{{ route('register') }}">Registro</a>
                @else
                    <a href="{{ url('/historial_compras') }}">Historial de Compras</a>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endguest
            </div>

            <div class="dropdown">
                <button class="dropdown-toggle cart-link btn btn-sm btn-transparent" type="button"
                    id="dropdownMenuCurrency" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                    style="color: #ccc; padding: 3px;">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fc/Flag_of_Mexico.svg/1024px-Flag_of_Mexico.svg.png"
                        alt="Bandera de México" class="flag flag-mexico">
                    <img src="https://img.freepik.com/vector-premium/vector-bandera-estados-unidos_1001513-9.jpg"
                        alt="Bandera de EE. UU." class="flag flag-usa">
                </button>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-sm dropdown-menu-transparent"
                    aria-labelledby="dropdownMenuCurrency">
                    <!-- Switch de moneda -->
                    <div class="switch-container">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fc/Flag_of_Mexico.svg/1024px-Flag_of_Mexico.svg.png"
                            alt="Bandera de México" class="flag flag-mexico">
                        <label class="switch">
                            <input type="checkbox" id="toggleCurrency" checked>
                            <span class="slider"></span>
                        </label>
                        <img src="https://img.freepik.com/vector-premium/vector-bandera-estados-unidos_1001513-9.jpg"
                            alt="Bandera de EE. UU." class="flag flag-usa">
                    </div>
                    <button class="btn btn-sm text-dark p-0" id="addTaxBtn">Con IVA</button>
                    <!-- Fin del switch de moneda -->
                </div>







            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const toggleCurrency = document.getElementById('toggleCurrency');
                    const flagMexico = document.querySelector('.flag-mexico');
                    const flagUSA = document.querySelector('.flag-usa');

                    // Por defecto, la bandera mostrada corresponde a la selección del switch de moneda
                    if (toggleCurrency.checked) {
                        flagMexico.style.display = 'inline-block';
                        flagUSA.style.display = 'none';
                    } else {
                        flagMexico.style.display = 'none';
                        flagUSA.style.display = 'inline-block';
                    }

                    toggleCurrency.addEventListener('change', function() {
                        if (toggleCurrency.checked) {
                            flagMexico.style.display = 'inline-block';
                            flagUSA.style.display = 'none';
                        } else {
                            flagMexico.style.display = 'none';
                            flagUSA.style.display = 'inline-block';
                        }

                        // Llama a la función actualizarTotal para actualizar el total al cambiar la moneda
                        actualizarTotal();
                    });
                });
            </script>


            <!-- Carrito de compras -->
            <div class="dropdown-cart"> <!-- Cambié la clase a dropdown-cart -->
                <a class="dropdown-toggle cart-link" href="#" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false" style="color: orange; text-decoration: none;">
                    <i class="fa fa-shopping-cart fa-lg cart-icon"></i> {{ \Cart::getTotalQuantity() }}
                </a>
                <div class="dropdown-menu dropdown-menu-right carrito" style="max-height: 400px; overflow-y: auto;">
                    <ul id="cartItemList" class="list-group" style="margin: 20px;">
                        @include('partials.cart-drop')
                    </ul>
                </div>
            </div>



            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>





            <!-- Switch de moneda -->

        </div>





        <div class="contenedor contenedor-grid">
            <div class="grid" id="grid">
                <div class="categorias">
                    <button class="btn-regresar"><i class="fas fa-arrow-left"></i> Regresar</button>
                    <h3 class="subtitulo">Categorías</h3>
                    @foreach ($subcategorias as $categoria)
                        <p><a href="#" data-categoria="{{ $categoria->nombre }}">{{ $categoria->nombre }} <i
                                    class="fas fa-angle-right"></i></a></p>
                    @endforeach
                </div>

                <div class="contenedor-subcategorias">
                    @foreach ($subcategorias as $categoria)
                        <div class="subcategoria" data-categoria="{{ $categoria->nombre }}">
                            <div class="enlaces-subcategoria">
                                <button class="btn-regresar"><i class="fas fa-arrow-left"></i>Regresar</button>
                                <h3 class="subtitulo">{{ $categoria->nombre }}</h3>
                                <ul>
                                    @foreach ($categoria->clasificaciones as $clasificacion)
                                        <li><a href="{{ route('products', $clasificacion->nombre) }}"
                                                data-categoria="{{ $clasificacion->nombre }}">{{ $clasificacion->nombre }}
                                                </a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </nav>

    <div class="overlay" id="overlay"></div>

    <script src="https://kit.fontawesome.com/2c36e9b7b1.js"></script>
    <script>
        const btnDepartamentos = document.getElementById('btn-departamentos');
        const btnCerrarMenu = document.getElementById('btn-menu-cerrar');
        const grid = document.getElementById('grid');
        const contenedorEnlacesNav = document.querySelector('#menu .contenedor-enlaces-nav');
        const contenedorSubCategorias = document.querySelector('#grid .contenedor-subcategorias');
        const overlay = document.getElementById('overlay');

        const esDispositivoMovil = () => window.innerWidth <= 800;

        btnDepartamentos.addEventListener('click', () => {
            grid.classList.add('activo');
            overlay.classList.add('activo');
        });

        btnCerrarMenu.addEventListener('click', () => {
            grid.classList.remove('activo');
            overlay.classList.remove('activo');
        });

        overlay.addEventListener('click', () => {
            grid.classList.remove('activo');
            overlay.classList.remove('activo');
        });

        document.querySelectorAll('#menu .categorias a').forEach((elemento) => {
            elemento.addEventListener('mouseenter', (e) => {
                if (!esDispositivoMovil()) {
                    document.querySelectorAll('#menu .subcategoria').forEach((categoria) => {
                        categoria.classList.remove('activo');
                        if (categoria.dataset.categoria == e.target.dataset.categoria) {
                            categoria.classList.add('activo');
                        }
                    });
                }
            });
        });

        // EventListeners para dispositivo movil.
        document.querySelector('#btn-menu-barras').addEventListener('click', (e) => {
            e.preventDefault();
            if (contenedorEnlacesNav.classList.contains('activo')) {
                contenedorEnlacesNav.classList.remove('activo');
                document.querySelector('body').style.overflow = 'visible';
            } else {
                contenedorEnlacesNav.classList.add('activo');
                document.querySelector('body').style.overflow = 'hidden';
            }
        });

        // Click en boton de todos los departamentos (Para version movil).
        btnDepartamentos.addEventListener('click', (e) => {
            e.preventDefault();
            grid.classList.add('activo');
            overlay.classList.add('activo');
        });

        // Boton de regresar en el menu de categorias
        document.querySelector('#grid .categorias .btn-regresar').addEventListener('click', (e) => {
            e.preventDefault();
            grid.classList.remove('activo');
            overlay.classList.remove('activo');
        });

        document.querySelectorAll('#menu .categorias a').forEach((elemento) => {
            elemento.addEventListener('click', (e) => {
                if (esDispositivoMovil()) {
                    contenedorSubCategorias.classList.add('activo');
                    document.querySelectorAll('#menu .subcategoria').forEach((categoria) => {
                        categoria.classList.remove('activo');
                        if (categoria.dataset.categoria == e.target.dataset.categoria) {
                            categoria.classList.add('activo');
                        }
                    });
                }
            });
        });

        // Boton de regresar en el menu de categorias
        document.querySelectorAll('#grid .contenedor-subcategorias .btn-regresar').forEach((boton) => {
            boton.addEventListener('click', (e) => {
                e.preventDefault();
                contenedorSubCategorias.classList.remove('activo');
            });
        });

        btnCerrarMenu.addEventListener('click', (e) => {
            e.preventDefault();
            document.querySelectorAll('#menu .activo').forEach((elemento) => {
                elemento.classList.remove('activo');
            });
            document.querySelector('body').style.overflow = 'visible';
        });
        overlay.addEventListener('click', () => {
            grid.classList.remove('activo');
            overlay.classList.remove('activo');
            contenedorEnlacesNav.classList.remove('activo');
            document.querySelector('body').style.overflow = 'visible'; // Restaurar el desplazamiento del cuerpo
        });
        document.body.addEventListener('click', (event) => {
            if (contenedorEnlacesNav.classList.contains('activo') && !event.target.closest('#menu')) {
                contenedorEnlacesNav.classList.remove('activo');
                overlay.classList.remove('activo');
                document.querySelector('body').style.overflow = 'visible'; // Restaurar el desplazamiento del cuerpo
            }
        });
    </script>
    <script>
        // Obtener el elemento del interruptor y el estado guardado en el almacenamiento local
        const toggleSwitch = document.getElementById('toggleCurrency');
        const savedState = localStorage.getItem('toggleState');

        // Configurar el interruptor en función del estado guardado
        if (savedState === 'on') {
            toggleSwitch.checked = true;
        } else {
            toggleSwitch.checked = false;
        }

        // Escuchar el evento de cambio en el interruptor
        toggleSwitch.addEventListener('change', function() {
            // Guardar el estado del interruptor en el almacenamiento local
            if (this.checked) {
                localStorage.setItem('toggleState', 'on');
            } else {
                localStorage.setItem('toggleState', 'off');
            }
        });
    </script>
</body>

</html>
