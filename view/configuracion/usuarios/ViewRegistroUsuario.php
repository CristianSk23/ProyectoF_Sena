    <!-- Content page -->
    <section class="bg0 p-t-62 p-b-60">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-9 p-b-80">
                    <div class="p-r-45 p-r-0-lg">
                        <!-- item blog -->
                        <form class="row g-3" id="registro" action="<?php echo getUrl("producto", "Usuario", "registroUsuario"); ?>" method="POST">
                            <div class="col-md-4">
                                <label for="rol" class="form-label">Rol</label>
                                <select class="form-select" id="rol" name="rol_id" required>
                                    <option selected disabled value="">Seleccione...</option>

                                    <?php foreach ($roles as $rol): ?>
                                        <option value="<?= $rol['rol_id']; ?>"><?= $rol['rol_nombre']; ?></option>
                                    <?php endforeach; ?>

 
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="documento" class="form-label">No. Documento</label>
                                <input type="text" class="form-control" id="documento" name="usu_cedula" value=""
                                    required>
                            </div>
                            <div class="col-md-4">
                                <label for="nombreUsuario" class="form-label">Nombres</label>
                                <input type="text" class="form-control" id="nombreUsuario" name="usu_nombre" value=""
                                    required>
                            </div>
                            <div class="col-md-4">
                                <label for="apellidousuario" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="apellidousuario" name="usu_apellido"
                                    value="" required>
                            </div>
                            <div class="col-md-4">
                                <label for="telefono" class="form-label">Telefono</label>
                                <input type="text" class="form-control" id="telefono" name="usu_telefono" value=""
                                    required>
                            </div>
                            <div class="col-md-4">
                                <label for="validationDefaultUsername" class="form-label">Correo</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="inputGroupPrepend2">@</span>
                                    <input type="email" class="form-control" id="correo"
                                        aria-describedby="inputGroupPrepend2" name="usu_correo" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="clave" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="clave" name="usu_contrasenia" required> <br>
                            </div>

                            <div class="col-md-10 mb-3">
                                <button class="btn btn-primary" type="submit">Registrar</button>

                            </div>
                            <div class="col-md-10 mb-3">
                                <button class="btn btn-primary" type="button" id="btnConsultar">
                                    Consultar
                                </button>
                            </div>

                            <script>
                                document.getElementById('btnConsultar').addEventListener('click', function() {
                                    window.location.href = '<?php echo getUrl("Configuracion", "Usuario", "consultarUsuario"); ?>';
                                });
                            </script>
                            <!-- <div class="col-md-3">
                                <button class="btn btn-primary" type="submit">Actualizar</button>
                              
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-primary" type="submit">Eliminar</button>
                              
                            </div> -->
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>