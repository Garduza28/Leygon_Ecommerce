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
        pad
        opacity: 0;
        transition: opacity 0.3s;
        text-align: center;
        box-sizing: border-box;
        z-index: 2; /* Asegura que esté por delante de otros elementos */
        pointer-events: none; /* Asegura que el overlay no capture eventos de puntero */
        border-radius: 10px; /* Añade esquinas redondeadas al overlay */
    }

    .title-container:hover .overlay {
        opacity: 1;
    }

    .overlay-content {
        padding: 0px; /* Ajusta el padding para separar el texto del borde del overlay */
        max-width: 800px; /* Ancho máximo para el contenido */
        word-wrap: break-word; /* Rompe las palabras largas si no caben en una línea */
    }

    .overlay-actions {
        position: absolute;
        bottom: 10px;
        left: 50%
        transform: translateX(-50%);
        z-index: 3; /* Asegura que los botones estén por delante del overlay */
    }

    .overlay-actions a,
    .overlay-actions button {
        display: inline-block;
        margin: 5px;
    }

    .card-footer {
        position: relative; /* Añade posición relativa para asegurar que los botones estén encima del overlay */
        z-index: 4; /* Asegura que los botones estén por delante del overlay y de otros elementos */
    }
</style>

<div class="container-fluid pt-5" style="padding-left: 70px; padding-right: 70px;">
    <div style="background: white;">
        <div class="text-center mb-4">
            <h2 class="section-title2">
                <span style="--l: '¡O';">¡O</span>
                <span style="--l: 'f';">f</span>
                <span style="--l: 'e';">e</span>
                <span style="--l: 'r';">r</span>
                <span style="--l: 't';">t</span>
                <span style="--l: 'a';">a</span>
                <span style="--l: 's!';">s!</span>
            </h2>
        </div>
        <br>
        <br>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-5 px-xl-5 pb-3"> <!-- Cambia las clases de la fila para ajustar el número de columnas -->
            @forelse ($productos as $product)
            <div class="col pb-1"> <!-- Elimina las clases de columnas -->
                <div class="card product-item border-0 mb-4" style="font-family: Arial, sans-serif; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    <a href="{{ route('cart.show', ['id' => $product->id]) }}" style="position: relative; display: block;">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            @if (filter_var($product->img_portada, FILTER_VALIDATE_URL))
                            <img src="{{ $product->img_portada }}" class="img-fluid w-100" alt="{{ $product->img_portada }}" style="max-width: 100%; height: auto;">
                            @else
                            <img src="{{ asset('storage/images/' . $product->img_portada) }}" class="img-fluid w-100" alt="{{ $product->img_portada }}" style="max-width: 100%; height: auto;">
                            @endif
                        </div>
                    </a>
                    <div class="card-body border-left border-right text-center p-0 pt-4 ">

                        <div class="title-container position-relative">
                            <h5 class="text-truncate mb-3 product-title">{{ $product->titulo }}</h5>
                            <div class="overlay">
                                <div class="overlay-content">
                                    <h5>{{ $product->titulo }}</h5>
                                    <!-- Agrega cualquier otra información que desees mostrar aquí -->
                                </div>
                            </div>
                        </div>
                        <div class="card-text" data-precio-original="{{ $product->precio }}" data-precio-con-cambio="{{ $product->precio * $dolarPrice }}">
                            <!-- La información sobre el precio con descuento y la conversión de moneda se agregará dinámicamente por JavaScript -->
                        </div>
                        <form action="{{ route('cart.store') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" value="{{ $product->id }}" id="id" name="id">
                            <input type="hidden" value="{{ $product->titulo }}" id="titulo" name="name">
                            <input type="hidden" value="{{ $product->precio_con_descuento }}" id="price" name="price">
                            <input type="hidden" value="{{ $product->img_portada }}" id="img" name="img">
                            <input type="hidden" value="{{ $product->titulo }}" id="titulo" name="titulo">
                            <input type="hidden" value="1" id="quantity" name="quantity">
                            <div class="card-footer d-flex justify-content-between bg-light border">
                                <!-- Deja los botones fuera del overlay para que no sean cubiertos -->
                                <a href="{{ route('cart.show', ['id' => $product->id, 'titulo' => urlencode($product->titulo)]) }}"
                                    class="btn btn-sm text-dark p-0">
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
            @empty
            <p>No hay productos disponibles</p>
            @endforelse
        </div>
    </div>
</div>
