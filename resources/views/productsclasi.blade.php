@extends('layouts.app')


@section('content')

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<style>



.filtro-lateral {
                position: fixed;
                left: -300px;
                width: 300px;
                top: 0;
                height: 100%;
                background-color: #fff;
                box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
                transition: left 0.3s;
                z-index: 1050;
            }

            .filtro-lateral.activo {
                left: 0;
            }

            .superposicion {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1040;
                display: none;
            }

            .superposicion.activo {
                display: block;
            }

            .boton-filtro {
                border: none;
                background: none;
                font-size: 1.5rem;
                cursor: pointer;
            }

            .boton-filtro:hover {
                color: #007bff;
            }

            .ordenar-por {
                display: flex;
                align-items: center;
            }

            .ordenar-por select {
                margin-left: 10px;
            }

            .vista-iconos {
                display: flex;
                align-items: center;
                margin-left: 20px;
            }

            .vista-iconos a {
                margin-right: 10px;
                text-decoration: none;
                color: gray;
            }

            .vista-iconos a:hover {
                color: #007bff;
            }

            .vista-iconos a.active {
                color: #007bff;
            }

            .scrollable {
                max-height: 1000px;
                /* Puedes ajustar esta altura según sea necesario */
                overflow-y: auto;
            }

            /* Estilos adicionales para el filtro lateral */
            #filtro-lateral .scrollable {
                max-height: 300px;
                /* Ajusta esta altura según tus necesidades */
                overflow-y: auto;
                /* Añade el scroll vertical cuando sea necesario */
                padding-right: 10px;
                /* Añade un poco de espacio para la scrollbar */
            }


            .subcategoria-link.active,
                .marca-link.active {
                    font-weight: bold;
                    color: blue;
                    /* Cambia esto al estilo que prefieras */
                }

                .scrollable {
                    max-height: 200px;
                    /* Ajusta la altura según tus necesidades */
                    overflow-y: auto;
                }


        </style>



</style>



<div class="container-fluid">
    <div class="row align-items-center mb-3">
        <div class="col-md-3">
            <!-- Botón para abrir el filtro -->
            <button id="toggle-filtro" class="boton-filtro">&#9776; FILTROS</button>
        </div>
        <div class="col-md-5 text-center">
            Mostrando <span id="productos-mostrados"></span> Productos encontrados
        </div>
        <div class="col-md-2 ordenar-por">
            <form id="orden-form" action="{{ route('products', ['subcategoria' => $subcategoria]) }}" method="GET">
                <input type="hidden" name="subcategoria" value="{{ $subcategoria }}">
                <select class="form-select form-select-sm" name="orden" onchange="document.getElementById('orden-form').submit()">
                    <option value="descendente" {{ request('orden') == 'descendente' ? 'selected' : '' }}>Mayor Precio</option>
                    <option value="ascendente" {{ request('orden') == 'ascendente' ? 'selected' : '' }}>Menor Precio</option>
                </select>
            </form>
        </div>
    </div>

    <!-- Filtro desplegable -->
    <div id="filtro-lateral" class="filtro-lateral">
        <div class="card border-0 shadow-none">
            <div class="card-header bg-transparent border-bottom py-3 px-4">
                <h5 class="font-size-16 mb-0">
                    Filtraciones
                    <span class="float-end">
                        <!-- Icono de regresar -->
                        <button id="regresar-subcategoria" class="btn btn-sm btn-light">
                            <i class="fas fa-arrow-left"></i>
                        </button>
                        <!-- Botón de cerrar -->
                        <button id="cerrar-filtro" class="btn btn-sm btn-light">&times;</button>
                    </span>
                </h5>
            </div>
            <div class="card-body p-4 pt-2">
                <!-- Aquí van los filtros -->
                <div class="mb-3">
                    <h6>Subcategorías</h6>
                    <div class="scrollable">
                        @foreach ($subcategoriaseleccionada as $subcategoria)
                            <div class="form-check">
                                @php
                                    $subcategoria = \App\Models\Subcategoria::find($subcategoria);
                                @endphp
                                @if ($subcategoria)
                                    <a href="{{ route('productos.clasi', ['subcategoria' => $subcategoria]) }}" class="subcategoria-link">{{ $subcategoria->nombre }}</a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- Filtro por marcas -->
                <div class="mb-3">
                    <h6>Marcas</h6>
                    <div class="scrollable">
                        @foreach ($marcaseleccionada as $marca)
                            <div class="form-check">
                                <a href="{{ route('productos.brand', ['clasification' => $clasification, 'marca' => $marca]) }}" class="marca-link">{{ $marca }}</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Selecciona el botón regresar
            const regresarBtn = document.getElementById('regresar-subcategoria');

            // Añade un evento de clic al botón regresar
            regresarBtn.addEventListener('click', function(event) {
                event.preventDefault(); // Prevenir el comportamiento por defecto
                // Utilizar el historial del navegador para regresar sin recargar la página
                window.history.back();
            });

            // Selecciona el botón de cerrar
            const cerrarBtn = document.getElementById('cerrar-filtro');

            // Añade un evento de clic al botón de cerrar para ocultar la barra lateral
            cerrarBtn.addEventListener('click', function(event) {
                event.preventDefault(); // Prevenir el comportamiento por defecto
                const filtroLateral = document.getElementById('filtro-lateral');
                filtroLateral.style.display = 'none';
            });
        });
    </script>

    <!-- Superposición -->
    <div id="superposicion" class="superposicion"></div>
