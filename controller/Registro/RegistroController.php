<?php
include_once "../model/Registro/RegistroModel.php";

class RegistroController {

    public function RegistrarC() {
        
        $nombre = $_POST["nombre"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $repeatPassword = $_POST["repeatPassword"];
        
        // Validaciones
        if (empty($nombre) || empty($email) || empty($password) || empty($repeatPassword)) {
            $_SESSION['errorEmpty'] = "Todos los campos son requeridos.";
            redirect("registro.php"); 
            return;
        }
        
        if ($password !== $repeatPassword) {
            $_SESSION['error'] = "Las contraseñas no coinciden.";
            redirect("registro.php"); 
            return;
        }
        // dd($_POST);
        // Instancia del modelo y llamada al método de registro
        $modelo = new RegistroModel();
        $resultado = $modelo->RegistrarC($nombre, $email, $password);
        
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