<?php
include_once "../model/Acceso/AccesoModel.php";
include_once "../model/Productos/ProductosModel.php";
class ProductosController
{

    public function productos()
    {

        $obj = new ProductosModel();
        $resultados = $obj->getProductos();


        return $resultados;
    }
    public function detalleProducto()
    {
        $id = $_GET['id'];
        $obj = new ProductosModel();
        $resultado = $obj->getDetalleProducto($id);

        include_once "../view/Productos/detalleProductoModal.php";
    }



}
//return $resultado;
/*  echo "<pre>";
 var_dump($resultado);
 echo "</pre>"; */