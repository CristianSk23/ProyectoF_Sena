<?php

include_once "../lib/conf/connection.php";

class MasterModel extends Connection
{

    public function insertar($sql)
    {
        $respuesta = mysqli_query($this->getConnect(), $sql);
        return $respuesta;
    }

    public function consultar($sql)
    {
        $respuesta = mysqli_query($this->getConnect(), $sql);
        return $respuesta;
    }

    public function editar($sql)
    {
        $respuesta = mysqli_query($this->getConnect(), $sql);
        return $respuesta;
    }

    public function eliminar($sql)
    {
        $respuesta = mysqli_query($this->getConnect(), $sql);
        return $respuesta;
    }

    public function autoincrement($table, $field)
    {
        $sql = "SELECT MAX($field) FROM $table";
        $respuesta = $this->consultar($sql);
        $contador = mysqli_fetch_row($respuesta);
        return $contador[0] + 1;
    }

    public function lastInsertId($table, $field)
    {
        $sql = "SELECT MAX($field) FROM $table";
        $respuesta = $this->consultar($sql);
        $contador = mysqli_fetch_row($respuesta);
        return $contador[0];
    }

    public function VerificarCorreo($email) {
        $sql= "SELECT usu_correo FROM usuario WHERE usu_correo = '$email'";
        $respuesta = $this->consultar($sql);
        $existe = $respuesta->num_rows > 0;
        return $existe; 
    }

    public function verificarDocumento($documento){
        $sql= "SELECT usu_cedula FROM usuario WHERE usu_cedula = '$documento'";
        $respuesta = $this->consultar($sql);
        $existe = $respuesta->num_rows > 0;
        return $existe;
    }
    public function is_valid_email($str)
    {
        return (false !== filter_var($str, FILTER_VALIDATE_EMAIL));
    }
   
}

?>