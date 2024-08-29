<?php include_once "../lib/helpers.php"; ?>

<head>
    <link rel="stylesheet" href="styleLogin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</head>

<section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
                        <!-- Mensajes de Error -->
                        <div class="d-flex justify-content-center">
                            <?php
                            if (isset($_SESSION["error"])) {
                                ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?= $_SESSION['error'] ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                <?php
                                unset($_SESSION["error"]);
                            }

                            if (isset($_SESSION["errorEmpty"])) {
                                ?>
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <?= $_SESSION['errorEmpty'] ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                <?php
                                unset($_SESSION["errorEmpty"]);
                            }
                            ?>
                        </div>

                        <div class="mb-md-5 mt-md-4 pb-5">
                            <form action="<?php echo getUrl("Registro", "Registro", "RegistrarC", array("id"=>1)); ?>" method="POST">
                                <!-- Título -->
                                <h2 class="fw-bold mb-2 text-uppercase">Registrarse</h2>

                                <!-- Nombre -->
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <label class="form-label" for="registerName">Nombre</label>
                                    <input type="text" id="registerName" name="nombre" class="form-control" required />
                                </div>

                                <!-- Email -->
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <label class="form-label" for="registerEmail">Correo</label>
                                    <input type="email" id="email" name="email" class="form-control" required />
                                </div>

                                <!-- Contraseña -->
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <label class="form-label" for="registerPassword">Contraseña</label>
                                    <input type="password" id="password" name="password" class="form-control" required />
                                </div>

                                <!-- Confirmar Contraseña -->
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <label class="form-label" for="registerRepeatPassword">Confirmar Contraseña</label>
                                    <input type="password" id="repeatPassword" name="repeatPassword" class="form-control" required />
                                </div>

                                <!-- Términos -->
                                <div class="form-check d-flex justify-content-center mb-4">
                                    <input class="form-check-input me-2" type="checkbox" value="" id="registerCheck" required />
                                    <label class="form-check-label" for="registerCheck">
                                        He leído y acepto los términos.
                                    </label>
                                </div>

                                <!-- Botón de Envío -->
                                <button type="submit" class="btn btn-primary btn-block mb-3">Registrarse</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>