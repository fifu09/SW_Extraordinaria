/*$(document).ready(function(){
    var alumno = /\w+\d{3}\@ikasle\.ehu\.(eus|es)/;
    var profe = /(\w+\.\w+|\w+)\@ehu\.(eus|es)/;
    $("#fquestion").submit(function (){
        if ($("#Email").val().length == 0){
            alert("Relleno el correo");
        }
        else if(!alumno.test($("#Email").val()) && !profe.test($("#Email").val())){
			alert("correo incorrecto");
			return false;
		}
        else if ($("#Pregunta").val().length == 0) {
            alert("Relleno el enunciado");
            return false;
        }
        else if ($("#Pregunta").val().length < 10) {
            alert("Enunciado demasiado corto");
            return false;
        }
        else if ($("#RespuestaCorrecta").val().length == 0) {
            alert("Relleno la respuesta");
            return false;
        }
        else if ($("#RespuestaIncorrecta1").val().length == 0) {
            alert("Relleno la respuesta");
            return false;
        }
        else if ($("#RespuestaIncorrecta2").val().length == 0) {
            alert("Relleno la respuesta");
            return false;
        }
        else if ($("#RespuestaIncorrecta3").val().length == 0) {
            alert("Relleno la respuesta");
            return false;
        }
        else if ($("#Tema").val().length == 0) {
            alert("Relleno el tema");
            return false;
        }else {
        alert("Se ha enviado el formulario correctamente");
    }
    });
});*/
x=0;