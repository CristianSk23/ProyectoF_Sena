<div class="mt-5">
    <h4 class="display-4">Consulta Productos</h4>
</div>
<div class="container">
    <div class="row mt-12">

        <table class="table  table-bordered " id="tablaUsuario">
            <theadstock>
                <tr>
                <th scope="col">Nombre de producto</th>
                <th scope="col">Talla</th>
                <th scope="col">Cololr</th>
                <th scope="col">Precio</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Acciones de edicción</th>
                

                </tr>
            </theadstock
            <tbody>
                <?php if (!empty($stocks)): ?>
                    <?php foreach ($stocks as $stock): ?>
                        <tr>
                            <td class="idStock" data-usu_id="<?= $stock['stock_id'] ?>" style="display: none;"><?= $stock['stock_id'] ?> </td>
                            <th><?= $stock['product_nombre']; ?></th>
                            <td><?= $stock['stock_talla']; ?></td>
                            <td><?= $stock['stock_color']; ?></td>
                            <td><?= $stock['stock_precio']; ?></td>
                            <td><?= $stock['stock_cantidad']; ?></td>
                            
                            <td>
                                <a title="Editar" href="<?php echo getUrl("Configuracion", "Stock", "modificar", array("stock_id" => $stock['stock_id'])); ?>">
                                    <button class="btn btn-primary actualizar"> <i class="fa-solid fa-pen-to-square fa-lg me-1" style="color: #0fcedb;"></i></button>
                                </a>

                                <a>
                                    <button class="btn btn-danger eliminar" data-url="<?php echo getUrl("Configuracion", "Stock", "eliminar") ?>"><i class="fa-sharp fa-solid fa-trash-can fa-lg" style="color: #fb6a6a;"></i></button>

                                </a>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">No se encontraron productos en stock activos.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="alert alert-success messageSuccess" style="display:none" role="alert">
            El registro se elimino con exito
        </div>
    </div>
</div>
