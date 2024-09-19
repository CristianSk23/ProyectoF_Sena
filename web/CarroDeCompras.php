<TITle>Carro de compras</TITle>
<?php
include_once "../view/partials/header.php";

?>

<?php
if (isset($_SESSION['error'])) {
    ?>
    <div class="alert">
        <div class='alert alert-danger' role="alert">
            <?php echo $_SESSION['error']; ?>
        </div>
    </div>
<?php } ?>
<?php
unset($_SESSION['error']);
?>

<body class="animsition">
    <!-- Shoping Cart -->
    <form class="bg0 p-t-75 p-b-85" action="<?php echo getUrl('CarroDeCompras', 'Venta', 'registroEnvio'); ?>"
        method="POST">

        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                    <div class="m-l-25 m-r--38 m-lr-0-xl">
                        <div class="wrap-table-shopping-cart">
                            <?php include_once "../web/vista_parcial_carro.php"; ?>
                        </div>

                    </div>
                </div>



                <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                    <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                        <h4 class="mtext-109 cl2 p-b-30">
                            Total Carro de Compras
                        </h4>

                        <div class="flex-w flex-t bor12 p-b-13">
                            <div class="size-208">
                                <span class="stext-110 cl2">
                                    Subtotal:
                                </span>
                            </div>

                            <div class="size-209">
                                <span class="mtext-110 cl2">
                                    <span id="total-precio" name="total"><?php echo number_format($total); ?></span>
                                </span>
                            </div>
                        </div>

                        <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                            <div class="size-208 w-full-ssm">
                                <span class="stext-110 cl2">
                                    Datos de envio:
                                </span>
                            </div>

                            <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                                <p class="stext-111 cl6 p-t-2">
                                    información relevante para los datos de envio
                                </p>

                                <div class="p-t-15">
                                    <span class="stext-112 cl8">
                                        Calcular envio
                                    </span>

                                    <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                                        <select class="js-select2" name="ciudad" id="select-ciudad"
                                            data-url="<?= getUrl('CarroDeCompras', 'CarroDeCompras', 'precioEnvioPorCiudad', false, 'ajax') ?>">
                                            <option>Selecciona tu Ciudad</option>
                                            <?php foreach ($ciudades as $ciudad): ?>
                                                <option value="<?php echo htmlspecialchars($ciudad['ciu_id']); ?>"
                                                    name="ciu_id">
                                                    <?php echo htmlspecialchars($ciudad['ciu_nombre']); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>

                                    <div class="bor8 bg0 m-b-12">
                                        <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="state"
                                            id="valor-envio" placeholder="Valor de Envío">
                                    </div>

                                    <div class="bor8 bg0 m-b-22">
                                        <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text"
                                            name="direccion_envio" placeholder="Dirección Envio">
                                    </div>
                                    <span class="stext-112 cl8">
                                        Metodo de pago
                                    </span>
                                    <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                                        <select class="js-select2" name="metodo_pago" id="select-metodo">
                                            <option>Selecciona...</option>
                                            <?php foreach ($metodos as $metodo): ?>
                                                <option value="<?php echo htmlspecialchars($metodo['idMetodo_pago']); ?>">
                                                    <?php echo htmlspecialchars($metodo['descripcionMetodo_pago']); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                    <div class="bor8 bg0 m-b-22">
                                        <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="cuenta"
                                            placeholder="No.Tarjeta/Cuenta">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex-w flex-t p-t-27 p-b-33">
                            <div class="size-208">
                                <span class="mtext-101 cl2">
                                    Total:
                                </span>
                            </div>

                            <div class="size-209 p-t-1">
                                <span class="mtext-110 cl2">
                                    $
                                </span>
                                <input type="hidden" name="total_con_envio" id="total-con-envio" value="">

                            </div>
                        </div>

                        <button type="submit"
                            class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer"
                            data-toggle="modal" data-target="#exampleModal">
                            Finalizar Compra
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">CONFIRMACION DE COMPRA</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ¡La compra se realizo con exito!
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Modal de Confirmación -->




    <!-- Footer -->
    <?php
    include_once "../view/partials/footer.php";
    ?>


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
        $(".js-select2").each(function () {
            $(this).select2({
                minimumResultsForSearch: 20,
                dropdownParent: $(this).next('.dropDownSelect2')
            });
        })




        $(document).ready(function () {
            // Evento para disminuir la cantidad
            $('.redicir-carro').on('click', function () {
                var input = $(this).siblings('.num-product');
                var cantidad = parseInt(input.val());
                if (cantidad > 1) {
                    input.val(cantidad - 1);
                }
            });

            // Evento para aumentar la cantidad
            $('.aumentar-carro').on('click', function () {
                let input = $(this).siblings('.num-product');
                console.log(input);

                let numProduct = Number(input.val());
                let maxStock = Number(input.attr('max'));
                let maxStockparse = maxStock - 1;
                if (numProduct < maxStockparse) {
                    let suma = numProduct + 1;
                    input.val(suma);
                }
            });

            // Manejo del envío del formulario
            $('form').on('submit', function (event) {
                // Prevenir el envío del formulario por defecto
                event.preventDefault();

                // Limpiar los valores de los campos ocultos
                $('.cantidad-hidden').remove(); // Remover campos ocultos previos

                // Iterar sobre los inputs de cantidad
                $('.num-product').each(function () {
                    // Obtener el valor de cantidad
                    let cantidad = $(this).val();
                    // Obtener el id del producto
                    let productoId = $(this).data('producto-id');

                    // Crear un nuevo campo oculto para la cantidad
                    $('<input>').attr({
                        type: 'hidden',
                        class: 'cantidad-hidden',
                        name: 'cantidad[]',
                        value: cantidad
                    }).appendTo(this.form);

                    // Crear un campo oculto para el ID del producto
                    $('<input>').attr({
                        type: 'hidden',
                        name: 'product_id[]',
                        value: productoId
                    }).appendTo(this.form);
                });

                // Enviar el formulario después de agregar los datos
                this.submit();
            });
        });
    </script>
    <!--===============================================================================================-->
    <script src="vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script>
        $('.js-pscroll').each(function () {
            $(this).css('position', 'relative');
            $(this).css('overflow', 'hidden');
            var ps = new PerfectScrollbar(this, {
                wheelSpeed: 1,
                scrollingThreshold: 1000,
                wheelPropagation: false,
            });

            $(window).on('resize', function () {
                ps.update();
            })
        });
    </script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>

</body>