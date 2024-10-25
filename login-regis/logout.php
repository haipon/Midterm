<?php
session_start(); // Start or resume the session

// 1. Unset all session variables
$_SESSION = array();

// 2. If there is a session cookie, remove it
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, 
        $params["path"], 
        $params["domain"], 
        $params["secure"], 
        $params["httponly"]
    );
}

// 3. Destroy the session
session_destroy();

// 4. Redirect the user to the login page or home page after logging out
header("Location: /login-regis/login.php");
exit();
?>

