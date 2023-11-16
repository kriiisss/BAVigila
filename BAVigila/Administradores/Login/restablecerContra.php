<?php
// Archivo: reset_password.php
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
    $token = $_GET["token"];
    $nueva_contrasena = $_POST["nueva_contrasena"];
    
    // Verifica si el token es válido y no ha expirado
    $sql = "SELECT usuario_id FROM tokens_recuperacion WHERE token = '$token' AND fecha_expiracion > NOW()";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $usuario_id = $row["usuario_id"];
        
        // Actualiza la contraseña del usuario
        $hashed_password = password_hash($nueva_contrasena, PASSWORD_DEFAULT);
        $sql = "UPDATE usuarios SET password = '$hashed_password' WHERE id = $usuario_id";
        if ($conn->query($sql) === TRUE) {
            // Elimina el token de recuperación
            $sql = "DELETE FROM tokens_recuperacion WHERE token = '$token'";
            $conn->query($sql);
            
            $_SESSION['mensaje'] = "La contraseña se ha restablecido con éxito. Inicia sesión con tu nueva contraseña.";
            header("Location: index.php");
            exit();
        } else {
            echo "Error al actualizar la contraseña: " . $conn->error;
        }
    } else {
        $_SESSION['mensaje'] = "El enlace para restablecer la contraseña es inválido o ha expirado.";
        header("Location: index.php");
        exit();
    }
}

$conn->close();
?>
