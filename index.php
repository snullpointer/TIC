<?php
session_start();
if(!isset($_SESSION ["userid"])){
header ("location: login.php");
}
?>
Bienvenido <?php echo $_SESSION["userid"];?> 
<a href= "CerrarSesion.php" > Salir </a>