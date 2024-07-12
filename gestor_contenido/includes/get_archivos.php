<?php
include 'db.php';

if (isset($_POST['carpeta_id'])) {
    $carpeta_id = $_POST['carpeta_id'];
    $sql_archivos = "SELECT * FROM archivos WHERE carpeta_id='$carpeta_id'";
    $result_archivos = $conn->query($sql_archivos);
    
    if ($result_archivos && $result_archivos->num_rows > 0) {
        while ($archivo = $result_archivos->fetch_assoc()) {
            echo '<p>' . $archivo['nombre'] . ' (' . $archivo['tipo'] . ')</p>';
        }
    } else {
        echo '<p>No hay archivos en esta carpeta.</p>';
    }
} else {
    echo '<p>Error: No se proporcionó el ID de la carpeta.</p>';
}
?>
