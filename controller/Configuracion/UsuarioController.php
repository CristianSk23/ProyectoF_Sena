<?php

include_once "../model/Configuracion/UsuarioModel.php";



class UsuarioController
{
    public function registrarUsuario()
    {
        $roles = $this->obtenerRoles();

        include_once "../view/configuracion/usuarios/ViewRegistroUsuario.php";

    }
    public function registroUsuario()
    {
        $obj = new UsuarioModel();


        // Sanitizar datos de entrada
        extract($_POST);



        if (empty($rol_id) || empty($usu_cedula) || empty($usu_nombre) || empty($usu_apellido) || empty($usu_telefono) || empty($usu_correo) || empty($usu_contrasenia)) {
            $_SESSION['errorEmpty'] = "Todos los campos son requeridos.";
            return;
        }

        /*  $_SESSION['errorEmpty'] = "Todos los campos son requeridos.";
         */
        /*  $correo = $obj->VerificarCorreo($usu_correo);
         if ($correo) {
             $_SESSION['error'] = "El correo ya existe.";
             redirect(getUrl("Configuracion", "Usuario", "registrarUsuario"));
             return;
         } */

        // Prepara la consulta reemplazando manualmente los parámetros
        $sql = sprintf(
            "INSERT INTO usuario (rol_id, usu_cedula, usu_nombre, usu_apellido, usu_telefono, usu_correo, usu_contrasenia) 
        VALUES ('%d', '%d', '%s', '%s', '%d', '%s', '%s')",
            $rol_id,
            $usu_cedula,
            $usu_nombre,
            $usu_apellido,
            $usu_telefono,
            $usu_correo,
            $usu_contrasenia
        );

        //dd($sql);


        $ejecutar = $obj->insertar($sql);

        if ($ejecutar) {
            // $id = $obj->lastInsertId('usuario', 'usu_id');
            // $_SESSION['id'] = $id;
            redirect(getUrl("Configuracion", "Usuario", "registrarUsuario"));
        } else {
            $_SESSION['error'] = "Error al registrar el usuario. Inténtalo de nuevo.";
        }
    }

    public function consultarUsuario()
    {

        $obj = new UsuarioModel();
        $sql = "SELECT usuario.*, rol.rol_nombre AS rol_nombre 
        FROM usuario 
        JOIN rol ON usuario.rol_id = rol.rol_id 
        WHERE usuario.usu_estado = 1 
        AND usuario.rol_id != 4 
        AND usuario.rol_id != 2";

        $usuarios = $obj->consultar($sql);

        include_once "../view/configuracion/usuarios/ViewConsultaUsuario.php";


    }


    public function getUpdate()
    {
        $obj = new UsuarioModel();
        $usu_id = $_GET['usu_id'];

        $sql = "SELECT * FROM usuario WHERE usu_id = $usu_id";

        $usuarios = $obj->consultar($sql);
        $roles = $this->obtenerRoles();
        include_once "../view/configuracion/usuarios/ViewEditarUsuario.php";


    }

    public function postUpdate()
    {
        $obj = new UsuarioModel();

        $usu_id = $_POST['usu_id'];
        $rol_id = $_POST['rol_id'];
        $usu_cedula = $_POST['usu_cedula'];
        $usu_nombre = $_POST['usu_nombre'];
        $usu_apellido = $_POST['usu_apellido'];
        $usu_telefono = $_POST['usu_telefono'];
        $usu_correo = $_POST['usu_correo'];
        $usu_contrasenia = $_POST['usu_contrasenia'];


        if ($usu_id == "" || $rol_id == "" || $usu_cedula == "" || $usu_nombre == "" || $usu_apellido == "" || $usu_telefono == "" || $usu_correo == "" || $usu_contrasenia == "") {
            $_SESSION['editarUsuario'] = "Por favor diligencie los datos";
            redirect(getUrl("Configuracion", "Usuario", "getUpdate", array("usu_id" => $usu_id)));
        } else {
            $sql = "UPDATE usuario SET rol_id=$rol_id, usu_cedula=$usu_cedula, usu_nombre='$usu_nombre', usu_apellido='$usu_apellido', 
            usu_telefono=$usu_telefono, usu_correo='$usu_correo', usu_contrasenia='$usu_contrasenia' WHERE usu_id =$usu_id";
            $ejecutar = $obj->editar($sql);
            if ($ejecutar) {
                redirect(getUrl("Configuracion", "Usuario", "consultarUsuario"));
            } else {
                echo "La edicion fallo";
            }
        }


    }

    public function obtenerRoles()
    {
        $obj = new UsuarioModel();
        extract($_POST);

        $sql = "SELECT rol_id, rol_nombre FROM rol WHERE rol_id != 4 AND rol_id != 2";
        $ejecutar = $obj->consultar($sql);
        $roles = [];
        if ($ejecutar && $ejecutar->num_rows > 0) {
            while ($row = $ejecutar->fetch_assoc()) {
                $roles[] = $row;
            }
        }
        return $roles;
    }
    public function delete()
    {
        $obj = new UsuarioModel();
        $usu_id = $_POST['usu_id'];
        $sql = "UPDATE usuario SET usu_estado=0 WHERE usu_id =$usu_id";
        $ejecutar = $obj->editar($sql);
        if ($ejecutar) {
            echo 1;
        } else {
            echo 2;
        }
    }
    /////////////////Clientes//////////////////

    public function consultarCliente()
    {

        $obj = new UsuarioModel();
        $usu_id = $_SESSION['usu_id'];
        $sql = "SELECT * FROM usuario  
        WHERE usuario.usu_estado = 1 
        AND usuario.usu_id = $usu_id";
        ;

        $usuarios = $obj->consultar($sql);

        include_once "../view/configuracion/clientes/ViewConsultarCliente.php";


    }
    public function Actualizar()
    {
        $obj = new UsuarioModel();
        $usu_id = isset($_POST['usu_id']) ? (int) $_POST['usu_id'] : 0;
        $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($obj->getConnect(), $_POST['nombre']) : '';
        $apellido = isset($_POST['apellido']) ? mysqli_real_escape_string($obj->getConnect(), $_POST['apellido']) : '';
        $documento = isset($_POST['documento']) ? mysqli_real_escape_string($obj->getConnect(), $_POST['documento']) : '';
        $telefono = isset($_POST['telefono']) ? mysqli_real_escape_string($obj->getConnect(), $_POST['telefono']) : '';

        // Construir la consulta SQL
        $sql = "UPDATE usuario SET usu_nombre = '$nombre', usu_apellido = '$apellido', usu_cedula = '$documento', usu_telefono = '$telefono' WHERE usu_id = $usu_id";

        // Ejecutar la consulta
        $resultado = $obj->editar($sql);

        // Devolver respuesta
        if ($resultado) {
            echo 'success';
        } else {
            echo 'error';
        }
    }



}
