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

    $host='sql302.infinityfree.com';
    $user='if0_35439042';
    $password='et32de14';
    $bd='if0_35439042_BAvigila';

    $conexion = mysqli_connect ($host, $user, $password, $bd) or die ('Error al conectarse');
    $resultado = mysqli_query ($conexion, $instruccion);
    if($resultado){
        $_SESSION['mensaje'] = "La denuncia se envió correctamente";
        header("Location:../index.php");
    }

    mysqli_close ($conexion);
?>