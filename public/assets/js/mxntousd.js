document.addEventListener("DOMContentLoaded", function() {
    var toggleCurrency = document.getElementById("toggleCurrency");
    var dolarPrice = parseFloat(document.body.dataset.dolarPrice);

    function convertirMoneda() {
        var mostrarEnUSD = toggleCurrency.checked;
        var cartItems = document.querySelectorAll(".cart-item");

        var formatterUSD = new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' });
        var formatterMXN = new Intl.NumberFormat('es-MX', { style: 'currency', currency: 'MXN' });

        cartItems.forEach(function(cartItem) {
            var precioOriginalUSD = parseFloat(cartItem.querySelector(".card-text").dataset.precioOriginal);
            var cantidadSeleccionada = parseInt(cartItem.querySelector(".quantity-select").value);
            var totalItemUSD = precioOriginalUSD * cantidadSeleccionada;
            var precioConCambioMXN = precioOriginalUSD * dolarPrice;
            var totalItemMXN = precioConCambioMXN * cantidadSeleccionada;

            if (mostrarEnUSD) {
                cartItem.querySelector(".card-text").innerHTML = `Precio: ${formatterUSD.format(precioOriginalUSD)}`;
                cartItem.querySelector(".item-total").innerText = `Total: ${formatterUSD.format(totalItemUSD)}`;
            } else {
                cartItem.querySelector(".card-text").innerHTML = `Precio: ${formatterMXN.format(precioConCambioMXN)}`;
                cartItem.querySelector(".item-total").innerText = `Total: ${formatterMXN.format(totalItemMXN)}`;
            }
        });

        // Actualiza el total general
        calcularTotalGeneral(formatterUSD, formatterMXN);
    }

    function calcularTotalGeneral(formatterUSD, formatterMXN) {
        var totalGeneral = 0;
        var mostrarEnUSD = toggleCurrency.checked;
        var cartItems = document.querySelectorAll(".cart-item");

        cartItems.forEach(function(cartItem) {
            var precioOriginalUSD = parseFloat(cartItem.querySelector(".card-text").dataset.precioOriginal);
            var cantidadSeleccionada = parseInt(cartItem.querySelector(".quantity-select").value);
            var totalItemUSD = precioOriginalUSD * cantidadSeleccionada;
            var totalItemMXN = totalItemUSD * dolarPrice;

            if (mostrarEnUSD) {
                totalGeneral += totalItemUSD;
            } else {
                totalGeneral += totalItemMXN;
            }
        });

        var iva = totalGeneral * 0.16;
        var totalConIVA = totalGeneral + iva;

        document.getElementById('totalAmount').innerText = mostrarEnUSD ? 
            `Total con IVA incluido: ${formatterUSD.format(totalConIVA)}` : 
            `Total con IVA incluido: ${formatterMXN.format(totalConIVA)}`;
    }

    // Inicializa la conversión de moneda y el total
    convertirMoneda();

    toggleCurrency.addEventListener('change', function() {
        convertirMoneda();
    });

    document.querySelectorAll('.quantity-select').forEach(function(quantitySelect) {
        quantitySelect.addEventListener('change', function() {
            convertirMoneda();
        });
    });
});
