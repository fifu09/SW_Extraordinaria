<?php
session_start();
if (isset($_SESSION['Email']) && $_SESSION['Email']=="admin@ehu.es"){
  $Email=$_SESSION['Email'];
  include 'DbConfig.php';

  $link = mysqli_connect($server, $user, $pass, $basededatos);
  $sql="DELETE FROM registrados WHERE Email='$_GET[id]'";
  $resultados=mysqli_query($link ,$sql);
  if (!$resultados){
    
    die('Error: ' . mysqli_error($link));
  }
  mysqli_close($link); 
  header('Location: HandlingAccounts.php');
  exit;
}
else{
  echo'<script type="text/javascript">alert("Necesitas ser el admin para entrar aqui");window.location.href="Layout.php";</script>';
} 
?>