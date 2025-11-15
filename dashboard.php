<?php
require_once 'includes/config.php';
require_once 'includes/auth.php';
require_once 'includes/functions.php';

// Verificar que el usuario esté logueado
requireLogin();

$auth = new Auth($pdo);
$user = $auth->getUser($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistema de Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="navbar-content">
            <a href="index.php" class="navbar-brand">Sistema Login</a>
            <div class="navbar-nav">
                <span style="color: white;">Hola, <?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                <a href="protected.php">Página Protegida</a>
                <a href="logout.php">Cerrar Sesión</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1>Dashboard</h1>
        
        <div class="user-info">
            <h2>Información del Usuario</h2>
            <p><strong>ID:</strong> <?php echo $user['id']; ?></p>
            <p><strong>Nombre:</strong> <?php echo htmlspecialchars($user['nombre']); ?></p>
            <p><strong>Correo:</strong> <?php echo htmlspecialchars($user['correo']); ?></p>
            <p><strong>Fecha de Registro:</strong> <?php echo date('d/m/Y H:i', strtotime($user['fecha_registro'])); ?></p>
        </div>
        
        <div class="links">
            <a href="protected.php" class="btn">Ir a Página Protegida</a>
            <a href="index.php" class="btn" style="margin-top: 10px; background: #6c757d;">Volver al Inicio</a>
        </div>
    </div>
</body>
</html>