<?php
function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

function redirect($url) {
    header("Location: $url");
    exit();
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        redirect('login.php');
    }
}

function displayMessage($message, $type = 'info') {
    if (!empty($message)) {
        $class = $type == 'error' ? 'alert-danger' : ($type == 'success' ? 'alert-success' : 'alert-info');
        return "<div class='alert $class'>$message</div>";
    }
    return '';
}
?>