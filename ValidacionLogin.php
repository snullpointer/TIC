<?php
session_start();

if(isset($_GET["txtUsuario"]))
{ 
	$usuario =  $_GET["txtUsuario"];
}
else 
{
	if(isset($_POST["txtUsuario"]))
	{
		$usuario = $_POST["txtUsuario"]; 
	}
}
 
if($usuario== "" )
{
	echo "Complete el campo usuario";
}

if(isset($_GET["txtContrasena"]))
{ 
	$contrasena =  $_GET["txtContrasena"];	
}
else{
	if(isset($_POST["txtContrasena"]))
	{
		$contrasena = $_POST["txtContrasena"]; 
	}
}
if($contrasena == "" )
{
	echo "Complete el campo contraseña";
}
 
if($usuario != "" and $contrasena != "") {
	$pos= strpos($usuario, "@");

	if($pos === false){
		echo "Mail erroneo";
	}
	else{
		$domain = strstr($usuario, "@");
		$pos2= strpos($domain, ".");
		if($pos2===false){
			echo "Mail erroneo";
		}
		else{
			
			
			
			//abrir conexion, traer persona y comparar contraseñas
			$conexion= mysqli_connect("localhost", "root", "", "preguntados") or die ("Problemas con la con la base de datos");		
			$query = "select * from personas WHERE email='" .$usuario."'";
			$contrasenaObt= "";
			$registros = mysqli_query($conexion, $query) or die("Problemas en el select:".mysqli_error($conexion));	
			
			while ($reg= mysqli_fetch_array($registros))
			{
				$contrasenaObt = $reg['password'];
			}
			
			mysqli_close($conexion); 	
			if($contrasenaObt != "")
			{
				if($contrasenaObt == $contrasena)
				{
					$_SESSION["userid"] = $_POST["txtUsuario"];
					header ("Location: index.php"); 
				}
				else
				{
					echo "Contraseña erronea";
				}
			}
			else
			{
				echo "No existe el usuario";
			}
		

		}
	}
}

?>