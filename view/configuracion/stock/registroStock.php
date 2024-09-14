<div class="container">
    <div class="mt-5">
        <h4 class="display-4">Registrar Stock</h4>
    </div>
    <form id="formulario" class="row g-3 mt-3" method="post" action="<?php echo getUrl("Configuracion", "Stock", "postInsert"); ?>" enctype="multipart/form-data">
        <input type="hidden" id="datos-organizados" name="datos-organizados">
        <div class="container">
            <div class="row">
                <!-- Sección de Nombre de Prenda -->
                <div class="form-group col-md-4">
                    <label for="nombrePrenda">Nombre de prenda</label>
                    <select class="form-control" name="idPrenda">
                        <option value="0">Seleccione...</option>
                        <?php foreach ($productos as $producto): ?>
                            <option value="<?= $producto['product_id']; ?>"><?= $producto['product_nombre']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Sección de Precio -->
                <div class="form-group col-md-3">
                    <label for="precio" class="form-label">Precio</label>
                    <input type="text" class="form-control" id="precio" name="precio" placeholder="Ingrese el precio">
                </div>
            </div>

            <div class="container mt-3">
                <!-- Contenedor para todos los colores -->
                <div id="color-container">
                    <!-- Primer contenedor de color con talla y cantidad -->
                    <div class="color-group mb-4">
                        <div class="row align-items-center">
                            <!-- Sección de Color -->
                            <div class="form-group col-md-3">
                                <label for="color" class="form-label">Color</label>
                                <input type="text" class="form-control" name="color[0]">
                            </div>
                            <!-- Botón para agregar más Talla/Cantidad al Color -->
                            <div class="col-md-2">
                                <button type="button" class="btn btn-success agregar-talla">Agregar Talla</button>
                            </div>
                            <!-- Botón para eliminar el contenedor de color -->
                            <div class="col-md-2">
                                <button type="button" class="btn btn-danger eliminar-color">Eliminar Color</button>
                            </div>
                        </div>

                        <!-- Contenedor de tallas y cantidades para este color -->
                        <div class="talla-cantidad-container mt-3">
                            <div class="row align-items-center">
                                <!-- Sección de Talla -->
                                <div class="form-group col-md-2">
                                    <label for="talla" class="form-label">Talla</label>
                                    <select class="form-control" name="color[0][talla][]">
                                        <option value="0">Seleccione...</option>
                                        <option>S</option>
                                        <option>M</option>
                                        <option>L</option>
                                        <option>XL</option>
                                        <option>XXL</option>
                                        <option>Única</option>
                                    </select>
                                </div>

                                <!-- Sección de Cantidad -->
                                <div class="form-group col-md-1">
                                    <label for="cantidad" class="form-label">Cantidad</label>
                                    <input type="text" class="form-control" name="color[0][cantidad][]">
                                </div>

                                <!-- Botón para eliminar esta fila de Talla/Cantidad -->
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-danger eliminar-talla">Eliminar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Botón para agregar más colores -->
                <div class="mt-4">
                    <button type="button" class="btn btn-success" id="agregar-color">Agregar Color</button>
                </div>
            </div>


            <div class="col-12 mt-4">
                <button class="btn btn-primary" type="submit">Registrar</button>
            </div>
    </form>
</div>
<div class="col-12 mt-1">
    <a href="<?php echo getUrl('Configuracion', 'Stock', 'consultar'); ?>" class="btn btn-primary">Consultar Stock</a>
</div>
<div class="col-12 mt-4"></div>


