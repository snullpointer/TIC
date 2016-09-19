<?php

include_once ($_SERVER["DOCUMENT_ROOT"] . '/preguntados/dao/dbconfig.php');
include_once ($_SERVER["DOCUMENT_ROOT"] . '/preguntados/model/personaInteres.php');

final class PersonaInteresDao {
	public static function Insertar($personaInteres) {
		$query = "INSERT INTO personas_intereses (
										IdUsuario, IdInteres										
										)
									VALUES (						
										" . $personaInteres->idUsuario . " ,	
										" . $personaInteres->idInteres . " ,										
										)";				
				
		mysqli_query(getConnection(),$query) or die(mysqli_error(getConnection()));		
		
		mysqli_close(getConnection());
		return mysqli_insert_id(getConnection());
	}// insert
	
	public static function Actualizar($personaInteres) {

		$query = "UPDATE personas_intereses SET 
			IdUsuario = ".addslashes($personaInteres->idUsuario)." ,	
			IdInteres = ".addslashes($personaInteres->idInteres)."			
			WHERE Id = ".$personaInteres->id;
		
		$result = mysqli_query(getConnection(),$query) or die(mysql_error());

		mysqli_close(getConnection());
	}// update
	
	public static function ObtenerPorId($id){
		$query = "SELECT * FROM intereses WHERE Id = ".$id;
		$rs = mysqli_query(getConnection(),$query) or die(mysqli_error(getConnection()));
		mysqli_close(getConnection());
		return InteresDao::setEntity($rs, false);
	}		
	
	public static function Eliminar($id) {
		$query = "DELETE FROM personas_intereses WHERE Id = " . $id;		
		mysqli_query(getConnection(),$query) or die(mysqli_error(getConnection()));
		mysqli_close(getConnection());
		
		return true;
	}// delete
	
	public static function ObtenerTodos(){
		$query="SELECT * FROM personas_intereses";
		$result = mysqli_query(getConnection(),$query) or die(mysqli_error(getConnection()));
		
		mysqli_close(getConnection());
		
		return PersonaInteresDao::setEntity($result, true);
	}//listar todos	

	public static function setEntity($rs, $list){
		$result = array();
		$personaInteres = null;
		$count = 0;
		
		while ($row = mysqli_fetch_array($rs)) {
			$personaInteres = new personaInteres();
			$personaInteres->id = $row['Id'];
			$personaInteres->idUsuario = $row['IdUsuario'];		
			$personaInteres->idInteres = $row['IdInteres'];			

			$result[$count] = $personaInteres;
			$count++;
		}

		if ($list) {
			return $result;
		} else {
			return $personaInteres;
		}			
	}
};
?>