<?php     

		function buscar($campos,$tabla,$condicion)
	{

		$sql="select ".$campos." from ".$tabla." where ".$condicion;

		 include("config.php");
		 return $resultado;
		 
	}

		function nuevo($tabla,$campos,$valores)
	{
	
		$sql="INSERT INTO  $tabla ( $campos ) VALUES( $valores )";
	
		 include("config.php");
		 if($conexion-> affected_rows > 0 ) 
		{ 
			echo "<script>location.href='nuevo.php' </script>";

		}else{
				echo  "Error: los datos no se han guardado. Es probale que la información ya se encuentre en el sistema.";
			}

		 return $resultado;
		
	} 

		function eliminar_tabla($tabla,$condicion)
	{
	
		$sql="DELETE FROM  $tabla $condicion ";
		
		 include("config.php");
		if($conexion-> affected_rows > 0 ) 
		{ 
			echo  "Los datos se han eliminado correctamente.";

		}else{
				echo  "Error: los datos no se han eliminado. La información continua en el sistema.";
			}

		 return $resultado;
		
	}

		function drop_table($tabla)

	{
	
		$sql="DROP TABLE $tabla ";
		
		 include("config.php");

		 
			echo  "La tabla se ha eliminado correctamente.";

		
		
	}

		function eliminar_dato_tabla($tabla,$primarykey,$documento,$enlacefinal)
	{
	
		
		$sql="DELETE FROM $tabla WHERE $primarykey='$documento';";
		
		include("config.php");
		$conexion->query( $sql );
		
		
		if($conexion-> affected_rows > 0 ) 
		{ 
				
				echo "<script>location.href='$enlacefinal' </script>";			

		}else{
				echo  "Error: los datos no se han eliminado. La información continua en el sistema.";
			}

		 return $resultado;
		
	}


function mostrartabla($tabla,$enlaceeli,$primarykey,$enlacefinal)

	{
		
$sql="SELECT * FROM  $tabla ";
include("config.php");
$resultado = $conexion->query( $sql );
echo "	<table class='table table-condensed display' id='mitabla' > 
		<thead>
		<tr>
				<th>Identificacion</th>
				<th>nombre</th>
				<th>Tipo de Externo</th>
				<th>Direccion</th>	
				<th>celular</th>	
				<th>fecha registro</th>	
				<th>Opciones</th>
		</tr>
		</thead>";

while ($row=mysqli_fetch_row($resultado)) 
{
	echo "<tr>
				<td>".$row[0]."</td>
				<td>".$row[1]."</td>	
				<td>".$row[2]."</td>
				<td>".$row[3]."</td>
				<td>".$row[4]."</td>
				<td>".$row[5]."</td>
				<td align='center'><a id='eliminarnegro' href='actualizaexterno.php?identificacion_externo=$row[0]' ><button class='glyphicon glyphicon-pencil'></button></a>
					<a id='eliminarnegro' href='javascript:mi_alerta()' ><button class='glyphicon glyphicon-trash'></button></a></td>
		</tr>
		<script language='Javascript'>
								function mi_alerta()
								{
								confirmar=confirm('Esta Usted seguro que desea eliminar este producto');

								if (confirmar)
								{	
								location.href='$enlaceeli?codigo=$row[0]&tabla=$tabla&enlacefinal=$enlacefinal&primarykey=$primarykey';

								}


								}
								</script>";

}
echo "	</table>";	

	}		



	
function mostrarformulario($tabla,$enlace)
	{
		$documento=$_GET['documento'];
				session_start();
				$_SESSION['documento']=$documento;
				 $sql= "SELECT * FROM $tabla WHERE documento='$documento'";
				 include("config.php");
				 $resultado = $conexion->query( $sql );	
				 $row=mysqli_fetch_row($resultado);
				 echo "<form class='form-horizontal' action='$enlace'>";
				 echo "	<br>documento<br><input type='text' class='form-control' name='cj1' value=".$row[0]." required>";
				 echo "	<br>Nombre<br><input type='text' class='form-control' name='cj2' value=".$row[1]." required>";
				 echo "	<br>Celular<br><input type='text' class='form-control' name='cj4' value=".$row[2]." required>";
				 echo "	<br><input type='submit' value='Actualizar'> ";
				 echo "</form>";
	}



function actualizardato($tabla,$documento,$nombre,$celular,$enlace)
	{

		session_start();
		$sql="update $tabla set documento='$documento',nombre='$nombre',celular='$celular' where documento='$_SESSION[documento]' ";
		
		include("config.php");
		$resultado = $conexion->query( $sql );	
		echo "<script>location.href='$enlace' </script>";
	}


