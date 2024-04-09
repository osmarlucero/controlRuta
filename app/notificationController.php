<?php
include_once "connectionController.php";
if (!isset($_SESSION)) {
    session_start();
	}
class NotificationController {
    public function getCount() {     
        try {
            $conn = connect();
            $id=$_SESSION['id'];
            if ($conn->connect_error == false) {
				if($_SESSION['rol']!="Admin"){
                	$query = "SELECT COUNT(*) AS count FROM `notifications` where id_vendedor = (SELECT id FROM users WHERE encargado = ?);";
                	$prepared_query = $conn->prepare($query);
					$prepared_query->bind_param('i',$id);
                }else{
                	$query = "SELECT COUNT(*) AS count FROM `notifications`";
                }
                if ($prepared_query->execute()) {
                    $result = $prepared_query->get_result();
                    $data = $result->fetch_assoc();
                    
                    return $data['count'];
                } else {
                    throw new Exception("Error al ejecutar la consulta");
                }
            } else {
                throw new Exception("Error de conexión a la base de datos");
            }
        } catch (Exception $e) {
            // Manejar la excepción
            return $e->getMessage();
        }
    }
}
// Ejemplo de uso
$notificationController = new NotificationController();
echo $notificationController->getCount(); 
?>
