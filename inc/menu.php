				<a class="btn-menu"><i class="icono glyphicon glyphicon-align-justify"></i></a>
				<ul class="menu">

				
					
						<ul >
							<li ><a href="productos.php">Productos</a></li>
							<li ><a href="externos.php">Externos</a></li>						
						</ul>
					</li>	
					<li ><a href="#"><i class="icono izquierda glyphicon glyphicon-user" ></i>Administrador<i class="icono derecha glyphicon glyphicon-menu-down" ></i></a>
						<ul >
							<li ><a href="stockdispo.php"><?php echo $_SESSION['nombre']; ?></a></li>
							<li ><a href="reportes.php">Reportes</a></li>
						</ul>	
					</li>
					<li><a href="logout.php"><i class="icono izquierda glyphicon glyphicon-off" ></i>Cerrar Sesión</a></li>
				</ul>