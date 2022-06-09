<?php
// Constantes para el acceso a datos...
//phpinfo();
DEFINE("_HOST_", "localhost");
DEFINE("_PORT_", "3306");
DEFINE("_USERNAME_", "root");
DEFINE("_DATABASE_", "quiz");
DEFINE("_PASSWORD_", "");

require_once 'database.php';
$method = $_SERVER['REQUEST_METHOD'];
$resource = $_SERVER['REQUEST_URI'];

    $cnx = Database::Conectar();
    switch ($method) {
        case 'GET': 
			if(isset($_GET['id']))
			{
                $datos = "";
                $id = $_GET['id'];
                $sql = "SELECT * FROM vips WHERE Email='$id'";
                $data=Database::EjecutarConsulta($cnx, $sql);
                if (isset($data[0])){
                    echo "<br><br><b>ENHORABUENA ".$id." ES VIP</b><br><img src=../images/ok.gif>";
                    break;
                }
                else {
                    echo "<br><br><b>LO SIENTO ".$id." NO ES VIP</b><br><img src=../images/mal.gif>";
                    break;
                }
			}
			else
			{
                $sql = "SELECT * FROM vips";
                $data=Database::EjecutarConsulta($cnx, $sql);
                echo($data);
				// Servicio para Listar Vips (GET sin parámetro)
			}
			break;
        case 'POST':
                $id = file_get_contents('php://input');
                $sql = "INSERT INTO vips(Email) VALUES ('$id')";
                $num=Database::EjecutarNoConsulta($cnx, $sql);
                if ($num==0){
                    echo (json_encode(array('Ya esta en la BD' => $id)));
                }
                else {
                    echo (json_encode(array('Creado Vip' => $id)));
                }
  
            // Para añadir VIPS
        case 'PUT':
            // Este no hay que implementar
        case 'DELETE':
            // Borrado de usuario VIP
            $id = file_get_contents('php://input');
                $sql = "DELETE FROM vips WHERE  Email='$id'";
                $num=Database::EjecutarNoConsulta($cnx, $sql);
                if ($num==0){
                    echo (json_encode(array('No eliminado ' => $id)));
                }
                else {
                    echo (json_encode(array('Eliminado ' => $id)));
                }
			}
    Database::Desconectar($cnx);

?>
