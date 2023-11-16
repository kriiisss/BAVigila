<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'Login\PHPMailer-master\vendor\autoload.php'; // Reemplaza con la ubicación correcta de PHPMailer

// Variables de configuración
$smtp_host = 'smtp.gmail.com'; // Cambia esto por la configuración de tu servidor SMTP
$smtp_port = 587; // Puerto del servidor SMTP
$smtp_username = 'bavigila1@gmail.com'; // Tu dirección de correo electrónico
$smtp_password = 'ayed rnaq zawi zkab'; // Tu contraseña de correo electrónico
$from_email = 'bavigila1@gmail.com'; // Dirección de correo electrónico del remitente
$from_name = 'bavigila'; // Nombre del remitente

// Crear una instancia de PHPMailer
$mail = new PHPMailer(true);

try {
    // Configuración del servidor SMTP
    $mail->isSMTP();
    $mail->Host = $smtp_host;
    $mail->SMTPAuth = true;
    $mail->Username = $smtp_username;
    $mail->Password = $smtp_password;
    $mail->SMTPSecure = tls; // Puedes cambiar esto según la configuración de tu servidor
    $mail->Port = $smtp_port;

    // Configuración del correo electrónico
    $mail->setFrom($from_email, $from_name);
    $mail->addAddress($email); // Aquí deberías definir la dirección de destino
    $mail->Subject = 'Asunto del correo';
    $mail->Body = 'Este es el cuerpo del correo electrónico. Puedes personalizarlo.';

    // Enviar el correo electrónico
    $mail->send();

    echo 'Correo electrónico enviado con éxito';
} catch (Exception $e) {
    echo "Error al enviar el correo electrónico: {$mail->ErrorInfo}";
}
?>
