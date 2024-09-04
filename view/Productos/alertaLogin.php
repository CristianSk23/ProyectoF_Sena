<?php
include_once "../partials/header.php";
?>
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Inicio de Sesión Requerido</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Debes iniciar sesión para agregar productos al carrito.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <a href="<?php echo getUrl('Acceso', 'Acceso', 'login'); ?>" class="btn btn-primary">Iniciar Sesión</a>
            </div>
        </div>
    </div>
</div>