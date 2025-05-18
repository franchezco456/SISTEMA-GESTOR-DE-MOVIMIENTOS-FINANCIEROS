document.addEventListener("DOMContentLoaded", function () {
    const cuenta = JSON.parse(localStorage.getItem("cuentaSeleccionada"));

    if (!cuenta) {
        alert("No se seleccionó ninguna cuenta.");
        window.location.href = "../Usuarios/principal.php";
        return;
    }

    // Mostrar datos actuales
    document.getElementById("nombreActual").textContent = cuenta.usuario;
    document.getElementById("saldoActual").textContent = `$${cuenta.saldo}`;
    document.getElementById("topeActual").textContent = `$${cuenta.tope}`;

    document.getElementById("nuevoUsuario").value = cuenta.usuario;
    document.getElementById("nuevoSaldo").value = cuenta.saldo;
    document.getElementById("nuevoTope").value = cuenta.tope;

    document.getElementById("formModificar").addEventListener("submit", function (e) {
        e.preventDefault();

        const datosActualizados = {
            usuarioAntiguo: cuenta.usuario,
            nuevoUsuario: document.getElementById("nuevoUsuario").value,
            nuevoSaldo: parseFloat(document.getElementById("nuevoSaldo").value),
            nuevoTope: parseFloat(document.getElementById("nuevoTope").value)
        };

        console.log("Enviando datos:", datosActualizados); // ← DEBUG

        fetch("../../../Controller/CuentaFinancieraController.php", {
            method: "PUT",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(datosActualizados)
        })
            .then(res => res.text())  // ← capturamos texto crudo por si no es JSON
            .then(text => {
                console.log("Respuesta del servidor:", text); // ← DEBUG

                try {
                    const res = JSON.parse(text);
                    if (res.status === "success") {
                        alert("Cuenta actualizada correctamente.");
                        localStorage.removeItem("cuentaSeleccionada");
                        window.location.href = "../Usuarios/principal.php";
                    } else {
                        alert("Error: " + res.message);
                    }
                } catch (e) {
                    alert("Error inesperado: respuesta no válida del servidor.");
                    console.error("Texto recibido:", text);
                }
            })
            .catch(err => {
                console.error("Error en la solicitud:", err);
                alert("Error de conexión con el servidor.");
            });
    });
});