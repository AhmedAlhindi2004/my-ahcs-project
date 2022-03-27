<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
//Establishing database connection
$server_name = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "participants";

$conn = mysqli_connect($server_name, $db_username, $db_password, $db_name);

if (!$conn) {
    die("Connection to database failed!");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql_delete_participant = "DELETE FROM `participant` WHERE `email` = '".$_SESSION["email"]."'";
    $deleted_participant = mysqli_query($conn, $sql_delete_participant);
    if (session_status() === PHP_SESSION_ACTIVE) {
        session_destroy();
        echo '<script type="text/javascript">alert("Account deleted successfully")</script>';
        header("Location: ../index.php");
    }
    
}
mysqli_close($conn);
?>