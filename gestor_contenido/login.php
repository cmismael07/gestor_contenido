<?php
session_start();
$error_message = "";
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
            $error_message = "Contraseña incorrecta.";
        }
    } else {
        $error_message ="No se encontró el usuario.";
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
    <link rel="stylesheet" href="css/topbar.css">
</head>
<body>
<div class="top-bar">
        <h1>EcuadorProtege</h1>
    </div>  

   <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="username">Usuario:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Iniciar Sesión</button>
        </form>
        <p>Registrarme como: <a href="register.php">Usuario</a> | <a href="register_cliente.php">Cliente </a></p>
    </div>
    <?php if ($error_message): ?>
        <div id="modal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <p><?php echo $error_message; ?></p>
            </div>
        </div>
    <?php endif; ?>
    <script src="js/scripts.js"></script>

</body>
</html>
