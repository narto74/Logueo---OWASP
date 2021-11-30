<?php 
session_start();
	 include "config.php";
	
	 	if (isset($_SESSION['usuario']))
	 	{
			$usuario=$_POST['usuario'];
			$nombre=$_POST['nombre'];
			$celular=$_POST['celular'];
			$correo=$_POST['correo'];

		include ('funciones.php');//llamo la funciones


		$sql = "update tb_usuarios set usuario= '$usuario', nombre= '$nombre', celular='$celular', correo='$correo' where usuario='$_SESSION[usuario]'";
		
		include("config.php");
		$resultado = $conexion->query( $sql );
			if( $conexion->affected_rows > 0 )
				{	session_destroy();
					session_start();
					$_SESSION['usuario']=$usuario;
					$_SESSION['nombre']=$nombre;
					echo "<script>location.href='stockdispo.php'</script>";

				}else{
						echo "<script> alert ('Error: no se han actualizado los datos de la tabla en la base de datos.') </script>";
						echo "<script>location.href='stockdispo.php'</script>";
					}

		}else{
			
		 	header("location: index.php");
		} 
?>