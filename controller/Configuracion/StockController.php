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
        $talla = $_POST['talla'];
        $color = $_POST['color'];
        $precio = $_POST['precio'];
        $cantidad = $_POST['cantidad'];
        
        if(empty($idprenda ) || empty($talla) || empty($color) || ($precio == "" && !is_numeric($precio) ) || ($cantidad == "" && !is_numeric($cantidad) )  || empty($_FILES  )) {
            $_SESSION['datosIncorrectos'] = "Por favor complete el formulario.";
            redirect(getUrl("Configuracion",  "Stock", "getInsert"));
        }

        $sql = "INSERT INTO stock VALUES(null, '$idprenda','$talla', '$color', '$precio',
        '$cantidad', 1 )";
        echo $sql;
        $ejecutar = $obj->insertar($sql);
        


        if($ejecutar){
            //redirect(getUrl("Configuracion", "Stock", "getInsert"));
            $imagenes = $_FILES['stock_img'];
            $idStock = $this->consultarUltimoId();
            for ($i = 0; $i < count($imagenes['name']); $i++){
                $tmp_img = $imagenes['name'][$i];
                $nombre = $imagenes['tmp_name'][$i];

                $ruta = "images/$tmp_img";
                move_uploaded_file($nombre, $ruta);

                $sql2 = "INSERT INTO fotos VALUES(null, '$ruta','$idStock', 1)"; 
                $ejecutar2 = $obj2->insertar($sql2);

            } 
        
            dd($_FILES);
        }else{
            $_SESSION['error'] = "Error al registrar el proucto. Inténtalo de nuevo.";
        }

        
    
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



    public function obtenerNombreProducto(){
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
        

        


    }
    
    public function eliminar(){
        $obj = new ProductoModel();
        $id = $_POST['id'];
        echo $id;
        $sql  = "UPDATE producto SET product_estado = 0 WHERE product_id =$id";
        $ejecutar = $obj->editar($sql);
        if($ejecutar){
            echo 1;
        }else{
            echo 2;
        }
    }


}

