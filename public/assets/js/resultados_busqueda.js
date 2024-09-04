// Script para abrir/cerrar el filtro desplegable



$(document).ready(function() {
    $('#toggle-filtro').on('click', function() {
        $('#filtro-lateral').toggleClass('activo');
        $('#superposicion').toggleClass('activo');
    });

    $('#cerrar-filtro, #superposicion').on('click', function() {
        $('#filtro-lateral').removeClass('activo');
        $('#superposicion').removeClass('activo');
    });
});

// Script para manejar la selección de subcategorías
$('.filtro-subcategoria').on('click', function(e) {
    e.preventDefault();
    var subcategoriaSeleccionada = $(this).data('subcategoria');

    $.ajax({
        type: 'GET',
        url: buscarProductosURL, // Utiliza la variable definida en HTML
        data: {
            subcategoria: subcategoriaSeleccionada
        },
        success: function(data) {
            // Actualiza la lista de productos con los resultados recibidos
            $('#resultados-productos').html(data);
        },
        error: function(xhr, status, error) {
            // Maneja el error si la solicitud falla
            console.error(error);
        }
    });
});
