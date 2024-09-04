@extends('layouts.app')

@section('content')
    @include('partials.topbar')
    @include('diseños.carouselimgs')
  <style>
    body {
    background-color: transparent !important; /* Establece el fondo transparente y anula cualquier estilo que provenga de Bootstrap */
}
    .category-link {
        display: flex;
        align-items: center;
    }

    .clasifications {
        display: none;
        position: absolute;
        top: 0;
        left: 100%;
        /* Coloca las clasificaciones a la derecha del enlace */
        min-width: 400px;
        /* Ancho mínimo del contenedor de clasificaciones */
        background-color: #EDF1FF;
        /* Fondo blanco */
        border: 1px solid black;
        /* Borde gris */
        border-radius: 4px;
        /* Bordes redondeados */
        padding: 10px;
        /* Espaciado interno */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        /* Sombra */
        top: 20px;
    }

    .clasifications li {
        margin-bottom: 5px;
        /* Espaciado entre elementos de la lista */
    }

    .clasifications a {
        padding: 2px;
        border-bottom: 1px solid #EDF1FF;
        display: block;
        /* Hace que los enlaces ocupen todo el ancho del contenedor */
        color: #333;
        /* Color de texto */
        text-decoration: none;
        /* Sin subrayado */
        cursor: pointer;
        /* Cambia el cursor al pasar sobre los enlaces */
    }

    .clasifications a:hover {
        background-color: #f0f0f0;
        /* Cambia el color de fondo al pasar el cursor */
    }

    /* Ajustes para las subcategorías */
    .subcategorias {
        display: none;
        position: absolute;
        top: 0;
        left: 100%;
        /* Despliega a la derecha */
        min-width: 300px;
        /* Ancho mínimo del contenedor de subcategorías */
        background-color: #EDF1FF;
        /* Fondo blanco */
        border: 1px solid black;
        /* Borde gris */
        border-radius: 4px;
        /* Bordes redondeados */
        padding: 10px;
        /* Espaciado interno */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        /* Sombra */
    }









    @media (max-width: 600px) {
        /* Estilos para dispositivos móviles con ancho máximo de 600px */
        .category-link {
            flex-direction: column;
            /* Cambia la dirección de los elementos a columna */
        }

        .clasifications, .subcategorias {
            position: static;
            /* Cambia la posición a estática para que aparezcan en línea */
            min-width: auto;
            /* Ancho mínimo automático */
            width: auto;
            /* Ancho automático */
            border: none;
            /* Sin borde */
            border-radius: 0;
            /* Sin bordes redondeados */
            padding: 0;
            /* Sin espaciado interno */
            box-shadow: none;
            /* Sin sombra */
            background-color: transparent;
            /* Fondo transparente */
        }

        .clasifications li, .subcategorias li {
            margin-bottom: 0;
            /* Sin margen entre elementos */
        }

        .clasifications a, .subcategorias a {
            border-bottom: none;
            /* Sin borde inferior */
        }
    }


        /* Estilos para la barra de desplazamiento */
        /* Estilos para los iconos de redes sociales */
        .social-icons {
            position: fixed;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
        }
        .social-icons a {
            display: block;
            margin-bottom: 10px;
            font-size: 24px;
            color: #333; /* Color de los iconos */
            text-decoration: none;
        }
        .social-icons a:hover {
            color: #007bff; /* Color de los iconos al pasar el ratón */
        }

        .payment-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            padding: 15px;
            background-color: #fff;
        }
        .payment-option {
            flex: 1;
            text-align: center;
        }
        .payment-option:not(:last-child) {
            border-right: 1px solid #e0e0e0;
        }
        .payment-option a {
            color: #007bff;
            text-decoration: none;
        }
        .payment-option img {
            vertical-align: middle;
            margin-left: 10px;
        }


        .category-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 20px;
        }
        .category {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            flex: 1 1 calc(33.333% - 20px);
            padding: 20px;
            text-align: center;
            box-sizing: border-box;
        }
        .category h2 {
            margin: 20px 0;
            font-size: 1.2em;
        }
        .category-main-image {
            max-width: 80%;
            height: auto;
            border-radius: 10px;
        }
        .category-items {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .category-items img {
            width: 18%;
            border-radius: 5px;
        }
        @media (max-width: 768px) {
            .category {
                flex: 1 1 calc(50% - 20px);
            }
        }
        @media (max-width: 480px) {
            .category {
                flex: 1 1 100%;
            }
            .category-items img {
                width: 24%;
            }
        }




        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #fff;
        }
        .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
            background: url('https://http2.mlstatic.com/D_NQ_803027-MLU74643615266_022024-OO.webp') no-repeat center center;
            background-size: cover;
        }
        .info {
            max-width: 50%;
        }
        .info h1 {
            color: white;
            font-size: 36px;
            margin: 0;
        }
        .info p {
            font-size: 20px;
            margin: 10px 0;
        }
        .info .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }
        .video-container {
            max-width: 45%;
            position: relative;
        }
        .video-container video {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .video-container::before {
            content: 'Vivir entre fuegos';
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: rgba(0, 0, 0, 0.7);
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 16px;
        }

    </style>



<!-- Iconos de redes sociales -->
<div class="social-icons">
    <a href="#" class="fab fa-facebook-f"></a>
    <a href="#" class="fab fa-twitter"></a>
    <a href="#" class="fab fa-instagram"></a>
    <!-- Agrega más iconos según sea necesario -->
</div>
<script>
    window.addEventListener('scroll', function() {
        var socialIcons = document.getElementById('socialIcons');
        var scrollPosition = window.pageYOffset;

        // Ajusta la posición vertical de los iconos en función de la posición de desplazamiento
        socialIcons.style.top = (50 + scrollPosition * 0.5) + '%';
    });
</script>



<br><br>


<div class="payment-container">
    <div class="payment-option">
        <p>Paga cómodo y seguro<br><small>con Leygon</small></p>
    </div>
    <div class="payment-option">
        <p>Promociones en meses sin intereses<br><a href="#">Ver condiciones</a></p>
    </div>
    <div class="payment-option">
        <img src="https://1000marcas.net/wp-content/uploads/2019/12/BBVA-logo.png" alt="BBVA" height="50">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/92/Citibanamex_logo.svg/2560px-Citibanamex_logo.svg.png" alt="CitiBanamex" height="30">
    </div>
    <div class="payment-option">
        <p>Más medios de pago<br><a href="#">Ver todos</a></p>
    </div>
</div>



    @include('partials.productstart')
    <br><br>
    <div class="container" >
        <div class="info">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a8/Mercado_Libre.svg/1280px-Mercado_Libre.svg.png" alt="" width="150">
            <h1>Ahora puedes ver series y películas</h1>
            <p style= "color: white;" >GRATIS</p>
            <a href="https://www.mercadoplay.com" class="btn"></a>
        </div>
        <div class="video-container">
            <video controls>
                <source src="{{asset('assets/img/faded.mp4')}}" type="video/mp4">
                Tu navegador no soporta la etiqueta de video.
            </video>
        </div>
    </div>


    @include('partials.productsoffer')







    @include('partials.footer')

    <script src="/assets/js/dolars.js"></script>




<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


@endsection
