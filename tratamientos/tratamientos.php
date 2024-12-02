<?php
// Iniciar la sesión
session_start();
// Conectar a la base de datos
include('../bd/conexion.php');

// Consultar los pacientes, médicos y usuarios
$query_pacientes = "SELECT numero_expediente, nombre_paciente FROM pacientes";
$result_pacientes = mysqli_query($conn, $query_pacientes);

$query_medicos = "SELECT id, nombre FROM medicos";
$result_medicos = mysqli_query($conn, $query_medicos);

$query_usuarios = "SELECT id, nombre FROM usuarios";
$result_usuarios = mysqli_query($conn, $query_usuarios);

// Verificar si se envió el formulario para agregar un tratamiento
if (isset($_POST['submit'])) {
    $numero_expediente = $_POST['numero_expediente'];
    $nombre_paciente = $_POST['nombre_paciente'];
    $tratamiento = $_POST['tratamiento'];
    $observaciones = $_POST['observaciones'];
    $cantidad = $_POST['cantidad'];
    $costo_unitario = $_POST['costo_unitario'];
    $costo_total = $_POST['costo_total']; // Este valor se calcula automáticamente
    $cd_id = $_POST['cd_id'];
    $fecha = $_POST['fecha'];
    $usuario_id = $_SESSION['user_id']; // Asumiendo que el ID del usuario está almacenado en la sesión

    // Insertar el tratamiento en la base de datos
    $query_insert = "INSERT INTO tratamientos (numero_expediente, nombre_paciente, tratamiento, observaciones, cantidad, costo_unitario, costo_total, cd_id, fecha, usuario_id) 
                     VALUES ('$numero_expediente', '$nombre_paciente', '$tratamiento', '$observaciones', '$cantidad', '$costo_unitario', '$costo_total', '$cd_id', '$fecha', '$usuario_id')";
    mysqli_query($conn, $query_insert);
}

// Consultar todos los tratamientos registrados
$query_tratamientos = "SELECT * FROM tratamientos";
$result_tratamientos = mysqli_query($conn, $query_tratamientos);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tratamientos</title>
    <link rel="stylesheet" href="../assets/css/style03tratamientos.css">
    <script type="text/javascript">
        // Función para calcular el costo total
        function calcularCostoTotal() {
            // Obtener los valores de cantidad y costo unitario
            var cantidad = document.getElementById("cantidad").value;
            var costoUnitario = document.getElementById("costo_unitario").value;
            
            // Validar que ambos campos estén llenos y sean números
            if (cantidad && costoUnitario && !isNaN(cantidad) && !isNaN(costoUnitario)) {
                // Calcular el costo total
                var costoTotal = cantidad * costoUnitario;
                document.getElementById("costo_total").value = costoTotal.toFixed(2); // Mostrar el costo total con dos decimales
            } else {
                // Si los campos están vacíos o no son válidos, borrar el costo total
                document.getElementById("costo_total").value = '';
            }
        }

        // JavaScript para actualizar el nombre del paciente cuando se selecciona un número de expediente
function actualizarNombrePaciente() {
    var selectExpediente = document.getElementById('numero_expediente');
    var nombrePacienteInput = document.getElementById('nombre_paciente');
    
    // Obtener el expediente seleccionado
    var selectedOption = selectExpediente.options[selectExpediente.selectedIndex];
    
    // Obtener el nombre asociado a esa opción
    var nombrePaciente = selectedOption.getAttribute('data-nombre');
    
    // Actualizar el campo correspondiente con el nombre del paciente
    nombrePacienteInput.value = nombrePaciente;
}
    </script>
</head>
<body>
    <div class="container">
        <h1>Tratamientos</h1>
        <br>
        <a href="../index.php" class="btn">Ir al Menú</a>
        <!-- Formulario para agregar un tratamiento -->
        <form method="POST" action="tratamientos.php">
             <!-- Campo Número de Expediente -->
    <label for="numero_expediente">Número de Expediente</label>
    <select name="numero_expediente" id="numero_expediente" required onchange="actualizarNombrePaciente()">
        <option value="">Seleccionar Número de Expediente</option>
        <?php 
        // Iterar sobre los resultados de la consulta SQL y mostrar pacientes
        while ($row = mysqli_fetch_assoc($result_pacientes)): ?>
            <option value="<?php echo $row['numero_expediente']; ?>" data-nombre="<?php echo $row['nombre_paciente']; ?>">
                <?php echo $row['numero_expediente']; ?> - <?php echo $row['nombre_paciente']; ?>
            </option>
        <?php endwhile; ?>
    </select>

    <!-- Campo Nombre del Paciente -->
    <label for="nombre_paciente">Nombre del Paciente</label>
    <input type="text" name="nombre_paciente" id="nombre_paciente" readonly />

        
            <label for="tratamiento">Tratamiento</label>
            <input type="text" name="tratamiento" id="tratamiento" required>

            <label for="observaciones">Observaciones</label>
            <textarea name="observaciones" id="observaciones"></textarea>

            <label for="cantidad">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" required oninput="calcularCostoTotal()">

            <label for="costo_unitario">Costo Unitario</label>
            <input type="number" step="0.01" name="costo_unitario" id="costo_unitario" required oninput="calcularCostoTotal()">

            <label for="costo_total">Costo Total</label>
            <input type="text" name="costo_total" id="costo_total" readonly>

            <label for="cd_id">Médico</label>
            <select name="cd_id" id="cd_id" required>
                <?php while ($row = mysqli_fetch_assoc($result_medicos)): ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                <?php endwhile; ?>
            </select>

            <label for="fecha">Fecha</label>
            <input type="date" name="fecha" id="fecha" required>

            <button type="submit" name="submit">Agregar Tratamiento</button>
        </form>

        <!-- Tabla de tratamientos registrados -->
        <table class="table">
            <thead>
                <tr>
                    <th>Número de Expediente</th>
                    <th>Nombre Paciente</th>
                    <th>Tratamiento</th>
                    <th>Observaciones</th>
                    <th>Cantidad</th>
                    <th>Costo Unitario</th>
                    <th>Costo Total</th>
                    <th>Médico</th>
                    <th>Fecha</th>
                    <th>Usuario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result_tratamientos)): ?>
                    <tr>
                        <td><?php echo $row['numero_expediente']; ?></td>
                        <td><?php echo $row['nombre_paciente']; ?></td>
                        <td><?php echo $row['tratamiento']; ?></td>
                        <td><?php echo $row['observaciones']; ?></td>
                        <td><?php echo $row['cantidad']; ?></td>
                        <td><?php echo $row['costo_unitario']; ?></td>
                        <td><?php echo $row['costo_total']; ?></td>
                        <td><?php echo $row['cd_id']; ?></td>
                        <td><?php echo $row['fecha']; ?></td>
                        <td><?php echo $row['usuario_id']; ?></td>
                        <td>
                            <a href="editar_tratamiento.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Editar</a>
                            <a href="eliminar_tratamiento.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
