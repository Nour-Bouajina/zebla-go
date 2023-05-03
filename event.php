<?php

session_start();

include("backend/connection.php");
include("backend/functions.php");

$event_name = urldecode($_GET['event_name']);

$event = curr_event_info($event_name);
$event_status = is_event_running($event);// 0 event hasent started 1 event is ongoing and 2 event is done
$calc_dist = ($event_status == 2 ? 0:1);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio</title>
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="style/style_event.css">
    <script>
        const searchBtn = document.querySelector(".search_btn");
        let map, searchManager;
        function getMap() {
            map = new Microsoft.Maps.Map("#map", {
            credentials: 'AskZI7hJZdiLqVVluq4uSDYNQxipttq0GGvJEv3mceRGXyiE8O_PrW4wM5s5nJ4U'
            });
            var location = new Microsoft.Maps.Location(<?=$event["lat"]?>, <?=$event["longi"]?>);
            var pin = new Microsoft.Maps.Pushpin(location);
            map.entities.push(pin);
        }
    </script>
    <script src='http://www.bing.com/api/maps/mapcontrol?callback=getMap&enableScripts=true' async></script>
</head>
<body>
    <header>
       
       <h3> <?=$event_name;?> </h3>
       <div class="line"></div>
    </header>
    <div class="Join_us">
        <h3>We would really love to have you</h3>
        <div class="line"></div>

        
        <?php 
            handel_messges();
            if (!is_user_event($_SESSION['user_id'], $event["event_id"]) && $event_status != 2){
            $count_down = $event["start_date"];
            echo '<form action="backend\join_event.php" method="post">          
                      <input type="submit" value="Join event!" class="btn">
                      <input type="hidden" name="event_name" value='.$event_name.'>
                      <input type="hidden" name="event_id" value='.$event["event_id"].'>
                      <input type="hidden" name="action" value=0>
                    </form>';
            }else if ($event_status == 0 && is_user_event($_SESSION['user_id'], $event["event_id"])){
                $count_down = $event["start_date"];

                echo '<form action="backend\join_event.php" method="post">          
                <input type="submit" value="leave event" class="leave_btn btn">
                <input type="hidden" name="event_name" value='.$event_name.'>
                <input type="hidden" name="event_id" value='.$event["event_id"].'>
                <input type="hidden" name="action" value=1>
              </form>';
            }else if($event_status == 1){
                $count_down = $event["end_date"];
                echo '<form action="backend/ml.php" method="post" enctype="multipart/form-data">
                <label for="image1" class="upload-btn">Select image</label>
                <input type="file" name="image1" id="image1">
                <label for="image2" class="upload-btn">Select image</label>
                <input type="file" name="image2" id="image2">
                <input type="hidden" name="event_name" value='.$event_name.'>
                <input type="submit" name="submit" value="Upload" class="submit-btn">
              </form>';
                }
            else{

                $count_down = $event["start_date"];
                echo '
                <div class="title-leaderboard"><h1>See our winners !</h1></div>
                <br>
                <main>
                <div id="head">
                    <h1>Ranking</h1>
                </div>
                <div id="leaderboard">
                    <div class="ribbon"></div>
                    <table>';
                 make_leaderboard(5,$event["event_id"]);
                echo '</table>
                </div> 
                ';
            }
            

        ?>



        </div>

    </section>  
    
    <section class ="about_event" id ="about">
        <div class="about-text">
            <h2><?=$event_name;?></h2>
            <p><?=$event['description'];?></p>
        </div>
        <img src=<?php echo get_event_pic($event['event_id']); ?>>
    </section>

    <section class="Location_map">
        <div class= "container">
            <h1>Location of the event</h1>
            <div id="map"></div>
        </div>
    </section>

    <section class="why_join">
        <div id="clean_env">
            <img src="img\earth.png">
            <h3>clean environment</h3>
            <h6>Lorem ipsum dolor sit, Consectetur quia quaerat animi quasi corporis asperiores tempore dolor iusto repellendus vel</h6>
        </div>
        <div id="community">
            <img src="img\Community.png">
            <h3>boost sense of community</h3>
            <h6>Lorem ipsum dolor sit, Consectetur quia quaerat animi quasi corporis asperiores tempore dolor iusto repellendus vel</h6>
        </div>
        <div id="awareness">
            <img src="img\think-green.png">
            <h3>Spread awareness</h3>
            <h6>Lorem ipsum dolor sit, Consectetur quia quaerat animi quasi corporis asperiores tempore dolor iusto repellendus vel</h6>
        </div>
        <div id="have_fun">
            <img src="img\have_fun.png">
            <h3>Have fun</h3>
            <h6>Lorem ipsum dolor sit, Consectetur quia quaerat animi quasi corporis asperiores tempore dolor iusto repellendus vel</h6>
        </div>
    </section>     
    
    <section class="time">
        <div class="timeleft">
            <div>
                <p id="days">00</p>
                <span>Days</span>
            </div>
            <div>
                <p id="hours">00</p>
                <span>Hours</span>
            </div>
            <div>
                <p id="minutes">00</p>
                <span>Minutes</span>
            </div>
            <div>
                <p id="seconds">00</p>
                <span>Seconds</span>
            </div>
        </div>

    </section>
    
</body>

<script>    
            var countdownDate = new Date('<?=$count_down?>').getTime();
            console.log(countdownDate);
            var x = setInterval(function(){
                var now = new Date().getTime();
                var distance = (countdownDate - now) * <?= $calc_dist?>;
                
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                document.getElementById("days").innerHTML = days;
                document.getElementById("hours").innerHTML = hours;
                document.getElementById("minutes").innerHTML = minutes;
                document.getElementById("seconds").innerHTML = seconds;

                if(distance < 0){
                    clearInterval(x);
                    document.getElementById("days").innerHTML = "00"
                    document.getElementById("seconds").innerHTML = "00";
                    document.getElementById("minutes").innerHTML = "00";
                    document.getElementById("hours").innerHTML = "00";
                }
            }, 1000);

            const imageInputs = document.querySelectorAll('input[type="file"]');
            const uploadBtns = document.querySelectorAll('.upload-btn');

            imageInputs.forEach((input, index) => {
              input.addEventListener('change', () => {
                if (input.value) {
                  uploadBtns[index].classList.add('selected');
                  uploadBtns[index].textContent = 'Image selected';
                } else {
                  uploadBtns[index].classList.remove('selected');
                  uploadBtns[index].textContent = 'Select image';
                }
              });
            });
        </script>
</html>

