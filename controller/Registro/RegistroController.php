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
            redirect(getUrl("Registro", "Registro", "RegistrarC")); 
            return;
        }
        
        if ($password !== $repeatPassword) {
            $_SESSION['error'] = "Las contraseñas no coinciden.";
            redirect(getUrl("Registro", "Registro", "RegistrarC"));
            return;
        }
        
        // Instancia del modelo y llamada al método de verificación de correo
     
        $correoExistente = $modelo->VerificarCorreo($emailC);

        if ($correoExistente) {
            $_SESSION['error'] = "El correo electrónico ya está registrado.";
            redirect("registro.php");
            return;
        }

        $resultado = $modelo->RegistrarCliente($nombre, $apellido,$emailC, $password);
        
        
        if ($resultado) {
            $_SESSION['success'] = "Registro exitoso. Puedes iniciar sesión.";
            redirect("login.php"); // Redirige al login después del registro
        } else {
            $_SESSION['error'] = "Error al registrar el usuario. Inténtalo de nuevo.";
            redirect(getUrl("Registro", "Registro", "RegistrarC")); 
        }
        
    }
}
?>