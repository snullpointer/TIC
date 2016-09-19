<?php

include_once ($_SERVER["DOCUMENT_ROOT"] . '/preguntados/dao/dbconfig.php');
include_once ($_SERVER["DOCUMENT_ROOT"] . '/preguntados/model/interes.php');


final class InteresDao {
	public static function Insertar($interes) {
		$query = "INSERT INTO intereses (
										nombre										
										)
									VALUES (						
										'" . $interes->nombre . "'										
										)";				
				
		mysqli_query(getConnection(),$query) or die(mysqli_error(getConnection()));		
		
		mysqli_close(getConnection());
		return mysqli_insert_id(getConnection());
	}// insert
	
	public static function Actualizar($interes) {

		$query = "UPDATE intereses SET 
			nombre = '".addslashes($interes->nombre)."'			
			WHERE id = ".$interes->id;
		
		$result = mysqli_query(getConnection(),$query) or die(mysql_error());

		mysqli_close(getConnection());
	}// update
	
	public static function ObtenerPorId($id){
		$query = "SELECT * FROM intereses WHERE id = ".$id;
		$rs = mysqli_query(getConnection(),$query) or die(mysqli_error(getConnection()));
		mysqli_close(getConnection());
		return InteresDao::setEntity($rs, false);
	}		
	
	public static function Eliminar($id) {
		$query = "DELETE FROM intereses WHERE id = " . $id;		
		mysqli_query(getConnection(),$query) or die(mysqli_error(getConnection()));
		mysqli_close(getConnection());
		
		return true;
	}// delete
	
	public static function ObtenerTodos(){
		$query="SELECT * FROM intereses";
		$result = mysqli_query(getConnection(),$query) or die(mysqli_error(getConnection()));
		
		mysqli_close(getConnection());
		
		return InteresDao::setEntity($result, true);
	}//listar todos	

	public static function setEntity($rs, $list){
		$result = array();
		$interes = null;
		$count = 0;
		
		while ($row = mysqli_fetch_array($rs)) {
			$interes = new interes();
			$interes->id = $row['id'];
			$interes->nombre = $row['nombre'];												

			$result[$count] = $interes;
			$count++;
		}

		if ($list) {
			return $result;
		} else {
			return $interes;
		}			
	}
};
?>