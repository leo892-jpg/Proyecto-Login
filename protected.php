<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

// Verificar que el usuario esté logueado
requireLogin();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Protegida - Sistema de Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="navbar-content">
            <a href="index.php" class="navbar-brand">Sistema Login</a>
            <div class="navbar-nav">
                <span style="color: white;">Hola, <?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                <a href="dashboard.php">Dashboard</a>
                <a href="logout.php">Cerrar Sesión</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1>Página Protegida</h1>
        
        <div class="user-info">
            <h2>¡Acceso Restringido!</h2>
            <p>Esta página solo es accesible para usuarios autenticados.</p>
            <p>Has accedido correctamente como: <strong><?php echo htmlspecialchars($_SESSION['user_name']); ?></strong></p>
            <p>Tu correo electrónico es: <strong><?php echo htmlspecialchars($_SESSION['user_email']); ?></strong></p>
        </div>
        
        <div class="links">
            <a href="dashboard.php" class="btn">Volver al Dashboard</a>
            <a href="index.php" class="btn" style="margin-top: 10px; background: #6c757d;">Volver al Inicio</a>
        </div>
    </div>
</body>
</html>