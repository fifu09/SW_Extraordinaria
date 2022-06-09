<?php session_start();?>
<?php
if(isset($_SESSION['Email'])){
		$Email = $_SESSION['Email'];
		include "./DbConfig.php";
		$mysqli = mysqli_connect("$server", "$user", "$pass", "$basededatos");
		if (!$mysqli){
			die ("Fallo al conectar a MySQL: " . mysqli_connect_error());
		}
		$sql = "SELECT Email FROM registrados WHERE Email='$Email'";
		$row = mysqli_fetch_row(mysqli_query($mysqli,$sql));
		mysqli_close($mysqli);
		if ($row){ ?>
      <header class='main' id='h1'>
        <span class="right" ><a href="./LogOut.php"> Logout</a> | Usuario:<?php echo " ".$Email?></span>
      </header>
      <nav class='main' id='n1' role='navigation'>
      <span><a href='Layout.php'>Inicio</a></span>
      <span><a href='Credits.php'>Creditos</a></span>
      
      <?php
      
      if((preg_match('/^[a-z]+[0-9]{3,}@ikasle\.ehu\.(es|eus)$/', $Email) || preg_match('/^[a-z]+(\.[a-z]+)?@ehu\.(es|eus)$/', $Email)) 
        && $Email!="admin@ehu.es"){ ?>
        <span><a href='HandlingQuizesAjax.php'> Gestionar Preguntas</a></span>
        <?php 
        if(preg_match('/^[a-z]+(\.[a-z]+)?@ehu\.e(s|us)$/', $Email)){
          ?>
          <span><a href='IsVip.php'> Es VIP?</a></span>
          <span><a href='AddVip.php'> Añadir VIP</a></span>
          <span><a href='ShowVips.php'> Mostrar VIPs</a></span>
          <span><a href='DeleteVip.php'> Eliminar VIPs</a></span>
          
          <?php
        }
      }
      if($Email=="admin@ehu.es"){
        ?>
        <span><a href='HandlingAccounts.php'> Gestionar cuentas</a></span>
        <?php
      } ?>
      </nav>
      
    <?php } ?>
<?php 
	}
	else{?>
    <div id='page-wrap'>
    <header class='main' id='h1'>
      <span><a href="./SignUp.php">Registro</a></span>
            <span><a href="./LogIn.php">Login</a></span>
    </header>
    <nav class='main' id='n1' role='navigation'>
      <span><a href='Layout.php'>Inicio</a></span>
      <span><a href='Credits.php'>Creditos</a></span>
      </nav>
<?php }
?>
  
