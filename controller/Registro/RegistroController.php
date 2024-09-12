<?php
include_once "../model/Registro/RegistroModel.php";

class RegistroController {

    public function RegistrarC() {

        $modelo = new RegistroModel();

        
       $nombre = $_POST['nombre'];
       $apellido = $_POST["apellido"];
       $emailC = $_POST["emailC"];
       $password = $_POST["password"];
       $repeatPassword = $_POST["repeatPassword"];

       
        
        // Validaciones
        if (empty($nombre) ||  empty($apellido) || empty($emailC) || empty($password) || empty($repeatPassword)) {
            
            $_SESSION['errorEmpty'] = "Todos los campos son requeridos.";
            redirect("registro.php");
            return;
        }
        
        $correoExistente = $modelo->VerificarCorreo($emailC);

        if ($correoExistente) {
            $_SESSION['error'] = "El correo electrónico ya está registrado.";
            redirect("registro.php");
            return;
        }
        if ($password !== $repeatPassword) {
            $_SESSION['error'] = "Las contraseñas no coinciden.";
            redirect("registro.php");
            return;
        }
     
        $pattern = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,}$/';
        if (!preg_match($pattern, $password)) {
          
            $_SESSION['error'] = "La contraseña debe tener al menos 8 caracteres, incluyendo una letra mayúscula, una letra minúscula, un número y un carácter especial.";
            redirect("registro.php");
            return;
        }

        $resultado = $modelo->RegistrarCliente($nombre, $apellido,$emailC, $password);
        
        
        if ($resultado) {
            $_SESSION['success'] = "Registro exitoso. Puedes iniciar sesión.";
            redirect("login.php"); // Redirige al login después del registro
        } else {
            $_SESSION['error'] = "Error al registrar el usuario. Inténtalo de nuevo.";
            redirect("registro.php");
        }
        
    }
}
?>