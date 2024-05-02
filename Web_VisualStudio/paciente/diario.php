<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla/Formulario</title>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
    html, body {
        height: 100%;
        margin: 0;
        background: linear-gradient(135deg, rgba(174, 214, 241, 0.3), rgba(250, 219, 216, 0.3), rgba(245, 183, 177, 0.3), rgba(210, 180, 222, 0.3));
        background-blend-mode: overlay;
        font-family: Arial, sans-serif;
    }
    .table {
        margin: 20px auto; /* Centra la tabla */
        max-width: 40%; /* Máximo ancho permitido */
        margin-right:30%;
        margin-left:30%;
    }
    table {
        width: 35%;
        border-collapse: collapse; /* Combina los bordes de las celdas */
        border: 5px solid gray; /* Añade un borde a la tabla */
        margin-top: 20px;
        margin-right:32.5%;
        margin-left:32.5%;
        background:#DDC3E0;
    }
    th, td {
        border: 1px solid gray; /* Añade bordes a las celdas */
        padding: 10px; /* Ajusta el relleno de las celdas */
        text-align: left;
    }
    h1{
        text-align:center;
        margin:20px;
    }
    button[type="submit"]  {
            margin: 10px;
            padding: 10px 20px;
            border: none;
            background-color: #79c3f5;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            text-align: center;
            margin-left: 48%
    }

    button[type="submit"]:hover {
        background-color: #D2B4DE;
    }
    .boton{
        margin: 10px;
        padding: 10px 20px;
        border: none;
        background-color: #79c3f5;
        color: white;
        cursor: pointer;
        transition: background-color 0.3s ease;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        text-align: center;
        margin-left: 48%

    }
    
</style>

</head>
<body>
    <?php
            include '../paciente/menu.php'; // Incluye el menú
    ?>
<?php
// Verifica si el parámetro 'fecha_actual' está presente en la URL
if (isset($_GET['fecha_actual'])) {
    // Recoge el valor del parámetro 'fecha'
    $fecha = $_GET['fecha_actual'];
    // Crear un objeto DateTime con el formato original
    $fechaa = DateTime::createFromFormat('d-m-Y', $fecha);

    if ($fechaa !== false) {
        // Formatear la fecha en el formato deseado "año-mes-dia"
        $fecha = $fechaa->format('Y-m-d');
        echo "Fecha formateada: $fecha";
    } else {
        echo "La fecha no tiene el formato correcto (dia-mes-año).";
    }

    // Realiza la conexión a la base de datos (asegúrate de reemplazar estos valores con los de tu configuración)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "webparkinson";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta para obtener los datos de la base de datos para la fecha seleccionada
    $sql = "SELECT * FROM diario WHERE fecha = '$fecha'";
    $result = $conn->query($sql);

    // Crear un array asociativo para almacenar los datos existentes
    $existing_data = array();
    while ($row = $result->fetch_assoc()) {
        $existing_data[$row['hora']] = array(
            'on' => $row['on_status'],
            'off' => $row['off_status'],
            'medication' => $row['medicacion']
        );
    }

    // Cerrar la conexión
    $conn->close();
} else {
    // Si el parámetro 'fecha_actual' no está presente en la URL
    echo "No se ha seleccionado ninguna fecha.";
    exit; // Finaliza el script para evitar que se muestre el formulario vacío
}
?>

    <h2>Diario del día <?php echo $fecha ?></h2>
    <form action="#" method="post" id="med_form">
        <fieldset class="medicacion" >
            <legend>Medicación</legend>
            <div id="medicacion">
            <div>
                <label for="nombre_med">Nombre de la medicación:</label>
                <input type="text" id="nombre_med" name="nombre_med[]">
            </div>
            <div>
                <label for="toma_med">Toma de medicación:</label>
                <select id="toma_med" name="toma_med[]">
                    <!-- Opciones de franjas horarias -->
                </select>
            </div>
            <div>
                <label for="efectos_med">Efectos de medicación:</label>
                <select id="efectos_med" name="efectos_med[]">
                    <!-- Opciones de franjas horarias -->
                </select>
            </div>
        <div id="2botones">
        <div id="botones">
            <button type="button" onclick="agregarToma(this.parentNode.parentNode)">Añadir Toma</button>
        </div>
        </div>
        <button type="button" onclick="agregarMedicacion()">Añadir Medicación</button>
        </div>
        </fieldset>
        </form>
        <button type="submit">Guardar</button>


    <script>
        let contadorMedicaciones =1;
        function agregarMedicacion() {
            contadorMedicaciones++;
            const MedLabel = document.createElement('label');
            MedLabel.textContent = 'Medicación ' + contadorMedicaciones + ': ';
            // Clonar el conjunto de campos de medicación
            const medicacionDiv = document.querySelector('#medicacion').cloneNode(true);
            // Crear un botón "Agregar Toma"


            // Obtener el formulario actual
            const formulario = document.getElementById('med_form');

            // Agregar los campos clonados al formulario
            formulario.appendChild(document.createElement('br'));
            formulario.appendChild(MedLabel);
            formulario.appendChild(document.createElement('br'));
            formulario.appendChild(medicacionDiv);

        }

        let contadorTomas = 1;
        function agregarToma(medicacionDiv) {
            const MedLabel = document.createElement('label');
            MedLabel.textContent = 'Toma de medicación adicional ' + contadorTomas + ': ';
            // Crear una nueva etiqueta <label> para el campo de toma de medicación
            const tomaMedLabel = document.createElement('label');
            tomaMedLabel.textContent = 'Toma de medicación: ';

            // Crear una nueva etiqueta <label> para el campo de efectos de medicación
            const efectosMedLabel = document.createElement('label');
            efectosMedLabel.textContent = 'Efectos de medicación: ';

            // Clonar el campo de toma de medicación y efectos de medicación
            const tomaMedDiv = document.querySelector('#toma_med').cloneNode(true);
            const efectosMedDiv = document.querySelector('#efectos_med').cloneNode(true);

            // Crear un salto de línea
            const lineBreak = document.createElement('br');

            // Agregar las etiquetas, los campos clonados y el salto de línea al formulario
            medicacionDiv.appendChild(document.createElement('br'));
            medicacionDiv.appendChild(MedLabel);
            medicacionDiv.appendChild(document.createElement('br'));
            medicacionDiv.appendChild(tomaMedLabel);
            medicacionDiv.appendChild(tomaMedDiv);
            medicacionDiv.appendChild(document.createElement('br'));
            medicacionDiv.appendChild(efectosMedLabel);
            medicacionDiv.appendChild(efectosMedDiv);
            medicacionDiv.appendChild(document.createElement('br'));

            // Incrementar el contador de tomas
            contadorTomas++;
        }



        // Generar opciones de franjas horarias
        const tomaMedSelect = document.getElementById('toma_med');
        const efectosMedSelect = document.getElementById('efectos_med');

        for (let hora = 0; hora < 24; hora++) {
            const horaStr = hora.toString().padStart(2, '0');
            const franjaHora = `${horaStr}:00-${horaStr}:59`;

            const tomaOption = document.createElement('option');
            tomaOption.value = franjaHora;
            tomaOption.textContent = franjaHora;
            tomaMedSelect.appendChild(tomaOption);

            const efectosOption = document.createElement('option');
            efectosOption.value = franjaHora;
            efectosOption.textContent = franjaHora;
            efectosMedSelect.appendChild(efectosOption);
        }
    </script>
</body>
</html>
