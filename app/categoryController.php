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
		}
	}

	class CategoryController{
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
		
}
?>