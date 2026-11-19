<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Cargar el autoloader de Composer
require 'vendor/autoload.php';

header('Content-Type: application/json');

// Obtener los datos enviados por JavaScript
$input = json_decode(file_get_contents('php://input'), true);

if (isset($input['email']) && isset($input['nombre']) && isset($input['telefono'])) {
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP (Ejemplo usando Gmail)
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'rodriguezrodriguezsantiago962@gmail.com'; // <--- Cambia esto por tu correo real de Gmail
        $mail->Password   = 'pqwh dkwe wqix oaph'; // <--- Cambia esto por una Contraseña de Aplicación de Google
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Remitente y Destinatario
        $mail->setFrom('rodriguezrodriguezsantiago962@gmail.com', 'Plataforma Escolar');
        $mail->addAddress($input['email'], $input['nombre']);

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Datos de Registro - Plataforma Escolar';
        $mail->Body    = "
            <h2>¡Hola, {$input['nombre']}!</h2>
            <p>Tus datos han sido registrados exitosamente en nuestra plataforma:</p>
            <ul>
                <li><b>Correo:</b> {$input['email']}</li>
                <li><b>Teléfono:</b> {$input['telefono']}</li>
            </ul>
            <p>¡Gracias por utilizar nuestro sistema!</p>
        ";
        $mail->AltBody = "Hola {$input['nombre']}, tus datos registrados son: Email: {$input['email']}, Teléfono: {$input['telefono']}";

        $mail->send();
        echo json_encode(['success' => true, 'message' => '¡Correo enviado exitosamente al usuario!']);
        
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => "No se pudo enviar el correo. Error: {$mail->ErrorInfo}"]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Faltan datos requeridos.']);
}
?>