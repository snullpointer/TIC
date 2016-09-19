<?php

	
	include_once ($_SERVER["DOCUMENT_ROOT"] . '/preguntados/dao/InteresDao.php');
	
	$id = isset($_GET['id']) ? $_GET['id'] : 0;	
	
	if($id>0){
		$accion = 'editar';
		
		$interes = InteresDao::ObtenerPorId($id);
	}else{
		$accion = 'agregar';
		$interes = new Interes();
	}
?>

<form action = "/preguntados/controller/interesesController.php" method="post">
	<input type= "hidden" name="accion" id= "accion" value = "<?php echo $accion; ?>" />
	<input type= "hidden" name="id" id= "id" value = "<?php echo $id ?>" />
	<label>Nombre:</label>
	<input type = "text" id="nombre" name= "nombre" value="<?php echo $interes->nombre; ?>" />
	<input type = "submit" value= "Guardar interes"/>
	<a href= "intereses-listado.php">Volver </a>
</form>	