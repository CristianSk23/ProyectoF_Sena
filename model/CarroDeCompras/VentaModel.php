<?php
include_once "../model/MasterModel.php";

class VentaModel extends MasterModel
{

    public function getMetodoPago()
    {
        $sql = "SELECT * FROM metodo_pago";
        $respuesta = $this->consultar($sql);

        return $respuesta;
    }

    public function actualizarStock($idproducto_venta)
    {

        $sql = "UPDATE stock SET stock_cantidad = stock_cantidad - ( SELECT cantidad_Producto  FROM producto_venta WHERE idProducto_venta = $idproducto_venta)
        WHERE stock_id = (SELECT stock_id FROM producto_venta WHERE idProducto_venta = $idproducto_venta)";

        $respuesta = $this->consultar($sql);


        return $respuesta;
    }

    public function limpiarCarrito($carro_id)
    {

        $sql = "DELETE FROM detalle_carrito WHERE carro_id = $carro_id";
        $respuesta = $this->eliminar($sql);
        return $respuesta;
    }

    public function historialCompras($usu_id)
    {
        $sql = "SELECT * FROM venta INNER JOIN usuario  ON venta.usu_id = usuario.usu_id WHERE usuario.usu_id = $usu_id";
        $respuesta = $this->consultar($sql);

        if ($respuesta) {
            $idVenta = []; // Inicializar el arreglo

            while ($row = mysqli_fetch_assoc($respuesta)) {
                $idVenta[] =
                    array(
                        "idVenta" => $row['idVenta'],
                        "usu_id" => $row['usu_id'],
                        "idEnvio" => $row['idEnvio'],
                        "totalVenta" => $row['totalVenta'],
                        "usu_nombre" => $row['usu_nombre']

                    ); // Agregar cada idVenta al arreglo
            }

            return $idVenta; // Retornar el arreglo con los idVenta
        }

        return []; // Retornar null si no hay resultados
    }

    public function getFActura($idventa)
    {
        $sql = "SELECT * FROM venta
        INNER JOIN usuario ON venta.usu_id = usuario.usu_id
        INNER JOIN envio ON envio.idEnvio = venta.idEnvio
        INNER JOIN metodo_pago ON envio.idMetodo_pago = metodo_pago.idMetodo_pago
        INNER JOIN ciudades ON envio.ciu_id = ciudades.ciu_id
        WHERE idVenta = $idventa";
        try {
            $respuesta = $this->consultar($sql);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return mysqli_fetch_assoc($respuesta);
    }

    public function getUsuario($idVenta)
    {

        $sql = "SELECT * FROM usuario INNER JOIN venta ON venta.usu_id = usuario.usu_id WHERE idVenta = $idVenta";
        try {
            $respuesta = $this->consultar($sql);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return mysqli_fetch_assoc($respuesta);
    }
    public function productos($idVenta)
    {
        $sql = "SELECT * FROM stock 
                INNER JOIN producto_venta ON stock.stock_id = producto_venta.stock_id 
                INNER JOIN venta ON venta.idVenta = producto_venta.idVenta
                INNER JOIN producto ON stock.product_id = producto.product_id
                INNER JOIN envio ON envio.idEnvio = venta.idEnvio
                WHERE venta.idVenta = $idVenta";

        $productos = []; // Inicializar el array para los productos

        try {
            $respuesta = $this->consultar($sql);

            // Bucle para obtener todas las filas
            while ($row = mysqli_fetch_assoc($respuesta)) {
                $productos[] = $row; // Agregar cada fila al array
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return $productos; // Retornar el array de productos
    }
}
