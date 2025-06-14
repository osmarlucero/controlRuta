<?php
	if (!isset($_SESSION)) {
    session_start();
	}
	include_once "connectionController.php";
	if(isset($_POST['action'])){
		$mermaController = new mermaController();
		switch ($_POST['action']) {
			case 'subirProducto':
				$producto = strip_tags($_POST['producto']);
				$estado = strip_tags($_POST['estado']);
				$cantidad = strip_tags($_POST['cantidad']);
				$persona = strip_tags($_POST['persona']);
				$mermaController->subirProducto($producto, $estado, $cantidad,$persona);
			break;
			
		}
	}

	class mermaController{
		public function getMerma() {
		    $conn = connect();
		    if ($conn->connect_error == false) {
		        $id = $_SESSION['id'];

		        if ($_SESSION['rol'] == "Admin") {
		            // Admin ve todas las mermas
		            $query = "SELECT merma.*, tienda.nombre AS nombre_tienda 
		                      FROM merma 
		                      JOIN tienda ON merma.id_tienda = tienda.id_tienda 
		                      ORDER BY merma.id_merma DESC;";
		            $prepared_query = $conn->prepare($query);
		        } else {
		            // Encargado solo ve mermas de los vendedores a su cargo
		            $query = "SELECT merma.*, tienda.nombre AS nombre_tienda 
		                      FROM merma 
		                      JOIN tienda ON merma.tienda_id = tienda.id_tienda 
		                      WHERE merma.id_vendedor = (
		                          SELECT id FROM users WHERE encargado = ?
		                      ) 
		                      ORDER BY merma.id DESC;";
		            $prepared_query = $conn->prepare($query);
		            $prepared_query->bind_param('i', $id);
		        }

		        $prepared_query->execute();
		        $results = $prepared_query->get_result();
		        $mermas = $results->fetch_all(MYSQLI_ASSOC);

		        $prepared_query->close();
		        $conn->close();

		        return count($mermas) > 0 ? $mermas : array();
		    } else {
		        return array();
		    }
		}

		public function getIncidentsDetail($id){
			if(true){
	 			$conn = connect();
				if ($conn->connect_error==false){			
					$query = "SELECT incidentes.*, 
						       tienda.nombre AS nombre_tienda,
						       incidentes.latitud AS lat,
						       incidentes.longitud AS lng
						FROM incidentes 
						JOIN tienda ON incidentes.tienda_id = tienda.id_tienda 
						WHERE incidentes.id = ".$id." 
						ORDER BY incidentes.id DESC;";
					$prepared_query = $conn->prepare($query);
					$prepared_query->execute();
					$results = $prepared_query->get_result();
					$stores = $results->fetch_all(MYSQLI_ASSOC);
					if( count($stores)>0){
						return $stores;
					}else{
						return array();				
					}
				}else{
					echo "error";
				}
			}else
				return array();
		}
		
		
}