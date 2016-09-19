<?php
	$id = isset($_GET['id']) ? $_GET ['id']: 0;
	$nombre = "";
	
	
	if ($id>0)
	{
		$accion = 'editar';
		//Abro la conexion con la base
		$conexion= mysqli_connect("localhost", "root", "", "preguntados") or die ("Problemas con la con la base de datos");
		
		$query = "select * from categorias WHERE id=" .$id;
		
	} 
		else {
				$accion = 'agregar';
		}
	
?>

<form action = "categoriaController.php" method="post">
	<input type= "hidden" name="action" id= "accion" value = "<?php echo $accion ?>" />
	<input type= "hidden" name="id" id= "id" value = "<?php echo $id ?>" />
	<label>Nombre:</label>
	<input type = "text" id="nombre" name= "nombre"/>
	<input type = "submit" value= "Guardar categoria"/>
	<a href= "categoria-listado.php">Volver </a>
</form>	