<div class="mt-5">
    <h4 class="display-4">Registrar Stock</h4>
</div>
<form class="row g-3 mt-5" method="post" action="<?php echo getUrl("Configuracion","Stock","postInsert"); ?>" enctype="multipart/form-data">




    <div class="form-group col-md-3 row mt-5"">
            <div class = "col-md-9" >
                <label for="nombrePrenda">Nombre de prenda</label>
                <select class="form-control" name="idPrenda">
                    <option value="0">Seleccione...</option>
                    <<?php foreach ($productos as $producto): ?>
                    <option value="<?= $producto['product_id']; ?>"><?= $producto['product_nombre']; ?></option>
                <?php endforeach; ?>
                </select>
            </div>
    </div>

    <div class="form-group col-md-3 row mt-5"" >
            <div class = "col-md-9" >
                <label for="talla">Talla</label>
                <select class="form-control" name="talla">
                    <option value="0">Seleccione...</option>
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
        <input type="text" class="form-control" id="color" name="color" >
    </div>

    <div class="col-md-3 mt-5"">
        <label for="precio" class="form-label">Precio</label>
        <input type="text" class="form-control" id="precio" name="precio" value="" 
        placeholder="Ingrese el precio">
    </div>


    <div class="col-md-1 mt-5"">
        <label for="cantidad" class="form-label">Cantidad</label>
        <input type="text" class="form-control" id="cantidad" name="cantidad" >
    </div>


        <div class="form-group row col-md-5 mt-5">

            <div class="form-group col-md-9" id= "copy">
                <label for="imagen">Agregar foto</label>
                <input class="row " type="file" name="stock_img[]" id="imageInput" multiple >
                <img id="preview" src="" alt="Vista previa" width="200px" height="200px"> <br><br>
            </div>

            <!-- <div class="row col-md-3 mt-5">
                
                    <button type="button" class="btn btn-success" id= "agregar">+</button>
            </div> -->

        </div>
        
        <!-- <div class = "row" id= "agregarResponsable"></div> -->
   
    
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

<script>
        document.getElementById('imageInput2').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview2').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>

<script>
        document.getElementById('imageInput3').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview3').src = e.target.result;
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
    <a href="<?php echo getUrl("Configuracion", "Stock", "consultar"); ?>"><button class="btn btn-primary">Consultar productos registrados</button></a>    
    </div>
