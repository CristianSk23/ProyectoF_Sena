<?php
include_once "../model/Acceso/AccesoModel.php";
include_once "../model/CarroDeCompras/CarroDeComprasModel.php";
include_once "../model/Productos/ProductosModel.php";
include_once "../model/Acceso/AccesoModel.php";

class CarroDeComprasController
{

    /* public function agregarProducto()
    {


        session_start(); // Inicia la sesión

        if (!isset($_SESSION['auth'])) {
            // Si no está logueado, guarda un mensaje en la sesión y redirige al login
            $_SESSION['login'] = "Por favor ingrese a su cuenta para agregar productos al carrito";
            echo json_encode(['success' => false, 'message' => 'Debes estar logueado para agregar productos al carrito.']);
            header("Location: " . getUrl("Acceso", "Acceso", "login"));
            exit();
        }

        $product_id = $_POST['product_id'];
        $cantidad = $_POST['cantidad'];
        $color = $_POST['color'];
        $talla = $_POST['talla'];
        $precio = $_POST['product_precio'];

        $total = $cantidad * $precio;

        $obj = new CarroDeComprasModel();
        $obj->guardarProducto($product_id, 1, $cantidad, $color, $talla, $total);
        echo json_encode(['success' => true, 'message' => 'Producto agregado al carrito']);
        exit();

    } */


    public function agregarProducto()
    {
        session_start(); // Asegúrate de que la sesión esté iniciada

        // Verificar si el usuario está logueado
        if (!isset($_SESSION['auth'])) {
            // Si no está logueado, devuelve una respuesta JSON
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

            // Calcular el total
            $total = $cantidad * $precio;

            // Guardar el producto en el carrito
            $obj = new CarroDeComprasModel();
            $obj->guardarProducto($product_id, 1, $cantidad, $color, $talla, $total);

        } else {
            echo json_encode(['success' => false, 'message' => 'Faltan datos para agregar el producto al carrito.']);
        }

        exit();
    }




    public function obtenerCarro()
    {
        ob_start(); // Iniciar el buffer de salida

        header('Content-Type: application/json'); // Configura el tipo de contenido como JSON

        if (isset($_POST['usu_id'])) {
            $usu_id = $_POST['usu_id'];
            $obj = new CarroDeComprasModel();
            $objProd = new ProductosModel();
            $carro_id = $obj->obtenerIdCarro($usu_id);

            $productoDetalle = [];

            foreach ($carro_id as $carro) {
                $id = $carro["carro_id"];
            }
            $prodCarroCompra = $obj->getProdCarro($id);

            foreach ($prodCarroCompra as $prod) {
                $producto = $objProd->getDetalleProducto($prod['product_id']);
                $stockProd = $objProd->getStockCarro($prod['product_id'], $prod['color'], $prod['talla']);

                $productoDetalle[] = [
                    'producto' => $producto,
                    'cantidad' => $prod['cantidad'],
                    'color' => $prod['color'],
                    'talla' => $prod['talla'],
                    'stock' => $stockProd
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



}

/*  $product_id = $_POST['product_id'];
    $cantidad = $_POST['cantidad'];
    $color = $_POST['color'];
    $talla = $_POST['talla'];
    $precio = $_POST['product_precio'];

    $total = $cantidad * $precio;
    echo "Este es el total " . $total;

    $obj = new CarroDeComprasModel();
    $ejecutar = $obj->guardarProducto($product_id, 1, $cantidad, $color, $talla, $total);*/


// Verifica si la sesión 'auth' está activa
/* 
} */

?>