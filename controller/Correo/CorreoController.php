<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $email = $_POST['email'];
    $message = $_POST['msg'];

    // Configura la dirección de correo del destinatario
    $to = 'lindamichip@gmail.com';  // Reemplaza con tu correo electrónico
    $subject = 'Nuevo Mensaje del Formulario de Contacto';
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Mensaje en formato HTML
    $body = "<html><body>";
    $body .= "<h2>Nuevo Mensaje de Contacto</h2>";
    $body .= "<p><strong>Email:</strong> $email</p>";
    $body .= "<p><strong>Mensaje:</strong><br>$message</p>";
    $body .= "</body></html>";

    // Enviar el correo
    if (mail($to, $subject, $body, $headers)) {
        echo "Correo enviado con éxito.";
    } else {
        echo "Error al enviar el correo.";
    }
}
?>
