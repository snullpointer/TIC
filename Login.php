<?php
session_start();
if(isset($_SESSION ["userid"])){
header ("location: index.php");
}
?>
<!doctype html>
<html>
	<head>
		<title> Preguntados </title>
	</head>	
		
	<body>
		<h1> Login </h1>
		
		<form action="ValidacionLogin.php" method="POST">
			<label> Usuario </label>
			<input type= "text" name= "txtUsuario" id= "txtUsuario" value = "" />		
			<label> Contrase�a </label>
			<input type= "password" name= "txtContrasena" id= "txtContrasena" value = "" />	 
			<input type= "submit"  value = "Ingresar" />
		</form>
		
		<a href="registracion.php" > Crear cuenta nueva </a>
		
	</body>

</html> 