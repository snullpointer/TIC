<?php
	

	include_once ($_SERVER["DOCUMENT_ROOT"] . '/preguntados/dao/CategoriaDao.php');
	
	echo '
	<a href="categoria-form.php">Crear nueva categoria</a><br/><br/>
	<table border="1">
		<tr>
			<th>Id</th>
			<th>Nombre</th>
			<th>Acciones</th>
		</tr>
	';
	
	$categorias = CategoriaDao::ObtenerTodos();
	
	foreach($categorias as $item){
		echo '
			<tr>
				<td>'.$item->id.'</td>
				<td>'.$item->nombre.'</td>
				<td>
					<a href="/preguntados/categoria-form.php?id='.$item->id.'">Editar</a>
					<a href="/preguntados/controller/categoriaController.php?id='.$item->id.'&accion=eliminar">Eliminar</a>
				</td>
			</tr>
		';
	}	
	
	echo '</table>';			
?>