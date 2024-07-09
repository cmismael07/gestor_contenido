<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Incluir el archivo de conexión a la base de datos
    include 'includes/db.php';

    // Recoger y escapar los datos del formulario
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Hash de la contraseña
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Preparar la consulta SQL
    $sql = "INSERT INTO usuarios (username, password) VALUES ('$username', '$hashed_password')";

    // Ejecutar la consulta y verificar el resultado
    if ($conn->query($sql) === TRUE) {
        $_SESSION['success_message'] = "¡Registro exitoso! Por favor, inicia sesión.";
        header("Location: login.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Error al registrar usuario: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <h2>Registro de Usuario</h2>

    <?php
    if (isset($_SESSION['error_message'])) {
        echo '<p class="error">' . $_SESSION['error_message'] . '</p>';
        unset($_SESSION['error_message']);
    }
    ?>

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="username">Usuario:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Registrarse</button>
    </form>

    <p><a href="login.php">Inicia sesión aquí</a></p>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
