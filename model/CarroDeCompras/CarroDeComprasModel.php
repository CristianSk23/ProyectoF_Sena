<?php
include_once "../model/MasterModel.php";


class CarroDeComprasModel extends MasterModel
{
    public function guardarProducto($product_id, $carroId, $cantidad, $color, $talla, $total)
    {

        $sql = "INSERT INTO detalle_carrito VALUES(?, ?, ?, null, ?, ?, ?)";
        $respuesta = $this->consultar($sql);

        return $respuesta;

    }


    public function obtenerCarro($usu_id)
    {
        $sql = "SELECT carro_id FROM carrito_compras WHERE usu_id =" . $usu_id;
        $respuesta = $this->consultar($sql);

        if ($respuesta) {
            echo $respuesta;
        }
    }



}


?>