<!-- resources/views/detalles_producto.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Producto</title>
</head>
<body>
    <h1>Detalles del Producto</h1>
    
    <ul>
        <li>Modelo: {{ $detallesProducto['modelo'] }}</li>
        <li>Total Existencia: {{ $detallesProducto['total_existencia'] }}</li>
        <!-- Agrega más detalles según sea necesario -->
    </ul>
</body>
</html>