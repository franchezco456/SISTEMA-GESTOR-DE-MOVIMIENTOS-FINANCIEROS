// Esperamos a que el DOM se haya cargado completamente
document.addEventListener("DOMContentLoaded", function () {

  // Cargar las cuentas desde el servidor cuando la página se carga
  fetchCuentas();

  // Inicializar el formulario para agregar una nueva cuenta
  initFormularioAgregarCuenta();

  // Exponer la función mostrarFormulario globalmente para que pueda ser llamada desde fuera
  window.mostrarFormulario = mostrarFormulario;

  // Función para cargar las cuentas desde el backend (servidor)
  function fetchCuentas() {
    fetch("../../../Controller/CuentaFinancieraController.php") // Realizamos una solicitud GET al backend
      .then(response => response.json())  // Parseamos la respuesta a JSON
      .then(renderizarCuentas)  // Llamamos a la función para renderizar las cuentas
      .catch(error => {  // Si hay un error, lo mostramos en la consola
        console.error("Error al cargar cuentas:", error);
      });
  }

  // Función para renderizar las cuentas en el contenedor del frontend
  function renderizarCuentas(cuentas) {
    const contenedor = document.getElementById("contenedor");  // Obtenemos el contenedor donde se mostrarán las cuentas
    contenedor.innerHTML = "";  // Limpiamos el contenedor antes de agregar las nuevas cuentas
    cuentas.forEach(cuenta => crearDivVisual(cuenta));  // Para cada cuenta, creamos un div visual
  }

  // Función para crear y mostrar el div visual de cada cuenta
  function crearDivVisual(datos) {
    const nuevoDiv = document.createElement("div");  // Creamos un nuevo div para la cuenta
    nuevoDiv.className = "mi-div";  // Añadimos una clase CSS para estilizar el div
    nuevoDiv.innerHTML = `  
      <p><strong>Cuenta:</strong> ${datos.usuario}</p><br>
      <p><strong>Saldo:</strong> ${datos.saldo}</p><br>
      <p><strong>Tope:</strong> ${datos.tope}</p><br>
    `;// Agregamos contenido HTML al div con los datos de la cuenta


    // Crear el botón para eliminar la cuenta
    const botonEliminar = document.createElement("button");  // Creamos un botón de eliminar
    botonEliminar.textContent = "Eliminar";  // Establecemos el texto del botón
    botonEliminar.className = "boton2";  // Añadimos una clase CSS para estilizar el botón
    botonEliminar.addEventListener("click", function () {  // Añadimos un evento para cuando el botón sea clickeado
      eliminarCuenta(datos.usuario, nuevoDiv);  // Llamamos a la función de eliminar cuenta
    });

    nuevoDiv.appendChild(botonEliminar);  // Añadimos el botón al div
    document.getElementById("contenedor").appendChild(nuevoDiv);  // Añadimos el div al contenedor
  }

  // Función para eliminar una cuenta tanto en el div como en la base de datos
  function eliminarCuenta(usuario, div) {
    // Llamamos al backend para eliminar la cuenta
    fetch("../../../Controller/CuentaFinancieraController.php", {
      method: "DELETE",  // Usamos el método HTTP DELETE para eliminar la cuenta
      headers: {
        "Content-Type": "application/json"  // Indicamos que enviamos datos en formato JSON
      },
      body: JSON.stringify({ usuario: usuario })  // Enviamos el usuario de la cuenta a eliminar
    })
    .then(response => response.json())  // Recibimos la respuesta del servidor en formato JSON
    .then(data => {  // Si la respuesta es exitosa
      if (data.status === "success") {
        alert("Cuenta eliminada correctamente.");  // Mostramos un mensaje de éxito
        div.remove();  // Eliminamos el div visualmente de la interfaz
      } else {
        alert("Error al eliminar la cuenta.");  // Si ocurre un error, mostramos un mensaje
      }
    })
    .catch(error => {  // Si hay un error en la solicitud, lo mostramos en la consola
      console.error("Error en la eliminación:", error);
      alert("Ocurrió un error al eliminar la cuenta.");
    });
  }

  // Inicializar el formulario para agregar una nueva cuenta
  function initFormularioAgregarCuenta() {
    const formulario = document.getElementById("formAgregar");  // Obtenemos el formulario de agregar cuenta
    formulario.addEventListener("submit", function (e) {  // Añadimos un evento para cuando el formulario sea enviado
      e.preventDefault();  // Prevenimos que la página se recargue al enviar el formulario

      // Obtenemos los valores ingresados en los campos del formulario
      const cuenta = document.getElementById("inputCuenta").value;
      const saldo = parseFloat(document.getElementById("inputSaldo").value);
      const tope = parseFloat(document.getElementById("inputTope").value);

      // Creamos un objeto con los datos de la cuenta
      const datosCuenta = {
        usuario: cuenta,
        saldo: saldo,
        tope: tope
      };

      // Enviar la nueva cuenta al backend
      agregarCuenta(datosCuenta, formulario);
    });
  }

  // Función para agregar una nueva cuenta al servidor
  function agregarCuenta(datosCuenta, formulario) {
    // Realizamos una solicitud POST para agregar la nueva cuenta al servidor
    fetch("../../../Controller/CuentaFinancieraController.php", {
      method: "POST",  // Usamos el método HTTP POST para enviar los datos
      headers: {
        "Content-Type": "application/json"  // Indicamos que los datos se envían en formato JSON
      },
      body: JSON.stringify([datosCuenta])  // Enviamos los datos de la cuenta como JSON
    })
    .then(response => response.text())  // Recibimos la respuesta como texto
    .then(text => {
      try {
        const data = JSON.parse(text);  // Intentamos parsear la respuesta a formato JSON
        if (data.status === "success") {
          alert("Cuenta agregada correctamente.");  // Si la cuenta se agregó correctamente
          fetchCuentas();  // Recargamos las cuentas para actualizar la lista
          formulario.reset();  // Limpiamos el formulario después de enviar
        } else {
          alert("Error al agregar: " + data.message);  // Si hay un error, mostramos el mensaje
        }
      } catch (e) {
        console.error("Error al procesar la respuesta del servidor:", text);  // En caso de error al procesar la respuesta
        alert("Error inesperado del servidor. Consulta la consola.");
      }
    })
    .catch(error => {  // Si hay un error en la conexión, lo mostramos en la consola
      console.error("Error en la conexión:", error);
    });

    // Ocultamos el formulario después de enviar
    document.getElementById("formularioCategoria1").classList.add("oculto");
  }

  // Función para mostrar el formulario si hay menos de 3 cuentas
  function mostrarFormulario() {
    // Realizamos una solicitud GET para verificar el número de cuentas
    fetch("../../../Controller/CuentaFinancieraController.php")
      .then(response => response.json())  // Recibimos las cuentas como JSON
      .then(data => {
        if (data.length >= 3) {  // Si ya hay 3 cuentas, mostramos un mensaje
          alert("Ya has creado las 3 cuentas permitidas.");
        } else {
          document.getElementById("formularioCategoria1").classList.remove("oculto");  // Si hay menos de 3, mostramos el formulario
        }
      });
  }

});
