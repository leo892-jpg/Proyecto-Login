<?php
require_once 'config.php';
require_once 'functions.php';

class Auth {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    public function register($nombre, $correo, $password) {
        // Validaciones básicas
        if (empty($nombre) || empty($correo) || empty($password)) {
            return "Todos los campos son obligatorios.";
        }
        
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            return "El formato del correo no es válido.";
        }
        
        if (strlen($password) < 6) {
            return "La contraseña debe tener al menos 6 caracteres.";
        }
        
        // Verificar si el correo ya existe
        $stmt = $this->pdo->prepare("SELECT id FROM usuarios WHERE correo = ?");
        $stmt->execute([$correo]);
        
        if ($stmt->rowCount() > 0) {
            return "Este correo ya está registrado.";
        }
        
        // Hash de la contraseña
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        
        // Insertar usuario
        $stmt = $this->pdo->prepare("INSERT INTO usuarios (nombre, correo, password) VALUES (?, ?, ?)");
        
        if ($stmt->execute([$nombre, $correo, $passwordHash])) {
            return "success:Registro exitoso. Ahora puedes iniciar sesión.";
        } else {
            return "Error en el registro. Intenta nuevamente.";
        }
    }
    
    public function login($correo, $password) {
        if (empty($correo) || empty($password)) {
            return "Todos los campos son obligatorios.";
        }
        
        $stmt = $this->pdo->prepare("SELECT id, nombre, password FROM usuarios WHERE correo = ?");
        $stmt->execute([$correo]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['nombre'];
            $_SESSION['user_email'] = $correo;
            return "success:Inicio de sesión exitoso.";
        } else {
            return "Credenciales incorrectas.";
        }
    }
    
    public function logout() {
        session_destroy();
        redirect('index.php');
    }
    
    public function getUser($id) {
        $stmt = $this->pdo->prepare("SELECT id, nombre, correo, fecha_registro FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}
?>