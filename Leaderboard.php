<?php
session_start();
include("backend/connection.php");
include("backend/functions.php");

if (isset($_COOKIE[session_name()]) && isset($_SESSION['user_id'])) {
    $profile_link = 'profile.php'; 
    $profile_text = 'Profile';
} 
else {

    $profile_link = 'login.php'; 
    $profile_text = 'Login';
}
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style.css">
    <title>Zebla GO</title>
</head>

<body>

    <header class="header">
        
        <nav class="navbar">
       
            <div class="logo">ZEBLA <span>GO</span> </div>  <!-- LOGO -->

            <!-- NAVIGATION MENU -->
            <ul class="nav-links">

                <!-- NAVIGATION MENUS -->
                <div class="menu">

                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    
                    <li class="services">

                    <a href="events.php">Events</a>

                    <!-- DROPDOWN MENU -->
                    <ul class="dropdown">
                        <li><a href="events.php#your-events">Your events</a></li>
                        <li><a href="events.php#all-events">All events</a></li>
                        <li><a href="events.php#map">Map</a></li>

                    </ul>

                    </li> 

                    <li><a href="leaderboard.php">Leaderboard</a></li>
                    <li><a href="contact_us.php">Contact</a></li>
                    <li class="login_btn"><a href="<?php echo $profile_link; ?>" class="btn"><?php echo $profile_text; ?></a></li>
                
                </div>
            </ul>

        </nav>

    </header>

    <div class="leaderboard-container">

        <div class="title-leaderboard"><h1>See our winners !</h1></div>

        <br>

        <main>

        <div id="head">

            <h1>Ranking</h1>

            <button class="share">
            <i class="ph ph-share-network"><img src="img\share-6359476_1280.png" ></i>
            </button>

        </div>

        <div id="leaderboard">

            <div class="ribbon"></div>

            <table>

            <?php make_leaderboard(20,"overall");?>
            </table>

            

            <div id="buttons">
            <button class="continue"> <a href="Leaderboard.php"> See all the leaderboard</a></button>
            </div> 
        </div>

            </main>

    </div>

</body>