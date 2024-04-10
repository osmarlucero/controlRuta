<?php
include_once "connectionController.php";
if (!isset($_SESSION)) {
    session_start();
	}
class NotificationController {
    public function getInsumos() {
        $conn = connect();
		$id=$_SESSION['id'];
        if ($conn->connect_error == false) {
            if($_SESSION['rol']=="Admin"){
            		$query = "SELECT * FROM `notifications` where leida=0";
            		$prepared_query = $conn->prepare($query);
			}
			else{
				$query = "SELECT * FROM `notifications` WHERE id_vendedor=(SELECT id FROM users WHERE encargado = ?) and leida=0;";
				$prepared_query = $conn->prepare($query);
				$prepared_query->bind_param('i',$id);
			}
            if ($prepared_query->execute()) {
                $result = $prepared_query->get_result();
                $insumos = $result->fetch_all(MYSQLI_ASSOC);
                return $insumos;
            } else {
                return array(); // Retorna un array vacío si la consulta falla
            }
        } else {
            return array(); // Retorna un array vacío si hay un error de conexión
        }
    }
}

// Ejemplo de uso
$notificationController = new NotificationController();
$insumos = $notificationController->getInsumos();

// Convertir el array a formato JSON
$json_insumos = json_encode($insumos);

// Imprimir el JSON
echo $json_insumos;
?>
