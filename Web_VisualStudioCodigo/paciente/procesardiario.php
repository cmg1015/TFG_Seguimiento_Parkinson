
<?php
function formatHora($hora) {
    if (strpos($hora, '.5') !== false) {
        $hora = str_replace('.5', '', $hora);
        return sprintf('%02d:30', $hora);
    } else {
        return sprintf('%02d:00', $hora);
    }
}
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
        } else {
            echo "La fecha no tiene el formato correcto (dia-mes-año).";
        }
        
    } else {
        echo "No se ha recibido ninguna fecha.";
    }

$data = $_POST['data'] ?? [];
        foreach ($data as $hora => $estado) {
            $dormido = isset($estado['dormido']) ? 1 : 0;
            $off = isset($estado['off']) ? 1 : 0;
            $on = isset($estado['on']) ? 1 : 0;
            $ondis = isset($estado['ondis']) ? 1 : 0;
            $fecha = $_GET['fecha'];
            $hora= formatHora($hora);

            $stmt = $conn->prepare("INSERT INTO diario (fecha, hora, durmiendo, off_status, on_status, ondis_status) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssiiii", $fecha1, $hora, $dormido, $off, $on, $ondis);
            $fecha_actual = date("Y-m-d");
            if ($stmt->execute()) {
                header("Location: diarios.php?fecha_actual=" . $fecha_actual);
                exit;
            } else {
                echo "Error al guardar el registro para la hora $hora: " . $stmt->error . "<br>";
            }
            
            $stmt->close();
        }


}

// Cerrar conexión
$conn->close();
?>

