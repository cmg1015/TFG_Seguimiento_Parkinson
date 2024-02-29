import socket
import os
import sys
print(sys.path)
import json
import matplotlib.pyplot as plt
from IPython.display import display, clear_output
import time
import mysql
import mysql.connector


script_directory = os.path.dirname(os.path.realpath(__file__))

# Construir la ruta completa al archivo JSON
json_file_path = os.path.join(script_directory, 'id_paciente.json')
# Leer el ID del paciente desde el archivo JSON
with open(json_file_path) as file:
    data = json.load(file)
    id_paciente = data.get('id_paciente', 0)
# Ahora id_paciente contiene el valor leído desde el archivo JSON
print(id_paciente)

json_file_path1 = os.path.join(script_directory, 'actividades.json')
# Leer el ID del paciente desde el archivo JSON
with open(json_file_path1) as file:
    data = json.load(file)
    actividades = data.get('actividades', 0)
# Ahora id_paciente contiene el valor leído desde el archivo JSON
print(actividades)


# Configuración de la conexión a MySQL
config = {
    'user': 'root',
    'password': '',
    'host': 'localhost',
    'database': 'webparkinson',
    'raise_on_warnings': True
}

# Crear una conexión
conn = mysql.connector.connect(**config)
# Verificar conexión
if conn.is_connected():
    print("Conexión exitosa.")
else:
    print("Conexión fallida.")

actividades1 = []

bloqueos=[]
nactividades=[]
bloqueosporminuto=[]
duracion=[]
bloqueosporpasos=[]
# Variables para estadísticas
totalBloqueos = 0
totalVelocidadMedia = 0
totalPasos = 0
totalDuracion = 0
contadorActividades = 0
# Consulta SQL para obtener las actividades del paciente
sql = "SELECT * FROM actividades WHERE id_paciente = %s"
params = (id_paciente,)

cursor = conn.cursor(dictionary=True)  # Devolver resultados como diccionarios

cursor.execute(sql, params)

resultados = cursor.fetchall()
for row in resultados:
    actividades1.append(row)
    bloqueos.append(row['numero_bloqueos'])
    nactividades.append(row['id_actividad'])
    duracion.append(row['duracion'])
    totalBloqueos += row['numero_bloqueos']
    totalVelocidadMedia += row['velocidad_media']
    totalPasos += row['numero_pasos']
    totalDuracion += row['duracion']
    contadorActividades += 1
    if row['duracion'] !=0:
        bloqueosporminuto.append(row['numero_bloqueos'] / row['duracion'])
    else:
        bloqueosporminuto.append(0)
    if row['numero_pasos']!=0:
        bloqueosporpasos.append((row['numero_bloqueos']*10)/row['numero_pasos'])
    else:
        bloqueosporpasos.append(0)
print("actividades 2", actividades1,nactividades,bloqueos)
plt.plot(nactividades, bloqueos, color='blue', linestyle='-')

# Etiquetas y título
plt.xlabel('Id de actividad')
plt.ylabel('Número de Bloqueos')
plt.title('Número de Bloqueos en cada actividad realizada')
plt.xticks(range(1, max(nactividades) + 1))
plt.yticks(range(1, max(bloqueos) + 1))
directorio_actual = os.path.dirname(os.path.realpath(__file__))

# Guardar la gráfica en el directorio actual como una imagen (por ejemplo, en formato PNG)
plt.savefig(os.path.join(directorio_actual, 'grafica.png'))

plt.clf()
plt.plot(nactividades,bloqueosporminuto , color='blue', linestyle='-')

# Etiquetas y título
plt.xlabel('Id de actividad')
plt.ylabel('Número de Bloqueos por minuto')
plt.xticks(range(1, max(nactividades) + 1))
plt.title('Número de Bloqueos por minuto en cada actividad realizada')

tamaño_texto = 7

# Iterar sobre los datos y agregar texto con fondo
for x, y in zip(nactividades, bloqueosporminuto):
    # Agregar texto con fondo
    plt.text(x, y, f'{y:.2f}', ha='center', va='bottom', color='red', fontsize=tamaño_texto,
             bbox=dict(facecolor='white', alpha=1, edgecolor='blue', boxstyle='round,pad=0.3'))



directorio_actual = os.path.dirname(os.path.realpath(__file__))

# Guardar la gráfica en el directorio actual como una imagen (por ejemplo, en formato PNG)
plt.savefig(os.path.join(directorio_actual, 'grafica1.png'))


plt.clf()
plt.plot(nactividades,bloqueosporpasos , color='blue', linestyle='-')

# Etiquetas y título
plt.xlabel('Id de actividad')
plt.ylabel('Número de Bloqueos por pasos')
plt.xticks(range(1, max(nactividades) + 1))
plt.title('Número de Bloqueos por cada 10 pasos en cada actividad realizada')

tamaño_texto = 7

# Iterar sobre los datos y agregar texto con fondo
for x, y in zip(nactividades, bloqueosporpasos):
    # Agregar texto con fondo
    plt.text(x, y, f'{y:.2f}', ha='center', va='bottom', color='red', fontsize=tamaño_texto,
             bbox=dict(facecolor='white', alpha=1, edgecolor='blue', boxstyle='round,pad=0.3'))



directorio_actual = os.path.dirname(os.path.realpath(__file__))

# Guardar la gráfica en el directorio actual como una imagen (por ejemplo, en formato PNG)
plt.savefig(os.path.join(directorio_actual, 'grafica2.png'))
# Mostrar la gráfica
# Cerrar el cursor y la conexión
cursor.close()
conn.close()
