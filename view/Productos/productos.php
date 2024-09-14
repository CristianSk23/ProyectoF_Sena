<?php
include_once "../controller/Productos/ProductosController.php";
$controller = new ProductosController();
$resultados = $controller->productos();
?>

<div class="row isotope-grid">
    <!-- Botones de filtro -->

    <!-- Productos -->
    <?php foreach ($resultados as $resultado): ?>
        <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item <?= htmlspecialchars($resultado['category']); ?>">
            <div class="block2">
                <div class="block2-pic hov-img0">
                    <img src="<?= htmlspecialchars($resultado['product_img']); ?>" alt="IMG-PRODUCT">

                    <a href="#"
                        class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                        Ver detalle
                    </a>
                </div>

                <div class="block2-txt flex-w flex-t p-t-14">
                    <div class="block2-txt-child1 flex-col-l">
                        <a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                            <?= htmlspecialchars($resultado['product_nombre']); ?>
                        </a>

                        <span class="stext-105 cl3">
                            <?= htmlspecialchars($resultado['product_precio']); ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>

