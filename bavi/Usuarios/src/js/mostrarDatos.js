function mostrarDatos(){
    document.getElementById("mostrarDatos").style.display="block";
  }

  function cerrarDatos(){
      document.getElementById("mostrarDatos").style.display="none";
      document.getElementById("mostrarDatos").style.pointerEvents = "auto";
    }

    $('#hurtoForm').submit(function(e) {
        if (e.originalEvent && e.originalEvent.isTrusted) //check if user clicked submit button or javascript clicked it
          e.preventDefault(); //prevent submitting the form if user clicked
  
        document.getElementById("mostrarDatos").style.display="block";
        document.getElementById("mostrarDatos").style.pointerEvents = "auto";
      });
  
      $('#enviarDatos').click(function() {
        $('#hurtoForm').submit();
      });