<div class="mt-5">
    <h4 class="display-4">Registrar Producto</h4>
</div>

<form class="row g-3 mt-5" method="post" action="<?php echo getUrl('Configuracion','Producto','postInsert'); ?>" enctype="multipart/form-data">

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
        <input type="text" class="form-control" id="nombre" name="nombreProducto" placeholder="Ingrese el nombre del producto" required>
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
        <label for="imagen">Agregar Foto del Producto</label>
        <input type="file" class="form-control" name="tar_img" id="imageInput" required>
    </div>

    <!-- Vista Previa de la Imagen -->
    <div class="col-md-3 mt-4">
        <label for="preview">Vista Previa:</label>
        <img id="preview" src="" alt="Vista previa" width="200px" height="200px" style="display: block; border: 1px solid #ccc; padding: 10px;"/>
    </div>

    <script>
        document.getElementById('imageInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>

    <!-- Botón de Registro -->
    <div class="col-12 mt-4">
        <button class="btn btn-primary" type="submit">Registrar Producto</button>
    </div>

    <!-- Botón para Consultar Productos Registrados -->
    <div class="col-12 mt-2">
        <a href="<?php echo getUrl('Configuracion', 'Producto', 'consultar'); ?>" class="btn btn-primary">Consultar Productos</a>
    </div>
    <div class="col-12 mt-4" >
    </div>

</form>
