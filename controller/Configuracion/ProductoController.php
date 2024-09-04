<?php

include_once "../model/Configuracion/ProductoModel.php";

Class ProductoController{

    public function getInsert(){
        
        $categorias = $this->obtenerCategorias();

        $generos = $this->obtenerGenero();

        $tipos = $this->obenerTipo();

        include_once "../view/configuracion/producto/registroProducto.php";
    } 

    public function postInsert(){
        
        $obj = new ProductoModel();

        $nombre = $_POST['nombreProducto'];
        $descripcion = $_POST['descripcionProducto'];
        $categoria = $_POST['categoria'];
        $genero = $_POST['genero'];
        $tipo = $_POST['tipo'];
        
        //dd($_POST);
        
        if(empty($nombre) || empty($descripcion) || empty($categoria) || empty($genero) 
        || empty($tipo) || $empty($_FILES)) {
            $_SESSION['datosIncorrectos'] = "Por favor complete el formulario.";
            redirect(getUrl("Configuracion",  "Producto", "getInsert"));
        }

        // Me muestra si está cargando la imagen y sus características.
        //dd($_FILES);

        //traigo el nombre de la imagen del arreglo tar_img
        $tmp_img = $_FILES['tar_img']['name'];
        //creo la ruta donde se guardará la imagen
        $ruta = "images/$tmp_img";

        //mueve el archivo a la ruta donde se guardará  
        move_uploaded_file($_FILES['tar_img']['tmp_name'], $ruta);

        //agrego la ruta en la posición donde está en la tabla de la base de datos

        $sql = "INSERT INTO producto VALUES(null, '$tipo','$nombre', '$descripcion', 
        '$genero', '$categoria', '$ruta', 1 )";
        echo $sql;
        $ejecutar = $obj->insertar($sql);
        if($ejecutar){
            redirect(getUrl("Configuracion", "Producto", "getInsert"));
            $_SESSION['success'] = "Registro exitoso.";
        }else{
            $_SESSION['error'] = "Error al registrar el producto. Inténtalo de nuevo.";
        }
    
    }

    public function obtenerCategorias(){
        $obj = new ProductoModel();
       // extract($_POST);

        $sql = "SELECT categoria_id, categoria_nombre FROM categoria";
        $ejecutar = $obj->consultar($sql);
        $categorias = [];
        if ($ejecutar && $ejecutar->num_rows > 0) {
            while ($row = $ejecutar->fetch_assoc()) {
                $categorias[] = $row;
            }
        }
        return $categorias;
    }

    public function obtenerGenero(){
        $obj = new ProductoModel();
       // extract($_POST);

        $sql = "SELECT genero_id, genero_nombre FROM genero";
        $ejecutar = $obj->consultar($sql);
        $generos = [];
        if ($ejecutar && $ejecutar->num_rows > 0) {
            while ($row = $ejecutar->fetch_assoc()) {
                $generos[] = $row;
            }
        }
        return $generos;
    }

    public function obenerTipo(){
        $obj = new ProductoModel();
       // extract($_POST);

        $sql = "SELECT tipo_id, tipo_nombre FROM tipoPrenda";
        $ejecutar = $obj->consultar($sql);
        $tipos = [];
        if ($ejecutar && $ejecutar->num_rows > 0) {
            while ($row = $ejecutar->fetch_assoc()) {
                $tipos[] = $row;
            }
        }
        return $tipos;
    }


    // METODOS PARA CONSULTA
    public function consultar() {
        $obj = new ProductoModel();
        $sql = "SELECT producto.*, tipoPrenda.tipo_nombre, 
        categoria.categoria_nombre, 
        genero.genero_nombre
        FROM producto 
        JOIN genero ON producto.genero_id = genero.genero_id
        JOIN categoria ON producto.categoria_id = categoria.categoria_id
        JOIN tipoPrenda ON producto.tipo_id = tipoPrenda.tipo_id
        WHERE product_estado != 0 
        ORDER BY product_id DESC";
        
        $productos  = $obj->consultar($sql);
        include_once "../view/configuracion/producto/consultaProducto.php";
    }

    
    
    public function modificar() {

        $obj = new ProductoModel();
        $id = $_GET['product_id'];
        $sql = "SELECT producto.*, tipoPrenda.tipo_nombre, 
        categoria.categoria_nombre, 
        genero.genero_nombre
        FROM producto 
        JOIN genero ON producto.genero_id = genero.genero_id
        JOIN categoria ON producto.categoria_id = categoria.categoria_id
        JOIN tipoPrenda ON producto.tipo_id = tipoPrenda.tipo_id
        WHERE product_id = $id ";
        
        $productos  = $obj->consultar($sql);

        $categorias = $this->obtenerCategorias();

        $generos = $this->obtenerGenero();

        $tipos = $this->obenerTipo();

        include_once "../view/configuracion/producto/modificarProducto.php";
    }

    public function modificacion() {
        $obj = new ProductoModel();

        $nombre = $_POST['nombreProducto'];
        $descripcion = $_POST['descripcionProducto'];
        $categoria = $_POST['categoria'];
        $genero = $_POST['genero'];
        $tipo = $_POST['tipo'];

        if(empty($nombre) || empty($descripcion) || empty($categoria) || empty($genero) 
        || empty($tipo) || empty($_FILES)) {
            $_SESSION['datosIncorrectos'] = "Por favor complete el formulario.";
            redirect(getUrl("Configuracion",  "Producto", "modificar"));
        }

        $tmp_img = $_FILES['tar_img']['name'];
        $ruta = "images/$tmp_img";
        move_uploaded_file($_FILES['tar_img']['tmp_name'], $ruta);

        $sql = "UPDATE producto SET VALUES(null, '$tipo','$nombre', '$descripcion', 
        '$genero', '$categoria', '$ruta', 1 )";
        echo $sql;
        $ejecutar = $obj->editar($sql);
        if($ejecutar){
            redirect(getUrl("Configuracion", "Producto", "modificar"));
            $_SESSION['success'] = "Registro exitoso.";
        }else{
            $_SESSION['error'] = "Error al registrar el producto. Inténtalo de nuevo.";
        }
    }
        
    public function traerId(){
        
    }
    
    public function eliminar(){
        $obj = new ProductoModel();
        $id = $_POST['id'];
        $sql  = "UPDATE producto SET product_estado = 0 WHERE product_id =$id";
        $ejecutar = $obj->editar($sql);
        if($ejecutar){
            echo 1;
        }else{
            echo 2;
        }
    }


}

