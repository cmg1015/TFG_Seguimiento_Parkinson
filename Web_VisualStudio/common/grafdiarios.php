<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfica</title>
    <style>
        .grafica-container {
            display: none;
        }
        html, body {
            height: 90%;
            padding: 3%; /* Añadir márgenes de 20px alrededor del contenido */
            background: linear-gradient(135deg, rgba(174, 214, 241, 0.3), rgba(250, 219, 216, 0.3), rgba(245, 183, 177, 0.3), rgba(210, 180, 222, 0.3));
            background-blend-mode: overlay;
            font-family: Arial, sans-serif;
        }
    </style>
    <script>
        function toggleGrafica(graficaId) {
            var grafica = document.getElementById(graficaId);
            grafica.style.display = (grafica.style.display === 'none' || grafica.style.display === '') ? 'block' : 'none';
        }
    </script>
</head>
<body>
<h2>Gráfica de número de bloqueos en cada actividad realizada</h2>
<button onclick="toggleGrafica('grafica')">Mostrar/Esconder Gráfica</button>
<div id="grafica" class="grafica-container">
    <?php
    // Obtener las fechas comunes de las tablas diario y diario2 de la base de datos
    $connection = mysqli_connect("localhost", "root", "", "webparkinson");
    $query = "SELECT DISTINCT fecha FROM diario WHERE fecha IN (SELECT DISTINCT fecha FROM diario2)";
    $result = mysqli_query($connection, $query);
    ?>
    <form method="post" action="">
        <label for="fecha">Selecciona una fecha:</label>
        <select name="fecha" id="fecha">
            <?php
            // Mostrar las fechas en el select
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['fecha'] . "'>" . $row['fecha'] . "</option>";
            }
            ?>
        </select>
    </form>
    <?php
    // Ejecutar el script de Python con la fecha seleccionada como parámetro
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fecha_seleccionada = $_POST['fecha'];
        echo $fecha_seleccionada;
        exec("python /xampp/htdocs/Web_VisualStudio_paraDescargar/Web_VisualStudio/common/grafdiarios.py $fecha_seleccionada");
    }
    ?>
    <img src="graficamed.png" alt="Gráfica de número de bloqueos en cada actividad realizada">
</div>


    <h2>Gráfica de número de bloqueos por minuto en cada actividad realizada</h2>
    <button onclick="toggleGrafica('grafica1')">Mostrar/Esconder Gráfica</button>
    <div id="grafica1" class="grafica-container">
        <?php
            shell_exec('python /xampp/htdocs/Web_VisualStudio_paraDescargar/Web_VisualStudio/common/graficasmed.py')
        ?>
        <img src="graficamed1.png" alt="Gráfica de número de bloqueos por minuto en cada actividad realizada">
    </div>

</body>
</html>
<?php

// Ruta al archivo Python
$archivo_python = 'intentografdiarios.py';

// Argumento para el script Python (fecha pasada)
$fecha_pasada = isset($_GET['fecha_pasada']) ? $_GET['fecha_pasada'] : '2024-05-20';

// Comando para ejecutar el script Python con el argumento
$comando = "python $archivo_python $fecha_pasada";

// Ejecutar el comando y obtener la salida
$output = 'graficamed.png';

// Mostrar la salida
echo "<pre>$output</pre>";

?>
