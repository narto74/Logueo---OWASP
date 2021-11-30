<?php 

	session_start();
	include "config.php";

	if (isset($_POST['enviar'])) 
	{

		$usuario= $_POST['usuario'] ;
		$contraseña=  $_POST['contraseña'];
		
		$sql="SELECT usuario FROM tb_usuarios WHERE usuario='".$usuario."' AND pass='".$contraseña."'" ;
		
		
		$resultado = $conexion->query( $sql );
 		
		if (mysqli_num_rows($resultado)==0) 
		{
				echo "<script text='text/javascript'>;
						alert('el usuario o la contraseña no coinciden');
						window.location= 'dsd.php';
					  </script>";
		}else{
					$_SESSION['usuario']=$usuario;
					header("location: stockdispo.php");
		}

	}

 ?>