<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "sekolah";

$conn = new mysqli($host, $username, $password, $database);

if(mysqli_connect_error()) {
	trigger_error("Failed to conencto to MySQL: " . mysql_connect_error(),
		E_USER_ERROR);
} else {
	echo "Berhasil terkoneksi";
}
?>