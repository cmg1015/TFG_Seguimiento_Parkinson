from reportlab.lib.pagesizes import letter
from reportlab.platypus import SimpleDocTemplate, Paragraph, Spacer, PageBreak, Table
from reportlab.lib.styles import getSampleStyleSheet
from tkinter import filedialog
import tkinter as tk
from urllib.request import urlretrieve
from reportlab.pdfgen import canvas
from io import BytesIO
#import pydoc
import os
import json
import mysql
from mysql import connector
from reportlab.lib.pagesizes import letter
from reportlab.lib import colors
from reportlab.platypus import SimpleDocTemplate, Table, TableStyle, Image



script_directory = os.path.dirname(os.path.realpath(__file__))

# Construir la ruta completa al archivo JSON
json_file_path = os.path.join(script_directory, 'id_paciente.json')
# Leer el ID del paciente desde el archivo JSON
with open(json_file_path) as file:
    data = json.load(file)
    id_paciente = data.get('id_paciente', 0)
# Ahora id_paciente contiene el valor leído desde el archivo JSON
print(id_paciente)

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

sql= "SELECT * FROM usuarios WHERE id_usuario= %s"
params=(id_paciente,)
cursor = conn.cursor(dictionary=True)  # Devolver resultados como diccionarios

cursor.execute(sql, params)

datosusuario = cursor.fetchall()
for row in datosusuario:
    nombre = row['nombre']
    apellidos = row['apellidos']
    correoelectronico= row['correo_electronico']
    idusuario=row['id_usuario']

sql ="SELECT * FROM pacientes WHERE id_paciente = %s"
params=(id_paciente,)
cursor = conn.cursor(dictionary=True)  # Devolver resultados como diccionarios

cursor.execute(sql, params)
datosusuario1 = cursor.fetchall()
for row in datosusuario1:
    sexo=row['sexo']

datos_paciente = {
    "Nombre": nombre,
    "Apellidos": apellidos,
    "Sexo": sexo,
    "Correo electrónico": correoelectronico,
    "Id usuario": idusuario
}



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
print(contadorActividades)
# Crear el objeto PDF
pdf_file = "Informe_Medico.pdf"
ruta_guardado = os.path.join(os.getcwd(), pdf_file)
doc = SimpleDocTemplate(pdf_file, pagesize=letter)


# Establecer el estilo del documento
styles = getSampleStyleSheet()
normal_style = styles["Normal"]
titulo_style = styles["Title"]

# Modificar el estilo para justificar el texto
normal_style.alignment = 0
titulo_style.alignment = 0

# Crear el contenido del PDF
contenido = []

# Encabezado del informe
titulo = Paragraph("Informe Médico", titulo_style)
contenido.append(titulo)
contenido.append(Spacer(1, 12))

contenido.append(Paragraph("Datos del Paciente:", normal_style))
contenido.append(Spacer(1, 6))


estilo_tabla = TableStyle([
    ('BACKGROUND', (0, 0), (-1, 0), colors.powderblue),
    ('TEXTCOLOR', (0, 0), (-1, 0), colors.black),
    ('ALIGN', (0, 0), (-1, -1), 'CENTER'),
    ('FONTNAME', (0, 0), (-1, 0), 'Helvetica-Bold'),
    ('BOTTOMPADDING', (0, 0), (-1, 0), 12),
    ('BACKGROUND', (0, 1), (-1, -1), colors.whitesmoke),
    ('GRID', (0, 0), (-1, -1), 1, colors.black),
    ('MAXWIDTH', (0, 0), (-1, -1), 30), 
    ('COLWIDTH', (0, 0), (-1, -1), 10),  
])

encabezados2 = list(datos_paciente.keys())
valores2 = list(datos_paciente[clave]for clave in encabezados2)
valores2 = [str(valor) for valor in valores2]
print (valores2)
tablapacientesfinal=[encabezados2]+ [valores2]
tabla2=Table(tablapacientesfinal)
print(tabla2)
tabla2.setStyle(estilo_tabla)
contenido.append(tabla2)
contenido.append(Spacer(1, 6))


if contadorActividades>0:
    mediaBloqueos=round(totalBloqueos/contadorActividades,2)
    mediaVelocidadMedia=round(totalVelocidadMedia/contadorActividades,2)
    mediaPasos=round(totalPasos/contadorActividades,2)
    mediaDuracion=round(totalDuracion/contadorActividades,2)
else:
    mediaBloqueos=0
    mediaVelocidadMedia=0
    mediaPasos=0
    mediaDuracion=0

encabezados1=['Total de actividades', 'Media de bloqueos', 'Velocidad media', 'Media de pasos', 'Media de duración']
lista=[contadorActividades, mediaBloqueos,mediaVelocidadMedia, mediaPasos,mediaDuracion]
tabla_datos1 = [lista]
tabla_final1=[encabezados1]+ tabla_datos1
tabla1=Table(tabla_final1)
tabla1.setStyle(estilo_tabla)
contenido.append(tabla1)
contenido.append(Spacer(1, 6))

# Encabezados de las columnas
encabezados = ['id_actividad', 'id_paciente', 'numero_bloqueos', 'velocidad_media', 'numero_pasos', 'duracion']

# Crear la tabla a partir de los datos
tabla_datos = [[row[col] for col in encabezados] for row in actividades1]

# Agregar encabezados a la tabla
tabla_final = [encabezados] + tabla_datos

# Crear la tabla
tabla = Table(tabla_final)


tabla.setStyle(estilo_tabla)
contenido.append(tabla)
contenido.append(Spacer(1, 6))
# Datos del paciente


contenido.append(Spacer(1, 6))
# Datos del paciente
imagen = Image('/xampp/htdocs/Web_VisualStudio_paraDescargar/Web_VisualStudio/common/grafica.png', width=450, height=300)
contenido.append(imagen)
imagen1 = Image('/xampp/htdocs/Web_VisualStudio_paraDescargar/Web_VisualStudio/common/grafica1.png', width=450, height=300)
contenido.append(imagen1)
imagen2 = Image('/xampp/htdocs/Web_VisualStudio_paraDescargar/Web_VisualStudio/common/grafica2.png', width=450, height=300)
contenido.append(imagen2)


doc.build(contenido)
