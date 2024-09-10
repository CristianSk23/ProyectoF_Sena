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

            $coloresUnicos = [];
            $tallasUnicas = [];
            $detallesFiltrados = [];

            foreach ($detalles as $detalle) {
                // Verificar que tanto el color como la talla estén definidos
                if (isset($detalle['stock_color']) && isset($detalle['stock_talla'])) {
                    $color = $detalle['stock_color'];
                    $talla = $detalle['stock_talla'];

                    // Si el color no está ya en el array de colores únicos, lo agregamos
                    if (!in_array($color, $coloresUnicos)) {
                        $coloresUnicos[] = $color;
                    }

                    // Si la talla no está ya en el array de tallas únicas, la agregamos
                    if (!in_array($talla, $tallasUnicas)) {
                        $tallasUnicas[] = $talla;
                    }

                    // Filtrar detalles agregando solo combinaciones únicas de color y talla
                    if (
                        !in_array($color, array_column($detallesFiltrados, 'stock_color')) ||
                        !in_array($talla, array_column($detallesFiltrados, 'stock_talla'))
                    ) {
                        $detallesFiltrados[] = $detalle;
                    }
                }
            }

            $productoConDetalle = $resultado;
            $productoConDetalle['detalles'] = $detallesFiltrados;
            // Pasar los datos a la vista
            include_once "../view/Productos/detalleProductoModal.php";
        }


    }


    public function obtenerTalla()
    {
        $id = $_GET['id'];
        $color = $_GET['color'];
        $obj = new ProductosModel();
        $resultado = $obj->getTalla($id, $color);
        return $resultado;
    }






}
//return $resultado;
/*  echo "<pre>";
 var_dump($resultado);
 echo "</pre>"; */