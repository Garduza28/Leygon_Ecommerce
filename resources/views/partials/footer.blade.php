<!-- Footer Start -->
<div class="container-fluid bg-secondary text-dark mt-5 pt-5">
    <div class="row px-xl-5 pt-5">
        <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
            <a href="" class="text-decoration-none">
                <h1 class="mb-4 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border border-white px-3 mr-1">E</span>Leygon</h1>
            </a>
            <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>Direccion</p>
            <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>Correo electronico</p>
            <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>Numero telefonico</p>
        </div>
        <div class="col-lg-8 col-md-12">
            <div class="row">
                <div class="col-md-4 mb-5">
                    <h5 class="font-weight-bold text-dark mb-4">Quick Links</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-dark mb-2" href="{{ url('/') }}"><i class="fa fa-angle-right mr-2"></i>Inicio</a>
                        <a class="text-dark" href=""><i class="fa fa-angle-right mr-2"></i>Contactenos</a>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <h5 class="font-weight-bold text-dark mb-4">Acerca de Leygon</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-dark mb-2" href="{{ url('informacion') }}"><i class="fa fa-angle-right mr-2"></i>Quienes somos</a>
                        <a class="text-dark mb-2" href=""><i class="fa fa-angle-right mr-2"></i>Preguntas frecuentes</a>
                        <a class="text-dark mb-2" href=""><i class="fa fa-angle-right mr-2"></i>Formas de pago</a>
                        <a class="text-dark mb-2" href=""><i class="fa fa-angle-right mr-2"></i>Formas de envío</a>
                        <a class="text-dark mb-2" href=""><i class="fa fa-angle-right mr-2"></i>Centro de información</a>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <h5 class="font-weight-bold text-dark mb-4">Nuevo comentario</h5>
                    <form action="">
                        <div class="form-group">
                            <input type="text" class="form-control border-0 py-4" placeholder="Nombre" required="required" />
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control border-0 py-4" placeholder="Email"
                                required="required" />
                        </div>
                        <div>
                            <button class="btn btn-primary1 btn-block border-0 py-3" type="submit">Subscribete ahora</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row border-top border-light mx-xl-5 py-4">
        <div class="col-md-6 px-xl-0">
        </div>
        <div class="col-md-6 px-xl-0 text-center text-md-right">
            <img class="img-fluid" src="{{asset('assets/img/payments.png')}}" alt="">
        </div>
    </div>
</div>
<!-- Footer End -->


<!-- Back to Top -->
<a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
