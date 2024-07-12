<?php
   $success_message = "";
   $error_message = "";

include 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $nombre = $_POST['nombre'];
    $email = isset ($_POST['email']) ? $_POST['email'] : NULL;
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $rol = 'cliente';

    $sql = "INSERT INTO usuarios (username, password, rol) VALUES ('$username', '$hashed_password', 'cliente')";
    if ($conn->query($sql) === TRUE) {
        $usuario_id = $conn->insert_id;
        $sql_cliente = "INSERT INTO clientes (nombre, email, telefono, direccion) VALUES ('$nombre', '$email', '$telefono', '$direccion')";
        if ($conn->query($sql_cliente) === TRUE) {
             $success_message = "¡Registro exitoso! Por favor, inicia sesión.";
        } else {
            $error_message = "Error al registrar usuario: " . $conn->error;
        }
    } else {
         $error_message ="Error: " . $sql . "<br>" . $conn->error;
    }
}
 

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Cliente</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/topbar.css">
</head>
<body>
<div class="top-bar">
        <h1>EcuadorProtege</h1>
    </div> 
    <div class="register-container register-client">
        <h2>Registro de Cliente</h2>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="username">*Usuario:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">*Contraseña:</label>
            <input type="password" id="password" name="password" required>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono">
            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion">
           
            <button type="submit">Registrarse</button>
        </form>
        <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>
    </div>

    <?php if ($success_message || $error_message): ?>
        <div id="modal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <p><?php echo $success_message ?: $error_message; ?></p>
            </div>
        </div>
    <?php endif; ?>

    <script src="js/scripts.js"></script>
</body>
</html>
