<?php 

	 
	session_start();
	require 'config.php';
	require 'funciones.php';	

	
	if (isset($_SESSION['usuario']))
	{			 

	
		$actualpass= $conexion->real_escape_string($_POST['actualpass']);
		$nuevapass= $conexion->real_escape_string($_POST['nuevapass']);
		$confirmapass= $conexion->real_escape_string($_POST['confirmapass']);

		global $conexion;
		
		$stmt = $conexion->prepare("SELECT password FROM tb_usuarios WHERE usuario = ? LIMIT 1");
		$stmt->bind_param("s", $_SESSION['usuario']);
		$stmt->execute();
		$stmt->store_result();
		$rows = $stmt->num_rows;
		
		if($rows > 0) 
		{			
				$stmt->bind_result($passwd);
				$stmt->fetch();
				
				$validaPassw = password_verify($actualpass, $passwd);
				
				if($validaPassw)
				{
					if(validacontraseñas($nuevapass, $confirmapass))
					{
							$id=$_SESSION['usuario'];
							$pass_hash = hashcontraseña($nuevapass);
							$sql = "update tb_usuarios set password= '$pass_hash'  where usuario='$id'";
						
							include("config.php");
							$resultado = $conexion->query( $sql );
							if( $conexion->affected_rows > 0 )
							{	
									echo "<script> alert ('Contraseña Modificada.') </script>";
									echo "<script>location.href='stockdispo.php'</script>";
													

							}else
								{
										echo "<script> alert ('Error: no se han actualizado los datos, Verifique la informacion que desea ingresar.') </script>";
										echo "<script>location.href='stockdispo.php'</script>";
										
								}	
					}else
						{
							$errors[] = "Las contraseñas no coinciden";
						}
						
				} else 
					{
					$errors = "La contrase&ntilde;a es incorrecta";
					}
		} else
			{
					 echo "<script> alert('la consulta no se realizo'); </script>";
			}
		
	
	}else{
			
		 	header("location: index.php");
	}

?>