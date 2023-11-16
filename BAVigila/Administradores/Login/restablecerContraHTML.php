<!DOCTYPE html>
<html>
<head>
    <title>Restablecer Contraseña</title>
</head>
<body>
    <h2>Restablecer Contraseña</h2>
    <?php
    session_start();
    if (isset($_SESSION['mensaje'])) {
        echo '<p>' . $_SESSION['mensaje'] . '</p>';
        unset($_SESSION['mensaje']);
    }
    ?>
    <form method="post" action="Login\restablecerContra.php?token=<?php echo $_GET['token']; ?>">
        <label for="nueva_contrasena">Nueva Contraseña:</label>
        <input type="password" name="nueva_contrasena" required>
        <br>
        <br>
        <input type="submit" value="Restablecer Contraseña">
    </form>
</body>
</html>
