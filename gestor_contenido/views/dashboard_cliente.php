<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../includes/db.php';

    // Obtener datos del formulario
    $nombre_carpeta = $_POST['nombre'];
    $usuario = $_SESSION['usuario_id'] ?? null;

    // Validar y procesar la creación de la carpeta
    if (!empty($nombre_carpeta)) {
        // Preparar la consulta SQL para insertar la carpeta
        $sql = "INSERT INTO carpetas (nombre, usuario_id) VALUES ('$nombre_carpeta', ?)";

        // Ejecutar la consulta y verificar el resultado
        if ($conn->query($sql) === TRUE) {
            $success_message = "Carpeta creada exitosamente.";
        } else {
            $error_message = "Error al crear la carpeta: " . $conn->error;
        }

        // Cerrar la conexión
    
    } else {
        echo "Por favor, ingresa un nombre para la carpeta.";
    }
}
include '../includes/db.php';

$cliente_id = $_SESSION['usuario_id'] ?? null;
$rol = $_SESSION['rol'];

// Obtener carpetas y archivos del cliente
$sql_carpetas = "SELECT * FROM carpetas WHERE usuario_id='$cliente_id'";
$result_carpetas = $conn->query($sql_carpetas);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Cliente</title>
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
<?php include '../includes/header.php'; ?>
    <!--h1>Bienvenido, <!-?php echo $_SESSION['username']; ?></h1-->
    <div>
        <h2>Mis Carpetas</h2>
        <ul>
            <?php while ($carpeta = $result_carpetas->fetch_assoc()): ?>
                <li>
                    <?php echo $carpeta['nombre']; ?>
                    <ul>
                        <?php
                        $carpeta_id = $carpeta['id'];
                        $sql_archivos = "SELECT * FROM archivos WHERE carpeta_id='$carpeta_id'";
                        $result_archivos = $conn->query($sql_archivos);
                        while ($archivo = $result_archivos->fetch_assoc()): ?>
                            <li><?php echo $archivo['nombre']; ?> (<?php echo $archivo['tipo']; ?>)</li>
                        <?php endwhile; ?>
                    </ul>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
    <div>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h2>Crear Carpeta</h2>
            <label for="nombre">Nombre de la Carpeta:</label>
            <input type="text" id="nombre" name="nombre" required>
            <button type="submit">Crear</button>
        </form>
    </div>
    <div>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
            <h2>Subir Archivo</h2>
            <label for="carpeta">Seleccionar Carpeta:</label>
            <select id="carpeta" name="carpeta_id" required>
                <?php
                $result_carpetas->data_seek(0); // Reiniciar el puntero del resultado
                while ($carpeta = $result_carpetas->fetch_assoc()): ?>
                    <option value="<?php echo $carpeta['id']; ?>"><?php echo $carpeta['nombre']; ?></option>
                <?php endwhile; ?>
            </select>
            <label for="archivo">Seleccionar Archivo:</label>
            <input type="file" id="archivo" name="archivo" required>
            <button type="submit">Subir</button>
        </form>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>
</html>
