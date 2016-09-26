<?php 	
	//Abro la conexion con la base
	$conexion= mysqli_connect("localhost", "root", "", "preguntados") or die ("Problemas con la con la base de datos");

	//defino la consulta
	$query = 'select * from respuestas';

	//ejecuto la consulta y obtengo el resultado del select
	$registros = mysqli_query($conexion, $query) or die("Problemas en el select:".mysqli_error($conexion));	
		
	echo ' <a href = "respuestas-form.php" > Crear nueva respuesta </a>
		<table border = 1>
		<tr>
			<th> id </th>
			<th>idPregunta </th>
			<th> Respuesta </th>
			<th> Correcta </th>		
			<th> Accion </th>					
		</tr>
	
	';
	

	//recorroel resultado obtenido y lo muestro por pantalla
	
	
	while ($reg= mysqli_fetch_array($registros))
	{
			
		echo ' 
			<tr> 
				<td>'.$reg['id'].'</td>
				<td>'.$reg['idpregunta'].' </td>
				<td>'.$reg['respuesta'].' </td>
				<td>'.$reg['correcta'].'</td>
				<td>
					<a href= "/preguntados/respuestas-form.php?id='.$reg['id'].'&action=editar">Editar</a>
					<a href= "/preguntados/controller/respuestasController.php?id='.$reg['id'].'&action=eliminar">Eliminar</a>
				</td>
			</tr>
		';	
	}
	echo '</table>';

//cierro la conexion
	mysqli_close($conexion); 