﻿<?php
	session_start();

	include "config.php";
	
	if (isset($_SESSION['usuario']))
		{
	$id=$_SESSION['usuario'];
	$sql = "select * from tb_usuarios where usuario = '$id'";
	$resultado = $conexion->query( $sql );
	$row = mysqli_fetch_row($resultado);
?>
<!DOCTYPE html>  
<html lang="es">
<head>
	<?php include ("inc/headcommon.php");?>
	<title>Inventario | Usuario</title>	
</head>
<body> 
<?php include "inc/header.php"; ?>
<section>
	<div class="container">
		<div class="row">
			<div class="contenedor-menu col-xs-12 col-sm-2 col-sd-2 ">
			<div class="smenu ">
					<?php include("inc/menu.php"); ?> 	
			</div>
			</div>
			<div class="contenedor-section1 col-xs-12 col-sm-10 col-sd-10 ">
				<div class="panel panel-success">	
					<div class="panel-heading">
						<div style="padding: 0;" class="col-xs-12 col-sm-12 btn-group pull-right ">

					    	
					    	
					    	<button type="button" style="float: right;"  class="col-xs-9 col-sm-5 btn btn-danger" data-toggle="modal" data-target="#myModal2"><span class="glyphicon glyphicon-lock"></span> Cambiar contraseña </button>			
						</div>			
					</div>
					<br>
					<div class="panel-body">
						<div class=" container">
							<div class="row">
								<div class="col-xs-12 col-sm-4 ">
							<form class="form-horizontal" role="form" action="actualizar.php" method="POST" autocomplete="off">
							
							<div id="signupalert" style="display:none" class="alert alert-danger">
								<p>Error:</p>
								<span></span>
							</div>

							<div class="form-group">
								<label class="col-md-3">Usuario</label>
								<br>
								<div class="col-md-12">
									<input type="text" class="form-control" name="usuario" placeholder="Usuario" value="<?php  echo $row[0];?>" required="">
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3">Nombre</label>
								<div class="col-md-12">
									<input type="text" class="form-control" name="nombre" placeholder="Nombre" value="<?php  echo $row[2];?>" required="">
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-3">Celular</label>
								<div class="col-md-12">
									<input type="text" class="form-control" name="celular" placeholder="Celular" value="<?php  echo $row[3];?>" required="">
								</div>
							</div>
						
							<div class="form-group">
								<label class="col-md-3 ">Email</label>
								<div class="col-md-12">
									<input type="email" class="form-control" name="correo" placeholder="Email" value="<?php  echo $row[4];?>" required="">
								</div>
							</div>

							<div class="form-group">                                      
								<div class="col-xs-12">
									<button id="btn-signup" type="submit" class="col-xs-12 btn btn-success"><span class="glyphicon glyphicon-refresh"></span>  Actualizar Perfil</button> 
								</div>
							</div>
						</form>							
							
								</div>
								<div class="col-xs-12 col-sm-4 ">
									
								</div>
								<div class="col-xs-12 col-sm-4 "></div>
							</div>
						</div>	
			 	 	</div>
				</div>
				<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
						<h4 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-edit"></i> Actualizar Contraseña</h4>
					  </div>
					  <div class="modal-body">
						<form class="form-horizontal" method="post" action="actualizarpass.php" >
						 	<div class="form-group">
							<div class="col-sm-12">
							  <input type="password" class="form-control" id="documento" placeholder="Contraseña Actual" name="actualpass">
							</div>
						  	</div>
						  
							<div class="form-group">
							<div class="col-sm-12">
							  <input type="password" class="form-control" id="nombre" placeholder="Nueva Contraseña " name="nuevapass" required="">
							</div>
						 	</div>
						  
						  	<div class="form-group">
							<div class="col-sm-12">
							<input type="password" class="form-control" id="celular" placeholder="Confirma Nueva Contraseña" name="confirmapass">
							</div>
							</div>	
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-primary" id="actualizar_datos">Actualizar Contraseña</button>

					  </div>
					 	</form> 
					</div>
				  </div>
				</div>		
			</div>
		</div>
	</div>
</section>
		<?php
		 }else{
		 	header("location: index.php");
		 }
			include "inc/footer.php";
 		?>
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>


		