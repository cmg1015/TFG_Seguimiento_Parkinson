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
        background-color: aliceblue;
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
    /* Establecer margen superior de 5px para cada div */
    div {
        margin-top: 5px;
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

    $id_paciente = $_SESSION['user_id'];
    $sql1 = "SELECT * FROM pautas WHERE paciente = '$id_paciente'";
    $result1 = mysqli_query($conn, $sql1);
    $num_filas = mysqli_num_rows($result1);
    $nummed=$num_filas;
    while ($row = $result1->fetch_assoc()) {
        $count=$row['nummed'];

        if ($count==1){
            $horas_registradas1=0;
            $medicacion1=$row['medicacion'];
            for ($i = 1; $i <= 5; $i++) {
                $variable_name = 'hora' . $i;
                $$variable_name = $row['hora_'.$i]; // Obtener el valor de la hora
                
                // Verificar si la hora está registrada
                if (!empty($$variable_name)) {
                    $horas_registradas1++; // Incrementar el contador
                } else {
                    $$variable_name = '00:00'; // Asignar null si la hora no está registrada
                }
            }
        }else if ($count == 2){
            $medicacion2=$row['medicacion'];
            $horas_registradas2=0;
            for ($i = 1; $i <= 5; $i++) {
                $variable_name = 'hora2_' . $i;
                $$variable_name = $row['hora_'.$i]; // Obtener el valor de la hora
                // Verificar si la hora está registrada
                if (!empty($$variable_name)) {
                    $horas_registradas2++; // Incrementar el contador
                } else {
                    $$variable_name = '00:00'; // Asignar null si la hora no está registrada
                }
            }
        }else if ($count == 3){
            $medicacion3=$row['medicacion'];
            $horas_registradas3=0;
            for ($i = 1; $i <= 5; $i++) {
                $variable_name = 'hora3_' . $i;
                $$variable_name = $row['hora_'.$i]; // Obtener el valor de la hora
                // Verificar si la hora está registrada
                if (!empty($$variable_name)) {
                    $horas_registradas3++; // Incrementar el contador
                } else {
                    $$variable_name = '00:00'; // Asignar null si la hora no está registrada
                }
            }
        }else if ($count == 4){
            $medicacion4=$row['medicacion'];
            $horas_registradas4=0;
            for ($i = 1; $i <= 5; $i++) {
                $variable_name = 'hora4_' . $i;
                $$variable_name = $row['hora_'.$i]; // Obtener el valor de la hora
                // Verificar si la hora está registrada
                if (!empty($$variable_name)) {
                    $horas_registradas4++; // Incrementar el contador
                } else {
                    $$variable_name = '00:00'; // Asignar null si la hora no está registrada
                }
            }
        }else if ($count == 5){
            $medicacion5=$row['medicacion'];
            $horas_registradas5=0;
            for ($i = 1; $i <= 5; $i++) {
                $variable_name = 'hora5_' . $i;
                $$variable_name = $row['hora_'.$i]; // Obtener el valor de la hora
                // Verificar si la hora está registrada
                if (!empty($$variable_name)) {
                    $horas_registradas5++; // Incrementar el contador
                } else {
                    $$variable_name = '00:00'; // Asignar null si la hora no está registrada
                }
            }
        }
    }
    // Cerrar la conexión
    $conn->close();
} else {
    // Si el parámetro 'fecha_actual' no está presente en la URL
    echo "No se ha seleccionado ninguna fecha.";
    exit; // Finaliza el script para evitar que se muestre el formulario vacío
}
?>
<br>
<br>
    <h2 style="text-align: center;">Diario de fluctuaciones motoras del día <?php echo $fecha ?></h2>
    <form action="procesardiario2.php" method="post" id="med_form">
    <input type="hidden" name="fecha" value="<?php echo $fecha ?>">
        <fieldset class="medicacion" >
            <legend style="text-align: center;">Introduzca únicamente datos relacionados con mediaciones que afectan a síntomas motores</legend>
            <div style="text-align: center; justify-content: center;">
            <!-- Agregar campo de selección para el número de medicaciones -->
            <label for="cantidad_medicaciones" style="text-align: center;">Número de Medicaciones:</label>
            <select id="cantidad_medicaciones" name="cantidad_medicaciones" value="<?php echo $horas_registradas1 ?>" onchange="mostrarMedicaciones()" style="text-align: center;">
                <option value="1" <?php if ($nummed== '1') echo 'selected'; ?> >1</option>
                <option value="2"  <?php if ($nummed == '2') echo 'selected'; ?> >2</option>
                <option value="3"  <?php if ($nummed == '3') echo 'selected'; ?> >3</option>
                <option value="4"  <?php if ($nummed == '4') echo 'selected'; ?> >4</option>
                <option value="5"   <?php if ($nummed == '5') echo 'selected'; ?> >5</option>
            </select>

