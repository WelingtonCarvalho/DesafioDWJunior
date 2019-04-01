<?php
date_default_timezone_set('America/Sao_Paulo');
$servername = "localhost";
$username = "root";
$password = "";
$database = "agendasistema";
// Create connection
$db = new mysqli($servername, $username, $password, $database);
mysqli_set_charset($db, "utf8");

?>