<?php
include 'includes/db.php';

$username = 'testuser';
$password = 'testpassword';
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$rol = 'usuario';

$sql = "INSERT INTO usuarios (username, password, rol) VALUES ('$username', '$hashed_password', '$rol')";
if ($conn->query($sql) === TRUE) {
    echo "Nuevo usuario creado exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
