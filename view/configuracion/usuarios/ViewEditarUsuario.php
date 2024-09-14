
<div class="container">
    <div class="mt-5">
        <h4 class="display-4">Editar usuario</h4>
    </div>
    <?php
    if (isset($_SESSION["editarUsuario"])) {
    ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $_SESSION['editarUsuario'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
        unset($_SESSION["editarUsuario"]);
    }
    if (isset($_SESSION['success'])) {
    ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $_SESSION['success'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
        unset($_SESSION["success"]);
    } ?>
    <?php foreach ($usuarios as $usuario): ?>
        <form method="post" action="<?php echo getUrl("Configuracion", "Usuario", "postUpdate"); ?>">
            <div class="row mt-5">
                <input type="hidden" name="usu_id" value="<?php echo $usuario['usu_id'] ?>">
                <div class="col-md-4">
                    <label for="rol" class="form-label">Rol</label>
                    <select class="form-control" id="rol" name="rol_id" required>
                        <option selected disabled value="">Seleccione...</option>
                        <?php foreach ($roles as $rol):
                            $selected = ($usuario["rol_id"] == $rol['rol_id']) ? "selected" : ""; ?>
                            <option value="<?= $rol['rol_id']; ?>" <?= $selected; ?>>
                                <?= $rol['rol_nombre']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="documento" class="form-label">No. Documento</label>
                    <input type="text" class="form-control" id="documento" name="usu_cedula" value="<?php echo $usuario['usu_cedula'] ?>"
                        required>
                </div>
                <div class="col-md-4">
                    <label for="nombreUsuario" class="form-label">Nombres</label>
                    <input type="text" class="form-control" id="nombreUsuario" name="usu_nombre" value="<?php echo $usuario['usu_nombre'] ?>"
                        required>
                </div>
                <div class="col-md-4">
                    <label for="apellidousuario" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" id="apellidousuario" name="usu_apellido"
                        value="<?php echo $usuario['usu_apellido'] ?>" required>
                </div>
                <div class="col-md-4">
                    <label for="telefono" class="form-label">Telefono</label>
                    <input type="text" class="form-control" id="telefono" name="usu_telefono" value="<?php echo $usuario['usu_telefono'] ?>"
                        required>
                </div>
                <div class="col-md-4">
                    <label for="validationDefaultUsername" class="form-label">Correo</label>
                    <div class="input-group">
                        <span class="input-group-text" id="inputGroupPrepend2">@</span>
                        <input type="email" class="form-control" id="correo"
                            aria-describedby="inputGroupPrepend2" name="usu_correo" value="<?php echo $usuario['usu_correo'] ?>" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="clave" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="clave" name="usu_contrasenia" value="<?php echo $usuario['usu_contrasenia'] ?>" required> <br>
                </div>
            </div>
            <br>
            <div class="mt-5">
                <input type="submit" value="Editar" class="btn btn-success">
            </div>
        </form>
    <?php endforeach; ?>
</div>

<script>
       var headerDesktop = $('.container-menu-desktop');
    var wrapMenu = $('.wrap-menu-desktop');

    if ($('.top-bar').length > 0) {
        var posWrapHeader = $('.top-bar').height();
    }
    else {
        var posWrapHeader = 0;
    }


    if ($(window).scrollTop() > posWrapHeader) {
        $(headerDesktop).addClass('fix-menu-desktop');
        $(wrapMenu).css('top', 0);
    }
    else {
        $(headerDesktop).removeClass('fix-menu-desktop');
        $(wrapMenu).css('top', posWrapHeader - $(this).scrollTop());
    }

    $(window).on('scroll', function () {
        if ($(this).scrollTop() > posWrapHeader) {
            $(headerDesktop).addClass('fix-menu-desktop');
            $(wrapMenu).css('top', 0);
        }
        else {
            $(headerDesktop).removeClass('fix-menu-desktop');
            $(wrapMenu).css('top', posWrapHeader - $(this).scrollTop());
        }
    });
</script>