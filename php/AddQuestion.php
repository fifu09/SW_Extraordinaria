
    <div>
    <?php
    include "./DbConfig.php";
      $mysqli = mysqli_connect("$server", "$user", "$pass", "$basededatos");
      if (!$mysqli){
        echo "<a href='./QuestionForm.php'>Rellene el formulario de nuevo</a></br>";
        die ("Fallo al conectar a MySQL: " . mysqli_connect_error());
      }
      if (isset($_GET["Email"]) && isset($_GET["Pregunta"]) && isset($_GET["RespuestaCorrecta"]) 
        && isset($_GET["RespuestaIncorrecta1"]) && isset($_GET["RespuestaIncorrecta2"]) 
        && isset($_GET["RespuestaIncorrecta3"]) && isset($_GET["Tema"])){
        $Email = $_GET["Email"];
        $Pregunta = $_GET["Pregunta"];
        $RespuestaCorrecta = $_GET["RespuestaCorrecta"];
        $RespuestaIncorrecta1 = $_GET["RespuestaIncorrecta1"];
        $RespuestaIncorrecta2 = $_GET["RespuestaIncorrecta2"];
        $RespuestaIncorrecta3 = $_GET["RespuestaIncorrecta3"];
        $Complejidad = $_GET["Complejidad"];
        $Tema = $_GET["Tema"];
        
        
        if (empty($Email) || empty($Pregunta) || empty($RespuestaCorrecta) || empty($RespuestaIncorrecta1)
        || empty($RespuestaIncorrecta2) || empty($RespuestaIncorrecta3) || empty($Tema)){
          echo "<h1>Introduce los datos obligatorios</h1>";
        }else if(strlen($Pregunta) <10){
          echo "<h1>Introduce enunciado con minimo 10 caracteres</h1>";
        }
        else {
          // Insertar en la BD
          $sql = "insert into preguntas(Email,Pregunta,RespuestaCorrecta,RespuestaIncorrecta1,
              RespuestaIncorrecta2,RespuestaIncorrecta3,Complejidad,Tema) 
              values ('$Email','$Pregunta','$RespuestaCorrecta','$RespuestaIncorrecta1',
              '$RespuestaIncorrecta2','$RespuestaIncorrecta3',$Complejidad,'$Tema')";
          if(!mysqli_query($mysqli,$sql)){
            echo "<h1>Error: No se ha podido insertar en a base de datos xml</h1>";
          }else{
            echo "Se ha insertado la pregunta en la BD correctamente <br>";
          }
          // Insertar en el XML
          $xml = simplexml_load_file('../xml/Questions.xml');
          if(!$xml){
            echo "<h1>Error: No se encuentra el fichero xml</h1>";
          }else{
            addXmlQuestion($xml, $Tema,$Email,$Pregunta,$RespuestaCorrecta,$RespuestaIncorrecta1,
            $RespuestaIncorrecta2,$RespuestaIncorrecta3);
          }
          // Insertar en el JSON
          $data = file_get_contents("../json/Questions.json"); 
          if (!$data){
            echo"<h1>Error: No se encuentra el fichero json</h1>";
          }else {
            addJsonQuestion($data, $Tema,$Email,$Pregunta,$RespuestaCorrecta,$RespuestaIncorrecta1,
            $RespuestaIncorrecta2,$RespuestaIncorrecta3);
          }
        }
      }
      ////////////////////////////////////////////////////////////////////
      mysqli_close($mysqli);
    ?>
    </div>

<?php 
  function addXmlQuestion($xml, $Tema,$Email,$Pregunta,$RespuestaCorrecta,$RespuestaIncorrecta1,
  $RespuestaIncorrecta2,$RespuestaIncorrecta3)
  {
    $domxml = new DOMDocument('1.0');
    $domxml->preserveWhiteSpace = false;
    $domxml->formatOutput = true;
    // Añadiendo autor y tema 
    $assessmentItem = $xml ->addChild('assessmentItem');
    $assessmentItem -> addAttribute('subject',$Tema);
    $assessmentItem -> addAttribute('author',$Email);
    // Añadiendo hijos
    $itemBody = $assessmentItem -> addChild('itemBody');
    $itemBody -> addChild('p',$Pregunta);
    $correctResponse = $assessmentItem -> addChild('correctResponse');
    $correctResponse -> addChild('response',$RespuestaCorrecta);
    // Añadiendo nietos o hijos de icorrectResponses
    $incorrectResponses = $assessmentItem -> addChild('incorrectResponses');
    $incorrectResponses -> addChild('response',$RespuestaIncorrecta1);
    $incorrectResponses -> addChild('response',$RespuestaIncorrecta2);
    $incorrectResponses -> addChild('response',$RespuestaIncorrecta3);
    $domxml->loadXML($xml->asXML());
    $domxml->save('../xml/Questions.xml');
    if($domxml->save('../xml/Questions.xml')){
      echo "Se ha insertado la pregunta en el XML correctamente</br>";
    }else{
      echo "<h1>No se ha podido añadir al fichero xml</h1>";
      
    }
  }
  function addJsonQuestion($data, $Tema,$Email,$Pregunta,$RespuestaCorrecta,$RespuestaIncorrecta1,
  $RespuestaIncorrecta2,$RespuestaIncorrecta3)
  {
          // Insertar en JSON
      
      $jsonDecode=json_decode($data);
      $assessmentItems = new stdClass();
      $assessmentItems -> subject=$Tema;
      $assessmentItems -> author=$Email;
      // Hijo de itemBody
      $itemB  = new stdClass();
      $itemB -> p=$Pregunta;
      $assessmentItems -> itemBody=$itemB;
      // Hijo de correctResponse
      $value1  = new stdClass();
      $value1 -> value=$RespuestaCorrecta;
      $assessmentItems -> correctResponse = $value1;
      // Hijo de incorrectResponses
      $value2  = new stdClass();
      $value2 -> value=array($RespuestaIncorrecta1, $RespuestaIncorrecta2, $RespuestaIncorrecta3);
      $assessmentItems -> incorrectResponses = $value2;
      // Proceso de encode
      array_Push($jsonDecode->assessmentItems, $assessmentItems);
      $jsonData = json_encode($jsonDecode); 
      $jsonData = str_replace('{', '{'.PHP_EOL, $jsonData); 
      $jsonData = str_replace(',', ','.PHP_EOL, $jsonData); 
      $jsonData = str_replace('}', PHP_EOL.'}', $jsonData);
      
      if (!file_put_contents("../json/Questions.json",$jsonData)){
        die('Error: Fichero JSON no abierto');
      }else{
        echo "Se ha insertado la pregunta en el JSON correctamente</br>";
      }
  }
?>