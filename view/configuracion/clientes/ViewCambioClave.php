
<div class="container rounded bg-white mt-5 mb-5">
    <form action="<?php var_dump(getUrl('Configuracion', 'Usuario', 'ActualizarClave'));?>" method="POST">
        <div class="mb-3">
            <label for="actualClave" class="form-label">Contraseña Actual</label>
            <input type="password" class="form-control" id="actualClave"  name="claveActual">
     
        </div>
        <div class="mb-3">
            <label for="cambioClave" class="form-label">Nueva Contraseña</label>
            <input type="password" class="form-control" id="cambioClave" name="claveNueva">
        </div>
        <div class="mb-3">
            <label for="nuevaClaveConfirmar" class="form-label">Confirmar Contraseña</label>
            <input type="password" class="form-control" id="nuevaClaveConfirmar" name="reapeatClaveNueva">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>