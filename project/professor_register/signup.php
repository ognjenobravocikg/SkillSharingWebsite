<?php 
session_start();

include("connection.php");
include("functions.php");

$skill_options = ['IT', 'Ekonomija', 'Inzenjering', 'Poljoprivreda'];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $skill = $_POST['skill'];
    $startTime = $_POST['startTime'];
    $endTime = $_POST['endTime'];
    $freeTime = $startTime . ' - ' . $endTime;

    if (!empty($name) && !empty($lastName) && !empty($email) && !empty($password) && !empty($skill) && !empty($freeTime)) {
        $professor_id = random_num(20);
        $query = "INSERT INTO professors (name, lastName, email, password, skill, freeTime, professor_id) VALUES ('$name', '$lastName', '$email', '$password', '$skill', '$freeTime', '$professor_id')";
        if (mysqli_query($con, $query)) {
            header("Location: login.php");
            exit;
        } else {
            echo "Error: " . mysqli_error($con);
        }
    } else {
        echo "Please enter valid information in all fields!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="professor_style/signup_style.css">
</head>
<body>
    <div id="box">
        <form method="post">
            <div>Registracija</div>

            <input type="text" name="first_name" placeholder="Ime" required><br><br>
            <input type="text" name="last_name" placeholder="Prezime" required><br><br>
            <input type="email" name="email" placeholder="E-mail" required><br><br>
            <input type="password" name="password" placeholder="Šifra" required><br><br>
            <label for="skill">Skill:</label>
            <select name="skill" id="skill" required>
                <?php foreach ($skill_options as $option): ?>
                    <option value="<?php echo $option; ?>"><?php echo $option; ?></option>
                <?php endforeach; ?>
            </select><br><br>
            <input type="time" name="startTime" required> - <input type="time" name="endTime" required>

            <input id="button" type="submit" value="Registruj se"><br><br>

            <a href="login.php">Već imaš nalog? Uloguj se.</a>
        </form>
    </div>
</body>
</html>
