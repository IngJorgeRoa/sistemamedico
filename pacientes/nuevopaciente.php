<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "control_medico");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Procesar el formulario si se envía
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $numero_expediente = $_POST['numero_expediente'];
    $nombre_paciente = $_POST['nombre_paciente'];
    $calle = $_POST['calle'];
    $numero = $_POST['numero'];
    $colonia = $_POST['colonia'];
    $municipio = $_POST['municipio'];
    $estado = $_POST['estado'];
    $codigo_postal = $_POST['cp'];
    $telefono = $_POST['telefono'];
    $fecha = $_POST['fecha'];

    // Insertar datos en la base de datos
    $sql = "INSERT INTO pacientes (numero_expediente, nombre_paciente, calle, numero, colonia, municipio, estado, cp, telefono, fecha) 
            VALUES ('$numero_expediente', '$nombre_paciente', '$calle', '$numero', '$colonia', '$municipio', '$estado', '$codigo_postal', '$telefono', '$fecha')";

    if ($conexion->query($sql) === TRUE) {
        header("Location: view.php"); // Redirigir a la lista de pacientes
    } else {
        echo "Error: " . $conexion->error;
    }

    $conexion->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Paciente</title>
    <link rel="stylesheet" href="../assets/css/style01pacientes.css">
</head>
<body>
    <div class="form-container">
        <h2>Agregar Nuevo Paciente</h2>
        <form action="" method="POST">
            <label for="numero_expediente">Número de Expediente</label>
            <input type="text" id="numero_expediente" name="numero_expediente" required>

            <label for="nombre_paciente">Nombre del Paciente</label>
            <input type="text" id="nombre_paciente" name="nombre_paciente" required>

            <label for="calle">Calle</label>
            <input type="text" id="calle" name="calle" required>

            <label for="numero">Número</label>
            <input type="text" id="numero" name="numero" required>

            <label for="colonia">Colonia</label>
            <select id="colonia" name="colonia" required>
                <option value="">Selecciona la</option>
                <option value="Barrio San Francisco">Barrio San Francisco</option>
                <option value="Bellavista">Bellavista</option>
                <option value="Chapultepec">Chapultepec</option>
                <option value="Cuauhtémoc">Cuauhtémoc</option>
                <option value="Fraccionamiento El Verde">Fraccionamiento El Verde</option>
                <option value="Huandacareo Centro">Huandacareo Centro</option>
                <option value="La Estancia">La Estancia</option>
                <option value="La Granja">La Granja</option>
                <option value="La Nopalera">La Nopalera</option>
                <option value="La Noria">La Noria</option>
                <option value="Salvador Urrutia">Salvador Urrutia</option>
                <option value="San Cristóbal">San Cristóbal</option>
                <option value="San José Cuaro">San José Cuaro</option>
                <option value="Tupatarillo">Tupatarillo</option>
                <option value="Tupátaro">Tupátaro</option>
                <option value="Vistabella">Vistabella</option>
            </select>

            <label for="municipio">Municipio</label>
            <input type="text" id="municipio" name="municipio" required>

            <label for="estado">Estado</label>
            <input type="text" id="estado" name="estado" required>

            <label for="codigo_postal">C.P</label>
            <input type="text" id="codigo_postal" name="cp" required>

            <label for="telefono">Teléfono</label>
            <input type="text" id="telefono" name="telefono" required>

            <label for="fecha">Fecha</label>
            <input type="date" id="fecha" name="fecha" required>

            <button type="submit" class="btn">Guardar</button>
        </form>
    </div>
</body>
</html>
