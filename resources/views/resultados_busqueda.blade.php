@extends('layouts.app')

@section('content')

    <head>
        <meta charset="utf-8">


        <title>shopping cart with selected products order summary and checkout button - Bootdey.com</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <style type="text/css">
            body {
                margin-top: 20px;
                background-color: #f1f3f7;
            }

            .avatar-lg {
                height: 10rem;
                width: 14rem;
            }

            .font-size-18 {
                font-size: 18px !important;
            }

            .text-truncate {
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }

            a {
                text-decoration: none !important;
            }

            .w-xl {
                min-width: 160px;
            }

            .card {
                margin-bottom: 24px;
                -webkit-box-shadow: 0 2px 3px #e4e8f0;
                box-shadow: 0 2px 3px #e4e8f0;
            }

            .card {
                position: relative;
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-orient: vertical;
                -webkit-box-direction: normal;
                -ms-flex-direction: column;
                flex-direction: column;
                min-width: 0;
                word-wrap: break-word;
                background-color: #fff;
                background-clip: border-box;
                border: 1px solid #eff0f2;
                border-radius: 1rem;
            }

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
        </style>


        <!-- Otras etiquetas meta y enlaces -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    </head>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css"
        integrity="sha256-NAxhqDvtY0l4xn+YVa6WjAcmd94NNfttjNsDmNatFVc=" crossorigin="anonymous" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">



    <body>

        <div class="container-fluid">
            <div class="row align-items-center mb-3">
                <div class="col-md-3">
                    <!-- Botón para abrir el filtro -->
                    <button id="toggle-filtro" class="boton-filtro">&#9776; FILTROS</button>
                </div>
                <div class="col-md-5 text-center">
    Mostrando <span id="productos-mostrados">{{ $numProductosMostrados }}</span>  Productos encontrados
