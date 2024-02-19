<?php 
session_start();

include("connection.php");
include("functions.php");

$skill_options = ['IT', 'Ekonomija', 'Inzenjering', 'Poljoprivreda'];
$interests_options = ['IT', 'Ekonomija', 'Inzenjering', 'Poljoprivreda'];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $skill = $_POST['skill'];
    $interests = $_POST['interests'];
    $education = $_POST['education'];

    if (!empty($first_name) && !empty($last_name) && !empty($email) && !empty($password) && !empty($skill) && !empty($interests) && !empty($education)) {
        $user_id = random_num(20);
        $query = "INSERT INTO users (name, lastName, email, password, skill, interests, education,user_id) VALUES ('$first_name', '$last_name', '$email', '$password', '$skill', '$interests', '$education','$user_id')";
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
    <link rel="stylesheet" href="user_register_style/signup_style.css">
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
            
            <label for="interests">Interests:</label>
            <select name="interests" id="interests" required>
                <?php foreach ($interests_options as $option): ?>
                    <option value="<?php echo $option; ?>"><?php echo $option; ?></option>
                <?php endforeach; ?>
            </select><br><br>
            <input type="text" name="education" placeholder="Edukacija" required><br><br>

            <input id="button" type="submit" value="Registruj se"><br><br>

            <a href="login.php">Već imas nalog? Uloguj se.</a>
        </form>
    </div>
</body>
</html>
