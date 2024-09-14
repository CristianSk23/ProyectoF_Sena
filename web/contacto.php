<?php
include_once '../lib/helpers.php';
?>
<!DOCTYPE html>
<html lang="en">
<TITle>Contactenos</TITle>
<?php
include_once "../view/partials/header.php";
?>

<body class="animsition">
	<?php include_once "../view/partials/navbar.php"; ?>
	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/conbanner.png');">
		<h2 class="ltext-105 cl0 txt-center">
			Contacto
		</h2>
	</section>


	<!-- Content page -->
	<section class="bg0 p-t-104 p-b-116">
		<div class="container">
			<div class="flex-w flex-tr">
				<div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
					<form action="https://formspree.io/f/xovaznbq" method="POST">
						<h4 class="mtext-105 cl2 txt-center p-b-30">
							Enviar Mensaje
						</h4>

						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="email" name="email" placeholder="Ingresa tu correo" required>
							<img class="how-pos4 pointer-none" src="images/icons/icon-email.png" alt="ICON">
						</div>

						<div class="bor8 m-b-30">
							<textarea class="stext-111 cl2 plh3 size-120 p-lr-28 p-tb-25" name="msg" placeholder="¿Cómo podemos ayudarte?" required></textarea>
						</div>

						<button class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer" type="submit">
							Enviar
						</button>
					</form>
				</div>


				<div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
					<div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-map-marker"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Direccion
							</span>

							<p class="stext-115 cl6 size-213 p-t-18" id="address">
								Carrera 32A No. 34B 04, Santiago de Cali, Colombia
							</p>
						</div>
					</div>

					<div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-phone-handset"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Llamanos
							</span>

							<p class="stext-115 cl1 size-213 p-t-18" id="phone">
								+57 800 1236879
							</p>
						</div>
					</div>

					<div class="flex-w w-full">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-envelope"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Correo
							</span>

							<p class="stext-115 cl1 size-213 p-t-18" id="email">
								naturalsportwear@gmail.com
							</p>
						</div>
					</div><br><br>
					<?php if (isset($_SESSION['usu_id']) && $_SESSION['rol_id'] == 1): ?>
						<div class="d-flex justify-content-between align-items-center mb-3">
							<button class="btn btn-primary" id="edit-button">
								<i class="fa-solid fa-pen-to-square fa-lg me-1" style="color: #0fcedb;"></i> Editar
							</button>

							<button class="btn btn-primary d-none" id="save-button">
								<i class="fa-solid fa-save fa-lg me-1" style="color: #0fcedb;"></i> Guardar
							</button>
						</div>
					<?php endif; ?>
				</div>
			</div>
	</section>

	<!-- Map -->
	<div class="map">
		<div class="size-303" id="google_map" data-map-x="40.691446" data-map-y="-73.886787" data-pin="images/icons/pin.png" data-scrollwhell="0" data-draggable="1" data-zoom="11"></div>
	</div>

	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>

	<?php
	include_once "../view/partials/footer.php";
	?>
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
		$(".js-select2").each(function() {
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
		$('.js-pscroll').each(function() {
			$(this).css('position', 'relative');
			$(this).css('overflow', 'hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});

			$(window).on('resize', function() {
				ps.update();
			})
		});
	</script>
	<!--===============================================================================================-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKFWBqlKAGCeS1rMVoaNlwyayu0e0YRes"></script>
	<script src="js/map-custom.js"></script>
	<!--===============================================================================================-->
	<script src="js/main.js"></script>
	<!--================ Script para editar campos===============================================================================-->
	<script>
		// Función para cargar datos desde el localStorage al recargar la página
		function loadData() {
			let savedAddress = localStorage.getItem('address') || 'Carrera 32A No. 34B 04, Santiago de Cali, Colombia';
			let savedPhone = localStorage.getItem('phone') || '+57 800 1236879';
			let savedEmail = localStorage.getItem('email') || 'naturalsportwear@gmail.com';

			document.getElementById('address').textContent = savedAddress;
			document.getElementById('phone').textContent = savedPhone;
			document.getElementById('email').textContent = savedEmail;
		}

		// Llama a la función loadData() cuando la página se carga
		document.addEventListener('DOMContentLoaded', loadData);

		document.getElementById('edit-button').addEventListener('click', function() {
			// Ocultar el botón de editar y mostrar el botón de guardar
			document.getElementById('edit-button').classList.add('d-none');
			document.getElementById('save-button').classList.remove('d-none');

			// Convertir los párrafos a campos de texto editables
			let address = document.getElementById('address');
			let phone = document.getElementById('phone');
			let email = document.getElementById('email');

			address.innerHTML = `<input type="text" id="input-address" value="${address.textContent.trim()}">`;
			phone.innerHTML = `<input type="text" id="input-phone" value="${phone.textContent.trim()}">`;
			email.innerHTML = `<input type="text" id="input-email" value="${email.textContent.trim()}">`;
		});

		document.getElementById('save-button').addEventListener('click', function() {
			// Obtener los valores de los campos de texto
			let newAddress = document.getElementById('input-address').value;
			let newPhone = document.getElementById('input-phone').value;
			let newEmail = document.getElementById('input-email').value;

			// Actualizar los párrafos con los nuevos valores
			document.getElementById('address').textContent = newAddress;
			document.getElementById('phone').textContent = newPhone;
			document.getElementById('email').textContent = newEmail;

			// Guardar los cambios en localStorage
			localStorage.setItem('address', newAddress);
			localStorage.setItem('phone', newPhone);
			localStorage.setItem('email', newEmail);

			// Mostrar el botón de editar y ocultar el botón de guardar
			document.getElementById('edit-button').classList.remove('d-none');
			document.getElementById('save-button').classList.add('d-none');
		});
	</script>

</body>

</html>