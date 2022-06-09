<?php include '../php/Menus.php' ?>
<?PHP
if (isset($_SESSION['Email']) && $_SESSION['Email']=="admin@ehu.es"){
    $Email=$_SESSION['Email'];
    ?>
    <!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
  <?php include 'DbConfig.php' ?>
  
</head>
<body>
  
  <section class="main" id="s1">
    <div>
      <h1> Usuarios </h1> <br>
      <table>
      <tr>
          <th>EMAIL</th>
          <th>PASS</th>
          <th>ESTADO</th>
          <th>BLOQUEO</th>
          <th>BORRAR</th>
      </tr>
      
      <?php
        $con = mysqli_connect($server, $user, $pass, $basededatos);
        $resultado = mysqli_query($con,"SELECT * from registrados");
        while($row=mysqli_fetch_array($resultado)){
            if($row['Email']!="admin@ehu.es"){
                echo '<tr><td>' . $row['Email'] . '</td><td>' . $row['Password'] . '</td> <td>' . $row['Estado'] . '</td> <td> <a href="ChangeUserState.php?id='.$row['Email'].'"><button type="button">Cambiar Estado</button></a> </td> <td> <a href="DeleteUser.php?id='.$row['Email'].'"><button type="button">Borrar</button></a> </td></tr>';
            }
        }

        mysqli_close($con);
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
  echo'<script type="text/javascript">alert("Necesitas ser el admin para entrar aqui");window.location.href="Layout.php";</script>';
}
?>
