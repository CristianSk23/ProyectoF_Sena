
<div class="container">
    <div class="mt-5">
        <h4 class="display-4">Consulta Productos</h4>
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

        <table class="table  table-bordered " id="tablaUsuario">
            <thead>
                <tr>
                    <th scope="col">Numero</th>
                    <th scope="col">tipo</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Categoría</th>
                    <th scope="col">Género</th>
                    <th scope="col">Acciones de edicción</th>


                </tr>
            </thead>
            <tbody>
                <?php if (!empty($productos)): ?>
                    <?php foreach ($productos as $producto): ?>
                        <tr>
                            <td data-id="<?= $producto['product_id'] ?>" style="display: none;"><?= $producto['producto_id'] ?> </td>
                            <td><?= $producto['product_id']; ?></td>
                            <td><?= $producto['tipo_nombre']; ?></td>
                            <td><?= $producto['product_nombre']; ?></td>
                            <td><?= $producto['product_descripcion']; ?></td>
                            <td><?= $producto['categoria_nombre']; ?></td>
                            <td><?= $producto['genero_nombre']; ?></td>

                            <td>
                                <a title="Editar" href="<?php echo getUrl("Configuracion", "Producto", "modificar", array("product_id" => $producto['product_id'])); ?>">
                                    <button class="btn btn-primary actualizar"> <i class="fa-solid fa-pen-to-square fa-lg me-1" style="color: #0fcedb;"></i></button>
                                </a>

                                <a>
                                    <button class="btn btn-danger eliminar" data-url="<?php echo getUrl("Configuracion", "Producto", "eliminar") ?>"><i class="fa-sharp fa-solid fa-trash-can fa-lg" style="color: #fb6a6a;"></i></button>

                                </a>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">No se encontraron productos activos.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="alert alert-success messageSuccess" style="display:none" role="alert">
            El registro se elimino con exito
        </div>
    </div>
</div>
<script>

    // Inicializar DataTable con opciones personalizadas
    var tabla = document.querySelector("#tablaUsuario");
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
        border: 1px solid #ced4da;
        /* Borde personalizado */
        border-radius: 4px;
        /* Bordes redondeados */
        padding: 0.375rem 0.75rem;
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