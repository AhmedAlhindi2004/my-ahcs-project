<?php
function trimInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function is_registered($value) {
    $sql_check_radio_button = "SELECT `groupLaneCode` FROM `participant` WHERE `groupLaneCode` = '$value'";
    $conn = mysqli_connect("localhost", "root", "", "participants");
    if (mysqli_num_rows(mysqli_query($conn, $sql_check_radio_button)) >= 1) {
        echo "disabled";
    }
    mysqli_close($conn);
}

function countParticipants() {
    $sql_count_participants = "SELECT `groupLaneCode` FROM `participant`";
    $conn = mysqli_connect("localhost", "root", "", "participants");
    $rows = mysqli_query($conn, $sql_count_participants);
    echo (50 - mysqli_num_rows($rows));
    mysqli_close($conn);
}

$races = array("1/6/2022 – 7:00am – Mont Blanc, 50 Rue Des Alps, 99999, Annecy, France",
                "8/6/2022 – 8:00am – Mont Blanc, 51 Rue Des Alps, 99999, Annecy, France",
                "15/6/2022 – 9:00am – Mont Blanc, 52 Rue Des Alps, 99999, Annecy, France",
                "22/6/2022 – 10:00am – Mont Blanc, 53 Rue Des Alps, 99999, Annecy, France",
                "29/6/2022 – 11:00am – Mont Blanc, 54 Rue Des Alps, 99999, Annecy, France");

$registered = [];


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
    $first_name = trimInput($_POST["first_name"]);
    $last_name = trimInput($_POST["last_name"]);
    $date_of_birth = trimInput($_POST["date_of_birth"]);
    $mobile_number = trimInput($_POST["mobile_number"]);

    //Check if email already exists
    $sql_check_email_exists = "SELECT `email` FROM `participant` WHERE `email` = '".$_POST["email"]."'";
    if (mysqli_num_rows(mysqli_query($conn, $sql_check_email_exists))) {
        header('location: ../index.php');
        echo '<script type="text/javascript">alert("This email address has already been taken!");</script>';
    } else {
        $email = trimInput($_POST["email"]);    
        
        //Confirming passwords
        $password = trimInput($_POST["password"]);
        $password_confirmed = trimInput($_POST["password_confirmed"]);
        if ($password != $password_confirmed) {
            header('location: ../index.php');
            echo '<script type="text/javascript">alert("Passwords must match!");</script>';
        } else {
            $group_lane_code = trimInput($_POST["group_lane_code"]);
            if (isset($group_lane_code)) {
                array_push($registered, $group_lane_code);
            }//check this part, it shouldn't exist?

            //Setting up group code (A, B, C, D, or E)
            $group = $group_lane_code[0]; //First character of group-lane code

            $postcode = trimInput($_POST["postcode"]);
            $city = trimInput($_POST["city"]);
            $country = trimInput($_POST["country"]);

            //Setting up race details based on the group code
            if ($group === "A") {
                $race_details = $races[0];
            } elseif ($group === "B") {
                $race_details = $races[1];
            } elseif ($group === "C") {
                $race_details = $races[2];
            } elseif ($group === "D") {
                $race_details = $races[3];
            } elseif ($group === "E") {
                $race_details = $races[4];
            }
            $sql_insert_into_db = "INSERT INTO `participant` (`groupLaneCode`, `firstName`, `surName`, `dateOfBirth`, `mobileNo`, `email`, `password`, `postcode`, `city`, `country`, `group`, `raceDetails`) VALUES ('$group_lane_code', '$first_name', '$last_name', '$date_of_birth', '$mobile_number', '$email', '$password', '$postcode', '$city', '$country', '$group', '$race_details')";
            
            if (mysqli_query($conn, $sql_insert_into_db)) {
                header('location: ../index.php');
                echo '<script type="text/javascript">alert("Successfully registered! You can now log in!")</script>';
            } else {
                header('location: ../index.php');
                echo '<script type="text/javascript">alert("Error submitting form, please try again...");</script>';
            }
        }
    }
}
mysqli_close($conn);
?>