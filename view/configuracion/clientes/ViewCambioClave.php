<section>
    <div class="container rounded bg-white mt-5 mb-5">
        <?php
        if (isset($_SESSION['mensajesC']) && !empty($_SESSION['mensajesC'])) {
            foreach ($_SESSION['mensajesC'] as $msg) {
        ?>
                <div class="alert">
                    <div class='alert <?= $msg['alert'] ?>' role="alert">
                        <?= $msg['mensaje'] ?>
                    </div>
                </div>
            <?php } ?>
        <?php
            unset($_SESSION['mensajesC']);
        }
        ?>
        <form action="<?php echo getUrl('Configuracion', 'Usuario', 'postActualizarClave'); ?>" method="POST">
            <div class="mb-3">
                <label for="actualClave" class="form-label">Contraseña Actual</label>
                <input type="password" class="form-control" id="actualClave" name="claveActual" required>

            </div>
            <div class="mb-3">
                <label for="claveNueva" class="form-label">Nueva Contraseña</label>
                <input type="password" class="form-control" id="cambioClave" name="claveNueva" required>
            </div>
            <div class="mb-3">
                <label for="nuevaClaveConfirmar" class="form-label">Confirmar Contraseña</label>
                <input type="password" class="form-control" id="nuevaClaveConfirmar" name="repeatClaveNueva" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</section>