<?php
include_once "../model/MasterModel.php";

class VentaModel extends MasterModel{

    public function getMetodoPago()
    {
        $sql = "SELECT * FROM metodo_pago";
        $respuesta = $this->consultar($sql);
        
         return $respuesta;
        }
    }

  



?>