
<?php

session_start();
include("backend/connection.php");
include("backend/functions.php");


$user = curr_user_info();

$email = $user['email'];
$username = $user['user_name']." ".$user['lastname'];
?>

<script >
  let map, searchManager;

function getMap() {
  map = new Microsoft.Maps.Map("#map", {
    credentials: 'AskZI7hJZdiLqVVluq4uSDYNQxipttq0GGvJEv3mceRGXyiE8O_PrW4wM5s5nJ4U'
  });

  Microsoft.Maps.Events.addHandler(map, 'click', function(e) {
    // Get the location of the click event
    const location = e.location;

    // Update the form with the longitude and latitude values
    document.getElementById('longitude').value = location.longitude;
    document.getElementById('latitude').value = location.latitude;

    // Clear any existing pins from the map and add a new pin at the clicked location
    map.entities.clear();
    const pin = new Microsoft.Maps.Pushpin(location);
    map.entities.push(pin);
  });
}

</script>
<script src='http://www.bing.com/api/maps/mapcontrol?callback=getMap&enableScripts=true' async></script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" type='text/css' media='screen' href='style/style_form.css'>
  </head>
<body>

<h4> If you want to recreate a previous event select it from the list below</h4>
<button id="fillFormButton">Load old event</button><br>
<select name="titles" size=4>
    <?php get_artical_titles()?>
</select>
  <?php handel_messges() ?>

<h4> If you want to create a new event, fill in this form</h4>
<form action="backend/create_event.php" method="post" enctype="multipart/form-data">
<input type="text" id="longitude" name="longitude" hidden><br>
<input type="text" id="latitude" name="latitude" hidden><br>



  <label for="Your username"> Your Username:</label>
  <input type="text" name="username" value="<?php echo $username; ?>" autocomplete="off"/>

  <label for="Your account email"> Your account email:</label>
  <input type="text" name="email" value="<?php echo $email; ?>" autocomplete="off"/>



  <label for="datetimestart">Enter a date and time for the start of the event: </label>
  <input type="datetime-local" name="start_date" min="<%= new Date().toISOString().slice(0, 10) %>" step="1" />

  <label for="datetimeend">Enter a date and time for the end of the event: </label>
  <input type="datetime-local" name="end_date" min="<%= new Date().toISOString().slice(0, 10) %>" max="<%= new Date().toISOString().slice(0, 10) + '+3d' %>" step="1" />

    <label for="Governorate">Select the Governorate where the event is taking place</label>
  <select name="region_name">
  <option value="Ariana">Ariana</option>
        <option value="Beja">Beja</option>
        <option value="Ben Arous">Ben Arous</option>
        <option value="Bizerte">Bizerte</option>
        <option value="Gabes">Gabes</option>
        <option value="Gafsa">Gafsa</option>
        <option value="Jendouba">Jendouba</option>
        <option value="Kairouan">Kairouan</option>
        <option value="Kasserine">Kasserine</option>
        <option value="Kebili">Kebili</option>
        <option value="Kef">Kef</option>
        <option value="Mahdia">Mahdia</option>
        <option value="Manouba">Manouba</option>
        <option value="Medenine">Medenine</option>
        <option value="Monastir">Monastir</option>
        <option value="Nabeul">Nabeul</option>
        <option value="Sfax">Sfax</option>
        <option value="Sidi Bouzid">Sidi Bouzid</option>
        <option value="Siliana">Siliana</option>
        <option value="Sousse">Sousse</option>
        <option value="Tataouine">Tataouine</option>
        <option value="Tozeur">Tozeur</option>
        <option value="Tunis">Tunis</option>
        <option value="Zaghouan">Zaghouan</option>
</select>
  <label for="region-name">Write the exact name of the targeted region in the box or select it directly on map, enter a valid name and beware different spellings</label>
  <input type="text" name="location" >

  <label for="Event_name"> Set a name for your event:</label>
  <input type="text" name="name">

  <label for="Event_about"> Tell us more about the event, what is your motive and what do you want say to incite people to participate :</label>
  <textarea name="description" cols="40" rows="10"></textarea>   
  <label for="image">Event image:</label>
  <input type="file" id="event_image" name="event_image" >
  <label for="map"> Select the exact region you're targetting on the map</label>
  <div id="map"></div>
  <input type="submit" value="Submit">
</form>
</body>






<!-- This next script will show only the elements of the option-previous if it was selected or only the elemnts of the option-new if that one was selected & hide the elements of the other-->
<script>

function onStartChange() {
          var start = document.getElementById("datetimestart").value;
          var end = document.getElementById("datetimeend").value;

          if (start > end) {
            alert("The start time must be before the end time.");
            document.getElementById("datetimestart").value = "";
          }
        }

      function onEndChange() {
          var start = document.getElementById("datetimestart").value;
          var end = document.getElementById("datetimeend").value;

          if (start > end) {
            alert("The start time must be before the end time.");
            document.getElementById("datetimeend").value = "";
          }
        }

document.getElementById("fillFormButton").addEventListener("click", function() {

  var titles = document.getElementsByName("titles")[0];
  var event_title = titles.options[titles.selectedIndex].text;

  var xhr = new XMLHttpRequest();
  xhr.open("GET", "backend/get_old_event_info.php?event_title=" + event_title, true);

  xhr.onreadystatechange = function() {
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
      // Parse the JSON response
      var event_data = JSON.parse(this.responseText);

      // Populate the form fields with the event data
      console.log(event_data);
      document.getElementsByName("start_date")[0].value = event_data.start_date;
      document.getElementsByName("end_date")[0].value = event_data.end_date;
      document.getElementsByName("location")[0].value = event_data.location;
      document.getElementsByName("region_name")[0].value = event_data.region_name;
      document.getElementsByName("name")[0].value = event_data.name;
      document.getElementsByName("description")[0].value = event_data.description;
    }
  };
  xhr.send();
});


      </script>
