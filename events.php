<?php 
        session_start();
        include("backend/connection.php");
        include("backend/functions.php");
        //only show the last search results one, if we reload the page ddont display the last results
        if (isset($_SESSION['last_search'])){
            $last_search = $_SESSION['last_search'];
            unset($_SESSION['last_search']);
        }else{
         $last_search =  $array = array("name" => "","date" => "","location" => "");
        }
        if (isset($_COOKIE[session_name()]) && isset($_SESSION['user_id'])) {
          $profile_link = 'profile.php'; 
          $profile_text = 'Profile';
        } 
        else {
      
          $profile_link = 'login.php'; 
          $profile_text = 'Login';
        }
        $pins = get_artical_pin();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/events.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <script src = "event_map.js"></script>
    <script src='http://www.bing.com/api/maps/mapcontrol?callback=getMap&enableScripts=true' async></script>
    <script>
      window.onload = function() {
        <?php
            foreach($pins as $pin){
              if (is_event_running($pin)==2){//if event is done
                $color = "blue";
                $desc = "event Finished on ".$pin["end_date"]." with ".$pin["npart"]." participants";
              }else{
                $color = "green";
                $desc = "event will begin on ".$pin["start_date"]." with ".$pin["npart"]." participants";
              }
              
              echo 'addPin('.$pin["lat"].', '.$pin["longi"].', "'.$pin["name"].'", "'.$desc.'","'.$color.'");';
            }
          ?>

      }
    </script>

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
                     <li><a href="/">Dropdown 1</a></li>
                     <li><a href="/">Dropdown 2</a></li>
                     <li><a href="/">Dropdown 2</a></li>
                     <li><a href="/">Dropdown 3</a></li>
                     <li><a href="/">Dropdown 4</a></li>
                   </ul>
                   
                 </li> 
 
                 <li><a href="events.php">Leaderboard</a></li>
                 <li><a href="contact_us.php">Contact</a></li>
                 <li class="login_btn"><a href="<?php echo $profile_link; ?>" class="btn"><?php echo $profile_text; ?></a></li>
               
             </div>
           </ul>
  </nav>

  <div class="about-section">
      <h1>Events</h1>
    </div>

</header>

<br><br><br>

<div id="map"></div>

<div class = Varticallist>
  <button class="btn left"><i class="fas fa-arrow-left"></i></button>
    <?php get_user_articals() ?>
  <button class="btn right"><i class="fas fa-arrow-right"></i></button>
</div>

<br><br><br>
	
  <form class="search-container" action="backend\search.php" method="post">

      <input type="text" class="search-box" id="name" name="name" placeholder="Search..." value= "<?php echo $last_search['name'] ?>">
      <input type="date" class="date-input" id="date" name="date" value="<?php echo $last_search['date'] ?>">
		  <select class="location-dropdown" id = "location" name = "location">
			  <?php get_locations($last_search['location']) ?>
		  </select>
		<button class="search-button" type="submit">Search</button>

	</form>

  <br>

  <div class = articallist>
    <?php 
    	if(isset($_SESSION['articals'] )) { 
            echo $_SESSION['articals'] ;
            unset($_SESSION['articals'] ); 
        }else{
            echo get_all_articals();
        } ?>
    </div>

    <br><br><br>

    <div class="footer-container">

      <div class="footerr">
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




</body>

<script>
const rotateLeftBtn = document.querySelector("button.left");
const rotateRightBtn = document.querySelector("button.right");
const articles = document.querySelectorAll(".Varticallist article");
const articleWidth = articles[0].clientWidth;
let currentIndex  = 0;

rotateLeftBtn.addEventListener('click', () => {
  if (currentIndex > 0) {
    currentIndex--;
    for (let article of articles) {
        article.style.transform = `translateX(-${currentIndex * articleWidth}px)`;
    }
  }
});

rotateRightBtn.addEventListener('click', () => {
  if (currentIndex < articles.length - 1) {
    currentIndex++;
    for (let article of articles) {
        article.style.transform = `translateX(-${currentIndex * articleWidth}px)`;
    }
  }
  
});
</script>



</html>
