<?php 
// Establecer una cookie para el ID del paciente antes de cualquier salida HTML
if (isset($_GET['id_paciente'])) {
    setcookie('id_paciente', $_GET['id_paciente'], time() + 86400, "/"); // La cookie expira en 1 día
}
?>
<!DOCTYPE html>
<html lang="es" dir="ltr" xml:lang="es" xmlns="http://www.w3.org/1999/xhtml" class="responsive">
<head>
    <meta charset="UTF-8">
    <title>Página de Inicio</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <?php
    
        // Verifica si la sesión ya está iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        };

        if ($_SESSION['user_type'] == 'paciente') {
            $userId = $_SESSION['user_id'];
        } elseif ($_SESSION['user_type'] == 'profesional') {
            // Obtener el ID del paciente desde la cookie
            $userId = isset($_GET['id_paciente']) ? $_GET['id_paciente'] : 0;
        }
        echo "<script type='text/javascript'>\n";
        echo "var userType = '" . $_SESSION['user_type'] . "';\n";
        echo "var userId = '" . $userId . "';\n"; // Usar userId basado en el tipo de usuario
        echo "</script>\n";

    ?>

    <script>
            let estadoActividad = 'esperando'; // Almacena el estado de la actividad (si se está realizando o no)
            function quitarbloqueo(){
                databloqueo=200;
                sendDato(databloqueo);
            }

            function actualizarEstado() {
                fetch('http://localhost:3000/actividad')
                    .then(response => response.json())
                    .then(data => {
                        //document.getElementById('estadoActividad').innerText = data.estado;
                        actividadIniciada = data.estado;
                        actualizarDatosRecuadro();
                    });
            }
            
            function sendCommand(command) {
                fetch('http://localhost:3000/command', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json',},
                    body: JSON.stringify({ command: command }),
                })
                .then(response => response.text())
                .then(data => {
                    console.log(data); // Confirmación de envío del comando
                    estadoActividad = command === '1' ? 'iniciada' : 'finalizada';
                    actualizarDatosRecuadro(); // Actualizar el estado después de enviar el comando
                });
            }

            function sendDato(databloqueo) {
                fetch('http://localhost:3000/data', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json',},
                    body: JSON.stringify({ databloqueo: databloqueo }),
                })
                .then(response => response.text())
                .then(data => {
                    console.log(data); // Confirmación de envío del comando
                });
            }

            function getArduinoData() {
                fetch('http://localhost:3000/datos')
                    .then(response => response.json())
                    .then(data => {
                        actualizarDatosRecuadro(data);
                    });
            } 
            function finalizar(){
                fetch('http://localhost:3000/datos')
                    .then(response => response.json())
                    .then(data => {
                        finalizarYConfirmarPersonalizacion(data);
                    });
            }
            function finalizarYConfirmarPersonalizacion(data) {
                try {
                    dato = ((data.actividadMin * 60) / data.Ptotal) * 2;
                    if (dato<=2.5){
                        if (dato<=1.5){
                            databloqueo=100;
                            datoreal=1;
                        }else{
                            databloqueo=21;
                            datoreal=2;
                        }
                    }else if (dato<20){
                        databloqueo=Math.round(dato);
                        datoreal=Math.round(dato);
                    }else{
                        databloqueo=20;
                        datoreal=20;
                    }

                    //let databloqueo = (dato <= 5) ? '2' : '1';
                    //let htmlContent = `<p>Datobloqueo: ${databloqueo} </p>`;

                    sendDato(databloqueo);


                } catch (error) {
                    console.error("Error:", error);
                }
                setTimeout(function() {
                    confirmarAccion('finalizarPersonalizacion'); // Mostrar mensaje de confirmación después de un corto retraso
                }, 2000);

                sendCommand('0'); // Enviar comando para finalizar la actividad


            }
            function actualizarDatosRecuadro(data) {
                let htmlContent = "";
                dato = (((data.actividadMin * 60) / data.Ptotal) * 2);
                if (dato<=2.5){
                        if (dato<=1.5){
                            datoreal=1;
                        }else{
                            datoreal=2;
                        }
                }else if (dato<20){
                        datoreal=Math.round(dato);
                }else{
                        datoreal=20;
                }
                if (data.izquierda) {
                    // Mostrar mensaje parpadeante
                    htmlContent = "<p class='parpadeante'>IZQUIERDA</p>";
                } else if (estadoActividad === 'iniciada') {
                    // Mostrar datos de actividad en curso
                    htmlContent = 
                        `<p>Pasos: ${data.contP}</p>
                        <p>Tiempo: ${data.tiempo}</p>
                        <p>Velocidad: ${data.velocidad}</p>`;
                        if (data.contP > 10) {
                        htmlContent += `<button onclick="finalizar()">Finalizar personalización</button>`;
                    }
                } else if (estadoActividad === 'finalizada') {
                    // Mostrar datos al finalizar la actividad
                    //Surstituir data.actividadMin por data['tiempo']*60/data.tiempo*60
                    htmlContent = 
                        `<p>Bloqueos: ${data.bloqueos}</p>
                        <p>Total de Pasos: ${data.Ptotal}</p>
                        <p>Actividad (min): ${data.actividadMin}</p>
                        <p>Velocidad Media: ${data.velocidadMedia}</p>
                        <p>El nuevo tiempo de bloqueo será: ${datoreal} segundos</p> `;
                        if (data.Ptotal> 10) {
                        htmlContent += `<button onclick="finalizar()">Finalizar personalización</button>`;
                    }
                } else {
                    htmlContent = "<p>Esperando a iniciar actividad</p>";
                }
                document.getElementById('datosActividad').innerHTML = htmlContent;
            }

            setInterval(getArduinoData, 1000); // Actualiza los datos cada segundo
            setInterval(actualizarEstado, 1000); // Actualiza el estado de la actividad cada segundo
            //setInterval(boton(data),1000);



        </script>
        <script src="../js/confirmacion.js" onerror="alert('Error al cargar confirmacion.js');"></script>
        <style>
            html, body {
                height: 100%;
                margin: 0;
                background: linear-gradient(135deg, rgba(174, 214, 241, 0.3), rgba(250, 219, 216, 0.3), rgba(245, 183, 177, 0.3), rgba(210, 180, 222, 0.3));
                background-blend-mode: overlay;
                font-family: Arial, sans-serif;
            }

            .content {
                text-align: center;
                position: absolute;
                width: 100%;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }

            .welcome-message {
                color: #333;
                font-size: 24px;
                margin-bottom: 20px;
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
            }

            button[type="submit"]:hover {
                background-color: #D2B4DE;
            }

            .info-actividad {
                background-color: #fff;
                padding: 20px;
                margin: 20px auto; /* Centra el recuadro */
                max-width: 400px; /* Ancho máximo */
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                text-align: center; /* Centra el texto */
            }

            .parpadeante {
                animation: parpadeo 1s infinite;
            }

            @keyframes parpadeo {  
                50% { opacity: 0; }
            }

        </style>

</head>
        <body>

            <div class="content">
            <div class="welcome-message">Actividad en Tiempo Real </div>
                <div id="arduinoMessage" class="info-actividad">
                    <div id="datosActividad">
                    </div>
                </div>
                <?php
                $id_paciente = isset($_GET['id_paciente']) ? $_GET['id_paciente'] : '';
                if ($_SESSION['user_type'] == 'paciente') {
                    echo '<button type="submit" onclick="location.href=\'../paciente/inicioPaciente.php\'">Menú Principal</button>';
                } elseif ($_SESSION['user_type'] == 'profesional') {
                    echo '<button type="submit" onclick="location.href=\'../profesional/inicioProfesional.php\'">Menú Pacientes</button>';
                }
                ?>
                <button type="submit" onclick="sendCommand('1');quitarbloqueo()">Iniciar Actividad</button>
            </div>

        </body>