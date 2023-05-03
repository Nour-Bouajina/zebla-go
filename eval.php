<!DOCTYPE html>
<html>
<head>
	<title>Upload Images</title>
</head>
<body>
	<form action="backend/ml.php" method="post" enctype="multipart/form-data">
		<label for="image1">Image 1:</label>
		<input type="file" name="image1" id="image1"><br><br>
		<label for="image2">Image 2:</label>
		<input type="file" name="image2" id="image2"><br><br>
		<input type="submit" name="submit" value="Upload">
	</form>
</body>
</html>