<div class="container-fluid">
    <div class="row bg-secondary py-2 px-xl-5">
        <div class="col-lg-6 d-none d-lg-block">
            <div class="d-inline-flex align-items-center">
                <a class="text-dark" href="">Ayuda</a>
                <span class="text-muted px-2">|</span>
                <a class="text-dark" href="">Soporte</a>
            </div>
        </div>
        <div class="col-lg-6 text-center text-lg-right">
            <div class="d-inline-flex align-items-center">
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
                    <i class="fab fa-instagram"></i>
                </a>
                <a class="text-dark pl-2" href="">
                    <i class="fab fa-youtube"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="row align-items-center py-3 px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a href="{{ url('/') }}" class="text-decoration-none">
                <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Leygon</h1>
            </a>
        </div>
        <div class="col-lg-6 col-6 text-left">
            <form action="">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="¿Qué necesitas?">
                    <div class="input-group-append">
                        <span class="input-group-text bg-transparent text-primary">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-3 col-6 text-right">
            <a href="" class="btn border">
                <i class="fas fa-heart text-primary"></i>
                <span class="badge">0</span>
            </a>
            <a href="#" class="btn border">
                <i class="fas fa-shopping-cart text-primary"></i>
                <span class="badge">{{ \Cart::getTotalQuantity()}}

                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="width: 450px; padding: 0px; border-color: #9DA0A2">
                <ul class="list-group" style="margin: 20px;">
                    @include('partials.cart-drop')
                </ul>

            </div>
        </div>
    </div>
</div>
<div class="col-lg-9">
    <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
        <a href="" class="text-decoration-none d-block d-lg-none">
            <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
    </div>
    <div class="navegacion">
    <ul class="menu">


    
    <li class="first-item">
    <a href="{{ route('admin.products.create') }}">
        <img src="{{ asset('assets/img/inicio.jpg') }}" alt="" class="imagen">
        <span class="text-item">Agregar producto</span>
        <span class="down-item"></span>
    </a>
</li>

<li>
    <a href="{{ route('admin.createCategory') }}">
        <img src="{{ asset('assets/img/info.jpg') }}" alt="" class="imagen">
        <span class="text-item">Crear Categorías</span>
        <span class="down-item"></span>
    </a>
</li>

        <li>
        <a href="{{ route('admin.createBrand') }}">
                <img src="{{asset('assets/img/contactenos.jpg')}}" alt="" class="imagen">
                <span class="text-item">Crear marcas</span>
                <span class="down-item"></span>
            </a>
        </li>

        <li>
        <a href="{{ route('admin.createClasification') }}">
                <img src="{{asset('assets/img/sesion.jpg')}}" alt="" class="imagen">
                <span class="text-item">crear clasificacion</span>
                <span class="down-item"></span>
            </a>
        </li>

        <li>
            <a href="#">
                <img src="{{asset('assets/img/registrarse.jpg')}}" alt="" class="imagen">
                <span class="text-item">Registrarse</span>
                <span class="down-item"></span>
            </a>
        </li>
    </ul>
</div>
</div>
</div>
</div>