</div>

                <div class="col-md-2 ordenar-por">
                    <form method="GET" action="{{ route('buscar') }}">
                        <span>Ordenar </span> <span> por:</span>
                        <select class="form-select form-select-sm" name="orden" onchange="this.form.submit()">
                            <option value="descendente" {{ request('orden') == 'descendente' ? 'selected' : '' }}>Mayor Precio</option>
                            <option value="ascendente" {{ request('orden') == 'ascendente' ? 'selected' : '' }}>Menor Precio</option>
                        </select>
                        <input type="hidden" name="query" value="{{ $query }}">
                        <input type="hidden" name="subcategoria" value="{{ $subcategoriaSeleccionada }}">
                        <input type="hidden" name="marca" value="{{ $marcaSeleccionada }}">
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
                                <button id="cerrar-filtro" class="btn btn-sm btn-light">
                                    &times;
                                </button>
                            </span>
                        </h5>
                    </div>
                    <div class="card-body p-4 pt-2">
                        <!-- Aquí van los filtros -->
                        <div class="mb-3">
                            <h6>Subcategorías</h6>
                            <div class="scrollable">
                                @foreach ($productSubcategories as $subcategoria_id)
                                    @php
                                        $subcategoria = \App\Models\Subcategoria::find($subcategoria_id);
                                    @endphp
                                    @if ($subcategoria)
                                        <div class="form-check">
                                            <a href="{{ route('buscar.productos', ['subcategoria' => $subcategoria_id]) }}"
                                                class="subcategoria-link">{{ $subcategoria->nombre }}</a>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="mb-3">
                            <h6>Marcas</h6>
                            <div class="scrollable">
                                @foreach ($productBrands as $brand_id)
                                    <div class="form-check">
                                        <a href="{{ route('buscar.productos', ['subcategoria' => $subcategoriaSeleccionada, 'query' => $query, 'marca' => $brand_id]) }}"
                                            class="marca-link {{ $brand_id == $marcaSeleccionada ? 'active' : '' }}">
                                            {{ $brand_id }}
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <style>
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

            <div class="row justify-content-center">
                <div class="col-xl-8">
                    @foreach ($resultados as $product)
                        <div class="card border shadow-none">
                            <div class="card-body">

                                <div class="d-flex align-items-start border-bottom pb-3">
                                    <div class="me-4">
                                        @if (filter_var($product->img_portada, FILTER_VALIDATE_URL))
                                            <img src="{{ $product->img_portada }}" class="avatar-lg rounded"
                                                alt="{{ $product->img_portada }}">
                                        @else
                                            <img src="{{ asset('storage/images/' . $product->img_portada) }}"
                                                class="avatar-lg rounded" alt="{{ $product->img_portada }}">
                                        @endif
                                    </div>

                                    <div class="flex-grow-1 align-self-center overflow-hidden">
                                        <div>
                                            <h5 class="text-truncate font-size-18"><a
                                                    href="{{ route('obtener.detalles.producto', ['productoId' => $product->producto_id]) }}"
                                                    class="text-dark">{{ $product->titulo }} </a></h5>
                                            <p class="text-muted mb-0">
                                                <i class="mdi mdi-star text-warning"></i>
                                                <i class="mdi mdi-star text-warning"></i>
                                                <i class="mdi mdi-star text-warning"></i>
                                            </p>
                                            <p class="mb-0 mt-1">Marca: <span
                                                    class="fw-medium">{{ $product->brand_id }}</span></p>
                                            <p class="mb-0 mt-1"> <a
                                                    href="{{ route('obtener.detalles.producto', ['productoId' => $product->producto_id]) }}"
                                                    class="btn btn-sm text-dark p-0">
                                                    <i class="fas fa-eye text-primary mr-1"></i>Ver detalles
                                                </a>
                                            <form action="{{ route('cart.store') }}" method="POST">
                                                {{ csrf_field() }}
                                                <input type="hidden" value="{{ $product->id }}" id="id"
                                                    name="id">
                                                <input type="hidden" value="{{ $product->titulo }}" id="titulo"
                                                    name="name">
                                                @if ($product->descuento > 0)
                                                    <input type="hidden" value="{{ $product->precio_con_descuento }}"
                                                        id="price" name="price">
                                                @else
                                                    <input type="hidden" value="{{ $product->precio }}" id="price"
                                                        name="price">
                                                @endif
                                                <input type="hidden" value="{{ $product->img_portada }}" id="img"
                                                    name="img">
                                                <!-- Agregar la imagen del producto aquí -->
                                                <input type="hidden" value="{{ $product->titulo }}" id="titulo"
                                                    name="titulo">
                                                <input type="hidden" value="1" id="quantity" name="quantity">


                                                <button type="submit" class="btn btn-sm text-dark p-0"
                                                    title="add to cart">
                                                    <i class="fas fa-shopping-cart text-primary mr-1"></i> Agregar al
                                                    carrito
                                                </button>


                                            </form></span></p>
                                            <p class="card-text" data-precio-original="{{ $product->precio }}"
                                                data-precio-con-cambio="{{ $product->precio * $dolarPrice }}">
                                                @if (session('show_prices_with_change'))
                                                    @if (session('show_prices_with_tax'))
                                                        Precio :
                                                        ${{ number_format($product->precio * $dolarPrice * 1.16, 2) }}
                                                    @else
                                                        Precio: ${{ number_format($product->precio * $dolarPrice, 2) }}
                                                    @endif
                                                @else
                                                    Precio: ${{ $product->precio }}
                                                @endif
                                            </p>
                                            <p class="mb-0 mt-1">Marca: <span
                                                    class="fw-medium">{{ $product->brand_id }}</span></p>
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0 ms-2">
                                        <ul class="list-inline mb-0 font-size-16">
                                            <li class="list-inline-item">
                                                <a href="#" class="text-muted px-1">
                                                    <i class="mdi mdi-heart-outline"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
        </div>
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

        <script>
            $('.filtro-subcategoria').on('click', function(e) {
                e.preventDefault();
                var subcategoriaSeleccionada = $(this).data('subcategoria');

                $.ajax({
                    type: 'GET',
                    url: '{{ route('buscar.productos') }}', // Ruta de tu controlador Laravel
                    data: {
                        subcategoria: subcategoriaSeleccionada
                    },
                    success: function(data) {
                        // Actualiza la lista de productos con los resultados recibidos
                        $('#resultados-productos').html(data);
                    },
                    error: function(xhr, status, error) {
                        // Maneja el error si la solicitud falla
                        console.error(error);
                    }
                });
            });
        </script>
    @endsection
