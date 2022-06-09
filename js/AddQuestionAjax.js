
function anadirpregunta(){
    var formdata = {"Email":$("#Email").val(),
    "Pregunta":$("#Pregunta").val(),
    "RespuestaCorrecta":$("#RespuestaCorrecta").val(),
    "RespuestaIncorrecta1":$("#RespuestaIncorrecta1").val(), 
    "RespuestaIncorrecta2":$("#RespuestaIncorrecta2").val(),
    "RespuestaIncorrecta3":$("#RespuestaIncorrecta3").val(),
    "Complejidad":$("#Complejidad").val(),
    "Tema": $("#Tema").val()
    };
    console.log(formdata);
    $.ajax({type:"GET", url:"../php/AddQuestion.php", data:formdata, success:function(datos)
        { 
          $("#resultado").html(datos); 
        },
        dataType: 'html' 
    });
    
}