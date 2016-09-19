<?php

	include_once ($_SERVER["DOCUMENT_ROOT"] . '/preguntados/dao/PreguntaDao.php');
	include_once ($_SERVER["DOCUMENT_ROOT"] . '/preguntados/model/pregunta.php');
	include_once ($_SERVER["DOCUMENT_ROOT"] . '/preguntados/dao/CategoriaDao.php');
	
	$id = isset($_GET['id']) ? $_GET ['id']: 0;
	$nombre = "";
	$idcateg = 0;
		
		
	if($id>0){
		$accion = 'editar';
		
		$pregunta = PreguntaDao::ObtenerPorId($id);
	}else{
		$accion = 'agregar';
		$pregunta = new pregunta();
	}
?>

<form action = "/preguntados/controller/preguntasController.php" method="post">
	<input type= "hidden" name="accion" id= "accion" value = "<?php echo $accion; ?>" />
	<input type= "hidden" name="id" id= "id" value = "<?php echo $id ?>" />
	<label>Nombre:</label>
	<input type = "text" id="nombre" name= "nombre" value="<?php echo $pregunta->nombre ; ?>" />
	<br> <br>
	<label>Categoria:</label>
	<select id="idcategoria" name="idcategoria">
	<?php	
	$categorias =CategoriaDao::ObtenerTodos();	
    ?>

	<?php foreach($categorias as $cat){ ?>
		<option value = "<?php echo $cat->id; ?>" <?php echo ($cat->id==$pregunta->idcategoria ? 'selected' : '') ?>> <?php echo $cat->nombre; ?> </option>	
	<?php } ?>
	</select>
	<br> <br>
	<input type = "submit" value= "Guardar pregunta"/>
	<br> <br>
	<a href= "preguntas-listado.php">Volver </a>
</form>	



