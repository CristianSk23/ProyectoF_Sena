<div class="mt-5">
    <h4 class="display-4">Editar Producto</h4>
</div>
<?php foreach($productos as $producto): ?>

    <form class="row g-3 mt-5" method="post" action="<?php echo getUrl("Configuracion","Producto","modificacion"); ?>" enctype="multipart/form-data">

        <div class="form-group col-md-3 row mt-5">
                <div class = "col-md-9" id= "">
                    <label for="tipo ">Tipo de prenda</label>
                    <select class="form-control" name="tipo">
                    <option value="<?php echo $producto['tipo_id']?>"><?= $producto['tipo_nombre']; ?></option>
        
                    <<?php foreach ($tipos as $tipo): ?>
                        <option value="<?= $tipo['tipo_id']; ?>"><?= $tipo['tipo_nombre']; ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>
        </div>

        <div class="col-md-4 mt-5">
            <label for="nombre" class="form-label">Nombre de producto </label>
            <input type="text" class="form-control" id="nombre" name="nombreProducto" value="<?php echo $producto['product_nombre']?>"" 
            placeholder="Ingrese nombre de la prenda" >
        </div>


        <<div class="form-group">
            <label for="descripcionProducto">Descripcion de producto</label>
            <textarea class="form-control" id="descripcionProducto" name="descripcionProducto" rows="4" cols="50"></textarea>
        </div>

        <div class="form-group col-md-3 row mt-5">
                <div class = "col-md-9" id= "">
                    <label for="categoria">Categoría</label>
                    <select class="form-control" name="categoria">
                    <option value="<?php echo $producto['categoria_id']?>"><?= $producto['categoria_nombre']; ?></option>>
        
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
                        <option value="<?php echo $producto['genero_id']?>"><?= $producto['genero_nombre']; ?></option>
                        <<?php foreach ($generos as $genero): ?>
                        <option value="<?= $genero['genero_id']; ?>"><?= $genero['genero_nombre']; ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>
        </div>

        

        <div class="form-group row col-md-5 mt-5">
            <div class="form-group col-md-9">
                <label for="imagen">Agregar foto</label>
                <input type="file" name="tar_img" >
            </div>
            
        </div>
        
        <div class="row col-md-3 mt-5">
        <img src="<?php echo $producto['product_img']?>" width="200px" height="200px">
        </div>        
                    
        <div class="col-12 mt-5" >
            <button class="btn btn-primary" type="submit">Actulizar</button>
        </div>

        

        
    </form>
    
<?php endforeach; ?>