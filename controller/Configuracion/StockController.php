<?php

include_once "../model/Configuracion/StockModel.php";

Class StockController{

    public function getInsert(){
        
        $productos = $this->obtenerNombreProducto();

        include_once "../view/configuracion/stock/registroStock.php";
    } 

    public function postInsert(){
        
        $obj = new StockModel();
        $obj2 = new StockModel();

        $idprenda = $_POST['idPrenda'];
        $precio = $_POST['precio'];
        $datos = $_POST['datos-organizados'];

        
        $datos2 = json_decode($datos, true);

              // Inicializamos el array para almacenar errores
        $errores = array();

        // //! Validar que el array de colores no esté vacío
        if (empty($datos2['color']) || !is_array($datos2['color'])) {
            $errores[] = "El campo de colores no puede estar vacío.";
        } else {
            // Recorremos los colores
            foreach ($datos2['color'] as $color) {
                // Validar que el color no esté vacío
                if (empty($color)) {
                    $errores[] = "Uno de los colores está vacío.";
                    
                }

                // Validar que existan tallas para ese color
                if (empty($datos2['talla'][$color]) || !is_array($datos2['talla'][$color])) {
                    $errores[] = "No hay tallas para el color $color.";
                    
                }

                // Validar que existan cantidades para ese color
                if (empty($datos2['cantidad'][$color]) || !is_array($datos2['cantidad'][$color])) {
                    $errores[] = "No hay cantidades para el color $color.";
                    
                }

                // Recorremos las tallas y las cantidades para cada color
                foreach ($datos2['talla'][$color] as $tallaIndex => $talla) {
                    // Validar que la talla no esté vacía
                    if (empty($talla)) {
                        $errores[] = "La talla para el color $color está vacía.";
                        
                    }

                    // Validar que la cantidad correspondiente a esa talla sea numérica
                    if (!isset($datos2['cantidad'][$color][$tallaIndex]) || !is_numeric($datos2['cantidad'][$color][$tallaIndex])) {
                        $errores[] = "La cantidad para la talla $talla del color $color debe ser un valor numérico.";
                    }
                }
            }
        }
        
            
            // Mostrar los errores si hay alguno
            if (!empty($errores)) {
                // Puedes almacenar los errores en una sesión o mostrarlos directamente
                $_SESSION['errores'] = $errores;
                foreach ($errores as $error) {
                    echo "<p>$error</p>";
                }
                exit;
            }
        //!aqui termina la validacion de codigo

        $productosOrganizados = array();

        // Recorremos los colores
        foreach ($datos2['color'] as $index => $color) {
            $producto = array(
                'color' => $color,
                'talla' => array()
            );

            // Recorremos las tallas y cantidades para cada color
            foreach ($datos2['talla'][$color] as $tallaIndex => $talla) {
                $producto['talla'][$talla] = $datos2['cantidad'][$color][$tallaIndex];
            }

            $productosOrganizados[] = $producto;
        }

        // se validan los inputs de nombre y precio
        if(empty($idprenda )  || !filter_var($precio, FILTER_VALIDATE_INT) ) {
            $_SESSION['datosIncorrectos'] = "Por favor complete el formulario.";
            redirect(getUrl("Configuracion",  "Stock", "getInsert"));
        }                

            foreach($productosOrganizados as $producto){ 
            $color = $producto['color'];  // Guardamos el color

            // Recorrer el array de tallas dentro de cada producto
                foreach ($producto['talla'] as $talla => $cantidad) {
                    // Construir la consulta SQL
                    $sql = "INSERT INTO stock  VALUES (null, '$idprenda','$talla','$color', '$precio','$cantidad',1)";
            
                    // Ejecutar la consulta

                    $ejecutar = $obj->insertar($sql);

            }
        }
        redirect(getUrl("Configuracion",  "Stock", "getInsert"));
    }


    public function consultarUltimoId(){
        $obj = new StockModel();
        $sql = "SELECT MAX(stock_id) FROM stock";
        $ejecutar = $obj->consultar($sql);
        $fila = $ejecutar->fetch_array();
        $ultimo_id = $fila[0];
        echo $ultimo_id;

        return $ultimo_id;
    }



    public function obtenerNombreProducto($nombreProducto = false){
        $obj = new StockModel();
       // extract($_POST);

        $sql = "SELECT product_id, product_nombre FROM producto";
        $ejecutar = $obj->consultar($sql);
        $productos = [];
        if ($ejecutar && $ejecutar->num_rows > 0) {
            while ($row = $ejecutar->fetch_assoc()) {
                $productos[] = $row;
            }
        }
        return $productos;
    }

    public function obtenerStock(){
        $obj = new StockModel();
       // extract($_POST);

        $sql = "SELECT product_id, product_nombre FROM producto";
        $ejecutar = $obj->consultar($sql);
        $productos = [];
        if ($ejecutar && $ejecutar->num_rows > 0) {
            while ($row = $ejecutar->fetch_assoc()) {
                $productos[] = $row;
            }
        }
        return $productos;
    }


    // METODOS PARA CONSULTA
    public function consultar() {
        $obj = new StockModel();
        $sql = "SELECT stock.*, producto.product_nombre
        FROM stock 
        JOIN producto ON producto.product_id = stock.product_id
        WHERE stock_estado != 0 
        ORDER BY stock_id DESC";
        
        $stocks  = $obj->consultar($sql);
        include_once "../view/configuracion/Stock/consultaStock.php";
    }

    
    
    public function modificar() {

        $obj = new StockModel();
        $id = $_GET['stock_id'];
        $sql = "SELECT stock.*, producto.product_nombre
        FROM stock 
        JOIN producto ON producto.product_id = stock.product_id
        WHERE stock_id = $id ";
        
        $stocks  = $obj->consultar($sql);

        $productos = $this->obtenerNombreProducto();


        include_once "../view/configuracion/Stock/modificarStock.php";
    }

    public function modificacion() {
        $obj = new StockModel();

        $idStock = $_POST['idStock'];
        $idprenda = $_POST['idPrenda'];
        $talla = $_POST['talla'];
        $color = $_POST['color'];
        $precio = $_POST['precio'];
        $cantidad = $_POST['cantidad'];

        if (
            empty($idStock) ||  empty($idprenda) || empty($talla) || empty($color)
            || empty($precio) || empty($cantidad)
        ) {
            $_SESSION['datosIncorrectos'] = "Por favor complete el formulario.";
            redirect(getUrl("Configuracion", "stock", "modificar", array("stock_id" => $idStock)));
        }

        //dd($_POST);
        
        $sql = "UPDATE stock 
        SET product_id = '$idprenda', 
            stock_talla = '$talla',  
            stock_color = '$color', 
            stock_precio = '$precio', 
            stock_cantidad = '$cantidad' 
        WHERE stock_id = $idStock";

        //dd($sql);
        $ejecutar = $obj->editar($sql);
        redirect(getUrl("Configuracion", "Stock", "consultar"));


    }
    
    public function eliminar(){
        $obj = new StockModel();
        $id = $_POST['id'];
        echo $id;
        $sql  = "UPDATE stock SET stock_estado = 0 WHERE stock_id =$id";
        $ejecutar = $obj->editar($sql);
        if($ejecutar){
            echo 1;
        }else{
            echo 2;
        }
    }


}

