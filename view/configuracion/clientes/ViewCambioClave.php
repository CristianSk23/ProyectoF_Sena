<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<div class="container rounded bg-white mt-5 mb-5">
    <form action="<?php echo getUrl("Configuracion", "Usuario", "ActualizarClave"); ?>">
        <div class="mb-3">
            <label for="actualClave" class="form-label">Contraseña Actual</label>
            <input type="password" class="form-control" id="actualClave" aria-describedby="emailHelp">
          
        </div>
        <div class="mb-3">
            <label for="nuevaClave" class="form-label">Nueva Contraseña</label>
            <input type="password" class="form-control" id="nuevaClave">
        </div>
        <div class="mb-3">
            <label for="nuevaClave" class="form-label">Confirmar Contraseña</label>
            <input type="password" class="form-control" id="nuevaClave">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>