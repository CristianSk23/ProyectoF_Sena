<?php
include_once "../model/Acceso/AccesoModel.php";
include_once "../model/Productos/ProductosModel.php";
class ProductosController
{

    public function productos()
    {

        $obj = new ProductosModel();
        $resultados = $obj->getProductos();
        $productosConDetalle = [];
        if ($resultados) {
            foreach ($resultados as $producto) {
                $product_id = $producto['product_id']; // Suponiendo que el campo del ID se llama 'product_id'

                // Obtener los detalles del producto usando el ID
                $detalles = $obj->getStock($product_id);

                // Verifica si se han encontrado detalles
                if ($detalles) {
                    $producto["detalles"] = $detalles;

                } else {
                    $producto['detalles'] = null;
                }
                $productosConDetalle[] = $producto;
            }
            //var_dump($productosConDetalle[]);


            return $productosConDetalle;
        }

        return null;


    }



    public function detalleProducto()
    {
        $id = $_GET['id'];
        $obj = new ProductosModel();
        $resultado = $obj->getDetalleProducto($id);

        $productoConDetalle = [];
        if ($resultado) {
            $product_id = $resultado['product_id']; // Obtener el ID del producto

            // Obtener los detalles del stock asociado al producto

            $detalles = $obj->getStock($product_id);


            // Construir el array con los detalles del producto y su stock
            $productoConDetalle = $resultado;
            $productoConDetalle['detalles'] = $detalles;

            // Pasar los datos a la vista
            include_once "../view/Productos/detalleProductoModal.php";
        }

        //include_once "../view/Productos/detalleProductoModal.php";
    }



}
//return $resultado;
/*  echo "<pre>";
 var_dump($resultado);
 echo "</pre>"; */