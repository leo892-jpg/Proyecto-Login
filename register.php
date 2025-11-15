<?php
require_once 'includes/config.php';
require_once 'includes/auth.php';

$auth = new Auth($pdo);
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = sanitizeInput($_POST['nombre']);
    $correo = sanitizeInput($_POST['correo']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    if ($password !== $confirm_password) {
        $message = "Las contraseñas no coinciden.";
    } else {
        $result = $auth->register($nombre, $correo, $password);
        if (strpos($result, 'success:') === 0) {
            $message = "success:" . substr($result, 8);
            $_POST = array(); // Limpiar formulario
        } else {
            $message = $result;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Sistema de Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Registro de Usuario</h1>
        
        <?php 
        if (!empty($message)) {
            $type = strpos($message, 'success:') === 0 ? 'success' : 'error';
            $msg = $type == 'success' ? substr($message, 8) : $message;
            echo displayMessage($msg, $type);
        }
        ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $_POST['nombre'] ?? ''; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="correo">Correo Electrónico:</label>
                <input type="email" id="correo" name="correo" value="<?php echo $_POST['correo'] ?? ''; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required minlength="6">
            </div>
            
            <div class="form-group">
                <label for="confirm_password">Confirmar Contraseña:</label>
                <input type="password" id="confirm_password" name="confirm_password" required minlength="6">
            </div>
            
            <button type="submit" class="btn">Registrarse</button>
        </form>
        
        <div class="links">
            <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a></p>
            <a href="index.php">Volver al Inicio</a>
        </div>
    </div>
</body>
</html>