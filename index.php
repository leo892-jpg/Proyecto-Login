<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Bienvenido al Sistema de Login</h1>
        
        <?php if (isLoggedIn()): ?>
            <div class="user-info">
                <h2>¡Hola, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h2>
                <p>Has iniciado sesión correctamente.</p>
            </div>
            <div class="links">
                <a href="dashboard.php" class="btn">Ir al Dashboard</a>
                <a href="protected.php" class="btn" style="margin-top: 10px; background: #28a745;">Página Protegida</a>
                <a href="logout.php" class="btn" style="margin-top: 10px; background: #dc3545;">Cerrar Sesión</a>
            </div>
        <?php else: ?>
            <div class="links">
                <p>Por favor inicia sesión o regístrate para acceder al sistema.</p>
                <a href="login.php" class="btn">Iniciar Sesión</a>
                <a href="register.php" class="a" style="margin-top: 10px; background: #6c757d;">Registrarse</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>