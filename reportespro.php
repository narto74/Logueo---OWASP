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
					    	
							<a href="reportes.php" > <button type="button"  style="float: right;" class="col-xs-6 col-sm-1 btn btn-success" ><span class="glyphicon glyphicon-hand-left"></span> Volver </button></a>
					    	
						</div>				
					</div>
					<div class="contenedor-section col-xs-12 panel-body">
						<div class="container ">
				    		<div class="row ">
				    		<div class="  col-xs-12 col-sm-12">
				    		<br>
				    		<h4 class="modal-title"><i class="glyphicon glyphicon-edit"></i> Productos</h4>
				    		<br>	
						    <table border="0" align="center">
						    	<tr>
						        	
						            <td><input type="date" id="bd-desde"/></td>
						            <td>Hasta&nbsp;&nbsp;&nbsp;&nbsp;</td>
						            <td><input type="date" id="bd-hasta"/></td>
						            
						            
						        </tr>
				   			</table>
					    	<div class="registros" id="agrega-registros"></div>
						    <center>
						        <ul class="pagination" id="pagination"></ul>
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


		