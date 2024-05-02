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
    table {
        border-collapse: collapse;
        margin: 20px auto;
    }

    /* Estilos para las celdas de medicación */
    .celda_medicacion {
        border: 1px solid #ccc;
        padding: 5px;
        margin-right: 10px; /* Espacio entre celdas */
    }

    /* Estilos para las filas de medicación */
    .fila_medicacion {
        display: flex;/* Para que las celdas se muestren en línea */
        justify-content: center;
        margin-bottom: 10px; /* Espacio entre filas */
    }

    td {
            padding: 10px;
            border: 1px solid black;
            min-width: 150px; /* Establecer el ancho automático por defecto */
            min-height: 150px;
    }

    /* Centrar las filas */
    tr {
        text-align: center;
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
            margin-left: 47%;
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
        margin-left: 47%;

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

    <h2 style="text-align: center;">Diario de fluctuaciones motoras del día <?php echo $fecha ?></h2>
    <form action="#" method="post" id="med_form">
        <fieldset class="medicacion" >
            <legend style="text-align: center;">Introduzca únicamente datos relacionados con mediaciones que afectan a síntomas motores</legend>
            <div style="text-align: center; justify-content: center;">
            <!-- Agregar campo de selección para el número de medicaciones -->
            <label for="cantidad_medicaciones" style="text-align: center;">Número de Medicaciones:</label>
            <select id="cantidad_medicaciones" onchange="mostrarMedicaciones()" style="text-align: center;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>

<table>
    <div class="fila_medicacion" id="fila_medicacion_1">
        <div class="celda_medicacion" id="celda_medicacion_1">
            <!-- Campos de medicación ocultos por defecto -->
            <div id="campos_medicacion_1">
                <div>
                    <label for="nombre_med_1">Nombre de la medicación:</label>
                    <input type="text" id="nombre_med_1" name="nombre_med[]">
                </div>
                <div>
                    <label for="toma_med_1">Toma de medicación:</label>
                    <select id="toma_med_1" name="toma_med[]">
                        <!-- Opciones de franjas horarias -->
                    </select>
                </div>
                <div>
                    <label for="efectos_med_1">Efectos de medicación:</label>
                    <select id="efectos_med_1" name="efectos_med[]">
                        <!-- Opciones de franjas horarias -->
                    </select>
                    <select id="efectos2_med_1" name="efectos_med[]">
                        <!-- Opciones de franjas horarias -->
                    </select>
                </div>
                <div id="2botones">
                    <div id="botones">
                        <button type="button" onclick="agregarToma(document.getElementById('campos_medicacion_1'))">Añadir Toma</button>
                    </div>
                </div>
            </div>
        </div>
       <div class="celda_medicacion" id="celda_medicacion_2" style="display: none;">

            <!-- Campos de medicación adicionales ocultos por defecto -->
            <div id="campos_medicacion_2">
            <div>
                    <label for="nombre_med_2">Nombre de la medicación:</label>
                    <input type="text" id="nombre_med_2" name="nombre_med[]">
                </div>
                <div>
                    <label for="toma_med_2">Toma de medicación:</label>
                    <select id="toma_med_2" name="toma_med[]">
                        <!-- Opciones de franjas horarias -->
                    </select>
                </div>
                <div>
                    <label for="efectos_med_2">Efectos de medicación:</label>
                    <select id="efectos_med_2" name="efectos_med[]">
                        <!-- Opciones de franjas horarias -->
                    </select>
                    <select id="efectos2_med_2" name="efectos_med[]">
                        <!-- Opciones de franjas horarias -->
                    </select>
                </div>
                <div id="2botones">
                    <div id="botones">
                        <button type="button" onclick="agregarToma(document.getElementById('campos_medicacion_2'))">Añadir Toma</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="celda_medicacion" id="celda_medicacion_3" style="display: none;">
            <div id="campos_medicacion_3">
            <div>
                    <label for="nombre_med_3">Nombre de la medicación:</label>
                    <input type="text" id="nombre_med_3" name="nombre_med[]">
                </div>
                <div>
                    <label for="toma_med_3">Toma de medicación:</label>
                    <select id="toma_med_3" name="toma_med[]">
                        <!-- Opciones de franjas horarias -->
                    </select>
                </div>
                <div>
                    <label for="efectos_med_3">Efectos de medicación:</label>
                    <select id="efectos_med_3" name="efectos_med[]">
                        <!-- Opciones de franjas horarias -->
                    </select>
                    <select id="efectos2_med_3" name="efectos_med[]">
                        <!-- Opciones de franjas horarias -->
                    </select>
                </div>
                <div id="2botones">
                    <div id="botones">
                        <button type="button" onclick="agregarToma(document.getElementById('campos_medicacion_3'))">Añadir Toma</button>
                    </div>
                </div>
            </div>
        </div>
</div>
<div class="fila_medicacion" id="fila_medicacion_2">
    <div class="celda_medicacion" id="celda_medicacion_4" style="display: none">
            <div id="campos_medicacion_4">
            <div>
                    <label for="nombre_med_4">Nombre de la medicación:</label>
                    <input type="text" id="nombre_med_4" name="nombre_med[]">
                </div>
                <div>
                    <label for="toma_med_4">Toma de medicación:</label>
                    <select id="toma_med_4" name="toma_med[]">
                        <!-- Opciones de franjas horarias -->
                    </select>
                </div>
                <div>
                    <label for="efectos_med_4">Efectos de medicación:</label>
                    <select id="efectos_med_4" name="efectos_med[]">
                        <!-- Opciones de franjas horarias -->
                    </select>
                    <select id="efectos2_med_4" name="efectos_med[]">
                        <!-- Opciones de franjas horarias -->
                    </select>
                </div>
                <div id="2botones">
                    <div id="botones">
                        <button type="button" onclick="agregarToma(document.getElementById('campos_medicacion_4'))">Añadir Toma</button>
                    </div>
                </div>
            </div>
    </div>
    <div class="celda_medicacion" id="celda_medicacion_5" style="display: none">
            <div id="campos_medicacion_5">
            <div>
                    <label for="nombre_med_5">Nombre de la medicación:</label>
                    <input type="text" id="nombre_med_5" name="nombre_med[]">
                </div>
                <div>
                    <label for="toma_med_5">Toma de medicación:</label>
                    <select id="toma_med_5" name="toma_med[]">
                        <!-- Opciones de franjas horarias -->
                    </select>
                </div>
                <div>
                    <label for="efectos_med_5">Efectos de medicación:</label>
                    <select id="efectos_med_5" name="efectos_med[]">
                        <!-- Opciones de franjas horarias -->
                    </select>
                    <select id="efectos2_med_5" name="efectos_med[]">
                        <!-- Opciones de franjas horarias -->
                    </select>
                </div>
                <div id="2botones">
                    <div id="botones">
                        <button type="button" onclick="agregarToma(document.getElementById('campos_medicacion_5'))">Añadir Toma</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
</table>
        </fieldset>
        </form>
        <button type="submit">Guardar</button>


    <script>
        // Función para mostrar u ocultar los campos de medicación según el número seleccionado
        function mostrarMedicaciones() {
            // Obtener el número seleccionado de medicaciones
            const cantidadMedicaciones = parseInt(document.getElementById('cantidad_medicaciones').value);

            // Ocultar todos los campos de medicación
            for (let i = 1; i <= 5; i++) {
                document.getElementById('celda_medicacion_' + i).style.display = 'none';
            }

            // Mostrar los campos de medicación correspondientes al número seleccionado
            for (let i = 1; i <= cantidadMedicaciones; i++) {
                document.getElementById('celda_medicacion_' + i).style.display = 'block';
            }
        }

        let contadorTomas = 1;
        function agregarToma(medicacionDiv) {
            const MedLabel = document.createElement('label');
            MedLabel.textContent = 'Toma de medicación adicional: ';
            // Crear una nueva etiqueta <label> para el campo de toma de medicación
            const tomaMedLabel = document.createElement('label');
            tomaMedLabel.textContent = 'Toma de medicación: ';

            // Crear una nueva etiqueta <label> para el campo de efectos de medicación
            const efectosMedLabel = document.createElement('label');
            efectosMedLabel.textContent = 'Efectos de medicación: ';

            // Clonar el campo de toma de medicación y efectos de medicación
            const tomaMedDiv = document.querySelector('#toma_med_1').cloneNode(true);
            const efectosMedDiv = document.querySelector('#efectos_med_1').cloneNode(true);

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

        // Generar opciones de franjas horarias para todos los elementos toma_med y efectos_med
        for (let i = 1; i <= 5; i++) {
            const tomaMedSelect = document.getElementById(`toma_med_${i}`);
            const efectosMedSelect = document.getElementById(`efectos_med_${i}`);
            const efectosMed1Select = document.getElementById(`efectos2_med_${i}`);
            if (tomaMedSelect && efectosMedSelect && efectosMed1Select) {
                generarOpcionesFranjasHorarias(tomaMedSelect);
                generarOpcionesFranjasHorarias(efectosMedSelect);
                generarOpcionesFranjasHorarias(efectosMed1Select);
            }
        }

        function generarOpcionesFranjasHorarias(selectElement) {
            // Eliminar las opciones existentes
            selectElement.innerHTML = '';

            // Generar nuevas opciones de franjas horarias
            for (let hora = 0; hora < 24; hora++) {
                const horaStr = hora.toString().padStart(2, '0');
                const franjaHora = `${horaStr}:00`;

                const option = document.createElement('option');
                option.value = franjaHora;
                option.textContent = franjaHora;
                selectElement.appendChild(option);
            }
        }

    </script>
</body>
</html>
