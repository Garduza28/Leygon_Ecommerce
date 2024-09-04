<style>
    .title-container {
        position: relative;
        z-index: 1; /* Asegura que el contenido esté por delante de otros elementos */
    }

    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.95); /* Fondo blanco semi-transparente */
        color: black; /* Texto en color negro para contrastar */
        display: flex;
        justify-content: center;
        align-items: center;
        opacity: 0;
        transition: opacity 0.3s;
        text-align: center;
        padding-bottom: 12%; /* Aumenta el padding para más espacio */
        box-sizing: border-box;
        z-index: 2; /* Asegura que esté por delante de otros elementos */
        pointer-events: none; /* Asegura que el overlay no capture eventos de puntero */
        border-radius: 10px; /* Añade esquinas redondeadas al overlay */
    }

    .title-container:hover .overlay {
        opacity: 1;
    }

    .overlay h5 {
        font-size: 16px;
        margin: 0;
        background-color: white; /* Fondo blanco para el texto */
        padding: 10px; /* Ajusta el padding para separar el texto del borde del overlay */
        border-radius: 5px; /* Opcional: añade esquinas redondeadas al fondo del texto */
    }

    .card-footer {
        position: relative; /* Añade posición relativa para asegurar que los botones estén encima del overlay */
        z-index: 3; /* Asegura que los botones estén por delante del overlay */
    }
</style>



<div class="container-fluid pt-5" style="padding-left: 70px; padding-right: 70px;">
    <div style="background: white;">
        <br>
        <center>
            <h2 class="section-title px-5"><span class="px-2">Lo Más Nuevo</span></h2>
        </center>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-5 px-xl-5 pb-3">
            @forelse ($products as $product)
                <div class="col pb-1">
                    <div class="card product-item border-0 mb-4">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            @if (filter_var($product->image_path, FILTER_VALIDATE_URL))
                                <img src="{{ $product->img_portada }}" class="img-fluid w-100" alt="{{ $product->img_portada }}">
                            @endif
                            <div class="card-body border-left border-right text-center p-0 pt-4">
                                <img src="{{ $product['img_portada'] }}" alt="{{ $product['titulo'] }}" id="img_portada" name="img_portada">
                                <div class="title-container position-relative">
                                    <h5 class="text-truncate mb-3 product-title">{{ $product->titulo }}</h5>
                                    <div class="overlay">
                                        <h5 >{{ $product->titulo }}</h5>
                                    </div>
                                </div>
                                <p class="card-text" data-precio-original="{{ $product->precio }}" data-precio-con-cambio="{{ $product->precio * $dolarPrice }}">
                                    @if (session('show_prices_with_change'))
                                        @if (session('show_prices_with_tax'))
                                            Precio : ${{ number_format($product->precio * $dolarPrice * 1.16, 2) }}
                                        @else
                                            Precio: ${{ number_format($product->precio * $dolarPrice, 2) }}
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
                                        <a href="{{ route('obtener.detalles.producto', ['productoId' => $product->producto_id]) }}" class="btn btn-sm text-dark p-0">
                                            <i class="fas fa-eye text-primary mr-1"></i>Ver detalles
                                        </a>
                                        <button type="submit" class="btn btn-sm text-dark p-0" title="add to cart">
                                            <i class="fas fa-shopping-cart text-primary mr-1"></i> Agregar al carrito
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p>No hay productos disponibles en esta clasificación.</p>
            @endforelse
        </div>
    </div>
</div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Función para sumar el IVA al precio en pesos mexicanos
            function sumarIVA() {
                // Obtener todos los elementos con la clase "card-text"
                var cardTexts = document.querySelectorAll(".card-text");

                cardTexts.forEach(function(cardText) {
                    var precioOriginal = parseFloat(cardText.dataset.precioOriginal);
                    var precioConCambio = parseFloat(cardText.dataset.precioConCambio);
                    var precioConIVA = precioConCambio * 1.16; // IVA del 16%

                    // Formatear el precio con IVA incluido
                    cardText.textContent = 'Precio MXN (con IVA): $' + new Intl.NumberFormat('es-MX', { style: 'currency', currency: 'MXN' }).format(precioConIVA);
                });
            }

            // Función para manejar el cambio de moneda y el IVA
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
                            cardText.textContent = 'Precio MXN (con IVA): ' + new Intl.NumberFormat('es-MX', { style: 'currency', currency: 'MXN' }).format(precioConIVA);
                        } else {
                            cardText.textContent = 'Precio MXN (sin IVA): ' + new Intl.NumberFormat('es-MX', { style: 'currency', currency: 'MXN' }).format(precioConCambio);
                        }
                    } else {
                        if (sumarIVA) {
                            cardText.textContent = 'Precio USD (con IVA): ' + new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(precioOriginal * 1.16);
                        } else {
                            cardText.textContent = 'Precio USD (sin IVA): ' + new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(precioOriginal);
                        }
                    }
                });
            }

            // Manejar el clic en el botón para sumar el IVA
            document.getElementById("addTaxBtn").addEventListener("click", function() {
                this.classList.toggle("checked");
                manejarCambioMonedaYIVA();
            });

            // Manejar el cambio de moneda y el IVA cuando se active el interruptor
            document.getElementById("toggleCurrency").addEventListener("change", function() {
                manejarCambioMonedaYIVA();
            });

            // Llamar a la función inicialmente para establecer los precios correctamente al cargar la página
            manejarCambioMonedaYIVA();
        });
    </script>