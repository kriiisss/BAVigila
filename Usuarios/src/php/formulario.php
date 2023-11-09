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

echo "Modalidad: ";
echo $modalidad;
echo " ";

$cantasa=$_POST['cantasa'];
echo "Cantidad de Asaltantes: ";
echo $cantasa;
echo " ";

$icaf=$_POST['icaf'];
echo "Cantidad de Afectados: ";
echo $icaf;
echo " ";

if($_POST['ambulancia']=='1'){
    $ambulancia = '1';
    echo "Se requiere ambulancia";
    echo " ";
}else{
    $ambulancia = '0';
    echo "No se requiere ambulancia";
    echo " ";
}


if($_POST['bomberos']=='1'){
    $bomberos = '1';
    echo "Se requieren bomberos";
    echo " ";
}else{
    $bomberos ='0';
    echo "No se requieren bomberos";
    echo " ";
}

$objsus=$_POST['objsus'];
echo "Objetos Sustraidos: ";
echo $objsus;
echo " ";

$infoadi=$_POST['infoadi'];
echo "Información Adicional: ";
echo $infoadi;
echo " ";

$instruccion="insert into formulario(ubicacion, modalidad, cant_asaltantes, cant_afectados, ambulancia, bomberos, objetos_sustraidos, info_adicional) values ('$ubicacion', '$modalidad', '$cantasa', '$icaf', '$ambulancia', '$bomberos', '$objsus', '$infoadi')";

    $host='localhost';
    $user='root';
    $password='';
    $bd='ReporteIncidencias';

    $conexion = mysqli_connect ($host, $user, $password, $bd) or die ('Error al conectarse');
    $resultado = mysqli_query ($conexion, $instruccion);

    mysqli_close ($conexion);
?>