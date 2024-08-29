<div class="container-menu-desktop">
	<!-- Topbar -->


	<div class="wrap-menu-desktop">
		<nav class="limiter-menu-desktop container">

			<!-- Logo desktop -->
			<a href="#" class="logo">
				<img src="images/icons/logo-01.png" alt="IMG-LOGO">
			</a>

			<!-- Menu desktop -->
			<div class="menu-desktop">
				<ul class="main-menu">
					<li class="active-menu">
						<a href="index.php">Inicio</a>
					</li>

					<li>
						<a href="product.php">Comprar</a>
					</li>

					<li class="label1" data-label1="hot">
						<a href="shoping-cart.html">Features</a>
					</li>

					<li>
						<a href="blog.html">Blog</a>
					</li>

					<li>
						<a href="about.html">About</a>
					</li>

					<li>
						<a href="contact.html">Contact</a>
					</li>
				</ul>
			</div>

			<!-- Icon header -->
			<div class="wrap-icon-header flex-w flex-r-m">
				<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
					<i class="zmdi zmdi-search"></i>
				</div>

				<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart"
					data-notify="2">
					<i class="zmdi zmdi-shopping-cart"></i>
				</div>

				<a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti"
					data-notify="0">
					<i class="zmdi zmdi-favorite-outline"></i>
				</a>
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
							<li><a class="dropdown-item" href="<?php echo getUrl('Acceso', 'Acceso', 'logout'); ?>">Cerrar
									sesión</a></li>
						<?php else: ?>
							<li><a class="dropdown-item"
									href="<?php echo getUrl('Acceso', 'Acceso', 'login'); ?>">Ingresar</a>
							</li>
							<li><a class="dropdown-item"
									href="<?php echo getUrl('Registro', 'Registro', 'RegistrarC'); ?>">Crear
									cuenta</a>
							</li>
						<?php endif; ?>
					</ul>
				</li>
			</ul>

		</nav>

	</div>
</div>