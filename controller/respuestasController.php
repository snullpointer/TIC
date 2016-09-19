<?php
//abro conexion
include_once ($_SERVER["DOCUMENT_ROOT"] . '/preguntados/dao/PreguntaDao.php');
$conexion=mysqli_connect("localhost","root","","preguntados") or 
die("Problemas con la conexión");

$accion =isset($_POST["action"]) ? $_POST["action"] : $_GET["action"];
$idPreguntaObt= isset ($_POST["idPregunta"]) ? ($_POST["idPregunta"]) :"";
$respuestaObt = isset ($_POST["respuesta"]) ? ($_POST["respuesta"]) :"";
$correctaObt=isset ($_POST["Rcorrecta"]) ? ($_POST["Rcorrecta"]) :"";
switch ($accion)
{
	case "agregar":
		$query="INSERT INTO respuestas (idpregunta, respuesta, correcta) VALUES ('" . $idPreguntaObt. "' , '".$respuestaObt."' , ".$correctaObt." )";
		mysqli_query($conexion,$query) or die("Problemas en el insert: ".mysqli_error($conexion));
		mysqli_close($conexion);
		//actualizar la cant de respuestas de una preguntados
		PreguntaDao::ActualizarRespuestasPregunta($idPreguntaObt , true);
		
		break;
		
	case "eliminar":	
		$idObtenido= isset ($_GET["id"]) ? ($_GET["id"]) : "";
		$query= "DELETE FROM respuestas WHERE id=" . $idObtenido;
		mysqli_query($conexion,$query) or die("Problemas en el delete: ".mysqli_error($conexion));
		mysqli_close($conexion);
		PreguntaDao::ActualizarRespuestasPregunta($idPreguntaObt , false);
		//restar la cant de respuestas 
		
		break;
	
	case "editar":	
		$idObtenido= isset ($_POST["id"]) ? ($_POST["id"]) : "";
		$query = "UPDATE preguntas SET nombre = '" .$nombreObt. "' , idcategoria = ".$idcategoriaObt." WHERE id="  .$idObtenido;				
		mysqli_query($conexion,$query) or die("Problemas en el editar: ".mysqli_error($conexion));
		break;
	
	
	
}
mysqli_close($conexion);
header("location:/preguntados/preguntas-listado.php");
?>