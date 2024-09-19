<body class="animsition">
    <!-- Banner -->
    <div class="sec-banner bg0 p-t-95 p-b-55">
        <div class="container">
            <div class="row">
                <div class="col-md-6 p-b-30 m-lr-auto">
                    <!-- Block1 -->
                    <div class="block1 wrap-pic-w">
                        <img src="images/mujer.png" alt="IMG-BANNER">

                        <a href="product.php"
                            class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                            <div class="block1-txt-child1 flex-col-l">
                                <span class="block1-name ltext-102 trans-04 p-b-8">
                                    Mujer
                                </span>

                                <span class="block1-info stext-102 trans-04">
                                    Lo nuevo
                                </span>
                            </div>

                            <div class="block1-txt-child2 p-b-4 trans-05">
                                <div class="block1-link stext-101 cl0 trans-09">
                                    ¡Comprar ahora!
                                </div>
                            </div>
                        </a>
                    </div>
                </div>



                <div class="col-md-6 p-b-30 m-lr-auto">
                    <!-- Block1 -->
                    <div class="block1 wrap-pic-w">
                        <img src="images/hombre.png" alt="IMG-BANNER">

                        <a href="product.php"
                            class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                            <div class="block1-txt-child1 flex-col-l">
                                <span class="block1-name ltext-102 trans-04 p-b-8">
                                    Hombre
                                </span>

                                <span class="block1-info stext-102 trans-04">
                                    Lo nuevo
                                </span>
                            </div>

                            <div class="block1-txt-child2 p-b-4 trans-05">
                                <div class="block1-link stext-101 cl0 trans-09">
                                    ¡Comprar ahora!
                                </div>
                            </div>
                        </a>
                    </div>
                </div>


            </div>
        </div>
    </div>


    <!-- Product -->
    <section class="bg0 p-t-23 p-b-130">
        <div class="container">
            <div class="p-b-10">
                <h3 class="ltext-103 cl5">
                    Productos
                </h3>
            </div>

            <div class="flex-w flex-sb-m p-b-52">
                <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
                        Todos los productos
                    </button>

                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter="1">
                        Mujer
                    </button>

                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter="hombre">
                        Hombre
                    </button>

                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter="ciclismo">
                        Ciclismo
                    </button>

                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter="gym">
                        Gym
                    </button>
                </div>
            </div>


            <?php
            include_once "../controller/Productos/ProductosController.php";
            $controller = new ProductosController();
            $resultados = $controller->productos();
            ?>


            <div class="row">
                <?php foreach ($resultados as $resultado): ?>
                    <?php
                    $precio = "";
                    $mostrarProducto = false;
                    $fotos_prod = $resultado['fotos'];


                    // Verifica si hay detalles del producto
                    if ($resultado["detalles"]) {
                        $prod_detalle = $resultado["detalles"];
                        foreach ($prod_detalle as $detalle) {
                            // Si el stock es mayor a 1, se marca para mostrar
                            if (isset($detalle["stock_precio"]) && $detalle["stock_precio"] > 1) {
                                $precio = $detalle["stock_precio"];
                                $mostrarProducto = true;
                                break;
                            }
                        }
                    }

                    // Solo mostramos el producto si $mostrarProducto es verdadero
                    if ($mostrarProducto):
                        ?>
                        <div class="col-sm-6 col-md-4 col-lg-3 p-b-35">

                            <?php



                            ?>
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-pic hov-img0">
                                    <img src="<?= $fotos_prod; ?>" alt="IMG-PRODUCT">
                                    <a href="<?php echo getUrl('Productos', 'Productos', 'detalleProducto', array('id' => $resultado['product_id'])); ?>"
                                        class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                                        Ver detalle
                                    </a>
                                </div>

                                <div class="block2-txt flex-w flex-t p-t-14">
                                    <div class="block2-txt-child1 flex-col-l">
                                        <a class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                            <?= $resultado['product_nombre']; ?>
                                        </a>

                                        <span class="stext-105 cl3">
                                            $
                                            <?php
                                            $precioConvertido = floatval($precio);
                                            echo number_format($precioConvertido);
                                            ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>




            <!-- Pagination -->
            <div class="flex-c-m flex-w w-full p-t-38">
                <a href="#" class="flex-c-m how-pagination1 trans-04 m-all-7 active-pagination1">
                    1
                </a>

                <a href="#" class="flex-c-m how-pagination1 trans-04 m-all-7">
                    2
                </a>
            </div>
        </div>
    </section>







    <!-- Back to top -->
    <div class="btn-back-to-top" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <i class="zmdi zmdi-chevron-up"></i>
        </span>
    </div>

    <!-- Modal1 -->



    </html>
    <!--  -->

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
    </script>
    <!--===============================================================================================-->
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/slick/slick.min.js"></script>
    <script src="js/slick-custom.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/parallax100/parallax100.js"></script>
    <script>
        $('.parallax100').parallax100();
    </script>
    <!--===============================================================================================-->
    <script src="vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
    <script>
        $('.gallery-lb').each(function () { // the containers for all your galleries
            $(this).magnificPopup({
                delegate: 'a', // the selector for gallery item
                type: 'image',
                gallery: {
                    enabled: true
                },
                mainClass: 'mfp-fade'
            });
        });
    </script>
    <!--===============================================================================================-->
    <script src="vendor/isotope/isotope.pkgd.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/sweetalert/sweetalert.min.js"></script>
    <script>
        $('.js-addwish-b2').on('click', function (e) {
            e.preventDefault();
        });

        $('.js-addwish-b2').each(function () {
            var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
            $(this).on('click', function () {
                swal(nameProduct, "is added to wishlist !", "success");

                $(this).addClass('js-addedwish-b2');
                $(this).off('click');
            });
        });

        $('.js-addwish-detail').each(function () {
            var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

            $(this).on('click', function () {
                swal(nameProduct, "is added to wishlist !", "success");

                $(this).addClass('js-addedwish-detail');
                $(this).off('click');
            });
        });

        /*---------------------------------------------*/

        $('.js-addcart-detail').each(function () {
            var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
            $(this).on('click', function () {
                swal(nameProduct, "is added to cart !", "success");
            });
        });
    </script>
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Selecciona los botones de filtro usando la clase correcta
            const filterButtons = document.querySelectorAll('.filter-tope-group button');
            const items = document.querySelectorAll('.isotope-item');

            filterButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const filterValue = this.getAttribute('data-filter');

                    // Cambia la clase activa del botón
                    filterButtons.forEach(btn => btn.classList.remove('how-active1'));
                    this.classList.add('how-active1');

                    items.forEach(item => {
                        if (filterValue === '*' || item.classList.contains(filterValue)) {
                            item.style.display = 'block';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });
            });
        });
    </script>


</body>

</html>