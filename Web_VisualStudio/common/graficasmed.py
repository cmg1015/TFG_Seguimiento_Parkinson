import pandas as pd
import matplotlib.pyplot as plt
from sqlalchemy import create_engine
import os

# Datos de conexión a la base de datos
db_user = 'root'
db_password = ''
db_host = 'localhost'
db_name = 'webparkinson'

# Crear la cadena de conexión
connection_string = f'mysql+pymysql://{db_user}:{db_password}@{db_host}/{db_name}'
engine = create_engine(connection_string)

# Leer las tablas
query_tabla1 = "SELECT * FROM diario"
query_tabla2 = "SELECT * FROM actividades"
tabla1 = pd.read_sql(query_tabla1, engine)
tabla2 = pd.read_sql(query_tabla2, engine)




tabla1['datetime'] = pd.to_datetime(tabla1['fecha']) + pd.to_timedelta(tabla1['hora'].astype(str))
tabla2['datetime'] = pd.to_datetime(tabla2['fecha']) + pd.to_timedelta(tabla2['hora'].astype(str))


# Función para determinar si una actividad está en estado on o off
def determinar_estado(hora_actividad, estados):
    for _, row in estados.iterrows():
        inicio_on = row['datetime']
        fin_on = inicio_on + pd.Timedelta(minutes=30)
        if inicio_on <= hora_actividad < fin_on:
            if row['off_status']==1:
                return 'off'
            elif row['on_status']==1:
                return 'on'
            elif row['ondis_status']==1:
                return 'on con discinesia'
    return 'noespecifica'

# Crear una columna de estado en tabla2
tabla2['estado'] = tabla2.apply(lambda row: determinar_estado(row['datetime'], tabla1), axis=1)
print(tabla1)
print(tabla2)
# Filtrar las actividades en estados on y off
actividades_on = tabla2[tabla2['estado'] == 'on']
actividades_off = tabla2[tabla2['estado'] == 'off']
actividades_ondis =tabla2[tabla2['estado'] == 'on con discinesia']

# Calcular bloqueos/minuto
if actividades_on['numero_bloqueos'].sum() ==0:
    bloqueos_on_minuto =0
else:
    bloqueos_on_minuto = actividades_on['numero_bloqueos'].sum() / actividades_on['duracion'].sum() 
if actividades_off['numero_bloqueos'].sum() ==0:
    bloqueos_off_minuto =0
else:
    bloqueos_off_minuto = actividades_off['numero_bloqueos'].sum() / actividades_off['duracion'].sum() 
if actividades_ondis['numero_bloqueos'].sum() ==0:
    bloqueos_ondis_minuto =0
else:
    bloqueos_ondis_minuto = actividades_ondis['numero_bloqueos'].sum() / actividades_ondis['duracion'].sum() 
# Crear la gráfica de barras
labels = ['On','On discinesia', 'Off']
bloqueos_minuto = [bloqueos_on_minuto,  bloqueos_ondis_minuto, bloqueos_off_minuto]

plt.bar(labels, bloqueos_minuto, color=['green', 'red'])
plt.xlabel('Estado')
plt.ylabel('Bloqueos por Minuto')
plt.title('Comparación de Bloqueos/Minuto en Estados On, On con discinesia y Off')
directorio_actual = os.path.dirname(os.path.realpath(__file__))

# Guardar la gráfica en el directorio actual como una imagen (por ejemplo, en formato PNG)
plt.savefig(os.path.join(directorio_actual, 'graficamed1.png'))
#plt.show()
