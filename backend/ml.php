<?php

include("connection.php");
include("functions.php");

if(isset($_POST['submit'])){
	$image1_name = $_FILES['image1']['name'];
	$image2_name = $_FILES['image2']['name'];
	
	$image1_tmp_name = $_FILES['image1']['tmp_name'];
	$image2_tmp_name = $_FILES['image2']['tmp_name'];
	
	$image1_type = $_FILES['image1']['type'];
	$image2_type = $_FILES['image2']['type'];
	
	$image1_ext = strtolower(pathinfo($image1_name, PATHINFO_EXTENSION));
	$image2_ext = strtolower(pathinfo($image2_name, PATHINFO_EXTENSION));
	
	$valid_extensions = array('jpg', 'jpeg', 'png');
	
	if(in_array($image1_ext, $valid_extensions) && in_array($image2_ext, $valid_extensions)){
		$image1_data = base64_encode(file_get_contents($image1_tmp_name));
		$image2_data = base64_encode(file_get_contents($image2_tmp_name));
		
		$data = array('image1' => $image1_data, 'image2' => $image2_data);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://localhost:5000/predict');
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
		$response = curl_exec($ch);
		curl_close($ch);
		
		$response = json_decode($response,true);

		$user = curr_user_info();
		$total_points = $user["points"] + $response["pints"];
		
		$stmt = mysqli_prepare($con,"UPDATE users set points = ? WHERE user_id = ?");
		mysqli_stmt_bind_param($stmt, "ii", $total_points,$user["user_id"]);
		mysqli_stmt_execute($stmt);

		$stmt = mysqli_prepare($con,"UPDATE enrolled_events set points = points + ? WHERE user_id = ? and event_id = ?");
		mysqli_stmt_bind_param($stmt, "iii", $total_points,$user["user_id"],$_POST["event_id"]);
		mysqli_stmt_execute($stmt);

		
		header("Location: ../event.php?event_name=".$_POST["event_name"]);
		if ($response["same_loc"]){
			$_SESSION['success_message'] = "you got ".$response["pints"]. " points! congratulation";
		}else{
			$_SESSION['error_message'] = "The locations dont match! ";
		}
	}else{
		echo "Invalid image file type!";
	}
}
?>