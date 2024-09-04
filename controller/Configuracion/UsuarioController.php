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
        extract($_POST);
       

        if (empty($rol_id) || empty($usu_cedula) || empty($usu_nombre) || empty($usu_apellido) || empty($usu_telefono) || empty($usu_correo) || empty($usu_contrasenia)) {
           

            $_SESSION['errorEmpty'] = "Todos los campos son requeridos.";
            return;
        }

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

        $ejecutar = $obj->insertar($sql);


        if ($ejecutar) {
            $_SESSION['success'] = "Registro exitoso.";
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

        $usuarios  = $obj->consultar($sql);
        
        include_once "../view/configuracion/usuarios/ViewConsultaUsuario.php";   
   

    }

    public function obtenerRoles()
    {
        $obj = new UsuarioModel();
       // extract($_POST);

        $sql = "SELECT rol_id, rol_nombre FROM rol";
        $ejecutar = $obj->consultar($sql);
        $roles = [];
        if ($ejecutar && $ejecutar->num_rows > 0) {
            while ($row = $ejecutar->fetch_assoc()) {
                $roles[] = $row;
            }
        }
        return $roles;
    }



}
