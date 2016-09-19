<?php


include_once ($_SERVER["DOCUMENT_ROOT"] . '/preguntados/dao/dbconfig.php');
include_once ($_SERVER["DOCUMENT_ROOT"] . '/preguntados/model/categoria.php');

final class CategoriaDao {
	public static function Insertar($categoria) {
		$query = "INSERT INTO categorias (
										nombre										
										)
									VALUES (						
										'" . $categoria->nombre . "'										
										)";			
												
				
		mysqli_query(getConnection(),$query) or die(mysqli_error(getConnection()));		
		
		mysqli_close(getConnection());
		return mysqli_insert_id(getConnection());
	}// insert
	
	public static function Actualizar($categoria) {

		$query = "UPDATE categorias SET 
			nombre = '".addslashes($categoria->nombre)."'			
			WHERE id = ".$categoria->id;
		
		$result = mysqli_query(getConnection(),$query) or die(mysql_error());

		mysqli_close(getConnection());
	}// update
	
	public static function ObtenerPorId($id){
		$query = "SELECT * FROM categorias WHERE id = ".$id;
		$rs = mysqli_query(getConnection(),$query) or die(mysqli_error(getConnection()));
		mysqli_close(getConnection());
		return CategoriaDao::setEntity($rs, false);
	}		
	
	public static function Eliminar($id) {
		$query = "DELETE FROM categorias WHERE id = " . $id;		
		mysqli_query(getConnection(),$query) or die(mysqli_error(getConnection()));
		mysqli_close(getConnection());
		
		return true;
	}// delete
	
	public static function ObtenerTodos(){
		$query="SELECT * FROM categorias";
		$result = mysqli_query(getConnection(),$query) or die(mysqli_error(getConnection()));
		
		mysqli_close(getConnection());
		
		return CategoriaDao::setEntity($result, true);
	}//listar todos	

	public static function setEntity($rs, $list){
		$result = array();
		$categoria = null;
		$count = 0;
		
		while ($row = mysqli_fetch_array($rs)) {
			$categoria = new Categoria();
			$categoria->id = $row['id'];
			$categoria->nombre = $row['nombre'];												

			$result[$count] = $categoria;
			$count++;
		}

		if ($list) {
			return $result;
		} else {
			return $categoria;
		}			
	}
};
?>