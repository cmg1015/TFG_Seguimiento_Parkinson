<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <script src="../js/confirmacion.js"></script>
    <title>Gráfica</title>
    <style>
        .grafica-container {
            display: none;
        }
        html, body {
            height: 100%;
            margin: 0;

            background: #A4CEDF;
            background-blend-mode: overlay;
            font-family: Arial, sans-serif;

            justify-content: center;
            align-items: center;
            text-align: center; /* Opcional, para centrar el texto dentro del contenido */
        }
    </style>
    <script>
        function toggleGrafica(graficaId) {
            var grafica = document.getElementById(graficaId);
            grafica.style.display = (grafica.style.display === 'none' || grafica.style.display === '') ? 'block' : 'none';
        }
    </script>
    <script src="estadisticas.py"></script>

</head>
<?php
session_start();
if ($_SESSION['user_type'] === 'profesional') {
    include '../profesional/menu.php'; // Incluye el menú para profesionales
} else if ($_SESSION['user_type'] === 'paciente') {
    include '../paciente/menu.php'; // Incluye el menú para pacientes
} else if ($_SESSION['user_type'] === 'administrador') {
    include '../admin/menu.php'; // Incluye el menú para pacientes
} 
?>
<body>
<?php
// Ejecuta el script Python
shell_exec('python intentograficasmed.py');
shell_exec('python intentografdiarios.py');
shell_exec('python estadisticas.py');









?>
<br>
<div style="background:white; padding:5px; display:flex; justify-content:center; margin-left:20px; margin-right:20px;">
<img src="dibujografica.webp" style="height:100px; width:70px;">
    <img src="dibujografica4.webp" style="height:100px; width:140px; margin-right:255px">    <h1 style="font:medium; padding:20px;">   Visualización de gráficas     </h1>  
    <img src="dibujografica5.webp" style="height:100px; width:140px; margin-left:185px;"><img src="dibujografica2.webp" style="height:100px; width:150px;">

</div><br>
      
    <h2>Número de bloqueos en cada actividad realizada</h2>
    <button onclick="toggleGrafica('grafica')">Mostrar/Esconder Gráfica</button>
    <div id="grafica" class="grafica-container">
        <?php
            exec("python /xampp/htdocs/Web_VisualStudio_paraDescargar/Web_VisualStudio/common/estadisticas.py")
        ?>
        <img src="grafica.png" alt="Gráfica de número de bloqueos en cada actividad realizada"style="transform: scale(0.8);">
    </div>

    <h2>Número de bloqueos por minuto en cada actividad realizada</h2>
    <button onclick="toggleGrafica('grafica1')">Mostrar/Esconder Gráfica</button>
    <div id="grafica1" class="grafica-container">
        <img src="grafica1.png" alt="Gráfica de número de bloqueos por minuto en cada actividad realizada"style="transform: scale(0.8);">
    </div>

    <h2>Número de bloqueos por cada 10 pasos en cada actividad realizada</h2>
    <button onclick="toggleGrafica('graficaa2')">Mostrar/Esconder Gráfica</button>
    <div id="graficaa2" class="grafica-container">
    <img src="graficaa2.png" alt="Gráfica de número de bloqueos por cada 10 pasos en cada actividad realizada" style="transform: scale(0.8);">

    </div>
    <h2>Comparación de bloqueos por minuto en actividades realizadas en cada estado</h2>
    <?php
            exec("python /xampp/htdocs/Web_VisualStudio_paraDescargar/Web_VisualStudio/common/intentografdiarios.py 2024-05-20")
        ?>
    <button onclick="toggleGrafica('graficamed1')">Mostrar/Esconder Gráfica</button>
    <div id="graficamed1" class="grafica-container">
        <img src="graficamed1.png" alt="Gráfica comparando bloqueos por minuto en actividades realizadas en cada estado"style="transform: scale(0.8);">
    </div>
    <h2>Gráfica más reciente de toma de medicaciones y estados del paciente</h2>
    <button onclick="toggleGrafica('graficameed')">Mostrar/Esconder Gráfica</button>
    <div id="graficameed" class="grafica-container">
        <img src="graficamed.png" alt="Gráfica más reciente de toma de medicaciones y estados del paciente"style="transform: scale(0.8);">
    </div>
</body>
</html>

