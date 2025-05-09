   
   //ESTE SCRIPT SE ENCARGA DE AMBAS GRAFICAS


  document.addEventListener("DOMContentLoaded", function () {
    // Espera a que el contenido HTML esté completamente cargado antes de ejecutar el código
  
    // VARIABLES – ESTO LO PUEDES MODIFICAR
    let Alimentos = 300;
    let Facturas = 400;
    let Transporte = 500;
    let Compras = 600;
    let Regalos = 700;
    let Educación = 800;
    let Renta = 900;
    let Viajes = 0;
  
    // Arreglo con los nombres de las categorías
    const categorias = [
      "Alimentos", "Facturas", "Transporte", "Compras",
      "Regalos", "Educación", "Renta", "Viajes"
    ];
  
    // Arreglo con los valores numéricos de gastos, en el mismo orden que las categorías
    const gastos = [
      Alimentos, Facturas, Transporte, Compras,
      Regalos, Educación, Renta, Viajes
    ];
  
    // -------------------- GRÁFICA DE BARRAS --------------------
  
    // Obtener el contexto del canvas donde se dibujará la gráfica de barras
    const ctxBar = document.getElementById('graficaGastos').getContext('2d');
  
    // Crear la gráfica de barras usando Chart.js
    const graficaBarras = new Chart(ctxBar, {
      type: 'bar', // Tipo de gráfica: barra
      data: {
        labels: categorias, // Etiquetas (categorías) en el eje X
        datasets: [{
          label: 'Gastos por Categoría ($)', // Leyenda del dataset
          data: gastos, // Datos a graficar
          backgroundColor: [ // Colores para cada barra
            '#74b9ff', '#ffeaa7', '#fab1a0', '#55efc4',
            '#e17055', '#a29bfe', '#fd79a8', '#81ecec'
          ]
        }]
      },
      options: {
        responsive: true, // Hace que la gráfica sea adaptable al tamaño del contenedor
        scales: {
          y: {
            beginAtZero: true // Comienza el eje Y en cero
          }
        }
      }
    });
  
    // -------------------- GRÁFICA DE PASTEL --------------------
  
    // Obtener el contexto del canvas donde se dibujará la gráfica de pastel
    const ctxPie = document.getElementById('graficaPastel').getContext('2d');
  
    // Crear la gráfica de pastel usando Chart.js
    const graficaPastel = new Chart(ctxPie, {
      type: 'pie', // Tipo de gráfica: pastel
      data: {
        labels: categorias, // Etiquetas para cada porción del pastel
        datasets: [{
          label: 'Distribución de Gastos', // Título del dataset
          data: gastos, // Datos a representar en el pastel
          backgroundColor: [ // Colores para cada segmento del pastel
            '#74b9ff', '#ffeaa7', '#fab1a0', '#55efc4',
            '#e17055', '#a29bfe', '#fd79a8', '#81ecec'
          ]
        }]
      },
      options: {
        responsive: true // Hace que la gráfica se ajuste automáticamente
      }
    });
  });