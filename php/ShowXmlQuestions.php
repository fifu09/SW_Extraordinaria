<div>
	<h1>Preguntas almacenadas en XML</h1>
	<table>
		<tr>
			<th>AUTOR</th>
			<th>ENUNCIADO</th>
			<th>RESPUESTA</th>
		</tr>
	<?php 
	$xml = simplexml_load_file('../xml/Questions.xml');
		if(!$xml){
			echo "<h1>No se encuentra el fichero xml</h1>";
		}else{
			foreach($xml->assessmentItem as $item){
				$Email = $item["author"];
				$Pregunta = $item->itemBody->p;
				$Respuesta = $item->correctResponse->response;
				echo "<tr>";
				echo "<th>$Email</th>";
				echo "<th>$Pregunta</th>";
				echo "<th>$Respuesta</th>";
				echo "</tr>";
			}
		}
	?>
	</table>
	</div>