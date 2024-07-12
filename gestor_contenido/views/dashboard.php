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
    <!--link rel="stylesheet" href="../css/modal.css"-->
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <div class="container" style="margin-top: 70px;">
        <!--h1>Bienvenido, <--?php echo $_SESSION['username']; ?></h1-->
        <div class="clientes">
            <!--h2>Clientes</h2-->
            <table>
                <thead>
                    <tr>
                        
                        <th>Carpeta</th>
                        <th colspan="3"></th>
                        <th>Nombre Cliente</th>
                        <!--th>Fecha y Hora</th-->
                    </tr>
                </thead>
                <tbody>
                    <?php while ($cliente = $result_clientes->fetch_assoc()): ?>
                        <?php
                        $cliente_id = $cliente['id'];
                        $sql_carpetas = "SELECT * FROM carpetas WHERE usuario_id='$cliente_id'";
                        $result_carpetas = $conn->query($sql_carpetas);
                        if ($result_carpetas) {
                            while ($carpeta = $result_carpetas->fetch_assoc()): ?>
                                <tr>
                                <td><a href="#" class="open-modal" data-carpeta-id="<?php echo $carpeta['id']; ?>"><?php echo $carpeta['nombre']; ?></a></td>
                                <td colspan="3"></td>    
                                <td><?php echo $cliente['nombre']; ?></td>
                                    <!--td>Carpeta</td-->
                                    <!--td><--?php echo $carpeta['fecha_creacion']; ?></td-->
                                </tr>
                                <?php
                                $carpeta_id = $carpeta['id'];
                                $sql_archivos = "SELECT * FROM archivos WHERE carpeta_id='$carpeta_id'";
                                $result_archivos = $conn->query($sql_archivos);
                                if ($result_archivos) {
                                    while ($archivo = $result_archivos->fetch_assoc()): ?>
                                        <tr>
                                        <td><?php echo $archivo['nombre']; ?></td>
                                            <td><?php echo $cliente['nombre']; ?></td>
                                            
                                            <!--td><--?php echo $archivo['tipo']; ?></td-->
                                            <!--td><--?php echo $archivo['fecha_creacion']; ?></td-->
                                        </tr>
                                    <?php endwhile; ?>
                                <?php }
                            endwhile;
                        }
                        ?>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php include '../includes/footer.php'; ?>

    <!-- Ventana modal -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div id="modal-body">
                <!-- Aquí se mostrarán los archivos de la carpeta -->
            </div>
        </div>
    </div>
    <?php include '../includes/footer.php'; ?>
    <script src="../js/navbar.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/clientes.js"></script>
    <script src="../js/search.js"></script>
</body>
</html>
