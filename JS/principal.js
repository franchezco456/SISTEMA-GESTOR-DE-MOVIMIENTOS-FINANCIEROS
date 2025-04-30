// SE Supone que con esta wea puedes poner puntos en numeros Ejemplo 1000 = 1.000 otro ejemplo 10000 = 10.000 etc
const input = document.getElementById("numero");
const resultado = document.getElementById("resultado");

input.addEventListener("input", () => {
  const numero = parseInt(input.value);
  if (!isNaN(numero)) {
    resultado.textContent = numero.toLocaleString('es-ES');
  } else {
    resultado.textContent = "";
  }
});