<?php 
session_start();

	include("professor_register/connection.php");
	include("professor_register/functions.php");

	$user_data = check_login($con);

?>

<!DOCTYPE html>
<html>
<head>
	<title>My website</title>
</head>
<body>

	<a href="professor_register/logout.php">Logout</a>
	<h1>This is the index page</h1>

	<br>
	Hello, <?php echo $user_data['name']; ?>
</body>
</html>