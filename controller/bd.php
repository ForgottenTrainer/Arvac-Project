<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "arvac";

// Conectar a la base de datos
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
// Establecer el modo de error de PDO a excepción
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



