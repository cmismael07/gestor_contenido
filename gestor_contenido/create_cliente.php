<?php
include 'includes/db.php';

$nombre = 'Cliente Prueba';
$email = 'cliente@ejemplo.com';
$telefono = '123456789';
$direccion = 'Calle Ejemplo 123';

$sql = "INSERT INTO clientes (nombre, email, telefono, direccion) VALUES ('$nombre', '$email', '$telefono', '$direccion')";
if ($conn->query($sql) === TRUE) {
    echo "Nuevo cliente creado exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
