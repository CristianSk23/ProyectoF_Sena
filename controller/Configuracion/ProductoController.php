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

        $nombre = $_POST['nombreProducto'];
        $descripcion = $_POST['descripcionProducto'];
        $categoria = $_POST['categoria'];
        $genero = $_POST['genero'];
        $tipo = $_POST['tipo'];
        

        dd($_FILES);

        

        // Tamaño máximo permitido en bytes (2 MB)
        $max_size = 2 * 1024 * 1024; // 2MB en bytes

        // Tipos MIME permitidos
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];

        if (
            empty($nombre) || empty($descripcion) || empty($categoria) || empty($genero)
            || empty($tipo) || empty($_FILES)
        ) {
            $_SESSION['datosIncorrectos'] = "Por favor complete el formulario.";
            redirect(getUrl("Configuracion", "Producto", "getInsert"));
        }

         // Obtener información del archivo
        $file_type = $_FILES['tar_img']['type'];
        $file_size = $_FILES['tar_img']['size'];
        $tmp_img = $_FILES['tar_img']['name'];
        $ruta = "images/$tmp_img";

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
        

        $sql = "INSERT INTO producto VALUES(null, '$tipo','$nombre', '$descripcion', 
        '$genero', '$categoria', '$ruta', 1 )";
        echo $sql;
        $ejecutar = $obj->insertar($sql);
        if ($ejecutar) {
            redirect(getUrl("Configuracion", "Producto", "getInsert"));
            $_SESSION['success'] = "Registro exitoso.";
        } else {
            $_SESSION['error'] = "Error al registrar el producto. Inténtalo de nuevo.";
        }

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

        $id = $_POST['id'];
        $nombre = $_POST['nombreProducto'];
        $descripcion = $_POST['descripcionProducto'];
        $categoria = $_POST['categoria'];
        $genero = $_POST['genero'];
        $tipo = $_POST['tipo'];
        // Tamaño máximo permitido en bytes (2 MB)
        $max_size = 2 * 1024 * 1024; // 2MB en bytes

        // Tipos MIME permitidos
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];

        if (
            empty($id) ||  empty($descripcion) || empty($categoria) || empty($genero)
            || empty($tipo) || empty($_FILES['tar_img']['name'])
        ) {
            $_SESSION['datosIncorrectos'] = "Por favor complete el formulario.";
            redirect(getUrl("Configuracion", "Producto", "modificar", array("product_id" => $id)));
        }

         // Obtener información del archivo
        $file_type = $_FILES['tar_img']['type'];
        $file_size = $_FILES['tar_img']['size'];
        $tmp_img = $_FILES['tar_img']['name'];
        $ruta = "images/$tmp_img";

        // Validar tipo de archivo
        if (!in_array($file_type, $allowed_types)) {
            $_SESSION['error'] = "El tipo de archivo no es válido. Solo se permiten JPEG, PNG o GIF.";
            redirect(getUrl("Configuracion", "Producto", "modificar", array("product_id" => $id)));
            exit;
        }

            // Validar tamaño del archivo
        if ($file_size > $max_size) {
            $_SESSION['error'] = "El tamaño del archivo es demasiado grande. El límite es 2 MB.";
            redirect(getUrl("Configuracion", "Producto", "modificar", array("product_id" => $id)));
            exit;
        }


        if (move_uploaded_file($_FILES['tar_img']['tmp_name'], $ruta)) {

            // Continuar con la actualización si la imagen se sube correctamente
            $sql = "UPDATE producto SET tipo_id ='$tipo', product_nombre ='$nombre', product_descripcion ='$descripcion', 
            genero_id ='$genero', categoria_id ='$categoria', product_img ='$ruta' WHERE product_id = $id";

            $ejecutar = $obj->editar($sql);
            if ($ejecutar) {
                redirect(getUrl("Configuracion", "Producto", "consultar"));
                $_SESSION['success'] = "modificación exitoso.";
            } else {
                $_SESSION['error'] = "Error al modificar el producto. Inténtalo de nuevo.";
            }
        } else {
            $_SESSION['error'] = "Error al subir la imagen.";
            redirect(getUrl("Configuracion", "Producto", "modificar", array("product_id" => $id)));
            
        }

        
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


}

