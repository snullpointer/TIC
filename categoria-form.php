<?php
	
	
		include_once ($_SERVER["DOCUMENT_ROOT"] . '/preguntados/dao/CategoriaDao.php');
	
	$id = isset($_GET['id']) ? $_GET['id'] : 0;	
	
	if($id>0){
		$accion = 'editar';
		
		$categoria = CategoriaDao::ObtenerPorId($id);
	}else{
		$accion = 'agregar';
		$categoria = new Categoria();
	}
?>
<form action = "/preguntados/controller/categoriaController.php" method="post">
	<input type= "hidden" name="accion" id= "accion" value = "<?php echo $accion; ?>" />
	<input type= "hidden" name="id" id= "id" value = "<?php echo $id ?>" />
	<label>Nombre:</label>
	<input type = "text" id="nombre" name= "nombre" value="<?php echo $categoria->nombre; ?>" />
	<input type = "submit" value= "Guardar categoria"/>
	<a href= "categorias-listado.php">Volver </a>
</form>	