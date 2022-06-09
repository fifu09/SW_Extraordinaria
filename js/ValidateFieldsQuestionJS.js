/*
function validarFormulario(f) {
    if (!huecosObligatoriosLlenos(f) || !correoEHU(f) || !enunciado10CaracteresMinimo(f)) {
        alert("No se ha enviado el formulario");
        return false;
    } else {
        alert("Se ha enviado el formulario correctamente");
    }
}

function huecosObligatoriosLlenos(f) {
    if (!f.Pregunta.value ||
        !f.Email.value ||
        !f.RespuestaCorrecta.value ||
        !f.RespuestaIncorrecta1.value ||
        !f.RespuestaIncorrecta2.value ||
        !f.RespuestaIncorrecta3.value ||
        !f.Complejidad.value ||
        !f.Tema.value) {
        alert("Rellene los datos obligatorios marcados con un *");
        return false;
    } else return true;

}

function correoEHU(f) {
    //   Letras + 3 dígitos + “@ikasle.ehu.” + “eus/es”
    var alumno = /\w+\d{3}\@ikasle\.ehu\.(eus|es)/;
    var profe = /(\w+\.\w+|\w+)\@ehu\.(eus|es)/;
    if (alumno.test(f.email.value) || profe.test(f.email.value)) {
        return true;
    } else {
        alert("Introduce un correo valido");
        return false;
    }
}

function enunciado10CaracteresMinimo(f) {

    if (f.enunciado.value.length < 10) {
        alert("Pregunta demasiado corta");
        return false;
    } else {
        //alert(f.enunciado.length.value());
        return true;
    }
}
*/
x=0;