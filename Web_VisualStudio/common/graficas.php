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
            exec("python /xampp/htdocs/Web_VisualStudio_paraDescargar/Web_VisualStudio/common/estadisticas.py")
        ?>
        <img src="grafica.png" alt="Gráfica de número de bloqueos en cada actividad realizada">
    </div>

    <h2>Gráfica de número de bloqueos por minuto en cada actividad realizada</h2>
    <button onclick="toggleGrafica('grafica1')">Mostrar/Esconder Gráfica</button>
    <div id="grafica1" class="grafica-container">
        <img src="grafica1.png" alt="Gráfica de número de bloqueos por minuto en cada actividad realizada">
    </div>

    <h2>Gráfica de número de bloqueos por cada 10 pasos en cada actividad realizada</h2>
    <button onclick="toggleGrafica('grafica2')">Mostrar/Esconder Gráfica</button>
    <div id="grafica2" class="grafica-container">
        <img src="grafica2.png" alt="Gráfica de número de bloqueos por cada 10 pasos en cada actividad realizada">
    </div>
</body>
</html>

