<?php
class CuentaFinancieraModel
{
    private $conn;  // Variable para almacenar la conexión a la base de datos

    // Constructor que recibe la conexión a la base de datos
    public function __construct($db)
    {
        $this->conn = $db;  // Asigna la conexión a la propiedad de la clase
    }

    // Verifica si ya existe una cuenta con el nombre de usuario dado
    public function cuentaExiste($usuario)
    {
        // Preparamos una consulta SQL para verificar si existe una cuenta con el nombre de usuario
        $stmt = $this->conn->prepare("SELECT 1 FROM cuentas WHERE usuario = ?");
        $stmt->bind_param("s", $usuario);  // Vinculamos el parámetro de tipo string
        $stmt->execute();  // Ejecutamos la consulta
        $stmt->store_result();  // Almacenamos los resultados de la consulta

        // Verificamos si el número de filas obtenidas es mayor que cero (es decir, si ya existe una cuenta)
        $existe = $stmt->num_rows > 0;

        $stmt->close();  // Cerramos la consulta
        return $existe;  // Devolvemos si la cuenta existe o no
    }

    // Guarda varias cuentas en la base de datos de manera segura
    public function guardarCuentas($cuentas)
    {
        // Preparamos la consulta SQL para insertar una cuenta en la base de datos
        $stmt = $this->conn->prepare("INSERT INTO cuentas(usuario, saldo, tope) VALUES (?, ?, ?)");
        if (!$stmt)  // Verificamos si la preparación de la consulta fue exitosa
            return false;

        // Recorremos cada cuenta del array de cuentas
        foreach ($cuentas as $cuenta) {
            $usuario = $cuenta['usuario'];
            $saldo = $cuenta['saldo'];
            $tope = $cuenta['tope'];

            // Verificamos si la cuenta ya existe antes de insertarla
            if ($this->cuentaExiste($usuario)) {
                continue;  // Si la cuenta ya existe, pasamos a la siguiente sin hacer nada
                // También podríamos usar return false aquí si queremos detener la ejecución al primer duplicado
            }

            // Vinculamos los parámetros con los valores de la cuenta
            $stmt->bind_param("sdd", $usuario, $saldo, $tope);  // 's' para string y 'd' para double
            if (!$stmt->execute()) {  // Si la ejecución falla, cerramos la consulta y devolvemos false
                $stmt->close();
                return false;
            }
        }

        $stmt->close();  // Cerramos la consulta después de guardar todas las cuentas
        return true;  // Si todo ha ido bien, devolvemos true indicando éxito
    }

    // Obtiene todas las cuentas de la base de datos
    public function obtenerCuentas()
    {
        $sql = "SELECT * FROM cuentas";  // Consulta SQL para obtener todas las cuentas
        $result = $this->conn->query($sql);  // Ejecutamos la consulta

        $cuentas = [];  // Array para almacenar las cuentas obtenidas
        if ($result && $result->num_rows > 0) {  // Si la consulta se ejecutó correctamente y hay resultados
            // Recorremos todos los resultados y los agregamos al array de cuentas
            while ($row = $result->fetch_assoc()) {
                $cuentas[] = $row;
            }
        }

        return $cuentas;  // Devolvemos el array de cuentas
    }
}
?>
