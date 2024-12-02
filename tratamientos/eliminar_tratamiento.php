<?php
// Conectar a la base de datos
include("../bd/conexion.php");

// Verificar si se ha enviado un ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Eliminar el tratamiento
    $query = "DELETE FROM tratamientos WHERE id = $id";
    mysqli_query($conn, $query);

    // Redirigir a la lista de tratamientos después de eliminar
    header("Location: tratamientos.php");
    exit();
}
?>
