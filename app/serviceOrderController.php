<?php
	if (!isset($_SESSION)) {
    session_start();
	}
	include_once "connectionController.php";
	if(isset($_POST['action'])){
		$serviceController = new serviceController();
		switch ($_POST['action']) {
			case 'storeOrder':
				$nombre = strip_tags($_POST['name']);
				$direccion = strip_tags($_POST['address']);
				$celularAlternativo = strip_tags($_POST['cell_alt']);
				$celular = strip_tags($_POST['cell']);
				$marca = strip_tags($_POST['brand']);
				$codigo = strip_tags($_POST['code']);
				$modelo = strip_tags($_POST['model']);
				$imei = strip_tags($_POST['imei']);
				$accesorio = strip_tags($_POST['accesorio']);
				$descripcion = strip_tags($_POST['description']);
				$codigoInterno = strip_tags($_POST['codeInt']);
				$date =strip_tags($_POST['date']);
				$serviceController->store(
				$nombre,
				$direccion,
				$celularAlternativo,
				$celular,
				$marca,
				$codigo,
				$modelo,
				$imei,
				$accesorio,
				$descripcion,
				$codigoInterno,
				$date
				);
			break;
			case 'Update':
				$estado_os = strip_tags($_POST['estado_os']);
				$tecnico = strip_tags($_POST['tecnico']);
				$dictamen = strip_tags($_POST['dictamen']);
				$costo_reparacion = strip_tags($_POST['costo_reparacion']);
				$codigoInterno = strip_tags($_POST['codigoInterno']);
				$serviceController->Update(
					$estado_os,
					$tecnico,
					$dictamen,
					$costo_reparacion,
					$codigoInterno
				);
			break;
		}
	}

	class serviceController{
		public function store($nombre,
				$direccion,
				$celularAlternativo,
				$celular,
				$marca,
				$codigo,
				$modelo,
				$imei,
				$accesorio,
				$descripcion,
				$codigoInterno,$date){
			$conn = connect();
			if ($conn->connect_error==false){
				if($imei!=""){	
					$query="insert into orden(nombre_cliente, domicilio, telefono, telefono_alternativo, marca, modelo, codigo, imei, accesorio, descripcion, codigo_interno,fecha_Ingreso) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
					$prepared_query = $conn->prepare($query);
					$prepared_query->bind_param('ssssssssssss',$nombre, $direccion, $celular, $celularAlternativo, $marca,	$modelo, $codigo, $imei, $accesorio, $descripcion, $codigoInterno, $date);
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
		
		public function Update(
					$estado_os,
					$tecnico,
					$dictamen,
					$costo_reparacion, 
					$codigoInterno){
			$conn = connect();
			if ($conn->connect_error==false){
				if($codigoInterno!=""){
				echo("popo");
					$query="update orden set estado_os=?, tecnico=?, dictamen=?, costo_reparacion=? where codigo_interno= ?";
					$prepared_query = $conn->prepare($query);
					$prepared_query->bind_param('sssss',$estado_os,$tecnico,$dictamen,$costo_reparacion, $codigoInterno);
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
			else
				header("Location:".$_SERVER["HTTP_REFERER"]);
		}
		public function delete($id){
			$conn = connect();
			if ($conn->connect_error==false){
				if($id!=""){
					$query="delete from pelicula where id=?";
					$prepared_query = $conn->prepare($query);
					$prepared_query->bind_param('i',$id);
					if($prepared_query->execute()){
						header("Location:../Pages/index.php?name=Inicio");
					}
					else
						header("Location:".$_SERVER["HTTP_REFERER"]);

				}
			}
			else
				header("Location:".$_SERVER["HTTP_REFERER"]);
		}
	public function add($id, $views){
			$conn = connect();
			if ($conn->connect_error==false){
				if($id!=""&&$views!=""){
					$query="update pelicula set vizualizaciones=? where id=?";
					$prepared_query = $conn->prepare($query);
					$prepared_query->bind_param('ii',$views,$id);
					if($prepared_query->execute()){
						header("Location:".$_SERVER["HTTP_REFERER"]);
					}
					else
						header("Location:".$_SERVER["HTTP_REFERER"]);

				}
			}
			else
				header("Location:".$_SERVER["HTTP_REFERER"]);
		}
		public function getOrder($code){
			$name="all";
 			$conn = connect();
			if ($conn->connect_error==false){			
				switch ($name) {
					case 'all':
						$query = "select * FROM `orden` where codigo_interno=".$code;
					break;
				}
				$prepared_query = $conn->prepare($query);
				$prepared_query->execute();
				$results = $prepared_query->get_result();
				$categories = $results->fetch_all(MYSQLI_ASSOC);

				if( count($categories)>0){
					return $categories;
				}else{
					return array();				
				}
			}else{
				echo "error";
			}
		}
		
		public function getOrders($id){
			$conn = connect();
			if ($conn->connect_error==false){
				$query = "select * from orden";
				$prepared_query = $conn->prepare($query);
				//$prepared_query->bind_param();
				$prepared_query->execute();

				$results = $prepared_query->get_result();
				$categories = $results->fetch_all(MYSQLI_ASSOC);

				if( count($categories)>0){
					return $categories;
				}else{
					return array();				
				}
			}else{
				echo "error";
			}
		}
		public function getName($id){
			$conn = connect();
			if ($conn->connect_error==false){
				$query = "select nombre from pelicula where id=?";
				$prepared_query = $conn->prepare($query);
				$prepared_query->bind_param('i',$id);
				$prepared_query->execute();

				$results = $prepared_query->get_result();
				$categories = $results->fetch_all(MYSQLI_ASSOC);

				if( count($categories)>0){
					return $categories;
				}else{
					return array();				
				}
			}else{
				echo "error";
			}
		}

		public function getSidebar(){
			$conn = connect();
			if ($conn->connect_error==false){
				$query = "select DISTINCT  categoria FROM `pelicula`";
				$prepared_query = $conn->prepare($query);
				$prepared_query->execute();

				$results = $prepared_query->get_result();
				$categories = $results->fetch_all(MYSQLI_ASSOC);

				if( count($categories)>0){
					return $categories;
				}else{
					return array();				
				}
			}else{
				echo "error";
			}
		}	
		public function getSidebarCount($name){
			$conn = connect();
			if ($conn->connect_error==false){
				$query = "select COUNT(*) categoria from pelicula WHERE categoria='$name'";
				$prepared_query = $conn->prepare($query);
				$prepared_query->execute();

				$results = $prepared_query->get_result();
				$categories = $results->fetch_all(MYSQLI_ASSOC);

				if( count($categories)>0){
					return $categories;
				}else{
					return array();				
				}
			}else{
				echo "error";
			}
		}
	}
?>