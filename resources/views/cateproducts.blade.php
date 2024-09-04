@extends('layouts.app')
<link rel="stylesheet" href="assets/css/estilos.css">

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

    /* Estilo para el interruptor */
    .toggle-switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 26px;
    }

    /* Estilo para el indicador del interruptor */
    .toggle-switch input[type="checkbox"] {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: .4s;
        border-radius: 34px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    /* Estilos para el texto del botón */
    .switch-text {
        position: relative;
        display: inline-block;
        padding-left: 28px; /* Espacio adicional para el indicador del botón */
        cursor: pointer;
    }

    /* Estilos para el indicador del botón cuando está encendido */
    .form-check-label.checked::before {
        content: "";
        position: absolute;
        top: 50%;
        left: 0;
        width: 22px;
        height: 22px;
        background-color: #28a745; /* Color del indicador cuando está encendido */
        transform: translate(-50%, -50%);
        border-radius: 50%;
    }

    /* Estilos para el indicador del botón cuando está apagado */
    .form-check-label::before {
        content: "";
        position: absolute;
        top: 50%;
        left: 0;
        width: 22px;
        height: 22px;
        background-color: #adb5bd; /* Color del indicador cuando está apagado */
        transform: translate(-50%, -50%);
        border-radius: 50%;
    }

    /* Cambia el color del texto cuando el botón está activo */
    .form-check-input:checked + .form-check-label .switch-text {
        color: #28a745; /* Color del texto cuando el botón está activo */
    }
</style>
<main class="contenedor">
    <article>
        <div class="form-check form-switch">
            <input type="hidden" id="switchState" value="on">
            <label class="form-check-label checked" for="toggleCurrency">
                <input class="form-check-input" type="checkbox" id="toggleCurrency" checked>
                <span class="switch-text">Mostrar en pesos</span>
            </label>
        </div>
        <button class="btn btn-sm text-dark p-0" id="addTaxBtn">Sumar IVA</button>

        <hr>

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
                                    <a href="{{ route('cart.show', ['id' => $product->id]) }}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Ver detalles</a>
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
