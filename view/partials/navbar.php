

	<div class="container-menu-desktop">
		<!-- Topbar -->
		<div class="wrap-menu-desktop">
			<nav class="limiter-menu-desktop container">
				<!-- Logo desktop -->
				<a href="#" class="logo">
					<img src="images/icons/ntrSport Logo1.png" alt="IMG-LOGO">
				</a>

				<!-- Botón toggle para pantallas pequeñas -->
				<button class="navbar-toggler" type="button" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<!-- Menu desktop -->
				<div class="menu-desktop">
					<ul class="main-menu">
						<li class="active-menu">
							<a href="index.php">Inicio</a>
						</li>

						<li>
							<a href="product.php">Comprar</a>
						</li>

						<li>
							<a href="about.php">Nosotros</a>
						</li>

						<li>
							<a href="contacto.php">Contacto</a>
						</li>

						<?php if (isset($_SESSION['usu_id']) && $_SESSION['rol_id'] == 1): ?>
							<li>
								<a href="#">Configuracion</a>
								<ul class="sub-menu">
									<li>
										<a href="<?php echo getUrl("Configuracion", "Usuario", "registrarUsuario"); ?>">Gestion
											Usuarios</a>
									</li>
									<li>
										<a href="<?php echo getUrl("Configuracion", "Producto", "getInsert"); ?>">Gestion
											Productos</a>
									</li>
									<li>
										<a href="<?php echo getUrl("Configuracion", "Stock", "getInsert"); ?>">Gestion Stock</a>
									</li>

								</ul>
							</li>
						<?php endif; ?>
					</ul>
				</div>

				<!-- Icon header -->
				<div class="wrap-icon-header flex-w flex-r-m">
					<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
						<i class="zmdi zmdi-search"></i>
					</div>

					<?php if (isset($_SESSION['nombre'])): ?>
						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart"
							data-notify="0"
							data-url="<?php echo getUrl("CarroDeCompras", "CarroDeCompras", "obtenerCarro", false, 'ajax'); ?>"
							data-id-usuario="<?php echo $_SESSION['usu_id']; ?>">
							<i class="zmdi zmdi-shopping-cart"></i>
						</div>
					<?php endif; ?>


				</div>

				<ul class="navbar-nav">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPerfil" role="button"
							data-bs-toggle="dropdown" aria-expanded="false">
							<?php if (isset($_SESSION['nombre'])): ?>
								<?= $_SESSION['nombre'] ?>
							<?php else: ?>
								Mi cuenta
							<?php endif; ?>
						</a>
						<ul class="dropdown-menu" aria-labelledby="navbarDropdownPerfil">
							<?php if (isset($_SESSION['nombre'])): ?>
								<li><a class="dropdown-item"
										href="<?php echo getUrl('Configuracion', 'Usuario', 'consultarCliente'); ?>">Mi
										cuenta</a></li>
								<li><a class="dropdown-item" href="<?php echo getUrl('Acceso', 'Acceso', 'logout'); ?>">Cerrar
										sesión</a></li>
							<?php else: ?>
								<li><a class="dropdown-item" href="login.php">Ingresar</a></li>
								<li><a class="dropdown-item" href="registro.php">Crear cuenta</a></li>
							<?php endif; ?>
						</ul>
					</li>
				</ul>
			</nav>
		</div>
		
	</div>
