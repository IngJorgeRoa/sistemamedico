<?php
$servername = "localhost";
$username = "root"; // Cambiar si tienes otro usuario
$password = ""; // Cambiar si tienes contraseña
$dbname = "control_medico";

// Crear conexión
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verificar conexión
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>
