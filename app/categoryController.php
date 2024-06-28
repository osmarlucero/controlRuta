<?php
	if (!isset($_SESSION)) {
    session_start();
	}
	include_once "connectionController.php";
	if(isset($_POST['action'])){
		$CategoryController = new CategoryController();
		switch ($_POST['action']) {
			case 'storeUser':
				$id = 1;
				$nombre = strip_tags($_POST['nombre']);
				$apellido = strip_tags($_POST['apellido']);
				$rol = strip_tags($_POST['rol']);
				$mac = strip_tags($_POST['mac']);
				$pass = strip_tags($_POST['password']);
				$CategoryController->storeUser($id, $nombre, $apellido,$rol,$mac,$pass);
			break;
			case 'updateUser':
				$id = strip_tags($_POST['id']);;
				$nombre = strip_tags($_POST['nombre']);
				$apellido = strip_tags($_POST['apellido']);
				$rol = strip_tags($_POST['rol']);
				$mac = strip_tags($_POST['mac']);
				$pass = strip_tags($_POST['password']);
				$CategoryController->updateUser($id, $nombre, $apellido,$rol,$mac,$pass);
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
			case 'editStore':
				$id_tienda = strip_tags($_POST['id']);
				$nombre = strip_tags($_POST['nombre']);
				$nombre_responsable = strip_tags($_POST['nombre_responsable']);
				$direccion = strip_tags($_POST['direccion']);
				$correo = strip_tags($_POST['correo']);
				$RFC = strip_tags($_POST['RFC']);
				$telefono = strip_tags($_POST['telefono']);
				$vendedor = strip_tags($_POST['vendedor']);
				$precio = strip_tags($_POST['precio']);

				$CategoryController->updateStore($id_tienda, $nombre, $nombre_responsable, $direccion, $correo, $RFC, $telefono, $vendedor, $precio);

			break;
			case 'updateFact':
				$update = isset($_POST['update']) ? true : false;
				$id = strip_tags($_POST['id']);
				$CategoryController->updateFact($update,$id);
			break;
			case 'getSellsDate':
				$dateStart = strip_tags($_POST['dateStart']);
				$dateEnd = strip_tags($_POST['dateEnd']);
				$userM = strip_tags($_POST['userM']);
				$CategoryController->getVentasDate($dateStart,$dateEnd,$userM);
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
		public function updateFact($update,$id) {
		    $conn = connect();
		    if ($conn->connect_error == false) {
		        $query = "UPDATE notifications SET leida = ? WHERE id_noti = ?;";
		        $prepared_query = $conn->prepare($query);
		        $prepared_query->bind_param('ii', $update,$id);

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
		public function updateStore($id_tienda, $nombre, $nombre_responsable, $direccion, $correo, $RFC, $telefono, $vendedor, $precio) {
		    $conn = connect();
		    if ($conn->connect_error == false) {
		        $query = "UPDATE tienda SET nombre = ?, nombre_responsable = ?, direccion = ?, correo = ?, RFC = ?, telefono = ?, vendedor = ?, precio = ?
		         WHERE id_tienda = ?";
		        $prepared_query = $conn->prepare($query);
		        $prepared_query->bind_param('ssssssiii',$nombre, $nombre_responsable, $direccion, $correo, $RFC, $telefono, $vendedor, $precio,$id_tienda);

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
		public function storeUser($id, $nombre, $apellido,$rol,$mac,$pass){
			$conn = connect();
			$pass= $pass."Hola";
			$pass_md5=md5($pass);
			if ($conn->connect_error==false){
				if($id!=""){
						$query="insert into users (nombre, apellido,rol,mac_impresora,password_md5) VALUES (?,?,?,?,?)";
						$prepared_query = $conn->prepare($query);

						$prepared_query->bind_param('sssss', $nombre, $apellido, $rol,$mac,$pass_md5);
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
		public function updateUser($id, $nombre, $apellido,$rol,$mac,$pass){
			$conn = connect();
			$pass= $pass."Hola";
			$pass_md5=md5($pass);
			if ($conn->connect_error==false){
				if($id!=""){
						$query="update users set nombre= ? , apellido= ?, rol=? , mac_impresora=? , password_md5=? where id = ?";
						$prepared_query = $conn->prepare($query);

						$prepared_query->bind_param('sssssi', $nombre, $apellido, $rol,$mac,$pass_md5,$id);
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
 			$id=$_SESSION['id'];
			if ($conn->connect_error==false){
				if($_SESSION['rol']!="Admin"){	
					$query = "select * FROM `users`where encargado =? ORDER BY `users`.`id` DESC;";
					$prepared_query = $conn->prepare($query);
					$prepared_query->bind_param('i',$id);
				}else{
					$query = "select * FROM `users` ORDER BY `users`.`id` DESC;";
					$prepared_query = $conn->prepare($query);
				}
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
				$query = "select * FROM `inventarios`";
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
		public function getSellers(){
			$id=$_SESSION['id'];
			if($id!=1){
	 			$conn = connect();
				if ($conn->connect_error==false){			
					$query = "SELECT * FROM users WHERE encargado =".$id;
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
		public function getArticles($id){
			
			if($id!=null){
	 			$conn = connect();
				if ($conn->connect_error==false){			
					$query = "SELECT * FROM inventariovendedor WHERE id_vendedor =".$id;
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
	 			$id=$_SESSION['id'];
				if ($conn->connect_error==false){	
					if($_SESSION['rol']=="Admin"){
						$query = "SELECT v.*, t.nombre AS nombre_tienda FROM ventas v JOIN tienda t ON v.cliente_id = t.id_tienda ORDER BY `v`.`venta_id` DESC";
						$prepared_query = $conn->prepare($query);
					}
					else{
						$query = "SELECT v.*, t.nombre AS nombre_tienda FROM ventas v JOIN tienda t ON v.cliente_id = t.id_tienda WHERE v.id_vendedor = (SELECT id FROM users WHERE encargado = ?) ORDER BY v.venta_id DESC;";
						$prepared_query = $conn->prepare($query);
						$prepared_query->bind_param('i',$id);
					}
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
		public function getVentasDate($fechaInicio, $fechaFinal,$user){
			if(true){
	 			$conn = connect();
	 			//$id=$_SESSION['id'];
				if ($conn->connect_error==false){	
					if(true){
						$query = "SELECT v.id_vendedor, t.id_tienda, t.nombre AS nombre_tienda, dv.nombre_articulo, SUM(dv.cantidad) AS cantidad_total FROM ventas v JOIN detalleventa dv ON v.venta_id = dv.venta_id JOIN tienda t ON v.cliente_id = t.id_tienda WHERE v.fecha_venta BETWEEN ? AND ? AND v.id_vendedor IN (SELECT id FROM users WHERE encargado = ?) GROUP BY t.id_tienda, t.nombre, dv.nombre_articulo;";
						$prepared_query = $conn->prepare($query);
						$prepared_query->bind_param('sss',$fechaInicio,$fechaFinal,$user);					
					}
					else{
						$query = "SELECT v.*, t.nombre AS nombre_tienda FROM ventas v JOIN tienda t ON v.cliente_id = t.id_tienda WHERE v.id_vendedor = (SELECT id FROM users WHERE encargado = ?) ORDER BY v.venta_id DESC;";
						$prepared_query = $conn->prepare($query);
						$prepared_query->bind_param('i',$id);
					}
					$prepared_query->execute();
					$results = $prepared_query->get_result();
					$users = $results->fetch_all(MYSQLI_ASSOC);
					if( count($users)>0){
						$json_product = json_encode($users);
            			echo $json_product; 
					}else{
						echo json_encode(["ERROR" => "No hay ventas en ese periodo de tiempo"]);
					}
				}else{
					echo json_encode(["error" => "Error en conexion"]);
				}
			}else
				return array();
		}

		public function getVentasDetail($id){
			if(true){
	 			$conn = connect();
				if ($conn->connect_error==false){	
					$query = "SELECT * FROM `ventas` WHERE venta_id = ?";
					$prepared_query = $conn->prepare($query);
					$prepared_query->bind_param('i',$id);
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

		public function getStats(){
			if(true){
	 			$conn = connect();
	 			$id=$_SESSION['id'];
				if ($conn->connect_error==false){
					if($_SESSION['rol']=="Admin"){
						$query = "SELECT nombre_articulo AS nombre, SUM(cantidad) AS ventas FROM detalleventa GROUP BY nombre_articulo;";
						$prepared_query = $conn->prepare($query);
					}
					else{
						$query = "SELECT nombre_articulo AS nombre, SUM(cantidad) AS ventas FROM detalleventa where venta_id=(SELECT venta_id FROM ventas v JOIN tienda t ON v.cliente_id = t.id_tienda WHERE v.id_vendedor = (SELECT id FROM users WHERE encargado = ?) ORDER BY v.venta_id DESC) GROUP BY nombre_articulo;";
						$prepared_query = $conn->prepare($query);
						$prepared_query->bind_param('i',$id);
					}
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
		public function getUsersStats(){
			if(true){
	 			$conn = connect();
	 			$id=$_SESSION['id'];
				if ($conn->connect_error==false){
					if($_SESSION['rol']=="Admin"){
						$query = "SELECT * FROM users where rol='Admin' or rol='encargado';";
						$prepared_query = $conn->prepare($query);
					}
					else{
						$query = "SELECT * FROM users where id=?";
						$prepared_query = $conn->prepare($query);
						$prepared_query->bind_param('i',$id);
					}
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
					$query = "select * FROM `detalleventa` where venta_id=".$id;
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
	 			$id=$_SESSION['id'];
				if ($conn->connect_error==false){
					if($_SESSION['rol']=="Admin"){
						$query = "select * FROM tienda Order by id_tienda DESC";
						$prepared_query = $conn->prepare($query);
					}
					else{
						$query = "SELECT * from tienda where vendedor = (SELECT id FROM users WHERE encargado = ?)";
						$prepared_query = $conn->prepare($query);
						$prepared_query->bind_param('i',$id);
					}			
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
					$query = "select * FROM `tienda` where id_tienda=".$id." Order by id_tienda DESC";
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
		public function getStocks($id){
			if(true){
	 			$conn = connect();
				if ($conn->connect_error==false){			
					$query = "select * FROM `inventariovendedor` where id_vendedor=".$id;
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
		public function getIncidents(){
			if(true){
	 			$conn = connect();
				if ($conn->connect_error==false){			
					$id=$_SESSION['id'];
					if ($conn->connect_error==false){
						if($_SESSION['rol']=="Admin"){
							$query = "SELECT incidentes.*, tienda.nombre AS nombre_tienda FROM incidentes JOIN tienda ON incidentes.tienda_id = tienda.id_tienda ORDER BY `incidentes`.`id` DESC;";
							$prepared_query = $conn->prepare($query);
						}
						else{
							$query = "SELECT incidentes.*, tienda.nombre AS nombre_tienda FROM incidentes JOIN tienda ON incidentes.tienda_id = tienda.id_tienda WHERE incidentes.id_vendedor = (SELECT id FROM users WHERE encargado = ?) ORDER BY incidentes.id DESC;";
							$prepared_query = $conn->prepare($query);
							$prepared_query->bind_param('i',$id);
						}	
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