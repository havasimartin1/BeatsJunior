<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<?php
$username = $_POST['username'];
$password = $_POST['password'];

	// Database connection
	$conn = new mysqli('localhost','root','','beatsjunior');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		$stmt = $conn->prepare("insert into register(username, password) values(?, ?)");
		$stmt->bind_param("ss", $username, $password);
		$stmt->execute();
		echo "Registration successfully...";
		$stmt->close();
		$conn->close();
	}
?>
</body>
</html>