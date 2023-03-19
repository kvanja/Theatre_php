<?php 
	$imeServera = "localhost";
	$dbUsername = "root";
	$dbPassword = "";
	$dbIme = "projekt";

	$conn = new mysqli($imeServera,$dbUsername,$dbPassword,$dbIme);
	$conn->set_charset("utf8");

	if (!$conn) {
		die("Neuspješno povezivanje sa bazom". mysqli_connect_error());
	}
?>