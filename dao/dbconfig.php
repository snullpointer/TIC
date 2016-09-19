<?php

function getConnection() {
	
	$conexion=mysqli_connect("localhost","root","","preguntados") 
	or die("Problemas con la conexión");
	
	return $conexion;

}// getConnection

?>