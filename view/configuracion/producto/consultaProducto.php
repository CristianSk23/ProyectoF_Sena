<div class="mt-5">
    <h4 class="display-4">Consulta Productos</h4>
</div>
<div class="container">
    <div class="row mt-12">

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
                            <td  data-id="<?= $producto['product_id'] ?>" style="display: none;"><?= $producto['producto_id'] ?> </td>
                            <th><?= $producto['product_id']; ?></th>
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
