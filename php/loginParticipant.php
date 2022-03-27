<?php

require_once "registerParticipant.php";

//Establishing database connection
$server_name = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "participants";

$conn = mysqli_connect($server_name, $db_username, $db_password, $db_name);

if (!$conn) {
    die("Connection to database failed!");
}

function displayOpponents($opponent_group) {
    $sql_display_opponents = "SELECT `firstName`, `surName`, `country` FROM `participant` WHERE `group` = '$opponent_group'";
    $conn = mysqli_connect("localhost", "root", "", "participants");        $registered_opponents = mysqli_query($conn, $sql_display_opponents);
    if (mysqli_num_rows($registered_opponents) > 0) {
        foreach ($registered_opponents as $opponent) {
            echo "          <tr>";
            echo "              <td>".$opponent["firstName"]." ".$opponent["surName"]."</td>";
            echo "              <td>".$opponent["country"]."</td>";
            echo "          </tr>";
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();

        $email = trimInput($_POST["email"]);
        $password = trimInput($_POST["password"]);

        $sql_check_credentials = "SELECT * FROM `participant` WHERE `email` = '$email'";
        $users = mysqli_query($conn, $sql_check_credentials);
        if (mysqli_num_rows($users) > 0) {
            while ($user = mysqli_fetch_array($users)) {
                //Check credentials
                if ($email == $user["email"] && $password == $user["password"]) {
                    $_SESSION["email"] = $user["email"];    
                    $_SESSION["password"] = $user["password"];

                    //Other details
                    $_SESSION["group_lane_code"] = $user["groupLaneCode"];
                    $_SESSION["first_name"] = $user["firstName"];
                    $_SESSION["last_name"] = $user["surName"];
                    $_SESSION["country"] = $user["country"];
                    $_SESSION["race_details"] = $user["raceDetails"];
                    $_SESSION["group"] = $user["group"];
                    echo '<script type="text/javascript">alert("User successfully logged in!");</script>';
                }
            }
        } else {
            session_destroy();
            echo '<script type="text/javascript">alert("Wrong email/password or user does not exist!")</script>';
        }
    }
}
mysqli_close($conn);
?>