<?php
session_start();
include 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['rol'] = $user['rol'];
            if ($user['rol'] == 'cliente') {
                $_SESSION['cliente_id'] = $user['id'];
                header("Location: views/dashboard_cliente.php");
            } else {
                header("Location: views/dashboard.php");
            }
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No user found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <form method="POST" action="login.php">
        <h2>Bienvenidos</h2>
        <label for="username">Usuario:</label>
        <input type="text" id="username" name="username" placeholder="Ingrese su numbre de usuario"required>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" placeholder="Escriba su contraseña" required>
        <button type="submit">Acceder</button>
        <p>Registrarme como: <a href="register.php">Usuario</a> | <a href="register_cliente.php">Cliente</a></p>
        <?php if (isset($error)) echo "<p>$error</p>"; ?>
    </form>
</body>
</html>