<script>
    let colorIndex = 0; // Para rastrear el índice del color

    // Función para agregar nuevo conjunto de Talla y Cantidad en el contenedor de color
    function agregarTalla(container, colorIndex) {
        const numTallas = $(container).find('.row').length; // Contar cuántas tallas ya hay

        if (numTallas >= 5) { // Limitar a 5 tallas
            alert("No puedes agregar más de 5 tallas por color.");
            return;
        }

        const newRow = $('<div>').addClass('row align-items-center mt-3');

        newRow.html(`
                    <div class="form-group col-md-2">
                        <label for="talla" class="form-label">Talla</label>
                        <select class="form-control" name="color[${colorIndex}][talla][]">
                            <option value="0">Seleccione...</option>
                            <option>S</option>
                            <option>M</option>
                            <option>L</option>
                            <option>XL</option>
                            <option>XXL</option>
                            <option>Única</option>
                        </select>
                    </div>
                    <div class="form-group col-md-1">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="text" class="form-control" name="color[${colorIndex}][cantidad][]">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger eliminar-talla">Eliminar</button>
                    </div>
                `);

        $(container).append(newRow);
    }

    // Evento para agregar nuevo color con su propia sección de Talla y Cantidad
    $('#agregar-color').on('click', function() {
        const colorContainer = $('#color-container');
        const newColorGroup = $('<div>').addClass('color-group mb-4');
        colorIndex++; // Incrementar el índice de color

        newColorGroup.html(`
                    <div class="row align-items-center">
                        <div class="form-group col-md-3">
                            <label for="color" class="form-label">Color</label>
                            <input type="text" class="form-control" name="color[${colorIndex}]">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-success agregar-talla">Agregar Talla</button>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger eliminar-color">Eliminar Color</button>
                        </div>
                    </div>
                    <div class="talla-cantidad-container mt-3">
                        <div class="row align-items-center">
                            <div class="form-group col-md-2">
                                <label for="talla" class="form-label">Talla</label>
                                <select class="form-control" name="color[${colorIndex}][talla][]">
                                    <option value="0">Seleccione...</option>
                                    <option>S</option>
                                    <option>M</option>
                                    <option>L</option>
                                    <option>XL</option>
                                    <option>XXL</option>
                                    <option>Única</option>
                                </select>
                            </div>
                            <div class="form-group col-md-1">
                                <label for="cantidad" class="form-label">Cantidad</label>
                                <input type="text" class="form-control" name="color[${colorIndex}][cantidad][]">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-danger eliminar-talla">Eliminar</button>
                            </div>
                        </div>
                    </div>
                `);

        colorContainer.append(newColorGroup);
    });

    // Usamos event delegation para manejar eventos dinámicos

    // Evento para agregar una nueva talla
    $(document).on('click', '.agregar-talla', function() {
        const container = $(this).closest('.color-group').find('.talla-cantidad-container');
        const colorIndex = $(this).closest('.color-group').index();
        agregarTalla(container, colorIndex);
    });

    // Evento para eliminar una fila de talla/cantidad
    $(document).on('click', '.eliminar-talla', function() {
        $(this).closest('.row').remove();
    });

    // Evento para eliminar el grupo de color
    $(document).on('click', '.eliminar-color', function() {
        $(this).closest('.color-group').remove();
    });

    // Función para obtener los datos del formulario
    function obtenerDatosFormulario() {
        const colores = [];
        const tallas = {};
        const cantidades = {};

        $('#color-container .color-group').each(function(index) {
            const color = $(this).find('input[name="color[' + index + ']"]').val().trim();
            const tallaCantidadContainer = $(this).find('.talla-cantidad-container');

            if (color) {
                colores.push(color);

                const tallasColor = [];
                const cantidadesColor = [];

                tallaCantidadContainer.find('.row').each(function() {
                    const talla = $(this).find('select[name="color[' + index + '][talla][]"]').val();
                    const cantidad = $(this).find('input[name="color[' + index + '][cantidad][]"]').val();

                    if (talla && cantidad) {
                        tallasColor.push(talla);
                        cantidadesColor.push(cantidad);
                    }
                });

                if (tallasColor.length > 0) {
                    tallas[color] = tallasColor;
                    cantidades[color] = cantidadesColor;
                }
            }
        });

        return {
            color: colores,
            talla: tallas,
            cantidad: cantidades
        };
    }

    $('#formulario').on('submit', function(e) {
        // Prevenir el envío automático del formulario
        e.preventDefault();

        const datosOrganizados = obtenerDatosFormulario();

        // Convertir el objeto a una cadena JSON
        $('#datos-organizados').val(JSON.stringify(datosOrganizados));

        // Enviar el formulario
        this.submit();
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

<style>
    .color-group {
        border: 2px solid #ada5a3;
        /* Borde para cada grupo de color */
        padding: 10px;
        margin-bottom: 20px;
    }
</style>