function actualizardatoupdate($table,$camposandvalues,$idcon)
	{

			
		$sql="update $table set $camposandvalues where $idcon ";
		
		include("config.php");
		if($conexion-> affected_rows > 0 ) 
		{ 
			echo "<center><br/><b style='color:green; font-size:15rem' >Los datos se han actualizado.</b></center>";
		

		}else{
				echo  "<center><br/><b style='color:red; font-size:15rem' >Error: los datos no se han actualizado.</b></center> ";
			}

		
	}

function isnull($usuario, $nombre, $celular, $email, $contraseña, $repitecontraseña){
	if (strlen(trim($usuario)) < 1 || strlen(trim($nombre)) < 1 || strlen(trim($email)) < 1 || strlen(trim($celular)) < 1 || strlen(trim($contraseña)) < 1 || strlen(trim($repitecontraseña)) < 1 ) 
	{
	return 	true;
	}else{
	return false;	
	}
}

function isemail($email){
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) 
	{
	return 	true;
	}else{
	return false;	
	}
}

function validacontraseñas($contraseña, $repitecontraseña){
	if (strcmp($contraseña, $repitecontraseña) !== 0) 
	{
	return 	false;
	}else{
	return true;	
	}
}



function minmax($min, $max, $valor){
	if (strlen(trim($valor)) < $min) 
	{
	return true;
	}else if(strlen (trim($valor)) > $max) 
	{
	return true;
	}else
	{
		return false;
	}

}

function usuarioexiste($usuario){

	global $conexion;
	
	$stmt=$conexion->prepare("SELECT usuario FROM tb_usuarios WHERE usuario = ? LIMIT 1");


	$stmt->bind_param("s", $usuario);
	
	$stmt->execute();
    
	$stmt->store_result();
	
	$num= $stmt->num_rows;
	
	$stmt->close();

	
	if ($num > 0) 
	{
		return true;
	}else{
		return false;
	}
}

function emailexiste($email){

	global $conexion;

	$stmt=$conexion->prepare("SELECT usuario FROM tb_usuarios WHERE correo = ? LIMIT 1");
	$stmt->bind_param("s", $email);
	$stmt->execute();
	$stmt->store_result();
	$num= $stmt->num_rows;
	$stmt->close();
	if ($num > 0) 
	{
		return true;
	}else{
		return false;
	}
}

function hashcontraseña($password){

	$hash=password_hash($password, PASSWORD_DEFAULT);
	return $hash;
}

function registroUsuario($usuario, $contraseña, $nombre, $celular, $email, $activo, $token, $fecha_registro ){

		
		global $conexion;
		
		$stmt=$conexion->prepare("INSERT INTO tb_usuarios (usuario, password, nombre, celular, correo, activacion, token, fecha_registro) VALUES (?,?,?,?,?,?,?,?)");
		$stmt->bind_param('sssssiss', $usuario, $contraseña, $nombre, $celular, $email, $activo, $token, $fecha_registro);
		
		if ($stmt->execute()){

			$stmt= $conexion->prepare("SELECT usuario FROM tb_usuarios WHERE usuario = ? LIMIT 1 ");
			$stmt->bind_param('s', $usuario);
			$stmt->execute();
			$stmt->store_result();
			$num = $stmt->num_rows;

			if ($num>0) 
			{
				$stmt->bind_result($_usuario);
				$stmt->fetch();
			return $_usuario;
			
			} else 
			{
			return 0;	
			}		
		}	
}

