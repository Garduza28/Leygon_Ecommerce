@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>Clasificaciones de {{ $category->nombre }}</h2>
        <ul class="list-unstyled">
            @foreach ($classifications as $classification)
                <li class="clasificacion" data-clasificacion-id="{{ $classification->id }}">
                    <button class="btn btn-link">{{ $classification->nombre }}</button>
                    <ul class="list-unstyled subcategorias" style="display: none;">
                        <!-- Aquí se mostrarán las subcategorías de la clasificación seleccionada -->
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            // Tu JavaScript aquí
            document.querySelectorAll('.clasificacion').forEach(item => {
                item.addEventListener('click', event => {
                    // Código para manejar el clic en las clasificaciones
                    const subcategoriasContainer = item.querySelector('.subcategorias');
                    
                    // Alternar la visibilidad de las subcategorías
                    subcategoriasContainer.style.display = subcategoriasContainer.style.display === 'none' ? 'block' : 'none';
                    
                    // Si las subcategorías están siendo mostradas, cargarlas
                    if (subcategoriasContainer.style.display === 'block') {
                        const clasificacionId = item.getAttribute('data-clasificacion-id');
                        fetch(`/subcategorias/${clasificacionId}`)
                            .then(response => response.json())
                            .then(subcategorias => {
                                subcategoriasContainer.innerHTML = ''; // Limpiar el contenedor antes de agregar nuevas subcategorías

                                subcategorias.forEach(subcategoria => {
                                    const listItem = document.createElement('li');
                                    const link = document.createElement('a');
                                    link.textContent = subcategoria.nombre;
                                    link.href = `/productos/subcategoria/${subcategoria.id}`;
                                    listItem.appendChild(link);
                                    subcategoriasContainer.appendChild(listItem);
                                });
                            })
                            .catch(error => console.error('Error:', error));
                    }
                });
            });
        });
    </script>
@endsection
