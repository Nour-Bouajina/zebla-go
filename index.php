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

          <!-- <div>
                  <h1> <span>“Never doubt that a small group of thoughtful, 
                  <br> committed citizens can change the world;
                  <br> indeed, it is the only thing that ever has.”</span> 
                  <br> —Margaret Mead </h1>
          </div> -->
        
      <div class="about-section">
      
        <h1> 
          Our small actions can change the world
          <br>Let's Unite to Save the Environment!
        </h1>

      </div>

    </header>

    <br><br>

    
    <div class="photo-list">

      <div class="photos">

        <img src="img/delice.jpg">
        <img src="img/delice.jpg">
        <img src="img/delice.jpg">
        <img src="img/delice.jpg">
        <img src="img/delice.jpg">

      </div>

    </div>


    <br><br>


    <div class="about-container">

      <div class="heading">

        <h1>About Us</h1>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.
           Aperiam eveniet deserunt repudiandae in alias et?
        </p>


      </div> 

      <div class="container">

        <section class="about">

          <div class="about-image">  <img src="img\TEAMM.jpg">  </div>

          <div class="about-content">

            <h2>Lorem ipsum dolor sit amet.</h2> 

            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
              Qui facere, doloribus mollitia inventore, voluptatum sunt 
              assumenda cumque optio tempore doloremque perferendis impedit?
            </p>

            <a href="about.php" class="read-more">Read More</a>

          </div>

        </section>

      </div>

    </div>


    <br><br><br><br>



    <!-- <h1>Here is the leaderboard !</h1> -->

    

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
            <?php make_leaderboard(5);?>
          </table>

   
          

          <div id="buttons">
            <button class="continue"> <a href="Leaderboard.php"> See all the leaderboard</a></button>
          </div> 
        </div>

      </main>

    </div>


    <br><br>

    <section class="why_join">

        <div id="clean_env">
            <img src="img\earth.png">
            <h3>clean environment</h3>
            
        </div>

        <div id="community">
            <img src="img\Community.png">
            <h3>boost sense of community</h3>
            
        </div>
        
        <div id="awareness">
            <img src="img\think-green.png">
            <h3>Spread awareness</h3>
            
        </div>

        <div id="have_fun">
            <img src="img\have_fun.png">
            <h3>Have fun</h3>
            
        </div>
    </section> 



   <div class="footer-container">

      <div class="footer">
          <div class="footer-heading footer-1">

            <h2>About Us</h2>
             <a href="#">Blog</a>
             <a href="#">Demo</a>
             <a href="#">Blog</a>
             <a href="#">Blog</a>

          </div>

          <div class="footer-heading footer-2">

            <h2>Contact Us</h2>
             <a href="#">Jobs</a>
             <a href="#">Support</a>
             <a href="#">Sponsorships</a>

          </div>

          <div class="footer-heading footer-3">

            <h2>Social Media</h2>
             <a href="#">Facebook</a>
             <a href="#">instagram</a>
             <a href="#">Twitter</a>
             <a href="#">Youtube</a>

          </div>

          <div class="footer-email-form">

            <h2>Join our newsletter now !</h2>
            <input type="email" placeholder="Enter your email adress">
            <input type="submit" value="sign up" id="footer-email-btn">

          </div>

      </div>

   </div>

  <script>
        
    const prevButton = document.getElementById('prev-button');
    const nextButton = document.getElementById('next-button');
    const photosContainer = document.querySelector('.photos');
    const photos = photosContainer.querySelectorAll('img');
    const photoWidth = photos[0].offsetWidth;
    let currentIndex = 0;

    prevButton.addEventListener('click', () => {
      currentIndex = Math.max(currentIndex - 1, 0);
      photosContainer.style.transform = `translateX(-${currentIndex * photoWidth}px)`;
    });

    nextButton.addEventListener('click', () => {
      currentIndex = Math.min(currentIndex + 1, photos.length - 1);
      photosContainer.style.transform = `translateX(-${currentIndex * photoWidth}px)`;
    });


	</script>


</body>


</html>