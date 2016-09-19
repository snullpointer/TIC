<?php


include_once ($_SERVER["DOCUMENT_ROOT"] . '/preguntados/dao/dbconfig.php');
include_once ($_SERVER["DOCUMENT_ROOT"] . '/preguntados/model/respuesta.php');

final class RespuestaDao {
	public static function Insertar($respuesta) {
		$query = "INSERT INTO respuestas (
										idpregunta, respuesta, correcta									
										)
									VALUES (						
										'" . $respuesta->idpregunta . "' , 
											'" . $respuesta->respuesta . "' , 
											'" . $respuesta->correcta . "' 
											
										)";				
				
		mysqli_query(getConnection(),$query) or die(mysqli_error(getConnection()));		
		
		mysqli_close(getConnection());
		return mysqli_insert_id(getConnection());
	}// insert
	
	public static function Actualizar($respuesta) {

		$query = "UPDATE respuestas SET 
			idpregunta = '".addslashes($respuesta->idpregunta)."',
			respuesta= '".addslashes($respuesta->respuesta)."',
			correcta= '".addslashes($respuesta->correcta)."',
			WHERE id = ".$respuesta->id;
		
		$result = mysqli_query(getConnection(),$query) or die(mysql_error());

		mysqli_close(getConnection());
	}// update
	
	public static function ObtenerPorId($id){
		$query = "SELECT * FROM respuestas WHERE id = ".$id;
		$rs = mysqli_query(getConnection(),$query) or die(mysqli_error(getConnection()));
		mysqli_close(getConnection());
		return RespuestaDao::setEntity($rs, false);
	}		
	
	public static function Eliminar($id) {
		$query = "DELETE FROM respuestas WHERE id = " . $id;		
		mysqli_query(getConnection(),$query) or die(mysqli_error(getConnection()));
		mysqli_close(getConnection());
		
		return true;
	}// delete
	
	public static function ObtenerTodos(){
		$query="SELECT * FROM respuestas";
		$result = mysqli_query(getConnection(),$query) or die(mysqli_error(getConnection()));
		
		mysqli_close(getConnection());
		
		return RespuestaDao::setEntity($result, true);
	}//listar todos	

	public static function setEntity($rs, $list){
		$result = array();
		$respuesta = null;
		$count = 0;
		
		while ($row = mysqli_fetch_array($rs)) {
			$respuesta = new respuesta();
			$respuesta->id = $row['id'];
			$respuesta->idpregunta = $row['idpregunta'];												
			$respuesta->respuesta= $row['respuesta'];
			$respuesta->correcta= $row['correcta'];
			
			$result[$count] = $respuesta;
			$count++;
		}

		if ($list) {
			return $result;
		} else {
			return $pregunta;
		}			
	}
	

};
?>