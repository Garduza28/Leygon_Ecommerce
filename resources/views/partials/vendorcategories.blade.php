<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Título de tu página</title>
    <style>

        
        /* Establece el tamaño del contenedor principal */
        .vendor-carousel {
            max-width: 1000px; /* Cambia este valor según tus necesidades */
            margin: 0 auto; /* Centra el contenedor horizontalmente */
        }
        /* Estilo para hacer el contenedor de cada imagen redondo */
        .vendor-item {
            border-radius: 50%;
            overflow: hidden;
            width: 150px; /* Ajusta el ancho del contenedor de la imagen */
            height: 150px; /* Ajusta la altura del contenedor de la imagen */
            margin: 0 auto; /* Centra el contenedor de la imagen horizontalmente */
        }
        /* Estilo para ajustar el tamaño de las imágenes */
        .vendor-item img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Ajusta la imagen dentro del contenedor */
        }
    </style>
    <!-- Aquí puedes incluir tus archivos CSS y JS -->
</head>
<body>
<div class="text-center mb-4">
        
        <h2 class="section-title px-5"><span class="px-2">Principales categorias</span></h2>
    </div>
<!-- Vendor Start -->
<div class="container-fluid py-5">
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel vendor-carousel">
            <div class="vendor-item border p-4" data-category="Videovigilancia">
                    <a href="#">
                        <img src="{{asset('assets/img/png-transparent-videovigilancia-ip-surveillance-security-camera-closed-circuit-television-camera-angle-surveillance-hikvision.png')}}" alt="">
                    </a>
                    <p>Radiocomunicación</p>
                </div>
                <div class="vendor-item border p-4" data-category="Automatización   e Intrusión">>
                    <a href="#">
                        <img src="{{asset('assets/img/Captura de pantalla 2018-10-10 a la(s) 19.00.59.png')}}" alt="">
                    </a>
                    <p>Automatización e Intrusión</p>
                </div>
                <div class="vendor-item border p-4" data-category="Redes y Audio-Video">
                    <a href="#">
                        <img src="{{asset('assets/img/US48500W.jpg')}}" alt="">
                    </a>
                    <p>Redes y Audio-Video</p>
                </div>
                <div class="vendor-item border p-4" data-category="IoT / GPS / Telemática y Señalización Audiovisual">
                    <a href="#">
                        <img src="{{asset('assets/img/WMPV45E.jpg')}}" alt="">
                    </a>
                    <p>IoT / GPS / Telemática y Señalización Audiovisual</p>
                </div>
                <div class="vendor-item border p-4" data-category="Energía / Herramientas">
                    <a href="#">
                        <img src="{{asset('assets/img/PL1812.jpg')}}" alt="">
                    </a>
                    <p>Energía / Herramientas</p>
                </div>
                <div class="vendor-item border p-4" data-category="Automatización e Intrusión">
                    <a href="#">
                        <img src="{{asset('assets/img/OSI10det.jpg')}}" alt="">
                    </a>

                    <p>Automatización e Intrusión</p>
                </div>
                <div class="vendor-item border p-4">
                    <a href="#">
                        <img src="{{asset('assets/img/DSD5050UCC-g.webp')}}" alt="">
                    </a>
                 
                    <p>   Detección de Fuego</p>
                </div>
                <div class="vendor-item border p-4" data-category="Control de Acceso">
                    <a href="#">
                        <img src="{{asset('assets/img/5806W3det.jpg')}}" alt="">
                        <p>Control de Acceso</p>
                    </a>
                </div>

                <div class="vendor-item border p-4" data-category="Cableado Estructurado">
                    <a href="#">
                        <img src="{{asset('assets/img/5806W3det.jpg')}}" alt="">
                        <p>Cableado Estructurado</p>
                    </a>
                </div>

                <div class="vendor-item border p-4" data-category="Audio y Video">
                    <a href="#">
                        <img src="{{asset('assets/img/5806W3det.jpg')}}" alt="">
                        <p>Audio y Video</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Vendor End -->

<!-- Aquí puedes incluir más contenido HTML si es necesario -->

</body>
</html>
