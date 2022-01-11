<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<?php
$username=$_POST['username'];
$password=$_POST['password'];

$con = new mysqli('localhost','root','','beatsjunior');
	if($con->connect_error){
		echo "$con->connect_error";
		die("Connection Failed : ". $con->connect_error);
	} else {
	$stmt=$con->prepare("select * from register where username = ?");
	$stmt->bind_param("s",$username);
	$stmt->execute();
	$stmt_result=$stmt->get_result();
	if($stmt_result->num_rows>0){
	$data=$stmt_result->fetch_assoc();
	if($data['password']===$password){
	    echo "succesful";
	}
	}else{
	echo "invalid";
	}
	}

?>
</body>
</html>