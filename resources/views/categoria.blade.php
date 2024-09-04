<!-- resources/views/categoria.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Categoría</title>
</head>
<body>
    <h1>Detalles de la clasificación</h1>

    <p>ID: {{ $categorias['id'] }}</p>
    <p>Nombre: {{ $categorias['nombre'] }}</p>
    <p>Nivel: {{ $categorias['nivel'] }}</p>


    <h2>Origen:</h2>
<ul>
    @foreach ($categorias['origen'] as $origen)
        <li>{{ $origen['nombre'] }} (ID: {{ $origen['id'] }}, Nivel: {{ $origen['nivel'] }})</li>
    @endforeach
</ul>



    <h2>Subclasificacion:</h2>
    <ul>
        @foreach ($categorias['subcategorias'] as $subcategoria)
            <li>{{ $subcategoria['nombre'] }} (ID: {{ $subcategoria['id'] }}, Nivel: {{ $subcategoria['nivel'] }})</li>
        @endforeach
    </ul>
</body>
</html>