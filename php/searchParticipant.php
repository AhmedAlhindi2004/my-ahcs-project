<?php

$hide_other_participants = false;

function displayParticipants() {
    $sql_display_participants = "SELECT `firstName`, `surName`, `country` FROM `participant`";
    $conn = mysqli_connect("localhost", "root", "", "participants");
    $registered_participants = mysqli_query($conn, $sql_display_participants);

    if (mysqli_num_rows($registered_participants) > 0) {
        foreach ($registered_participants as $participant) {
            echo "          <tr>";
            echo "              <td>".$participant["firstName"]." ".$participant["surName"]."</td>";
            echo "              <td>".$participant["country"]."</td>";
            echo "          </tr>";
        }
    }
}
?>