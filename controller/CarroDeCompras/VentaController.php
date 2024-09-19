<?php

include_once "../model/CarroDeCompras/VentaModel.php";

class VentaController
{
  
    public function registroEnvio()
{
    $obj = new VentaModel();
    
    // Verifica que los datos existan
    if (isset($_POST['direccion_envio'], $_POST['ciudad'], $_POST['metodo_pago'], $_POST['total_con_envio'], $_POST['cantidad'], $_POST['product_id'])) {
        $direccion = $_POST['direccion_envio'];
        $ciudad = (int)$_POST['ciudad'];
        $metodo = (int)$_POST['metodo_pago'];
        $cuenta = $_POST['cuenta'];
        $total = (float)$_POST['total_con_envio'];

        // Validación de dirección
        if (empty($direccion)) {
            $_SESSION['error'] = "La dirección de envío no puede estar vacía.";
            return;
        }

        // Validación de ciudad y método de pago
        if ($ciudad <= 0 || $metodo <= 0) {
            $_SESSION['error'] = "Ciudad y método de pago deben ser válidos.";
            return;
        }

        // Insertar el envío
        $sql = "INSERT INTO envio (direccion_envio, ciu_id, idMetodo_pago, numeroCuenta) VALUES ('$direccion', $ciudad, $metodo, '$cuenta')";
        $resultado = $obj->insertar($sql);

        if ($resultado) {
            $envio_id = $obj->lastInsertId('envio', 'idEnvio');
            $usu_id = $_SESSION['usu_id'];

            // Validación del total
            if ($total <= 0) {
                $_SESSION['error'] = "El total debe ser un valor positivo.";
                return;
            }

            // Insertar la venta
            $sql = "INSERT INTO venta (usu_id, idEnvio, totalVenta) VALUES ($usu_id, $envio_id, $total)";
            $resultado = $obj->insertar($sql);

            if ($resultado) {
                $idVenta = $obj->lastInsertId('venta', 'idVenta');

                // Recoger las cantidades y los IDs de los productos
                $cantidades = $_POST['cantidad']; // Este es un array de cantidades
                $productosIds = $_POST['product_id']; // Este es un array de IDs de productos

                // Procesar cada producto
                foreach ($productosIds as $index => $productoId) {
                    $cantidad = (int)$cantidades[$index];

                    // Validación de cantidad
                    if ($cantidad <= 0) {
                        $_SESSION['error'] = "La cantidad para el producto ID: $productoId debe ser un valor positivo.";
                        return;
                    }

                    // Consultar el stock_id para cada producto_id
                    $sqlStock = "SELECT stock_id FROM stock WHERE product_id = $productoId LIMIT 1";
                    $resultadoStock = $obj->consultar($sqlStock);

                    if ($resultadoStock && $resultadoStock->num_rows > 0) {
                        $stock = $resultadoStock->fetch_assoc(); // Obtener el primer resultado como un array asociativo
                        $stockId = $stock['stock_id']; // Ahora puedes acceder correctamente
                        
                        // Insertar en la tabla producto_venta
                        $sqlProductoVenta = "INSERT INTO producto_venta (stock_id, cantidad_producto, idVenta) VALUES ($stockId, $cantidad, $idVenta)";
                        $resultadoProductoVenta = $obj->insertar($sqlProductoVenta);
                        $idproducto_venta = $obj->lastInsertId('producto_venta', 'idProducto_venta');


                        if (!$resultadoProductoVenta) {
                            $_SESSION['error'] = "Error al registrar el producto ID: $productoId.";
                            return; // Salir de la función si ocurre un error
                        }
                    } else {
                        $_SESSION['error'] = "No se encontró stock para el producto ID: $productoId.";
                        return; // Salir de la función si no se encuentra el stock
                    }
                }
                
            } else {
                $_SESSION['error'] = "Error al registrar la venta.";
            }
        } else {
            $_SESSION['error'] = "Error al registrar el envío.";
        }
    } else {
        $_SESSION['error'] = "Datos incompletos.";
    }
    $obj -> actualizarStock($idproducto_venta);
   
    redirect("index.php");
}
 

  
}


