<?php
include_once "../model/MasterModel.php";

class Registromodel extends MasterModel {

    public function RegistrarCliente($nombre, $apellido,$emailC, $password) {
        // Prepara la consulta SQL para evitar inyecciones SQL
        $sql = "INSERT INTO usuario (rol_id, usu_nombre, usu_apellido,usu_correo, usu_contrasenia, usu_estado) 
        VALUES (4,?,?,?, ?,1)";
        // Ejecuta la consulta SQL con parámetros
        $stmt = $this->getConnect()->prepare($sql);
        if ($stmt === false) {
            die('Error en la preparación de la consulta: ' . $this->getConnect()->error);
        }

        // Bind de parámetros y ejecución
        $stmt->bind_param('ssss', $nombre,$apellido, $emailC, $password);
        $respuesta = $stmt->execute();

        if (!$respuesta) {
            die('Error en la ejecución de la consulta: ' . $stmt->error);
        }
     
        return $respuesta;
    }

 
}
?>