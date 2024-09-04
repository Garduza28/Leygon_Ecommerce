@extends('layouts.admin') {{-- Asegúrate de tener tu layout principal configurado --}}
@section('content')
    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('admin.barra-navadmin')
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Buscar..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter"></span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Notificaciones
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Mostrar las
                                    notificaciones</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter"></span>
                            </a>
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Centro de comentarios
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="{{ asset('assets/img/undraw_profile_1.svg') }}"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem Ive been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Leer mas
                                    comentarios</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Nombre del usuario</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('assets/img/undraw_profile.svg') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar sesión
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- End of Main Content -->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>

            <div class="card-body">
<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-6">

                <div class="form-group">
                <label for="titulo">Nombre:</label>
                <input type="text" name="titulo" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="producto_id">Id del producto:</label>
                <input type="number" name="producto_id" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="modelo">Modelo:</label>
                <input type="text" name="modelo" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="total_existencia">Total de existencias:</label>
                <input type="text" name="total_existencia" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="brand_id">Marca:</label>
                <select name="brand_id" class="form-control" required>
                    @if (isset($brands))
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->nombre }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="form-group">
                <label for="sat_key">Sat key:</label>
                <input type="text" name="sat_key" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" name="precio" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="marca_logo">Marca Logo:</label>
                <input type="text" name="marca_logo" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="existencia_nuevo">Existencia Nuevo:</label>
                <input type="number" name="existencia_nuevo" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="category_id">Categoría</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="clasification_id">Clasificación</label>
                <select name="clasification_id" id="clasification_id" class="form-control" required>
                    <option value="">Seleccionar clasificación</option>
                </select>
            </div>

            <div class="form-group">
                <label for="subcategoria_id">Subcategoría</label>
                <select name="subcategoria_id" id="subcategoria_id" class="form-control" required>
                    <option value="">Seleccionar subcategoría</option>
                </select>
            </div>
        </div>


                <div class="col-md-6">
                <div class="form-group">
                <label for="img_portada">Imagen del producto:</label>
                <input type="file" name="img_portada" id="img_portada" class="form-control-file" accept="image/*" required>
                <img id="imagenSeleccionada" src="https://cdn-icons-png.flaticon.com/512/84/84099.png"
                    alt="Vista previa de la imagen" style="max-width: 15%; margin-top: 10px;">
            </div>

            <button type="submit" class="btn btn-primary">Crear Producto</button>
        </form>
    </div>
    <!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function(e) {
        $('#img_portada').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#imagenSeleccionada').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
    });
</script>

<script>
$(document).ready(function() {
    // Función para cargar las clasificaciones
    function cargarClasificaciones(categoryId) {
        $.ajax({
            url: '/obtener-clasificaciones/' + categoryId,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#clasification_id').empty();
                $('#clasification_id').append('<option value="">Seleccionar clasificación</option>');
                $.each(data, function(key, value) {
                    $('#clasification_id').append('<option value="' + value.id + '">' + value.nombre + '</option>');
                });
            }
        });
    }

    // Función para cargar las subcategorías
    function cargarSubcategorias(clasificationId) {
        console.log("Cargando subcategorías para la clasificación con ID: " + clasificationId);
        $.ajax({
            url: '/obtener-subcategorias/' + clasificationId,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log("Datos de subcategorías recibidos:", data);
                $('#subcategoria_id').empty();
                $('#subcategoria_id').append('<option value="">Seleccionar subcategoría</option>');
                $.each(data, function(key, value) {
                    $('#subcategoria_id').append('<option value="' + value.id + '">' + value.nombre + '</option>');
                });
            },
            error: function(xhr, status, error) {
                console.error("Error al cargar subcategorías:", error);
            }
        });
    }
    // Cargar las clasificaciones cuando cambie la categoría seleccionada
    $('#category_id').change(function() {
        var categoryId = $(this).val();
        if (categoryId) {
            cargarClasificaciones(categoryId);
        } else {
            $('#clasification_id').empty();
            $('#clasification_id').append('<option value="">Seleccionar clasificación</option>');
        }
    });

    // Cargar las subcategorías cuando cambie la clasificación seleccionada
    $('#clasification_id').change(function() {
        var clasificationId = $(this).val();
        if (clasificationId) {
            cargarSubcategorias(clasificationId);
        } else {
            $('#subcategoria_id').empty();
            $('#subcategoria_id').append('<option value="">Seleccionar subcategoría</option>');
        }
    })
});
</script>


