<?php
session_start(); // Start the session

// Unset all of the session variables
$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will remove the session from the user's browser.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finally, destroy the session.
session_destroy();

// Redirect to the login page or home page
setcookie('logged_in', 'true', time() + 3600);
    echo "Logout successful!";
echo "<script>setTimeout(function(){ window.location.href = 'Main.php'; }, 2000);</script>";
exit();
?>