<?php
	define("HOST", "srv901.hstgr.io");
	define("USER", "u848276287_root");
	define("PSWD", "Fixcel016_");
	define("DBNM", "u848276287_system");
	function connect(){
		$conn = new mysqli(HOST,USER,PSWD,DBNM);
		if ($conn) {
			return $conn;
		}
		return null;
	}
?>