<table>
    <div class="fila_medicacion" id="fila_medicacion_1">
        <div class="celda_medicacion" id="celda_medicacion_1">
            <!-- Campos de medicación ocultos por defecto -->
            <div id="campos_medicacion_1">
                <div>
                    <label for="nombre_med_1">1 Nombre de la medicación:</label>
                    <input type="text" id="nombre_med_1" name="nombre_med_1"  value=<?php if (isset($medicacion1)) echo $medicacion1 ?>>
                </div>
                <div>
                    <label for="cantidad_tomas1" style="text-align: center;">Número de Tomas de esta medicación:</label>
                    <select id="cantidad_tomas1"name="cantidad_tomas1" onload="mostrarTomas()" onchange="mostrarTomas()" style="text-align: center;">
                        <option value="1" <?php if ($horas_registradas1 == '1') echo 'selected'; ?> >1</option>
                        <option value="2" <?php if ($horas_registradas1 == '2') echo 'selected'; ?>>2</option>
                        <option value="3" <?php if ($horas_registradas1 == '3') echo 'selected'; ?>>3</option>
                        <option value="4" <?php if ($horas_registradas1 == '4') echo 'selected'; ?>>4</option>
                        <option value="5" <?php if ($horas_registradas1 == '5') echo 'selected'; ?>>5</option>
                    </select>
                </div>
                <div>
                    <label for="toma_med_1"><strong>Toma 1 </strong>de medicación:</label>
                    <select id="toma_med_1" name="toma_med_1">
                        <!-- Opciones de franjas horarias -->
                    </select>
                </div>

                <div id="tomas1_2" style="display: none;">
                    <div>
                        <label for="toma_med_12"><strong>Toma 2</strong> de medicación:</label>
                        <select id="toma_med_12" name="toma_med_12">
                            <!-- Opciones de franjas horarias -->
                        </select>
                    </div>
                </div>
                <div id="tomas1_3" style="display: none;">
                    <div>
                        <label for="toma_med_13"><strong>Toma 3</strong> de medicación:</label>
                        <select id="toma_med_13" name="toma_med_13">
                            <!-- Opciones de franjas horarias -->
                        </select>
                    </div>
                </div>
                <div id="tomas1_4" style="display: none;">
                    <div>
                        <label for="toma_med_14"><strong>Toma 4 </strong>de medicación:</label>
                        <select id="toma_med_14" name="toma_med_14">
                            <!-- Opciones de franjas horarias -->
                        </select>
                    </div>
                </div>
                <div id="tomas1_5" style="display: none;">
                    <div>
                        <label for="toma_med_15"><strong>Toma 5 </strong>de medicación:</label>
                        <select id="toma_med_15" name="toma_med_15">
                            <!-- Opciones de franjas horarias -->
                        </select>
                    </div>
                </div>


            </div>
        </div>
       <div class="celda_medicacion" id="celda_medicacion_2" style="display: none;">

            <!-- Campos de medicación adicionales ocultos por defecto -->
            <div id="campos_medicacion_2">
            <div>
                    <label for="nombre_med_2">Nombre de la medicación:</label>
                    <input type="text" id="nombre_med_2" name="nombre_med_2"  value=<?php if (isset($medicacion2)) echo $medicacion2 ?>>
                </div>
                <div>
                    <label for="cantidad_tomas2" style="text-align: center;">Número de Tomas de esta medicación:</label>
                    <select id="cantidad_tomas2" name="cantidad_tomas2" onchange="mostrarTomas()" style="text-align: center;">
                        <option value="1" <?php if (isset($horas_registradas2) && $horas_registradas2 == '1') echo 'selected'; ?> >1</option>
                        <option value="2" <?php if (isset($horas_registradas2) && $horas_registradas2 == '2') echo 'selected'; ?> >2</option>
                        <option value="3" <?php if (isset($horas_registradas2) && $horas_registradas2 == '3') echo 'selected'; ?> >3</option>
                        <option value="4" <?php if (isset($horas_registradas2) && $horas_registradas2 == '4') echo 'selected'; ?> >4</option>
                        <option value="5" <?php if (isset($horas_registradas2) && $horas_registradas2 == '5') echo 'selected'; ?> >5</option>
                    </select>
                </div>
                <div>
                    <label for="toma_med_2"><strong>Toma 1</strong> de medicación:</label>
                    <select id="toma_med_2" name="toma_med_2">
                        <!-- Opciones de franjas horarias -->
                    </select>
                <div id="tomas2_2" style="display: none;">
                    <div>
                        <label for="toma_med_22"><strong>Toma 2</strong> de medicación:</label>
                        <select id="toma_med_22" name="toma_med_22">
                            <!-- Opciones de franjas horarias -->
                        </select>
                    </div>
                </div>
                <div id="tomas2_3" style="display: none;">
                    <div>
                        <label for="toma_med_23"><strong>Toma 3 </strong>de medicación:</label>
                        <select id="toma_med_23" name="toma_med_23">
                            <!-- Opciones de franjas horarias -->
                        </select>
                    </div>
                </div>
                <div id="tomas2_4" style="display: none;">
                    <div>
                        <label for="toma_med_24"><strong>Toma 4</strong> de medicación:</label>
                        <select id="toma_med_24" name="toma_med_24">
                            <!-- Opciones de franjas horarias -->
                        </select>
                    </div>
                </div>
                <div id="tomas2_5" style="display: none;">
                    <div>
                        <label for="toma_med_25"><strong>Toma 5</strong> de medicación:</label>
                        <select id="toma_med_25" name="toma_med_25">
                            <!-- Opciones de franjas horarias -->
                        </select>
                    </div>
                </div>
            
                </div>

            </div>
        </div>
        <div class="celda_medicacion" id="celda_medicacion_3" style="display: none;">
            <div id="campos_medicacion_3">
            <div>
                    <label for="nombre_med_3">Nombre de la medicación:</label>
                    <input type="text" id="nombre_med_3" name="nombre_med_3" value=<?php if (isset($medicacion3)) echo $medicacion3 ?>>
                </div>
                <div>
                    <label for="cantidad_tomas3" style="text-align: center;">Número de Tomas de esta medicación:</label>
                    <select id="cantidad_tomas3" name="cantidad_tomas3" onchange="mostrarTomas()" style="text-align: center;">
                        <option value="1" <?php if (isset($horas_registradas3) && $horas_registradas3 == '1') echo 'selected'; ?> >1</option>
                        <option value="2" <?php if (isset($horas_registradas3) && $horas_registradas3 == '2') echo 'selected'; ?> >2</option>
                        <option value="3" <?php if (isset($horas_registradas3) && $horas_registradas3 == '3') echo 'selected'; ?> >3</option>
                        <option value="4" <?php if (isset($horas_registradas3) && $horas_registradas3 == '4') echo 'selected'; ?> >4</option>
                        <option value="5" <?php if (isset($horas_registradas3) && $horas_registradas3 == '5') echo 'selected'; ?> >5</option>
                    </select>
                </div>
                <div>
                    <label for="toma_med_3"><strong>Toma 1</strong> de medicación:</label>
                    <select id="toma_med_3" name="toma_med_3">
                        <!-- Opciones de franjas horarias -->
                    </select>
                </div>


                <div id="tomas3_2" style="display: none;">
                    <div>
                        <label for="toma_med_32"><strong>Toma 2</strong> de medicación:</label>
                        <select id="toma_med_32" name="toma_med_32">
                            <!-- Opciones de franjas horarias -->
                        </select>
                    </div>
                </div>
                <div id="tomas3_3" style="display: none;">
                    <div>
                        <label for="toma_med_33"><strong>Toma 3</strong> de medicación:</label>
                        <select id="toma_med_33" name="toma_med_33">
                            <!-- Opciones de franjas horarias -->
                        </select>
                    </div>
                </div>
                <div id="tomas3_4" style="display: none;">
                    <div>
                        <label for="toma_med_34"><strong>Toma 4</strong> de medicación:</label>
                        <select id="toma_med_34" name="toma_med_34">
                            <!-- Opciones de franjas horarias -->
                        </select>
                    </div>
                </div>
                <div id="tomas3_5" style="display: none;">
                    <div>
                        <label for="toma_med_35"><strong>Toma 5</strong> de medicación:</label>
                        <select id="toma_med_35" name="toma_med_35">
                            <!-- Opciones de franjas horarias -->
                        </select>
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
                    <input type="text" id="nombre_med_4" name="nombre_med_4"  value=<?php if (isset($medicacion4)) echo $medicacion4 ?>>
                </div>
                <div>
                    <label for="cantidad_tomas4" style="text-align: center;">Número de Tomas de esta medicación:</label>
                    <select id="cantidad_tomas4" name="cantidad_tomas4" onchange="mostrarTomas()" style="text-align: center;">
                        <option value="1" <?php if (isset($horas_registradas4) && $horas_registradas4 == '1') echo 'selected'; ?> >1</option>
                        <option value="2" <?php if (isset($horas_registradas4) && $horas_registradas4 == '2') echo 'selected'; ?> >2</option>
                        <option value="3" <?php if (isset($horas_registradas4) && $horas_registradas4 == '3') echo 'selected'; ?> >3</option>
                        <option value="4" <?php if (isset($horas_registradas4) && $horas_registradas4 == '4') echo 'selected'; ?> >4</option>
                        <option value="5" <?php if (isset($horas_registradas4) && $horas_registradas4 == '5') echo 'selected'; ?> >5</option>
                    </select>
                </div>
                <div>
                    <label for="toma_med_4"><strong>Toma 1</strong> de medicación:</label>
                    <select id="toma_med_4" name="toma_med_4">
                        <!-- Opciones de franjas horarias -->
                    </select>
                </div>


                <div id="tomas4_2" style="display: none;">
                    <div>
                        <label for="toma_med_42"><strong>Toma 2</strong> de medicación:</label>
                        <select id="toma_med_42" name="toma_med_42">
                            <!-- Opciones de franjas horarias -->
                        </select>
                    </div>
                </div>
                <div id="tomas4_3" style="display: none;">
                    <div>
                        <label for="toma_med_43"><strong>Toma 3</strong> de medicación:</label>
                        <select id="toma_med_43" name="toma_med_43">
                            <!-- Opciones de franjas horarias -->
                        </select>
                    </div>
                </div>
                <div id="tomas4_4" style="display: none;">
                    <div>
                        <label for="toma_med_44"><strong>Toma 4</strong> de medicación:</label>
                        <select id="toma_med_44" name="toma_med_44">
                            <!-- Opciones de franjas horarias -->
                        </select>
                    </div>
                </div>
                <div id="tomas4_5" style="display: none;">
                    <div>
                        <label for="toma_med_45"><strong>Toma 5</strong> de medicación:</label>
                        <select id="toma_med_45" name="toma_med_45">
                            <!-- Opciones de franjas horarias -->
                        </select>
                    </div>
                </div>
            </div>
    </div>
    <div class="celda_medicacion" id="celda_medicacion_5" style="display: none">
            <div id="campos_medicacion_5">
            <div>
                    <label for="nombre_med_5">Nombre de la medicación:</label>
                    <input type="text" id="nombre_med_5" name="nombre_med_5"  value=<?php if (isset($medicacion5)) echo $medicacion5 ?>>
                </div>
                <div>
                    <label for="cantidad_tomas5" style="text-align: center;">Número de Tomas de esta medicación:</label>
                    <select id="cantidad_tomas5" name="cantidad_tomas5" onchange="mostrarTomas()" style="text-align: center;">
                        <option value="1" <?php if (isset($horas_registradas5) && $horas_registradas5 == '1') echo 'selected'; ?> >1</option>
                        <option value="2" <?php if (isset($horas_registradas5) && $horas_registradas5 == '2') echo 'selected'; ?> >2</option>
                        <option value="3" <?php if (isset($horas_registradas5) && $horas_registradas5 == '3') echo 'selected'; ?> >3</option>
                        <option value="4" <?php if (isset($horas_registradas5) && $horas_registradas5 == '4') echo 'selected'; ?> >4</option>
                        <option value="5" <?php if (isset($horas_registradas5) && $horas_registradas5 == '5') echo 'selected'; ?> >5</option>
                    </select>
                </div>
                <div>
                    <label for="toma_med_5"><strong>Toma 1</strong> de medicación:</label>
                    <select id="toma_med_5" name="toma_med_5">
                        <!-- Opciones de franjas horarias -->
                    </select>
                </div>


                <div id="tomas5_2" style="display: none;">
                    <div>
                        <label for="toma_med_52"><strong>Toma 2</strong> de medicación:</label>
                        <select id="toma_med_52" name="toma_med_52">
                            <!-- Opciones de franjas horarias -->
                        </select>
                    </div>
                </div>
                <div id="tomas5_3" style="display: none;">
                    <div>
                        <label for="toma_med_53"><strong>Toma 3</strong> de medicación:</label>
                        <select id="toma_med_53" name="toma_med_53">
                            <!-- Opciones de franjas horarias -->
                        </select>
                    </div>
                </div>
                <div id="tomas5_4" style="display: none;">
                    <div>
                        <label for="toma_med_54"><strong>Toma 4</strong> de medicación:</label>
                        <select id="toma_med_54" name="toma_med_54">
                            <!-- Opciones de franjas horarias -->
                        </select>
                    </div>
                </div>
                <div id="tomas5_5" style="display: none;">
                    <div>
                        <label for="toma_med_55"><strong>Toma 5</strong> de medicación:</label>
                        <select id="toma_med_55" name="toma_med_55">
                            <!-- Opciones de franjas horarias -->
                        </select>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
