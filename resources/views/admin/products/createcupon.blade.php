<form action="{{ route('coupons.store') }}" method="POST">
    @csrf
    <label for="codigo">Código:</label>
    <input type="text" name="codigo" id="codigo" required>
    <label for="descuento">Descuento:</label>
    <input type="number" name="descuento" id="descuento" required>
    <label for="cantidad_disponible">Cantidad Disponible:</label>
    <input type="number" name="cantidad_disponible" id="cantidad_disponible" required>
    <!-- Puedes agregar más campos según tus necesidades -->
    <button type="submit">Crear Cupón</button>
</form>
