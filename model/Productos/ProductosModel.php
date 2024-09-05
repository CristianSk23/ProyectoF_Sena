<?php
include_once "../model/MasterModel.php";

class ProductosModel extends MasterModel
{
    public function getProductos()
    {
        $sql = "SELECT * FROM producto";

        $respuesta = $this->consultar($sql);


        return $respuesta;
    }
    public function getDetalleProducto($id)
    {
        $sql = "SELECT * FROM producto WHERE product_id = $id";

        $respuesta = $this->consultar($sql);
        if ($respuesta) {

            $producto = mysqli_fetch_assoc($respuesta);


            return $producto;
        } else {
            return "No se encontraron resultados.";
        }

    }


    public function getStock($product_id)
    {


        $sql = "SELECT * FROM stock WHERE product_id = $product_id";
        $respuesta = $this->consultar($sql);
        if ($respuesta && $respuesta->num_rows > 0) {
            //* Convierte el resultado a un array asociativo
            return $respuesta->fetch_all(MYSQLI_ASSOC);
        } else {
            return null;
        }
    }

}
