

<div class="container">
    <div class="mt-5">
        <h4 class="display-4">Consulta de usuarios</h4>
    </div>
        <div class="alert alert-danger alert-dismissible fade show" id="errorEliminarUsuario" style="display: none;" role="alert">
            No puede eliminar su cuenta.
        </div>
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $_SESSION['success'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION["success"]); ?>
    <?php endif; ?>

    <div id="usuarioActual" data-idUsu="<?= $_SESSION['usu_id'] ?>" style="display: none;"></div>
    <div class="row mt-12">
        <table class="table table-bordered" id="tablaUsuario">
            <thead>
                <tr>
                    <th scope="col">Rol</th>
                    <th scope="col">Cedula</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($usuarios)): ?>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td class="idUsuario" data-usu_id="<?= $usuario['usu_id'] ?>" style="display: none;"><?= $usuario['usu_id'] ?></td>
                            <th><?= $usuario['rol_nombre']; ?></th>
                            <td><?= $usuario['usu_cedula']; ?></td>
                            <td><?= $usuario['usu_nombre']; ?></td>
                            <td><?= $usuario['usu_apellido']; ?></td>
                            <td><?= $usuario['usu_telefono']; ?></td>
                            <td><?= $usuario['usu_correo']; ?></td>
                            <td>
                                <a title="Editar" href="<?php echo getUrl("Configuracion", "Usuario", "getUpdate", array("usu_id" => $usuario['usu_id'])); ?>">
                                    <button class="btn btn-primary actualizar">
                                        <i class="fa-solid fa-pen-to-square fa-lg me-1" style="color: #0fcedb;"></i>
                                    </button>
                                </a>
                                <a title="Eliminar">
                                    <button class="btn btn-danger eliminarU" data-url="<?php echo getUrl("Configuracion", "Usuario", "delete",false,"ajax") ?>">
                                        <i class="fa-sharp fa-solid fa-trash-can fa-lg" style="color: #fb6a6a;"></i>
                                    </button>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">No se encontraron usuarios activos.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="alert alert-success messageSuccess" style="display:none" role="alert">
            El registro se eliminó con éxito
        </div>
    </div>
    <a title="Volver" href="<?php echo getUrl("configuracion", "Usuario", "registrarUsuario") ?>">
        <button><i class="fa-solid fa-reply fa-xl" style="color: #63E6BE;"></i></button>
    </a>
</div>
<script>
      $(document).ready(function() {
        $(document).off('click', '.eliminarU');
        $(document).on('click', '.eliminarU', function() {
            
            const aviso = confirm("¿Está seguro de que desea eliminar el registro?");
            if (aviso) {
                // e.preventDefault();
                // Encuentra la fila <tr> más cercana al botón clicado
                const row = $(this).closest('tr');

                // Obtén el ID de usuario de la celda correspondiente en la fila
                const usu_id = row.find('.idUsuario').data('usu_id');
                const usuActual = $('#usuarioActual').attr('data-idUsu');
                // console.log(usuActual);
            //   if(usuActual == usu_id){
            //     console.log('No se puede eliminar el usuario actual');
            //     return;
            //   }else{
                    // Obtén la URL de eliminación del botón clicado
                    const url = $(this).data('url');
                    // console.log('ID Usuario:', usu_id);
                    
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            usu_id: usu_id,
                            usuActual: usuActual
                        },
                        success: function(response) {
                            // debugger;
                            if (response == "1") {
                                console.log(response);
                                $("#errorEliminarUsuario").css("display", "block");
                                setTimeout(() => {
                                    $("#errorEliminarUsuario").css("display", "none");
                                }, 3000);
                            }else if(response == "2"){
                                $('.messageSuccess').css('display', 'block');
                                setTimeout(() => {
                                    location.reload();
                                }, 500);
                            }
                        }
                    });
            //   }
              
            } else {
                alert("Se ha cancelado la eliminación.");
            }
        });
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

