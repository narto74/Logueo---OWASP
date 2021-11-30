<?php   
	require 'config.php';
	require 'funciones.php';

	$tabla=$_GET['tabla'];
	
	$primarykey=$_GET['primarykey'];
	
	$documento=$_GET['codigo'];
		
	$enlacefinal=$_GET['enlacefinal'];
	
 	$sql1="";
	
	eliminar_dato_tabla($tabla,$primarykey,$documento,$enlacefinal);

?>