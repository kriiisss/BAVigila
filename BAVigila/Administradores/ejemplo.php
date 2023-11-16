<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Font Awesome -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
    rel="stylesheet"
    />
    <!-- MDB -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css"
    rel="stylesheet"
    />

    <title>Vicson</title>
</head>


<body style="background-color:#FBD0FC;">
    <form action="#" class="intro" method="POST">
        <div class="container my-4">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card" style="border-radius: 1rem; background-color:#ECE0DA;">
                        <div class="card-body p-5 text-center">
                            <div class="my-md-5 pb-3">
                                <div class="position-absolute top-0 start-0" style="width:120px; margin-left: 20px; margin-top: 20px;">
                                    <a href="Login.php"><i style="color:black; float:left;" class="fas fa-angles-left fa-2x"></i><h3 style="color:black;" >Volver</h3></a>
                                </div>
                                    
                                <h1 class="fw-bold mb-0">Recuperar contraseña</h1>
                                <p class=" mb-3">¿Olvidaste tu contraseña? No hay problema. Ingresa el Email con el que te hayas registrado a nuestra pagina web. Se te enviara un correo mediante el cual te indicaremos como cambiar tu contraseña usando un <b>Codigo Unico</b> que se te enviara.</p>  

                                <div class="form-outline mb-3" >
                                    <input style="background-color:#D7D1D7" type="email" id="typeEmail" class="form-control form-control-lg" name="email" required/>
                                    <label class="form-label" for="typeEmail">Email</label>
                                </div>

                                <button style="background-color:#D7D1D7" class="btn btn-lg btn-rounded gradient-custom text-body px-5" type="submit">Enviar</button>

                            </div>
                            <p>Si ya cuentas con el <b>Codigo Unico</b>, toca el siguiente boton.</p>
                            <button type="button" class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#ModalEditar">Ingresar Codigo</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <?php
    if (isset($_POST["email"])) {
        require 'PHPMailer-master/vendor/autoload.php';

        include("conexion.php");

        $email = $_POST["email"];

        $consulta_sql = "SELECT * FROM usuario WHERE email = ?";
        $statement = $conexion->prepare($consulta_sql);
        $statement->bind_param("s", $email);
        $statement->execute();
        $resultado = $statement->get_result();

        if ($resultado->num_rows > 0) {

            $token = bin2hex(random_bytes(4));

            $mail = new PHPMailer(true);
            $row = $resultado->fetch_assoc();

            //Consulto que el token que se haya asignado anterior a este intento no haya caducado por el tiempo.

            $consulta_dispo = "SELECT token, creacion FROM tokens WHERE usuario_id = ? AND email = ? AND usado = FALSE";
            $statement_dispo = $conexion->prepare($consulta_dispo);
            $statement_dispo->bind_param("is", $row['ID'], $email);
            $statement_dispo->execute();
            $resultado_dispo = $statement_dispo->get_result();
                
            if ($resultado_dispo->num_rows === 1) {
                $fila = $resultado_dispo->fetch_assoc();
                $token_bd = $fila['token'];
                $creacion = new DateTime($fila['creacion']);
                $now = new DateTime();

                $interval = $now->diff($creacion);
                $minutos_pasados = $interval->i;

                if ($minutos_pasados >= 30) {
                    //pasados 30 minutos, se elimina el token
                    $eliminar_query = "DELETE FROM tokens WHERE usuario_id = ? AND email = ?";
                    $eliminar_statement = $conexion->prepare($eliminar_query);
                    $eliminar_statement->bind_param("is", $row['ID'], $email);
                    $eliminar_statement->execute();
                } 
            } 

            try {
                $mail->SMTPDebug = 0; 
                $mail->isSMTP(); 
                $mail->Host       = 'smtp.gmail.com'; 
                $mail->SMTPAuth   = true;
                $mail->Username   = ''; 
                $mail->Password   = '';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port       = 465; 

                $mail->setFrom('bernabekevin4@gmail.com', 'Kevin Bernabe');
                $mail->addAddress($email, $row['nombre'], $row['apellido']);

                $mail->isHTML(true); 
                $mail->CharSet = 'UTF-8';
                $mail->Subject = 'Recuperar contraseña - Vicson Web';
                $mail->Body  = '<!DOCTYPE html>
                                <html lang="es">
                                <head>
                                    <meta charset="UTF-8">
                                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                    
                                    <!-- Font Awesome -->
                                    <link
                                    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
                                    rel="stylesheet"
                                    />
                                    <!-- Google Fonts -->
                                    <link
                                    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
                                    rel="stylesheet"
                                    />
                                    <!-- MDB -->
                                    <link
                                    href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css"
                                    rel="stylesheet"
                                    />
                                
                                    <title>Vicson</title>
                                
                                </head>
                                <body style="background-color:#FBD0FC;">
                                    <h2 class="card-title">Recuperar contraseña.</h2>
                                    <p class="card-text">Usted, '. $row['nombre'] . ' '. $row['apellido'] .', ha solcitado un cambio de contraseña y aqui le indicaremos como.</p>
                                    <p class="card-text">Ingrese <a href="http://localhost/VicsonWeb/recuperar_contrase%C3%B1a.php">AQUI</a>, presione el boton de <b>"Ingresar Codigo"</b>e ingrese el siguiente codigo. NO LO COMPARTA CON NADIE: <b>' . $token . '</b></p>
                                    <p class="card-text">De este modo, podrá ingresar a la pestaña de edicion de sus datos personales donde podra editar su contraseña. <b>El  Codigo Unico Caducara luego de pasados 30 minutos desde su solicitud.</b></p>
                                    <p class="card-text">Ante cualquier duda, estamos a su disposicion. Muchas Gracias!</p>
                                </body>
                                </html>';
                $mail->AltBody = 'Esto no se que es.';

                $consulta_existencia = "SELECT * FROM tokens WHERE usuario_id = ? OR email = ? AND usado = FALSE";
                $statement_existencia = $conexion->prepare($consulta_existencia);
                $statement_existencia->bind_param("is", $row['ID'], $email);
                $statement_existencia->execute();
                $resultado_existencia = $statement_existencia->get_result();

                if ($resultado_existencia->num_rows === 0) {
                    $hash_token = md5($token);

                    $consulta_insertar = "INSERT INTO tokens (usuario_id, email, token) VALUES (?, ?, ?)";
                    $statement_insertar = $conexion->prepare($consulta_insertar);
                    $statement_insertar->bind_param("iss", $row['ID'], $email, $hash_token);
                    $statement_insertar->execute();

                    $mail->send();

                    echo '<div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="miModalLabel" aria-hidden="true" data-mdb-backdrop="static" data-mdb-keyboard="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="miModalLabel">¡Mail Enviado!</h5>
                                    </div>
                    
                                    <div class="modal-body">
                                        <p>Se le ha enviado un mail con un <b>codigo especial</b> y un par de especificaciones mas. Mediante este formulario podra acceder al formulario de "Editar de Datos Personales" mediante el cual podra establecer una nueva contraseña.</p>
                                        <p>Antes de ello, por favor, ingrese el <b>Codigo Unico</b> que se le ha enviado por correo y podra acceder.</p>
                                        <form action="procesos.php" method="POST">
                                            <div class="form-outline mb-3">
                                                <input type="password" id="typePassword" class="form-control form-control-lg" name="token" required/>
                                                <label class="form-label" for="typePassword">Codigo Unico</label>
                                            </div>

                                            <button type="submit" class="btn btn-primary btn-block">Enviar</button>
                                        </form>
                                    </div>
                    
                                    <div class="modal-footer">
                                        <a href="Login.php" type="button" class="btn btn-danger">Volver</a>
                                        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>';

                } else {
                    echo '<div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="miModalLabel" aria-hidden="true" data-mdb-backdrop="static" data-mdb-keyboard="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="miModalLabel">¡Mail NO envaido!</h5>
                                    </div>
                    
                                    <div class="modal-body">
                                        <p>No se ha enviado el mail, debido a que ya existe un <b>Codigo Unico</b> para el Email ingresado. Puede que ya haya solicitado el cambio de contraseña. Intente ingresando en el boton "Ingresar Codigo", revise su casilla de correo donde deberia haber recibido el Codigo Unico e ingreselo. De lo contrario, intente de nuevo mas tarde.</p> 
                                    </div>

                                    <div class="modal-footer">
                                        <a href="recuperar_contraseña.php" type="button" class="btn btn-danger">Cerrar</a>
                                    </div>
                                </div>
                            </div>
                        </div>';
                }

                
            } catch (Exception $e) {
                echo "Mail probablemente no enviado Mailer Error: {$mail->ErrorInfo}";
            }
        } else{
            echo '<div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="miModalLabel" aria-hidden="true" data-mdb-backdrop="static" data-mdb-keyboard="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="miModalLabel">¡Mail NO envaido!</h5>
                                </div>
                
                                <div class="modal-body">
                                    No se le ha podido enviar el mail. Puede que el correo ingresado no se encuentre resgitrado o que se haya ingresado mal, por favor, intente denuevo.
                                </div>

                                <div class="modal-footer">
                                    <a href="recuperar_contraseña.php" type="button" class="btn btn-danger">Volver a intentar</a>
                                </div>
                            </div>
                        </div>
                    </div>';
        }
    }
    ?>

    <div class="modal top fade" id="ModalEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-mdb-backdrop="static" data-mdb-keyboard="true">
        <div class="modal-dialog  ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ingresar <b>Codigo Unico</b></h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Haz solicitado la recuperacion de contraseña, mediante este formulario, podra acceder a la pestaña de "Editar de Datos Personales" y asi tambien su <b>contraseña</b>.</p>
                    <p>Antes de ello, por favor, ingrese el <b>Codigo Unico</b> que se le ha enviado por correo y podra acceder</p>
                    <form action="procesos.php" method="POST">
                        <div class="form-outline mb-3">
                            <input type="password" id="typePassword" class="form-control form-control-lg" name="token" required/>
                            <label class="form-label" for="typePassword">Codigo Unico</label>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Enviar</button>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        setTimeout(function() {
        var modal = new mdb.Modal(document.getElementById('miModal'));
        modal.show();
        }, 500);
    </script>

    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
</body>
</html>
