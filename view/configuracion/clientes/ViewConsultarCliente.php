<div class="container rounded bg-white mt-5 mb-5">
    <?php if (!empty($usuarios)): ?>
        <?php foreach ($usuarios as $usuario): ?>
            <div class="col-md-8">
                <div class="border p-3 py-5" id="perfil">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Perfil</h4>
                        <button class="btn btn-primary" id="edit-button">
                            <i class="fa-solid fa-pen-to-square fa-lg me-1" style="color: #0fcedb;"></i> Editar
                        </button>

                        <button class="btn btn-primary d-none" id="save-button">
                            <i class="fa-solid fa-save fa-lg me-1" style="color: #0fcedb;"></i> Guardar
                        </button>

                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label class="labels" for="nombre">Nombre</label>
                            <input type="text" id="nombre" class="form-control" placeholder="Nombre" value="<?= htmlspecialchars($usuario['usu_nombre']); ?>" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="apellido" class="labels">Apellido</label>
                            <input type="text" id="apellido" class="form-control" value="<?= htmlspecialchars($usuario['usu_apellido']); ?>" placeholder="Apellido" readonly>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label class="labels" for="documento">No. Documento</label>
                            <input type="text" id="documento" class="form-control" placeholder="Ingrese número de documento" value="<?= htmlspecialchars($usuario['usu_cedula']); ?>" readonly>
                        </div>
                        <div class="col-md-12">
                            <label class="labels" for="email">Correo</label>
                            <input type="text" id="email" class="form-control" value="<?= htmlspecialchars($usuario['usu_correo']); ?>" readonly>
                        </div>
                        <div class="col-md-12">
                            <label class="labels" for="telefono">Número de Teléfono</label>
                            <input type="text" id="telefono" class="form-control" placeholder="(Opcional)" value="<?= htmlspecialchars($usuario['usu_telefono']); ?>" readonly>
                        </div>
                    </div><br>
                    <a href="../view/configuracion/clientes/ViewCambioClave.php" class="btn btn-primary" id="cambiar-clave">
                        Cambiar Contraseña
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No se encontraron datos del usuario.</p>
    <?php endif; ?>
</div>
<script>
    $(document).ready(function() {
        $('#edit-button').click(function() {
            // Habilitar campos excepto el de correo
            $('#perfil input:not(#email)').removeAttr('readonly');

            // Ocultar botón de editar y mostrar botón de guardar
            $(this).addClass('d-none');
            $('#save-button').removeClass('d-none');
        });

        $('#save-button').click(function() {
            // Recoger los datos del formulario
            const formData = {
                usu_id: <?= json_encode($usuario['usu_id']); ?>,
                nombre: $('#nombre').val(),
                apellido: $('#apellido').val(),
                documento: $('#documento').val(),
                telefono: $('#telefono').val(),
                email: $('#email').val() // Aunque es solo lectura, se puede enviar también si se desea
            };

            guardarDatosCliente(formData);
        });
    });

    function guardarDatosCliente(data) {
        $.ajax({
            url: '<?php echo getUrl("Configuracion", "Usuario", "Actualizar"); ?>',
            type: 'POST',
            data: data,

            success: function(response) {
                console.log('Respuesta del servidor:', response);
                // Verifica si la respuesta contiene la palabra 'success'
                if (response.includes('success')) {
                    alert('Datos actualizados correctamente');
                    // Volver a poner los campos en modo solo lectura
                    $('#perfil input').attr('readonly', true);

                    // Ocultar botón de guardar y mostrar botón de editar
                    $('#save-button').addClass('d-none');
                    $('#edit-button').removeClass('d-none');
                } else {
                    alert('Error al guardar los datos');
                }
            },

        });
    }
</script>