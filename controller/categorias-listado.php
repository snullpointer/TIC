<?php 	
	//Abro la conexion con la base
	$conexion= mysqli_connect("localhost", "root", "", "preguntados") or die ("Problemas con la con la base de datos");

	//defino la consulta
	$query = 'select * from categorias';

	//ejecuto la consulta y obtengo el resultado del select
	$registros = mysqli_query($conexion, $query) or die("Problemas en el select:".mysqli_error($conexion));	
		
	echo ' <a href = "categoria-form.php" > Crear nueva categoria </a>
		<table border = 1>
		<tr>
			<th> id </th>
			<th>nombre </th>
			<th>Acciones </th>			
		</tr>
	
	';
	

	
	
	
	//recorroel resultado obtenido y lo muestro por pantalla
	
	
	while ($reg= mysqli_fetch_array($registros))
	{
		echo ' 
			<tr> 
				<td>'.$reg['id'].'</td>
				<td>'.$reg['categorias'].' </td>
				<td>
					<a href= "/preguntados/controller/categoriaController.php?id='.$reg['id'].'&action=editar"> Editar  </a>
					<a href= "/preguntados/controller/categoriaController.php?id='.$reg['id'].'&action=eliminar"> Eliminar </a>
				</td>
			</tr>
		';	
	}
	echo '</table>';

//cierro la conexion
	mysqli_close($conexion); 	