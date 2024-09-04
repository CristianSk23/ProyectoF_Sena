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

        if (!isset($_SESSION['auth'])) {
            // Si no está logueado, devuelve una respuesta JSON
            echo json_encode(['success' => false, 'message' => 'Debes estar logueado para agregar productos al carrito.']);
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
    }



    public function obtenerCarro()
    {
        if (isset($_POST['usu_id'])) {
            $usu_id = $_POST['usu_id'];
        }
        $obj = new CarroDeComprasModel();
        $carro_id = $obj->obtenerCarro($usu_id);
        exit();

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