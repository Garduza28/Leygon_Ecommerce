@extends('layouts.app')

@section('content')
<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <form id="imagenForm" action="{{ route('perfil.subirOActualizarImagen') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="position-relative">
                        <img id="previewImagen" class="rounded-circle mt-5 mb-3" width="150px" src="{{ $user->image_url }}">
                        <input type="file" id="imagenInput" name="imagen" class="d-none">
                        <label for="imagenInput" class="btn btn-primary">Actualizar Imagen</label>
                    </div>
                </form>
                <span class="font-weight-bold">{{ $user->name }} {{ $user->apellido }}</span>
                <span class="text-black-50">{{ $user->email }}</span>
            </div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Configuración de perfil</h4>
                </div>
                <form method="POST" action="{{ route('perfil.actualizar') }}">
                    @csrf
                    @method('PUT')

                    <div class="row mt-2">
                        <div class="col-md-6"><label class="labels">Nombre</label><input type="text" name="name" class="form-control" placeholder="Nombre" value="{{ $user->name }}"></div>
                        <div class="col-md-6"><label class="labels">Apellido</label><input type="text" name="apellido" class="form-control" value="{{ $user->apellido }}" placeholder="Apellido"></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels">Número de Teléfono</label><input type="text" name="numero_telefono" class="form-control" placeholder="Ingrese número de móvil" value="{{ $user->numero_telefono }}"></div>
                        <div class="col-md-12"><label class="labels">Dirección</label><input type="text" name="direccion" class="form-control" placeholder="Ingrese dirección línea 1" value="{{ $user->direccion }}"></div>
                        <div class="col-md-12"><label class="labels">Número Interior o Exterior</label><input type="text" name="exterior_interior" class="form-control" placeholder="Ingrese dirección línea 2" value="{{ $user->exterior_interior }}"></div>
                        <div class="col-md-12"><label class="labels">Código Postal</label><input type="text" name="codigo_postal" class="form-control" placeholder="Ingrese código postal" value="{{ $user->codigo_postal }}"></div>
                        <div class="col-md-12"><label class="labels">Municipio</label><input type="text" name="municipio" class="form-control" placeholder="Ingrese Municipio" value="{{ $user->municipio }}"></div>
                        <div class="col-md-12"><label class="labels">Instrucciones</label><input type="text" name="instrucciones" class="form-control" placeholder="Ingrese área" value="{{ $user->instrucciones }}"></div>
                        <div class="col-md-12"><label class="labels">Correo Electrónico</label><input type="text" name="email" class="form-control" placeholder="Ingrese correo electrónico" value="{{ $user->email }}"></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6"><label class="labels">País</label><input type="text" name="pais" class="form-control" placeholder="Ingrese país" value="{{ $user->pais }}"></div>
                        <div class="col-md-6"><label class="labels">Estado/Región</label><input type="text" name="region" class="form-control" value="{{ $user->estado }}" placeholder="Ingrese estado"></div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        {{ __('Actualizar Datos') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var preview = document.getElementById('previewImagen');
            preview.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    document.getElementById('imagenInput').addEventListener('change', function(event) {
        previewImage(event);
        document.getElementById('imagenForm').submit();
    });
</script>

@endsection