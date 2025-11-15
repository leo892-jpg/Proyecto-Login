<?php
require_once 'includes/config.php';
require_once 'includes/auth.php';

// Si ya está logueado, redirigir al dashboard
if (isLoggedIn()) {
    redirect('dashboard.php');
}

$auth = new Auth($pdo);
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = sanitizeInput($_POST['correo']);
    $password = $_POST['password'];
    
    $result = $auth->login($correo, $password);
    
    if (strpos($result, 'success:') === 0) {
        redirect('dashboard.php');
    } else {
        $message = $result;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Iniciar Sesión</h1>
        
        <?php 
        if (!empty($message)) {
            echo displayMessage($message, 'error');
        }
        ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="correo">Correo Electrónico:</label>
                <input type="email" id="correo" name="correo" value="<?php echo $_POST['correo'] ?? ''; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit" class="btn">Iniciar Sesión</button>
        </form>
        
        <div class="links">
            <p>¿No tienes una cuenta? <a href="register.php">Regístrate aquí</a></p>
            <a href="index.php">Volver al Inicio</a>
        </div>
    </div>
</body>
</html>