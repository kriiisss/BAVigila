<?php
session_start();
$ubicacion=$_POST['ubicacion'];

$objsus=$_POST['objsus'];

$icaf=$_POST['icaf'];

$cantasa=$_POST['cantasa'];

if($_POST['ambulancia']=='1'){
    $ambulancia = '1';
}else{
    $ambulancia = '0';
}

$infoadi=$_POST['infoadi'];

$instruccion="insert into hurto(ubicacion, objetos_sustraidos, cant_afectados, cant_asaltantes, ambulancia, info_adicional) values ('$ubicacion', '$objsus', '$icaf', '$cantasa', '$ambulancia', '$infoadi')";

    $host='localhost';
    $user='root';
    $password='';
    $bd='baVigila_incidentes';

    $conexion = mysqli_connect ($host, $user, $password, $bd) or die ('Error al conectarse');
    $resultado = mysqli_query ($conexion, $instruccion);
    if($resultado){
        $_SESSION['mensaje'] = "La denuncia se envió correctamente";
        header("Location:../index.php");
    }

    mysqli_close ($conexion);
?>