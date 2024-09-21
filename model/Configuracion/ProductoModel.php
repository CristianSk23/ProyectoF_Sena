<?php

include_once "../model/MasterModel.php";


Class ProductoModel extends MasterModel{

    public function validarNombre($nombre)
    {
        $obj = new ProductoModel();
        $sql = "SELECT * FROM producto WHERE product_nombre = '$nombre' ";
        $ejecutar = $obj->consultar($sql);

        // Comprobar si el producto existe
        if ($ejecutar->num_rows > 0) {
            $row = $ejecutar->fetch_assoc();
            if ($row > 0) {
                return 1;
            } else {
                return 0;
            }
        }
    }
}

