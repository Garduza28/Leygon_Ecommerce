document.addEventListener("DOMContentLoaded", function() {
    var toggleCurrency = document.getElementById("toggleCurrency");

    function convertirAPesos() {
        var cardTexts = document.querySelectorAll(".card-text");

        cardTexts.forEach(function(cardText) {
            var precioOriginal = parseFloat(cardText.dataset.precioOriginal);
            var precioConCambio = parseFloat(cardText.dataset.precioConCambio);
            var precioConDescuento = parseFloat(cardText.dataset.precioConDescuento);

            if (!isNaN(precioConDescuento)) {
                var antesConDescuentoMXN = precioOriginal;
                var ahoraConDescuentoMXN = precioConDescuento;
                var antesConDescuentoUSD = precioOriginal * precioConCambio;
                var ahoraConDescuentoUSD = precioConDescuento * precioConCambio;

                cardText.innerHTML = `
                    <p>Antes: MXN <del>${antesConDescuentoMXN.toFixed(2)}</del> (USD $${antesConDescuentoUSD.toFixed(2)})</p>
                    <p>Ahora: MXN ${ahoraConDescuentoMXN.toFixed(2)} (USD $${ahoraConDescuentoUSD.toFixed(2)})</p>`;
            } else {
                cardText.textContent = 'Precio: MXN $' + precioConCambio.toFixed(2);
            }
        });
    }

    convertirAPesos();

    toggleCurrency.addEventListener("change", function() {
        var mostrarEnPesos = toggleCurrency.checked;
        var cardTexts = document.querySelectorAll(".card-text");

        cardTexts.forEach(function(cardText) {
            var precioOriginal = parseFloat(cardText.dataset.precioOriginal);
            var precioConCambio = parseFloat(cardText.dataset.precioConCambio);
            var precioConDescuento = parseFloat(cardText.dataset.precioConDescuento);

            if (!isNaN(precioConDescuento)) {
                if (mostrarEnPesos) {
                    var antesConDescuentoMXN = precioOriginal;
                    var ahoraConDescuentoMXN = precioConDescuento;
                    var antesConDescuentoUSD = precioOriginal * precioConCambio;
                    var ahoraConDescuentoUSD = precioConDescuento * precioConCambio;

                    cardText.innerHTML = `
                        <p>Antes: MXN <del>${antesConDescuentoMXN.toFixed(2)}</del> (USD $${antesConDescuentoUSD.toFixed(2)})</p>
                        <p>Ahora: MXN ${ahoraConDescuentoMXN.toFixed(2)} (USD $${ahoraConDescuentoUSD.toFixed(2)})</p>`;
                } else {
                    var antesConDescuentoMXN = precioOriginal * precioConCambio;
                    var ahoraConDescuentoMXN = precioConDescuento *precioConCambio;
                    var antesConDescuentoUSD = precioOriginal;
                    var ahoraConDescuentoUSD = precioConDescuento;

                    cardText.innerHTML = `
                        <p>Antes: USD $${antesConDescuentoUSD.toFixed(2)} (MXN ${antesConDescuentoMXN.toFixed(2)})</p>
                        <p>Ahora: USD $${ahoraConDescuentoUSD.toFixed(2)} (MXN ${ahoraConDescuentoMXN.toFixed(2)})</p>`;
                }
            } else {
                if (mostrarEnPesos) {
                    cardText.textContent = 'Precio MXN: $' + precioConCambio.toFixed(2);
                } else {
                    cardText.textContent = 'Precio USD: $' + precioOriginal.toFixed(2);
                }
            }
        });
    });
});
