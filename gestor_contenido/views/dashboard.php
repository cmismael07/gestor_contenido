<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

include '../includes/db.php';

$user_id = $_SESSION['user_id'];
$rol = $_SESSION['rol'];

// Obtener todos los clientes
$sql_clientes = "SELECT * FROM clientes";
$result_clientes = $conn->query($sql_clientes);
if (!$result_clientes) {
    die("Error en la consulta: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <h1>Bienvenido, <?php echo $_SESSION['username']; ?></h1>
    <div>
        <h2>Clientes</h2>
        <ul>
            <?php while ($cliente = $result_clientes->fetch_assoc()): ?>
                <li>
                    <strong><?php echo $cliente['nombre']; ?></strong><br>
                    Email: <?php echo $cliente['email']; ?><br>
                    Teléfono: <?php echo $cliente['telefono']; ?><br>
                    Dirección: <?php echo $cliente['direccion']; ?><br>
                    <h3>Carpetas</h3>
                    <ul>
                        <?php
                        $cliente_id = $cliente['id'];
                        $sql_carpetas = "SELECT * FROM carpetas WHERE cliente_id='$cliente_id'";
                        $result_carpetas = $conn->query($sql_carpetas);
                        if (!$result_carpetas) {
                            echo "<li>Error en la consulta: " . $conn->error . "</li>";
                            continue;
                        }
                        while ($carpeta = $result_carpetas->fetch_assoc()): ?>
                            <li>
                                <?php echo $carpeta['nombre']; ?>
                                <ul>
                                    <?php
                                    $carpeta_id = $carpeta['id'];
                                    $sql_archivos = "SELECT * FROM archivos WHERE carpeta_id='$carpeta_id'";
                                    $result_archivos = $conn->query($sql_archivos);
                                    if (!$result_archivos) {
                                        echo "<li>Error en la consulta: " . $conn->error . "</li>";
                                        continue;
                                    }
                                    while ($archivo = $result_archivos->fetch_assoc()): ?>
                                        <li><?php echo $archivo['nombre']; ?> (<?php echo $archivo['tipo']; ?>)</li>
                                    <?php endwhile; ?>
                                </ul>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>
</html>
