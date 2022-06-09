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
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>
    <h1>Preguntas almacenadas en el JSON</h1>
    <table>
		<tr>
			<th>AUTOR</th>
			<th>ENUNCIADO</th>
			<th>RESPUESTA</th>
		</tr>
        <?php
        $data = file_get_contents("../json/Questions.json"); 
        $jsonDecode=json_decode($data);
            if(!$data){
                echo "<h1>No se encuentra el fichero json</h1>";
            }else{
                foreach($jsonDecode->assessmentItems as $item){
                    $autor = $item->author;
                    $enunciado = $item->itemBody->p;
                    $respuesta = $item->correctResponse->value;
                    echo "<tr>";
                    echo "<td>$autor</td>";
                    echo "<td>$enunciado</td>";
                    echo "<td>$respuesta</td>";
                    echo "</tr>";
                }
            }
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