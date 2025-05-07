<?php 

$host_db = "localhost";
$user_db = "root";
$pass_db = "SVlt1414cj";
$db_name = "personalizacion";


$conn = new mysqli($host_db, $user_db, $pass_db, $db_name);
$conn ->set_charset("utf8");

if ($conn ->connect_error) {
 die("La conexion falló: " . $conn->connect_error);
}

 ?>