</div>
</table>
        </fieldset>
        <button type="submit">Guardar</button>
        </form>



    <script>
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
        function mostrarTomas() {
            // Obtener el número seleccionado de medicaciones
            for (let i = 1; i<=5; i++){
                const cantidadTomas = parseInt(document.getElementById('cantidad_tomas' + i).value);

                // Ocultar todos los campos de medicación
                for (let j = 2; j <= 5; j++) {
                    document.getElementById('tomas' + i + '_' + j).style.display = 'none';
                }

                // Mostrar los campos de medicación correspondientes al número seleccionado
                for (let j = 2; j <= cantidadTomas; j++) {
                    document.getElementById('tomas' + i + '_' + j).style.display = 'block';
                }
            }

        }

        let contadorTomas = 1;
        function agregarToma(medicacionDiv) {
            const MedLabel = document.createElement('label');
            MedLabel.textContent = 'Toma de medicación adicional: ';
            // Crear una nueva etiqueta <label> para el campo de toma de medicación
            const tomaMedLabel = document.createElement('label');
            tomaMedLabel.textContent = 'Toma de medicación: ';



            // Clonar el campo de toma de medicación y efectos de medicación
            const tomaMedDiv = document.querySelector('#toma_med_1').cloneNode(true);

            // Crear un salto de línea
            const lineBreak = document.createElement('br');

            // Agregar las etiquetas, los campos clonados y el salto de línea al formulario
            medicacionDiv.appendChild(document.createElement('br'));
            medicacionDiv.appendChild(MedLabel);
            medicacionDiv.appendChild(document.createElement('br'));
            medicacionDiv.appendChild(tomaMedLabel);
            medicacionDiv.appendChild(tomaMedDiv);
            medicacionDiv.appendChild(document.createElement('br'));
            // Incrementar el contador de tomas
            contadorTomas++;
        }

        // Generar opciones de franjas horarias para todos los elementos toma_med y efectos_med
        for (let i = 1; i <= 5; i++) {
            const tomaMedSelect = document.getElementById(`toma_med_${i}`);
            if (tomaMedSelect) {
                generarOpcionesFranjasHorarias(tomaMedSelect);
            }
        }
        for (let j = 1; j <= 5; j++){
            for (let i = 2; i <= 5; i++) {
                const tomaMedSelect = document.getElementById(`toma_med_${j}${i}`);
                if (tomaMedSelect ) {
                    generarOpcionesFranjasHorarias(tomaMedSelect);
                }
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
        
        document.addEventListener('DOMContentLoaded', function() {
        // Llamar a la función mostrarTomas() al cargar la página
        mostrarTomas();
        mostrarMedicaciones();

        });

    </script>
</body>
</html>
