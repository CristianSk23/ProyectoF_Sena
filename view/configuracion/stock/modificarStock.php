<div class="container">
    <div class="mt-5">
        <h4 class="display-4">Editar Stock</h4>
    </div>

    <?php foreach ($stocks as $stock): ?>
        <form class="row g-3 mt-5" method="post" action="<?php echo getUrl("Configuracion", "Stock", "modificacion") ?>">

            <!-- Nombre de prenda -->
            <div class="form-group col-md-4">
                <label for="nombrePrenda">Nombre de prenda</label>
                <select class="form-control" name="idPrenda">
                    <option value="<?= $stock['product_id']; ?>"><?= $stock['product_nombre']; ?></option>
                    <?php foreach ($productos as $producto): ?>
                        <option value="<?= $producto['product_id']; ?>"><?= $producto['product_nombre']; ?></option>
                    <?php endforeach; ?>
                </select>

            </div>


            <!-- Talla -->
            <div class="form-group col-md-4">
                <label for="talla">Talla</label>
                <select class="form-control" name="talla">
                    <option ><?= $stock['stock_talla']; ?></option>
                    <option>S</option>
                    <option>M</option>
                    <option>L</option>
                    <option>XL</option>
                    <option>XXL</option>
                    <option>Única</option>
                </select>
            </div>

            <!-- Color -->
            <div class="col-md-4">
                <label for="color" class="form-label">Color</label>
                <input type="text" class="form-control" id="color" name="color" value="<?= $stock['stock_color']; ?>">
                <input type="hidden" name="idStock" value="<?= $stock['stock_id']; ?>">

            </div>

            <!-- Precio -->
            <div class="col-md-4">
                <label for="precio" class="form-label">Precio</label>
                <input type="text" class="form-control" id="precio" name="precio" value="<?= $stock['stock_precio']; ?>" placeholder="Ingrese el precio">
            </div>

            <!-- Cantidad -->
            <div class="col-md-4">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="text" class="form-control" id="cantidad" name="cantidad" value="<?= $stock['stock_cantidad']; ?>">
            </div>

            <!-- Botones de acción -->
            <div class="col-12 mt-4">
                <button class="btn btn-primary" type="submit">Actualizar Stock</button>
            </div>
            <div class="col-12 mt-4">
            </div>
        </form>
    <?php endforeach; ?>
</div>
<script>
    var headerDesktop = $('.container-menu-desktop');
    var wrapMenu = $('.wrap-menu-desktop');

    if ($('.top-bar').length > 0) {
        var posWrapHeader = $('.top-bar').height();
    } else {
        var posWrapHeader = 0;
    }


    if ($(window).scrollTop() > posWrapHeader) {
        $(headerDesktop).addClass('fix-menu-desktop');
        $(wrapMenu).css('top', 0);
    } else {
        $(headerDesktop).removeClass('fix-menu-desktop');
        $(wrapMenu).css('top', posWrapHeader - $(this).scrollTop());
    }

    $(window).on('scroll', function() {
        if ($(this).scrollTop() > posWrapHeader) {
            $(headerDesktop).addClass('fix-menu-desktop');
            $(wrapMenu).css('top', 0);
        } else {
            $(headerDesktop).removeClass('fix-menu-desktop');
            $(wrapMenu).css('top', posWrapHeader - $(this).scrollTop());
        }
    });
</script>