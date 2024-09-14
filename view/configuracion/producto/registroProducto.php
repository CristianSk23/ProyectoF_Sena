<div class="container">
    <div class="mt-5">
        <h4 class="display-4">Registrar Producto</h4>
    </div>
    <form class="row g-3 mt-5" method="post" action="<?php echo getUrl('Configuracion', 'Producto', 'postInsert'); ?>" enctype="multipart/form-data">



        <!-- Tipo de Prenda -->
        <div class="form-group col-md-4 mt-4">
            <label for="tipo">Tipo de prenda</label>
            <select class="form-control" name="tipo">
                <option selected disabled value="">Seleccione...</option>
                <?php foreach ($tipos as $tipo): ?>
                    <option value="<?= $tipo['tipo_id']; ?>"><?= $tipo['tipo_nombre']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Nombre del Producto -->
        <div class="form-group col-md-4 mt-4">
            <label for="nombre">Nombre del Producto</label>
            <input type="text" class="form-control" id="nombre" name="nombreProducto" placeholder="Ingrese el nombre del producto">
        </div>

        <!-- Categoría -->
        <div class="form-group col-md-4 mt-4">
            <label for="categoria">Categoría</label>
            <select class="form-control" name="categoria">
                <option selected disabled value="">Seleccione...</option>
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?= $categoria['categoria_id']; ?>"><?= $categoria['categoria_nombre']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Descripción del Producto -->
        <div class="form-group col-md-8 mt-4">
            <label for="descripcionProducto">Descripción del Producto</label>
            <textarea class="form-control" id="descripcionProducto" name="descripcionProducto" rows="4" placeholder="Ingrese una descripción del producto"></textarea>
        </div>



        <!-- Género -->
        <div class="form-group col-md-4 mt-4">
            <label for="genero">Género</label>
            <select class="form-control" name="genero">
                <option selected disabled value="">Seleccione...</option>
                <?php foreach ($generos as $genero): ?>
                    <option value="<?= $genero['genero_id']; ?>"><?= $genero['genero_nombre']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Imagen del Producto -->
        <div class="form-group col-md-5 mt-4">
            <label for="imagen">Agregar fotos del producto</label>
            <input type="file" class="form-control" name="stock_img[]" id="imageInput" multiple>
        </div>

        <br>
        <?php if (isset($_SESSION['datosIncorrectos'])): ?>
            <div class="alert alert-danger alert-dismissible fade show col-md-12" role="alert">
                <?= $_SESSION['datosIncorrectos'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
            unset($_SESSION['datosIncorrectos']);
        endif;
        ?>
        <br>

        <!-- Botón de Registro -->
        <div class="col-12 mt-4">
            <button class="btn btn-primary" type="submit">Registrar Producto</button>
        </div>

        <!-- Botón para Consultar Productos Registrados -->
        <div class="col-12 mt-2">
            <a href="<?php echo getUrl('Configuracion', 'Producto', 'consultar'); ?>" class="btn btn-primary">Consultar Productos</a>
        </div>

        <div class="col-12 mt-4">
        </div>

    </form>
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