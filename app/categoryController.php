<?php
	/*if (!isset($_SESSION)) {
    session_start();
	}*/
	include_once "connectionController.php";
	if(isset($_POST['action'])){
		$CategoryController = new CategoryController();
		switch ($_POST['action']) {
			case 'storeUser':
				$id = strip_tags($_POST['id']);
				$nombre = strip_tags($_POST['nombre']);
				$apellido = strip_tags($_POST['apellido']);
				$rol = strip_tags($_POST['rol']);
				$CategoryController->storeUser($id, $nombre, $apellido,$rol);
			break;
			case 'getLocation':
				$CategoryController->getLocations();
			break;
			case 'storeStore':
				$nombre = strip_tags($_POST['nombreTienda']);
				$direccion = strip_tags($_POST['direccion']);
				$telofono = strip_tags($_POST['telefono']);
				$rfc = strip_tags($_POST['rfc']);
				$nombreEnc = strip_tags($_POST['nameEnc']);
				$email = strip_tags($_POST['email']);
				$CategoryController->storeStore($nombre, $direccion, $telofono, $rfc, $nombreEnc, $email);
			break;
			case 'updateStock':
				$id = strip_tags($_POST['id']);
				$idDon = strip_tags($_POST['idDon']);
				$cantidad = strip_tags($_POST['cantidad']);
				$CategoryController->updateStock($id, $idDon, $cantidad);
			break;
		}
	}

	class CategoryController{
		public function updateStock($id, $idDon, $cantidad) {
		    $conn = connect();
		    if ($conn->connect_error == false) {
		        $query = "CALL stockControl(?, ?, ?)";
		        $prepared_query = $conn->prepare($query);
		        $prepared_query->bind_param('iii', $id, $idDon, $cantidad);

		        if ($prepared_query->execute()) {
		            // El procedimiento se ejecutó correctamente
		            header("Location:" . $_SERVER["HTTP_REFERER"]);
		            $_SESSION['success'] = "Datos enviados correctamente";
		        } else {
		            // Error al ejecutar el procedimiento
		            $_SESSION['error'] = "Error al ejecutar el procedimiento almacenado";
		            header("Location:" . $_SERVER["HTTP_REFERER"]);
		        }
		    } else {
		        // Error en la conexión a la base de datos
		        $_SESSION['error'] = "Conexión Mala BD";
		        header("Location:" . $_SERVER["HTTP_REFERER"]);
		    }
		}
		public function storeUser($id, $nombre, $apellido,$rol){
			$conn = connect();
			if ($conn->connect_error==false){
				if($id!=""){
						$query="insert into users (id, nombre, apellido,rol) VALUES (?,?,?,?)";
						$prepared_query = $conn->prepare($query);
						$prepared_query->bind_param('isss',$id, $nombre, $apellido, $rol);
						if($prepared_query->execute()){
							header("Location:".$_SERVER["HTTP_REFERER"]);
							$_SESSION['success'] ="Datos enviados correctaqmente";
						}
						else{
							$_SESSION['error'] ="verifica datos";
							header("Location:".$_SERVER["HTTP_REFERER"]);
						}
				}
			}
			else{
				$_SESSION['error'] ="COnexion MAl BD";
				header("Location:".$_SERVER["HTTP_REFERER"]);
			}

		}
		/**
		 * 
		 * */
		public function storeStore($nombre, $direccion, $telofono, $rfc, $nombreEnc, $email){
			$conn = connect();
			if ($conn->connect_error==false){
				if($nombre!=""){
						$query="insert into tienda (nombre,direccion,telefono,RFC,nombre_responsable,correo,fecha_creacion) VALUES (?,?,?,?,?,?,CURRENT_DATE)";
						$prepared_query = $conn->prepare($query);
						$prepared_query->bind_param('ssssss',$nombre, $direccion, $telofono, $rfc, $nombreEnc, $email);
						if($prepared_query->execute()){
							header("Location:".$_SERVER["HTTP_REFERER"]);
							$_SESSION['success'] ="Datos enviados correctaqmente";
						}
						else{
							$_SESSION['error'] ="verifica datos";
							header("Location:".$_SERVER["HTTP_REFERER"]);
						}
				}
			}
			else{
				$_SESSION['error'] ="COnexion MAl BD";
				header("Location:".$_SERVER["HTTP_REFERER"]);
			}

		}
		//****
		public function getUsers(){
 			$conn = connect();
			if ($conn->connect_error==false){			
				$query = "select * FROM `users`";
				$prepared_query = $conn->prepare($query);
				$prepared_query->execute();
				$results = $prepared_query->get_result();
				$users = $results->fetch_all(MYSQLI_ASSOC);
				if( count($users)>0){
					return $users;
				}else{
					return array();				
				}
			}else{
				echo "error";
			}
		}
		public function getInsumos(){
 			$conn = connect();
			if ($conn->connect_error==false){			
				$query = "select * FROM `insumos`";
				$prepared_query = $conn->prepare($query);
				$prepared_query->execute();
				$results = $prepared_query->get_result();
				$insumos = $results->fetch_all(MYSQLI_ASSOC);
				if( count($insumos)>0){
					return $insumos;
				}else{
					return array();				
				}
			}else{
				echo "error";
			}
		}
		public function getInsumo($id,$nombre){
 			$conn = connect();
			if ($conn->connect_error==false){			
				$query = "SELECT * FROM `insumos` WHERE nombre = '$nombre'";
				$prepared_query = $conn->prepare($query);
				$prepared_query->execute();
				$results = $prepared_query->get_result();
				$insumos = $results->fetch_all(MYSQLI_ASSOC);
				if( count($insumos)>0){
					return $insumos;
				}else{
					return array();				
				}
			}else{
				echo "error";
			}
		}
		public function getUser($id){
			if($id!=1){
	 			$conn = connect();
				if ($conn->connect_error==false){			
					$query = "select * FROM `users` where id=".$id;
					$prepared_query = $conn->prepare($query);
					$prepared_query->execute();
					$results = $prepared_query->get_result();
					$users = $results->fetch_all(MYSQLI_ASSOC);
					if( count($users)>0){
						return $users;
					}else{
						return array();				
					}
				}else{
					echo "error";
				}
			}else
				return array();
		}
		public function getVentas(){
			if(true){
	 			$conn = connect();
				if ($conn->connect_error==false){			
					$query = "select * FROM `Ventas`";
					$prepared_query = $conn->prepare($query);
					$prepared_query->execute();
					$results = $prepared_query->get_result();
					$users = $results->fetch_all(MYSQLI_ASSOC);
					if( count($users)>0){
						return $users;
					}else{
						return array();				
					}
				}else{
					echo "error";
				}
			}else
				return array();
		}
		public function getDEtalleVenta($id){
			if(true){
	 			$conn = connect();
				if ($conn->connect_error==false){			
					$query = "select * FROM `DetalleVenta` where venta_id=".$id;
					$prepared_query = $conn->prepare($query);
					$prepared_query->execute();
					$results = $prepared_query->get_result();
					$users = $results->fetch_all(MYSQLI_ASSOC);
					if( count($users)>0){
						return $users;
					}else{
						return array();				
					}
				}else{
					echo "error";
				}
			}else
				return array();
		}
		public function getLocations(){
			if(true){
	 			$conn = connect();
				if ($conn->connect_error==false){			
					$query = "select lat, lng,nombre,id_tienda FROM `tienda`";
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
		public function getStoresInfo($id){
			if(true){
	 			$conn = connect();
				if ($conn->connect_error==false){			
					$query = "select * FROM `tienda` where id_tienda=".$id;
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
/*
CREATE PROCEDURE `stockControlUser` (IN 'stockDejado' INT, IN `idArticulo` INT,IN `idVendedor` INT)   BEGIN
    -- Declarar variables para almacenar los valores actuales y nuevos
    DECLARE stock_actual INT;
    DECLARE nuevo_stock INT;
    DECLARE id_nuevo INT;
    -- Obtener el stock actual del insumo con id = id
    SELECT cantidad INTO stock_actual FROM InventarioVendedor WHERE id_vendedor = idVendedor AND id_articulo = idArticulo LIMIT 1;
    SELECT id INTO id_nuevo FROM InventarioVendedor WHERE id_vendedor = idVendedor AND id_articulo = idArticulo LIMIT 1;

    -- Calcular el nuevo stock restando la cantidad especificada
    SET nuevo_stock = stock_actual - stockDejado;

	-- Actualizar el stock solo para el registro con id = id
    UPDATE InventarioVendedor SET cantidad = nuevo_stock WHERE id = id_nuevo;
END$$

DELIMITER ;
*/
?>