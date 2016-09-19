<?php

	include_once ($_SERVER["DOCUMENT_ROOT"] . '/preguntados/dao/InteresDao.php');
	echo '
	<a href="intereses-form.php">Crear nuevo interes</a><br/><br/>
	<table border="1">
		<tr>
			<th>Id</th>
			<th>Nombre</th>
			<th>Acciones</th>
		</tr>
	';
	
	$intereses = InteresDao::ObtenerTodos();
	
	foreach($intereses as $item){
		echo '
			<tr>
				<td>'.$item->id.'</td>
				<td>'.$item->nombre.'</td>
				<td>
					<a href="/preguntados/intereses-form.php?id='.$item->id.'">Editar</a>
					<a href="/preguntados/controller/interesesController.php?id='.$item->id.'&accion=eliminar">Eliminar</a>
				</td>
			</tr>
		';
	}	
	
	echo '</table>';			
?>