<?php
include_once "../model/MasterModel.php";


class CarroDeComprasModel extends MasterModel
{
    public function guardarProducto($product_id, $carroId, $cantidad, $color, $talla, $total)
    {

        $sql = "INSERT INTO detalle_carrito VALUES($product_id, $carroId, $cantidad, null, '$color', '$talla', $total)";
        $respuesta = $this->consultar($sql);
        return $respuesta;

    }


    public function obtenerIdCarro($usu_id)
    {
        $sql = "SELECT carro_id FROM carrito_compras WHERE usu_id =" . $usu_id;
        $respuesta = $this->consultar($sql);

        if ($respuesta) {
            return $respuesta->fetch_all(MYSQLI_ASSOC);
        }
    }

    public function getProdCarro($carroId)
    {

        $sql = "SELECT * FROM detalle_carrito WHERE carroId =" . $carroId;
        $respuesta = $this->consultar($sql);

        if ($respuesta) {
            return $respuesta->fetch_all(MYSQLI_ASSOC);
        }
    }



}


?>