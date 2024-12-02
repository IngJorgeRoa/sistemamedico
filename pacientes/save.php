<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conexion = new mysqli("localhost", "root", "", "control_medico");
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $numero_expediente = $_POST['numero_expediente'];
    $nombre_paciente = $_POST['nombre_paciente'];
    $calle = $_POST['calle'];
    $numero = $_POST['numero'];
    $colonia = $_POST['colonia'];
    $municipio = $_POST['municipio'];
    $estado = $_POST['estado'];
    $codigo_postal = $_POST['codigo_postal'];
    $telefono = $_POST['telefono'];
    $fecha = $_POST['fecha'];

    $sql = "INSERT INTO pacientes (numero_expediente, nombre_paciente, calle, numero, colonia, municipio, estado, codigo_postal, telefono, fecha) 
            VALUES ('$numero_expediente', '$nombre_paciente', '$calle', '$numero', '$colonia', '$municipio', '$estado', '$codigo_postal', '$telefono', '$fecha')";

    if ($conexion->query($sql) === TRUE) {
        header("Location: pacientes.php");
    } else {
        echo "Error: " . $conexion->error;
    }

    $conexion->close();
}
