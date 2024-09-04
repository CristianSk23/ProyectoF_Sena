<div class="mt-5">
    <h4 class="display-4">Editar Stock</h4>
</div>
<?php foreach($stocks as $stock): ?>
    <form class="row g-3 mt-5" method="post" action="<?php echo getUrl("Configuracion","Stock","postInsert"); ?>" enctype="multipart/form-data">




        <div class="form-group col-md-3 row mt-5"">
                <div class = "col-md-9" id= "copy">
                    <label for="nombrePrenda">Nombre de prenda</label>
                    <select class="form-control" name="idPrenda">
                        <option value="<?= $stock['product_id']; ?>"><?= $stock['product_nombre']; ?></option>
                        <<?php foreach ($productos as $producto): ?>
                        <option value="<?= $producto['product_id']; ?>"><?= $producto['product_nombre']; ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>
        </div>

        <div class="form-group col-md-3 row mt-5"" >
                <div class = "col-md-9" id= "copy">
                    <label for="talla">Talla</label>
                    <select class="form-control" name="talla">
                        <option value="0"><?= $stock['stock_talla']; ?></option>
                        <option>S</option>
                        <option>M</option>
                        <option>L</option>
                        <option>XL</option>
                        <option>XXL</option>
                        <option>Única</option>
                    </select>
                </div>
        </div>


        <div class="col-md-2 mt-5"">
            <label for="color" class="form-label">Color</label>
            <input type="text" class="form-control" id="color" name="color" value="<?= $stock['stock_color']; ?>">
        </div>

        <div class="col-md-3 mt-5"">
            <label for="precio" class="form-label">Precio</label>
            <input type="text" class="form-control" id="precio" name="precio" value="<?= $stock['stock_precio']; ?>" 
            placeholder="Ingrese el precio">
        </div>


        <div class="col-md-1 mt-5"">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="text" class="form-control" id="cantidad" name="cantidad" value="<?= $stock['stock_cantidad']; ?>" >
        </div>


            <div class="form-group row col-md-5 mt-5">
                <div class="form-group col-md-9" id= "copy">
                    <label for="imagen">Agregar foto</label>
                    <input type="file" name="tar_img" id="imageInput" multiple>
                </div>
            </div>
        

        <div class="col-12 mt-5" >
            <button class="btn btn-primary" type="submit">Registrar</button>
        </div>

        

        
    </form>
<?php endforeach; ?>