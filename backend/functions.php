<?php

function check_login($con)
{

	if(isset($_SESSION['user_id']))
	{

		$id = $_SESSION['user_id'];
		$query = "select * from users where user_id = '$id' limit 1";

		$result = mysqli_query($con,$query);
		if($result && mysqli_num_rows($result) > 0)
		{

			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
	}

	die;

}

function random_num()
{
	$text = "";
	$len = rand(20);
	for ($i=0; $i < $len; $i++) { 
		$text .= rand(0,9);
	}
	return $text;
}
function handel_messges(){
	if(isset($_SESSION['error_message'])) { 
		echo '<div class="error-message"> <p>' . $_SESSION['error_message'] . '</p> </div>';
		unset($_SESSION['error_message']); 
	}

	else if(isset($_SESSION['success_message'])) { 
		echo '<div class="success_message"> <p>' . $_SESSION['success_message'] . '</p> </div>';
 		unset($_SESSION['success_message']); 
	}
}

function get_filtered_articals($stmt = ""){
	include("connection.php");
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	if(mysqli_num_rows($result) > 0){
	  while($row = mysqli_fetch_assoc($result)){
		// Fetch the links related to the event
		
		$stmt = mysqli_prepare($con, "SELECT link FROM pic_links WHERE event_id = ? limit 1");
		mysqli_stmt_bind_param($stmt, "i", $row['event_id']);
		mysqli_stmt_execute($stmt);
		$link = mysqli_stmt_get_result($stmt);
		$link = mysqli_fetch_assoc($link);
		echo '<article id = "profile">
				<img src="'.$link["link"].'" alt="" />
				<div class="content">
		  			<h1><a href="event.php?event_name='.$row["name"].'" title="">'.$row["name"].'</a></h1>
		  			<p>'.$row["description"].'</p>
					<h5 class="footer">'.$row["start_date"].' - '.$row["end_date"].' in '.$row["location"].'</h5>

				</div>
	  			</article>';
	  }
	}else{
	  echo '<p> Join some events!</p>';
	}
}

//get the articals per user with old for old events and new for upcoming events
function get_all_articals(){
	include("connection.php");
	$filter = "SELECT events.* FROM events";
	$stmt = mysqli_prepare($con, $filter);
	get_filtered_articals($stmt);
}

function get_artical_pin(){
	include("connection.php");
	$filter = "SELECT count(enrolled_events.enroll_id) AS npart , events.* FROM events LEFT JOIN enrolled_events ON events.event_id = enrolled_events.event_id GROUP BY events.event_id";
	$stmt = mysqli_prepare($con, $filter);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	return $result;
}

function get_user_articals($filter = ""){
	include("connection.php");
	if($filter == "old"){
	  $filter = " and events.end_date < NOW()";
	}else if($filter == "new"){
	  $filter = " and events.end_date > NOW()";
	}

	$filter = "SELECT events.* FROM events , enrolled_events ev WHERE events.event_id = ev.event_id and ev.user_id = ? ".$filter;
	$stmt = mysqli_prepare($con, $filter);
	mysqli_stmt_bind_param($stmt, "i", $_SESSION['user_id']);
	get_filtered_articals($stmt);
  }

// get all of the locations for the search bar
function get_locations($curr_location = ''){
	include("connection.php");

	$menu = '';
	$total =0 ;
	$stmt = mysqli_prepare($con, "SELECT location ,count(*) occ FROM events group by location");
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	while($row = mysqli_fetch_assoc($result)){
		if ($row["location"] == $curr_location){
			$menu  .= '<option value="'.$row["location"].'" selected>'.$row["location"]."  (".$row["occ"].')</option>';
		}else{
			$menu  .= '<option value="'.$row["location"].'">'.$row["location"]."  (".$row["occ"].')</option>';
		}
		$total +=$row["occ"];
	}
	//make the first elemtn ALL
	$menu = '<option value=""> ALL ('.$total.')</option>'.$menu;
	echo $menu;
} 

function get_artical_titles($print = True){
	include("connection.php");
	$sql = "SELECT name FROM events";
	$stmt = mysqli_prepare($con, $sql);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	$titles=array();
	while($row = mysqli_fetch_assoc($result)){
		if($print){
			echo '<option value="event-1">'.$row["name"].'</option>';
		}
		array_push($titles, $row["name"]);
	}

	return $titles;
}

function curr_user_info(){
	include("connection.php");
	if(isset($_SESSION['user_id'])){
		// retrieve user info from database
		$stmt = mysqli_prepare($con, "SELECT * FROM users WHERE user_id = ?");
		mysqli_stmt_bind_param($stmt, "i", $_SESSION['user_id']);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$user = mysqli_fetch_assoc($result);
	}
	return $user;
}

function curr_event_info($event_name){
	include("connection.php");

	$stmt = mysqli_prepare($con, "SELECT * FROM events WHERE name = ?");
	mysqli_stmt_bind_param($stmt, "s", $event_name);
	mysqli_stmt_execute($stmt);

	$result = mysqli_stmt_get_result($stmt);
	$event = mysqli_fetch_assoc($result);

	return $event;
}


function get_event_pic($event_id){

	include("connection.php");

	$stmt = mysqli_prepare($con, "SELECT link FROM pic_links WHERE event_id = ? limit 1");
	mysqli_stmt_bind_param($stmt, "i", $event_id);
	mysqli_stmt_execute($stmt);
	$link = mysqli_stmt_get_result($stmt);
	$link = mysqli_fetch_assoc($link);

	return $link["link"];
}

function is_event_running($event){
	// 0 event hasent started 1 event is ongoing and 2 event is done
	$curr_date = date("Y-m-d H:i:s");
	if ($event["start_date"] > $curr_date){
		return 0;
	}else if ($curr_date > $event["start_date"] && $curr_date < $event["end_date"] ){
		return 1;
	}
	else{
		return 2;
	}

}

function is_user_event($user_id, $event_id){
	include("connection.php");
	
	$stmt = mysqli_prepare($con, "select * from enrolled_events where event_id = ? and user_id = ?");
	mysqli_stmt_bind_param($stmt, "ii", $event_id, $user_id);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	$num_rows = mysqli_num_rows($result);
	return ($num_rows != 0);
}


function make_leaderboard($limit, $type = "this_month"){
	include("connection.php");
	if($type == "this_month"){
		$filter = "SELECT users.user_name,users.lastname,sum(enrolled_events.points) as points 
	from enrolled_events 
	left join events on events.event_id = enrolled_events.event_id 
	LEFT JOIN users ON users.user_id = enrolled_events.user_id
	where events.start_date >= DATE_SUB(NOW(), INTERVAL 1 MONTH) GROUP by enrolled_events.user_id ORDER BY points DESC LIMIT 0, ?";
		

}	else if ($type == "overall"){
	$filter = "SELECT * FROM users ORDER BY points DESC LIMIT 0, ?";
	}
	else {
		$filter = "SELECT users.user_name,users.lastname,sum(enrolled_events.points) as points 
		from enrolled_events 
		LEFT JOIN users ON users.user_id = enrolled_events.user_id
		where enrolled_events.event_id = $type GROUP by enrolled_events.user_id ORDER BY points DESC LIMIT 0, ?";
		}
	
	
	$stmt = mysqli_prepare($con, $filter);
	mysqli_stmt_bind_param($stmt, "i", $limit);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	$user = mysqli_fetch_assoc($result);
	$name = $user["user_name"]." ".$user["lastname"];
	$counte = 1;
	echo '<tr>
			<td class="number">'.$counte.'</td>
			<td class="name">'.$name.'</td>
			<td class="points">'.$user["points"].'<img class="gold-medal" src="https://github.com/malunaridev/Challenges-iCodeThis/blob/master/4-leaderboard/assets/gold-medal.png?raw=true" alt="gold medal"/>
			</td>
		</tr>';
	
	while($user = mysqli_fetch_assoc($result)){
		$counte = $counte + 1 ;
		$name = $user["user_name"]." ".$user["lastname"];
		echo '<tr>
				<td class="number">'.$counte.'</td>
				<td class="name">'.$name.'</td>
				<td class="points">'.$user["points"].'</td>
			</tr>';
	}
	return $result;
}

