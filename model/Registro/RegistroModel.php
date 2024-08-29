<?php
include_once "../model/MasterModel.php";

class Registromodel extends MasterModel {

    public function RegistrarC($nombre, $email, $password) {
        // Prepara la consulta SQL para evitar inyecciones SQL
        $sql = "INSERT INTO usuario (rol_id, usu_cedula, usu_nombre, usu_telefono, usu_correo, usu_contrasenia, usu_estado) 
        VALUES (1,2323,?, 4353453,?, ?,1)";
        // Ejecuta la consulta SQL con parámetros
        $stmt = $this->getConnect()->prepare($sql);
        if ($stmt === false) {
            die('Error en la preparación de la consulta: ' . $this->getConnect()->error);
        }

        // Bind de parámetros y ejecución
        $stmt->bind_param('sss', $nombre, $email, $password);
        $respuesta = $stmt->execute();

        if (!$respuesta) {
            die('Error en la ejecución de la consulta: ' . $stmt->error);
        }
     
        return $respuesta;
    }
}
?>