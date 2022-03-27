<!--
    Name: Ahmed Alhindi
    Class: 6C
    School: Hillhead High School
    Scottish Candidate Number: 201425298
    Project: a screen-width responsive, fully functional, and aesthetically pleasing website for a snowboarding club's competition (the Eagles).
-->
<?php 
//Start session if not active
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require_once "php/registerParticipant.php";
require_once "php/searchParticipant.php";
require_once "php/loginParticipant.php";
require_once "php/logoutParticipant.php";
require_once "php/unregisterParticipant.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Homepage</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/mystylesheet12.css">
        <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🎿</text></svg>">
    </head>
    <body>
        <main>
            <header>
                <nav>
                    <a id="logoContainer" href="index.php">
                        <img src="media/png/img2.png" alt="our logo" id="logo">
                    </a>
                    <div id="hamburger">
                        <div class="line"></div>
                        <div class="line"></div>
                        <div class="line"></div>
                    </div>

                    <ul class="navLinks">
                        <li><a class="links" href="#home">Homepage</a></li>
                        <li><a class="links" href="#competition">Competition</a></li>
                        <li><a class="links" href="#prizes">Prizes</a></li>
                        <li><a class="links" href="#competitors">Competitors</a></li>
                        <li><a class="links" href="#aboutUs">About us</a></li>
                        <li <?php if (isset($_SESSION["email"])) {echo 'style="display: none;"';} ?>><a  class="links" href="#login" id="loginButton">Log in</a></li>
                        <li><a href="#race"  class="hiddenForPHP links" <?php if (isset($_SESSION["email"])) {echo 'style="display: inline;"';} ?>>Race</a></li>
                        <li><a href="#opponents" class="hiddenForPHP links" <?php if (isset($_SESSION["email"])) {echo 'style="display: inline;"';} ?>>Opponents</a></li>
                        <li><a href="#unregister" class="hiddenForPHP links" <?php if (isset($_SESSION["email"])) {echo 'style="display: inline;"';} ?>>Unregister</a></li> 
                        <li>
                            <form action="php/logoutParticipant.php" method="POST">
                                <input type="submit" value="Log out" class="hiddenForPHP links" id="logoutButton" <?php if (isset($_SESSION["email"])) {echo 'style="display: inline;"';} else {echo 'style="display: none;"';} ?>>
                            </form>
                        </li>
                    </ul>
                </nav>
            </header>
            <section class="sectionScroller">
                <section id="home">
                    <h1 class="bigText">50 participants.
                    </h1>
                    <h1 class="bigText">10 finalists.
                    </h1>
                    <h1 class="bigText">1 master.
                    </h1>
                    <div id="buttonsContainer">
                        <a href="#competition" class="button" id="seeMore">
                            <p>See more</p>
                        </a>
                        <a <?php if (isset($_SESSION["email"])) {echo 'style="display: none;"';} ?> href="#joinUs" class="button" id="signUp">
                            <p>Join us</p>
                        </a>
                    </div>
                </section>

                <section id="competition">
                    <h1>Competition</h1>
                    <div class="pContainer">
                        <p>50 participants gather every year from across the globe to race for glory in the Alps. A one-hour race to determine who is the best snowboarder in in the world. The 50 participants will be divided into 5 groups (A-E). Each participant will race in one of our ten lanes. The first two to cross the line will take part in our upcoming final race...</p>
                        
                        <p>Our competition is not for the faint-hearted. At below-zero temperatures, with blurred vision and shivering bones, only the fearless will make it to the line before anyone else, and will guarantee a chance for becoming the snowboarding master of the Alps. May the best snowboarder in the world win!</p>
                        
                        <p>Your safety, wellbeing and health are of the utmost importance to us and every aspect of the competition has been designed with you in mind. However, in the unlikely event of an injury, our first-aid team is always ready to intervene.</p>
                    </div>
                </section>

                <section id="prizes">
                    <h1>Prizes</h1>

                    <table>
                        <th>Place</th>
                        <th>Prize</th>
                        <tr>
                            <td>1st</td>
                            <td>£10,000</td>
                        </tr>
                        <tr>
                            <td>2nd</td>
                            <td>£5,000</td>
                        </tr>
                        <tr>
                            <td>3rd</td>
                            <td>£2,500</td>
                        </tr>
                        <tr>
                            <td>4th – 10th</td>
                            <td>£500</td>
                        </tr>
                    </table>
                </section>

                <section id="competitors">
                    <h1>Competitors</h1>

                    <p>Here are the registered participants so far. Don’t waste your chance to become one of them!</p>
                    <p>The number of available places is <b><?php echo countParticipants() ?></b>.</p>

                    <form action="" method="GET">
                        <input type="text" placeholder="Enter first name here" maxlength="50" name="search" value="<?php if (isset($_GET["search"])) {echo $_GET["search"];} ?>" id="inputField">
                        <input type="submit" value="Search participants" id="submitButton">
                    </form>
                    
                    <div id="tableContainer">
                        <table>
                            <th>Name</th>
                            <th>Country</th>
                            <?php
                            if (isset($_GET["search"])) {
                                global $hide_other_participants;
                                $hide_other_participants = true;
                                $search = $_GET["search"];
                                $sql_find_participant = "SELECT `firstName`, `surName`, `country` FROM `participant` WHERE `firstName` LIKE '$search'";
                                $targets = mysqli_query($conn, $sql_find_participant);
                                if (mysqli_num_rows($targets) > 0) {
                                    while ($target = mysqli_fetch_array($targets)) {
                                        echo '  <tr>';
                                        echo "      <td>".$target["firstName"]." ".$target["surName"]."</td>";
                                        echo "      <td>".$target["country"]."</td>";
                                        echo "   </tr>";
                                    }
                                }
                            }
                            ?>
                            <?php
                            if ($hide_other_participants) {
                                echo "<!--";
                            }
                            ?>
                            <?php
                            displayParticipants();
                            ?>
                            <?php
                            if ($hide_other_participants) {
                                echo "-->";
                            }
                            ?>
                        </table>
                    </div>
                </section>

                <section id="aboutUs">
                    <h1>About us</h1>
                    <div class="textContainer">
                        <p>Our club was founded in 2000, and ever since we have become among the top snowboarding clubs in the world. The best snowboarders gather every year to race in our track in the Alps. A lot of our participants go on to become Winter Olympics finalists, if not medalists.</p>
                        
                        <p>We started with five lanes in 2000, upgraded to 7 lanes in 2005 and to 10 lanes in 2010. We’re planning to double the number of our lanes by 2025, celebrating an outstanding, decades-long journey with snowboarding lovers and professionals in the world.</p>
                    </div>
                    <div class="textContainer">
                        <p>Over the past 21 years, our club has been awarded multiple national and international prizes, recognising our commitment to fostering an inclusive, welcoming environment for every one interested in this magnificent sport.</p>

                        <p>Wanna join our annual competition? Registration is still open, and we invite all professionals to sign up as soon as possible since we expect all places to fill up very quickly. We particularly welcome applications from BAME participants as they have been under-represented in our annual competitions over the past few years. </p>
                    </div>
                </section>

                <section id="joinUs" <?php if (isset($_SESSION["email"])) {echo 'style="display: none;"';} ?>>
                    <h1>Join us!</h1>
                    <form id="desktopRegisterForm" method="POST" action="php/registerParticipant.php">
                        <div class="formColumns">
                            <label>FIRST NAME:</label>
                            <input name="first_name" type="text" maxlength="20" placeholder="Enter first name here" required>
                            <label>SURNAME:</label>
                            <input name="last_name" type="text" maxlength="20" placeholder="Enter surname here" required>
                            <label>DATE OF BIRTH:</label>
                            <input name="date_of_birth" type="date" min= "1998-01-01" max="2004-12-31" placeholder="Enter date of birth here" required>
                            <label>MOBILE NUMBER:</label>
                            <input name="mobile_number" type="tel" minlength="11" maxlength="11" placeholder="Enter mobile number here" required>
                            <label>EMAIL:</label>
                            <input name="email" type="email" maxlength="50" placeholder="Enter email here" required>
                        </div>
                        <div class="formColumns">
                            <label>PASSWORD:</label>
                            <input name="password" type="password" minlength="8" placeholder="Enter password here" required>
                            <label>CONFIRM PASSWORD:</label>
                            <input name="password_confirmed" type="password" minlength="8" placeholder="Confirm password here" required>
                            <div id="radioButtonsContainer">
                                <label id="radioColumnTag">GROUP-LANE CODE:</label>
                                <div class="radioColumns">
                                    <input type="radio" id="A1" name="group_lane_code" value="A1" <?php is_registered("A1"); ?>>
                                    <label for="A1">A1</label><br>
                                    <input type="radio" id="A2" name="group_lane_code" value="A2" <?php is_registered("A2"); ?>>
                                    <label for="A2">A2</label><br>
                                    <input type="radio" id="A3" name="group_lane_code" value="A3" <?php is_registered("A3"); ?>>
                                    <label for="A3">A3</label><br>
                                    <input type="radio" id="A4" name="group_lane_code" value="A4" <?php is_registered("A4"); ?>>
                                    <label for="A4">A4</label><br>
                                    <input type="radio" id="A5" name="group_lane_code" value="A5" <?php is_registered("A5"); ?>>
                                    <label for="A5">A5</label><br>
                                    <input type="radio" id="A6" name="group_lane_code" value="A6" <?php is_registered("A6"); ?>>
                                    <label for="A6">A6</label><br>
                                    <input type="radio" id="A7" name="group_lane_code" value="A7" <?php is_registered("A7"); ?>>
                                    <label for="A7">A7</label><br>
                                    <input type="radio" id="A8" name="group_lane_code" value="A8" <?php is_registered("A8"); ?>>
                                    <label for="A8">A8</label><br>
                                    <input type="radio" id="A9" name="group_lane_code" value="A9" <?php is_registered("A9"); ?>>
                                    <label for="A9">A9</label><br>
                                    <input type="radio" id="A10" name="group_lane_code" value="A10" <?php is_registered("A10"); ?>>
                                    <label for="A10">A10</label>
                                </div>
                                <div class="radioColumns">
                                    <input type="radio" id="B1" name="group_lane_code" value="B1" <?php is_registered("B1"); ?>>
                                    <label for="B1">B1</label><br>
                                    <input type="radio" id="B2" name="group_lane_code" value="B2" <?php is_registered("B2"); ?>>
                                    <label for="B2">B2</label><br>
                                    <input type="radio" id="B3" name="group_lane_code" value="B3" <?php is_registered("B3"); ?>>
                                    <label for="B3">B3</label><br>
                                    <input type="radio" id="B4" name="group_lane_code" value="B4" <?php is_registered("B4"); ?>>
                                    <label for="B4">B4</label><br>
                                    <input type="radio" id="B5" name="group_lane_code" value="B5" <?php is_registered("B5"); ?>>
                                    <label for="B5">B5</label><br>
                                    <input type="radio" id="B6" name="group_lane_code" value="B6" <?php is_registered("B6"); ?>>
                                    <label for="B6">B6</label><br>
                                    <input type="radio" id="B7" name="group_lane_code" value="B7" <?php is_registered("B7"); ?>>
                                    <label for="B7">B7</label><br>
                                    <input type="radio" id="B8" name="group_lane_code" value="B8" <?php is_registered("B8"); ?>>
                                    <label for="B8">B8</label><br>
                                    <input type="radio" id="B9" name="group_lane_code" value="B9" <?php is_registered("B9"); ?>>
                                    <label for="B9">B9</label><br>
                                    <input type="radio" id="B10" name="group_lane_code" value="B10" <?php is_registered("B10"); ?>>
                                    <label for="B10">B10</label>
                                </div>
                                <div class="radioColumns">
                                    <input type="radio" id="C1" name="group_lane_code" value="C1" <?php is_registered("C1"); ?>>
                                    <label for="C1">C1</label><br>
                                    <input type="radio" id="C2" name="group_lane_code" value="C2" <?php is_registered("C2"); ?>>
                                    <label for="C2">C2</label><br>
                                    <input type="radio" id="C3" name="group_lane_code" value="C3" <?php is_registered("C3"); ?>>
                                    <label for="C3">C3</label><br>
                                    <input type="radio" id="C4" name="group_lane_code" value="C4" <?php is_registered("C4"); ?>>
                                    <label for="C4">C4</label><br>
                                    <input type="radio" id="C5" name="group_lane_code" value="C5" <?php is_registered("C5"); ?>>
                                    <label for="C5">C5</label><br>
                                    <input type="radio" id="C6" name="group_lane_code" value="C6" <?php is_registered("C6"); ?>>
                                    <label for="C6">C6</label><br>
                                    <input type="radio" id="C7" name="group_lane_code" value="C7" <?php is_registered("C7"); ?>>
                                    <label for="C7">C7</label><br>
                                    <input type="radio" id="C8" name="group_lane_code" value="C8" <?php is_registered("C8"); ?>>
                                    <label for="C8">C8</label><br>
                                    <input type="radio" id="C9" name="group_lane_code" value="C9" <?php is_registered("C9"); ?>>
                                    <label for="C9">C9</label><br>
                                    <input type="radio" id="C10" name="group_lane_code" value="C10" <?php is_registered("C10"); ?>>
                                    <label for="C10">C10</label>
                                </div>
                                <div class="radioColumns">
                                    <input type="radio" id="D1" name="group_lane_code" value="D1" <?php is_registered("D1"); ?>>
                                    <label for="D1">D1</label><br>
                                    <input type="radio" id="D2" name="group_lane_code" value="D2" <?php is_registered("D2"); ?>>
                                    <label for="D2">D2</label><br>
                                    <input type="radio" id="D3" name="group_lane_code" value="D3" <?php is_registered("D3"); ?>>
                                    <label for="D3">D3</label><br>
                                    <input type="radio" id="D4" name="group_lane_code" value="D4" <?php is_registered("D4"); ?>>
                                    <label for="D4">D4</label><br>
                                    <input type="radio" id="D5" name="group_lane_code" value="D5" <?php is_registered("D5"); ?>>
                                    <label for="D5">D5</label><br>
                                    <input type="radio" id="D6" name="group_lane_code" value="D6" <?php is_registered("D6"); ?>>
                                    <label for="D6">D6</label><br>
                                    <input type="radio" id="D7" name="group_lane_code" value="D7" <?php is_registered("D7"); ?>>
                                    <label for="D7">D7</label><br>
                                    <input type="radio" id="D8" name="group_lane_code" value="D8" <?php is_registered("D8"); ?>>
                                    <label for="D8">D8</label><br>
                                    <input type="radio" id="D9" name="group_lane_code" value="D9" <?php is_registered("D9"); ?>>
                                    <label for="D9">D9</label><br>
                                    <input type="radio" id="D10" name="group_lane_code" value="D10" <?php is_registered("D10"); ?>>
                                    <label for="D10">D10</label>
                                </div>
                                <div class="radioColumns">
                                <input type="radio" id="E1" name="group_lane_code" value="E1" <?php is_registered("E1"); ?>>
                                <label for="E1">E1</label><br>
                                <input type="radio" id="E2" name="group_lane_code" value="E2" <?php is_registered("E2"); ?>>
                                <label for="E2">E2</label><br>
                                <input type="radio" id="E3" name="group_lane_code" value="E3" <?php is_registered("E3"); ?>>
                                <label for="E3">E3</label><br>
                                <input type="radio" id="E4" name="group_lane_code" value="E4" <?php is_registered("E4"); ?>>
                                <label for="E4">E4</label><br>
                                <input type="radio" id="E5" name="group_lane_code" value="E5" <?php is_registered("E5"); ?>>
                                <label for="E5">E5</label><br>
                                <input type="radio" id="E6" name="group_lane_code" value="E6" <?php is_registered("E6"); ?>>
                                <label for="E6">E6</label><br>
                                <input type="radio" id="E7" name="group_lane_code" value="E7" <?php is_registered("E7"); ?>>
                                <label for="E7">E7</label><br>
                                <input type="radio" id="E8" name="group_lane_code" value="E8" <?php is_registered("E8"); ?>>
                                <label for="E8">E8</label><br>
                                <input type="radio" id="E9" name="group_lane_code" value="E9" <?php is_registered("E9"); ?>>
                                <label for="E9">E9</label><br>
                                <input type="radio" id="E10" name="group_lane_code" value="E10" <?php is_registered("E10"); ?>>
                                <label for="E10">E10</label>
                                </div>
                            </div>
                            <label>POSTCODE:</label>
                            <input name="postcode" type="text" minlength="6" maxlength="8" placeholder="Enter postcode here" required>
                        </div>
                        <div class="formColumns">
                            <label>CITY:</label>
                            <input name="city" type="text" maxlength="30" placeholder="Enter city name here" required>
                            <label>COUNTRY:</label>
                            <input name="country" type="text" maxlength="30" placeholder="Enter country name here" required>
                            <input id="submitButton" type="submit" value="SUBMIT">
                            <p>ALREADY HAVE AN ACCOUNT? <a href="#login">LOG IN</a></p>
                        </div>
                    </form>
                    <form id="ipadRegisterForm" method="POST" action="php/registerParticipant.php">
                        <div class="formColumns">
                            <label>FIRST NAME:</label>
                            <input name="first_name" type="text" maxlength="20" placeholder="Enter first name here" required>
                            <label>SURNAME:</label>
                            <input name="last_name" type="text" maxlength="20" placeholder="Enter surname here" required>
                            <label>DATE OF BIRTH:</label>
                            <input name="date_of_birth" type="date" min= "1998-01-01" max="2004-12-31" placeholder="Enter date of birth here" required>
                            <label>MOBILE NUMBER:</label>
                            <input name="mobile_number" type="tel" minlength="11" maxlength="11" placeholder="Enter mobile number here" required>
                            <label>EMAIL:</label>
                            <input name="email" type="email" maxlength="50" placeholder="Enter email here" required>
                            <label>PASSWORD:</label>
                            <input name="password" type="password" minlength="8" placeholder="Enter password here" required>
                            <label>CONFIRM PASSWORD:</label>
                            <input name="password_confirmed" type="password" minlength="8" placeholder="Confirm password here" required>
                        </div>
                        <div class="formColumns">
                            <div id="radioButtonsContainer">
                                <label id="radioColumnTag">GROUP-LANE CODE:</label>
                                <div class="radioColumns">
                                    <input type="radio" id="A1" name="group_lane_code" value="A1" <?php is_registered("A1"); ?>>
                                    <label for="A1">A1</label><br>
                                    <input type="radio" id="A2" name="group_lane_code" value="A2" <?php is_registered("A2"); ?>>
                                    <label for="A2">A2</label><br>
                                    <input type="radio" id="A3" name="group_lane_code" value="A3" <?php is_registered("A3"); ?>>
                                    <label for="A3">A3</label><br>
                                    <input type="radio" id="A4" name="group_lane_code" value="A4" <?php is_registered("A4"); ?>>
                                    <label for="A4">A4</label><br>
                                    <input type="radio" id="A5" name="group_lane_code" value="A5" <?php is_registered("A5"); ?>>
                                    <label for="A5">A5</label><br>
                                    <input type="radio" id="A6" name="group_lane_code" value="A6" <?php is_registered("A6"); ?>>
                                    <label for="A6">A6</label><br>
                                    <input type="radio" id="A7" name="group_lane_code" value="A7" <?php is_registered("A7"); ?>>
                                    <label for="A7">A7</label><br>
                                    <input type="radio" id="A8" name="group_lane_code" value="A8" <?php is_registered("A8"); ?>>
                                    <label for="A8">A8</label><br>
                                    <input type="radio" id="A9" name="group_lane_code" value="A9" <?php is_registered("A9"); ?>>
                                    <label for="A9">A9</label><br>
                                    <input type="radio" id="A10" name="group_lane_code" value="A10" <?php is_registered("A10"); ?>>
                                    <label for="A10">A10</label>
                                </div>
                                <div class="radioColumns">
                                    <input type="radio" id="B1" name="group_lane_code" value="B1" <?php is_registered("B1"); ?>>
                                    <label for="B1">B1</label><br>
                                    <input type="radio" id="B2" name="group_lane_code" value="B2" <?php is_registered("B2"); ?>>
                                    <label for="B2">B2</label><br>
                                    <input type="radio" id="B3" name="group_lane_code" value="B3" <?php is_registered("B3"); ?>>
                                    <label for="B3">B3</label><br>
                                    <input type="radio" id="B4" name="group_lane_code" value="B4" <?php is_registered("B4"); ?>>
                                    <label for="B4">B4</label><br>
                                    <input type="radio" id="B5" name="group_lane_code" value="B5" <?php is_registered("B5"); ?>>
                                    <label for="B5">B5</label><br>
                                    <input type="radio" id="B6" name="group_lane_code" value="B6" <?php is_registered("B6"); ?>>
                                    <label for="B6">B6</label><br>
                                    <input type="radio" id="B7" name="group_lane_code" value="B7" <?php is_registered("B7"); ?>>
                                    <label for="B7">B7</label><br>
                                    <input type="radio" id="B8" name="group_lane_code" value="B8" <?php is_registered("B8"); ?>>
                                    <label for="B8">B8</label><br>
                                    <input type="radio" id="B9" name="group_lane_code" value="B9" <?php is_registered("B9"); ?>>
                                    <label for="B9">B9</label><br>
                                    <input type="radio" id="B10" name="group_lane_code" value="B10" <?php is_registered("B10"); ?>>
                                    <label for="B10">B10</label>
                                </div>
                                <div class="radioColumns">
                                    <input type="radio" id="C1" name="group_lane_code" value="C1" <?php is_registered("C1"); ?>>
                                    <label for="C1">C1</label><br>
                                    <input type="radio" id="C2" name="group_lane_code" value="C2" <?php is_registered("C2"); ?>>
                                    <label for="C2">C2</label><br>
                                    <input type="radio" id="C3" name="group_lane_code" value="C3" <?php is_registered("C3"); ?>>
                                    <label for="C3">C3</label><br>
                                    <input type="radio" id="C4" name="group_lane_code" value="C4" <?php is_registered("C4"); ?>>
                                    <label for="C4">C4</label><br>
                                    <input type="radio" id="C5" name="group_lane_code" value="C5" <?php is_registered("C5"); ?>>
                                    <label for="C5">C5</label><br>
                                    <input type="radio" id="C6" name="group_lane_code" value="C6" <?php is_registered("C6"); ?>>
                                    <label for="C6">C6</label><br>
                                    <input type="radio" id="C7" name="group_lane_code" value="C7" <?php is_registered("C7"); ?>>
                                    <label for="C7">C7</label><br>
                                    <input type="radio" id="C8" name="group_lane_code" value="C8" <?php is_registered("C8"); ?>>
                                    <label for="C8">C8</label><br>
                                    <input type="radio" id="C9" name="group_lane_code" value="C9" <?php is_registered("C9"); ?>>
                                    <label for="C9">C9</label><br>
                                    <input type="radio" id="C10" name="group_lane_code" value="C10" <?php is_registered("C10"); ?>>
                                    <label for="C10">C10</label>
                                </div>
                                <div class="radioColumns">
                                    <input type="radio" id="D1" name="group_lane_code" value="D1" <?php is_registered("D1"); ?>>
                                    <label for="D1">D1</label><br>
                                    <input type="radio" id="D2" name="group_lane_code" value="D2" <?php is_registered("D2"); ?>>
                                    <label for="D2">D2</label><br>
                                    <input type="radio" id="D3" name="group_lane_code" value="D3" <?php is_registered("D3"); ?>>
                                    <label for="D3">D3</label><br>
                                    <input type="radio" id="D4" name="group_lane_code" value="D4" <?php is_registered("D4"); ?>>
                                    <label for="D4">D4</label><br>
                                    <input type="radio" id="D5" name="group_lane_code" value="D5" <?php is_registered("D5"); ?>>
                                    <label for="D5">D5</label><br>
                                    <input type="radio" id="D6" name="group_lane_code" value="D6" <?php is_registered("D6"); ?>>
                                    <label for="D6">D6</label><br>
                                    <input type="radio" id="D7" name="group_lane_code" value="D7" <?php is_registered("D7"); ?>>
                                    <label for="D7">D7</label><br>
                                    <input type="radio" id="D8" name="group_lane_code" value="D8" <?php is_registered("D8"); ?>>
                                    <label for="D8">D8</label><br>
                                    <input type="radio" id="D9" name="group_lane_code" value="D9" <?php is_registered("D9"); ?>>
                                    <label for="D9">D9</label><br>
                                    <input type="radio" id="D10" name="group_lane_code" value="D10" <?php is_registered("D10"); ?>>
                                    <label for="D10">D10</label>
                                </div>
                                <div class="radioColumns">
                                    <input type="radio" id="E1" name="group_lane_code" value="E1" <?php is_registered("E1"); ?>>
                                    <label for="E1">E1</label><br>
                                    <input type="radio" id="E2" name="group_lane_code" value="E2" <?php is_registered("E2"); ?>>
                                    <label for="E2">E2</label><br>
                                    <input type="radio" id="E3" name="group_lane_code" value="E3" <?php is_registered("E3"); ?>>
                                    <label for="E3">E3</label><br>
                                    <input type="radio" id="E4" name="group_lane_code" value="E4" <?php is_registered("E4"); ?>>
                                    <label for="E4">E4</label><br>
                                    <input type="radio" id="E5" name="group_lane_code" value="E5" <?php is_registered("E5"); ?>>
                                    <label for="E5">E5</label><br>
                                    <input type="radio" id="E6" name="group_lane_code" value="E6" <?php is_registered("E6"); ?>>
                                    <label for="E6">E6</label><br>
                                    <input type="radio" id="E7" name="group_lane_code" value="E7" <?php is_registered("E7"); ?>>
                                    <label for="E7">E7</label><br>
                                    <input type="radio" id="E8" name="group_lane_code" value="E8" <?php is_registered("E8"); ?>>
                                    <label for="E8">E8</label><br>
                                    <input type="radio" id="E9" name="group_lane_code" value="E9" <?php is_registered("E9"); ?>>
                                    <label for="E9">E9</label><br>
                                    <input type="radio" id="E10" name="group_lane_code" value="E10" <?php is_registered("E10"); ?>>
                                    <label for="E10">E10</label>
                                </div>
                            </div>
                            <label>POSTCODE:</label>
                            <input name="postcode" type="text" minlength="6" maxlength="8" placeholder="Enter postcode here" required>
                            <label>CITY:</label>
                            <input name="city" type="text" maxlength="30" placeholder="Enter city name here" required>
                            <label>COUNTRY:</label>
                            <input name="country" type="text" maxlength="30" placeholder="Enter country name here" required>
                            <input id="submitButton" type="submit" value="SUBMIT">
                            <p>ALREADY HAVE AN ACCOUNT? <a href="#login">LOG IN</a></p>
                        </div>
                    </form>
                </section>

                <section id="login" <?php if (isset($_SESSION["email"])) {echo 'style="display: none;"';} ?>>
                    <h1>Welcome back!</h1>
                    <form id="desktopLoginForm" method="POST" action="php/loginParticipant.php">
                        <div>
                            <label>EMAIL:</label>
                            <input name="email" type="email" maxlength="50" placeholder="Enter email here" required>
                            <label>PASSWORD:</label>
                            <input name="password" type="password" minlength="8" placeholder="Enter password here" required>
                            <input id="submitButton" type="submit" value="LOG IN">
                            <p>NOT ON BOARD YET? <a href="#joinUs">SIGN UP</a></p>
                        </div>
                    </form>
                </section>

                <section class="hiddenForPHP" <?php if (isset($_SESSION["email"])) {echo 'style="display: block;"';} ?> id="race">
                    <h1>Ready?</h1>

                    <p>Your group-lane code is <b><?php if (isset($_SESSION["group_lane_code"])) {echo $_SESSION["group_lane_code"];}?></b></p>
                    
                    <p>Time and place: <?php if (isset($_SESSION["race_details"])) {echo $_SESSION["race_details"];} ?></p>
                    
                    <p>Equipment provided: backpack, snowboard, trainers, SOS emergency device, helmet, goggles and mask</p>

                    <p>Equipment <b>needed</b>: gloves, weather-proof jackets, weather-proof trousers, thermal socks and hand watch</p>
                </section>

                <section class="hiddenForPHP" <?php if (isset($_SESSION["email"])) {echo 'style="display: block;"';} ?> id="opponents">
                    <h1>Your opponents</h1>
                    <div id="container">
                        <div id="psContainer">
                            <p>Here are the participants you will compete against. Lane numbers are hidden to ensure competition’s integrity. </p>
                            
                            <p>Please make sure you are considerate to other players at all times. Any anti-social behaviour may result in dismissing your participation.</p>
                        </div>
                        <div id="tableContainer">
                            <table>
                                <th>Name</th>
                                <th>Country</th>
                                <?php displayOpponents($_SESSION["group"]); ?>
                            </table>
                        </div>
                    </div>
                </section>

                <section class="hiddenForPHP" <?php if (isset($_SESSION["email"])) {echo 'style="display: block;"';} ?> id="unregister">
                    <h1>Not sure?</h1>
                    <p>It’s absolutely normal to feel nervous about the competition. We’ll provide you with support every step of the way. We can also have some arrangements in place if you need them, please let us know if you think you fall into that category on this email: <b>support@eaglesclub.co.uk</b></p> <br>
                    <p>However, if you change your mind about participating in the competition, you can certainly unregister by clicking on the button below. By doing so, we will immediately delete all your stored details forever. You might be able to register again if there are places available. We are really sad to see you leave...</p>
                    <form action="php/unregisterParticipant.php" method="POST">
                        <input id="unregisterButton" type="submit" value="DELETE ACCOUNT">
                    </form>
                </section>
            </section>
        </main>
        
        <div class="intro">
            <div class="intro-text">
                <h1 class="hide">
                    <span class="text">It's Back!</span>
                </h1>
                <h1 class="hide">
                    <span class="text">Our Annual Snowboarding</span>
                </h1>
                <h1 class="hide">
                    <span class="text">Competition.</span>
                </h1>
            </div>
        </div>
        <div class="slider"></div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js" 
        integrity="sha512-H6cPm97FAsgIKmlBA4s774vqoN24V5gSQL4yBTDOY2su2DeXZVhQPxFK4P6GPdnZqM9fg1G3cMv5wD7e6cFLZQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="js/JSanimations.js"></script>
    </body>
</html>