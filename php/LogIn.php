
<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>
        <form id='fquestion' name='fquestion' action="" method="post">
            Email*:<input type="email" id="Email" name="Email"><br>
            Password*:<input type="password" id="password" name="password"><br>
            <input type="submit" name="Logearse" value="Entrar">
            <?php
                // Validacion de los datos
                $condicion = false;
                $inicioDeSesion = false;
                if(isset($_POST["Email"]) && isset($_POST["password"])){
                    $Email = $_POST["Email"];
                    $password = $_POST["password"];
                    if (empty($Email) || empty($password)){
                        echo "<h1>Introduce los datos obligatorios</h1>";
                    }else if (!(preg_match("/\w+\d{3}\@ikasle\.ehu\.(eus|es)/", $Email) || preg_match("/(\w+\.\w+|\w+)\@ehu\.(eus|es)/", $Email))) {
                        echo "<h1>Introduce un correo correcto</h1>";
                    }
                    else{
                        $condicion = true;
                    }
                }
                // Conexion con la BD
                if ($condicion){
                    include "./DbConfig.php";
                    $mysqli = mysqli_connect("$server", "$user", "$pass", "$basededatos");
                    $sql = "select Email,Password FROM registrados WHERE Email='$Email' AND Password='$password'";
                    $estadoSql = "select Estado FROM registrados WHERE Email='$Email'";
                    $estado = mysqli_fetch_row(mysqli_query($mysqli,$estadoSql));
                    if (!$mysqli){
                        die ("Fallo al conectar a MySQL: " . mysqli_connect_error());
                    }
                    if (!mysqli_query($mysqli,$sql)){
                        echo "Error al entrar en la base de datos: ".mysqli_error($mysqli);
                    }else{
                        if (!mysqli_fetch_row(mysqli_query($mysqli,$sql)))
                        {
                            echo "<h1>Parametros incorrectos</h1>";
                        }
                        
                        else if( $estado[0] == "bloqueado")
                        {
                            echo "<h1>Usuario bloqueado</h1>";
                        }
                        else {
                            $_SESSION["Email"] = $Email;
                            echo "<script type='text/javascript'>window.location.href = 'Layout.php';</script>";
                            exit();
                        }
                    }
                    mysqli_close($mysqli);
                }
            ?>
        </form>
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>