function registros($tabla, $camposbd, $valoresusu){

		global $conexion;

		$stmt= $conexion->prepare("INSERT INTO $tabla ($camposbd) VALUES (?,?,?,?,?,?,?)");
		$stmt->bind_param('sss', $valoresusu);

 		
}

	function enviarEmail($email, $nombre, $asunto, $cuerpo){
		
		require_once 'PHPMailer/PHPMailerAutoload.php';
		
		$mail = new PHPMailer();
		$mail->isSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'tls'; 	
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = '587';
		$mail->Username = 'eltuyo@gmail.com';
		$mail->Password = '*******';
		
		 
        
		$mail->setFrom('eltuyo@gmail.com', 'GIBMAFE');
		$mail->addAddress($email, $nombre);
		
		$mail->Subject = $asunto;
		$mail->Body    = $cuerpo;
		$mail->IsHTML(true);
		
		if($mail->Send()) {
	 	return true;
		}else{
		return false;
	}
	}

	function validaIdToken($id, $token){
		global $conexion;
		
		$stmt = $conexion->prepare("SELECT activacion FROM tb_usuarios WHERE usuario = ? AND token = ? LIMIT 1");
		$stmt->bind_param("ss", $id, $token);
		$stmt->execute();
		$stmt->store_result();
		$rows = $stmt->num_rows;
		
		if($rows > 0) {
			$stmt->bind_result($activacion);
			$stmt->fetch();
			
			if($activacion == 1){
				$msg = "La cuenta ya se activo anteriormente.";
				} else {
				if(activarUsuario($id)){
					$msg = 'Cuenta activada.';
					} else {
					$msg = 'Error al Activar Cuenta';
				}
			}
			} else {
			$msg = 'No existe el registro para activar.';
		}
		return $msg;
	}

	function activarUsuario($id)
	{
		global $conexion;
		
		$stmt = $conexion->prepare("UPDATE tb_usuarios SET activacion=1 WHERE usuario = ?");
		$stmt->bind_param('s', $id);
		$result = $stmt->execute();
		$stmt->close();
		return $result;
	}

function resultblock($errors){
	if (count($errors)> 0) {
		
		echo "<div id='error' class='alert alert-danger' role='alert'>
			  <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'>";	
		foreach ($errors as $error) 
		{		
				echo $error;
		}
		echo "</span>";
		echo "<span class='sr-only'>Error:</span>";
		echo "</div>";	
	}
}

function isnulllogin($usuario, $contraseña){
	if (strlen(trim($usuario)) < 1 || strlen(trim($contraseña)) < 1 ) 
	{
		return true;
	}
	else
	{
		return false;
	}
		
	
}

function login1($usuario, $contraseña){

	global $conexion;

	$stmt=$conexion->prepare("SELECT usuario,password FROM tb_usuarios WHERE usuario = ?  LIMIT 1");
	$stmt->bind_param("s", $usuario);
	$stmt->execute();
	$stmt->store_result();
	$num= $stmt->num_rows;

	if ($num > 0) 
	{
		$stmt->bind_result($id,$passw);
		$stmt->fetch();

		
		print_r($stmt);
		if($validacontraseñas){
			$_SESSION['usuario']=$id;
			header("location: stockdispo.php");
		}
		else{
		$errors = "La contraseña es incorrecta";
		}
	}
}

function Login($usuario, $password)
	{
		global $conexion;
		
		$stmt = $conexion->prepare("SELECT usuario, password, nombre FROM tb_usuarios WHERE usuario = ? || correo = ? LIMIT 1");
		$stmt->bind_param("ss", $usuario, $usuario);
		$stmt->execute();
		$stmt->store_result();
		$rows = $stmt->num_rows;
		
		if($rows > 0) {
			
			if(isActivo($usuario)){
				
				$stmt->bind_result($id, $passwd,$nombre);
				$stmt->fetch();
				
				$validaPassw = password_verify($password, $passwd);
				
				if($validaPassw){
					
					lastSession($id);


					$_SESSION['usuario'] = $id;
					$_SESSION['nombre'] = $nombre;

					
					
					header("location: stockdispo.php");
					} else {
					
					$errors = "La contrase&ntilde;a es incorrecta";
				}
				} else {
				$errors = 'El usuario no esta activo';
			}
			} else {
			$errors = "El nombre de usuario o correo electr&oacute;nico no existe";
		}
		return $errors;
	}

			function lastSession($id)
	{
		global $conexion;
		
		$stmt = $conexion->prepare("UPDATE tb_usuarios SET ultima_sesion=NOW(), token_password='', password_request=1 WHERE usuario = ?");
		$stmt->bind_param('s', $id);
		$stmt->execute();
		$stmt->close();
	}

function registromovimiento($descripcion, $cantidad, $tipo_movimiento, $valor_movimiento, $fecha_registro, $factura, $codigo_externo, $usuario, $codigo_producto){

		global $conexion;

		if($statement=$conexion->prepare("INSERT INTO tb_movimientos (descripcion, cantidad, tipo_movimiento, valor_movimiento, fecha_movimiento, factura, identificacion_externo, usuario, cod_producto) VALUES (?,?,?,?,?,?,?,?,?)"))
				{
			    $statement->bind_param('sisissssi', $descripcion, $cantidad, $tipo_movimiento, $valor_movimiento, $fecha_registro, $factura, $codigo_externo, $usuario, $codigo_producto);	
			    $statement->execute();
				    if ($conexion-> affected_rows > 0 )  {
						echo "<script> alert ('guardado') </script>" ;
						echo "<script>location.href='movimientos.php' </script>";
						}
						else
						{
						echo "<script> alert ('Verifique los datos ingresados') </script>";
						echo "<script>location.href='movimientos.php' </script>";
						}
				}
}


