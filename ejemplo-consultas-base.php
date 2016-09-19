<?php
//EJEMPLO PARA INSERTAR

//ABRO LA CONEXION CON LA BASE
$conexion=mysqli_connect("localhost","root","","preguntados") or 
die("Problemas con la conexión");

$query = "INSERT INTO 
categorias (categorias) VALUES ('" . $nombre . "')";

//EJECUTO EL INSERT
mysqli_query($conexion,$query) or 
die("Problemas en el insert:".mysqli_error($conexion));

//CIERRO LA CONEXION
mysqli_close($conexion);

//--------------------------------------------------------------------------------------

//EJEMPLO PARA RECUPERAR UN LISTADO LUEGO DE UN SELECT
//ABRO LA CONEXION CON LA BASE
$conexion=mysqli_connect("localhost","root","","preguntados") or 
die("Problemas con la conexión");

//DEFINO LA CONSULTA A EJECUTAR
$query = 'select * from categorias';

//EJECUTO LA CONSULTA Y OBTENGO EL RESULTADO DEL SELECT
$registros=mysqli_query($conexion,$query) or 
die("Problemas en el select:".mysqli_error($conexion));


//RECORRO EL RESULTADO OBTENIDO Y LO MUESTRO POR PANTALLA
while ($reg=mysqli_fetch_array($registros)){
		//MUESTRO CADA NOMBRE DEL LISTADO QUE RECUPERO
		echo $reg['nombre'];
}

?>