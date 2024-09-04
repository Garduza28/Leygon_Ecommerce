@extends('layouts.app')
<link rel="stylesheet" href="assets/css/estilos.css">

@section('content')

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<style>
    p {
        text-align: justify;
    }

    .cat-btn {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
    }

    .product-img {
        width: 100%; /* Ajusta el ancho de la imagen para que ocupe el 100% del espacio disponible */
    }

    .card-body {
        flex-grow: 1; /* Permite que el contenido de la tarjeta crezca para ocupar el espacio disponible */
        margin: 0 10px; /* Margen entre la imagen y el contenido */
    }

    .card-body p {
        margin-bottom: 10px; /* Margen inferior para separar los párrafos */
    }

    .card-footer {
        flex-shrink: 0; /* Evita que el pie de la tarjeta se contraiga */
    }

    .category-header {
        font-size: 2rem; /* Tamaño de fuente grande para el encabezado de categoría */
        margin-top: 20px; /* Espacio superior */
        margin-bottom: 20px; /* Espacio inferior */
        text-align: center; /* Centrar el texto */
        font-weight: bold; /* Negrita para el texto */
    }
</style>

<main class="contenedor">
    <article>
        @foreach($productsByCategory as $categoryName => $products)
        <div class="col-12 mb-4">
            <h2 class="category-header">{{ $categoryName }}</h2>
        </div>
                @forelse ($products as $product)
                    <div class="col-12 mb-3">
                        <div class="cat-btn d-flex align-items-center justify-content-between">
                            <div class="product-img-container mr-3" style="width: 150px; height: 150px;"> <!-- Contenedor para la imagen del producto con tamaño fijo -->
                                @if(filter_var($product->img_portada, FILTER_VALIDATE_URL))
                                    <img src="{{ $product->img_portada }}" class="img-fluid category-image" alt="{{ $product->img_portada }}" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <img src="{{ asset('storage/images/' . $product->img_portada) }}" class="img-fluid category-image" alt="{{ $product->img_portada }}" style="width: 100%; height: 100%; object-fit: cover;">
                                @endif
                            </div>
                            <div class="card-body flex-grow-1 text-center" style="width: 250px;"> <!-- Contenedor para el cuerpo de la tarjeta con ancho fijo -->
                                <div style="height: 100%; display: flex; flex-direction: column; justify-content: center;"> <!-- Alinea verticalmente el contenido -->
                                    <p class="text-truncate font-size-18"><a
                                        href="{{ route('obtener.detalles.producto', ['productoId' => $product->producto_id]) }}"
                                        class="text-dark">{{ $product->titulo }} </a></p>
                                    <p class="card-text" data-precio-original="{{ $product->precio }}" data-precio-con-cambio="{{ $product->precio * $dolarPrice }}">
                                        <!-- Contenido del precio -->
                                    </p>
                                </div>
                            </div>
                            <div class="qr-container position-relative overflow-hidden bg-transparent border p-0 ml-3" style="width: 150px; height: 150px; display: flex; justify-content: center; align-items: center;"> <!-- Contenedor para el código QR con tamaño fijo y texto centrado -->
                                <img src="data:image/png;base64,{{ $product->qrCodeBase64 }}" alt="QR Code" style="width: 100px;">
                            </div>
                        </div>
                    </div>
                @empty
                    <p>No hay productos disponibles</p>
                @endforelse
            @endforeach
        </div>
    </article>
</main>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        function sumarIVA() {
            var cardTexts = document.querySelectorAll(".card-text");

            cardTexts.forEach(function(cardText) {
                var precioOriginal = parseFloat(cardText.dataset.precioOriginal);
                var precioConCambio = parseFloat(cardText.dataset.precioConCambio);
                var precioConIVA = precioConCambio * 1.16;

                cardText.textContent = 'Precio MXN (con IVA): $' + precioConIVA.toFixed(2);
            });
        }

        function manejarCambioMonedaYIVA() {
            var mostrarEnPesos = document.getElementById("toggleCurrency").checked;
            var sumarIVA = document.getElementById("addTaxBtn").classList.contains("checked");

            var cardTexts = document.querySelectorAll(".card-text");

            cardTexts.forEach(function(cardText) {
                var precioOriginal = parseFloat(cardText.dataset.precioOriginal);
                var precioConCambio = parseFloat(cardText.dataset.precioConCambio);
                var precioConIVA = precioConCambio * 1.16; // IVA del 16%

                if (mostrarEnPesos) {
                    if (sumarIVA) {
                        cardText.textContent = 'Precio MXN (con IVA): $' + precioConIVA.toFixed(2);
                    } else {
                        cardText.textContent = 'Precio MXN (sin IVA): $' + precioConCambio.toFixed(2);
                    }
                } else {
                    if (sumarIVA) {
                        cardText.textContent = 'Precio USD (con IVA): $' + (precioOriginal * 1.16).toFixed(2);
                    } else {
                        cardText.textContent = 'Precio USD (sin IVA): $' + precioOriginal.toFixed(2);
                    }
                }
            });
        }

        document.getElementById("addTaxBtn").addEventListener("click", function() {
            this.classList.toggle("checked");
            manejarCambioMonedaYIVA();
        });
        document.getElementById("toggleCurrency").addEventListener("change", function() {
            manejarCambioMonedaYIVA();
        });
        manejarCambioMonedaYIVA();
    });
</script>

@endsection
