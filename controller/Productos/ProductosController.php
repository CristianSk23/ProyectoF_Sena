<?php
//include_once "../model/Acceso/AccesoModel.php";
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

        /*  echo "Entrando a la función detalleProducto()<br>";

     
         echo "<pre>";
         var_dump($resultado);
         echo "</pre>"; */


        include_once "../view/Productos/detalleProductos.php";
    }
}