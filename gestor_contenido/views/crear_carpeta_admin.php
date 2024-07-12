<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../includes/db.php';

    // Obtener datos del formulario
    $nombre_carpeta = $_POST['nombre_carpeta'];

    // Validar y procesar la creación de la carpeta
    if (!empty($nombre_carpeta)) {
        // Preparar la consulta SQL para insertar la carpeta
        $sql = "INSERT INTO carpetas (nombre) VALUES ('$nombre_carpeta')";

        // Ejecutar la consulta y verificar el resultado
        if ($conn->query($sql) === TRUE) {
            echo "Carpeta creada exitosamente.";
        } else {
            echo "Error al crear la carpeta: " . $conn->error;
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
    <title>Crear Carpeta (Admin)</title>
    <link rel="stylesheet" href="">
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <h2>Crear Carpeta (Admin)</h2>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="nombre_carpeta">Nombre de la Carpeta:</label>
        <input type="text" id="nombre_carpeta" name="nombre_carpeta" required>
        <button type="submit">Crear</button>
    </form>
    <?php include '../includes/footer.php'; ?>
</body>
</html>
