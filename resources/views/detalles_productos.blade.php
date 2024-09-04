@extends('layouts.app')
<style>
    .custom-size {
        width: 300px;
        /* Puedes ajustar este valor según tu preferencia */
        height: auto;
        /* Esto mantendrá la proporción de la imagen */
    }


    .marca-logo {
        width: 150px;
        /* Cambia el valor a lo que necesites */
        /* Otros estilos si es necesario */
    }

    .marca-logo img {
        max-width: 100%;
        /* Para asegurarse de que la imagen se ajuste al ancho del div */
        height: auto;
        /* Para mantener la proporción */
        margin-top: 10px;
    }

    .zoomable-image:hover {
        transform: scale(90);
        /* Ajusta el nivel de zoom aquí según tus preferencias */
    }

    .precio-descuento {
        color: red;
        /* color para el precio con descuento */
        font-weight: bold
    }

    .zoom-container {
        position: relative;
        width: 100%;
        overflow: hidden;
        border: 1px solid #ccc;
    }

    .zoomable-image {
        width: 100%;
        transition: transform 0.3s ease;
    }

    .zoomable-image.zoomed {
        transform: scale(2);
        /* Ajusta el nivel de zoom aquí según tus preferencias */
        position: absolute;
        z-index: 999;
    }

    #image-container {
        overflow: hidden;
        position: relative;
    }

    .zoom-overlay {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background: rgba(255, 255, 255, 0.5);
        display: none;
        pointer-events: none;
    }

    .zoomed .zoom-overlay {
        display: block;
    }

    .user-info {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        /* Espacio entre cada comentario */
    }

    .user-image {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        overflow: hidden;
        margin-right: 10px;
        /* Espacio entre la imagen y el nombre */
    }

    .user-image img {
        width: 100%;
        height: auto;
    }

    .user-details {
        margin-left: 10px;
    }

    .user-name {
        font-weight: bold;
        margin-bottom: 3px;
        /* Espacio entre el nombre y la fecha */
    }

    .post-date {
        font-size: 12px;
        color: #888;
        margin-bottom: 5px;
        /* Espacio entre la fecha y el rating */
    }

    .rating {
        margin-bottom: 5px;
        /* Espacio entre el rating y el comentario */
    }

    .rating i {
        color: #FFD700;
        font-size: 16px;
    }

    .media-body {
        margin-top: 10px;
        /* Espacio entre cada comentario y el siguiente */
    }

    .marca-logo2 {
        margin-bottom: 10px;
        /* Ajusta el valor según la separación que desees */
    }

    .product-details {
        background: #fff;
        padding: 30px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        overflow: hidden;
        position: relative;
    }

    .product-details h2 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    .description p {
        margin-bottom: 15px;
        line-height: 1.6;
        font-size: 16px;
    }

    .description img {
        max-width: 100%;
        height: auto;
        display: block;
        margin: 0 auto 15px;
    }

    .description ul {
        margin-bottom: 15px;
        padding-left: 10px;
        /* Ajusta este valor para mover el texto más a la derecha */
        list-style-type: none;
    }

    .description ul li {
        margin-bottom: 10px;
        position: relative;
    }

    .description ul li:before {
        content: "\2022";
        position: absolute;
        left: -10px;
        /* Ajusta este valor para que el punto de la lista se mueva en consecuencia */
        color: #333;
    }

    .main-image {
        display: block;
        margin: 0 auto;
    }

    .additional-images-container {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
    }

    .additional-image {
        cursor: pointer;
        padding: 5px;
        border: 1px solid rgba(0, 0, 0, 0.1);
        /* Cambiar el color y la opacidad del borde */
        background-color: white;
    }

    .additional-images-container {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
        overflow: hidden;
        justify-content: center;
        /* Alineación horizontal centrada */
        align-items: center;
        /* Alineación vertical centrada */
    }
    .slick {
        height: 300px; /* Ajusta la altura según tus necesidades */
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .slick-content {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
</style>
@section('content')

    <head>

        <link rel="stylesheet" href="/assets/css/stylescarouselimgs2.css">
    </head>
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 pb-5">
                <div class="image-container zoom-container" id="image-container"
                    style="background-color: white; padding: 10px; border-radius: 5px;">
                    @if (filter_var($product->img_portada, FILTER_VALIDATE_URL))
                        <img src="{{ $product->img_portada }}" class="img-fluid category-image zoomable-image main-image"
                            alt="{{ $product->img_portada }}" id="product-image">
                    @else
                        <img src="{{ asset('storage/images/' . $product->img_portada) }}"
                            class="img-fluid category-image zoomable-image main-image" alt="{{ $product->img_portada }}"
                            id="product-image">
                    @endif
                </div>

                @if (count($detallesProducto['imagenes']) > 1)
                    <div class="additional-images-container" style="margin-top: 20px;">
                        @foreach ($detallesProducto['imagenes'] as $imagen)
                            <img src="{{ $imagen['imagen'] }}" alt="Imagen del Producto" width="63"
                                class="additional-image" onclick="changeMainImage('{{ $imagen['imagen'] }}')"
                                style="border: 1px solid #ccc; margin-right: 5px; margin-bottom: 5px;">
                        @endforeach
                    </div>
                @endif
            </div>
            <!-- Modal para mostrar la imagen con zoom -->
            <div class="modal fade" id="zoomModal" tabindex="-1" aria-labelledby="zoomModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <!-- Agregar flechas -->
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <button class="btn btn-light" id="prev-image"><i class="fas fa-chevron-left"></i></button>
                                <img src="" class="img-fluid" id="zoomed-image" alt="Zoomed Image">
                                <button class="btn btn-light" id="next-image"><i class="fas fa-chevron-right"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-lg-7 mt-lg">
                <div class="product-details">
                    <h3>{{ $product->titulo }}</h3>
                    <div class="d-flex mb-3">
                        @php
                            $filledStars = floor($totalStarPercentage / 20);
                            $halfStar = $totalStarPercentage % 20 >= 10;
                        @endphp

                        {{-- Mostrar estrellas completas --}}
                        @for ($j = 0; $j < min($filledStars, 5); $j++)
                            <i class="fas fa-star"></i>
                        @endfor

                        {{-- Mostrar media estrella si corresponde --}}
                        @if ($halfStar && $filledStars < 5)
                            <i class="fas fa-star-half-alt"></i>
                        @endif

                        {{-- Rellenar el resto de las estrellas con estrellas vacías --}}
                        @for ($k = $filledStars + ($halfStar ? 1 : 0); $k < 5; $k++)
                            <i class="far fa-star"></i>
                        @endfor

                        {{-- Mostrar el porcentaje y el total de reviews --}}
                        <small class="pt-1">({{ round($totalStarPercentage, 1) }}%)</small>
                        <small class="pt-1">({{ $totalReviews }} Reviews)</small>
                    </div>
                    <h5>Modelo: {{ $product->modelo }}</h5>
                    <h5>Marca: {{ $product->brand_id }} </h5>
                    <h5>Peso: {{ $detallesProducto['peso'] }} kg</h5>
                    <h5>Unidad de Medida: {{ $detallesProducto['unidad_de_medida']['nombre'] }}</h5>
                    @if (isset($detallesProducto['alto']) && is_numeric($detallesProducto['alto']) && $detallesProducto['alto'] !== 0)
                        <h5>Alto: {{ $detallesProducto['alto'] }} cm</h5>
                    @endif

                    @if (isset($detallesProducto['largo']) && is_numeric($detallesProducto['largo']) && $detallesProducto['largo'] !== 0)
                        <h5>Largo: {{ $detallesProducto['largo'] }} cm</h5>
                    @endif

                    @if (isset($detallesProducto['ancho']) && is_numeric($detallesProducto['ancho']) && $detallesProducto['ancho'] !== 0)
                        <h5>Ancho: {{ $detallesProducto['ancho'] }} cm</h5>
                    @endif
                    <p class="card-text" data-precio-original="{{ $product->precio }}"
                        data-precio-con-cambio="{{ $product->precio * $dolarPrice }}">
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
                    <li>Total Existencia: {{ $detallesProducto['total_existencia'] }}</li>
                    <div class="marca-logo">
                        @if (filter_var($product->marca_logo, FILTER_VALIDATE_URL))
                            <img src="{{ $product->marca_logo }}" class="img-fluid category-image custom-size"
                                alt="{{ $product->marca_logo }}">
                        @else
                            <img src="{{ asset('storage/images/' . $product->marca_logo) }}"
                                class="img-fluid category-image custom-size" alt="{{ $product->marca_logo }}">
                        @endif
                    </div>

                    @if ($product->precio > 0) <!-- Agregar esta condición -->
                        @if ($detallesProducto['total_existencia'] > 0)
                            <form action="{{ route('cart.store') }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" value="{{ $product->id }}" id="id" name="id">
                                <input type="hidden" value="{{ $product->titulo }}" id="titulo" name="name">
                                @if ($product->descuento > 0)
                                    <input type="hidden" value="{{ $product->precio_con_descuento }}" id="price"
                                        name="price">
                                @else
                                    <input type="hidden" value="{{ $product->precio }}" id="price" name="price">
                                @endif
                                <input type="hidden" value="{{ $product->img_portada }}" id="img" name="img">
                                <input type="hidden" value="{{ $product->titulo }}" id="titulo" name="titulo">
                                <input type="hidden" value="1" id="quantity" name="quantity">
                                <div class="text-right">
                                    <button type="submit" class="btn btn-sm text-dark p-0" title="add to cart">
                                        <i class="fas fa-shopping-cart text-primary mr-1"></i> Agregar al carrito
                                    </button>
                                </div>
                            </form>
                        @else
                            <!-- Aquí puedes mostrar un mensaje o simplemente no renderizar nada -->
                            <p>No hay existencias disponibles para este producto.</p>
                        @endif
                    @else
                        <p>No esta disponible este producto.</p>
                    @endif


                    <div class="d-flex pt-2">
                        <p class="text-dark font-weight-medium mb-0 mr-2">Share on:</p>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h5 class="text-center">Recursos</h5>
        <div class="row">
            <div class="col-md-12 text-center">
                <ul class="list-unstyled">
                    @foreach ($detallesProducto['recursos'] as $recurso)
                        <li class="d-inline-block">
                            <h6 class="d-inline-block">
                                <a class="btn btn-primary btn-xxs mr-2" href="{{ $recurso['path'] }}"
                                    target="_blank">{{ $recurso['recurso'] }}</a>
                            </h6>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="product-details">
            <h2>Descripción del Producto</h2>
            <div class="description">
                {!! $detallesProducto['descripcion'] !!}
            </div>
            </li>
        </div>
        </ul>
        <div class="row px-xl-5">
    <div class="col">
        <div class="nav nav-tabs justify-content-center border-secondary mb-4">
            <!-- Aquí van las pestañas si es necesario -->
        </div>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="tab-pane-3">
                <div class="row">
                    <div class="col-md-6">
                        <!-- Iterar sobre los comentarios y mostrarlos -->
                        @foreach ($reviews as $review)
                        @if ($review->product_id == $product->id)
                        <div class="media mb-4">
                            <div class="user-info">
                                <img src="{{ $review->user->image_url }}" alt="User Image" class="user-image">
                                <span class="user-name">{{ $review->user->name }}</span>
                            </div>
                            <div class="media-body">
                                <br><small><i>{{ $review->created_at->format('d M Y') }}</i></small></br>
                                <div class="text-primary mb-2">
                                    @for ($i = 0; $i < $review->rating; $i++)
                                    <i class="fas fa-star"></i>
                                    @endfor
                                    @for ($i = $review->rating; $i < 5; $i++)
                                    <i class="far fa-star"></i>
                                    @endfor
                                </div>
                                <p>{{ $review->comment }}</p>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                    <div class="col-md-6">
                        <div class="comment-container" style="height: 400px; overflow-y: auto;">
                            <div class="bg-white">
                                <h4 class="mb-4">Dejar un comentario</h4>
                                <small>Su dirección de correo electrónico no será publicada. Los campos obligatorios están marcados *</small>

                                <div class="container">
                                    <form id="reviewForm" method="POST" action="{{ route('reviews.store', $product->id) }}">
                                        @csrf
                                        <div class="d-flex my-3">
                                            <p class="mb-0 mr-2">Tu clasificación * :</p>
                                            <div class="text-primary" id="rating-stars">
                                                <input type="hidden" name="rating" id="rating" value="0">
                                                <i class="far fa-star star" data-rating="1"></i>
                                                <i class="far fa-star star" data-rating="2"></i>
                                                <i class="far fa-star star" data-rating="3"></i>
                                                <i class="far fa-star star" data-rating="4"></i>
                                                <i class="far fa-star star" data-rating="5"></i>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="comment">Comentario *:</label>
                                            <textarea name="comment" id="comment" class="form-control" rows="5" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Enviar opinión</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

   
    <div class="Carousel bg-white">
        <h2>Productos Relacionados</h2>
        <div class="slick-list" id="slick-list" style="height: 500px;"> <!-- Ajusta la altura según tus necesidades -->
            <button class="slick-arrow slick-prev" id="button-prev" data-button="button-prev" onclick="app.processingButton(event)">
                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-left" class="svg-inline--fa fa-chevron-left fa-w-10" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                    <path fill="currentColor" d="M34.52 239.03L228.87 44.69c9.37-9.37 24.57-9.37 33.94 0l22.67 22.67c9.36 9.36 9.37 24.52.04 33.9L131.49 256l154.02 154.75c9.34 9.38 9.32 24.54-.04 33.9l-22.67 22.67c-9.37 9.37-24.57 9.37-33.94 0L34.52 272.97c-9.37-9.37-9.37-24.57 0-33.94z"></path>
                </svg>
            </button>
            <div class="slick-track" id="track">
                @foreach ($detallesProducto2 as $producto)
                    <div class="slick">
                        <div class="slick-content">
                            <a href="{{ route('obtener.detalles.producto', ['productoId' => $producto['producto_id']]) }}">
                                <img src="{{ $producto['img_portada'] }}" alt="{{ $producto['titulo'] }}">
                            </a>
                            <h6>{{ strlen($producto['titulo']) > 50 ? substr($producto['titulo'], 0, 50) . '...' : $producto['titulo'] }}</h6> <!-- Limitar a 60 caracteres -->
                        </div>
                        <a href="{{ route('obtener.detalles.producto', ['productoId' => $producto['producto_id']]) }}" class="btn btn-primary btn-sm" style="text-align: center;">
                            <i class="fas fa-eye text-light mr-1"></i> Ver detalles
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="button-container">
                <button class="slick-arrow slick-next" id="button-next" data-button="button-next"
                    onclick="app.processingButton(event)">
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right"
                        class="svg-inline--fa fa-chevron-right fa-w-10" role="img" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 320 512">
                        <path fill="currentColor"
                            d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z">
                        </path>
                    </svg>
                </button>
            </div>
        </div>
    </div>


    @include('partials.footer')
    <script defer src="/assets/js/maincarouselimgs.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('reviewForm');
            form.addEventListener('submit', function(event) {
                const rating = document.getElementById('rating').value;
                if (rating === '0') {
                    alert('Por favor, seleccione una clasificación antes de enviar su comentario.');
                    event.preventDefault(); // Evitar que se envíe el formulario
                }
            });

            const stars = document.querySelectorAll('.star');
            stars.forEach(star => {
                star.addEventListener('click', function() {
                    const rating = this.getAttribute('data-rating');
                    document.getElementById('rating').value = rating;

                    // Actualizar el estilo de las estrellas
                    stars.forEach(s => {
                        const sRating = s.getAttribute('data-rating');
                        if (sRating <= rating) {
                            s.classList.remove('far');
                            s.classList.add('fas');
                        } else {
                            s.classList.remove('fas');
                            s.classList.add('far');
                        }
                    });
                });
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const container = document.querySelector(".zoom-container");
            const image = document.getElementById("product-image");
            const modal = new bootstrap.Modal(document.getElementById('zoomModal'));
            const zoomedImage = document.getElementById("zoomed-image");
            const additionalImages = {!! json_encode($detallesProducto['imagenes']) !!}; // Obtener las imágenes adicionales del producto
            let currentIndex = 0; // Índice de la imagen actual

            container.addEventListener("mousemove", function(e) {
                const {
                    left,
                    top,
                    width,
                    height
                } = container.getBoundingClientRect();
                const x = e.clientX - left;
                const y = e.clientY - top;

                const scaleX = 1.5; // Ajusta el nivel de zoom aquí según tus preferencias
                const scaleY = 1.5; // Ajusta el nivel de zoom aquí según tus preferencias

                image.style.transformOrigin = `${x}px ${y}px`;
                image.style.transform = `scale(${scaleX}, ${scaleY})`;
            });

            container.addEventListener("mouseleave", function() {
                // Restablecer el tamaño de la imagen cuando el cursor se aleje
                image.style.transform = 'scale(1)';
            });

            container.addEventListener("click", function() {
                const src = image.getAttribute("src");
                zoomedImage.src = src; // Establecer la fuente de la imagen en el modal
                modal.show(); // Mostrar el modal
            });

            // Controladores de eventos para las flechas
            document.getElementById("prev-image").addEventListener("click", function() {
                currentIndex = (currentIndex - 1 + additionalImages.length) % additionalImages.length;
                zoomedImage.src = additionalImages[currentIndex].imagen;
            });

            document.getElementById("next-image").addEventListener("click", function() {
                currentIndex = (currentIndex + 1) % additionalImages.length;
                zoomedImage.src = additionalImages[currentIndex].imagen;
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('.star');

            stars.forEach(star => {
                star.addEventListener('click', function() {
                    const rating = this.getAttribute('data-rating');
                    document.getElementById('rating').value = rating;

                    // Actualizar el estilo de las estrellas
                    stars.forEach(s => {
                        const sRating = s.getAttribute('data-rating');
                        if (sRating <= rating) {
                            s.classList.remove('far');
                            s.classList.add('fas');
                        } else {
                            s.classList.remove('fas');
                            s.classList.add('far');
                        }
                    });
                });
            });
        });
    </script>
    <script>
        function changeMainImage(src) {
            document.getElementById('product-image').src = src;
        }
    </script>
    <script src="/assets/js/iva.js"></script>
    <script src="/assets/js/dolars.js"></script>
@endsection
