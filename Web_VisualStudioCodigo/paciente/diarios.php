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
        background: linear-gradient(135deg, rgba(174, 214, 241, 0.3), rgba(250, 219, 216, 0.3), rgba(245, 183, 177, 0.3), rgba(210, 180, 222, 0.3));*/
        background-blend-mode: overlay;
        font-family: Arial, sans-serif;

    }
    .container {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        gap: 20px;
    }
    .item {
        text-align: center;
        width: 1000px;
        background-color: #E5F4FA;*/
        border: 3px solid blue;
        box-shadow: 3px 4px 6px rgba(0, 0, 0, 0.2);
        padding: 20px;
    }

    h1{
        text-align:center;
        margin:20px;
    }

    .button {
            display: inline-block;
            justify: center;
            padding: 20px 30px;
            font-size: 25px;
            color: black;
            background-color: lightblue;
            border: none;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            margin: 5px;
    }
    .button:hover {
        background-color: #74B5CF;
    }
    /* Establecer margen superior de 5px para cada div */
    div {
        margin-top: 5px;
    }
    .mensaje {
        padding: 15px;
        margin: 20px;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }
    .mensaje.verde {
        background-color: #d4edda;
        color: #155724;
    }
    .mensaje.amarillo {
        background-color: #fff3cd;
        color: #856404;
    }
    .icono {
        margin-right: 10px;
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
        $fechamandar = $_GET['fecha_actual'];
        $fechamostrar = strftime('%e/%m/%Y', strtotime($fecha));
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
        $estados="";
        $tomas="";
        if ($result->num_rows > 0) {
            $estados = "si";// Si hay filas en el resultado

            //echo "Hay " . $result->num_rows . " filas en el resultado.<br>";
        } 
        $sql2 = "SELECT * FROM diario2 WHERE fecha = '$fecha'";
        $result2 = $conn->query($sql2);
        $tomas="";
        if ($result2->num_rows > 0) {
            $tomas = "si";// Si hay filas en el resultado
            //echo $result2;
            //echo $fecha;
        }
    } else {
        echo "No se ha seleccionado ninguna fecha.";
        exit; // Finaliza el script para evitar que se muestre el formulario vacío
    }
    $conn->close();
    ?>

<br>
<br>
    <h2 style="text-align: center;">Acceso a los diarios del día <?php echo $fechamostrar ?></h2>
    <br>
    <br>
    <br>
    <div class="container">
        <div class="item">
            <a href="diariotomas.php?fecha_actual=<?php echo htmlspecialchars($fecha); ?>" class="button">Diario de tomas de medicación</a>
            <div id="mensaje1" class="mensaje <?php echo $tomas === 'si' ? 'verde' : 'amarillo'; ?>">
                <span class="icono"><?php echo $tomas === 'si' ? '✅' : '⚠️'; ?></span>
                <span><?php echo $tomas === 'si' ? 'Diario rellenado para el día de hoy.' : 'Aún no se ha rellenado el diario para la fecha de hoy'; ?></span>
            </div>
            <button class="explicacion-btn"><i class="fas fa-question-circle"></i> Instrucciones y explicación del diario</button>
            <div class="explicacion" style="display: none;">
                <!-- Texto de explicación -->
                En este diario usted puede registrar las tomas de medicaciones recetadas para manejar síntomas motores en el párkinson.<br>
                Al abrir el diario, haciendo click en <strong>"diario de tomas de medicación"</strong>, observará como respuestas predeterminadas la pauta de medicaciones
                que el profesional sanitario le haya asignado. Independientemente de que vea esta pauta asignada o no, puede modificar los campos que ve
                en pantalla, seleccionando el número de medicaciones diferentes que tomó hoy, sus nombres y las horas de toma de cada una de ellas.<br>
                Cuando haya terminado de rellenar el diario, pulse el botón <strong>"guardar"</strong>.
            </div>
        </div>
        <div class="item">
            <a href="diarioestado.php?fecha_actual=<?php echo htmlspecialchars($fecha); ?>" class="button">Diario de fluctuaciones motoras</a>
            <div id="mensaje2" class="mensaje <?php echo $estados === 'si' ? 'verde' : 'amarillo'; ?>">
                <span class="icono"><?php echo $estados === 'si' ? '✅' : '⚠️'; ?></span>
                <span><?php echo $estados === 'si' ? 'Diario rellenado para el día de hoy' : 'Aún no se ha rellenado el diario para la fecha de hoy'; ?></span>
            </div>
            <button class="explicacion-btn"><i class="fas fa-question-circle"></i> Instrucciones y explicación del diario</button>
            <div class="explicacion" style="display: none;">
                <!-- Texto de explicación -->
                En este diario usted puede registrar los estados en los que se encuentra a lo largo del día.<br>
                El estado  <strong>"ON"</strong>, indica que la medicación hace efecto, pueden realizarse movimientos con relativa agilidad<br>
                El estado  <strong>"ON con discinesia"</strong>, indica que la medicación hace efecto, pueden realizarse movimientos con relativa agilidad pero se producen movimientos musculares involuntarios<br>
                El estado  <strong>"OFF"</strong>, indica que la medicación no está haciendo efecto, se presentan síntomas como temblores, congelamientos de la marcha... de forma frecuente
                Para rellenar el diario tan sólo debe marcar al final del día los estados en los que se ha encontrado a lo largo del mismo, marcando con un tick la casilla correspondiente.<br>
                Por favor, marque un estado para cada intervalo horario.<br>
                Cuando haya terminado de rellenar el diario, pulse el botón <strong>"guardar"</strong>.
            </div>
        </div>
    </div>

    <script>
    // Función para mostrar u ocultar la explicación
    document.querySelectorAll('.explicacion-btn').forEach(button => {
        button.addEventListener('click', () => {
            const explicacion = button.nextElementSibling;
            if (explicacion.style.display === 'none' || explicacion.style.display === '') {
                explicacion.style.display = 'block';
            } else {
                explicacion.style.display = 'none';
            }
        });
    });
</script>
</body>
</html>