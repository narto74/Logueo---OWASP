<?php
	 
	session_start();
	include "config.php";
	
	if (isset($_SESSION['usuario']))
	{	
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php include ("inc/headcommon.php");?>
	<title>Inventario | Reportes</title>
<link href="css/estilo.css" rel="stylesheet">
<script src="js/bootstrap.js"></script>	
<script src="js/jqueryb.js"></script>
<script src="js/myjava.js"></script>
</head>
<body> 
<?php	include "inc/header.php";?>
<section>
	<div class="container">
		<div class="row">
			<div class="contenedor-menu col-xs-12 col-sm-2 col-sd-2 ">
			<div class="smenu ">
					<?php include("inc/menu.php"); ?> 	
			</div>
			</div>
			<div class="contenedor-section0	 col-xs-12 col-sm-10 col-sd-10  ">
				<div class="panel panel-success">	
					<div class="panel-heading">
					    <div class=" btn-group col-xs-12 pull-right">
					    	
						</div>				
					</div>
					<br>
					<h4 class="modal-title"><i class="glyphicon glyphicon-edit"></i> Reportes por Fecha</h4>
					<br>
					<div class="contenedor-section col-xs-12 panel-body">
						<div class="container ">
				    		<div class="row ">
				    		<div class="  col-xs-12 col-sm-12">
				    			
				    			<br><br><br><br>		
				    		</div>	
				    		</div>
				    		
					    	</div>
				    		<div class="  col-xs-12 col-sm-12">
				    			<div class="container">
				    				<div class="row">
				    					
				    					<div class="col-xs-12 col-sm-4 ">
				    						<center><a href="reportesmov.php"><button type="button" class="btn btn-default btn-lg">
											  <span class="glyphicon glyphicon-transfer" aria-hidden="true"></span> MOVIMIENTOS	
											</button></a></center><br><br>
				    					</div>
				    					<div class="col-xs-12 col-sm-4 ">
				    						<center><a href="reportespro.php"><button type="button" class="btn btn-default btn-lg">
											  <span class="glyphicon glyphicon-tags" aria-hidden="true"></span> PRODUCTOS
											</button></a></center><br><br>
				    					</div>
				    					<div class="col-xs-12 col-sm-4 ">
				    						<center><a href="reportesext.php"><button type="button" class="btn btn-default btn-lg">
											  <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span> EXTERNOS
											</button></a></center><br><br>
				    						
				    					</div>
				    					
				    				</div>
				    				
				    			</div>
				    		<br>
						    
					    	
						    <center>
						    
						    </center>
					    	</div>
					    	</div>
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
</body>
</html>


		