</div>











<main class="contenedor">
    <article>

        <div class="row px-xl-5 pb-3">
            @forelse ($products as $product)
                <div class="col-lg-3 col-md-6 col-sm-6 cat-btn">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        @if(filter_var($product->img_portada, FILTER_VALIDATE_URL))
                            <img src="{{ $product->img_portada }}" class="img-fluid category-image" alt="{{ $product->img_portada }}">
                        @else
                            <img src="{{ asset('storage/images/' . $product->img_portada) }}" class="img-fluid category-image" alt="{{ $product->img_portada }}">
                        @endif
                        <div class="card-body">
                            <br>
                            <h5 class="text-truncate mb-3">{{ $product->marca }}</h5>
                            <p class="card-text" data-precio-original="{{ $product->precio }}" data-precio-con-cambio="{{ $product->precio * $dolarPrice }}">
                                @if(session('show_prices_with_change'))
                                    @if(session('show_prices_with_tax'))
                                        Precio MXN (con IVA): ${{ number_format($product->precio * $dolarPrice * 1.16, 2) }}
                                    @else
                                        Precio MXN (sin IVA): ${{ number_format($product->precio * $dolarPrice, 2) }}
                                    @endif
                                @else
                                    Precio: ${{ $product->precio }}
                                @endif
                            </p>
                            <form action="{{ route('cart.store') }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" value="{{ $product->id }}" id="id" name="id">
                                <input type="hidden" value="{{ $product->titulo }}" id="titulo" name="name">
                                <input type="hidden" value="{{ $product->precio }}" id="price" name="price">
                                <input type="hidden" value="{{ $product->img_portada }}" id="img" name="img">
                                <input type="hidden" value="{{ $product->titulo }}" id="titulo" name="titulo">
                                <input type="hidden" value="1" id="quantity" name="quantity">
                                <div class="card-footer d-flex justify-content-between bg-light border">
                                <a
                                                    href="{{ route('obtener.detalles.producto', ['productoId' => $product->producto_id]) }}"
                                                    class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Ver detalles</a>
                                    <button type="submit" class="btn btn-sm text-dark p-0" title="add to cart">
                                        <i class="fas fa-shopping-cart text-primary mr-1"></i> Agregar al carrito
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p>No hay productos disponibles</p>
            @endforelse
        </div>
    </article>
</main>
@include('partials.footer')
        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="/assets/js/iva.js"></script>
        <script src="/assets/js/dolars.js"></script>
        <script>
            // Script para abrir/cerrar el filtro desplegable
            $(document).ready(function() {
                $('#toggle-filtro').on('click', function() {
                    $('#filtro-lateral').toggleClass('activo');
                    $('#superposicion').toggleClass('activo');
                });

                $('#cerrar-filtro, #superposicion').on('click', function() {
                    $('#filtro-lateral').removeClass('activo');
                    $('#superposicion').removeClass('activo');
                });
            });
        </script>





@endsection
