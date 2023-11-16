<?php
    
    session_start();
    if(empty($_SESSION["usuario"])){
        header("Location:../Login/index_hurto.html");
    }else{
        
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hurtos | BAVigila</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="incidentes.css?v=<?php echo(rand()); ?>" />
    <script src="/js/mi_script.js?v=<?php echo(rand()); ?>"></script>
    <script src="script.js" defer></script>
    <script src="https://kit.fontawesome.com/59fba2a9c8.js" crossorigin="anonymous"></script>
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
        <p><?php $variable = $_SESSION["usuario"]; echo " ".htmlspecialchars($variable); $conexion=mysqli_connect('localhost','root', '', 'baVigila_incidentes');}?></p>
        <header>
            <a href="cerrarsesion.php"><i class="fa-solid fa-right-to-bracket fa-2xl" style="font-size: 30px;"></i></a>
        </header>

        <div class="logo"><img href="#" src="..\Login\Logo.png"></div>
        <br>

    <center>
        <table>
            <thead>
                <th>Incidente N°</th>
                <th>Ubicación</th>
                <th>Objetos Sustraídos</th>
                <th>Cantidad de Afectados</th>
                <th>Cantidad de Asaltantes</th>              
                <th>Ambulancia</th>
                <th>Información Adicional</th>
            </thead>

            <?php
            
            $incidente="select* from hurto";
                
                $resultado2 = mysqli_query($conexion, $incidente);    

            while($mostrar=mysqli_fetch_array($resultado2)){
                ?>
            <tbody>
                <tr>
                    <td><?php echo $mostrar['id']?></td>
                    <td><?php echo $mostrar['ubicacion']?></td>
                    <td><?php echo $mostrar['objetos_sustraidos']?></td>
                    <td><?php echo $mostrar['cant_afectados']?></td> 
                    <td><?php echo $mostrar['cant_asaltantes']?></td>                 
                    <td><?php echo $mostrar['ambulancia']?></td>
                    <td><?php echo $mostrar['info_adicional']?></td>
                </tr>
            </tbody>
            <?php
            }
            mysqli_close($conexion);
            ?>
        </table>
    </center>
    <br>

    <div class="botones">
        <button type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">Insertar</button>

        <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">

            <!----------------------------------------------------------- Acá empieza el boton Insertar ----------------------------------------------------------->

            <div class="offcanvas-body">


            <form action="insertmod.php"  method="POST">

                        Ubicación: <input type="text" class="text" name="ubicacion" placeholder="Ej: Fraga 2282 / Juan B. Justo y San Martín" style="color: black; width: 300px; height: 40px;">
                    
                        <input type="checkbox" name="modalidad[]" value="cab" style="width: 13px; height: 13px;">
                        <label for="caf">AF</label>
                        <input type="checkbox" name="modalidad[]" value="caf" style="width: 13px; height: 13px;">
                        <label for="cab">AB</label>
                        <input type="checkbox" name="modalidad[]" value="co" style="width: 13px; height: 13px;">
                        <label for="co">O</label>
                        <input type="checkbox" name="modalidad[]"  value="cn" style="width: 13px; height: 13px;">
                        <label for="cn">N</label>
                    
                        Cantidad de Asaltantes: <input type="number" class="number" name="cantasa" id="ica" min="0" max="15" style="color: black; width: 40px; height: 40px;">
                    
                        Cantidad de Afectados: <input type="number" class="number" name="icaf" id="icaf" min="0" max="50" style="color: black; width: 40px; height: 40px;">

                        Objetos Sustraídos:<input type="text" class="text" name="objsus" placeholder="Ej: Mochila / Telefono celular / Billetera" style="color: black; width: 300px; height: 40px;">

                        Requiere Ambulancia?
                        <input name="rra" type="radio" name="rsi" value="rsi" style="width: 13px; height: 13px;">
                        <label for="rsi">Sí</label>
                        <input name="rra" type="radio" name="cno" value="cno" checked style="width: 13px; height: 13px;">
                        <label for="cno">No</label>
                    
                        Requiere Bomberos?
                        <input name="rrb" type="radio" name="rsib" id="rsib" style="width: 13px; height: 13px;">
                        <label for="rsib">Sí</label>
                        <input name="rrb" type="radio" name="rnob" id="rnob" checked style="width: 13px; height: 13px;">
                        <label for="rnob">No</label>
                                        
                        Información Adicional: <input type="text" class="text" name="infoadi" placeholder="Ej: Vestimenta de los asaltantes" style="color: black; width: 300px; height: 40px;">

                        <button type="submit">Insertar</button>
                        
                        </form>
            </div>

            <!----------------------------------------------------------- Acá empieza el boton Insertar ----------------------------------------------------------->

        </div>
    

        <button type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">Modificar</button>

        <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
            <!-- <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasBottomLabel">Modificar Incidente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div> -->
            <div class="modificar">
        ...
            </div>
        </div>

        <button type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">Eliminar</button>

        <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
            <!-- <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasBottomLabel">Eliminar incidente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div> -->
            <div class="elminar">
        ...
            </div>
        </div>
    </div>

    <iframe src="test.html" frameborder="0" style="height: 963px; width: 100%;"></iframe>

</body>
</html>
