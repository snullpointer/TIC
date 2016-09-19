<?php

	
	include_once ($_SERVER["DOCUMENT_ROOT"] . '/preguntados/dao/CategoriaDao.php');
	
	$accion = isset($_POST['accion']) ? $_POST['accion'] : $_GET['accion'];

	switch($accion){
		case 'agregar':			
			$categoria = new Categoria();
			$categoria->nombre = $_POST['nombre'];
			
			CategoriaDao::Insertar($categoria);
			
			break;
		case 'eliminar':						
			
			CategoriaDao::Eliminar($_GET['id']);
			
			break;
			
		case 'editar':			
			$categoria = CategoriaDao::ObtenerPorId($_POST['id']);
			$categoria->nombre = $_POST['nombre'];
			
			CategoriaDao::Actualizar($categoria);
			
			break;
	}	
	
	header("Location: /preguntados/categorias-listado.php");
?>