function actualizar($tabla, $campos, $valores, $condicion)
{

	$sql = "UPDATE $tabla set $campos = $valores WHERE $condicion";
	echo $sql;
	include("config.php");
	$resultado = $conexion->query( $sql );
	if( $conexion->affected_rows > 0 )
		{
			echo "Los datos se han actualizado correctamente.";

		}else{
				echo "Error: no se han actualizado los datos de la tabla en la base de datos.";
			}
		
		return $resultado;

}

function getvalor($campo, $campowhere, $valor){

	global $conexion;

	$stmt= $conexion->prepare("SELECT $campo FROM tb_usuarios WHERE $campowhere = ? LIMIT 1 ");
	$stmt->bind_param('s', $valor);
	$stmt->execute();
	$stmt->store_result();
	$num = $stmt->num_rows;

	if ($num>0) 
	{
		$stmt->bind_result($_campo);
		$stmt->fetch();
		return $_campo;
	}else{
		echo "error";
	}

}

function traer_lista_informacion( $nombre_lista, $tabla, $campo_llave_primaria, $campo_a_mostrar )
	{


		$salida = "";

	
		$sql = "SELECT * FROM  $tabla ";
		include( "config.php" );
	
		$resultado = $conexion->query( $sql );	

		$salida .= "<SELECT class='form-control' NAME='$nombre_lista'>";
		$salida .= "<OPTION VALUE='-1'>Seleccionar</OPTION>";

		while( $fila = mysqli_fetch_assoc( $resultado ) )
		{
			$salida .= "<OPTION VALUE='".$fila[ $campo_llave_primaria ]."'>".$fila[ $campo_a_mostrar ]."</OPTION>";
		}

		$salida .= "</SELECT>";

		return $salida;	
	}

	
	function retornar_dato_tabla( $tabla, $campo_a_retornar, $condicion = null )
	{
		
		$salida = "";

	
		$sql = "SELECT $campo_a_retornar AS dato_de_salida FROM $tabla ";
		include( "config.php" ); 
		
		$resultado = $conexion->query( $sql );	
		if( $condicion != null ) $sql .= " WHERE $condicion ";

	
		if( mysqli_num_rows( $resultado ) > 0 )
		{
			while( $fila = mysqli_fetch_assoc( $resultado ) )
			{
				$salida = $fila[ 'dato_de_salida' ];
			}
		}

		return $salida;
	}

		function isActivo($usuario)
	{
		global $conexion;
		
		$stmt = $conexion->prepare("SELECT activacion FROM tb_usuarios WHERE usuario = ? || correo = ? LIMIT 1");
		$stmt->bind_param('ss', $usuario, $usuario);
		$stmt->execute();
		$stmt->bind_result($activacion);
		$stmt->fetch();
		
		if ($activacion == 1)
		{
			return true;
		}
		else
		{
			return false;	
		}
	}	


		function cambiaPassword($password, $user_id, $token){
		
		global $conexion;
		
		$stmt = $conexion->prepare("UPDATE tb_usuarios SET password = ?, token_password='', password_request=0 WHERE usuario = ? AND token_password = ?");
		$stmt->bind_param('sss', $password, $user_id, $token);
		
		if($stmt->execute()){
			return true;
			} else {
			return false;		
		}
	}


	function verificaTokenPass($user_id, $token){
		
		global $conexion;
		
		$stmt = $conexion->prepare("SELECT activacion FROM tb_usuarios WHERE usuario = ? AND token_password = ? AND password_request = 1 LIMIT 1");
		$stmt->bind_param('ss', $user_id, $token);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		
		if ($num > 0)
		{
			$stmt->bind_result($activacion);
			$stmt->fetch();
			if($activacion == 1)
			{
				return true;
			}
			else 
			{
				return false;
			}
		}
		else
		{
			return false;	
		}
	}

	function generaTokenPass($user_id)
	{	
		global $conexion;
		
		$token = generarToken();
		
		$stmt = $conexion->prepare("UPDATE tb_usuarios SET token_password=?, password_request=1 WHERE usuario = ?");
		$stmt->bind_param('ss', $token, $user_id);
		$stmt->execute();
		$stmt->close();
		
		return $token;
	}

	function generarToken()
	{
		$gen = md5(uniqid(mt_rand(), false));	
		return $gen;
	}


?>
