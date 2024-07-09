<?php
include 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $rol = 'cliente';

    $sql = "INSERT INTO usuarios (username, password, rol) VALUES ('$username', '$hashed_password', '$rol')";
    if ($conn->query($sql) === TRUE) {
        $usuario_id = $conn->insert_id;
        $sql_cliente = "INSERT INTO clientes (nombre, email, telefono, direccion) VALUES ('$nombre', '$email', '$telefono', '$direccion')";
        if ($conn->query($sql_cliente) === TRUE) {
            echo "Nuevo cliente creado exitosamente";
        } else {
            echo "Error: " . $sql_cliente . "<br>" . $conn->error;
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Cliente</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <form method="POST" action="register_cliente.php">
        <h2>Registro de Cliente</h2>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono">
        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion">
        <button type="submit">Registrar</button>
        <p style="text-align:center;"><a href="login.php"> Inicia sesión aquí</a></p>
    </form>
</body>
</html>
