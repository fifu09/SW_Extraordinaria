<?php include '../php/Menus.php' ?>
<?PHP
if (isset($_SESSION['Email']) && $_SESSION['Email']!="admin@ehu.es" && preg_match('/(\w+\.\w+|\w+)\@ehu\.(eus|es)/', $_SESSION['Email'])){
  $Email=$_SESSION['Email'];
  ?>
    <!DOCTYPE html>
  <html>
  <head>
    <?php include '../html/Head.html'?>  
    <?php include 'Funciones.php'?>
  </head>
  <body>
    
    <section class="main" id="s1">
      <div>
      <?php
          ?>
          <h3>Cliente REST para listar los usuarios VIP</h3><br>
          <h1>Usuarios VIPs</h1><br>
          <?php
          echo(CallAPI('GET',"VipUsers.php",null));
          ?>
      </div>
    </section>
    <?php include '../html/Footer.html' ?>
  </body>
  </html>
<?php
  
}
else{
  echo'<script type="text/javascript">alert("Necesitas ser un profesor para entrar aqui");window.location.href="Layout.php";</script>';
} 
?>

