<?php

include_once "../model/Acceso/AccesoModel.php";


class AccesoController
{


    public function is_valid_email($str)
    {
        return (false !== filter_var($str, FILTER_VALIDATE_EMAIL));
    }
    public function login()
    {
        $obj = new AccesoModel();

        $usu_email = $_POST["email"];
        $usu_password = $_POST["password"];



        $usuarios = $obj->login($usu_email, $usu_password);



        if (!empty($usu_email) && !empty($usu_password)) {
            if (mysqli_num_rows($usuarios) > 0) {
                echo "Con usuarios registrados";
                foreach ($usuarios as $usuario) {
                    $_SESSION['auth'] = "ok";
                    $_SESSION['usu_id'] = $usuario["usu_id"];
                    $_SESSION['nombre'] = $usuario["usu_nombre"];
                    $_SESSION['email'] = $usuario["usu_correo"];
                }
                redirect("index.php");
            } else {
                $_SESSION['error'] = "Email y/o contraseña incorrectas";
                redirect("login.php");
            }



        } else {
            $_SESSION['errorEmpty'] = "Recuerde rellenar el formulario";
            redirect("login.php");
        }


    }

    public function logout()
    {
        session_destroy();
        redirect("index.php");
    }



}


