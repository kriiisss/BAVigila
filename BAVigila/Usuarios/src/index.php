<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BAVigila</title>
    <link rel="stylesheet" href="css/index.css?1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="js/jquery-3.7.0.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap" rel="stylesheet">

</head>
<body>
  <header>
    <div class="text">
      <div class="a">
        <p>FORMULARIO DE REPORTE DE INCIDENCIAS</p><br>
        <p>CIUDAD AUTÓNOMA DE BUENOS AIRES</p>
      </div>
      
    </div>
    <div class="logo">
      <a href="index.html"><img src="img/Logo.png"></a>
    </div>     
  </header>
  <nav>
    <p>SITUACIÓN A DENUNCIAR</p>
  </nav>
  <div class="accordion" id="accordionExample">

    <p><?php 
         if(isset($_SESSION['mensaje'])){
           echo ($_SESSION['mensaje']);
           unset($_SESSION['mensaje']);
         }
       ?></p>
    <div class="accordion-item-report">
      <h2 class="accordion-header">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Hurto
        </button>
      </h2>
      <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          <form id="hurtoForm" action="php/hurto.php" method="post">
            <label for="ubi">Ubicación</label><br>
            <input type="text" name="ubicacion" class="ubi-i" id="ubicacion">
            <label for="ubi" class="obj">Objeto/s sustraído/s</label>
            <input type="text" name="objsus" class="obj-i" id="objetos"><br>
            <div class="cant-afec-asa">
              <div class="afectados">
                <label for="ubi" class="cant-afec">Cantidad de afectados</label>
                <input type="number" name="icaf" min="0" max="50" id="afectados" required>
              </div>
              <div class="asaltantes">
                <label for="ubi" class="cant-asa">Cantidad de asaltantes</label>
                <input type="number" name="cantasa" id="asaltantes">
              </div>
            </div> 
            <p class="ambu">¿Requiere ambulancia?</p>
            <div class="ambulancia">
              <div class="si">
                <label for="ubi">Si</label>
                <input type="radio" name="ambulancia" value="1" required>
              </div>
              <div class="no">
                <label for="ubi">No</label>
              <input type="radio" name="ambulancia" value="0" required><br>
              </div>
              
            </div>        
            <label for="ubi" class="info-adi">Información adicional</label><br>
            <textarea name="infoadi" id="info"></textarea><br>
            <input class="btn" type="submit" value="Enviar">
          

            <div class="mostrarDatos" id="mostrarDatos">
              <h2>Datos del incidente</h2>
              <div class="datos">
                <div class="ub" style="display: flex;gap: 5%;">
                  <p>Ubicación:</p>
                  <p id="ubi"></p>
                  <script>
                    $("#ubicacion").on("keyup change input",function(){
                      $("#ubi").html($(this).val());
                    });
                  </script>
                </div>

                <div class="ob" style="display: flex;gap: 5%;">
                  <p>Objetos sustraídos:</p>
                  <p id="obj"></p>
                  <script>
                    $("#objetos").on("keyup change input",function(){
                      $("#obj").html($(this).val());
                    });
                  </script>
                </div>
          
                <div class="af" style="display: flex;gap: 5%;">
                  <p>Cantidad de afectados:</p>
                  <p id="afe"></p>
                  <script>
                    $("#afectados").on("keyup change input",function(){
                      $("#afe").html($(this).val());
                    });
                  </script>
                </div>

                <div class="as" style="display: flex;gap: 5%;">
                  <p>Cantidad de asaltantes:</p>
                  <p id="asa">
                  <script>
                    $("#asaltantes").on("keyup change input",function(){
                      $("#asa").html($(this).val());
                    });
                  </script>
                </div>
          
                <div class="am" style="display: flex;gap: 5%;">
                  <p>¿Requiere ambulancia?</p>
                  <p id="amb"></p>
                  <script>
                    $(document).ready(function() {
                      $('input:radio[name=ambulancia]').change(function() {
                        if (this.value == '1') {
                          $("#amb").html("Si");
                        }
                        else if (this.value == '0') {
                          $("#amb").html("No");
                        }
                      });
                    });
                  </script>
                </div>
                                            
                <div class="ia" style="display: flex;gap: 5%;">
                  <p>Información adicional:</p>
                  <p id="inf"></p>
                  <script>
                    $("#info").on("keyup change input",function(){
                      $("#inf").html($(this).val());
                    });
                  </script>
                </div>
              </div>
          
              <div class="botones">
                <a href="javascript:cerrarDatos()" id="cancelar">Cancelar</a>
                <button id="enviarDatos">Enviar datos</button>
              </div>            
            </div>    
          </form>   
        </div>
      </div>
    </div>


    <div class="accordion-item-report">
      <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Robo
        </button>
      </h2>
      <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          <form id="hurtoForm" action="php/hurto.php" method="post">
            <label for="ubi">Ubicación</label><br>
            <input type="text" name="ubicacion" class="ubi-i" id="ubicacion">
            <label for="ubi" class="obj">Objeto/s sustraído/s</label>
            <input type="text" name="objsus" class="obj-i" id="objetos"><br>
            <div class="cant-afec-asa">
              <div class="afectados">
                <label for="ubi" class="cant-afec">Cantidad de afectados</label>
                <input type="number" name="icaf" min="0" max="50" id="afectados" required>
              </div>
              <div class="asaltantes">
                <label for="ubi" class="cant-asa">Cantidad de asaltantes</label>
                <input type="number" name="cantasa" id="asaltantes">
              </div>
            </div> 
            <p class="mod">Modalidad del robo</p>
            <div class="modalidad">
              <div class="si">
                <label for="ubi">Arma de fuego</label>
                <input type="checkbox" name="ambulancia" value="1" required>
              </div>
              <div class="no">
                <label for="ubi">Arma blanca</label>
                <input type="checkbox" name="ambulancia" value="0" required><br>
              </div>
              <div class="no">
                <label for="ubi">Otro</label>
                <input type="checkbox" name="ambulancia" value="0" required><br>
              </div> 
              <div class="no">
                <label for="ubi">Ninguno</label>
                <input type="checkbox" name="ambulancia" value="0" required><br>
              </div>          
            </div>        
            <p class="ambu">¿Requiere ambulancia?</p>
            <div class="ambulancia">
              <div class="si">
                <label for="ubi">Si</label>
                <input type="radio" name="ambulancia" value="1" required>
              </div>
              <div class="no">
                <label for="ubi">No</label>
              <input type="radio" name="ambulancia" value="0" required><br>
              </div>
              
            </div>        
            <label for="ubi" class="info-adi">Información adicional</label><br>
            <textarea name="infoadi" id="info"></textarea><br>
            <input class="btn" type="submit" value="Enviar">
          

            <div class="mostrarDatos" id="mostrarDatos">
              <h2>Datos del incidente</h2>
              <div class="datos">
                <div class="ub" style="display: flex;gap: 5%;">
                  <p>Ubicación:</p>
                  <p id="ubi"></p>
                  <script>
                    $("#ubicacion").on("keyup change input",function(){
                      $("#ubi").html($(this).val());
                    });
                  </script>
                </div>

                <div class="ob" style="display: flex;gap: 5%;">
                  <p>Objetos sustraídos:</p>
                  <p id="obj"></p>
                  <script>
                    $("#objetos").on("keyup change input",function(){
                      $("#obj").html($(this).val());
                    });
                  </script>
                </div>
          
                <div class="af" style="display: flex;gap: 5%;">
                  <p>Cantidad de afectados:</p>
                  <p id="afe"></p>
                  <script>
                    $("#afectados").on("keyup change input",function(){
                      $("#afe").html($(this).val());
                    });
                  </script>
                </div>

                <div class="as" style="display: flex;gap: 5%;">
                  <p>Cantidad de asaltantes:</p>
                  <p id="asa">
                  <script>
                    $("#asaltantes").on("keyup change input",function(){
                      $("#asa").html($(this).val());
                    });
                  </script>
                </div>
          
                <div class="am" style="display: flex;gap: 5%;">
                  <p>¿Requiere ambulancia?</p>
                  <p id="amb"></p>
                  <script>
                    $(document).ready(function() {
                      $('input:radio[name=ambulancia]').change(function() {
                        if (this.value == '1') {
                          $("#amb").html("Si");
                        }
                        else if (this.value == '0') {
                          $("#amb").html("No");
                        }
                      });
                    });
                  </script>
                </div>
                                            
                <div class="ia" style="display: flex;gap: 5%;">
                  <p>Información adicional:</p>
                  <p id="inf"></p>
                  <script>
                    $("#info").on("keyup change input",function(){
                      $("#inf").html($(this).val());
                    });
                  </script>
                </div>
              </div>
          
              <div class="botones">
                <a href="javascript:cerrarDatos()" id="cancelar">Cancelar</a>
                <button id="enviarDatos">Enviar datos</button>
              </div>            
            </div>    
          </form>   
        </div>
      </div>
    </div>


    <div class="accordion-item-report">
      <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Accidente
        </button>
      </h2>
      <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
        </div>
      </div>
    </div>


    <div class="accordion-item-report">
      <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
          Violencia de género
        </button>
      </h2>
      <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
        </div>
      </div>
    </div>


    <div class="accordion-item-report">
      <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
          Acoso
        </button>
      </h2>
      <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
        </div>
      </div>
    </div>


    <div class="accordion-item-report">
      <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
          Disturbio
        </button>
      </h2>
      <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
        </div>
      </div>
    </div>


    <div class="accordion-item-report">
      <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven" style="text-align: center;"> 
          Entradera
        </button>
      </h2>
      <div id="collapseSeven" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
        </div>
      </div>
    </div>


    <div class="accordion-item-report">
      <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">Venta de estupefacientes</button>
      </h2>
      <div id="collapseEight" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
        </div>
      </div>
    </div>


    <div class="accordion-item-emergency">
      <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
          Emergencia
        </button>
      </h2>
      <div id="collapseNine" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
        </div>
      </div>
    </div>

  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="js/mostrarDatos.js"></script>
</body>
</html>