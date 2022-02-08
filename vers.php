<?php include_once('layouts/header_ver.php'); ?>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
	<br>

  <h2>LISTADO DE MEJORAS EN LA VERSIÓN</h2>            
  <table class="table table-striped">
	<tr>
		<th>MÓDULO</th>
		<th>ACTUACIÓN</th>
		<th>FECHA</th>
	</tr>

	<tr>
		<td>home.php</td>
		<td>Mejorado el aspecto y hecho más atractivo</td>
		<td>22/04/2020</td>
	</tr>

	<tr>
		<td>footer.php</td>
		<td>Incluido el nombre de los programadores y enlace a página de versiones.</td>
		<td>22/04/2020</td>
	</tr>

	<tr>
		<td>add_tipo_incidencia.php</td>
		<td>Fallo en texto arreglado.</td>
		<td>22/04/2020</td>
	</tr>

	<tr>
		<td>header.php</td>
		<td>Incluido un enlace al home en el logo y arreglado la hora.</td>
		<td>23/04/2020</td>
	</tr>

	<tr>
		<td>usuarios.php</td>
		<td>Arreglado fallo de la última conexión.</td>
		<td>23/04/2020</td>
	</tr>

	<tr>
		<td>edit_grupo.php</td>
		<td>Incluido una descripción del nivel para aclarar el grupo.</td>
		<td>3/05/2020</td>
	</tr>

	<tr>
		<td>add_grupo.php</td>
		<td>Añadir un minimo al nivel del grupo y arreglado el fallo al redireccionar.</td>
		<td>3/05/2020</td>
	</tr>
	
	<tr>
		<td>tarea.php</td>
		<td>Añadido un botón para poder eliminar tareas.</td>
		<td>11/05/2020</td>
	</tr>
	<tr>
		<td>incidencia.php</td>
		<td>Añadido comportamientos a los botones de técnicos y estados para estar desabilitados en caso de que se cumplas ciertas condiciones (que no haya tecnico asignado para el de estado y que no haya ningún tecnico registrado en la aplicación para el de técnico) además de que el botón de estado estará en rojo si las tareas asignadas no están todas finalizadas y verde si la están.</td>
		<td>25/05/2020</td>
	</tr>
        
    <tr>
		<td>add_incidencia.php</td>
		<td>Al crear la incidencia envia un correo al profesor que la haya generado.</td>
		<td>28/05/2020</td>
	</tr>
	
	<tr>
		<td>incidencia.php</td>
		<td>Modificado la tabla de incidencias para que aparezcan si existen TODAS las tareas y estado de las mismas asociadas a una incidencia.</td>
		<td>28/05/2020</td>
	</tr>
	
	<tr>
		<td>tarea.php</td>
		<td>Cuando una tarea ha finalizado, no aparece en la columna fecha final, la fecha de finalización.</td>
		<td>28/05/2020</td>
	</tr>
	
	<tr>
		<td>importa_profesorado.php</td>
		<td>Carga automática de usuarios por fichero excel.</td>
		<td>30/05/2020</td>
	</tr>
	
	<tr>
		<td>edit_usuario.php</td>
		<td>Cuando se cambia la contraseña, se envía un correo al usuario.</td>
		<td>1/06/2020</td>
	</tr>
	
	<tr>
		<td>enviar_info.php</td>
		<td>Envía un correo al usuario seleccionado con todas las incidencias propuestas por dicho usuario.</td>
		<td>03/06/2020</td>
	</tr>
	
	<tr>
		<td>asigna_estado.php</td>
		<td>Al establecer una incidencia como finalizada se envía un correo automáticamente al profesor que la haya creado con las tareas que se han llevado acabo.</td>
		<td>03/06/2020</td>
	</tr>
	
	<tr>
		<td>incidencia.php</td>
		<td>Añadido un botón para poder eliminar incidencias si tiene todas las tareas acabadas.</td>
		<td>03/06/2020</td>
	</tr>
	
	<tr>
		<td>lista_usuarios.php</td>
		<td>Lista TODOS los usuarios de nivel 1 (profesorado) con el objeto de la impresión. (Privilegios: SuperUsuario(0). Gestor TIC(2)). Aparece en la opción de utilidades.</td>
		<td>04/06/2020</td>
	</tr>
	
	
</table>
</body>
</html>
<?php include_once('layouts/footer_ver.php'); ?>
