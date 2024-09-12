<div class="container">
    <div class="mt-5">
        <h4 class="display-4">Consulta de usuarios</h4>
    </div>
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $_SESSION['error'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION["error"]); ?>
    <?php endif; ?>
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $_SESSION['success'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION["success"]); ?>
    <?php endif; ?>
    <div id="usuActual" data-usu_idA="<?= $_SESSION['usu_id']; ?>"></div>

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
                                    <button class="btn btn-danger eliminarU" data-url="<?php echo getUrl("Configuracion", "Usuario", "delete") ?>">
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
        $(document).on('click', '.eliminarU', function() {
            // Confirmar la acción
            const aviso = confirm("¿Está seguro de que desea eliminar el registro?");
            if (aviso) {
                // Encuentra la fila <tr> más cercana al botón clicado
                const row = $(this).closest('tr');

                // Obtén el ID de usuario de la celda correspondiente en la fila
                const usu_id = row.find('.idUsuario').data('usu_id');

                // Enviar el ID del usuario actual desde el servidor al cliente
                const usuActual = $('#usuActual').data('usu_id');

                if (usu_id == usuActual) {
                    alert("El usuario no se puede eliminar.");
                    return;
                }

                // Obtén la URL de eliminación del botón clicado
                const url = $(this).data('url');

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        usu_id: usu_id
                    },
                    success: function(response) {
                        let data;

                        // Intenta analizar la respuesta como JSON
                        try {
                            data = JSON.parse(response);
                        } catch (e) {
                            console.error("Error al analizar la respuesta JSON:", e);
                            alert("Hubo un problema al procesar la respuesta del servidor.");
                            return;
                        }

                        // Verifica el estado de la respuesta
                        if (data.status === "success") {
                            $('.messageSuccess').css('display', 'block');
                            setTimeout(() => {
                                location.reload();
                            }, 500);
                        } else {
                            alert(data.message || "No se pudo eliminar el registro.");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error en la solicitud:", error);
                        alert("Hubo un problema al intentar eliminar el registro.");
                    }
                });

            } else {
                alert("Se ha cancelado la eliminación.");
            }
        });
    });
</script>