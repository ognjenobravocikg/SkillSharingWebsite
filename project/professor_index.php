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

	<a href="professor_register/logout.php">Odjavi se</a>
	<h1>Dobrodošli</h1>

	<br>
	Zdravo, <?php echo $user_data['name']; ?>
	<br>
	<br>
	<a href="settings/professors_settings.php">Podešavanja</a>

</body>
</html>