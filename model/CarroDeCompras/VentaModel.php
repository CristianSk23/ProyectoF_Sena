<?php
include_once "../model/MasterModel.php";

class VentaModel extends MasterModel{

    public function getMetodoPago()
    {
        $sql = "SELECT * FROM metodo_pago";
        $respuesta = $this->consultar($sql);
        
         return $respuesta;
        }
        
    public function actualizarStock($idproducto_venta){

        $sql = "UPDATE stock SET stock_cantidad = stock_cantidad - ( SELECT cantidad_Producto  FROM producto_venta WHERE idProducto_venta = $idproducto_venta)
        WHERE stock_id = (SELECT stock_id FROM producto_venta WHERE idProducto_venta = $idproducto_venta)";
        
        $respuesta = $this->consultar($sql);

        
        return $respuesta;

    }
    }


  



?>