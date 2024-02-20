<?php
	define("HOST", "bstaaxredphdizbd8zrh-mysql.services.clever-cloud.com");
	define("USER", "utu8ouwielrititx");
	define("PSWD", "zKuHRes615gaRilyEcUd");
	define("DBNM", "bstaaxredphdizbd8zrh");

	function connect(){
		$conn = new mysqli(HOST,USER,PSWD,DBNM);
		if ($conn) {
			return $conn;
		}
		return null;
	}
?>