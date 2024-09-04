<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>EShopper - Bootstrap Shop Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">


    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/estilosdiv.css">
</head>
<style>
    @media (max-width: 1300px) {
        .carousel-overlays {
            display: none;
            /* Oculta los contenedores de los productos en pantallas pequeñas */
        }
    }

    .cat-item {
        background-color: #ffffff;
        /* Fondo blanco */
        padding: 20px;
        /* Espacio interno */
        border: 1px solid #cccccc;
        /* Borde gris */
        border-radius: 5px;
        /* Bordes redondeados */
        height: 300px;
        /* Altura fija para el contenedor */
        display: flex;
        /* Para centrar verticalmente */
        flex-direction: column;
        /* Para asegurarse de que el texto esté debajo de la imagen */
        justify-content: center;
        /* Para centrar verticalmente */
        text-align: center;
        /* Para centrar horizontalmente el texto */
    }

    .cat-img {
        max-width: 100%;
        /* Asegura que la imagen no se desborde */
        max-height: 100%;
        /* Asegura que la imagen no se desborde */
        margin: 0 auto;
        /* Centra horizontalmente la imagen */
    }

    .carousel-container {
        position: relative;
    }

    .carousel-overlays {
        position: absolute;
        top: 79%;
        /* Cambia el valor según lo que necesites */
        left: 0;
        width: 100%;
        height: 40%;
        /* Altura ajustada según tus necesidades */
        background: linear-gradient(180deg, transparent, #ebebeb);
        /* Degradado desde transparente a #ebebeb */
        z-index: 3;
        /* Coloca los overlays encima del carrusel */
    }

    .carousel-indicators {
        /* Ajusta la posición vertical de los indicadores */
        transform: translateY(-50%);
        /* Ajusta la posición vertical de los indicadores */
        top: 80%;
        /* Cambia el valor según lo que necesites */
    }

    .carousel-indicators li {
        transition: opacity 0.s ease-in-out;
        /* Agrega una transición de opacidad */
    }

    .carousel-indicators li.active {
        opacity: 0.9;
        /* Reduce la opacidad de los indicadores no activos */
    }

    .mirage {
        position: relative;
        overflow: hidden;
    }

    .mirage img {
        display: block;
        width: 100%;
        animation: mirage 3s infinite;
    }

    @keyframes mirage {
        0% {
            transform: translateY(0) skewX(0deg);
        }

        25% {
            transform: translateY(-5px) skewX(-1deg);
        }

        50% {
            transform: translateY(0) skewX(0deg);
        }

        75% {
            transform: translateY(5px) skewX(1deg);
        }

        100% {
            transform: translateY(0) skewX(0deg);
        }
    }

    .clickable {
        cursor: pointer;
    }

    .container-card {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        background: white;
        padding: 20px;
    }

    .card {

        border: 1px solid #cccccc;
        border-radius: 15px;
        max-width: 300px;

        background: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.6s ease-out, transform 0.6s ease-out;
    }

    .card.show {
        opacity: 1;
        transform: translateY(0);
    }
</style>

<body>

    <div class="carousel-container">
        <div id="header-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" style="height: 410px;">
                    <img class="img-fluid" src="{{ asset('assets/img/D_NQ_686625-MLA75918869716_042024-OO.webp') }}"
                        alt="Image">
                </div>
                <div class="carousel-item" style="height: 410px;">
                    <img class="img-fluid" src="{{ asset('assets/img/D_NQ_827820-MLA76147740183_052024-OO.webp') }}"
                        alt="Image">
                </div>
                <div class="carousel-item" style="height: 410px;">
                    <img class="img-fluid" src="{{ asset('assets/img/D_NQ_653842-MLA76387261552_052024-OO.webp') }}"
                        alt="Image">
                </div>


            </div>
            <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                <div class="btn btn-dark" style="width: 45px; height: 45px;">
                    <span class="carousel-control-prev-icon mb-n2"></span>
                </div>
            </a>
            <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                <div class="btn btn-dark" style="width: 45px; height: 45px;">
                    <span class="carousel-control-next-icon mb-n2"></span>
                </div>
            </a>
        </div>
        <!-- Contenedores fijos encima del carrusel -->
        <ol class="carousel-indicators">
            <!-- Aquí deberías tener dinámicamente tantos <li> como productos tengas -->
            @foreach ($productosDrones as $index => $product)
                <li data-target="#header-carousel" data-slide-to="{{ $index }}"
                    class="{{ $index === 0 ? 'active' : '' }}"></li>
            @endforeach
        </ol>
        <div class="container-fluid carousel-overlays" style="padding-left: 70px; padding-right: 70px;">
            <div class="row justify-content-center">
                {{-- Mostrar productos generales --}}
                @foreach ($productosDrones as $product)
                    <div class="col-lg-2 col-md-4 col-sm-6 col-12" style="max-width: 220px;">
                        <div class="card clickable"
                            data-url="{{ route('obtener.detalles.producto', ['productoId' => $product->producto_id]) }}"
                            style="border-radius: 15px; border: 1px solid #cccccc;">
                            <div class="card-body">
                                <center>
                                    <img src="{{ $product->img_portada }}" style="width: 140px; height: auto;"
                                        alt="">
                                </center>
                                <h6>{{ strlen($product['titulo']) > 50 ? substr($product['titulo'], 0, 20) . '...' : $product['titulo'] }}
                                </h6>
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
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <script>
                document.querySelectorAll('.clickable').forEach(function(card) {
                    card.addEventListener('click', function() {
                        window.location.href = card.getAttribute('data-url');
                    });
                });
            </script>
        </div>
    </div>
    </div>
    </div>

    <br> <br> <br> <br> <br> <br> <br>  <br> 


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.card');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('show');
                    } else {
                        entry.target.classList.remove('show');
                    }
                });
            }, {
                threshold: 0.1
            });

            cards.forEach(card => {
                observer.observe(card);
            });
        });
    </script>
    <!--Fin   Tarjetas-->
    <script>
        // Espera a que el DOM esté completamente cargado
        $(document).ready(function() {
            // Agrega un evento para cuando cambie el carrusel
            $('#header-carousel').on('slide.bs.carousel', function(e) {
                // Obtiene el índice de la nueva imagen activa
                var newIndex = $(e.relatedTarget).index();
                // Actualiza el indicador activo
                $('.carousel-indicators li').removeClass('active');
                $('.carousel-indicators li').eq(newIndex).addClass('active');
            });

            // Agrega un evento para manejar el clic en los indicadores
            $('.carousel-indicators li').click(function() {
                // Obtiene el índice del indicador clickeado
                var index = $(this).index();
                // Cambia al carrusel a la imagen correspondiente
                $('#header-carousel').carousel(index);
            });
        });
    </script>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
