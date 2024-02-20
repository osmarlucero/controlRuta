<?php
	define("HOST", "localhost");
	define("USER", "id21732187_root");
	define("PSWD", "Fixcel016_");
	define("DBNM", "id21732187_app");

	function connect(){
		$conn = new mysqli(HOST,USER,PSWD,DBNM);
		if ($conn) {
			return $conn;
		}
		return null;
	}
?>