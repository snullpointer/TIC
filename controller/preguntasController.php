<?php
		
include_once ($_SERVER["DOCUMENT_ROOT"] . '/preguntados/dao/PreguntaDao.php');

$accion =isset($_POST["accion"]) ? $_POST["accion"] : $_GET["accion"];
$nombreObt= isset ($_POST["nombre"]) ? ($_POST["nombre"]) :"";
$idcategoriaObt = isset ($_POST["idcategoria"]) ? ($_POST["idcategoria"]) :"";

switch ($accion)
{
	case 'agregar':			
			$pregunta = new pregunta();
			$pregunta->nombre = $_POST['nombre'];
			$pregunta->idcategoria= $_POST['idcategoria'];
			$id = PreguntaDao::Insertar($pregunta);
			$redireccion = "/preguntados/respuestas-form.php?idpregunta=" . $id;
			break;
			
		case 'eliminar':						
			PreguntaDao::Eliminar($_GET['id']);
			$redireccion = "Location: /preguntados/preguntas-listado.php";
			break;
			
		case 'editar':			
			$pregunta = PreguntaDao::ObtenerPorId($_POST['id']);
			$pregunta->nombre = $_POST['nombre'];
			$pregunta->idcategoria= $_POST['idcategoria'];
			PreguntaDao::Actualizar($pregunta);
			$redireccion = "Location: /preguntados/preguntas-listado.php";
			break;		
}

header("Location: " . $redireccion);
?>