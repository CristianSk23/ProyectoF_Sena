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
        ;
        if ($resultados) {
            foreach ($resultados as $producto) {
                $product_id = $producto['product_id']; // Suponiendo que el campo del ID se llama 'product_id'

                // Obtener los detalles del producto usando el ID
                $detalles = $obj->getStock($product_id);
                $fotos_prod = $obj->getFoto($product_id);
                foreach ($fotos_prod as $foto) {

                    $fotoProd = $foto['foto_img'];
                }

                // Verifica si se han encontrado detalles
                if ($detalles) {
                    $producto["detalles"] = $detalles;

                } else {
                    $producto['detalles'] = null;
                }

                if ($fotos_prod) {
                    $producto["fotos"] = $fotoProd;

                } else {
                    $producto["fotos"] = null;
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
            $fotos = $obj->getFoto($product_id);

            $coloresUnicos = [];
            $tallasUnicas = [];
            $detallesFiltrados = [];
            $fotosProducto = [];

            if (!empty($fotos)) {
                foreach ($fotos as $foto) {
                    $fotosProducto[] = $foto['foto_img']; // Guardamos todas las imágenes en el array
                }
            }



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
                        // Agregar las fotos al detalle del producto
                        $detalle['fotos'] = $fotosProducto;


                        // Agregar el detalle filtrado
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

        if (isset($_GET['color'])) {
            $colorSeleccionado = $_GET['color'];
            $productId = $_GET['product_id'];


            $obj = new ProductosModel();
            $detalles = $obj->getTalla($productId, $colorSeleccionado); // Filtrar por color

            // Crear un array para las tallas
            $tallas = [];

            // Recorrer los detalles filtrados y obtener las tallas únicas
            foreach ($detalles as $detalle) {
                if (!in_array($detalle['stock_talla'], $tallas)) {
                    $tallas[] = $detalle['stock_talla'];
                }
            }

            // Devolver las tallas en formato JSON
            echo json_encode($tallas);
        }

    }






}
//return $resultado;
/*  echo "<pre>";
 var_dump($resultado);
 echo "</pre>"; */