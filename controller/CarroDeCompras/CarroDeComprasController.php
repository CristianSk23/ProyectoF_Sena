<?php
include_once "../model/Acceso/AccesoModel.php";
include_once "../model/CarroDeCompras/CarroDeComprasModel.php";
include_once "../model/Productos/ProductosModel.php";
include_once "../model/Acceso/AccesoModel.php";
include_once "../model/CarroDeCompras/VentaModel.php";

class CarroDeComprasController
{


    public function agregarProducto()
    {



        if (!isset($_SESSION['auth'])) {
            echo json_encode(['success' => false, 'message' => 'Debes estar logueado para agregar productos al carrito.']);
            exit();
        }


        if (isset($_POST['product_id'], $_POST['product_precio'], $_POST['color'], $_POST['talla'], $_POST['cantidad'])) {
            $product_id = intval($_POST['product_id']);
            if ($_POST['cantidad'] != 0) {
                $cantidad = intval($_POST['cantidad']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Debes tener al menos una unidad seleccionada para guardar en el carro de compras']);
                exit();
            }
            $color = htmlspecialchars($_POST['color'], ENT_QUOTES);
            $precio = doubleval($_POST['product_precio']);
            $talla = htmlspecialchars($_POST['talla'], ENT_QUOTES);


            $total = $cantidad * $precio;


            $obj = new CarroDeComprasModel();
            if (isset($_SESSION['usu_id'])) {
                $id_usuario = $_SESSION['usu_id'];
                $carro_id = $obj->obtenerIdCarro($id_usuario);
                foreach ($carro_id as $carro) {

                    $idcarro = $carro;

                }
                $idParse = (int) $idcarro;


                $productoExistente = $obj->validarExistenciaProd($product_id, $idParse, $color, $talla);




                if ($productoExistente) {

                    $nuevaCantidad = $productoExistente['cantidad'] + $cantidad;
                    $nuevoTotal = $nuevaCantidad * $precio;


                    $obj->actualizarCantidadProducto($product_id, $idParse, $nuevaCantidad, $nuevoTotal);

                    echo json_encode(['success' => true, 'message' => 'Cantidad actualizada en el carrito.']);
                } else {
                    $this->contarProductosCarro($idParse);
                    $obj->guardarProducto($product_id, $idParse, $cantidad, $color, $talla, $total);

                    echo json_encode(['success' => true, 'message' => 'Producto agregado al carrito.']);
                }
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Faltan datos para agregar el producto al carrito.']);
        }

        exit();
    }


    public function obtenerCarro()
    {
        ob_start();


        header('Content-Type: application/json'); // Configura el tipo de contenido como JSON

        if (isset($_SESSION['usu_id'])) {
            $usu_id = $_SESSION['usu_id'];

            $obj = new CarroDeComprasModel();
            $objProd = new ProductosModel();
            $carro_id = $obj->obtenerIdCarro($usu_id);
            $productoDetalle = [];
            foreach ($carro_id as $carro) {

                $idcarro = $carro;

            }
            $carro_id = (int) $idcarro;
            $prodCarroCompra = $obj->getProdCarro($carro_id);

            foreach ($prodCarroCompra as $prod) {

                $producto = $objProd->getDetalleProducto($prod['product_id']);
                $stockProd = $objProd->getStockCarro($prod['product_id'], $prod['color'], $prod['talla']);
                //dd($stockProd);

                $fotos = $objProd->getFoto($prod['product_id']);
                $productoDetalle[] = [
                    'producto' => $producto,
                    'cantidad' => $prod['cantidad'],
                    'color' => $prod['color'],
                    'talla' => $prod['talla'],
                    'stock' => $stockProd,
                    'fotosProd' => $fotos
                ];
            }


            ob_end_clean();


            echo json_encode(['success' => true, 'productos' => $productoDetalle]);

        } else {
            ob_end_clean();
            echo json_encode(['success' => false, 'message' => 'Usuario no encontrado.']);
        }
    }


    public function obtenerCarroDetalle()
    {

        if (isset($_GET['usu_id'])) {
            $usu_id = $_GET['usu_id'];
            $obj = new CarroDeComprasModel();
            $objProd = new ProductosModel();
            $objMetodo = new VentaModel();
            $carro_id = $obj->obtenerIdCarro($usu_id);
            $ciudades = $obj->getCiudades();
            $metodos = $objMetodo->getMetodoPago();
            $productoDetalle = [];

            foreach ($carro_id as $carro) {

                $idcarro = $carro;

            }

            $carro_id = (int) $idcarro;
            $prodCarroCompra = $obj->getProdCarro($carro_id);


            foreach ($prodCarroCompra as $prod) {
                $producto = $objProd->getDetalleProducto($prod['product_id']);
                $stockProd = $objProd->getStockCarro($prod['product_id'], $prod['color'], $prod['talla']);
                $fotos = $objProd->getFoto($prod['product_id']);
                $productoDetalle[] = [
                    'producto' => $producto,
                    'cantidad' => $prod['cantidad'],
                    'color' => $prod['color'],
                    'talla' => $prod['talla'],
                    'stock' => $stockProd,
                    'fotosProd' => $fotos
                ];
            }


            include_once "../web/CarroDeCompras.php";

        }
    }


    public function precioEnvioPorCiudad()
    {

        header('Content-Type: application/json');
        $obj = new CarroDeComprasModel();
        if (isset($_POST['ciu_id'])) {
            $ciu_id = $_POST['ciu_id'];
            $precioEnvio = $obj->getPrecioPorCiudad($ciu_id);

            echo json_encode(['precioEnvio' => $precioEnvio]);
        }
    }




    public function contarProductosCarro($carro_id)
    {
        $obj = new CarroDeComprasModel();
        $idCarro = $_SESSION['carro_id'];
        $carro_id = (int) $idCarro;
        $cantidad = $obj->getCantProductos($carro_id);

        return $cantidad;
    }


    public function eliminarProd()
    {
        $obj = new CarroDeComprasModel();
        if (isset($_POST['product_id'])) {
            $usu_id = $_SESSION['usu_id'];
            $idProducto = $_POST['product_id'];
            $eliminar = $obj->eliminarProductoCarrito($idProducto);
            if ($eliminar == 1) {
                echo 1;
            } else {
                echo 2;

            }
        }

    }


    public function actualizarCantidad()
    {


    }



}




?>