<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (session_status() === PHP_SESSION_ACTIVE) {
        session_destroy();
        echo '<script type="text/javascript">alert("User successfully logged out!");</script>';
        header("Location: ../index.php");
    }
}
?>