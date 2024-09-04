<div class="mt-5">
    <h4 class="display-4">Registrar Producto</h4>
</div>
<form class="row g-3 mt-5" method="post" action="<?php echo getUrl("Configuracion","Producto","postInsert"); ?>" enctype="multipart/form-data">

    <div class="form-group col-md-3 row mt-5">
            <div class = "col-md-9" id= "">
                <label for="tipo ">Tipo de prenda</label>
                <select class="form-control" name="tipo">
                <option selected disabled value="">Seleccione...</option>
    
                <<?php foreach ($tipos as $tipo): ?>
                    <option value="<?= $tipo['tipo_id']; ?>"><?= $tipo['tipo_nombre']; ?></option>
                <?php endforeach; ?>
                </select>
            </div>
    </div>

    <div class="col-md-4 mt-5">
        <label for="nombre" class="form-label">Nombre de producto </label>
        <input type="text" class="form-control" id="nombre" name="nombreProducto" value="" 
        placeholder="Ingrese nombre de la prenda" >
    </div>


    

    <div class="form-group">
        <label for="descripcionProducto">Descripcion de producto</label>
        <textarea class="form-control" id="descripcionProducto" name="descripcionProducto" rows="4" cols="50"></textarea>
    </div>

    <div class="form-group col-md-6 row mt-5">
            <div class = "col-md-9" id= "">
                <label for="categoria">Categoría</label>
                <select class="form-control" name="categoria">
                <option selected disabled value="">Seleccione...</option>
    
                <<?php foreach ($categorias as $categoria): ?>
                    <option value="<?= $categoria['categoria_id']; ?>"><?= $categoria['categoria_nombre']; ?></option>
                <?php endforeach; ?>
                </select>
            </div>
    </div>


    <div class="form-group col-md-3 row mt-5"">
            <div class = "col-md-9" id= "copy">
                <label for="genero">Género</label>
                <select class="form-control" name="genero">
                    <option value="0">Seleccione...</option>
                    <<?php foreach ($generos as $genero): ?>
                    <option value="<?= $genero['genero_id']; ?>"><?= $genero['genero_nombre']; ?></option>
                <?php endforeach; ?>
                </select>
            </div>
    </div>

    

    <div class="form-group row col-md-5 mt-5">
        <div class="form-group col-md-9">
                <label for="imagen">Agregar foto</label>
            <input type="file" name="tar_img" id="imageInput">
        </div>
    </div>

    

    <div class="row col-md-3 mt-5">
    <img id="preview" src="" alt="Vista previa" width="200px" height="200px">
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

    

    <div class="col-12 mt-5" >
        <button class="btn btn-primary" type="submit">Registrar</button>
    </div>

    

    
</form>
<div class="col-12 mt-5" >
    <a href="<?php echo getUrl("Configuracion", "Producto", "consultar"); ?>"><button class="btn btn-primary">Consultar productos registrados</button></a>    
</div>
