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
        body, html {
            height: 100%;
            margin: 0;
            background: rgb(173, 216, 230);
            font-family: Arial, sans-serif;
        }

        .welcome-message {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .content {
            text-align: center;
            top: 50%;
            overflow: auto;
            padding:3%;
        }


        .table {
            margin: auto; /* Centra la tabla dentro del recuadro */
            max-width: 100%; /* Máximo ancho de la tabla */
        }

        button[type="submit"]  {
            margin-left: 47%;
            margin-top:2%;
            padding: 10px 20px;
            border: none;
            background-color: #79c3f5;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            display: center;
        }

        button[type="submit"]:hover {
            background-color: #D2B4DE;
            display: center;
        }
        /* Estilos para el desplegable */

        .contenedor {
            background-color: #fff;
            padding: 200px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: auto;
            max-width: 90%; /* Ajustar según sea necesario */
            margin: 20px; /* Margen superior e inferior de 20px y centrado horizontal */
            overflow: auto; /* Añadir scroll si el contenido excede el tamaño del contenedor */
        }

        table {
            width: 50%;
            border-collapse: collapse;
            background-color: #D8BFD8;
            padding-right: 15px;
            padding-left:15px;
        }

        th, td {
            border: 1px solid #dddddd; /* Añadir bordes a las celdas */
            text-align: center;
            padding-top: 5px ;
            padding-bottom: 5px;
        }

        th {
            background-color: #f2f2f2;
        }
        .fa-pencil {
            display: inline; /* Ocultar el ícono de lápiz inicialmente */
        }
        .tabla-container {
            overflow-x: auto; /* Barra de desplazamiento horizontal */
            max-width: 95%; /* Máximo ancho del contenedor */
            margin: 0 auto; /* Centrado horizontal */
            margin-bottom: 20px; /* Margen inferior */
        }

        .form-container {
            padding-top: 50;
            padding-right: 100px;
            padding-left:100px;
            display: flex;
        }
        .left-half {
            text-align: left;
            justify-self: left;
        }
        
        .right-half {
            text-align: right;
        }
        td input[type="checkbox"] {
            width:100%;
            height: 100%;
        }

    </style>
    </head>
<body>
<?php

$fecha = date('d-m-Y');
?>
    <?php
            include '../paciente/menu.php'; // Incluye el menú
    ?>
    <br>
<form action="procesardiario.php?fecha=<?php echo $fecha; ?>" method="POST">
    <input type="hidden" name="fecha" value="<?php echo $fecha; ?>">
    <div class="form-container">
    <table>
                <thead>
                    <tr>
                        <th>Horas</th>
                        <th>Durmiendo</th>
                        <th>OFF</th>
                        <th>ON</th>
                        <th>ON con discinesia</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Crear filas para las horas hasta las 16:00
                    for ($i = 7; $i <= 15; $i++) {
                        echo "<tr>";
                        // Columna de horas
                        echo "<td>$i:00 - " . ($i) . ":30</td>";
                        echo "<td><input type='checkbox' name='data[$i][dormido]' onclick='uncheckOther(this)'></td>";
                        echo "<td><input type='checkbox' name='data[$i][off]' onclick='uncheckOther(this)'></td>";
                        // Columna OFF
                        echo "<td><input type='checkbox' name='data[$i][on]' onclick='uncheckOther(this)'></td>";
                        // Columna de toma de medicación
                        echo "<td><input type='checkbox' name='data[$i][ondis]' onclick='uncheckOther(this)'></td>";
                        echo "</tr>";

                        // Media hora después
                        echo "<tr>";
                        // Columna de horas
                        echo "<td>$i:30 - " . ($i + 1) . ":00</td>";
                        // Columna ON
                        echo "<td><input type='checkbox' name='data[$i.5][dormido]' onclick='uncheckOther(this)'></td>";
                        echo "<td><input type='checkbox' name='data[$i.5][off]' onclick='uncheckOther(this)'></td>";
                        // Columna OFF
                        echo "<td><input type='checkbox' name='data[$i.5][on]' onclick='uncheckOther(this)'></td>";
                        // Columna de toma de medicación
                        echo "<td><input type='checkbox' name='data[$i.5][ondis]' onclick='uncheckOther(this)'></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>


            <table style="margin-left: 40px;">
                <thead>
                    <tr>
                        <th>Horas</th>
                        <th>Durmiendo</th>
                        <th>OFF</th>
                        <th>ON</th>
                        <th>ON con discinesia</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Crear filas para las horas después de las 16:00
                    for ($i = 16; $i < 24; $i++) {
                        echo "<tr>";
                        // Columna de horas
                        echo "<td>$i:00 - " . ($i) . ":30</td>";
                        // Columna ON
                        echo "<td><input type='checkbox' name='data[$i][dormido]' onclick='uncheckOther(this)'></td>";
                        echo "<td><input type='checkbox' name='data[$i][off]' onclick='uncheckOther(this)'></td>";
                        // Columna OFF
                        echo "<td><input type='checkbox' name='data[$i][on]' onclick='uncheckOther(this)'></td>";
                        // Columna de toma de medicación
                        echo "<td><input type='checkbox' name='data[$i][ondis]' onclick='uncheckOther(this)'></td>";
                        echo "</tr>";

                        // Media hora después
                        echo "<tr>";
                        // Columna de horas
                        echo "<td>$i:30 - " . ($i + 1) . ":00</td>";
                        // Columna ON
                        echo "<td><input type='checkbox' name='data[$i.5][dormido]' onclick='uncheckOther(this)'></td>";
                        echo "<td><input type='checkbox' name='data[$i.5][off]' onclick='uncheckOther(this)'></td>";
                        // Columna OFF
                        echo "<td><input type='checkbox' name='data[$i.5][on]' onclick='uncheckOther(this)'></td>";
                        // Columna de toma de medicación
                        echo "<td><input type='checkbox' name='data[$i.5][ondis]' onclick='uncheckOther(this)'></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
    </div>
    <button type="submit">Guardar</button>
</form>
<script>
    function uncheckOther(checkbox) {
        // Obtener la fila actual
        var currentRow = checkbox.parentNode.parentNode;

        // Desmarcar otros checkboxes en la misma fila
        var checkboxes = currentRow.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(function(cb) {
            if (cb !== checkbox) {
                cb.checked = false;
            }
        });
    }
</script>
</body>
</html>