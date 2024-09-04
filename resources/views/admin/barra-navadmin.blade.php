    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Leygon</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Página principal</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Procesos
            </div>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.ver-tabla')}}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Ver productos</span></a>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.products.create') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Agregar productos</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.createCategory') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Crear categorias</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.createBrand') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Agregar marcas</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.createClasification') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Crear clasificación</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.index_pedidos.index') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Ver pedidos</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('coupons.index') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Ver Cupones</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.devoluciones') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Ver Devoluciones</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
