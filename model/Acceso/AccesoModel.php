<?php
include_once "../model/MasterModel.php";

class AccesoModel extends MasterModel
{
    public function Login1($email, $password)
    {
        $sql = "SELECT * FROM usuario WHERE usu_correo = '$email' AND usu_contrasenia =  '$password' AND usu_estado=1";
        $respuesta = $this->consultar($sql);
        return $respuesta;
    }

    public function carrito($usu_id){
        $sql = "SELECT carro_id FROM carrito_compras WHERE usu_id = $usu_id";
        $respuesta = $this->consultar($sql);
    }
}


?>