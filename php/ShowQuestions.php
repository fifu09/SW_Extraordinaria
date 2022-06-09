<?php include '../php/Menus.php' ?>
<?php
if (isset($_SESSION['Email']) && $_SESSION['Email']!="admin@ehu.es"){ ?>
  <!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
  <link rel="stylesheet" href="../styles/Tabla.css">
</head>
<body>
  <section class="main" id="s1">
    <div>
      <?php
        include "./DbConfig.php";
        $mysqli = mysqli_connect("$server", "$user", "$pass", "$basededatos");
        if (!$mysqli){
          die ("Fallo al conectar a MySQL: " . mysqli_connect_error());
        }
        $sql="SELECT Email, Pregunta, RespuestaCorrecta FROM preguntas";
        $condicion=mysqli_query($mysqli,$sql);
      ?>
      <h1>Preguntas almacenadas en la BD</h1>
      <table>
        <tr>
          <th id="TituloEmail">AUTOR</th>
          <th id="TituloPreguntas">ENUNCIADO</th>
          <th id="TituloRespuestasCorrectas">RESPUESTA</th>
        </tr>
        <?php
          if($condicion){
            while($row = mysqli_fetch_array($condicion)){ 
        ?>
            <tr>
              <td id="Email"><?php echo $row["Email"]; ?></td>
              <td id="Pregunta"><?php echo $row["Pregunta"];?></td>
              <td id="RespuestaCorrecta"><?php echo $row["RespuestaCorrecta"];?></td>
            </tr>
				<?php
            }
          }
          mysqli_close($mysqli);
        ?>
      </table> 
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