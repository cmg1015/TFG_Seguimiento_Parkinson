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

    $cantidadmedicaciones = $_POST["cantidad_medicaciones"];
    for ($i=1; $i<=$cantidadmedicaciones; $i++){
        $fecha=$_POST["fecha"];
        $medicacion=$_POST["nombre_med_$i"];
        $ntomas=$_POST["cantidad_tomas$i"];
        $hora1=$_POST["toma_med_$i"];
        
        if ($ntomas >= 2) {
            $hora2 = $_POST["toma_med_" . $i . "2"];
        } else {
            $hora2 = null;
        }
        
        if ($ntomas >= 3) {
            $hora3 = $_POST["toma_med_" . $i . "3"];
        } else {
            $hora3 = null;
        }
        
        if ($ntomas >= 4) {
            $hora4 = $_POST["toma_med_" . $i . "4"];
        } else {
            $hora4 = null;
        }
        
        if ($ntomas >= 5) {
            $hora5 = $_POST["toma_med_" . $i . "5"];      
        }else{
            $hora5=null;
        }
        $sql_insert = "INSERT INTO diario2 (fecha, medicacion, hora_1, hora_2, hora_3,  hora_4, hora_5) VALUES ('$fecha', '$medicacion', '$hora1', '$hora2', '$hora3', '$hora4', '$hora5')";
    
        if ($conn->query($sql_insert) === TRUE) {
            //echo "Registro insertado correctamente para la hora $i <br>";
            $fecha_actual = date("Y-m-d");
            header("Location: diarios.php?fecha_actual=" . $fecha_actual);
        } else {
            echo "Error al insertar registro: " . $conn->error;
        }
        
    }

}

// Cerrar conexión
$conn->close();
?>
