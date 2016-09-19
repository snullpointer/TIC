<?php


include_once ($_SERVER["DOCUMENT_ROOT"] . '/preguntados/dao/dbconfig.php');
include_once ($_SERVER["DOCUMENT_ROOT"] . '/preguntados/model/pregunta.php');
include_once ($_SERVER["DOCUMENT_ROOT"] . '/preguntados/dao/RespuestaDao.php');

final class PreguntaDao {
	public static function Insertar($pregunta) {
		$query = "INSERT INTO preguntas (
										nombre, idcategoria										
										)
									VALUES (						
										'" . $pregunta->nombre . "' , 
											".$pregunta->idcategoria."
										)";				
				
		mysqli_query(getConnection(),$query) or die(mysqli_error(getConnection()));		
		
		mysqli_close(getConnection());
		return mysqli_insert_id(getConnection());
	}// insert
	
	public static function Actualizar($pregunta) {

		$query = "UPDATE preguntas SET 
			nombre = '".addslashes($pregunta->nombre)."',
			idcategoria= ".$pregunta->idcategoria."
			WHERE id = ".$pregunta->id;
		
		$result = mysqli_query(getConnection(),$query) or die(mysql_error());

		mysqli_close(getConnection());
	}// update
	
	public static function ObtenerPorId($id){
		$query = "SELECT * FROM preguntas WHERE id = ".$id;
		$rs = mysqli_query(getConnection(),$query) or die(mysqli_error(getConnection()));
		mysqli_close(getConnection());
		return PreguntaDao::setEntity($rs, false);
	}		
	
	public static function Eliminar($id) {
		$query = "DELETE FROM preguntas WHERE id = " . $id;		
		mysqli_query(getConnection(),$query) or die(mysqli_error(getConnection()));
		mysqli_close(getConnection());
		
		return true;
	}// delete
	
	public static function ObtenerTodos(){
		$query="SELECT * FROM preguntas";
		$result = mysqli_query(getConnection(),$query) or die(mysqli_error(getConnection()));
		
		mysqli_close(getConnection());
		
		return PreguntaDao::setEntity($result, true);
	}//listar todos	

	public static function setEntity($rs, $list){
		$result = array();
		$pregunta = null;
		$count = 0;
		
		while ($row = mysqli_fetch_array($rs)) {
			$pregunta = new pregunta();
			$pregunta->id = $row['id'];
			$pregunta->nombre = $row['nombre'];												
			$pregunta->idcategoria= $row['idcategoria'];
			
			$result[$count] = $pregunta;
			$count++;
		}

		if ($list) {
			return $result;
		} else {
			return $pregunta;
		}			
	}
	
	public static function ObtenerRespuestasPregunta($IdPregunta)
	{
		$query= "SELECT * FROM respuestas where idpregunta =".$IdPregunta;
		$resultado= mysqli_query(getConnection(),$query) or die(mysqli_error(getConnection()));
		mysql_close(getConnection());
		return RespuestaDao::setEntity($resultado, true);		
	}
	
	public static function ActualizarRespuestasPregunta($IdPregunta , $boolean)
	{
		$resul= PreguntaDao::ObtenerRespuestasPregunta($IdPregunta);
		$resps= $resul.count();
		if($boolean){$resps= $resps++;}
		else{$resps= $resps--;}
		
	$query="UPDATE preguntas SET cantidadRespuestas=".$resps." WHERE id = ".$IdPregunta;
		$resultado= mysqli_query(getConnection(),$query) or die(mysqli_error(getConection()));
		mysql_close(getConection());
	}
};
?>