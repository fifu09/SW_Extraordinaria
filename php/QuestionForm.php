<?php include '../php/Menus.php' ?>
<?php

if (isset($_SESSION['Email']) && $_SESSION['Email']!="admin@ehu.es"){ ?>
  <!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
  <script type="text/javascript" src="../js/ShowQuestionAjax.js"></script>
  <script type="text/javascript" src="../js/AddQuestionAjax.js"></script>
</head>
<body>
  
  <section class="main" id="s1">
    <div>

    <form id="fquestion" name="fquestion" method="GET" action="AddQuestion.php">
        <h2>Datos de las preguntas</h2>
        <?php if (isset($_GET["Email"])){  ?>
        Email*:<input type="text" id="Email" name="Email" value="<?php echo $_GET["Email"]; ?>" readonly="readonly"><br> 
        
        <?php }else{?>
        Email*:<input type="email" id="Email" name="Email"><br> <?php } ?>
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
          <input type="button" value="Enviar datos" id="subir" onclick="anadirpregunta()">
          <input type="button" value="Ver datos xml" id="xml" onclick="mostrarpreguntas()">
        </div>
        <div id="resultado"></div>
        <div id="preguntas"></div>
        </form>
        <?php 
          // Validacion del formulario
        if (isset($_GET["Email"]) && isset($_GET["Pregunta"]) && isset($_GET["RespuestaCorrecta"]) 
        && isset($_GET["RespuestaIncorrecta1"]) && isset($_GET["RespuestaIncorrecta2"]) 
        && isset($_GET["RespuestaIncorrecta3"]) && isset($_GET["Tema"])){
          $Email = $_GET["Email"];
          $Pregunta = $_GET["Pregunta"];
          $RespuestaCorrecta = $_GET["RespuestaCorrecta"];
          $RespuestaIncorrecta1 = $_GET["RespuestaIncorrecta1"];
          $RespuestaIncorrecta2 = $_GET["RespuestaIncorrecta2"];
          $RespuestaIncorrecta3 = $_GET["RespuestaIncorrecta3"];
          $Complejidad = $_GET["Complejidad"];
          $Tema = $_GET["Tema"];
          if (empty($Email) || empty($Pregunta) || empty($RespuestaCorrecta) || empty($RespuestaIncorrecta1) 
          || empty($RespuestaIncorrecta2) || empty($RespuestaIncorrecta3) || empty($Tema)){
            echo "<h1>Introduce los datos obligatorios</h1>";
          }else if (strlen($Pregunta)<10){
            echo "<h1>Introduce un enunciado con minimo 10 caracteres</h1>";
          }else{ 
            echo "<script type='text/javascript'>window.location.href = 'AddQuestion.php?Email=$Email&Pregunta=$Pregunta&RespuestaCorrecta=$RespuestaCorrecta&RespuestaIncorrecta1=$RespuestaIncorrecta1&RespuestaIncorrecta2=$RespuestaIncorrecta2&RespuestaIncorrecta3=$RespuestaIncorrecta3&Complejidad=$Complejidad&Tema=$Tema';</script>";
            echo "no hice nada";
        }
        }
        ?>
    

    </div>
  </section>
  <?php include '../html/Footer.html' ?>
  
</body>
</html>
<?php
}
else{
  echo'<script type="text/javascript">alert("Los administradores no tiene acceso aqui");window.location.href="Layout.php";</script>';
} 
?>