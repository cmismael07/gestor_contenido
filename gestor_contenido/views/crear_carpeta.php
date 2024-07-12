<?php
session_start();
$success_message = "";
$error_message = "";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../includes/db.php';

    // Obtener datos del formulario
    $nombre_carpeta = $_POST['nombre'];
    $usuario = $_SESSION['usuario_id'] ?? null;

    // Validar y procesar la creación de la carpeta
    if (!empty($nombre_carpeta)) {
        // Preparar la consulta SQL para insertar la carpeta
        $sql = "INSERT INTO carpetas (nombre, cliente_id) VALUES ('$nombre_carpeta', '$usuario_id')";

        // Ejecutar la consulta y verificar el resultado
        if ($conn->query($sql) === TRUE) {
            $success_message = "Carpeta creada exitosamente.";
        } else {
            $error_message = "Error al crear la carpeta: " . $conn->error;
        }

        // Cerrar la conexión
        $conn->close();
    } else {
        echo "Por favor, ingresa un nombre para la carpeta.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Carpeta</title>
    <link rel="stylesheet" href="">
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <h2>Crear Carpeta</h2>
    <form action="crear_carpeta.php" method="POST">
    <label for="nombre">Nombre de la Carpeta:</label>
    <input type="text" id="nombre" name="nombre" required><br><br>

    <label for="cliente">Cliente:</label>
    <select id="cliente" name="cliente" required>
        <!-- Aquí debes obtener y mostrar opciones de clientes desde la base de datos -->
        <?php
        // Ejemplo de cómo puedes obtener y mostrar opciones de clientes
        $sql = "SELECT id, nombre FROM clientes";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value=\"" . $row["id"] . "\">" . $row["nombre"] . "</option>";
            }
        }
        ?>
    </select><br><br>

    <input type="submit" value="Crear Carpeta">
</form>
    <script src="../js/scripts.js"></script>
</body>
</html>
