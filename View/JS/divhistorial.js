// Función para cargar y mostrar movimientos en la tabla
function cargarMovimientos() {
  fetch('api_movimientos.php')
    .then(response => response.json())
    .then(data => {
      const tbody = document.getElementById('tablaDatos');
      tbody.innerHTML = '';

      if (data.length === 0) {
        tbody.innerHTML = '<tr><td colspan="5">No hay movimientos registrados.</td></tr>';
        return;
      }

      data.forEach(mov => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td>${mov.idMovimiento}</td>
          <td>${mov.categoria}</td>
          <td>${mov.cantidad}</td>
          <td>${mov.fecha}</td>
          <td>${mov.idCuenta}</td>
        `;
        tbody.appendChild(tr);
      });
    })
    .catch(err => console.error('Error cargando movimientos:', err));
}

// Al cargar la página, cargar la tabla
window.addEventListener('load', cargarMovimientos);

// Manejar el formulario de modificar
document.querySelector('.modificarMovimiento').addEventListener('submit', function(e) {
  e.preventDefault();

  const id = document.getElementById('idMovimientoModificar').value;
  const categoria = document.getElementById('nuevaCategoria').value;
  const cantidad = document.getElementById('nuevaCantidad').value;

  const formData = new FormData();
  formData.append('accion', 'modificar');
  formData.append('id', id);
  formData.append('categoria', categoria);
  formData.append('cantidad', cantidad);

  fetch('api_movimientos.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      cargarMovimientos();
      alert(data.mensaje);
      // Opcional: limpiar formulario
      this.reset();
    } else {
      alert(data.mensaje);
    }
  })
  .catch(error => {
    console.error('Error:', error);
  });
});

// Manejar el formulario de eliminar
document.getElementById('eliminarMovimiento').addEventListener('submit', function(e) {
  e.preventDefault();

  const id = document.getElementById('idMovimientoEliminar').value;

  const formData = new FormData();
  formData.append('accion', 'eliminar');
  formData.append('id', id);

  fetch('api_movimientos.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      cargarMovimientos();
      alert(data.mensaje);
      this.reset();
    } else {
      alert(data.mensaje);
    }
  })
  .catch(error => {
    console.error('Error:', error);
  });
});
