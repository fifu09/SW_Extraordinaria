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
            <h2>Registro</h2>
            <label for="male">Profesor</label>
		        <input type="radio" name="radio" value="Profesor" checked>
		    <label for="male">Alumno</label>
		        <input type="radio" name="radio" value="Alumno"><br>
            Email*:<input type="text" id="Email" name="Email" onfocusout="estaMatriculado()"><br>
            <div id="matricula"></div>
            Nombre y Apellidos*:<input type="text" id="Nombre" name="Nombre"><br>
            Password*:<input type="password" id="password" name="password"><br>
            Repetir Password*:<input type="password" id="Repepassword" name="Repepassword"><br>
            Seleccione un archivo...:<input type="File" name="imagen"><br>
            <input type="submit" id="registrarse" value="Registrarse" onclick="start()" disabled>
        </form>
        <?php
            // Funciones del patron del email
            function validaEmailAlumno ( $var = '' ) {
                return preg_match("/\w+\d{3}\@ikasle\.ehu\.(eus|es)/", $var);
            }
            function validaEmailProfe ( $var = '' ) {
                return preg_match("/(\w+\.\w+|\w+)\@ehu\.(eus|es)/", $var);
            }
            // Comprobacion del formulario
            if(isset($_POST["password"]) && isset($_POST["Repepassword"])){
                $Email = $_POST["Email"];
                $Nombre = $_POST["Nombre"];
                $password = $_POST["password"];
		        $repepassword = $_POST["Repepassword"];
                $radio = $_POST["radio"];
                $condicion=false;
                if (empty($Email) || empty($Nombre) || empty($password) || empty($repepassword)){
                    echo "<h1>Introduce los datos obligatorios</h1>";
                }else if (empty($password) || strlen($password)<8){
                    echo "<h1>La contraseña como minimo debe tener 8 digitos</h1>";
                }else if ($password != $repepassword){
                    echo "<h1>La contraseñas no coinciden</h1>";
                }else if ($radio=="Profesor"){
                    if(!validaEmailProfe($Email)){
                        echo "<h1>Introduce un correo de profesor</h1>";
                    }else{
                        $condicion=true;
                    }
                }else if ($radio=="Alumno"){
                    if(!validaEmailAlumno($Email)){
                        echo "<h1>Introduce un correo de alumno</h1>";
                    }else{
                        $condicion=true;
                    }
                }
                // Inicio de conexion con la BD
                if ($condicion){
                    include "./DbConfig.php";
                    $mysqli = mysqli_connect("$server", "$user", "$pass", "$basededatos");
                    $sql = "insert into registrados(Email,Password,Nombre,Estado) values ('$Email','$password','$Nombre', 'activo')";
                    if (!$mysqli){
                        die ("Fallo al conectar a MySQL: " . mysqli_connect_error());
                    }
                    if (!mysqli_query($mysqli,$sql)){
                        if (mysqli_error($mysqli)=="Duplicate entry '$Email' for key 'PRIMARY'"){
                            echo "Este correo ya ha utilizado en el registro";
                        }else{
                            echo "Se ha producido el siguiente error: ".mysqli_error($mysqli);
                        }
                    }else{
                        header('Location: LogIn.php');
                        die();
                    }
                    mysqli_close($mysqli);
                }
            }
        ?>
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
  <script src="../js/jquery-3.4.1.min.js"></script>
  <script src="../js/ValidateSignUp.js"></script>
  <!-- Script de estaMatricualdo -->
    <script>
        function estaMatriculado() 
        {   
            email = document.getElementById("Email").value;
            xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET","ClientVerifyEnrollment.php?Email="+email,true);
            xmlhttp.onreadystatechange=function()
            {
                if (xmlhttp.readyState===4 && xmlhttp.status===200)
                {
                    document.getElementById("matricula").innerHTML=xmlhttp.responseText;
                    validacionDeRegistro(); 
                }
            }
            xmlhttp.send();
        }
    </script>
    <!-- Script de condicionMatricula -->
    <script>
        function validacionDeRegistro()
        {
        var matriculacion=document.getElementById('matricula').innerHTML;
        setTimeout(function(){ 
            if(matriculacion == "El correo SI está matriculado"){
            document.getElementById("registrarse").disabled = false;
            }
            else{
            document.getElementById("registrarse").disabled = true;
            } 
        
        }, 150);
        }
    </script>
</body>
</html>
