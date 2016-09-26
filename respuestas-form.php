<?php
	$id = isset($_GET['id']) ? $_GET ['id']: 0;
	$accion = isset($_GET['action']) ? $_GET ['action']: 0;
	$idpregunta = "";
	$respuesta = "";
	$correcta=0;
		
	if (accion == "editar")
	{
		$accion = 'editar';
		//Abro la conexion con la base
		$conexion= mysqli_connect("localhost", "root", "", "preguntados") or die ("Problemas con la con la base de datos");		
		$query = "select * from respuestas WHERE id=" .$id;
		
		$registros = mysqli_query($conexion, $query) or die("Problemas en el select:".mysqli_error($conexion));	
		
		while ($reg= mysqli_fetch_array($registros))
		{
			$idpregunta = $reg['idpregunta'];	
			$respuesta = $reg['respuesta'];
			$correcta= $reg['correcta'];
		}
		
		mysqli_close($conexion); 	
	} 
	else {
		$accion = 'agregar';
	}
	
?>

<form action = "/preguntados/controller/respuestasController.php" method="post">
	<input type= "hidden" name="action" id= "action" value = "<?php echo $accion; ?>" />
	<input type= "hidden" name="id" id= "id" value = "<?php echo $id ?>" />
	<label>idPregunta:</label>
	<input type = "text" id="idPregunta" name= "idPregunta" value="<?php echo $id; ?>" />
	<br> <br>
	<label>Respuesta:</label>
	<input type = "text" id="respuesta" name= "respuesta" value="<?php echo $respuesta; ?>" />
	
	<label>Correcta:</label>
	<select name="Rcorrecta" id="Rcorrecta">
		<option value= 1> Si</option>
		<option value= 2> No</option>
	</select>
	
	
	<br> <br>
	<input type = "submit" value= "Guardar respuesta"/>
	<br> <br>
	<a href= "respuestas-listado.php">Volver </a>
</form>	