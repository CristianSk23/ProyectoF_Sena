<div class="container">
    <div class="mt-5">
        <h4 class="display-4">Consulta Stock</h4>
    </div>
    <div class="row mt-12">
    <br>
        <?php
            if (isset($_SESSION['mensajes']) && !empty($_SESSION['mensajes'])) {
                foreach ($_SESSION['mensajes'] as $msg) {
            ?>
                    <div class="alert">
                        <div class="alert <?= $msg['alert'] ?> alert-dismissible fade show col-md-12" role="alert">
                            <?= $msg['mensaje'] ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                <?php } 
            
                unset($_SESSION['mensajes']);
                
            }
            
            ?>
        <br>
        <table class="table table-bordered" id="tablaStock">
            <thead>
                <tr>
                    <th scope="col">Nombre de producto</th>
                    <th scope="col">Talla</th>
                    <th scope="col">Color prenda</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Acciones de edición</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($stocks)): ?>
                    <?php foreach ($stocks as $stock): ?>
                        <tr>
                            <td class="idStock" data-id="<?= $stock['stock_id'] ?>"><?= $stock['product_nombre']; ?></td>
                            <td><?= $stock['stock_talla']; ?></td>
                            <td><?= $stock['stock_color']; ?></td>
                            <td><?= $stock['stock_precio']; ?></td>
                            <td><?= $stock['stock_cantidad']; ?></td>
                            <td>
                                <a title="Editar" href="<?php echo getUrl("Configuracion", "Stock", "modificar", array("stock_id" => $stock['stock_id'])); ?>">
                                    <button class="btn btn-primary actualizar">
                                        <i class="fa-solid fa-pen-to-square fa-lg me-1" style="color: #0fcedb;"></i>
                                    </button>
                                </a>
                                <button class="btn btn-danger eliminar" data-url="<?php echo getUrl("Configuracion", "Stock", "eliminar") ?>">
                                    <i class="fa-sharp fa-solid fa-trash-can fa-lg" style="color: #fb6a6a;"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No se encontraron productos en stock activos.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    // Inicializar DataTable con opciones personalizadas
    var tabla = document.querySelector("#tablaStock");
    var dataTable = new DataTable(tabla, {
        paging: true,
        ordering: true,
        searching: true,
        autoWidth: false, // Desactiva el ajuste automático de ancho
        columnDefs: [{
                width: "40%",
                targets: 0
            }, // Establece el ancho de la columna 'Nombre de producto'
            {
                width: "10%",
                targets: 1
            }, // Establece el ancho de la columna 'Talla'
            {
                width: "15%",
                targets: 2
            }, // Establece el ancho de la columna 'Color prenda'
            {
                width: "10%",
                targets: 3
            }, // Establece el ancho de la columna 'Precio'
            {
                width: "5%",
                targets: 4
            }, // Establece el ancho de la columna 'Cantidad'
            {
                width: "10%",
                targets: 5
            } // Establece el ancho de la columna 'Acciones de edición'
        ]
    });





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

<!-- CSS personalizado -->
<style>
    /* Ajustar el borde del buscador */
    .dataTables_filter input {
        border: 3px solid #000000;
        /* Borde personalizado */
        border-radius: 4px;
        /* Bordes redondeados */
        padding: 10px 10px;
        /* Espaciado interno */
        width: 100%;
        /* Ancho del buscador */
    }

    /* Ajuste de las celdas para que los títulos queden en una sola línea */
    th {
        white-space: nowrap;
        /* Evita que los títulos de las columnas se dividan en varias líneas */
    }

    /* Ajuste del ancho mínimo de las columnas */
    table#tablaStock th,
    table#tablaStock td {
        min-width: 178px;
        /* Ancho mínimo de las celdas */
        text-align: center;
        /* Centra el texto de las columnas */
    }
</style>