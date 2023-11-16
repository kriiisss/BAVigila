<?php
$user = $_GET["usuario"];
$conexion = new mysqli("localhost", "root", "", "baVigila_admins");
    if(isset($_GET["usuario"])&&isset($_GET["password"])){
        $consulta_sql = "SELECT * FROM usuarios WHERE email = '".$_GET["usuario"]."' and password='".$_GET["password"]."'";
        $envio_sql = $conexion->query($consulta_sql);
        if(($envio_sql->num_rows)>0){
            session_start();
            $_SESSION["usuario"]=$user;
            header("Location:../Incidentes/hurto.php");
        }else{
            echo "Nombre de usuario y/o contraseña incorrectos";
        }
    }

    //' or 1 = 1; #
?>