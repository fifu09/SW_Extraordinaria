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
        $result='';
        $extra = '';
         if (isset($_GET['Email']) && $_GET['Email'] != ''){
            $extra = "?Email=" . $_GET['Email'];
          }
        
        if(isset($_POST['id'])){
          $id=$_POST['id'];
          $result=CallAPI('GET',"VipUsers.php?id=".$id,null);
        }

        ?>
      <form name="fisvip" id="fisvip" method="POST">
        <h3>Cliente REST para saber si el usuario es VIP</h3><br>
        <h1>Es VIP?</h1><br>
        <p>Introduce el email: <input type="text" id="id" name="id" value="" class="field"> </p> <br>
        <input type="submit" id="submit" value="Es VIP?" class="field">

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
  echo'<script type="text/javascript">alert("Necesitas ser un profesor para entrar aqui");window.location.href="Layout.php";</script>';
} 
?>
