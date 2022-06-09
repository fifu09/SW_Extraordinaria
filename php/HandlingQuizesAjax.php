<?php include '../php/Menus.php' ?>
<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
</head>
<body>
  
  <section class="main" id="s1">
    <div>

    <form id="fquestion" name="fquestion" method="GET" action="AddQuestion.php">
        <h2>Datos de las preguntas</h2>
        <?php if (isset($_SESSION["Email"])){  ?>
        Email*:<input type="text" id="Email" name="Email" value="<?php echo $_SESSION["Email"]; } ?>" readonly="readonly"><br> 
        Enunciado de la pregunta*:<input type="text" id="Pregunta" name="Pregunta"><br>
        Respuesta Correcta*:<input type="text" id="RespuestaCorrecta" name="RespuestaCorrecta"><br>
        Respuesta Inorrecta*:<input type="text" id="RespuestaIncorrecta1" name="RespuestaIncorrecta1"><br>
        Respuesta Inorrecta*:<input type="text"  id="RespuestaIncorrecta2" name="RespuestaIncorrecta2"><br>
        Respuesta Inorrecta*:<input type="text" id="RespuestaIncorrecta3" name="RespuestaIncorrecta3"><br>
        Complejidad*:<select id="Complejidad" name="Complejidad">
                              <option value=1>Baja</option>
                              <option value=2>Media</option>
                              <option value=3>Alta</option>
                            </select><br>
        Tema(Subject)*:<input type="text" id="Tema" name="Tema"><br>
        <input type="File" name="imagen"><br>
        </form>
          <button id="subir" onclick="anadirpregunta()">Enviar datos</button>
          <button id="xml" onclick="mostrarpreguntas()">Ver datos xml</button>
        </div>
        <div id="resultado"></div>
        <div id="preguntas"></div>
    

    </div>
  </section>
  <?php include '../html/Footer.html' ?>
  <script src="../js/AddQuestionAjax.js"></script>
  <script src="../js/ShowQuestionAjax.js"></script>
  <script src="../js/jquery-3.4.1.min.js"></script>
</body>
</html>
