//ESTE SCRIPT SE ENCARGA DE AMBAS GRAFICAS

document.addEventListener("DOMContentLoaded", function () {
  // Llama a la API para obtener los datos dinámicamente
  fetch('../../../View/API/api_graficas.php')
    .then(response => response.json())
    .then(data => {
      if (data.error) {
        alert(data.error);
        window.location.href = 'login.php';
        return;
      }

      const categorias = data.categorias;
      const gastos = data.gastos;

      // -------------------- GRÁFICA DE BARRAS --------------------
      const ctxBar = document.getElementById('graficaGastos').getContext('2d');
      const graficaBarras = new Chart(ctxBar, {
        type: 'bar',
        data: {
          labels: categorias,
          datasets: [{
            label: 'Gastos por Categoría ($)',
            data: gastos,
            backgroundColor: [
              '#74b9ff', '#ffeaa7', '#fab1a0', '#55efc4',
              '#e17055', '#a29bfe', '#fd79a8', '#81ecec', '#636e72'
            ]
          }]
        },
        options: {
          responsive: true,
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });

      // -------------------- GRÁFICA DE PASTEL --------------------
      const ctxPie = document.getElementById('graficaPastel').getContext('2d');
      const graficaPastel = new Chart(ctxPie, {
        type: 'pie',
        data: {
          labels: categorias,
          datasets: [{
            label: 'Distribución de Gastos',
            data: gastos,
            backgroundColor: [
              '#74b9ff', '#ffeaa7', '#fab1a0', '#55efc4',
              '#e17055', '#a29bfe', '#fd79a8', '#81ecec', '#636e72'
            ]
          }]
        },
        options: {
          responsive: true
        }
      });
    })
    .catch(error => {
      alert('Error al cargar los datos de las gráficas');
      console.error(error);
    });
});