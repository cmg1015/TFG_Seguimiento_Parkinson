<?php
session_start();
// Conexión a la base de datos
$servername = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "webparkinson";
$conn = new mysqli($servername, $db_username, $db_password, $db_name);


    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $actividades = [];
    $id_paciente = 0;

    if ($_SESSION['user_type'] == 'paciente') {
        $id_paciente = $_SESSION['user_id'];
        include '../paciente/menu.php'; // Incluye el menú
    } elseif ($_SESSION['user_type'] == 'profesional') {
        if (isset($_GET['id_paciente']) && is_numeric($_GET['id_paciente'])) {
            $id_paciente = $_GET['id_paciente'];
        }
        include '../profesional/menu.php'; // Incluye el menú
    }



    // Consulta SQL para obtener las actividades del paciente
    $sql = "SELECT * FROM actividades WHERE id_paciente = $id_paciente";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $actividades[] = $row;
            $idactividad[]=$row['id_actividad'];
            $totalBloqueos[]= $row['numero_bloqueos'];
            //$totalVelocidadMedia += $row['velocidad_media'];
            //$totalPasos += $row['numero_pasos'];
            //$totalDuracion += $row['duracion'];
            //$contadorActividades++;
        }
    }
    //print_r($totalBloqueos);
    $tb=json_encode($totalBloqueos);
    $ia=json_encode($idactividad);
    
    // Convertir las cadenas JSON a arrays de PHP
    $lista1 = json_decode($tb, true);
    $lista2 = json_decode($ia, true);

    // Imprimir las listas resultantes
    print_r($lista1);
    print_r($lista2);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Gráfica de Barras</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="myChart" width="400" height="400"></canvas>

    <script>
        // Utilizar los datos obtenidos en la consulta
        var data = <?php echo json_encode($data); ?>;
        var labels = data.map(function(item) {
            return item.categoria;
        });
        var values = data.map(function(item) {
            return item.cantidad;
        });

        // Crear la gráfica
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Cantidad',
                    data: values,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
