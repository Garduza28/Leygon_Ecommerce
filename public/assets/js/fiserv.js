document.querySelectorAll('input[name="paymentMethod"]').forEach(function(checkbox) {
    checkbox.addEventListener('change', function() {
        if (this.checked) {
            // Desseleccionar otros checkboxes
            document.querySelectorAll('input[name="paymentMethod"]').forEach(function(checkbox) {
                if (checkbox !== this) {
                    checkbox.checked = false;
                }
            }, this);

            if (this.value === 'directSale') {
                document.getElementById('paymentForm').style.display = 'block';
                document.getElementById('installmentsForm').style.display = 'none';
            } else if (this.value === 'installments') {
                document.getElementById('installmentsForm').style.display = 'block';
                document.getElementById('paymentForm').style.display = 'none';
            }
        } else {
            // Si se deselecciona un checkbox, mostrar ambos formularios
            document.getElementById('paymentForm').style.display = 'block';
            document.getElementById('installmentsForm').style.display = 'block';
        }
    });
});

// Función para obtener los valores del formulario
function obtenerValoresFormulario() {
    var chargetotal = parseFloat(document.querySelector('input[name="chargetotal"]').value);
    var pedido = document.querySelector('input[name="pedido"]').value;
    return { chargetotal: chargetotal, pedido: pedido };
}

// Guardar los valores del formulario cuando la página se carga
var valoresIniciales = obtenerValoresFormulario();

// Evento de envío del formulario
document.getElementById('paymentForm').addEventListener('submit', function(event) {
    event.preventDefault();

    // Obtener los valores actuales del formulario
    var valoresActuales = obtenerValoresFormulario();

    // Comparar los valores
    if (JSON.stringify(valoresIniciales) === JSON.stringify(valoresActuales)) {
        // Si los valores no han cambiado, continuar con el proceso de envío del formulario
        var currentDate = new Date();
        var year = currentDate.getFullYear();
        var month = ('0' + (currentDate.getMonth() + 1)).slice(-2);
        var day = ('0' + currentDate.getDate()).slice(-2);
        var hours = ('0' + currentDate.getHours()).slice(-2);
        var minutes = ('0' + currentDate.getMinutes()).slice(-2);
        var seconds = ('0' + currentDate.getSeconds()).slice(-2);

        var formattedDate = year + ':' + month + ':' + day + '-' + hours + ':' + minutes + ':' + seconds;

        document.getElementById('txndatetime').value = formattedDate;

        var stringToHash = valoresActuales.chargetotal + '|' +
            document.querySelector('input[name="checkoutoption"]').value + '|' +
            document.querySelector('input[name="currency"]').value + '|' +
            document.querySelector('input[name="hash_algorithm"]').value + '|' +
            document.querySelector('input[name="responseFailURL"]').value + '|' +
            document.querySelector('input[name="responseSuccessURL"]').value + '|' +
            document.querySelector('input[name="storename"]').value + '|' +
            document.querySelector('input[name="timezone"]').value + '|' +
            formattedDate + '|' +
            document.querySelector('input[name="txntype"]').value;

        console.log('Hash calculado:', stringToHash);

        var sharedsecret = 'HqSx)45>np';
        var calculatedHash = CryptoJS.HmacSHA256(stringToHash, sharedsecret);
        var base64Hash = CryptoJS.enc.Base64.stringify(calculatedHash);
        console.log('Hash en base64:', base64Hash);

        document.getElementById('hashExtended').value = base64Hash;
        this.submit(); // Envía el formulario
    } else {
        // Si los valores han cambiado, mostrar un mensaje de error
        alert('Error: Se ha detectado un cambio en los valores del formulario. Por favor, no modifique los valores manualmente.');
    }
});

// Función para obtener los valores originales de los campos del formulario
function obtenerValoresOriginales(formularioId) {
    var originalValues = {};
    var formInputs = document.querySelectorAll('#' + formularioId + ' input[type="hidden"]');
    formInputs.forEach(function(input) {
        originalValues[input.name] = input.value;
    });
    return originalValues;
}

