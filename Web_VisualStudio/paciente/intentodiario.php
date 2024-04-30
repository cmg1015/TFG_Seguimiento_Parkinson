<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario de Medicación</title>
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: #f0f0f0; /* Color de fondo */
    }
    .form-container {
      max-width: 600px;
      padding: 20px;
      background-color: lightblue; /* Color de fondo del contenedor de medicación */
      border-radius: 10px; /* Bordes redondeados */
    }
    .medication-container {
      margin-bottom: 20px;
      background-color: lightblue; /* Color de fondo del contenedor de medicación */
      padding: 20px;
      border-radius: 8px; /* Bordes redondeados */
    }
    h1 {
      font-size: 24px;
      margin-bottom: 10px;
    }
    h2 {
      font-size: 15px;
      margin-bottom: 5px;
    }
  </style>
</head>
<body>
  <div id="form-container"></div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
  const formContainer = document.getElementById('form-container');
  let medicationCount = 0; // Contador de medicaciones

  // Función para agregar una nueva medicación al formulario
  function addMedication() {
    medicationCount++; // Incrementar el contador de medicaciones

    const medicationContainer = document.createElement('div');
    medicationContainer.classList.add('medication-container');
    medicationContainer.dataset.medicationId = medicationCount; // Identificador único para la medicación
    medicationContainer.dataset.doseCount = 1; // Inicializar el contador de dosis para esta medicación
    medicationContainer.innerHTML = `
      <h1>Medicación ${medicationCount}</h1>
      <label for="medication-name-${medicationCount}">Nombre de la medicación:</label>
      <input type="text" id="medication-name-${medicationCount}" placeholder="Nombre de la medicación"><br>
      <h2>Toma 1</h2>
      <label for="time-select-take-${medicationCount}-1">Hora de Toma:</label>
      <select class="time-select" id="time-select-take-${medicationCount}-1">
        ${generateHourOptions()}
      </select>
      <label for="time-select-effect-${medicationCount}-1">Principios del Efecto:</label>
      <select class="time-select" id="time-select-effect-${medicationCount}-1">
        ${generateHourOptions()}
      </select><br>
      <label id="dose-count-${medicationCount}" style="display: none;">Tomas: 1</label><br>
      <button class="add-dose">Añadir Toma</button>
      <button class="add-medication">Añadir Medicación</button>
    `;
    formContainer.appendChild(medicationContainer);
  }

  // Función para generar opciones de hora
  function generateHourOptions() {
    let optionsHTML = '<option value="" disabled selected>Seleccionar hora</option>';
    for (let i = 0; i < 24; i++) {
      const hour = i; // Agrega un cero delante si es menor que 10
      optionsHTML += `<option value="${hour}">${hour}:00 - ${hour === 23 ? '00' : hour + 1}:00</option>`;
    }
    return optionsHTML;
  }

  // Función para agregar una nueva toma a una medicación
  function addDose(target) {
    const medicationContainer = target.parentElement;
    const medicationId = medicationContainer.dataset.medicationId;
    const doseCountLabel = medicationContainer.querySelector(`#dose-count-${medicationId}`);
    let doseCount = parseInt(medicationContainer.dataset.doseCount) + 1; // Obtener el contador de tomas y aumentarlo en 1
    medicationContainer.dataset.doseCount = doseCount; // Actualizar el contador de dosis para esta medicación
    doseCountLabel.textContent = `Tomas: ${doseCount}`;

    const doseContainer = document.createElement('div');
    doseContainer.innerHTML = `
      <div>
        <h2>Toma ${doseCount}</h2>
        <label for="time-select-take-${medicationId}-${doseCount}">Hora de Toma:</label>
        <select class="time-select" id="time-select-take-${medicationId}-${doseCount}">
          ${generateHourOptions()}
        </select>
        <label for="time-select-effect-${medicationId}-${doseCount}">Principios del Efecto:</label>
        <select class="time-select" id="time-select-effect-${medicationId}-${doseCount}">
          ${generateHourOptions()}
        </select>
      </div>
    `;

    // Insertar la nueva toma antes de los botones
    medicationContainer.insertBefore(doseContainer, target);
  }

  // Agregar la primera medicación al cargar la página
  addMedication();

  // Agregar event listener para los botones "Añadir Toma" y "Añadir Medicación"
  formContainer.addEventListener('click', function(event) {
    const target = event.target;
    if (target.classList.contains('add-dose')) {
      addDose(target);
    } else if (target.classList.contains('add-medication')) {
      addMedication();
    }
  });
});

  </script>
</body>
</html>

