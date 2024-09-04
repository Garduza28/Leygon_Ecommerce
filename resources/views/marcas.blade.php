<!-- resources/views/categorias.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marcas Syscom</title>
</head>
<body>
    <h1>Categorías obtenidas desde Syscom API</h1>

    <ul>
        @foreach($marcas as $marca)
        <li>{{ $marca['id'] }}
            {{ $marca['nombre'] }}
            {{ $marca['nivel'] }}</li>
        @endforeach


        </ul>


</body>
</html>
