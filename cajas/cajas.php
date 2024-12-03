<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $expediente = $_POST['expediente'] ?? '';
    $nombre = $_POST['nombre'] ?? 0;
    $total = $_POST['total'] ?? 0;
    $abono = $_POST['abono'] ?? 0;
    $tipo_pago = $_POST['tipo_pago'] ?? '';
    $comentarios = $_POST['comentarios'] ?? '';

    // Validación básica.
    if (empty($expediente) || empty($nombre) || empty($total) || empty($tipo_pago)) {
        echo "Por favor, complete todos los campos obligatorios.";
        exit;
    }
    //Conexión de la base de datos.
        $conexion = new mysqli("localhost", "root", "", "control_medico");
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }
        $sql = "INSERT INTO cajas VALUES ('$expediente','$nombre','$total','$abono','$tipo_pago','$comentarios')";
        if ($conexion->query($sql) === TRUE) {
            echo "<h1>Pago procesado exitosamente</h1>";
            echo "<p><strong>Expediente:</strong> $expediente</p>";
            echo "<p><strong>Nombre:</strong> $nombre</p>";
            echo "<p><strong>Total:</strong> $total</p>";
            echo "<p><strong>Abono:</strong> $abono</p>";
            echo "<p><strong>Tipo de Pago:</strong> $tipo_pago</p>";
            echo "<p><strong>Comentarios:</strong> " . htmlspecialchars($comentarios) . "</p>";
        } else {
            echo "Error: " . $conexion->error;
        }
        $conexion->close();
    //Fin de la conexión de la base de datos.
    //Procesar el pago (lógica de negocio).
} else {
    echo "Método de solicitud no válido.";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área de Cajas - Formulario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Formulario para el Área de Cajas</h1>
        <form action="" method="POST" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="expediente" class="form-label"># de expediente</label>
                <input type="text" class="form-control" id="expediente" name="expediente" placeholder="Ingrese el expediente del cliente" required>
                <div class="invalid-feedback">Por favor, ingrese el # de expediente.</div>
            </div>
            <!--Pendiente de ajustar en PHP-->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre del cliente" required>
                <div class="invalid-feedback">Por favor, ingrese el nombre.</div>
            </div>
            <div class="mb-3">
                <label for="total" class="form-label">Monto total a Pagar</label>
                <input type="number" class="form-control" id="total" name="total" step="0.01" placeholder="Ingrese el total" required>
                <div class="invalid-feedback">Por favor, ingrese el monto total a pagar.</div>
            </div>
            <!--Fin del pendiente de ajustar en PHP-->
            <div class="mb-3">
                <label for="abono" class="form-label">Importe de abono</label>
                <input type="number" class="form-control" id="abono" name="abono" step="0.01" placeholder="Ingrese el abono" required>
                <div class="invalid-feedback">Por favor, ingrese el abono a pagar.</div>
            </div>
            <div class="mb-3">
                <label for="tipo_pago" class="form-label">Tipo de Pago</label>
                <select class="form-select" id="tipo_pago" name="tipo_pago" required>
                    <option value="" disabled selected>Seleccione el tipo de pago</option>
                    <option value="efectivo">Efectivo</option>
                    <option value="tarjeta">Tarjeta</option>
                    <option value="transferencia">Transferencia</option>
                </select>
                <div class="invalid-feedback">Por favor, seleccione un tipo de pago.</div>
            </div>
            <div class="mb-3">
                <label for="comentarios" class="form-label">Comentarios Adicionales</label>
                <textarea class="form-control" id="comentarios" name="comentarios" rows="3" placeholder="Ingrese comentarios si es necesario"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Procesar Pago</button>
        </form>
        <a href="../index.php"><button type="submit" class="btn btn-primary">Ir a menú</button></a>
    </div>

    <script>
        // Script para habilitar validación de Bootstrap
        (function () {
            'use strict';
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
</body>
</html>