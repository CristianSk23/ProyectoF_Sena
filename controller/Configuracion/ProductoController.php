<?php

include_once "../model/Configuracion/ProductoModel.php";

class ProductoController
{

    public function getInsert()
    {

        $categorias = $this->obtenerCategorias();

        $generos = $this->obtenerGenero();

        $tipos = $this->obenerTipo();

        include_once "../view/configuracion/producto/registroProducto.php";
    }

    public function postInsert()
    {

        $obj = new ProductoModel();
        $obj2 = new ProductoModel();

        $nombre = $_POST['nombreProducto'];
        $descripcion = $_POST['descripcionProducto'];
        $categoria = $_POST['categoria'];
        $genero = $_POST['genero'];
        $tipo = $_POST['tipo'];
        
        // Validacion si el input esta vacio o no
        if (
            empty($nombre) || empty($descripcion) || empty($categoria) || empty($genero)
            || empty($tipo) 
        ) {
            $_SESSION['datosIncorrectos'] = "Por favor complete el formulario.";
            redirect(getUrl("Configuracion", "Producto", "getInsert"));
        }

        //dd($_FILES['stock_img']);
        

        $sql = "INSERT INTO producto VALUES(null, '$tipo','$nombre', '$descripcion', 
        '$genero', '$categoria', 1 )";
        echo $sql;
        $ejecutar = $obj->insertar($sql);

        //Insercion de las imagenes con su respectivas validaciones
        if ($ejecutar) {

            $imagenes = $_FILES['stock_img'];
            $idProducto = $this->consultarUltimoId();

            for ($i = 0; $i < count($imagenes['name']); $i++){
                $tmp_img = $imagenes['name'][$i];
                $nombre = $imagenes['tmp_name'][$i];

                //Tamaño máximo permitido en bytes (2 MB)
                $max_size = 2 * 1024 * 1024; // 2MB en bytes

                // Tipos MIME permitidos
                $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];

                $file_type = $imagenes['type'][$i];
                $file_size = $imagenes['size'][$i];

                // Validar tipo de archivo
                if (!in_array($file_type, $allowed_types)) {
                    $_SESSION['error'] = "El tipo de archivo no es válido. Solo se permiten JPEG, PNG o GIF.";
                    redirect(getUrl("Configuracion", "Producto", "getInsert"));
                    exit;
                }

                // Validar tamaño del archivo
                if ($file_size > $max_size) {
                    $_SESSION['error'] = "El tamaño del archivo es demasiado grande. El límite es 2 MB.";
                    redirect(getUrl("Configuracion", "Producto", "getInsert"));
                    exit;
                }

                // se mueven las imagenes a la ruta definida
                $ruta = "images/$tmp_img";
                move_uploaded_file($nombre, $ruta);

                $sql2 = "INSERT INTO fotos VALUES(null, '$ruta','$idProducto', 1)"; 
                $ejecutar2 = $obj2->insertar($sql2);
                
            }
            redirect(getUrl("Configuracion", "Producto", "getInsert"));
            $_SESSION['success'] = "Registro exitoso.";
        } else {
            $_SESSION['error'] = "Error al registrar el producto. Inténtalo de nuevo.";
        }
    }

    public function consultarUltimoId(){
        $obj = new ProductoModel();
        $sql = "SELECT MAX(product_id) FROM producto";
        $ejecutar = $obj->consultar($sql);
        $fila = $ejecutar->fetch_array();
        $ultimo_id = $fila[0];
        echo $ultimo_id;

        return $ultimo_id;
    }

    public function validarNombree(){
        $obj = new ProductoModel();

        $sql = "SELECT product_nombre FROM producto ";
    }

    public function obtenerCategorias()
    {
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

    public function obtenerGenero()
    {
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

    public function obenerTipo()
    {
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
    public function consultar()
    {
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

        $productos = $obj->consultar($sql);
        include_once "../view/configuracion/producto/consultaProducto.php";
    }



    public function modificar()
    {

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

        $productos = $obj->consultar($sql);

        $categorias = $this->obtenerCategorias();

        $generos = $this->obtenerGenero();

        $tipos = $this->obenerTipo();

        include_once "../view/configuracion/producto/modificarProducto.php";
    }

    public function modificacion()
    {
        $obj = new ProductoModel();
        $obj2 = new ProductoModel();

        $id = $_POST['id'];
        $nombre = $_POST['nombreProducto'];
        $descripcion = $_POST['descripcionProducto'];
        $categoria = $_POST['categoria'];
        $genero = $_POST['genero'];
        $tipo = $_POST['tipo'];


        if (
            empty($id) ||  empty($descripcion) || empty($categoria) || empty($genero)
            || empty($tipo) 
        ) {
            $_SESSION['datosIncorrectos'] = "Por favor complete el formulario.";
            redirect(getUrl("Configuracion", "Producto", "modificar", array("product_id" => $id)));
        }

        // Continuar con la actualización si la imagen se sube correctamente
        $sql = "UPDATE producto SET tipo_id ='$tipo', product_nombre ='$nombre', product_descripcion ='$descripcion', 
        genero_id ='$genero', categoria_id ='$categoria' WHERE product_id = $id";
        $ejecutar = $obj->editar($sql);

            //Insercion de las imagenes con su respectivas validaciones
        if ($ejecutar ) {

            $imagenes = $_FILES['stock_img'];
            $this->EliminarFotos($id);

            for ($i = 0; $i < count($imagenes['name']); $i++){
                $tmp_img = $imagenes['name'][$i];
                $nombre = $imagenes['tmp_name'][$i];

                // Tamaño máximo permitido en bytes (2 MB)
                // $max_size = 2 * 1024 * 1024; // 2MB en bytes

                // // Tipos MIME permitidos
                // $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];

                // $file_type = $imagenes['type'][$i];
                // $file_size = $imagenes['type'][$i];

                // // Validar tipo de archivo
                // if (!in_array($file_type, $allowed_types)) {
                //     $_SESSION['error'] = "El tipo de archivo no es válido. Solo se permiten JPEG, PNG o GIF.";
                //     redirect(getUrl("Configuracion", "Producto", "getInsert"));
                //     exit;
                // }

                // // Validar tamaño del archivo
                // if ($file_size > $max_size) {
                //     $_SESSION['error'] = "El tamaño del archivo es demasiado grande. El límite es 2 MB.";
                //     redirect(getUrl("Configuracion", "Producto", "getInsert"));
                //     exit;
                // }

                // se mueven las imagenes a la ruta definida
                if ($tmp_img){
                    $ruta = "images/$tmp_img";
                move_uploaded_file($nombre, $ruta);
                $sql2 = "INSERT INTO fotos VALUES(null, '$ruta','$id', 1)"; 
                $ejecutar2 = $obj2->insertar($sql2);
                }
                
                
            }
        } 
        redirect(getUrl("Configuracion", "Producto", "consultar"));
        $_SESSION['success'] = "Registro exitoso.";

        
    }


    public function eliminar()
    {
        $obj = new ProductoModel();
        $id = $_POST['id'];
        $sql = "UPDATE producto SET product_estado = 0 WHERE product_id =$id";
        $ejecutar = $obj->editar($sql);
        if ($ejecutar) {
            echo 1;
        } else {
            echo 2;
        }
    }

    public function EliminarFotos($id){
        $obj = new ProductoModel();
        $sql = "DELETE FROM fotos WHERE product_id = $id";
        $ejecutar = $obj->eliminar($sql);
    }


}

