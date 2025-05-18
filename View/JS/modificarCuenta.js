document.addEventListener("DOMContentLoaded", function () {
    // Recuperamos la cuenta seleccionada del localStorage
    const cuenta = JSON.parse(localStorage.getItem("cuentaSeleccionada"));

    // Verificamos si se encontró la cuenta seleccionada
    if (!cuenta) {
        alert("No se seleccionó ninguna cuenta.");
        window.location.href = "../Usuarios/principal.php";  // Redirige si no se seleccionó cuenta
        return;
    }

    // Mostrar los datos actuales de la cuenta
    document.getElementById("nombreActual").textContent = cuenta.usuario;  // Muestra el nombre de usuario
    document.getElementById("saldoActual").textContent = `$${cuenta.saldo}`;  // Muestra el saldo actual con formato de moneda
    document.getElementById("topeActual").textContent = `$${cuenta.tope}`;  // Muestra el tope de la cuenta con formato de moneda

    // Rellenar los campos del formulario con los datos actuales
    document.getElementById("nuevoUsuario").value = cuenta.usuario;
    document.getElementById("nuevoSaldo").value = cuenta.saldo;
    document.getElementById("nuevoTope").value = cuenta.tope;

    // Agregar el evento de submit al formulario para modificar la cuenta
    document.getElementById("formModificar").addEventListener("submit", function (e) {
        e.preventDefault();  // Prevenimos el comportamiento por defecto de enviar el formulario

        // Obtenemos los valores ingresados por el usuario
        const nuevoUsuario = document.getElementById("nuevoUsuario").value.trim();  // Trim para eliminar espacios innecesarios
        const nuevoSaldo = parseFloat(document.getElementById("nuevoSaldo").value);  // Convertimos el saldo a número decimal
        const nuevoTope = parseFloat(document.getElementById("nuevoTope").value);  // Convertimos el tope a número decimal

        // Validación de los campos: Verificamos que todos los campos sean válidos
        if (!nuevoUsuario || isNaN(nuevoSaldo) || isNaN(nuevoTope)) {
            alert("Por favor, ingrese todos los campos correctamente.");
            return;  // Si algún campo no es válido, salimos de la función
        }

        // Verificamos si hay cambios en los datos. Si no, no enviamos la solicitud.
        if (cuenta.usuario === nuevoUsuario && cuenta.saldo === nuevoSaldo && cuenta.tope === nuevoTope) {
            alert("No se realizaron cambios.");
            return;  // Si no hay cambios, no hacemos nada
        }

        // Creamos un objeto con los datos actualizados que vamos a enviar al servidor
        const datosActualizados = {
            usuarioAntiguo: cuenta.usuario,
            nuevoUsuario: nuevoUsuario,
            nuevoSaldo: nuevoSaldo,
            nuevoTope: nuevoTope
        };

        console.log("Enviando datos:", datosActualizados);  // ← DEBUG: Verificamos los datos que estamos enviando

        // Enviamos los datos al servidor utilizando fetch (API para hacer solicitudes HTTP)
        fetch("../../../Controller/CuentaFinancieraController.php", {
            method: "PUT",  // Indicamos que la solicitud es de tipo PUT (actualización)
            headers: {
                "Content-Type": "application/json"  // Especificamos que estamos enviando JSON
            },
            body: JSON.stringify(datosActualizados)  // Convertimos el objeto a JSON y lo enviamos en el cuerpo de la solicitud
        })
            .then(res => res.text())  // Esperamos la respuesta y la convertimos a texto
            .then(text => {
                console.log("Respuesta del servidor:", text);  // ← DEBUG: Verificamos la respuesta del servidor

                try {
                    // Intentamos parsear la respuesta como JSON
                    const res = JSON.parse(text);
                    // Verificamos si la respuesta del servidor es exitosa
                    if (res.status === "success") {
                        alert("Cuenta actualizada correctamente.");
                        localStorage.removeItem("cuentaSeleccionada");  // Limpiamos el localStorage
                        window.location.href = "../Usuarios/principal.php";  // Redirigimos a la página principal
                    } else {
                        alert("Error: " + res.message);  // Si no fue exitosa, mostramos el mensaje de error
                    }
                } catch (e) {
                    alert("Error inesperado: respuesta no válida del servidor.");
                    console.error("Texto recibido:", text);  // ← DEBUG: Si no es un JSON válido, mostramos el texto recibido
                }
            })
            .catch(err => {
                console.error("Error en la solicitud:", err);  // ← DEBUG: Mostramos errores de la solicitud en la consola
                if (err.message) {
                    alert("Error de conexión con el servidor: " + err.message);  // Si hay un mensaje de error, lo mostramos
                } else {
                    alert("Error de conexión con el servidor.");  // Si no hay mensaje de error, mostramos un mensaje genérico
                }
            });
    });
});
