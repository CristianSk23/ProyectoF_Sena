<?php

include_once "../model/Acceso/AccesoModel.php";
include_once "../model/CarroDeCompras/CarroDeComprasModel.php";

class AccesoController
{

    public function login()
    {
        $obj = new AccesoModel();
        $objC = new CarroDeComprasModel();
        $usu_email = $_POST["email"];
        $usu_password = $_POST["password"];


        // Consulta para verificar si el usuario existe
        $usuarios = $obj->Login1($usu_email, $usu_password);
        /* dd($usuarios); */

        // Verifica si los campos de correo y contraseña no están vacíos
        if (!empty($usu_email) && !empty($usu_password)) {
            if (mysqli_num_rows($usuarios) > 0) {

                foreach ($usuarios as $usuario) {
                    // Guarda los datos del usuario en la sesión
                    $_SESSION['auth'] = "ok";
                    $_SESSION['usu_id'] = $usuario["usu_id"];
                    $_SESSION['nombre'] = $usuario["usu_nombre"];
                    $_SESSION['email'] = $usuario["usu_correo"];
                    $_SESSION['rol_id'] = $usuario["rol_id"];
                    //var_dump($usuario);


                }
                //dd($_SESSION['usu_id']);
                $carrito = $objC->obtenerIdCarro($usuario['usu_id']);
                $_SESSION['carro_id'] = $carrito['carro_id'];
                var_dump($_SESSION['usu_id']);
                redirect("index.php");
            } else {
                // Si no hay coincidencias, muestra un mensaje de error
                $_SESSION['error'] = "Email y/o contraseña incorrectas";
                redirect("login.php"); // Redirige al formulario de login
            }
        } else {
            // Si algún campo está vacío, muestra un mensaje de error
            $_SESSION['errorEmpty'] = "Recuerde rellenar el formulario";
            redirect("login.php"); // Redirige al formulario de login
        }
    }

    // Método para cerrar la sesión
    public function logout()
    {

        session_destroy(); // Destruye la sesión
        redirect("index.php"); // Redirige al formulario de login
    }
}



