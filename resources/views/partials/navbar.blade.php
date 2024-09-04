<br>
<br>
<br>
<br>
<nav class="navbar navbar-expand-md navbar-dark fixed-top" style="background-color: #EDF1FF;">
    <div class="container">
        <a href="{{ url('/') }}" class="text-decoration-none">
            <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold px-3 mr-1">E</span>Leygon</h1>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>



        <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <form class="form-inline ml-auto" action="{{ route('buscar.productos') }}" method="GET">
        <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Search" name="query">
        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Buscar</button>
    </form>
</div>




            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="badge badge-pill badge-dark">
                            <i class="fa fa-shopping-cart"></i> {{ \Cart::getTotalQuantity() }}
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right carrito" style="max-height: 400px; overflow-y: auto;">
                        <ul id="cartItemList" class="list-group" style="margin: 20px;">
                            @include('partials.cart-drop')
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>



<div class="navegacion">
    <ul class="lista1">
        <li>
            <a class="btn shadow-none d-flex align-items-center justify-content-between text-white w-100 clas"
                data-toggle="collapse" href="#navbar-vertical"
                id="toggle-nav">
                <span class="text-item" style="color: black">Todos los productos</span>
                <i class="fa-solid fa-bars text-dark" style="font-size: 35px; padding-left: 50px;"></i>
            </a>
            <nav class="collapse navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0"
                id="navbar-vertical">
                <div class="navbar-nav">
                    @foreach ($categories as $category)
                        <a href="#" class="nav-item nav-link category-link"
                            data-category-id="{{ $category->id }}">
                            {{ $category->nombre }}
                            <ul class="list-unstyled clasifications"></ul>
                        </a>
                    @endforeach

                    @if ($categories->isEmpty())
                        <p>No categories available.</p>
                    @endif
                </div>
            </nav>
        </li>
    </ul>
    <ul class="menu lista2">
        <li class="first-item">
            <a href="{{ url('informacion') }}">
                <img src="{{ asset('assets/img/info.jpg') }}" alt="" class="imagen">
                <span class="text-item">Quienes somos</span>
                <span class="down-item"></span>
            </a>
        </li>

        <li>
            <a href="{{ url('/') }}">
                <img src="{{ asset('assets/img/inicio.jpg') }}" alt="" class="imagen">
                <span class="text-item">Inicio</span>
                <span class="down-item"></span>
            </a>
        </li>

        @guest
            @if (Route::has('login'))
                <li>
                    <a href="{{ route('login') }}">
                        <img src="{{ asset('assets/img/sesion.jpg') }}" alt="" class="imagen">
                        <span class="text-item">{{ __('Iniciar sesion') }}</span>
                        <span class="down-item"></span>
                    </a>
                </li>
            @endif
            <li>
                <a href="{{ route('register') }}">
                    <img src="{{ asset('assets/img/registrarse.jpg') }}" alt="" class="imagen">
                    <span class="text-item"></span>
                    <span class="down-item"></span>
                </a>
            </li>
        @else
            <li>
                <a href="{{ route('perfil.formulario') }}">
                    <img src="{{ asset('assets/img/sesion.jpg') }}" alt="" class="imagen">
                    <span class="text-item">{{ Auth::user()->name }}</span>
                    <span class="down-item"></span>
                </a>

            <li>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <img src="{{ asset('assets/img/registrarse.jpg') }}" alt="" class="imagen">
                    <span class="text-item">{{ __('Cerrar sesion') }}</span>
                    <span class="down-item"></span>
                </a>

            </li>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
    </div>
@endguest
</ul>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
</div>





