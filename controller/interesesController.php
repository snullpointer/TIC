<?php
	
		include_once ($_SERVER["DOCUMENT_ROOT"] . '/preguntados/dao/InteresDao.php');
	
	$accion = isset($_POST['accion']) ? $_POST['accion'] : $_GET['accion'];

	switch($accion){
		case 'agregar':			
			$interes = new Interes();
			$interes->nombre = $_POST['nombre'];
			
			InteresDao::Insertar($interes);
			
			break;
		case 'eliminar':						
			
			InteresDao::Eliminar($_GET['id']);
			
			break;
			
		case 'editar':			
			$interes = InteresDao::ObtenerPorId($_POST['id']);
			$interes->nombre = $_POST['nombre'];
			
			InteresDao::Actualizar($interes);
			
			break;
	}	
	
	header("Location: /preguntados/intereses-listado.php");
?>

