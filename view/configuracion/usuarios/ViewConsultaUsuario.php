<link rel="stylesheet" type="text/css" href="css/styleUsuario.css">

    <div class="container">
        <div class="row mt-12">
            <form >
                <table class="table " id="tablaUsuario">
                    <thead>
                        <tr>
                            <th scope="col">Rol</th>
                            <th scope="col">Cedula</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellido</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Clave</th>
                        </tr>
                    </thead>
                    <?php if (!empty($usuarios)): ?>
                        <?php foreach ($usuarios as $usuario): ?>
                            <tr>
                                <th><?= $usuario['rol_nombre']; ?></th>
                                <td><?= $usuario['usu_cedula']; ?></td>
                                <td><?= $usuario['usu_nombre']; ?></td>
                                <td><?= $usuario['usu_apellido']; ?></td>
                                <td><?= $usuario['usu_telefono']; ?></td>
                                <td><?= $usuario['usu_correo']; ?></td>
                                <td><?= $usuario['usu_contrasenia']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">No se encontraron usuarios activos.</td>
                        </tr>
                    <?php endif; ?>
                </table>
            </form>
        </div>
    </div>
