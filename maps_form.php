
<!--@@@@***@@@@***@@@@***@@@@***@@@@***@@@@***@@@@***@@@@-->

<html>
  <head>
    <title>Form for organizing Events</title>
    <meta charset="utf-8">
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type='text/css' media='screen' href='style/style_form.css'>
  </head>
 
       
  
  <!--@@@@***@@@@***@@@@***@@@@***@@@@***@@@@***@@@@***@@@@-->
        
        <label for="Exact region">Write the exact name of the targeted region in the box or select it directly on map, enter a valid name and beware different spellings</label>
        
        <div class="options">
          <input class="search_input" placeholder="Search">
          <button class="search_btn">Search</button>
        </div>
        <div id="map"></div>
        <script src='JS_map.js'></script>
        <script src='http://www.bing.com/api/maps/mapcontrol?callback=getMap&enableScripts=true' async></script>

