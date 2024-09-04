<head>
    <meta charset="utf-8">
    <title>Conocenos</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">



    <!-- Customized Bootstrap Stylesheet -->
    <link rel="stylesheet" href="{{asset('assets/css/style2.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style1.css')}}">
</head>
<body style="background: white;">
    

@include('partials.nav-prueba')
<br>
<br>
<br>
<br>
<br>

    <div class="container-fluid contact-info mt-5 mb-4" >
        <div class="container" style="padding: 0 30px;">
            <div class="row">
                <div class="col-md-4 d-flex align-items-center justify-content-center bg-terciary mb-4 mb-lg-0"
                    style="height: 100px;">
                    <div class="d-inline-flex">
                        <i class="fa fa-2x fa-map-marker-alt text-white m-0 mr-3"></i>
                        <div class="d-flex flex-column">
                            <h5 class="text-white font-weight-medium">Localización</h5>
                            <p class="m-0 text-white">Zaragoza 911 Col. Centro, Tabasco, cp 86000</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex align-items-center justify-content-center bg-primary mb-4 mb-lg-0"
                    style="height: 100px;">
                    <div class="d-inline-flex text-left">
                        <i class="fa fa-2x fa-envelope text-white m-0 mr-3"></i>
                        <div class="d-flex flex-column">
                            <h5 class="text-white font-weight-medium">Escribenos</h5>
                            <p class="m-0 text-white">smartech.mexico@gmail.com</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex align-items-center justify-content-center bg-terciary mb-4 mb-lg-0"
                    style="height: 100px;">
                    <div class="d-inline-flex text-left">
                        <i class="fa fa-2x fa-phone-alt text-white m-0 mr-3"></i>
                        <div class="d-flex flex-column">
                            <h5 class="text-white font-weight-medium">Llamanos</h5>
                            <p class="m-0 text-white">+52 993 149 2591</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <img class="img-fluid" src="{{asset('assets/img/about.jpeg')}}" alt="">
                </div>
                <div class="col-lg-7 mt-5 mt-lg-0 pl-lg-5">
                    <h1 class="mb-4 weight-bold">Acerca de nosotros</h1>
                    <h4 class="font-weight-medium font-italic mb-4" style="color: #46C6CE">¡Bienvenido a Leygon, tu destino definitivo para las
                        compras en linea!</h5>
                    <p style="color: black" class="font-weight-medium">En un mundo cada vez mas conectado, en Leygon nos enorgullece ser tu aliado confiable para
                        encontrar los materiales y herramientas de la más alta calidad.
                        Nosotros entendemos la importancia de contar con productos confiables y de ultima tecnología,
                        estamos aqui para ofrecerte una amplia variedad de opciones,
                        respaldadas por marcas reconocidas y la garantía de calidad que mereces.
                    </p>
                    <br>
                    <p style="color: black" class="font-weight-medium">Navegar por nuestra tineda en línea es tan fácil como conectar un enchufe. Ofrecemos una interfaz
                        intuitiva que te permite explorar nuestro catalogo de productos,
                        desde cables e interruptores, hasta dispositivos inteligentes y herramientas especializadas.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <div class="container-fluid pt-5 pb-3">
        <div class="container">
            <h1 class="display-4 text-center mb-5 weight-bold">Como cuidamos tu privacidad</h1>
            <div class="row">
                <div class="col-lg-3 col-md-6 pb-1">
                    <div class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4"
                        style="height: 300px;">
                        <div class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4"
                            style="width: 100px; height: 100px;">
                            <i class="fa-solid fa-circle-dollar-to-slot"></i>
                        </div>
                        <h4 class="weight-bold m-0">Somos transparentes</h4>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 pb-1">
                    <div class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4"
                        style="height: 300px;">
                        <div class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4"
                            style="width: 100px; height: 100px;">
                            <i class="fa-solid fa-medal"></i>
                        </div>
                        <h4 class="weight-bold m-0">Trabajamos con calidad</h4>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 pb-1">
                    <div class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4"
                        style="height: 300px;">
                        <div class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4"
                            style="width: 100px; height: 100px;">
                            <i class="fa-solid fa-user-lock"></i>
                        </div>
                        <h4 class="weight-bold m-0">Protegemos tus datos</h4>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 pb-1">
                    <div class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4"
                        style="height: 300px;">
                        <div class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4"
                            style="width: 100px; height: 100px;">
                            <i class="fa-solid fa-minimize"></i>
                        </div>
                        <h4 class="weight-bold m-0">Minimizacion de datos</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 m-0 my-lg-5 pt-0 pt-lg-5 pr-lg-5">
                    <h1 class="mb-4 weight-bold">¿Por qué elegirnos?</h1>
                    <p style="color: black" class="font-weight-medium">En Leygon, no solo vendemos productos, construimos conexiones confiables. Estamos comprometidos a
                        proporcionarte no solo los mejores
                        materiales si no tambien la información sobre estos.
                    </p>
                    <div class="row">
                        <div class="col-sm-6 mb-4">
                            <h1 class="text-secondary" style="font-weight: 700" data-toggle="counter-up">10</h1>
                            <h5 class="weight-bold">Años de experiencia</h5>
                        </div>
                        <div class="col-sm-6 mb-4">
                            <h1 class="text-secondary" style="font-weight: 700" data-toggle="counter-up">250</h1>
                            <h5 class="weight-bold">Productos vendidos</h5>
                        </div>
                        <div class="col-sm-6 mb-4">
                            <h1 class="text-secondary" style="font-weight: 700" data-toggle="counter-up">1250</h1>
                            <h5 class="weight-bold">Clientes felices</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div
                        class="d-flex flex-column align-items-center justify-content-center bg-terciary h-100 py-5 px-3">
                        <i class="fa fa-5x fa-certificate text-white mb-5"></i>
                        <h1 class="display-1 text-white mb-3 weight-bold">10+</h1>
                        <h1 class="text-white m-0 weight-bold">Años de experiencia</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Features End -->

    <!-- Working Process Start -->
    <div class="container-fluid pt-5">
        <div class="container">
            <h1 class="display-4 text-center mb-5 weight-bold">Terminos y condiciones</h1>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex flex-column align-items-center justify-content-center text-center mb-5">
                        <div class="d-inline-flex align-items-center justify-content-center bg-white border border-light shadow rounded-circle mb-4"
                            style="width: 150px; height: 150px; border-width: 15px !important;">
                            <i class="fa-solid fa-file-signature"></i>
                        </div>
                        <a data-bs-toggle="modal" data-bs-target="#exampleModal1">
                            <h3 class="weight-bold m-0 mt-2">Aceptacion de terminos</h3>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex flex-column align-items-center justify-content-center text-center mb-5">
                        <div class="d-inline-flex align-items-center justify-content-center bg-white border border-light shadow rounded-circle mb-4"
                            style="width: 150px; height: 150px; border-width: 15px !important;">
                            <i class="fa-solid fa-user-check"></i>
                        </div>
                        <a data-bs-toggle="modal" data-bs-target="#exampleModal2">
                            <h3 class="weight-bold m-0 mt-2">Registro de cuenta y usuario</h3>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex flex-column align-items-center justify-content-center text-center mb-5">
                        <div class="d-inline-flex align-items-center justify-content-center bg-white border border-light shadow rounded-circle mb-4"
                            style="width: 150px; height: 150px; border-width: 15px !important;">
                            <i class="fa-solid fa-credit-card"></i>
                        </div>
                        <a data-bs-toggle="modal" data-bs-target="#exampleModal3">
                            <h3 class="weight-bold m-0 mt-2">Productos y transacciones</h3>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex flex-column align-items-center justify-content-center text-center mb-5">
                        <div class="d-inline-flex align-items-center justify-content-center bg-white border border-light shadow rounded-circle mb-4"
                            style="width: 150px; height: 150px; border-width: 15px !important;">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <a data-bs-toggle="modal" data-bs-target="#exampleModal4">
                            <h3 class="weight-bold m-0 mt-2">Privacidad</h3>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex flex-column align-items-center justify-content-center text-center mb-5">
                        <div class="d-inline-flex align-items-center justify-content-center bg-white border border-light shadow rounded-circle mb-4"
                            style="width: 150px; height: 150px; border-width: 15px !important;">
                            <i class="fa-solid fa-brain"></i>
                        </div>
                        <a data-bs-toggle="modal" data-bs-target="#exampleModal5">
                            <h3 class="weight-bold m-0 mt-2">Propiedad intelectual</h3>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex flex-column align-items-center justify-content-center text-center mb-5">
                        <div class="d-inline-flex align-items-center justify-content-center bg-white border border-light shadow rounded-circle mb-4"
                            style="width: 150px; height: 150px; border-width: 15px !important;">
                            <h2 class="display-2 text-secondary m-0">6</h2>
                        </div>
                        <a data-bs-toggle="modal" data-bs-target="#exampleModal6">
                            <h3 class="weight-bold m-0 mt-2">Limitación de responsabilidad</h3>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 weight-bold" id="exampleModalLabel">Aceptación de terminos</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Al acceder y utilizar nuestra aplicación, aceptas cumplir con estos términos y condiciones, así como
                    nuestras politicas de privacidad y cualquier otra política que podamos publicar.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Ver terminos y condiciones</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 weight-bold" id="exampleModalLabel">Registro de cuenta y usuario</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 class="weight-bold">Registro de cuenta</h4>
                    <p>Debes proporcioar información precisa y actualizada al registrarte</p>
                    <p>Eres responsable de mantener la confidencialidad confidencialidad de tu información de inicio de sesio</p>
                    <h4 class="weight-bold">Uso de la cuenta</h4>
                    <p>Solo puedes usar tu cuenta para transacciones legítimas y personales</p>
                    <p>No compartas tu información de cuenta con terceros</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 weight-bold" id="exampleModalLabel">Productos y transacciones</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 class="weight-bold">Listado de productos</h4>
                    <p>Los vendedores son  responsables de la exactitud de la información del producto.</p>
                    <p>Nos reservamos el derecho de retirar cualquier producto que no cumpla con nuestras políticas.</p>
                    <h4 class="weight-bold">Transacciones</h4>
                    <p>Las transacciones se realizarán de acuerdo con los métodos de pago disponibles en la aplicación.</p>
                    <p>Te comprometes a pagar los montos debidos por las transacciones realizadas.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-4 weight-bold" id="exampleModalLabel">Privacidad</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 class="weight-bold">Datos personales</h4>
                    <p>Recopilamos y procesamos datos personales de acuerdo con nuestra política de privacidad.</p>
                    <p>Comprendes y aceptas los términos de nuestra política de privacidad.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal5" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 weight-bold" id="exampleModalLabel">Propiedad intelectual</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 class="weight-bold">Derechos de autor</h4>
                    <p>Los contenidos de la aplicación están protegidos por derechos de autor.</p>
                    <p>No puedes utilizar, reproducir o distribuir nuestro contenido sin autorización.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal6" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 weight-bold" id="exampleModalLabel">Limitación de responsabilidad</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                   <h4 class="weight-bold">Uso de la aplicación</h4>
                   <p>Utilizas la aplicación bajo tu propio riesgo.</p>
                   <p>No somos responsables de pérdidas o daños resultantes del uso de nuestra aplicación.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg bg-fourth back-to-top"><i class="fa fa-angle-double-up"></i></a>
    @include('partials.footer')


     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('assets/lib2/easing/easing.min.js')}}"></script>
    <script src="{{asset('assets/lib2/waypoints/waypoints.min.js')}}"></script>
    <script src="{{asset('assets/lib2/counterup/counterup.min.js')}}"></script>
    <script src="{{asset('assets/lib2/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <!-- Contact Javascript File -->
    <script src="{{asset('assets/mail2/jqBootstrapValidation.min.js')}}"></script>
    <script src="{{asset('assets/mail2/contact.js')}}"></script>
    <script src="{{asset('assets/js/product.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{asset('assets/js/main2.js')}}"></script>
</body>

</html>
