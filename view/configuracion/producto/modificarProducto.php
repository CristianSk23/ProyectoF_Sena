<div class="mt-5">
    <h4 class="display-4">Editar Producto</h4>
</div>
<?php foreach($productos as $producto): ?>

    <form class="row g-3 mt-5" method="post" action="<?php echo getUrl("Configuracion","Producto","modificacion", array("product_id" => $producto['product_id'])); ?>" enctype="multipart/form-data">

    <!-- Tipo de Prenda -->
    <div class="form-group col-md-4 mt-4">
        <label for="tipo">Tipo de prenda</label>
        <select class="form-control" name="tipo">
            <option  value="<?php echo $producto['tipo_id']?>"><?= $producto['tipo_nombre']; ?></option>
            <?php foreach ($tipos as $tipo): ?>
                <option value="<?= $tipo['tipo_id']; ?>"><?= $tipo['tipo_nombre']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Nombre del Producto -->
    <div class="form-group col-md-4 mt-4">
        <label for="nombre">Nombre del Producto</label> 
        <input type="text" class="form-control" id="nombre" name="nombreProducto" placeholder="Ingrese el nombre del producto" value="<?php echo $producto['product_nombre']?>" required>
        <input type="hidden" name="id" value="<?php echo $producto['product_id']?>">

    </div>

     <!-- Categoría -->
     <div class="form-group col-md-4 mt-4">
        <label for="categoria">Categoría</label>
        <select class="form-control" name="categoria">
            <option  value="<?php echo $producto['categoria_id']?>"><?= $producto['categoria_nombre']; ?></option>>
            <?php foreach ($categorias as $categoria): ?>
                <option value="<?= $categoria['categoria_id']; ?>"><?= $categoria['categoria_nombre']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Descripción del Producto -->
    <div class="form-group col-md-8 mt-4">
        <label for="descripcionProducto">Descripción del Producto</label>
        <textarea class="form-control" id="descripcionProducto" name="descripcionProducto" rows="4" placeholder="Ingrese una descripción del producto"><?php echo $producto['product_descripcion']?></textarea>
    </div>

   

    <!-- Género -->
    <div class="form-group col-md-4 mt-4">
        <label for="genero">Género</label>
        <select class="form-control" name="genero">
            <option  value="<?php echo $producto['genero_id']?>"><?= $producto['genero_nombre']; ?></option>
            <?php foreach ($generos as $genero): ?>
                <option value="<?= $genero['genero_id']; ?>"><?= $genero['genero_nombre']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Imagen del Producto -->
    <div class="form-group col-md-5 mt-4">
        <label for="imagen">Cambiar fotos del producto</label>
        <input type="file" class="form-control" name="stock_img[]" id="imageInput" multiple >
    </div>

    

    <!-- Botón de Registro -->
    <div class="col-12 mt-4">
        <button class="btn btn-primary" type="submit">Actualizar Producto</button>
    </div>

    
    <div class="col-12 mt-4" >
    </div>

</form>

    
<?php endforeach; ?>