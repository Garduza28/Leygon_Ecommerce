<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/stylescarouselimgs.css">
    <title>Subcategory Carousel</title>
    <style>
        .slick h4 {
            color: black;
        }
        .slick img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }
        /* Estilos para el modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.9);
        }
        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }
        .modal-content, #caption {
            animation-name: zoom;
            animation-duration: 0.6s;
        }
        @keyframes zoom {
            from {transform: scale(0)}
            to {transform: scale(1)}
        }
        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }
        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="Carousel">
    <div class="container-fluid pt-5" style="padding-left: 20px; padding-right: 20px; margin-bottom: 10px;">
        <div style="background: white;">
            <h2>Subcategory Carousel</h2>
            <div class="slick-list" id="slick-list">
                <button class="slick-arrow slick-prev" id="button-prev" data-button="button-prev"
                    onclick="app.processingButton(event)">
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-left"
                        class="svg-inline--fa fa-chevron-left fa-w-10" role="img" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 320 512">
                        <path fill="currentColor"
                            d="M34.52 239.03L228.87 44.69c9.37-9.37 24.57-9.37 33.94 0l22.67 22.67c9.36 9.36 9.37 24.52.04 33.9L131.49 256l154.02 154.75c9.34 9.38 9.32 24.54-.04 33.9l-22.67 22.67c-9.37 9.37-24.57 9.37-33.94 0L34.52 272.97c-9.37-9.37-9.37-24.57 0-33.94z"></path>
                    </svg>
                </button>
                <div class="slick-track" id="track">
                    <!-- Imagen 1 -->
                    <div class="slick">
                        <div>
                            <a href="{{ route('brands.show', ['brandId' => 'HIKVISION']) }}">
                                <h4><small>HIKVISION</small></h4>
                                <picture>
                                    <img src="/assets/img/Hikvision.png" alt="HIKVISION" >
                                </picture>
                            </a>
                        </div>
                    </div>
                    <!-- Imagen 2 -->
                    <div class="slick">
                        <div>
                            <a href="{{ route('brands.show', ['brandId' => 'PANDUIT']) }}">
                                <h4><small>Panduit</small></h4>
                                <picture>
                                    <img src="/assets/img/panduit.png" alt="Panduit" >
                                </picture>
                            </a>
                        </div>
                    </div>
                    <!-- Imagen 3 -->
                    <div class="slick">
                        <div>
                            <a href="{{ route('brands.show', ['brandId' => 'Syscom']) }}">
                                <h4><small>Syscom</small></h4>
                                <picture>
                                    <img src="/assets/img/syscom.png" alt="Syscom" >
                                </picture>
                            </a>
                        </div>
                    </div>
                    <!-- Imagen 4 -->
                    <div class="slick">
                        <div>
                            <a href="{{ route('brands.show', ['brandId' => 'LINKEDPRO BY EPCOM']) }}">
                                <h4><small>LINKEDPRO BY EPCOM</small></h4>
                                <picture>
                                    <img src="/assets/img/LINKEDPRO BY EPCOM.png" alt="LINKEDPRO BY EPCOM" >
                                </picture>
                            </a>
                        </div>
                    </div>
                    <!-- Imagen 5 -->
                    <div class="slick">
                        <div>
                            <a href="{{ route('brands.show', ['brandId' => 'Century']) }}">
                                <h4><small>Century</small></h4>
                                <picture>
                                    <img src="/assets/img/century.png" alt="Century" >
                                </picture>
                            </a>
                        </div>
                    </div>
                    <!-- Imagen 6 -->
                    <div class="slick">
                        <div>
                            <a href="{{ route('brands.show', ['brandId' => 'PLANET']) }}">
                                <h4><small>PLANET</small></h4>
                                <picture>
                                    <img src="/assets/img/planet.png" alt="PLANET" >
                                </picture>
                            </a>
                        </div>
                    </div>
                    <!-- Imagen 7 -->
                    <div class="slick">
                        <div>
                            <a href="{{ route('brands.show', ['brandId' => 'COBRA']) }}">
                                <h4><small>COBRA</small></h4>
                                <picture>
                                    <img src="/assets/img/COBRA.png" alt="COBRA" >
                                </picture>
                            </a>
                        </div>
                    </div>
                    <!-- Imagen 8 -->
                    <div class="slick">
                        <div>
                            <a href="{{ route('brands.show', ['brandId' => 'Politec']) }}">
                                <h4><small>Politec</small></h4>
                                <picture>
                                    <img src="/assets/img/politec.png" alt="Politec" >
                                </picture>
                            </a>
                        </div>
                    </div>
                    <!-- Imagen 9 -->
                    <div class="slick">
                        <div>
                            <a>
                                <h4><small></small></h4>
                                <picture>
                                    <img src="/assets/img/anuncio.png" alt="Anuncio" onclick="openModal(this)">
                                </picture>
                            </a>
                        </div>
                    </div>
                    <!-- Imagen 10 -->
                    <div class="slick">
                        <div>
                            <a>
                                <h4><small></small></h4>
                                <picture>
                                    <img src="/assets/img/anuncio.png" alt="Anuncio" onclick="openModal(this)">
                                </picture>
                            </a>
                        </div>
                    </div>
                    <!-- Imagen 11 -->
                    <div class="slick">
                        <div>
                            <a>
                                <h4><small></small></h4>
                                <picture>
                                    <img src="/assets/img/anuncio.png" alt="Anuncio" onclick="openModal(this)">
                                </picture>
                            </a>
                        </div>
                    </div>
                    <!-- Imagen 12 -->
                    <div class="slick">
                        <div>
                            <a>
                                <h4><small></small></h4>
                                <picture>
                                    <img src="/assets/img/anuncio.png" alt="Anuncio" onclick="openModal(this)">
                                </picture>
                            </a>
                        </div>
                    </div>
                    <!-- Imagen 13 -->
                    <div class="slick">
                        <div>
                            <a>
                                <h4><small></small></h4>
                                <picture>
                                    <img src="/assets/img/anuncio.png" alt="Anuncio" onclick="openModal(this)">
                                </picture>
                            </a>
                        </div>
                    </div>
                    <!-- Imagen 14 -->
                    <div class="slick">
                        <div>
                            <a>
                                <h4><small></small></h4>
                                <picture>
                                    <img src="/assets/img/anuncio.png" alt="Anuncio" onclick="openModal(this)">
                                </picture>
                            </a>
                        </div>
                    </div>
                </div>
                <button class="slick-arrow slick-next" id="button-next" data-button="button-next"
                    onclick="app.processingButton(event)">
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right"
                        class="svg-inline--fa fa-chevron-right fa-w-10" role="img" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 320 512">
                        <path fill="currentColor"
                            d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- El Modal -->
<div id="myModal" class="modal">
    <span class="close" onclick="closeModal()">&times;</span>
    <img class="modal-content" id="img01">
    <div id="caption"></div>
</div>

<script defer src="/assets/js/maincarouselimgs.js"></script>
<script>
    function openModal(imgElement) {
        var modal = document.getElementById("myModal");
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        modal.style.display = "block";
        modalImg.src = imgElement.src;
        captionText.innerHTML = imgElement.alt;
    }

    function closeModal() {
        var modal = document.getElementById("myModal");
        modal.style.display = "none";
    }
</script>
</body>
</html>