<?php include '../php/Menus.php' ?>
<?PHP
if (isset($_SESSION['Email']) && $_SESSION['Email']!="admin@ehu.es" && preg_match('/^[a-z]+(\.[a-z]+)?@ehu\.e(s|us)$/', $_SESSION['Email'])){
  $Email=$_SESSION['Email'];
  ?>
    <!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>  

  <?php include 'Funciones.php'?>
  <style>
    
    .field{
      padding:5px;
      width:200px;
      text-align: centre;

    }

  </style>
  
</head>


<body>
  
  <section class="main" id="s1">
    <div>
    <?php
        $result='';
        $extra = '';
         if (isset($_GET['Email']) && $_GET['Email'] != ''){
            $extra = "?Email=" . $_GET['Email'];
          }
        if(isset($_POST['id'])){
          $id=$_POST['id'];
          $result=CallAPI('POST',"../servicioVip/php/VipUsers.php",$id);
        }
        ?>
      <form name="fisvip" id="fisvip" method="POST">
        <h2>Cliente REST para incluir un Email a la lista de usuarios VIP</h2><br>
        <p>Introduce el Email: <input type="text" id="id" name="id" value="" class="field"> </p> <br>
        <input type="submit" id="submit" value="Convertir en VIP" class="field">
      </form>
      <div><?php echo($result);?></div>
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
  <?php
}
else{
  echo'<script type="text/javascript">alert("Intruso, necesitas ser un profesor para entrar aqui");window.location.href="Layout.php";</script>';
} 
?>