// Función para comparar los valores originales con los valores actuales del formulario
function compararValores(originales, formularioId) {
    var formInputs = document.querySelectorAll('#' + formularioId + ' input[type="hidden"]');
    for (var input of formInputs) {
        if (originales[input.name] !== input.value) {
            return false;
        }
    }
    return true;
}

// Cuando se carga la página, obtener los valores originales
var valoresOriginalesPaymentForm = obtenerValoresOriginales('paymentForm');
var valoresOriginalesInstallmentsForm = obtenerValoresOriginales('installmentsForm');

// Agregar un manejador de eventos para el envío del formulario
document.getElementById('installmentsForm').addEventListener('submit', function(event) {
    event.preventDefault();

    // Comparar los valores originales con los valores actuales
    var valoresIguales = compararValores(valoresOriginalesInstallmentsForm, 'installmentsForm');

    if (!valoresIguales) {
        // Si los valores no son iguales, mostrar un mensaje de error y detener el envío del formulario
        alert('Error: Los valores del formulario han sido editados desde el inspector del navegador.');
        return;
    }

    // Obtener el valor seleccionado en el menú desplegable
    var numberOfInstallments = parseInt(document.getElementById('numberOfInstallmentsInput').value);
    var valoresPermitidos = [3, 6, 9, 12];

    // Verificar si el valor seleccionado está dentro de los valores permitidos
    if (!valoresPermitidos.includes(numberOfInstallments)) {
        alert('Error: El número de cuotas seleccionado no es válido. Por favor, seleccione una opción válida.');
        return;
    }
    // Obtener el valor de chargetotal del formulario
    var chargetotal = parseFloat(document.querySelector('#installmentsForm input[name="chargetotal"]').value);

    // Obtener el subtotal del carrito desde los elementos con la clase "subtotal"
    var subtotals = document.querySelectorAll('.subtotal');
    var subtotal = 0;
    subtotals.forEach(function(element) {
        subtotal += parseFloat(element.getAttribute('data-subtotal'));
    });
    chargetotal = Math.round(chargetotal * 100) / 100;
    subtotal = Math.round(subtotal * 100) / 100;

    // Comparar los valores


    // Continuar con el proceso de envío del formulario
    var currentDate = new Date();
    var year = currentDate.getFullYear();
    var month = ('0' + (currentDate.getMonth() + 1)).slice(-2);
    var day = ('0' + currentDate.getDate()).slice(-2);
    var hours = ('0' + currentDate.getHours()).slice(-2);
    var minutes = ('0' + currentDate.getMinutes()).slice(-2);
    var seconds = ('0' + currentDate.getSeconds()).slice(-2);

    var formattedDate = year + ':' + month + ':' + day + '-' + hours + ':' + minutes + ':' + seconds;

    document.getElementById('txndatetime2').value = formattedDate;

    var numberOfInstallments = document.getElementById('numberOfInstallmentsInput').value;
    var stringToHash = chargetotal + '|' +
        document.querySelector('#installmentsForm input[name="checkoutoption"]').value + '|' +
        document.querySelector('#installmentsForm input[name="currency"]').value + '|' +
        document.querySelector('#installmentsForm input[name="hash_algorithm"]').value + '|' +
        document.querySelector('#installmentsForm input[name="installmentsInterest"]').value + '|' +
        numberOfInstallments + '|' +
        document.querySelector('#installmentsForm input[name="responseFailURL"]').value + '|' +
        document.querySelector('#installmentsForm input[name="responseSuccessURL"]').value + '|' +
        document.querySelector('#installmentsForm input[name="storename"]').value + '|' +
        document.querySelector('#installmentsForm input[name="timezone"]').value + '|' +
        formattedDate + '|' +
        document.querySelector('#installmentsForm input[name="txntype"]').value;

    console.log('Hash calculado:', stringToHash);

    var sharedsecret = 'HqSx)45>np';
    var calculatedHash = CryptoJS.HmacSHA256(stringToHash, sharedsecret);
    var base64Hash = CryptoJS.enc.Base64.stringify(calculatedHash);
    console.log('Hash en base64:', base64Hash);

    document.getElementById('hashExtended2').value = base64Hash;
    this.submit(); // Envía el formulario

});