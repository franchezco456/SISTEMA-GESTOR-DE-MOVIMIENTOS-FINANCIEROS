
//ESTE SCRIPT SE ENCARGA DE LAS 3 CUENTAS Y EL FORMULARIO

// Espera a que todo el contenido HTML esté cargado antes de ejecutar el código
document.addEventListener("DOMContentLoaded", function () {

  // Intenta recuperar los cuadros guardados del almacenamiento local
  // Si no hay nada, comienza con un arreglo vacío
  let divsGuardados = JSON.parse(localStorage.getItem("cuadros")) || [];

  // Función que crea visualmente un cuadro con los datos del usuario
  function crearDivVisual(datos) {
    // Crea un nuevo div y le da una clase para estilos
    const nuevoDiv = document.createElement("div");
    nuevoDiv.className = "mi-div";

    // Inserta los datos del usuario dentro del div
    nuevoDiv.innerHTML = `
      <p id="cuenta"><strong>Cuenta:</strong> ${datos.usuario}</p><br>
      <p id="saldo"><strong>Saldo:</strong> ${datos.saldo}</p><br>
      <p id="tope"><strong>Tope:</strong> ${datos.tope}</p><br>
    `;

    // Crea un botón para eliminar el div
    const botonEliminar = document.createElement("button");
    botonEliminar.textContent = "Eliminar";
    botonEliminar.className = "boton2";

    // Al hacer clic en el botón "Eliminar"
    botonEliminar.addEventListener("click", function () {
      // Filtra el objeto actual del array guardado
      divsGuardados = divsGuardados.filter(d => 
        d.usuario !== datos.usuario || d.saldo !== datos.saldo || d.tope !== datos.tope
      );

      // Guarda el nuevo estado en localStorage
      localStorage.setItem("cuadros", JSON.stringify(divsGuardados));

      // Elimina el div de la pantalla
      nuevoDiv.remove();
    });

    // Agrega el botón de eliminar al div
    nuevoDiv.appendChild(botonEliminar);

    // Agrega el div completo al contenedor principal en el HTML
    document.getElementById("contenedor").appendChild(nuevoDiv);
  }

  // Recorre los cuadros guardados y los muestra en pantalla
  divsGuardados.forEach(datos => {
    crearDivVisual(datos);
  });

  // Función para crear un nuevo cuadro con los datos ingresados
  window.crearDiv = function (usuario, saldo, tope) {
    // Si ya hay 3 cuadros creados, muestra una alerta y no permite más
    if (divsGuardados.length >= 3) {
      alert("Ya has creado los 3 cuadros permitidos.");
      return;
    }

    // Crea un objeto con los datos ingresados
    const nuevoUsuario = { usuario, saldo, tope };

    // Agrega el nuevo objeto al array
    divsGuardados.push(nuevoUsuario);

    // Guarda el nuevo array actualizado en el almacenamiento local
    localStorage.setItem("cuadros", JSON.stringify(divsGuardados));

    // Crea el div visual en la página
    crearDivVisual(nuevoUsuario);
  };

  // Escucha el evento "submit" del formulario
  document.getElementById("formAgregar").addEventListener("submit", function (e) {
    e.preventDefault(); // Previene el recargo de la página

    // Obtiene los valores ingresados por el usuario en el formulario
    const cuenta = document.getElementById("inputCuenta").value;
    const saldo = document.getElementById("inputSaldo").value;
    const tope = document.getElementById("inputTope").value;

    // Llama a la función para crear un nuevo div con esos datos
    crearDiv(cuenta, saldo, tope);

    // Oculta el formulario después de enviar
    document.getElementById("formularioCategoria1").classList.add("oculto");

    // Limpia los campos del formulario
    e.target.reset();
  });

  // Función para mostrar el formulario al hacer clic en el botón "+"
  window.mostrarFormulario = function () {
    // Si ya hay 3 cuadros, no muestra el formulario
    if (divsGuardados.length >= 3) {
      alert("Límite de cuadros alcanzado.");
      return;
    }

    // Quita la clase "oculto" para mostrar el formulario
    document.getElementById("formularioCategoria1").classList.remove("oculto");
  };
});