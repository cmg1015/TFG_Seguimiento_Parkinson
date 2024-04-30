<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario Interactivo</title>
        
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5; /* Fondo en morado clarito */
            display: flex;
            flex-direction: column; /* Alinea los elementos en columna */
            height: 100%; /* Ajusta la altura para centrar */
        }
        table {
            width: auto;
            border-collapse: collapse;
            background-color: lavender; /* Color de fondo del calendario */
            max-width: 80%; /* Ancho máximo de la tabla */
        }
        th, td {
            font-size: xx-large;
            padding: 35px;
            text-align: center;
            border: 2px solid #574063; /* Borde gris claro */
            width: 80px; /* Tamaño fijo de las celdas */
            height: 10px; /* Tamaño fijo de las celdas */
        }
        th {
            background-color: #D094F0; /* Encabezado de columna en gris más oscuro */
        }
        td a {
            text-decoration: none;
            color: black;
            display: block;
        }
        td a:hover {
            background-color: whitesmoke; /* Cambio de color al pasar el ratón sobre un día */
        }
        .month-nav {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .nav-container {
            display: flex;
            align-items: center;
        }
    </style>

</head>
<body>
<?php
    include '../paciente/menu.php'; // Incluye el menú
?>

<br>
<br>
<div class='month-nav'>
    <?php
    // Obtener el año y el mes actual
    $year = isset($_GET['year']) ? $_GET['year'] : date("Y");
    $month = isset($_GET['month']) ? $_GET['month'] : date("n");

    // Obtener el primer día del mes
    $first_day = mktime(0, 0, 0, $month, 1, $year);

    // Obtener el número de días en el mes
    $days_in_month = date("t", $first_day);

    // Obtener el día de la semana del primer día del mes
    $day_of_week = date("w", $first_day);

    // Array para los nombres de los meses
    $months = [
        1 => "Enero", 2 => "Febrero", 3 => "Marzo", 4 => "Abril",
        5 => "Mayo", 6 => "Junio", 7 => "Julio", 8 => "Agosto",
        9 => "Septiembre", 10 => "Octubre", 11 => "Noviembre", 12 => "Diciembre"
    ];
    ?>
    <div class="nav-container" style="margin-left: 25%">
        <a href='?rol=<?php echo $rol;?>&id_usuario=<?php echo $id_usuario; ?>&year=<?php echo ($month == 1 ? $year - 1 : $year) ?>&month=<?php echo ($month == 1 ? 12 : $month - 1) ?>'>&lt; Anterior</a>
        <a style="font-size: x-large; font-weight: bold; margin-left: 300px; margin-right:300px;"><?php echo $months[$month] . " $year"; ?></a>
        <a href='?rol=<?php echo $rol;?>&id_usuario=<?php echo $id_usuario; ?>&year=<?php echo ($month == 12 ? $year + 1 : $year) ?>&month=<?php echo ($month == 12 ? 1 : $month + 1) ?>'>Siguiente &gt;</a>
    </div>
</div>

<table style="margin-left: 10%;">
    <tr><th style="font-size:20px">Domingo</th><th style="font-size:20px">Lunes</th><th style="font-size:20px">Martes</th><th style="font-size:20px">Miércoles</th><th style="font-size:20px">Jueves</th><th style="font-size:20px">Viernes</th><th style="font-size:20px">Sábado</th></tr>
    <?php
    // Rellenar los espacios en blanco hasta llegar al primer día del mes
    echo "<tr>";
    for ($i = 0; $i < $day_of_week; $i++) {
        echo "<td></td>";
    }

    // Mostrar los días del mes
    for ($day = 1; $day <= $days_in_month; $day++) {
        // Obtener la fecha en formato "dia-mes-año"
        $date = str_pad($day, 2, "0", STR_PAD_LEFT) . "-" . str_pad($month, 2, "0", STR_PAD_LEFT) . "-$year";

        // Generar el enlace con la fecha como parámetro
        echo "<td><a href='diario.php?fecha_actual=$date'>$day</a></td>";
        // Avanzar al siguiente día de la semana
        if (++$day_of_week == 7) {
            echo "</tr><tr>";
            $day_of_week = 0;
        }
    }

    // Rellenar los últimos espacios en blanco
    while ($day_of_week < 7) {
        echo "<td></td>";
        $day_of_week++;
    }

    echo "</tr>";
    ?>
</table>

</body>
</html>