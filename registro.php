 <?php 
	
	require 'config.php';
	require 'funciones.php';
	
	$errors = array();
	
	if(!empty($_POST)) 
	{
		$nombre = $conexion->real_escape_string($_POST['nombre']);
		
		$usuario = $conexion->real_escape_string($_POST['usuario']);	
			
		$password = $conexion->real_escape_string($_POST['contrasena']);	
			
		$con_password = $conexion->real_escape_string($_POST['repitecontrasena']);
			
		$celular= $conexion->real_escape_string($_POST['celular']);
		$email = $conexion->real_escape_string($_POST['email']);	
		
		$captcha = $conexion->real_escape_string($_POST['g-recaptcha-response']);
		
		date_default_timezone_set("america/bogota");
		$fecha_registro=date('Y-m-d H:i:s');	
		$activo = 0;
		
		$secret = '6LddGBwUAAAAAEHJFB2Gd8ROyHHFmFGuXlfmYo_E';
		
		if(!$captcha){
			$errors[] = "Por favor verifica el captcha";
		}
		
		if(isNull( $usuario, $nombre, $celular, $email, $password, $con_password ))
		{
			$errors[] = "Debe llenar todos los campos";
		}
		
		if(!isEmail($email))
		{
			$errors[] = "Dirección de correo inválida";
		}
		if(!preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{12,50}$/', $password)) {
    	$errors[] = "La contraseña no cumple con los requerimientos";
		}
		
		if(!validacontraseñas($password, $con_password))
		{
			$errors[] = "Las contraseñas no coinciden";
		}
		
		if(usuarioExiste($usuario))
		{
			$errors[] = "El nombre de usuario $usuario ya existe";
		}
		
		if(emailExiste($email))
		{
			$errors[] = "El correo electronico $email ya existe";
		}
		
		if(count($errors) == 0)
		{
			$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");
			
			$arr = json_decode($response, TRUE);
			
			if($arr['success'])
			{
				
				$pass_hash = hashcontraseña($password);
				
				$token = generarToken();
				
				$registro = registroUsuario($usuario, $pass_hash, $nombre, $celular, $email, $activo, $token, $fecha_registro);
				
				if(!empty($registro))
				{
					
					
					$url = 'http://'.$_SERVER["SERVER_NAME"].'/modificado/activar.php?id='.$registro.'&val='.$token;
					
					$asunto = 'Activar Cuenta';
					$cuerpo = "Estimado $nombre: <br /><br />Para continuar con el proceso de registro, es indispensable de click en la siguiente liga <a href='$url'>Activar Cuenta</a>";
					
					if(enviarEmail($email, $nombre, $asunto, $cuerpo)){
					
					echo "Para terminar el proceso de registro siga las instrucciones que le hemos enviado la direccion de Correo Electronico: $email";
					
					echo "<br><a href='index.php' >Iniciar Sesion</a>";
					exit; 
					

					} else {
						$erros[] = "Error al enviar Email";
					}
					
					} else {
					$errors[] = "Error al Registrar";
				}
				
				} else {
				$errors[] = 'Error al comprobar Captcha';
			}
			
		}
		
	}
	
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<link rel="shortcut icon" type="image/x-icon" href="images/sen2.png">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>| Registro Administradores</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet"  href="css/estilos.css">
	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
<section>
	<div class="container">
		<div class="row">	
			<div class="col-sm-4"></div>
			<div  class="col-xs-12 col-sm-4">
				<div style="margin-top:50px" class="panel panel-default">
					<div class="panel-heading ">
						<div class="panel-title">Regístrese</div>
						<div style="float:right; font-size: 100%; position: relative; top: -10px"><a id="signinlink" href="index.php">Iniciar Sesión</a></div>
					</div>  
					
					<div class="panel-body">
						
						<form class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
							
							<div id="signupalert" style="display:none" class="alert alert-danger">
								<p>Error:</p>
								<span></span>
							</div>

							<div class="form-group">
								<label for="usuario" class="col-md-3 control-label">Usuario</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="usuario" placeholder="Usuario" value="" required="">
								</div>
							</div>

							<div class="form-group">
								<label for="nombre" class="col-md-3 control-label">Nombre:</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="nombre" placeholder="Nombre" value="" required="">
								</div>
							</div>
							
							<div class="form-group">
								<label for="celular" class="col-md-3 control-label">Celular:</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="celular" placeholder="Celular" value="" required="">
								</div>
							</div>
						
							<div class="form-group">
								<label for="email" class="col-md-3 control-label">Email</label>
								<div class="col-md-9">
									<input type="email" class="form-control" name="email" placeholder="Email" value="" required="">
								</div>
							</div>
							
							<div class="form-group">
								<label for="contraseña" class="col-md-3 control-label">Contraseña</label>
								<div class="col-md-9">
									<input type="password" class="form-control" name="contrasena" placeholder="Contraseña" required="">
								</div>
							</div>
							
							<div class="form-group">
								<label for="con_contraseña" class="col-md-3 control-label">Confirmar Contraseña</label>
								<div class="col-md-9">
									<input type="password" class="form-control" name="repitecontrasena" placeholder="Confirmar Contraseña" required="">
								</div>
							</div>
							<div class="form-group">
								<label for="captcha" class="col-md-3 control-label"></label>
								<div class="g-recaptcha col-md-9" data-sitekey="6LddGBwUAAAAAOL2bMn0KPebaQ20Xdg1L08uxfEh"></div>
							</div>
							
							<div class="form-group">                                      
								<div class="col-md-offset-3 col-md-9">
									<button id="btn-signup" type="submit" class="btn btn-success"><i class="icon-hand-right"></i>Registrar</button> 
								</div>
							</div>
						</form>
						<?php echo resultblock($errors); ?>
					</div>
				</div>
			</div>
			
			<div class="col-sm-4"></div>
		</div>
	</div>
	<br><br>
</section>
<footer style="margin-top: 450px;" id="footer2">
	<div class="container">
		<div class="row">
		</div>
	</div>	
</footer>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>