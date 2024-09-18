<?php
include_once "../model/MasterModel.php";


class CarroDeComprasModel extends MasterModel
{
    public function guardarProducto($product_id, $carro_id, $cantidad, $color, $talla, $total)
    {

        $sql = "INSERT INTO detalle_carrito VALUES($product_id, $carro_id, $cantidad, null, '$color', '$talla', $total)";
        $respuesta = $this->consultar($sql);
        return $respuesta;

    }


    public function obtenerIdCarro($usu_id)
    {
        $sql = "SELECT carro_id FROM carrito_compras WHERE usu_id = '$usu_id'";
        $respuesta = $this->consultar($sql);

        if ($respuesta) {
            // Asumiendo que $respuesta es un recurso de base de datos
            $carroId = mysqli_fetch_assoc($respuesta); // O la función equivalente para tu base de datos
            return $carroId;
        }

        return null; // En caso de que no haya resultados
    }

    public function getProdCarro($carro_id)
    {

        $sql = "SELECT * FROM detalle_carrito WHERE carro_id = $carro_id";
        $respuesta = $this->consultar($sql);

        if ($respuesta) {
            return $respuesta->fetch_all(MYSQLI_ASSOC);
        }
    }

    public function getCantProductos($carro_id)
    {
        $sql = "SELECT COUNT(*) AS total_productos FROM detalle_carrito WHERE carro_id = $carro_id";
        $respuesta = $this->consultar($sql);
        if ($respuesta) {
            $row = $respuesta->fetch_assoc();
            return $row['total_productos'] ?: 0; // Retorna 0 si no hay productos
        }
    }

    public function getCiudades()
    {
        $sql = "SELECT * FROM ciudades";
        $respuesta = $this->consultar($sql);

        if ($respuesta) {
            return $respuesta->fetch_all(MYSQLI_ASSOC);
        }
    }


    public function getPrecioPorCiudad($id_ciudad)
    {

        $sql = "SELECT * FROM ciudades WHERE ciu_id = " . $id_ciudad;
        $respuesta = $this->consultar($sql);

        if ($respuesta) {
            return $respuesta->fetch_all(MYSQLI_ASSOC);
        }
    }

    public function eliminarProductoCarrito($idProducto)
    {
        $sql = "DELETE FROM detalle_carrito WHERE product_id = " . $idProducto;
        $respuesta = $this->consultar($sql);

        if ($respuesta) {
            return $respuesta->fetch_all(MYSQLI_ASSOC);
        }
    }

    public function validarExistenciaProd($product_id, $carro_id, $color, $talla)
    {
        $sql = "SELECT cantidad FROM detalle_carrito WHERE product_id = $product_id
         AND carro_id = $carro_id
         AND color = '$color'
         AND talla = '$talla'";

        $respuesta = $this->consultar($sql);

        if ($respuesta) {
            return $respuesta->fetch_assoc();
        }

    }
    public function actualizarCantidadProducto($product_id, $carro_id, $nuevaCantidad, $nuevoTotal)
    {
        $sql = "UPDATE detalle_carrito SET cantidad = $nuevaCantidad, total = $nuevoTotal WHERE product_id = $product_id AND carroId =  $carro_id ";
        $respuesta = $this->consultar($sql);

        if ($respuesta) {
            return $respuesta->fetch_assoc();
        }


    }



}


?>