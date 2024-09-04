@php
    $nuevosPrecios = session('nuevos_precios');
    session()->forget('nuevos_precios');
@endphp


@extends('layouts.app')

@section('content')

    <head>

        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>

    <style>
        .category-container {
            width: 70%;
            height: 1000px;
            overflow: hidden;
            transition: transform 0.5s;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .category-image {
            width: 100%;
            height: auto;
            object-fit: cover;
            transition: transform 0.5s;
            padding: 10px;
        }

        .cat-btn {
            text-decoration: none;


        }

        .cat-btn:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .cat-btn:hover .category-image {
            transform: scale(1.1);
        }

        .card-body {

            top: 8%;
            left: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.8);
            padding: 10px;
            text-align: left;
            box-sizing: border-box;
            z-index: 1;
        }

        <style>.custom-select-width {
            width: 15px;
        }
    </style>
    <div class="container-fluid pt-5">

        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Productos: {{ $category->name }}</span></h2>
        </div>

        <div class="col-lg-5">
            <form action="{{ route('products.category.search', ['category' => $category->id]) }}" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Buscar productos..." name="query"
                        value="{{ $query ?? '' }}">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                    </div>
                </div>
            </form>
        </div>


        <div class="row px-xl-5 pb-3">
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="orderBySelect">Ordenar por:</label>
                    <select class="custom-select-width " id="orderBySelect" onchange="handleOrderByChange(this)">
                        <option value="default">Por defecto</option>
                        <option value="price_asc">Precio ascendente</option>
                        <option value="price_desc">Precio descendente</option>
                        <option value="discount">Con descuento</option>
                    </select>
                </div>
            </div>

            <button onclick="cambiarPrecios()">Cambiar Precios</button>
        </div>
        <br>


        <div class="row px-xl-5 pb-3">
            @forelse ($products as $product)
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="card product-item border-0 mb-4">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img src="{{ asset('storage/images/' . $product->image_path) }}"
                                class="img-fluid category-image" alt="{{ $product->name }}">
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <br>
                            <h5 class="text-truncate mb-3">{{ $product->name }}</h5>
                            <p class="d-flex justify-content-center">{{ $product->description }}</p>
                            <p class="d-flex justify-content-center">Price: ${{ $product->price }}</p>
                            <p class="d-flex justify-content-center">Precio: ${{ $nuevosPrecios[0]['datos'][0]['dato'] ?? $product->price }}</p>
                            <form action="{{ route('cart.store') }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" value="{{ $product->id }}" id="id" name="id">
                                <input type="hidden" value="{{ $product->name }}" id="name" name="name">
                                <input type="hidden" value="{{ $product->price }}" id="price" name="price">
                                <input type="hidden" value="{{ $product->image_path }}" id="img" name="img">
                                <input type="hidden" value="{{ $product->slug }}" id="slug" name="slug">
                                <input type="hidden" value="1" id="quantity" name="quantity">
                                <div class="card-footer d-flex justify-content-between bg-light border">
                                    <a
                                        href="{{ route('cart.show', ['id' => $product->id]) }}"class="btn btn-sm text-dark p-0"><i
                                            class="fas fa-eye text-primary mr-1"></i>Ver detalles</a>
                                    <button type="submit" class="btn btn-sm text-dark p-0" title="add to cart">
                                        <i class="fas fa-shopping-cart text-primary mr-1"></i> Agregar al carrito
                                    </button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p>No products available in this category.</p>
            @endforelse
        </div>
    </div>
@endsection

<script>
    function handleOrderByChange(selectElement) {
        var selectedValue = selectElement.value;


        switch (selectedValue) {
            case 'default':
                window.location.href =
                    "{{ route('products.category.show', ['category' => $category->id, 'orderBy' => 'default']) }}";
                break;
            case 'price_asc':
                window.location.href =
                    "{{ route('products.category.show', ['category' => $category->id, 'orderBy' => 'price_asc']) }}";
                break;
            case 'price_desc':
                window.location.href =
                    "{{ route('products.category.show', ['category' => $category->id, 'orderBy' => 'price_desc']) }}";
                break;
            case 'discount':
                window.location.href =
                    "{{ route('products.category.show', ['category' => $category->id, 'orderBy' => 'discount']) }}";
                break;
            default:

                break;
        }
    }
</script>

<script>
    function cambiarPrecios() {
        $.ajax({
            url: '/cambiar_precios',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                alert('¡Precios actualizados con éxito!');
                window.location.reload();
            },
            error: function(error) {
                console.error('Error al actualizar precios', error);
                alert('Error al actualizar precios. Consulta la consola para más detalles.');
            }
        });

    }
</script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        $('.cart-form').submit(function(event) {
                @guest
                event.preventDefault(); // Evita que el formulario se envíe
                window.location.href =
                    "{{ route('login') }}"; // Redirige al usuario a la página de inicio de sesión
            @endguest
        });
    });
</script>
