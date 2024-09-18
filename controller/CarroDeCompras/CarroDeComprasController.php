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
        session_start(); // Asegúrate de que la sesión esté iniciada

        // Verificar si el usuario está logueado
        if (!isset($_SESSION['auth'])) {
            echo json_encode(['success' => false, 'message' => 'Debes estar logueado para agregar productos al carrito.']);
            exit();
        }

        // Verificar si se recibieron los datos necesarios
        if (isset($_POST['product_id'], $_POST['product_precio'], $_POST['color'], $_POST['talla'], $_POST['cantidad'])) {
            $product_id = intval($_POST['product_id']);
            $cantidad = intval($_POST['cantidad']);
            $color = htmlspecialchars($_POST['color'], ENT_QUOTES); // Escapar los valores de texto
            $precio = doubleval($_POST['product_precio']);
            $talla = htmlspecialchars($_POST['talla'], ENT_QUOTES);

            // Calcular el total para la cantidad actual
            $total = $cantidad * $precio;

            // Guardar el producto en el carrito
            $obj = new CarroDeComprasModel();
            if (isset($_SESSION['usu_id'])) {
                $id_usuario = $_SESSION['usu_id'];
                $carro_id = $obj->obtenerIdCarro($id_usuario);
                $idParse = (int) $carro_id;

                // Verificar si el producto ya está en el carrito con el mismo color y talla
                $productoExistente = $obj->validarExistenciaProd($product_id, $idParse, $color, $talla);

                var_dump($productoExistente);


                if ($productoExistente) {
                    // Si el producto ya está en el carrito, actualizar la cantidad sumando la nueva
                    $nuevaCantidad = $productoExistente['cantidad'] + $cantidad;
                    $nuevoTotal = $nuevaCantidad * $precio;

                    // Actualizar el producto con la nueva cantidad y el nuevo total
                    $obj->actualizarCantidadProducto($product_id, $idParse, $nuevaCantidad, $nuevoTotal);

                    echo json_encode(['success' => true, 'message' => 'Cantidad actualizada en el carrito.']);
                } else {
                    // Si no existe, agregar el producto al carrito
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
        ob_start(); // Iniciar el buffer de salida


        header('Content-Type: application/json'); // Configura el tipo de contenido como JSON

        if (isset($_SESSION['usu_id'])) {
            $usu_id = $_SESSION['usu_id'];
            $obj = new CarroDeComprasModel();
            $objProd = new ProductosModel();
            $carro_id = $obj->obtenerIdCarro($usu_id);
            $productoDetalle = [];

            $carro_id = (int) $carro_id;
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

            // Limpiar cualquier salida previa
            ob_end_clean();

            // Enviar la respuesta JSON
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
            $metodos=$objMetodo->getMetodoPago();
            $productoDetalle = [];
            $carro_id = (int) $carro_id;
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
            $idProducto = $_POST['product_id'];
            $prodEliminado = $obj->eliminarProductoCarrito($idProducto);
        }

        var_dump($prodEliminado);

    }



}




?>