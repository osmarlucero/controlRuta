
<?php
if (!isset($_SESSION)) {
    session_start();
	}
include_once "connectionController.php";
	if(isset($_POST['access'])){
		$AuthController = new AuthController();
		switch ($_POST['access']) {
			case 'login':
				$email = strip_tags($_POST['user']);
				$pass = strip_tags($_POST['pass']);
				$AuthController->login($email,$pass);
			break;

			case 'logout':
				$AuthController->logout();
			break;
		}
	
	}
 class AuthController{
 	public function login($email, $pass){
 		$conn = connect();
 		$passMD5=md5($pass."Hola");
			if ($conn->connect_error==false){
				$query="SELECT * FROM users where id =? and password_md5= ?";
				$prepared_query = $conn->prepare($query);
				$prepared_query->bind_param('is',$email,$passMD5);
				if($prepared_query->execute()){
					$results = $prepared_query->get_result();
                	$user = $results->fetch_all(MYSQLI_ASSOC);
					if(count($user)>0){
							//echo  ("r".$_SERVER["HTTP_REFERER"]."d");
						$user = array_pop($user);
						$_SESSION['id'] = $user['id'];
						$_SESSION['nombre'] = $user['nombre'];
						$_SESSION['apellido'] = $user['apellido'];
						$_SESSION['rol'] = $user['rol'];
						//if($_SESSION['rol']=="admin"){
							header("Location:../pages/main.php");
						//}
					}else{
                		$_SESSION['error'] = "Los datos de inicio de sesión son incorrectos.";
						header("Location:".$_SERVER["HTTP_REFERER"]);
					}
				}
				else{
					$_SESSION['error'] =" verifica datos";
					//header("Location:".$_SERVER["HTTP_REFERER"]);
				}
			}
			else{
				$_SESSION['error'] ="COnexion MAl BD";
				header("Location:".$_SERVER["HTTP_REFERER"]);
			}
 	}
 	public function logout(){
        session_destroy();
		header("Location:".$_SERVER["HTTP_REFERER"]);
 	}
 }
?>
