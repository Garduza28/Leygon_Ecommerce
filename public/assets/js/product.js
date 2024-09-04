document.addEventListener('DOMContentLoaded', (event) => {
    document.querySelectorAll('.category-link').forEach(item => {
        item.addEventListener('click', event => {
            event.preventDefault(); // Evitar que el enlace se siga

            const categoryId = item.getAttribute('data-category-id');
            const clasificationsContainer = item.querySelector('.clasifications');

            // Cerrar cualquier otro contenedor de clasificaciones abierto
            document.querySelectorAll('.clasifications').forEach(container => {
                if (container !== clasificationsContainer) {
                    container.style.display = 'none';
                }
            });

            // Alternar la visibilidad del contenedor de clasificaciones correspondiente
            clasificationsContainer.style.display = clasificationsContainer.style
                .display === 'none' ? 'block' : 'none';

            // Cargar las clasificaciones si es necesario
            if (clasificationsContainer.style.display === 'block' && clasificationsContainer
                .innerHTML.trim() === '') {
                fetch(`/clasifications/${categoryId}`)
                    .then(response => response.json())
                    .then(clasifications => {
                        clasificationsContainer.innerHTML =
                            ''; // Limpiar el contenedor antes de agregar nuevas clasificaciones

                        clasifications.forEach(clasification => {
                            const listItem = document.createElement('li');
                            const link = document.createElement('a');
                            link.textContent = clasification.nombre;
                            link.href =
                                '#'; // Cambiado para evitar redireccionamiento
                            listItem.appendChild(link);
                            clasificationsContainer.appendChild(listItem);

                            // Crear el contenedor para las subcategorías
                            const subcategoriasContainer = document
                                .createElement('ul');
                            subcategoriasContainer.className = 'subcategorias';
                            subcategoriasContainer.style.display = 'none';
                            listItem.appendChild(subcategoriasContainer);

                            // Event listener para mostrar/ocultar las subcategorías
                            link.addEventListener('click', (event) => {
                                event
                                    .preventDefault(); // Evitar que el enlace se siga
                                event
                                    .stopPropagation(); // Detener la propagación del evento

                                // Alternar la visibilidad de las subcategorías
                                subcategoriasContainer.style.display =
                                    subcategoriasContainer.style
                                    .display === 'none' ? 'block' :
                                    'none';

                                // Cerrar cualquier otro contenedor de subcategorías abierto
                                document.querySelectorAll(
                                    '.subcategorias').forEach(
                                    container => {
                                        if (container !==
                                            subcategoriasContainer
                                        ) {
                                            container.style
                                                .display = 'none';
                                        }
                                    });

                                // Si las subcategorías están siendo mostradas y no han sido cargadas, cargarlas
                                if (subcategoriasContainer.style
                                    .display === 'block' &&
                                    subcategoriasContainer.innerHTML
                                    .trim() === '') {
                                    fetch(
                                            `/subcategorias/${clasification.id}`
                                        )
                                        .then(response => response
                                            .json())
                                        .then(subcategorias => {
                                            subcategorias.forEach(
                                                subcategoria => {
                                                    const
                                                        subItem =
                                                        document
                                                        .createElement(
                                                            'li'
                                                        );
                                                    const
                                                        subLink =
                                                        document
                                                        .createElement(
                                                            'a'
                                                        );
                                                    subLink
                                                        .textContent =
                                                        subcategoria
                                                        .nombre;
                                                    subLink
                                                        .href =
                                                        `/productos/subcategoria/${subcategoria.id}`;
                                                    subItem
                                                        .appendChild(
                                                            subLink
                                                        );
                                                    subcategoriasContainer
                                                        .appendChild(
                                                            subItem
                                                        );
                                                });
                                        })
                                        .catch(error => console.error(
                                            'Error:', error));
                                }
                            });

                            // Evitar que el evento de clic en las subcategorías se propague al contenedor padre
                            subcategoriasContainer.addEventListener('click', (
                                event) => {
                                event.stopPropagation();
                            });
                        });
                    })
                    .catch(error => console.error('Error:', error));
            }
        });
    });
});
