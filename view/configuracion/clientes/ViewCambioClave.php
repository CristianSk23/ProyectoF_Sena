<section>
<style>
        .btnCliente {
            background-color:lightgrey;
            color: #fff;
            border: 1px solid gray;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btnCliente:hover {
            background-color: darkgray;
        }

    </style>
    <div class="container rounded bg-white mt-5 mb-5">
        <?php
        if (isset($_SESSION['mensajesC']) && !empty($_SESSION['mensajesC'])) {
            foreach ($_SESSION['mensajesC'] as $msg) {
        ?>
                <div class="alert <?= $msg['alert'] ?>" role="alert">
                    <?= $msg['mensaje'] ?>
                </div>
            <?php } ?>
        <?php
            unset($_SESSION['mensajesC']);
        }
        ?>
        <form action="<?php echo getUrl('Configuracion', 'Usuario', 'postActualizarClave'); ?>" method="POST">
            <div class="mb-3">
                <label for="actualClave" class="form-label">Contraseña Actual</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="actualClave" name="claveActual" required>
                    <button type="button" class="btn btnCliente" id="toggleActualClave">
                        <i class="bi bi-eye" id="iconActualClave"></i>
                    </button>
                </div>
            </div>
            <div class="mb-3">
                <label for="cambioClave" class="form-label">Nueva Contraseña</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="cambioClave" name="claveNueva" required>
                    <button type="button" class="btn btnCliente" id="toggleCambioClave">
                        <i class="bi bi-eye" id="iconCambioClave"></i>
                    </button>
                </div>
            </div>
            <div class="mb-3">
                <label for="nuevaClaveConfirmar" class="form-label">Confirmar Contraseña</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="nuevaClaveConfirmar" name="repeatClaveNueva" required>
                    <button type="button" class="btn btnCliente" id="toggleConfirmarClave">
                        <i class="bi bi-eye" id="iconConfirmarClave"></i>
                    </button>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</section>
<script>

function togglePasswordVisibility(inputId, iconId) {
        const passwordField = document.getElementById(inputId);
        const eyeIcon = document.getElementById(iconId);

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            eyeIcon.classList.remove('bi-eye');
            eyeIcon.classList.add('bi-eye-slash');
        } else {
            passwordField.type = 'password';
            eyeIcon.classList.remove('bi-eye-slash');
            eyeIcon.classList.add('bi-eye');
        }
    }

    document.getElementById('toggleActualClave').addEventListener('click', function () {
        togglePasswordVisibility('actualClave', 'iconActualClave');
    });

    document.getElementById('toggleCambioClave').addEventListener('click', function () {
        togglePasswordVisibility('cambioClave', 'iconCambioClave');
    });

    document.getElementById('toggleConfirmarClave').addEventListener('click', function () {
        togglePasswordVisibility('nuevaClaveConfirmar', 'iconConfirmarClave');
    });




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

