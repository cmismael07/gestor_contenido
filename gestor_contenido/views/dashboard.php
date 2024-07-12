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
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="../css/clientes.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <div class="container" style="margin-top: 70px;">
        <!--h1>Bienvenido, <!-?php echo $_SESSION['username']; ?></h1-->
        <div class="clientes">
            <?php while ($cliente = $result_clientes->fetch_assoc()): ?>
                <div class="cliente">
                    <h3><?php echo $cliente['nombre']; ?></h3>
                    <!--p><strong>Email:</strong> <--?php echo $cliente['email']; ?></p>
                    <p><strong>Teléfono:</strong> <--?php echo $cliente['telefono']; ?></p>
                    <p><strong>Dirección:</strong> <--?php echo $cliente['direccion']; ?></p-->
                    <div class="carpetas">
                        <h4>Carpetas</h4>
                        <?php
                        $cliente_id = $cliente['id'];
                        $sql_carpetas = "SELECT * FROM carpetas WHERE usuario_id='$cliente_id'";
                        $result_carpetas = $conn->query($sql_carpetas);
                        if (!$result_carpetas) {
                            echo "<p>Error en la consulta: " . $conn->error . "</p>";
                            continue;
                        }
                        while ($carpeta = $result_carpetas->fetch_assoc()): ?>
                            <div class="carpeta">
                                <h5><?php echo $carpeta['nombre']; ?></h5>
                                <div class="archivos">
                                    <!--h6>Archivos</h6-->
                                    <?php
                                    $carpeta_id = $carpeta['id'];
                                    $sql_archivos = "SELECT * FROM archivos WHERE carpeta_id='$carpeta_id'";
                                    $result_archivos = $conn->query($sql_archivos);
                                    if (!$result_archivos) {
                                        echo "<p>Error en la consulta: " . $conn->error . "</p>";
                                        continue;
                                    }
                                    while ($archivo = $result_archivos->fetch_assoc()): ?>
                                        <div class="archivo">
                                            <p><?php echo $archivo['nombre']; ?> (<?php echo $archivo['tipo']; ?>)</p>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <?php include '../includes/footer.php'; ?>
    <script src="../js/navbar.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/clientes.js"></script>
    <script src="../js/search.js"></script>
</body>
</html>
