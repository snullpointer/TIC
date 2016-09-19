<?php


include_once ($_SERVER["DOCUMENT_ROOT"] . '/preguntados/dao/dbconfig.php');
include_once ($_SERVER["DOCUMENT_ROOT"] . '/preguntados/model/persona.php');


final class PersonaDao {
	public static function Insertar($persona) {
		$query = "INSERT INTO personas (
										nombre, apellido, email, fecha_nacimiento, password, sexo			
										)
									VALUES (						
										'" .$persona->nombre . "'	,		
										'".$persona->apellido."'	,
										'".$persona->email."'	,		
										".$persona->nacimiento."	,						
										'".$persona->contraseña."'	,	
										".$persona->sexo."	,										
										)";				
				
		mysqli_query(getConnection(),$query) or die(mysqli_error(getConnection()));		
		
		mysqli_close(getConnection());
		return mysqli_insert_id(getConnection());
	}// insert
	
	public static function Actualizar($persona) {

		$query = "UPDATE personas SET 
			nombre = '".addslashes($persona->nombre)."' , 
			apellido = '".addslashes($persona->apellido)."' , 
			email = '".addslashes($persona->email)."' , 
			fecha_nacimiento = ".addslashes($persona->nacimiento)." , 
			password = '".addslashes($persona->contraseña)."' , 
			sexo = ".addslashes($persona->sexo)." , 
			WHERE id = ".$persona->id;
		
		$result = mysqli_query(getConnection(),$query) or die(mysql_error());

		mysqli_close(getConnection());
	}// update
	
	public static function ObtenerPorId($id){
		$query = "SELECT * FROM personas WHERE id = ".$id;
		$rs = mysqli_query(getConnection(),$query) or die(mysqli_error(getConnection()));
		mysqli_close(getConnection());
		return PersonaDao::setEntity($rs, false);
	}		
	
	public static function Eliminar($id) {
		$query = "DELETE FROM personas WHERE id = " . $id;		
		mysqli_query(getConnection(),$query) or die(mysqli_error(getConnection()));
		mysqli_close(getConnection());
		
		return true;
	}// delete
	
	public static function ObtenerTodos(){
		$query="SELECT * FROM personas";
		$result = mysqli_query(getConnection(),$query) or die(mysqli_error(getConnection()));
		
		mysqli_close(getConnection());
		
		return PersonaDao::setEntity($result, true);
	}//listar todos	

	public static function setEntity($rs, $list){
		$result = array();
		$persona = null;
		$count = 0;
		
		while ($row = mysqli_fetch_array($rs)) {
			$persona = new Persona();
			$persona->id = $row['id'];
			$persona->nombre = $row['nombre'];	
			$persona->apellido = $row['apellido'];
			$persona->email= $row['email'];
			$persona->nacimiento= $row['fecha_nacimiento'];			
			$persona->contraseña= $row['password'];
			$persona->sexo= $row['sexo'];
						
			$result[$count] = $persona;
			$count++;
		}

		if ($list) {
			return $result;
		} else {
			return $persona;
		}			
	}
};
?>