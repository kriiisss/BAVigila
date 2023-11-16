<?php
// Archivo: forgot_password.php
session_start();

// Conexión a la base de datos (cambia estos valores por los tuyos)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admins";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("La conexión a la base de datos falló: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    // Verifica si el correo electrónico existe en la base de datos
    $sql = "SELECT id, nombre FROM usuarios WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        // Genera un token único
        $token = bin2hex(random_bytes(16));
        // Establece una fecha de expiración para el token (por ejemplo, 1 hora)
        $fecha_expiracion = date('Y-m-d H:i:s', strtotime('+1 hour'));
        // Almacena el token en la base de datos
        $sql = "INSERT INTO tokens_recuperacion (usuario_id, token, fecha_expiracion) VALUES ({$usuario['id']}, '$token', '$fecha_expiracion')";
        if ($conn->query($sql) === TRUE) {
            // Envía un correo electrónico al usuario con el enlace de recuperación
            $mensaje = "Hola {$usuarios['nombre']},\n\nPara restablecer tu contraseña, haz clic en el siguiente enlace:\n\n";
            $mensaje .= "http://localhost/Administradores/restablecerContraHTML.php?token=$token\n\n";
            $mensaje .= "Este enlace expirará en 1 hora.\n\n";
            $mensaje .= "Si no solicitaste restablecer tu contraseña, ignora este mensaje.\n";
            mail($email, "Recuperación de contraseña", $mensaje);
            $_SESSION['mensaje'] = "Se ha enviado un correo electrónico con las instrucciones para restablecer la contraseña.";
            header("Location: restablecerContraHTML.php");
            exit();
        } else {
            echo "Error al generar el token: " . $conn->error;
        }
    } else {
        $_SESSION['mensaje'] = "No se encontró ninguna cuenta con ese correo electrónico.";
        header("Location: recuperarContraHTML.php");
        exit();
    }
}

$conn->close();
?>
