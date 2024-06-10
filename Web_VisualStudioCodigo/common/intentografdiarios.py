import pandas as pd
import matplotlib.pyplot as plt
from sqlalchemy import create_engine
import sys
#import pymysql
from datetime import datetime
import os
# Obtener la fecha pasada del argumento de línea de comandos
if len(sys.argv) < 2:
    print("Por favor, proporciona la fecha pasada como argumento en formato YYYY-MM-DD.")
    sys.exit(1)

fechapasada = sys.argv[1]
try:
    # Convertir la cadena a un objeto de fecha
    fechapasada = datetime.strptime(fechapasada, '%Y-%m-%d').date()
except ValueError:
    print("La fecha pasada no está en el formato correcto (YYYY-MM-DD).")
    sys.exit(1)
print(fechapasada)
print(type(fechapasada))
# Función para mapear los estados a números
def mapear_estado_a_numero(on, off, ondis, dormido):
    if on == 1:
        return 0
    elif ondis == 1:
        return 1
    elif off == 1:
        return 2
    elif dormido == 1:
        return 3
    else:
        return None  # Manejo de casos no contemplados
    
def pasar_a_lista(hora_1, hora_2, hora_3, hora_4, hora_5):
    horas = [hora_1, hora_2, hora_3, hora_4, hora_5]
    formatted_times = []
    
    for hora in horas:
        if isinstance(hora, pd.Timedelta):
            # Si es Timedelta, lo convertimos a string y tomamos los últimos 8 caracteres ('HH:MM:SS')
            formatted_time = str(hora)[-8:-3]
        else:
            # Si es datetime.time, lo formateamos usando strftime
            formatted_time = hora.strftime('%H:%M')
        formatted_times.append(formatted_time)
    
    return formatted_times


db_user = 'root'
db_password = ''
db_host = 'localhost'
db_name = 'webparkinson'

# Crear la cadena de conexión
connection_string = f'mysql+pymysql://{db_user}:{db_password}@{db_host}/{db_name}'
engine = create_engine(connection_string)

# Paso 2: Consulta SQL para combinar los datos de ambas tablas
query = """
    SELECT t2.fecha, t2.hora, t2.on_status, t2.off_status, t2.ondis_status, t2.durmiendo
    FROM diario t2
    WHERE fecha = %s"""

# Ejecutar la consulta SQL con la fecha pasada como parámetro
datos = pd.read_sql_query(query, engine, params=[(fechapasada,)])

# Paso 4: Mapear los estados a números
datos['estado_numero'] = datos.apply(lambda row: mapear_estado_a_numero(row['on_status'], row['off_status'], row['ondis_status'], row['durmiendo']), axis=1)

# Paso 5: Generar la gráfica
fig, ax = plt.subplots()

query2= """ SELECT * FROM diario2 WHERE fecha = %s"""
datos2 = pd.read_sql_query(query2, engine, params=[(fechapasada,)])


datos2['horas'] = datos2.apply(lambda row: pasar_a_lista(row['hora_1'], row['hora_2'], row['hora_3'], row['hora_4'], row['hora_5']), axis=1)

for fecha, datos_fecha in datos.groupby('fecha'):
    ax.plot(datos_fecha['estado_numero'], label='Estado', marker='o')

    ax.set_title(f'Estado del paciente el {fecha}')
ax.set_xlabel('Hora del día')
ax.set_ylabel('Estado')
ax.legend()

fig.set_size_inches(10, 6)

ax.set_xticks(range(0, 34))
ax.set_xticklabels(['7:00', '7:30', '8:00', '8:30', '9:00', '9:30', '10:00', '10:30', '11:00', '11:30', '12:00', '12:30', '13:00', '13:30', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30', '18:00', '18:30', '19:00', '19:30', '20:00', '20:30', '21:00', '21:30', '22:00', '22:30', '23:00', '23:30'], rotation=45)

ax.set_yticks(range(4))
ax.set_yticklabels(['On', 'On discinesia', 'Off', 'Durmiendo'])

# Agregar líneas horizontales en las tomas coincidentes
horas_tomas = ['hora_1', 'hora_2', 'hora_3', 'hora_4', 'hora_5']
horas2 = ['07:00', '07:30', '08:00', '08:30', '09:00', '09:30', '10:00', '10:30', '11:00', '11:30', '12:00', '12:30', '13:00', '13:30', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30', '18:00', '18:30', '19:00', '19:30', '20:00', '20:30', '21:00', '21:30', '22:00', '22:30', '23:00', '23:30']
print(datos)
print(datos2)
for index, row in datos2.iterrows():
    for hora in row['horas']:
        print(hora)
        if hora in horas2:
            print(hora)
            indice = horas2.index(hora)
            print(indice)

            ax.axvline(x=indice, color='r', linestyle='-')
            ax.text(indice, 0.9, row['medicacion'], transform=ax.get_xaxis_transform(), ha='center', va='top', color='black', fontsize=8, rotation=90, bbox=dict(facecolor='white', edgecolor='none', boxstyle='round,pad=0.3'))

directorio_actual = os.path.dirname(os.path.realpath(__file__))

# Guardar la gráfica en el directorio actual como una imagen (por ejemplo, en formato PNG)
plt.savefig(os.path.join(directorio_actual, 'graficamed.png'))
#plt.show()

# Cerrar la conexión a la base de datos
engine.dispose()
