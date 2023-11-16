<!DOCTYPE html>
<html>
<head>
    <title>Recuperar Contraseña</title>
</head>
<body>
    <h2>Recuperar Contraseña</h2>
    <?php
    session_start();
    if (isset($_SESSION['mensaje'])) {
        echo '<p>' . $_SESSION['mensaje'] . '</p>';
        unset($_SESSION['mensaje']);
    }
    ?>
    <form method="post" action="recuperarContra.php">
        <label for="email">Correo Electrónico:</label>
        <input type="email" name="email" required>
        <br>
        <input type="submit" value="Enviar Correo de Recuperación">
    </form>
</body>
</html>
