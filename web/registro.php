<?php include_once "../lib/helpers.php"; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="stylesheet" href="styleLogin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
</head>

<section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
                        <!-- Mensajes de Error -->
                        <div class="d-flex justify-content-center">
                            <?php
                            if (isset($_SESSION["error"])) {
                            ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?= $_SESSION['error'] ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php
                                unset($_SESSION["error"]);
                            }
                            if (isset($_SESSION['success'])) {
                            ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <?= $_SESSION['success'] ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php
                                unset($_SESSION["success"]);
                            }

                            if (isset($_SESSION["errorEmpty"])) {
                            ?>
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <?= $_SESSION['errorEmpty'] ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php
                                unset($_SESSION["errorEmpty"]);
                            }
                            ?>
                        </div>

                        <div class="mb-md-5 mt-md-4 pb-5">
                            <form action="<?php echo getUrl("Registro", "Registro", "RegistrarC", array("id" => 1)); ?>" method="POST">

                                <!-- Título -->
                                <h2 class="fw-bold mb-2 text-uppercase">Registrarse</h2>

                                <!-- Nombre -->
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <label class="form-label" for="registerName">Nombre</label>
                                    <input type="text" id="registerName" name="nombre" class="form-control" required autocomplete="given-name" />
                                </div>

                                <!--Apellido-->
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <label class="form-label" for="registroApellido">Apellido</label>
                                    <input type="text" id="registroApellido" name="apellido" class="form-control" required autocomplete="family-name" />
                                </div>

                                <!-- Email -->
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <label class="form-label" for="registerEmail">Correo</label>
                                    <input type="email" id="registerEmail" name="emailC" class="form-control" required autocomplete="email" />
                                </div>

                                <!-- Contraseña -->
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <label class="form-label" for="password1">Contraseña</label>
                                    <input type="password" id="password1" name="password" class="form-control" required autocomplete="new-password" />
                                </div>

                                <!-- Confirmar Contraseña -->
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <label class="form-label" for="repeatPassword1">Confirmar Contraseña</label>
                                    <input type="password" id="repeatPassword1" name="repeatPassword" class="form-control" required autocomplete="new-password" />
                                </div>

                                <!-- Términos -->
                                <div class="form-check d-flex justify-content-center mb-4">
                                    <input class="form-check-input me-2" type="checkbox" value="" id="registerCheck" required />
                                    <label class="form-check-label" for="registerCheck">
                                        He leído y acepto los <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">términos</a>.
                                    </label>
                                </div>
                                <!-- Modal de Términos y Condiciones -->
                                <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="termsModalLabel" style="color : black">Términos y Condiciones</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p style="color : black">Bienvenido a Natural Sport. Al acceder y utilizar nuestro sitio web, usted acepta cumplir y estar sujeto a los siguientes términos y condiciones. Si no está de acuerdo con estos términos, por favor no utilice nuestro sitio web.<br>
                                                    1. Introducción
                                                    Natural Sport (en adelante, "nosotros" o "nuestro") es una empresa dedicada a la comercialización de ropa deportiva. Estos términos y condiciones rigen el uso de nuestro sitio web y la compra de productos a través del mismo.<br>

                                                    2. Uso del Sitio Web
                                                    El contenido de este sitio web es solo para su uso personal y no comercial. Usted acepta utilizar el sitio de manera responsable y cumplir con todas las leyes aplicables. Queda prohibido:
                                                    Modificar, distribuir, transmitir, reproducir, publicar, licenciar, crear trabajos derivados, transferir o vender cualquier información, software, productos o servicios obtenidos del sitio web.
                                                    Utilizar el sitio web para cualquier propósito ilegal o no autorizado.<br>
                                                    3. Registro de Usuarios
                                                    Para realizar compras a través de nuestro sitio web, puede ser necesario registrarse y crear una cuenta. Usted es responsable de mantener la confidencialidad de su información de cuenta y contraseña, 
                                                    así como de todas las actividades que ocurran bajo su cuenta. Nos reservamos el derecho de rechazar el servicio, cerrar cuentas o cancelar pedidos a nuestra discreción.<br>

                                                    4. Compras y Pagos
                                                    Los precios de los productos están indicados en la moneda local y pueden estar sujetos a cambios sin previo aviso. El pago de los productos se realizará a través de los métodos de pago disponibles en el sitio web. Al confirmar su compra, usted se compromete a proporcionar información de pago válida y precisa.<br>

                                                    5. Política de Envíos y Devoluciones
                                                    Envíos: Los pedidos se enviarán a la dirección proporcionada durante el proceso de compra. Los tiempos de entrega son estimados y pueden variar según la ubicación del destinatario.<br>

                                                    Devoluciones: Usted puede devolver los productos no utilizados y en su embalaje original dentro de los 15 días posteriores a la recepción del pedido. Para más detalles, consulte nuestra política de devoluciones en el sitio web.<br>

                                                    6. Propiedad Intelectual
                                                    Todos los contenidos del sitio web, incluidos los textos, gráficos, logotipos, imágenes y software, son propiedad de Natural Sport o de sus proveedores y están protegidos por las leyes de propiedad intelectual. Queda prohibida la reproducción, distribución o exhibición de cualquier contenido sin el permiso expreso de Natural Sport.<br>

                                                    7. Contenido del Usuario
                                                    Si usted envía comentarios, sugerencias, ideas u otros contenidos a través del sitio web, nos concede el derecho no exclusivo, libre de regalías, perpetuo, irrevocable y sublicenciable para utilizar, reproducir, modificar, adaptar, publicar, traducir, crear trabajos derivados, distribuir y exhibir dicho contenido en todo el mundo en cualquier medio.<br>

                                                    8. Enlaces a Sitios de Terceros
                                                    Nuestro sitio web puede contener enlaces a otros sitios web que no son operados por nosotros. No tenemos control sobre el contenido y las prácticas de esos sitios y no asumimos responsabilidad alguna por ellos.<br>

                                                    9. Limitación de Responsabilidad
                                                    Natural Sport no será responsable de ningún daño directo, indirecto, incidental, especial o consecuente que resulte del uso o la incapacidad de usar nuestro sitio web o productos, incluso si hemos sido informados de la posibilidad de tales daños.<br>

                                                    10. Modificaciones a los Términos y Condiciones
                                                    Nos reservamos el derecho de modificar estos términos y condiciones en cualquier momento. Las modificaciones serán efectivas a partir de su publicación en el sitio web. Se recomienda revisar periódicamente los términos y condiciones para estar informado de cualquier cambio.<br>

                                                    11. Ley Aplicable y Jurisdicción
                                                    Estos términos y condiciones se rigen por las leyes de Colombia. Cualquier disputa que surja en relación con estos términos y condiciones estará sujeta a la jurisdicción exclusiva de los tribunales de [Ciudad], Colombia.<br>

                                                    12. Contacto
                                                    Si tiene alguna pregunta o comentario sobre estos términos y condiciones, por favor contáctenos en:

                                                    Correo Electrónico: naturalsportwear@gmail.com
                                                    Dirección: Carrera 32A No. 34B 04, Santiago de Cali, Colombia
                                                    Teléfono: +57 800 1236879
                                                </p>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Botón de Envío -->
                                <button type="submit" class="btn btn-primary btn-block mb-3">Registrarse</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>