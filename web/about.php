<?php
include_once '../lib/helpers.php';
?>
<!DOCTYPE html>
<html lang="en">
<TITle>Nosotros</TITle>
<?php
include_once "../view/partials/header.php";
?>



<body class="animsition">
		<?php include_once "../view/partials/navbar.php"; ?>

		<div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
			<div class="container-search-header">
				<button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
					<img src="images/icons/icon-close2.png" alt="CLOSE">
				</button>

				<form class="wrap-search-header flex-w p-l-15">
					<button class="flex-c-m trans-04">
						<i class="zmdi zmdi-search"></i>
					</button>
					<input class="plh3" type="text" name="search" placeholder="Search...">
				</form>
			</div>
		</div>
	

	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/bannerN2.png');">
		<h2 class="ltext-105 cl0 txt-center">
			Nosotros
		</h2>
	</section>	


	<!-- Content page -->
	<section class="bg0 p-t-75 p-b-120">
		<div class="container">
			<div class="row p-b-148">
				<div class="col-md-7 col-lg-8">
					<div class="p-t-7 p-r-85 p-r-15-lg p-r-0-md">
						<h3 class="mtext-111 cl2 p-b-16">
						Mision
						</h3>

						<p class="stext-113 cl6 p-b-26">
						En Naturals Sport, nuestra misión es proporcionar ropa deportiva de alta calidad que potencie el rendimiento y el bienestar de nuestros clientes. Nos comprometemos 
						a diseñar y fabricar productos que combinan innovación, comodidad y estilo, mientras promovemos un estilo de vida activo y saludable. A través de prácticas sostenibles 
						y un enfoque en la satisfacción del cliente, buscamos inspirar a las personas a alcanzar sus metas deportivas y vivir una vida equilibrada.
						</p>

					</div>
				</div>

				<div class="col-11 col-md-5 col-lg-4 m-lr-auto">
					<div class="how-bor1 ">
						<div class="hov-img0">
							<img src="images/naturalsport.jpg" alt="IMG">
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="order-md-2 col-md-7 col-lg-8 p-b-30">
					<div class="p-t-7 p-l-85 p-l-15-lg p-l-0-md">
						<h3 class="mtext-111 cl2 p-b-16">
							Vision
						</h3>

						<p class="stext-113 cl6 p-b-26">
						Nuestra visión en Naturals Sport es ser líderes en la industria de la ropa deportiva, reconocidos por nuestra excelencia en calidad, diseño innovador y 
						compromiso con la sostenibilidad. Aspiramos a ser la primera elección de deportistas y entusiastas del fitness en todo el mundo, contribuyendo al avance del deporte y 
						la vida saludable. Buscamos expandir nuestra presencia global, impactar positivamente en nuestras comunidades y establecer un legado de integridad y excelencia en el sector de la moda deportiva.
						
						</p>

					</div>
				</div>

				<div class="order-md-1 col-11 col-md-5 col-lg-4 m-lr-auto p-b-30">
					<div class="how-bor2">
						<div class="hov-img0">
							<img src="images/ntrs2.jpeg" alt="IMG">
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>	
	
		
	<?php include_once "../view/partials/footer.php"; ?>

	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>

<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<script>
		$(".js-select2").each(function(){
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		})
	</script>
<!--===============================================================================================-->
	<script src="vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script>
		$('.js-pscroll').each(function(){
			$(this).css('position','relative');
			$(this).css('overflow','hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});

			$(window).on('resize', function(){
				ps.update();
			})
		});
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
	
</body>
</html>