<?php

$ubicacion=$_POST['ubicacion'];
echo "Ubicación: ";
echo $ubicacion;
echo " ";

$modalidad = '';
if(isset($_POST['opc'])){
    foreach($_POST['opc'] as $valor){
        $modalidad = implode(', ', $_POST['opc']);
    }
}

$caf=$_POST['caf'];
echo "Arma de fuego: ";
echo $caf;
echo " ";

$cab=$_POST['cab'];
echo "Arma Blanca: ";
echo $cab;
echo " ";

$co=$_POST['co'];
echo "Otro: ";
echo $co;
echo " ";

$cn=$_POST['cn'];
echo "Ninguno: ";
echo $cn;
echo " ";

$cantasa=$_POST['cantasa'];
echo "Cantidad de Asaltantes: ";
echo $cantasa;
echo " ";

$icaf=$_POST['icaf'];
echo "Cantidad de Afectados: ";
echo $icaf;
echo " ";

/*if(!empty($_POST['ambulancia'])){
    $lenguajes=$_POST['lenguajes'];
    foreach($lenguajes as $unLenguaje){
     echo $unLenguaje;
    }
}*/

$objsus=$_POST['objsus'];
echo "Objetos Sustraidos: ";
echo $objsus;
echo " ";

if($_POST['bomberos']=='1'){
    $bomberos = '1';
    echo "Se requieren bomberos";
    echo " ";
}else{
    $bomberos ='0';
    echo "No se requieren bomberos";
    echo " ";
}

if($_POST['ambulancia']=='1'){
    $ambulancia = '1';
    echo "Se requiere ambulancia";
    echo " ";
}else{
    $ambulancia = '0';
    echo "No se requiere ambulancia";
    echo " ";
}

$infoadi=$_POST['infoadi'];
echo "Información Adicional: ";
echo $infoadi;
echo " ";

$instruccion="insert into formulario(ubicacion, caf, cab, co, cn, cantasa, icaf, objsus, bomberos, ambulancia, infoadi) values ('$ubicacion', '$caf ', '$cab', '$co', '$cn', '$cantasa', '$icaf', '$objsus', '$bomberos', '$ambulancia', '$infoadi')";

    $host='localhost';
    $user='root';
    $password='';
    $bd='incidentes';

    $conexion = mysqli_connect ($host, $user, $password, $incidentes) or die ('Error al conectarse');
    $resultado = mysqli_query ($conexion, $instruccion);

    mysqli_close ($conexion);
?>