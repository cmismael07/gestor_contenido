<?php
session_start();
include '../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['cliente_id'])) {
    $carpeta_id = $_POST['carpeta_id'];
    $nombre = $_FILES['archivo']['name'];
    $tipo = $_FILES['archivo']['type'];
    $tmp_name = $_FILES['archivo']['tmp_name'];

    $carpeta_destino = "../uploads/$carpeta_id/";
    if (!is_dir($carpeta_destino)) {
        mkdir($carpeta_destino, 0777, true);
    }

    $ruta_destino = $carpeta_destino . basename($nombre);
    if (move_uploaded_file($tmp_name, $ruta_destino)) {
        $sql = "INSERT INTO archivos (nombre, tipo, ruta, carpeta_id) VALUES ('$nombre', '$tipo', '$ruta_destino', '$carpeta_id')";
        if ($conn->query($sql) === TRUE) {
            header("Location: dashboard_cliente.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error al subir el archivo.";
    }
}
?>
