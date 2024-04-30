   
   <style>
        body, html {
            height: 100%;
            margin: 0;
            background: rgb(173, 216, 230);
            font-family: Arial, sans-serif;
        }
        tr.apto {
            background-color: #c7ecc7; /* Verde claro */
        }
        tr.asignado {
            background-color: #D3D3D3; /* Verde claro */
        }
        tr.incompatible {
            background-color: #FFE4B5; /* Amarillo claro pastel */
            color: #333; /* Texto oscuro para mejor contraste */
        }

        /* Estilo para filas con anestesia no apta o fecha caducada */
        tr.no-apto {
            background-color: #FFB6C1; /* Rosa claro pastel */
            color: #333; /* Texto oscuro para mejor contraste */
        }
        tr.fuera{
            background-color: whitesmoke;
            color: #333;
        }

        .welcome-message {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .content {
            text-align: center;
            width: 95%;
            top: 50%;
            overflow: auto;
            padding:3%;
        }

        .tabla-actividades {
            background-color: #fff;
            padding: 20px;
            margin: 20px auto; /* Centra el recuadro */
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: auto; /* Ancho automático basado en el contenido */
            max-width: 80%; /* Máximo ancho permitido */
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, .05);
        }

        .table {
            margin: auto; /* Centra la tabla dentro del recuadro */
            max-width: 100%; /* Máximo ancho de la tabla */
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
            position: sticky;
        }

        button[type="submit"]:hover {
            background-color: #D2B4DE;
        }
        /* Estilos para el desplegable */
        .dropbtn {
            margin: 10px;
            padding: 10px 20px;
            border: none;
            background-color: #79c3f5;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .dropdown {
            position: flex;
            display: inline-block;
        }

        .dropdown-content {
            margin: 10px;
            padding: 10px 20px;
            border: 1px lightgray;
            background-color: #B1E4F7;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .dropdown-container {
            position: relative;
            display: inline-block;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #CDE7F1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: #D2B4DE;
        }
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
            width: 40%;
            border-collapse: collapse;
            margin-left: 30%;
            margin-right: 30%;
            background-color: #D8BFD8;
        }

        th, td {
            border: 1px solid #dddddd; /* Añadir bordes a las celdas */
            padding: 8px;
            text-align: left;
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
            display: inline-block; /* Mostrar los formularios en línea */
            border-right: 5px solid #6DA4B9; /* Línea vertical de separación */
            border-top:5px solid #6DA4B9;
            border-left:5px solid #6DA4B9;
            border-bottom:5px solid #6DA4B9;
            padding-right: 5px;
            padding-left:5px;
            background-color: #D1EBF5;
        }


    </style>
<form action="procesardiario.php" method="POST">
    <input type="hidden" name="fecha" value="<?php echo $fecha; ?>">
    <table>
        <thead>
            <tr>
                <th>Horas</th>
                <th>ON</th>
                <th>OFF</th>
                <th>Toma de medicación</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Crear filas para las 24 horas del día
            for ($i = 0; $i < 24; $i++) {
                echo "<tr>";
                // Columna de horas
                echo "<td>$i:00 - " . ($i + 1) . ":00</td>";
                // Columna ON
                echo "<td><input type='checkbox' name='data[$i][on]'></td>";
                // Columna OFF
                echo "<td><input type='checkbox' name='data[$i][off]'></td>";
                // Columna de toma de medicación
                echo "<td><input type='text' name='data[$i][medication]'></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <button type="submit">Guardar</button>
</form>
