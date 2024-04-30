<?php
// Conexión a la base de datos (reemplaza los valores con los de tu configuración)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webparkinson";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se han recibido datos mediante POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    if (isset($_GET['fecha'])) {
        $fecha = $_GET['fecha'];

        // Crear un objeto DateTime con el formato original
        $date = DateTime::createFromFormat('d-m-Y', $fecha);
        
        if ($date !== false) {
            // Formatear la fecha en el formato deseado "año-mes-dia"
            $fecha1 = $date->format('Y-m-d');
            echo "Fecha formateada: $fecha1";
        } else {
            echo "La fecha no tiene el formato correcto (dia-mes-año).";
        }
        
        
        
        
        // Hacer lo que necesites con la fecha
        echo "La fecha recibida es: $fecha";
    } else {
        echo "No se ha recibido ninguna fecha.";
    }
    $on = $_POST['on'];
    $off = $_POST['off'];
    $medication = $_POST['medication'];

// Verificar si ya hay datos para la fecha dada
$sql_check = "SELECT COUNT(*) as count FROM diario WHERE fecha = '$fecha1'";
$result_check = $conn->query($sql_check);
$row_check = $result_check->fetch_assoc();
$count = $row_check['count'];

if ($count > 0) {
    // Ya hay datos para esta fecha, actualizar en lugar de insertar
    for ($i = 0; $i < 24; $i++) {
        $on_status = isset($on[$i]) ? 1 : 0;
        $off_status = isset($off[$i]) ? 1 : 0;
        $medication_value = isset($medication[$i]) ? $conn->real_escape_string($medication[$i]) : '';

        $sql_update = "UPDATE diario SET on_status = $on_status, off_status = $off_status, medicacion = '$medication_value' WHERE fecha = '$fecha1' AND hora = $i";
        
        if ($conn->query($sql_update) === TRUE) {
            echo "Registro actualizado correctamente para la hora $i <br>";
        } else {
            echo "Error al actualizar registro: " . $conn->error;
        }
    }
} else {
    // No hay datos para esta fecha, insertar nuevos registros
    for ($i = 0; $i < 24; $i++) {
        $on_status = isset($on[$i]) ? 1 : 0;
        $off_status = isset($off[$i]) ? 1 : 0;
        $medication_value = isset($medication[$i]) ? $conn->real_escape_string($medication[$i]) : '';

        $sql_insert = "INSERT INTO diario (fecha, hora, on_status, off_status, medicacion) VALUES ('$fecha1', $i, $on_status, $off_status, '$medication_value')";

        if ($conn->query($sql_insert) === TRUE) {
            echo "Registro insertado correctamente para la hora $i <br>";
        } else {
            echo "Error al insertar registro: " . $conn->error;
        }
    }
}

}

// Cerrar conexión
$conn->close();
?>
